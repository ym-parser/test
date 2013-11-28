<?php

class CartController extends Controller {
	private $uchet;
	private $codeU;
	public function __construct($id,$module=null) {
		parent::__construct($id, $module);
		$model = Yii::app()->user->getUchetModel();
		$this->codeU = $model['codeU'];
		$this->uchet = new Uchet();
    }
	private function GetItemInfo($data){
		foreach ($data as $id=>&$row){
					if(!empty($row['goods_code'])){
						$art = $this->uchet->GetItemInfo((int)$row['goods_code']);
						$data[$id]['brand'] = $art['brand'];
						$data[$id]['linecode'] = $art['linecode'];
						$data[$id]['name'] = $art['name'];
					}
					$data[$id]['name'] = iconv('windows-1251','utf-8',$data[$id]['name']);
				}
		return $data;
	}
	public function actionIndex(){
		$model = Yii::app()->user->getUchetModel();
		if ($model['codeU'] == 0){
			# Получаем содержимое корзины от неавторизованного пользователя
			$data = $this->uchet->GetClientBasket_na(Yii::app()->session->sessionID);
			if(is_array($data)){
				$data = $this->GetItemInfo($data);
			}
		}else{
			#Получаем содержимое корзины авторизованного пользователя
			$data = $this->uchet->GetClientBasket($model['codeU']);
			if(is_array($data)){
				$data = $this->GetItemInfo($data);
			}
		}
		#echo '<pre>';
		#var_dump($data);
		#echo '</pre>';
		$this->render('/cart', array(
			'model'=>$model,
			'data'=>$data
		));
	}
	public function actionAddBasket(){
		$codeU = strlen(HU::get('codeU'));
		$data = array(
			'codeU'		=> HU::get('codeU'),
			'warehouse' => (int)HU::get('wh'),
			'is_basic'	=> (int)HU::get('ib'),
			'quantity'	=> HU::get('qnt'),
			'name'	=> iconv('utf-8','windows-1251',HU::get('name')),
			'price'	=> HU::get('price'),
			'goods_code'=> (int)HU::get('codeG'),
			'brands'	=> HU::get('bra'),
			'linecode'	=> HU::get('art'),
		);
		if ($codeU<10){
			$cart = $this->uchet->AddIntoBasket($data);
		}else{
			$cart = $this->uchet->AddIntoBasket_na($data);
		}
		$cart['0']['msg'] =  iconv('windows-1251','utf-8',$cart['0']['msg']);
		echo json_encode($cart);
	}
	public function actionDeleteBasket(){
		$id = (int)HU::get('id');
		if ($this->codeU!=0){
			echo json_encode($this->uchet->DeleteFromBasket($id));
		}else{
			echo json_encode($this->uchet->DeleteFromBasket_na($id));
		}
	}
	public function actionChangeBasket(){
		$id = (int)HU::get('id');
		$cnt = (int)HU::get('val');
		if ($this->codeU!=0){
			echo json_encode($this->uchet->ChangeQuantityInBasket($id,$cnt));
		}else{
			echo json_encode($this->uchet->ChangeQuantityInBasket_na($id,$cnt));
		}
	}
	public function actionClearBasket(){
		$id = (int)HU::get('id');
		if ($this->codeU!=0){
			echo json_encode($this->uchet->ClearClientBasket($id));
		}else{
			echo json_encode($this->uchet->ClearClientBasket_na($id));
		}
	}
}