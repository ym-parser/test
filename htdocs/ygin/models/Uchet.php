<?
Class Uchet {
	#Процедура, авторазмещения заказа в учёте
	public function get_order_processing($title,$lin){
		$command = Yii::app()->dbU->createCommand("EXECUTE OrderProcessing @title='".$title."', @lines='".$lin."'");
		$res = $command->queryRow();
		return $res;
	}
	#Процедура, возвращающая данные по взаиморасчетам – GetCalculations
	public function get_calculations($code,$start,$end){
		$command = Yii::app()->dbU->createCommand("EXECUTE GetCalculations @Client=".$code." , @StartDate='".$start."', @EndDate='".$end."'");
		$res = $command->queryAll();
		return $res;
	}
	#Приводим массив от get_calculations к виду используемому ранее
	public function get_user_invoice($arr){
		if (is_array($arr)){
		$sheet = array();
		$i=0;
		foreach ($arr as $row){
			 if (!empty($row['OperDate'])) {
				$sheet[$i]['date'] = $row['OperDate'];
				$sheet[$i]['time'] = substr($row['OperTime'], 0, 8);
				if ((int)$row['OperCode'] == 1){
					$row['OperCode'] = 'Получено';
				} else if ((int)$row['OperCode'] == 2) {
					$row['OperCode'] = 'Оплачено';
				} else if ((int)$row['OperCode'] == 3) {
					$row['OperCode'] = 'Возврат';
				}
				$sheet[$i]['code'] = $row['OperCode'];
				$sheet[$i]['amount'] = $row['OperSumm'];
				$sheet[$i]['docid'] = $row['DocCode'];
				$sheet[$i]['nomnak'] = $row['DocNumber'];
				$sheet[$i]['payment'] = $row['PaymentType'];
				$sheet[$i]['balance'] = $balance;
				++$i;
			 }else{
				$balance = $row['OperSumm'];
			 }
		 }
		 return $sheet;
		}else{
			return false;
		}
	}
	#Функция для получения оплаченных накладных по заказам клиента
	public function get_user_pay_invoice ($arr){
		if (is_array($arr)){
		foreach ($arr as $row){
			if ($row['code'] == 'Оплачено'){
				$pay[] = $row;
			}
		}
		if (isset($pay)){
			$nom = count($pay);
			$total = 0;
			foreach ($pay as $id=>$sh){
				$pay["$id"]['nom_s'] = $nom;
				$total = $sh['amount']+(int)$total;
			}
			foreach ($pay as $id=>$p){
				$pay["$id"]['total'] = $total;
			}
			return $pay;
		}
		}else{
			return false;
		}
	}
	#Функция для получения отгруженных накладных по заказам клиента
	public function get_user_ship_invoice ($arr){
		if (is_array($arr)){
		foreach ($arr as $row){
			if($row['code'] == 'Получено'){
				$otgruz[] = $row;
			}
		}
		if (isset($otgruz)){
			$nom = count($otgruz);
			$total = 0;
			foreach ($otgruz as $id=>$sh){
				$otgruz["$id"]['nom_s'] = $nom;
				$total = $sh['amount']+$total;
				$otgruz["$id"]['total'] = $total;
			}
			foreach ($otgruz as $id=>$o){
				$otgruz["$id"]['total'] = $total;
			}
			return $otgruz;
		}
		}else{
			return false;
			}
	}
	#Функция для получения возврата накладных по заказам клиента
	public function get_user_retuns_invoice ($arr){
		if (is_array($arr)){
		foreach ($arr as $row){
			if($row['code'] == 'Возврат'){
				$vozvrat[] = $row;
			}
		}
		if (isset($vozvrat)){
			$nom = count($vozvrat);
			$total = 0;
			foreach ($vozvrat as $id=>$sh){
				$vozvrat["$id"]['nom_s'] = $nom;
				$total = $sh['amount']+$total;
				$vozvrat["$id"]['total'] = $total;
			}
			foreach ($vozvrat as $id=>$o){
				$vozvrat["$id"]['total'] = $total;
			}
			return $vozvrat;
		}
		}else{
			return false;
		}
	}
	#Процедура, возвращающая  данные по заказам клиента – GetOrders
	public function get_orders($code,$start,$end){
		$command = Yii::app()->dbU->createCommand("EXECUTE GetOrders @Client=".$code." , @StartDate='".$start."', @EndDate='".$end."'");
		$res = $command->queryAll();
		return $res;
	}
	#приводим массив от get_orders к виду используемому ранее
	public function get_user_orders($arr){
		$orders=array();
		$i=0;
		foreach ($arr as $row){
			$row['cdate'] = substr($row['cdate'], 0, 11); #смотрим первые 10 символов
			$row['cdate'] = date_create($row['cdate']);
			$row['cdate'] = date_format($row['cdate'], 'd.m.Y');
			$orders["$i"]['date'] = $row['cdate'];
			$orders["$i"]['orderId'] = $row['order_id'];
			$orders["$i"]['brand'] = $row['producer'];
			$orders["$i"]['vendor'] = $row['linecode'];
			$orders["$i"]['name'] = $row['name'];
			$orders["$i"]['qty'] = number_format($row['quantity'],0,'.','');
			$orders["$i"]['price'] = number_format($row['price'],2,'.','');
			$orders["$i"]['amount'] = number_format($row['amount'],2,'.','');
			$orders["$i"]['cur'] = $row['currency'];
			if ($row['order_state'] == '1'){
				$row['9'] = 'Принят';
			}else if ($row['order_state'] == '2') {
				$row['9'] = 'Комплектуется';
			}else if ($row['order_state'] == '3') {
				$row['9'] = 'Готов к отгрузке';
			}else if ($row['order_state'] == '4') {
				$row['9'] = 'Отгружен';
			}else if ($row['order_state'] == '666') {
				$row['9'] = 'Возврат';
			}
			$orders["$i"]['status'] = $row['9'];
			++$i;
		}
		$orders_2 = array();
		$i =0;
		foreach ($orders as $id=>$or){
			if ($i == '0'){
				$orders_2["{$or['orderId']}"]['date'] = $or['date'];
				$orders_2["{$or['orderId']}"]['total'] = '';
				$orders_2["{$or['orderId']}"]['children'][]  = $or;
				$i++;
			} else {
				$n=$i-1;
				if (isset($orders_2["{$or['orderId']}"])){
					#if($orders_2["{$or['orderId']}"]['children']["$n"]['vendor'] != $or['vendor']){
						$orders_2["{$or['orderId']}"]['children'][]  = $or;
						$i++;
					#} else {
						#$orders_2["{$or['orderId']}"]['children']["$n"]  = $or;
						#$i++;
					#}
				} else {
					$i = 0;
					$orders_2["{$or['orderId']}"]['date'] = $or['date'];
					$orders_2["{$or['orderId']}"]['total'] = '';
					$orders_2["{$or['orderId']}"]['children'][]  = $or;
					$i++;
				}
			}
		}
		foreach ($orders_2 as $id=>$or){
			foreach ($or['children'] as $idc=>$ch){
				$n = $idc-1;
				if ($or['children']["{$n}"]['vendor'] != $ch['vendor']){
					$orders_2["$id"]['total'] = $orders_2["$id"]['total']+$ch['amount'];
				}
			}
		}
		return $orders_2;
	}
	private function search_stat ($arr,$str){
		foreach ($arr as $row){
		$key_1 = $row;
		$exit = preg_match("~$key_1~i",$str);
		if ($exit != 0) {
			$exit = $row;
			break;
		}
		}
		return $exit;
	}
	#статусы заказов
	public function get_order_status ($arr){
		foreach ($arr as $id=>$or){
			$i=0;
			foreach ($or['children'] as $idc=>$ch){
				if ($i==0){
					$arr["$id"]['total'] = $arr["$id"]['total']+$ch['amount'];
					$i++;
				}else{
					$n = $idc-1;
					if (isset($or['children']["{$n}"])){
						if ($or['children']["{$n}"]['vendor'] != $ch['vendor']){
							$arr["$id"]['total'] = $arr["$id"]['total']+$ch['amount'];
						}
					}
				}
				$orders_status["$id"]['tot_stat']["{$ch['vendor']}"] = $ch['status'];
			}
		}
		foreach ($orders_status as $id=>$orders){
			foreach ($orders as $ido=>$row){
				$status = $this->search_stat($row,'Принят');
					if ($status == '0'){
						$status = $this->search_stat($row,'Комплектуется');
						if ($status == '0'){
							$status = $this->search_stat($row,'Готов к отгрузке');
								if ($status == '0'){
									$status = $this->search_stat($row,'Отгружен');
									if ($status == '0'){
										$status = $this->search_stat($row,'Отказ');
										$orders_status["$id"]['it_st'] = $status;
									}else{
										$orders_status["$id"]['it_st'] = $status;
									}
								}else{
									$orders_status["$id"]['it_st'] = $status;
								}
						}else{
							$orders_status["$id"]['it_st'] = $status;
						}
					}else{
						$orders_status["$id"]['it_st'] = $status;
					}
			}
		}
		return $orders_status;
	}
	#Процедура, возвращающая  данные по возвратам клиента – GetReturns
	public function get_returns($code,$start,$end){
		$command = Yii::app()->dbU->createCommand("EXECUTE GetReturns @Client=".$code." , @StartDate='".$start."', @EndDate='".$end."'");
		$res = $command->queryAll();
		return $res;
	}
	#приводим массив get_retuns к имеющему прошлый вид
	public function get_user_retuns($arr){
		if(is_array($arr)){
		$orders = array();
		$i =0;
		foreach ($arr as $row){
			 #if ($row['0'] != '') {
			 $row['cdate'] = substr($row['cdate'], 0, 11); #смотрим первые 10 символов
			 $row['cdate'] = date_create($row['cdate']);
			 $row['cdate'] = date_format($row['cdate'], 'd.m.Y');
			 $orders["$i"]['date'] = $row['cdate'];
			 $orders["$i"]['brand'] = $row['producer'];
			 $orders["$i"]['vendor'] = $row['linecode'];
			 $orders["$i"]['name'] = $row['name'];
			 $orders["$i"]['qty'] = number_format($row['quantity'],0,'.','');
			$orders["$i"]['price'] = number_format($row['price'],2,'.','');
			$orders["$i"]['amount'] = number_format($row['amount'],2,'.','');
			 $orders["$i"]['cur'] = $row['currency'];
			 ++$i;
		} 
		return $orders;
		}else{
			return false;
		}
	}
	#Процедура, возвращающая информацию о пользователе для отображения в ЛК. – ClientManagement.cClientInfo
	public function get_cClientInfo($code){
		$command = Yii::app()->dbU->createCommand("EXECUTE ClientManagement.cClientInfo @Client=".$code);
		$res = $command->queryAll();
		return $res[0];
	}
	#Процедура, возвращающая финансовую информацию о клиенте – ClientManagement.fClientInfo
	public function get_fClientInfo($code){
		$command = Yii::app()->dbU->createCommand("EXECUTE ClientManagement.fClientInfo @Client= ".$code);
		$res = $command->queryAll();
		return $res[0];
	}
	#Процедура, возвращающая накладную – ClientManagement.GetDocument
	public function get_document($code){
		$command = Yii::app()->dbU->createCommand("EXECUTE ClientManagement.GetDocument @doc_code=".$code);
		$res = $command->queryAll();
		return $res;
	}
	#Процедура, возвращающая цены для клиента по списку товаров  – ClientManagement.GetClientPrices
	public function get_client_prices($code,$list){
		$command = Yii::app()->dbU->createCommand("EXECUTE ClientManagement.GetClientPrices @company_code=".$code.", @goods_list='".$list."'");
		$res = $command->queryAll();
		return $res;
	}
	#Функция, возвращающая цену для клиента по одному товару  – ClientManagement.GetOneClientPrice
	static function get_one_client_price($company_code,$good_code){
		$command = Yii::app()->dbU->createCommand("SELECT ClientManagement.GetOneClientPrice(".$company_code.",".$good_code.")");
		$res = $command->queryRow();
		return $res[''];
	}
	#Функция, Авторизации  – ClientManagement.ClientAuthorization
	public function client_authorization($login,$pass){
		$command = Yii::app()->dbU->createCommand("SELECT ClientManagement.ClientAuthorization('".$login."','".$pass."')");
		$res = $command->queryRow();
		return $res[''];
	}
	#Процедура, изменяющая пароль пользователя  – ClientManagement.SetClientPassword
	public function set_client_password($code,$mail,$pass){
		$command = Yii::app()->dbU->createCommand("EXECUTE ClientManagement.SetClientPassword @code=".$code.", @email='".$mail."', @password='".$pass."'");
		$res = $command->queryAll();
		return $res;
	}
	#Функция, возвращающая курс Евро  – ClientManagement.GetRikEuro()
	public function get_rik_euro(){
		$command = Yii::app()->dbU->createCommand("SELECT ClientManagement.GetRikEuro()");
		$res = $command->queryRow();
		return $res['0'];
	}
	#Процедура, возвращающая скидки по  брендам – ClientManagement.GetClientDiscounts
	public function get_client_discounts($code){
		$command = Yii::app()->dbU->createCommand("EXECUTE ClientManagement.GetClientDiscounts @company_code=".$code);
		$res = $command->queryAll();
		return $res;
	}
	#Процедура, изменяющая клиентскую наценку – ClientManagement.ChangeExtraCharge
	public function change_ExtraCharge($code,$new_charge){
		$command = Yii::app()->dbU->createCommand("EXECUTE ClientManagement.ChangeExtraCharge @client=".$code.", @new_charge='".$new_charge."'");
		$res = $command->queryRow();
		return $res;
	}
	#Процедура, изменяющая пароль клиента – ClientManagement.ChangePassword
	public function change_password($mail,$old,$new){
		$command = Yii::app()->dbU->createCommand("EXECUTE ClientManagement.ChangePassword @email='".$mail."', @old_psw='".$old."', @new_psw='".$new."'");
		$res = $command->queryRow();
		return $res;
	}
	#Процедура для получения списка аналогов (Альт+7 в учёте)
	static function select_analogues($code){
		$code = (int)$code;
		$command = Yii::app()->dbU->createCommand("EXECUTE SelectAnalogues @code=".$code);
		try {
			$res = $command->queryAll();
			if (!$res){
				throw new Exception("Не найдены аналоги по альт+7:");
			}else{
				return $res;
			}
		} catch (Exception $e) {
					$res = null;
					return $res;
				}
	}
	#Процедура для показа/скрытия клиентской цены
	public function сhange_price_visibility($code,$new){
		$command = Yii::app()->dbU->createCommand("EXECUTE ClientManagement.ChangePriceVisibility @client = ".$code." , @new_visibility = ".$new);
		$res = $command->queryAll();
		return $res;
	}
	#Функция для получения информации о кол-ве товара в Рика
	static function get_item_rest ($code,$id){
		$RIK_sklad = Yii::app()->dbU->createCommand()
				->select("Sum(ostatq.quantity) as quantity")
				->from("nomencl,ostatq")
				->where("nomencl.code = {$code} AND nomencl.code = ostatq.tovar AND ostatq.account = '41' AND (ostatq.company = '{$id}' OR ostatq.company = '443')")
				->queryRow();
		if(!empty($RIK_sklad)){
			$sklad = $RIK_sklad;
				$q = '-';
			if($sklad) {
				if($sklad['quantity'] > 4){
					$q = '>4';
				}elseif($sklad['quantity'] == 0){
					$q='';
				}else{
					$q = number_format($sklad['quantity'],0,'.','');
				}
			}
		}else{
			$q= '-';
		}
		return $q;
	}
	#Процедура Добавление подписки на новости
	public function AddSubscription($company_code, $nomencl_code, $news_type, $how_show){
		# $news_type 1 – поступление на основной склад; 2 – появление в предварительном приходе (?); 3 – изменение цены…
		# $how_show 1 – эл. почта;  2 – показ в личном кабинете; 3 - SMS

		$command = Yii::app()->dbU->createCommand("EXECUTE ClientManagement.AddSubscription @company_code = ".$company_code." , @nomencl_code = ".$nomencl_code.", @news_type = ".$news_type." , @how_show =".$how_show);
		$res = $command->queryAll();
		return $res;
	}
	#Процедура Получение данных обо всех подписках клиента 
	public function GetClientSubscription($company_code){
		$command = Yii::app()->dbU->createCommand("EXECUTE ClientManagement.GetClientSubscription @company_code = ".$company_code);
		$res = $command->queryAll();
		return $res;
	}
	#Процедура Удаление подписки
	public function DeleteSuscription($id){
		$command = Yii::app()->dbU->createCommand("EXECUTE ClientManagement.DeleteSuscription @id = ".$id);
		$res = $command->execute();
		return 1;
	}
	#Процедура Получение новостей, на которые клиент подписался
	public function GetClientNews($company_code){
		$command = Yii::app()->dbU->createCommand("EXECUTE ClientManagement.GetClientNews @company_code = ".$company_code);
		$res = $command->queryAll();
		return $res;
	}
	#Получить информацию о детали по её коду
	public function GetItemInfo($code){
		$sql = "SELECT  n.code, n.name, n.linecode, b.name as brand
				FROM dbo.nomencl as n
				LEFT JOIN dbo.Brand as b ON b.code = n.complect
				WHERE n.code = {$code}";
		$res = Yii::app()->dbU->createCommand($sql)
			->queryRow();
		return $res;
	}
	# Получить поисковую выдачу на складе Рика и Удаленных
	public function GetGoodsList($art,$bid){
		#$res = Yii::app()->dbU->createCommand("exec [Rusimport].[dbo].[GetGoodsList] '".$art."', ".(int)$bid)
			#->execute();
		#return $res;
		return 1;
	}
	
}
?>