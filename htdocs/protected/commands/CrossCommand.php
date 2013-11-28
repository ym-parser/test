<?
class CrossCommand extends CConsoleCommand {

	private $Patch;
	
	public function __construct($id,$module=null) {
            parent::__construct($id, $module);
			$this->Patch = 'commands/cross/';
    }
	public function actionFormat ($name){
		
		$patch = $this->Patch.$name;
		$data = new Spreadsheet_Excel_Reader($patch);
		$price = $data->parse_xls(true,true);
		var_dump ($price['1']);
		var_dump ($price['2']);
		var_dump ($price['3']);
	}
}
