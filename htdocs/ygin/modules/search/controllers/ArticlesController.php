<?php

class ArticlesController extends Controller {
  
  #protected $urlAlias = 'articles';
	private function order($array, $by) {
		$result = array();
		foreach ($array as $val) {
			if (!is_array($val) || !key_exists($by, $val)) {
				continue;
			}
			end($result);
			$current = current($result);
			while ($current[$by] > $val[$by]) {
				$result[key($result)+1] = $current;
				prev($result);
				$current = current($result);
			}
			$result[key($result)+1] = $val;
		}
		return $result;
	}
	public function actionIndex(){
	$model = Yii::app()->user->getUchetModel();
	if ($model['codeU'] == 0){$code =null;}else{$code=$model['codeU'];}
	$model['sid'] = Yii::app()->session->sessionId;
	$uchet = new Uchet;
	$tq = HU::get('TQ');
	$brand = HU::get('BRAND');
	$bid = HU::get('bra_id');
	$art = preg_replace("/[^A-z0-9]/is", "", $tq);
	$det = $uchet->GetGoodsList($art,(int)$bid,$code,$model['sid']);
	#echo '<pre>';
	#var_dump($det);
	#echo '</pre>';
	$rem =[];
	foreach ($det as $id=>&$all){
		foreach ($all as $id2=>&$row){
			if (count($row)>0){
				foreach ($row as $id3=>&$val){
					$det[$id][$id2][$id3] = iconv('windows-1251','utf-8',$val);
				}
			}
		}
	}
	
	foreach ($det['Remote'] as &$remz){
		foreach ($det['sklads'] as $id=>&$sklad){
		#if (isset($remz['gs_sid'] AND isset($sklad['sklad_id'])))}
			if ($remz['gs_sid'] == $sklad['sklad_id']){
				#$rem["{$sklad['sklad_name']}"]['des'] = $sklad['sklad_des'];
				$rem["{$sklad['sklad_name']}_{$sklad['sklad_id']}"]['items'][] = $remz;
				#$rem["{$sklad['sklad_name']}"]['sort'] = $id;
			}
		#}
		}
	}
	#$rem = $this->order($rem,'sort');
	#echo '<pre>';
	#echo 'данные склада';
	#var_dump($det['sklads']);
	#echo 'данные деталей со склада';
	#var_dump($det['Remote']);
	#echo 'данные склад с товарами';
	#var_dump($rem);
	#echo '</pre>';
	#$rik = $this->order($det['rik'],'brand');
	$rik = $det['rik'];
    $this->render('/articles', array(
	  #'details' => $det,
	  'RIK' =>$rik,
	  'wh' => $det['sklads'],
	  'REM' =>$rem,
	  'tq' => $tq,
	  'bid'=>(int)$bid,
	  'model'=>$model,
    ));
  }
}