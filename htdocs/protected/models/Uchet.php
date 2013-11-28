<?
Class Uchet {
	# Загрузить удаленный Склад
	public function rwhLoadGoods($sid,$lines){
		#$command = Yii::app()->dbUR->createCommand("EXECUTE [Rusimport].[dbo].[rwhLoadGoods] @gs_id=".(int)$id.", @goods='".$lines."'");
		#$command = Yii::app()->dbUR->createCommand("EXECUTE [Rusimport].[dbo].[rwhLoadGoods] @gs_id=:id, @goods=:goods");
		/** PHP PDO для работы с несколькими наборами данных из процедуры **/
		$conn = new PDO(Yii::app()->dbU->connectionString,Yii::app()->dbU->username,Yii::app()->dbU->password);
		$sql = "EXECUTE [Rusimport].[dbo].[rwhLoadGoods] @gs_id=:id, @goods=:goods";
		$command = $conn->prepare($sql);
			$command->bindParam(":id",	$sid,PDO::PARAM_INT);
			$command->bindParam(":goods",$lines,PDO::PARAM_STR);
			$command->execute();
			$command->fetch();
		#$res = $command->queryRow();
		return $command;
	}
}
?>