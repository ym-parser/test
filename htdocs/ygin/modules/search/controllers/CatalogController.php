<?php

class CatalogController extends Controller {
  
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
	public function actionIndex($mfaId = null, $modId= null){
		$model = Yii::app()->user->getUchetModel();
		if ($model['codeU'] == 0){$code =null;}else{$code=$model['codeU'];}
		$model['mfaId'] = $mfaId;#HU::get('mfaId');
		$model['modId'] = $modId;#HU::get('modId');
		if(empty($model['mfaId'])){$model['mfaId']=0;};
		if(empty($model['modId'])){$model['modId']=0;};
		$this->render('/catalog', array(
		  'model'=>$model,
		));
	}
	public function actionMainJson(){
		$this->layout=false;
		$mfaId = HU::get('mfaId');
		$modId = HU::get('modId');
		#echo $mfaId;
		$url = "http://laf24.ru/Catalog/Main.json/".$mfaId."/".$modId;
		$search = array('<html>','<head></head>','<body>','</body>','</html>','</pre>','<pre style="word-wrap: break-word; white-space: pre-wrap;">');
		$json = file_get_contents($url);
		$json = str_replace($search,'',$json);
		echo $json;
	}
	public function actionTreeJson(){
		$this->layout=false;
		$typId = HU::get('typId');
		$node = HU::get('node');
		#echo $mfaId;
		$url = "http://laf24.ru/Catalog/Tree.json/".$typId."/".$node."?all=1";
		$search = array('<html>','<head></head>','<body>','</body>','</html>','</pre>','<pre style="word-wrap: break-word; white-space: pre-wrap;">');
		$json = file_get_contents($url);
		$json = str_replace($search,'',$json);
		$arr = json_decode($json);
		#echo '<pre>';
		#var_dump($arr->goods);
		if (!empty($arr->goods)){
		foreach ($arr->goods as &$items){
			foreach ($items as &$it){
				#echo $it->art_id ."<br/>";
				$brands[] = $it->art_sup_id;
				$arts[] = preg_replace("/[^A-z0-9]/is", "", $it->art_article_nr);
			}
		}
		$uchet = new Uchet();
		$RIK = $uchet->ChekGoodInRik($arts,$brands);
		foreach ($RIK as $id=>&$tmp){
			if(is_array($tmp)){
				foreach($tmp as $id2=>$row){
					$RIK[$id][$id2] = iconv('windows-1251','utf-8',$row);
				}
				$RIK[$id]['qty'] = number_format($tmp['qty'],1,'.','');
				if ($RIK[$id]['qty']>4){
					$RIK[$id]['qty'] = '>4';
				}elseif($RIK[$id]['qty']==0){
					$RIK[$id]['qty'] = 'нет в наличии';
				}
				$RIK[$id]['price'] = number_format($tmp['price'],2,'.','');
			}
		}
		$arr->RIK = $RIK;
		}
		#$arts = array('08447510','08473824','VKBA1355','03141');
		#$brands = array(65,65,50,101);
		
		#echo '<pre>';
		#var_dump($RIK);
		#echo '</pre>';
		echo json_encode($arr);
	}
	public function actionTree($typId = null, $node= null){
		$model = Yii::app()->user->getUchetModel();
		if ($model['codeU'] == 0){$code =null;}else{$code=$model['codeU'];}
		$model['typId'] = $typId;#HU::get('mfaId');
		$model['node'] = $node;#HU::get('modId');
		if(empty($model['typId'])){$model['typId']=0;};
		if(empty($model['node'])){$model['node']=0;};
		$this->render('/tree', array(
		  'model'=>$model,
		));
	}
	public function actionTest(){
		echo 'test';
		$uchet = new Uchet();
		$arts = array('08447510','08473824','VKBA1355','03141');
		$brands = array(65,65,50,101);
		
		echo '<pre>';
		var_dump($arts);
		var_dump($brands);
		var_dump($uchet->ChekGoodInRik($arts,$brands));
		echo '</pre>';
	}
}