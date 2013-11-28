<?php

class RemSkladController extends DaObjectController {
	protected $idObject = 'project-sklady';
	private $whr;
	
	public function __construct($id,$module=null) {
		parent::__construct($id, $module);
		$this->whr = new RemoteWh;
	}
	public function actionIndex(){
		$sklads = $this->whr->rwhGetList();
		#var_dump($sklads);
		$this->render('/sklads', array(
			'sklads' => $sklads,
		));
	}
	public function actionSklad($id) {
		$model['auto'] = $this->whr->rwhGetAutoData((int)$id);
		if(!empty($model['auto']['use_date'])){
			$model['chek'] = 'checked';
			$model['display'] = 'block';
		}else{
			$model['chek'] = '';
			$model['display'] = 'none';
		}
		$this->render('/sklad', array(
			'sklad'	=> $this->whr->rwhGetOne((int)$id),
			'model'	=> $model,
			'items'	=> $this->whr->rwhGetDetailsPage(array('id'=>(int)$id,'show'=>21,'page'=>1)),
			'id'	=>$id,
		));
	}
	public function actionShowGoodsInSklad($id,$page){
		var_dump($this->whr->rwhGetDetailsPage(array('id'=>(int)$id,'show'=>21,'page'=>(int)$page)));
	}
	public function actionSaveInfoSklad(){
		$arr = array(
			'id'	=> HU::post('id'),
			'name'	=> iconv('utf-8','windows-1251',HU::post('name')),
			'sname'	=> iconv('utf-8','windows-1251',HU::post('sname')),
			'sort'	=> HU::post('sort'),
			'code'	=> HU::post('code'),
			'des'	=> iconv('utf-8','windows-1251',HU::post('des')),
		);
		var_dump($arr);
		$this->whr->rwhAddUpdateOne($arr);
	}
	public function actionUpdate($sid){
		echo '<pre>';
			system('cd protected; php -q console.php price autoload --sid='.$sid, $code);
		echo '<pre>';
		echo 'Код возврата: '.$code;
	}
}