<?php
class CabinetController extends Controller {
  public $defaultAction = 'profile';
  
  
  public function actions() {
    return CMap::mergeArray(parent::actions(), array(
      'login'  => 'LoginAction',
      'logout' => 'LogoutAction',
    ));
  }
  
  public function filters() {
    return array(
      'accessControl',
    );
  }
  
  public function accessRules(){
    return array(
      array('allow',
        'actions'=>array('register', 'recover'),
        'users'=>array('?'),
      ),
      array('allow',
        'actions'=>array('profile','balance','stat','orders','retuns','subscription','cabinet'),
        'users'=>array('@'),
      ),
      array('allow',
        'actions'=>array('login', 'recovery'),
        'users'=>array('?'),
      ),
      array('allow',
        'actions'=>array('logout', 'captcha', 'view'),
        'users'=>array('*'),
      ),
      array('deny',
        'users' => array('*'),
      ),
    );
  }
  private function getUchetInfo(){
		$model = Yii::app()->user->getUchetModel();
		
		$uchet = new Uchet;
		$cClientInfo = $uchet->get_cClientInfo($model['codeU']);
		$fClientInfo = $uchet->get_fClientInfo($model['codeU']);
		$model = array('cInfo'=>$cClientInfo,'fInfo'=>$fClientInfo,'login'=>$model['login']);
		unset($uchet);
		return $model;
  }
  private function getDate($prov){
		#$dates = time()-(7*24*60*60);
		#$dates = date('d.m.Y', $dates); //Прошлая неделя

		$dates = $prov;
		$datee = time();
		$datee = date('d.m.Y', $datee);	//Сегодня

		return array('dates'=>$dates,'datee'=>$datee);
  }
  public function performAjaxValidation($model, $ajaxFormId) {
    if (isset($_POST['ajax']) && $_POST['ajax']===$ajaxFormId) {
      echo CActiveForm::validate($model);
      Yii::app()->end();
    }
  }
  
  protected function getRedirectRouteAfterRegister() {
    $module = Yii::app()->getModule('user');
    if (!empty($module->redirectRouteAfterRegister)) {
      return $module->redirectRouteAfterRegister;
    }
    if ($module->immediatelyAuthorization) {
      return $module->routeProfile;
    }
    return $module->routeLogin;
  }
  
  public function actionRegister() {
    $model = BaseActiveRecord::newModel('User', 'register');
    $modelClass = get_class($model);
    $this->performAjaxValidation($model, 'register-form');
  
    if (isset($_POST[$modelClass])) {
      $model->attributes = $_POST[$modelClass];
      //Создаем indentity раньше сохранения модели
      //т.к. после сохранения поле user_password измениться на хеш
      $identity = new UserIdentity($model->name, $model->user_password);
      $model->onAfterSave = array($this, 'sendRegisterMessage');
      if ($model->save()) {
        //если разрешено сразу авторизовать пользователя
        if (Yii::app()->getModule('user')->immediatelyAuthorization) {
          //загружаем модель пользователя
          var_dump($identity->authenticate());
          //Сразу авторизуем пользователя
          Yii::app()->user->login($identity);
          Yii::app()->user->setFlash('registerSuccess', 'Регистрация успешно завершена.');
        } else {
          Yii::app()->user->setFlash('registerSuccess', 'Регистрация успешно завершена. Теперь вы можете войти на сайт через форму авторизации.');
        }
        
        $this->redirect(Yii::app()->createUrl($this->getRedirectRouteAfterRegister()));
      }
    }
    $this->render('/register', array('model' => $model));
  }
  public function sendRegisterMessage(CEvent $event) {
    /* @var User $$user */
    $user = $event->sender;
    $message = $this->renderPartial('/register_email', array('user' => $user), true);
    Yii::app()->notifier->addNewEvent(
      $this->module->idEventTypeRegister,
      $message
    );
  }
  public function actionRecover() {
    $model = BaseFormModel::newModel('RecoverForm');
    $modelClass = get_class($model);
    $this->performAjaxValidation($model, 'recover-form');
    if (isset($_POST[$modelClass])) {
      $model->attributes = $_POST[$modelClass];
      if ($model->validate()) {
        $model->onRecover = array($this, 'sendRecoverMessage');
        $model->recover();
        Yii::app()->user->setFlash('recoverSuccess', 'Новый пароль от вашего аккаунта отправлен вам на e-mail.');
        $this->refresh();
      }
    }
    $this->render('/recover', array('model' => $model));
  }
  
  public function sendRecoverMessage(CEvent $event) {
    /* @var RecoverForm $recoverForm */
    $recoverForm = $event->sender;
    $message = $this->renderPartial('/recoveryMessage', array('recoverForm' => $recoverForm), true);
    Yii::app()->notifier->addNewEvent(
      $this->module->idEventTypeRecover,
      $message,
      $this->module->idEventSubscriberRecover,
      $recoverForm->getUserModel()->mail
    )->sendNowLastAdded();
  }
  
  public function actionView($id) {
    $model = BaseActiveRecord::model('User')->findByPk($id);
    if ($model === null) {
      $this->throw404Error();
    }
    $this->render('/view', array('model' => $model));
  }
  
  public function actionProfile() {
	$model = $this->getUchetInfo();
	#var_dump($model);
    #$model = Yii::app()->user->getModel();
    #$model->scenario = 'profile';
    #$modelClass = get_class($model);
    #$this->performAjaxValidation($model, 'profile-form');
  
    #if (isset($_POST[$modelClass])) {
    #  $model->attributes = $_POST[$modelClass];
    #  if ($model->save()) {
    #    Yii::app()->user->setFlash('profileSuccess', 'Профиль успешно изменен.');
    #    $this->refresh();
    #  }
    #}
    //Затираем пароль, чтобы он не отображался в инпуте
    #$model->user_password = '';
	$uchet = new Uchet;
	$skids =  $uchet->get_client_discounts($model['cInfo']['company_code']);
	if (isset($skids['0'])){
            $skid = array();
            foreach ($skids as $sk){
                $skid[$sk['name']] = $sk['discount'];
            }
        }
	$model['skid'] = $skid;
    $this->render('/profile', array('model' => $model));
  }
	public function actionBalance(){
		$model = $this->getUchetInfo();
		#var_dump($model);
		$this->render('/balance',array('model'=>$model));
	}
	#Страница Подписок
	public function actionSubscription(){
		$model = $this->getUchetInfo();
		$uchet = new Uchet;
		$tmp = $uchet->GetClientSubscription($model['cInfo']['company_code']);
		if (is_array($tmp)){
			$i=0;
			foreach ($tmp as &$sub){
				switch ($sub['news_type']){
					case 1:
						$sub['type'] = 'Основной склад';
						break;
					case 2:
						$sub['type'] = 'Поступление';
						break;
					case 3:
						$sub['type'] = 'Изменение цены';
						break;
					default:
						$sub['type'] = 'новое оповещение';
				}
				switch ($sub['news_type']){
					case 1:
						$sub['show'] = 'E-mail';
						break;
					case 2:
						$sub['show'] = 'Личный Кабинет';
						break;
					default:
						$sub['show'] = 'новое оповещение';
				}
				$item = $uchet->GetItemInfo((int)$sub['nomencl_code']);
				$model['subscriptions'][$i]['id'] = $sub['id'];
				$model['subscriptions'][$i]['code'] = (int)$sub['nomencl_code'];
				$model['subscriptions'][$i]['type'] = $sub['type'];
				$model['subscriptions'][$i]['show'] = $sub['show'];
				$model['subscriptions'][$i]['created'] = substr($sub['created'], 0, 11); #смотрим первые 10 символов
				$model['subscriptions'][$i]['brand'] = $item['brand'];
				$model['subscriptions'][$i]['art'] = $item['linecode'];
				++$i;
			}
		}
		$this->render('/subscription',array('model'=>$model));
	}
	#Страница Взаиморасчетов
	public function actionStat(){
		$model = $this->getUchetInfo();
		$date = $this->getDate($model['fInfo']['start_date']);
		$uchet = new Uchet;
		$i=0;
		$sheet_tmp = $uchet->get_calculations($model['cInfo']['company_code'],$date['dates'],$date['datee']);
		$model['sheet_tmp'] = $sheet_tmp;
		if (count($sheet_tmp)>0){
			$model['sheet'] = $uchet->get_user_invoice($sheet_tmp);
			$model['nom1'] = count($model['sheet']);
			$model['pay'] = $uchet->get_user_pay_invoice($model['sheet']);
			$model['otgruz'] = $uchet->get_user_ship_invoice($model['sheet']);
			$model['vozvrat'] = $uchet->get_user_retuns_invoice($model['sheet']);
		}
		$this->render('/stat',array('model'=>$model));
	}
	#Страница Заказов
	public function actionOrders(){
		$model = $this->getUchetInfo();
		$date = $this->getDate($model['fInfo']['start_date']);
		$uchet = new Uchet;

		$i=0;
		$model['orders_tmp']  = $uchet->get_orders($model['cInfo']['company_code'],$date['dates'],$date['datee']);
		if (count($model['orders_tmp'])>0){
			$model['orders'] = $uchet->get_user_orders($model['orders_tmp']);
			$model['orders_status'] = $uchet->get_order_status($model['orders']);
		}
		$this->render('/orders',array('model'=>$model));
	}
	#Страница Возвратов
	public function actionRetuns(){
		$model = $this->getUchetInfo();
		$date = $this->getDate($model['fInfo']['start_date']);
		$uchet = new Uchet;

		$i=0;
		$model['retuns_tmp'] = $uchet->get_returns($model['cInfo']['company_code'],$date['dates'],$date['datee']);
		if (count($model['retuns_tmp'])>0){
			$model['retuns'] = $uchet->get_user_retuns($model['retuns_tmp']);
		}
		$this->render('/retuns',array('model'=>$model));
	}
	#Страница Кабинета
	public function actionCabinet(){
		 $session=new CHttpSession;
		$session->open();
		echo '<pre>';
	var_dump(Yii::app()->session->sessionID);
	var_dump($session);
	echo '</pre>';
		$model = $this->getUchetInfo();
		$this->render('/cabinet', array('model' => $model));
	}
  protected function beforeAction($action) {
    $this->urlAlias = $action->id == 'view' ? 'user' : $action->id;
    return parent::beforeAction($action);
  }
}