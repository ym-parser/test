<?
# Набор функций для работы с Удаленными складами
Class RemoteWh{
	# Получить список всех удалённых складов 
	public function rwhGetList(){
		$command = Yii::app()->dbU->createCommand("EXECUTE [RUSIMPORT].[dbo].[rwhGetList]");
		$res = $command->queryAll();
		return $res;
	}
	# Возвращает всю информацию по одному удалённому складу 
	public function rwhGetOne($sid){
		$command = Yii::app()->dbU->createCommand("EXECUTE [RUSIMPORT].[dbo].[rwhGetOne] @sklad_id=:sid");
		$command->bindParam(":sid",	$sid,PDO::PARAM_INT);
		$command->execute();
		$res = $command->queryRow();
		return $res;
	}
	# Записывает информацию по одному удалённому складу
	public function rwhAddUpdateOne($row){
		$command = Yii::app()->dbU->createCommand("EXECUTE [RUSIMPORT].[dbo].[rwhAddUpdateOne] @sklad_id=:id, @sklad_name= :name, @sklad_des=:desc, @sklad_sname=:sname, @sklad_code=:code, @sklad_delivery=NULL, @sklad_sort=:sort");
		$command->bindParam(":id",	$row['id'],PDO::PARAM_INT);
		$command->bindParam(":name",$row['name'],PDO::PARAM_STR);
		$command->bindParam(":desc",	$row['des'],PDO::PARAM_STR);
		$command->bindParam(":sname",$row['sname'],PDO::PARAM_STR);
		$command->bindParam(":code",$row['code'],PDO::PARAM_INT);
		$command->bindParam(":sort",$row['sort'],PDO::PARAM_INT);
		$command->execute();
		#$res = $command->queryRow();
		#return $res;
	}
	# Возвращает одну страницу из списка деталей по удалённому складу
	public function rwhGetDetailsPage ($row){
		$command = Yii::app()->dbU->createCommand("EXECUTE [RUSIMPORT].[dbo].[rwhGetDetailsPage] @sklad_id=:id, @show= :show, @page=:page");
		$command->bindParam(":id",	$row['id'],PDO::PARAM_INT);
		$command->bindParam(":show",$row['show'],PDO::PARAM_INT);
		$command->bindParam(":page",$row['page'],PDO::PARAM_INT);
		$command->execute();
		$res = $command->queryAll();
		return $res;
	}
	# Удаляет информацию по одному складу
	public function rwhDelete ($id){
		$command = Yii::app()->dbU->createCommand("EXECUTE [RUSIMPORT].[dbo].[rwhDelete] @sklad_id=:id");
		$command->bindParam(":id",	$id,PDO::PARAM_INT);
		$command->execute();
		$res = $command->queryRow();
		return $res;
	}
	# Загружает информацию о товарах по одному складу – dbo.rwhLoadGoods
	public function rwhLoadGoods ($id,$goods){
		$command = Yii::app()->dbU->createCommand("EXECUTE [RUSIMPORT].[dbo].[rwhLoadGoods] @gs_id=:id, @goods=:goods");
		$command->bindParam(":id",	$id,PDO::PARAM_INT);
		$command->bindParam(":goods",$goods,PDO::PARAM_STR);
		$command->execute();
		$res = $command->queryRow();
		return $res;
	}
	# 
	public function rwhGetAutoData($id){
		$res = Yii::app()->db->createCommand()
			->select('*')
			->from('rem_sklad_auto_data')
			->where('sid=:sid',array(':sid'=>$id))
			->queryRow();
		if (!empty($res)){
			return $res;
		}else{
			return array (
				'sid'		  => NULL,
				'use_date'	  => NULL,
				'format_date' => NULL,
				'monday_date' => NULL,
				'default_date'=> NULL,
				'from_lett'	  => NULL,
				'subj_lett'	  => NULL,
				'markup'	  => NULL,
				'col_brand'	  => NULL,
				'col_art'	  => NULL,
				'col_name'	  => NULL,
				'col_cnt'	  => NULL,
				'col_price'	  => NULL,
			);
		}
	}
}