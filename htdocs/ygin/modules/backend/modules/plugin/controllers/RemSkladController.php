<?php

class RemSkladController extends DaObjectController {
	protected $idObject = 528;
	#private whr;
	
	/*public function __construct(){
		$this->whr = new RemoteWh();
	}
	*/
	public function actionIndex($id) {
		$whr = new RemoteWh();
		$this->render('/sklad', array(
			'sklad' => $whr->rwhGetOne((int)$id),
			'items' => $whr->rwhGetDetailsPage(array('id'=>(int)$id,'show'=>21,'page'=>1)),
			'id'	=>$id,
		));
	}
	public function actionShowGoodsInSklad($id,$page){
		$whr = new RemoteWh();
		var_dump($whr->rwhGetDetailsPage(array('id'=>(int)$id,'show'=>21,'page'=>(int)$page)));
	}
	public function actionSaveInfoSklad(){
		$whr = new RemoteWh();
		$arr = array(
			'id'	=> HU::post('id'),
			'name'	=> iconv('utf-8','windows-1251',HU::post('name')),
			'sname'	=> iconv('utf-8','windows-1251',HU::post('sname')),
			'sort'	=> HU::post('sort'),
			'code'	=> HU::post('code'),
			'des'	=> iconv('utf-8','windows-1251',HU::post('des')),
		);
		var_dump($arr);
		$whr->rwhAddUpdateOne($arr);
	}
}