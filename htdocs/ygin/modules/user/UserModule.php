<?php

class UserModule extends DaWebModuleAbstract {

  const ROUTE_LOGOUT = 'user/cabinet/logout';
  const ROUTE_LOGIN = 'user/cabinet/login';
  const ROUTE_REGISTER = 'user/cabinet/register';
  const ROUTE_PROFILE = 'user/cabinet/profile';
  const ROUTE_BALANCE = 'user/cabinet/balance';
  const ROUTE_CABINET = 'user/cabinet/cabinet';
  const ROUTE_ORDERS = 'user/cabinet/orders';
  const ROUTE_STAT = 'user/cabinet/stat';
  const ROUTE_RETUNS = 'user/cabinet/retuns';
  const ROUTE_SUBSCRIPTION = 'user/cabinet/subscription';
  const ROUTE_RECOVER = 'user/cabinet/recover';
  const ROUTE_VIEW = 'user/cabinet/view';
  const ROUTE_ADMIN_LOGIN = 'user/user/login';
  const ROUTE_ADMIN_LOGOUT = 'user/user/logout';
  const ROUTE_CART = 'user/cart/index';
  const ROUTE_CART_ADD = 'user/cart/AddBasket';
  const ROUTE_CART_DEL = 'user/cart/DeleteBasket';
  const ROUTE_CART_CHANG = 'user/cart/ChangeBasket';
  const ROUTE_CART_CLEAR = 'user/cart/ClearBasket';
  
  /** Чтобы иметь возможность нормально переопределять */
  public $routeLogout = self::ROUTE_LOGOUT;
  public $routeLogin = self::ROUTE_LOGIN;
  public $routeRegister = self::ROUTE_REGISTER;
  public $routeRecover = self::ROUTE_RECOVER;
  public $routeProfile = self::ROUTE_PROFILE;
  public $routeBalance = self::ROUTE_BALANCE;
  public $routeCabinet = self::ROUTE_CABINET;
  public $routeOrders = self::ROUTE_ORDERS;
  public $routeStat = self::ROUTE_STAT;
  public $routeRetuns = self::ROUTE_RETUNS;
  public $routeSubscription = self::ROUTE_SUBSCRIPTION;
  public $routeView = self::ROUTE_VIEW;
  public $cart = self::ROUTE_CART;
  public $cartAdd = self::ROUTE_CART_ADD;
  public $cartDell = self::ROUTE_CART_DEL;
  public $cartChang = self::ROUTE_CART_CHANG;
  public $cartClear = self::ROUTE_CART_CLEAR;
  
  
  /**
   * Роут для редиректа пользователя после регистрации
   * @var string
   */
  public $redirectRouteAfterRegister;
  /**
   * Нужно ли сразу авторизовывать пользователя после регистрации
   * @var boolean
   */
  public $immediatelyAuthorization = true;
  
  /**
   * @var boolean Доступность личного кабинета
   */
  public $cabinetEnabled = false;
  
  public $defaultController = "user";
  /**
   * @var int Тип события "Восстановление пароля"
   */
  public $idEventTypeRecover;
  /**
   * @var int Подписчик на событие "Восстановление пароля"
   */
  public $idEventSubscriberRecover;
  /**
   * @var int Тип события "Регистрация пользователя"
   */
  public $idEventTypeRegister;

  public function init() {
    $this->setImport(array(
        $this->getId().'.models.*',
        $this->getId().'.components.*',
        $this->getId().'.behaviors.password.*',
        $this->getId().'.components.auth.models.*',
    ));
    
    if ($this->cabinetEnabled) {
      $this->setUrlRules(array(
        'login'         => $this->routeLogin,
        'logout'        => $this->routeLogout,
        'register'      => $this->routeRegister,
        'cabinet/profile'       => $this->routeProfile,
		'cabinet/balance'       => $this->routeBalance,
		'cabinet/'       => $this->routeCabinet,
		'cabinet/orders'       => $this->routeOrders,
		'cabinet/stat'       => $this->routeStat,
		'cabinet/retuns'       => $this->routeRetuns,
		'cabinet/subscription'       => $this->routeSubscription,
        'recover'       => $this->routeRecover,
        'user/<id:\d+>' => $this->routeView,
		'search/cart/' =>$this->cart,
		'search/cart/add' =>$this->cartAdd,
		'search/cart/DeleteBasket' =>$this->cartDell,
		'search/cart/ChangeBasket' =>$this->cartChang,
		'search/cart/ClearBasket' =>$this->cartClear,
      ));
    }
    
    if (Yii::app()->isBackend) {
      $ext = Yii::createComponent('user.components.RbamExtension', $this);
      Yii::app()->backend->addExtension($ext);
      //для админки надо поменять роуты
      $this->setUrlRules(array(
        'login' => self::ROUTE_ADMIN_LOGIN,
        'logout' => self::ROUTE_ADMIN_LOGOUT,
      ));
      Yii::app()->user->loginUrl = array(self::ROUTE_ADMIN_LOGIN);
    }
  }

}
