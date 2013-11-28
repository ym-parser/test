<?php

class RemoteModule extends DaWebModuleAbstract {

  const ROUTE_REMOTE_SKLADS = 'backend/remote/RemSklad/';
  const ROUTE_REMOTE_SKLAD = 'backend/remote/RemSklad/Sklad';
  const ROUTE_REMOTE_SKLAD_ITEMS = 'backend/remote/RemSklad/ShowGoodsInSklad';
  const ROUTE_REMOTE_SKLAD_SAVE = 'backend/remote/RemSklad/SaveInfoSklad';
    const ROUTE_REMOTE_SKLAD_MAIL_UPDATE = 'backend/remote/RemSklad/Update';

  public $urlRules = array(
    // TODO пока тут прописываем все маршруты объектов-контроллеров. Позже их необходимо будет отсюда убрать и что-то для них придумать
	'sklads' => self::ROUTE_REMOTE_SKLADS,
	'sklad/<id:\d+>' => self::ROUTE_REMOTE_SKLAD,
	'sklad/items/<id:\d+>/<page:\d+>' => self::ROUTE_REMOTE_SKLAD_ITEMS,
	'sklad/save' => self::ROUTE_REMOTE_SKLAD_SAVE,
	'sklad/mail/update/<sid:\d+>' => self::ROUTE_REMOTE_SKLAD_MAIL_UPDATE,
  );

  public function init() {
    $this->setImport(array(
        'ygin.modules.menu.models.*',
        'remote.models.*',
    ));
  }

  public static function updateByCode($code) {
    Yii::import('ygin.modules.backend.modules.remote.models.*');
    Yii::import('ygin.models.*');
  }

}
