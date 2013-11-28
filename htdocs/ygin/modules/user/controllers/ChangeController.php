<?
class ChangeController extends Controller{
	private $Uchet;
	public function __construct($id,$module=null) {
		parent::__construct($id, $module);
		$this->Uchet = new Uchet();
	}
	private function getUchetInfo(){
		$model = Yii::app()->user->getUchetModel();
		
		$uchet = $this->Uchet;
		$cClientInfo = $uchet->get_cClientInfo($model['codeU']);
		$fClientInfo = $uchet->get_fClientInfo($model['codeU']);
		$model = array('cInfo'=>$cClientInfo,'fInfo'=>$fClientInfo,'login'=>$model['login']);
		return $model;
	}
	private function getDate($start,$end,$prov){
		$str = $start;// входящая дата
		$str2 = $prov;	//разрешённая дата
		
		$timestamp = strtotime($str);// $timestamp - уже дата
		$timestamp2 = strtotime($str2);// $timestamp - уже дата
		
		if ($timestamp2 > $timestamp){
			$start = $timestamp2;
			$start = date('d.m.Y', $start); 
		}
		$start = date('d.m.Y', strtotime($start));
		$end = date('d.m.Y', strtotime($end));
		return array('dates'=>$start,'datee'=>$end);
	}
	# Экшн показа списка взаиморасчетов
	public function actionStat($start,$end,$uid){
		$model = $this->getUchetInfo();
		$date = $this->getDate($start,$end,$model['fInfo']['start_date']);
		#echo $uid.' '.$start.' '.$end;
		$sheet_tmp = $this->Uchet->get_calculations($uid,$date['dates'],$date['datee']);
					if (count($sheet_tmp)>0){
						$sheet = $this->Uchet->get_user_invoice($sheet_tmp);
					}
				#var_dump($sheet_tmp);
			$nom1 = count($sheet);
			$pay = $this->Uchet->get_user_pay_invoice($sheet);
			$otgruz = $this->Uchet->get_user_ship_invoice($sheet);
			$vozvrat = $this->Uchet->get_user_retuns_invoice($sheet);
			if (!empty($sheet['0']['balance'])){$pit=$sheet['0']['balance'];}else{$pit=0;}
			$pb=$pit;
			$prom = $pit;
			$vb=0;
			$vpay=0;
			$votg=0;
			$total = 0;
			$total_o = 0;
			foreach ($sheet as $id=>$sh){
				$sheet["$id"]['nom'] = $nom1;
				if ($sh['code']=='Оплачено'){
					$pb = $pb+$sh['amount'];
					$prom = $prom + $sh['amount'];
					$vpay = $sh['amount']+$vpay;
					$sheet["$id"]['cost']=$pb;
					$total = $sh['amount']+(int)$total;
					$sheet["$id"]['it_pay'] = number_format($vpay,2,'.','');
					$sheet["$id"]['prom'] = number_format($prom,2,'.','');
				}elseif($sh['code']=='Получено'){
					$pb = $pb-$sh['amount'];
					$votg = $votg - $sh['amount'];
					//$sheet["$id"]['amount']=$pb;
					$prom = $prom - $sh['amount'];
					$total_o = $sh['amount']+(int)$total_o;
					$sheet["$id"]['it_otg'] = number_format($votg,2,'.','');
					$sheet["$id"]['prom'] = number_format($prom,2,'.','');
				}elseif($sh['code']=='Возврат'){
					$pb = $pb+$sh['amount'];
					$vb = $vb+$sh['amount'];
					$prom = $prom + $sh['amount'];
					//$sheet["$id"]['amount']=$pb;
					$total = $sh['amount']+(int)$total;
					$sheet["$id"]['it_vozv'] = number_format($vb,2,'.','');
					//$sheet["$id"]['it_pay'] = round($total,2);
					$sheet["$id"]['prom'] = number_format($prom,2,'.','');
				}
			}
			if (isset($pay)){
				$nom = count($pay);
				$total = 0;
				foreach ($pay as $id=>$sh){
					$pay["$id"]['nom_s'] = $nom;
					$total = $sh['amount']+(int)$total;
					$pay["$id"]['total'] = number_format($total,2,'.','');
				}
				foreach ($pay as $id=>$p){
					$bal = $p['total']+$p['balance'];
					$pay["$id"]['total'] = number_format($total,2,'.','');
					//$pay["$id"]['balance'] = number_format($bal,2,'.','');
				}
			}
			if (isset($otgruz)){
				$nom = count($otgruz);
				$total=0;
				foreach ($otgruz as $id=>$sh){
					$otgruz["$id"]['nom_s'] = $nom;
					$total = $sh['amount']+$total;
					$otgruz["$id"]['total'] = $total;
					$otgruz["$id"]['total'] = number_format($total,2,'.','');
				}
				foreach ($otgruz as $id=>$o){
					$otgruz["$id"]['total'] = number_format($total,2,'.','');
				}
			}
			if (isset($vozvrat)){
			$nom = count($otgruz);
			$total=0;
			foreach ($vozvrat as $id=>$sh){
				$vozvrat["$id"]['nom_s'] = $nom;
				$total = $sh['amount']+$total;
				$vozvrat["$id"]['total'] = $total;
				$vozvrat["$id"]['total'] = number_format($total,2,'.','');
			}
			}
			if (isset($pay) AND isset($otgruz) AND isset($vozvrat)){
				$result = array('type'=>'success', 'pay'=>$pay, 'otgruz'=>$otgruz, 'vozv'=>$vozvrat, 'full'=>$sheet);
			}elseif(isset($pay) AND !isset($otgruz) AND !isset($vozvrat)){
				$result = array('type'=>'pay', 'pay'=>$pay, 'otgruz'=>'none', 'vozv'=>'none','full'=>$sheet);
			}elseif(!isset($pay) AND isset($otgruz) AND !isset($vozvrat)){
				$result = array('type'=>'otgruz', 'pay'=>'none', 'otgruz'=>$otgruz, 'vozv'=>'none','full'=>$sheet);
			}elseif(isset($pay) AND isset($otgruz) AND !isset($vozvrat)){
				$result = array('type'=>'otgruz2', 'pay'=>$pay, 'otgruz'=>$otgruz, 'vozv'=>'none','full'=>$sheet);
			}else{
				$result = array('type'=>'none', 'pay'=>'none', 'otgruz'=>'none', 'vozv'=>'none', 'full'=>'none');
			}
			print json_encode($result);
	}
	# Экшн показа списка заказов
	public function actionOrders($start,$end,$uid){
		$model = $this->getUchetInfo();
		$date = $this->getDate($start,$end,$model['fInfo']['start_date']);
		
		$orders_tmp  = $this->Uchet->get_orders($uid,$date['dates'],$date['datee']);
				if (count($orders_tmp)>0){
					$orders = $this->Uchet->get_user_orders($orders_tmp);
					$orders_status = $this->Uchet->get_order_status($orders);
				}
			$orders_3 = array();
			$i=0;
			foreach ($orders as $id=>$or){
				$orders_3["$i"]['date'] = $or['date'];
				$orders_3["$i"]['id'] = $id;
				$orders_3["$i"]['total'] = $or['total'];//.' '.$or['children']['0']['cur'];
				$orders_3["$i"]['cheng'] = $or['children']['0']['date'];
				$orders_3["$i"]['status'] = $orders_status["$id"]['it_st'];
				$orders_3["$i"]['children'] = $or['children'];
				$i++;
			}
			$orders_4 = array();
			$i=0;
			foreach ($orders as $id => $or){
				foreach ($or['children'] as $ch){
					$orders_4["$i"]['id']  =	 $id;
					$ch['brand'] = str_replace(' - Амортизаторы', ' ',$ch['brand']);
					$ch['brand'] = str_replace('-', ' ',$ch['brand']);
					$orders_4["$i"]['brand']  =	 iconv('windows-1251','utf-8',$ch['brand']);
					$orders_4["$i"]['vendor'] =	 $ch['vendor'];
					$orders_4["$i"]['name']   =	 $ch['name'];
					$orders_4["$i"]['qty'] 	  =	 $ch['qty'];
					$orders_4["$i"]['price']  =	 $ch['price'];
					$orders_4["$i"]['amount']  =	 $ch['amount'];
					$orders_4["$i"]['status']  =	 $ch['status'];
					$i++;
				}
			}
			$result = array('type'=>$orders_4, 'sheet'=>$orders_3);
			print json_encode($result);
	}
	#Экшн показа списка возвратов
	public function actionRetuns($start,$end,$uid){
		$model = $this->getUchetInfo();
		$date = $this->getDate($start,$end,$model['fInfo']['start_date']);
		$retuns_tmp = $this->Uchet->get_returns($uid,$date['dates'],$date['datee']);;
			if (count($retuns_tmp)>0){
				$retuns = $this->Uchet->get_user_retuns($retuns_tmp);
				$result = array('type'=>'success', 'sheet'=>$retuns);
			}else{
				$result = array('type'=>'none', 'sheet'=>'none');
			}
			print json_encode($result);
	}
	#Экшн смены наценки и показа/скрытия своей цены
	public function actionClient(){
		if (isset($_GET['extra'])){
			$model = $this->getUchetInfo();
			$extra = number_format($_GET['extra'],2,'.',',');
			var_dump($this->Uchet->change_ExtraCharge($model['cInfo']['company_code'],$extra));
		}elseif(isset($_GET['show'])){
			$model = $this->getUchetInfo();
			if ($_GET['val'] == 'true'){
				$vis = 1;
			}else{ $vis = 0;}
			var_dump($this->Uchet->сhange_price_visibility($model['cInfo']['company_code'],$vis));
		}
	}
	
	public function actionSubscription($id){
		echo json_encode($this->Uchet->DeleteSuscription((int)$id));
	}
	/*
	if (isset($_GET['start']))
			$dates = $_GET['start'];
		if (isset($_GET['end']))
			$datee = $_GET['end'];
		if (isset($_GET['uid']))
			$uid = $_GET['uid'];
		
		$prov = $this->flientInfo['start_date'];
		
		$str = $dates;// входящая дата
		$str2 = $prov;	//разрешённая дата
		$timestamp = strtotime($str);// $timestamp - уже дата
		$timestamp2 = strtotime($str2);// $timestamp - уже дата
		if ($timestamp2 > $timestamp){
			$dates = $timestamp2;
			$dates = date('d.m.Y', $dates); 
		}
		
		if (isset($_GET['orders'])){
			
		}elseif (isset($_GET['stat'])){
			
		}elseif (isset($_GET['retuns'])){
			
		}elseif(isset($_GET['price'])){
			$chek = $_GET['check'];
			if ($chek == 'false'){
				$zh = 0;
				$new = $this->Uchet->сhange_price_visibility($uid , $zh);
			}elseif ($chek == 'true'){
				$zh = 1;
				$new = $this->Uchet->сhange_price_visibility($uid , $zh);
			}
			$this->redirect('/cabinet/profile');
		}
		/**/
}