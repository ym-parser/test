<?
Class Uchet {
	# Загрузить удаленный Склад
	public function rwhLoadGoods($sid,$lines){
		$command = Yii::app()->dbUR->createCommand("EXECUTE [Rusimport].[dbo].[rwhLoadGoods] @gs_id=".$sid.", @goods='".$lines."'")
			->execute();
		#$res = $command->queryRow();
		
		#return $res;
	}
}
?>