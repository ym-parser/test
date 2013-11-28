<?php
class AddController extends Controller {
	private $uchet;
	public function __construct($id,$module=null) {
		parent::__construct($id, $module);
		$this->uchet = new Uchet();
	}
	public function actionSubscription(){
		$codeU = HU::get('codeU');
		$codeG = HU::get('codeG');
		$type = HU::get('type');
		$show = HU::get('show');
		$res = $this->uchet->AddSubscription($codeU, $codeG, $type, $show);
		$res['0']['message'] = iconv('windows-1251','UTF-8',$res['0']['message']);
		echo json_encode($res);
	}
}