<?
class DownloadController extends Controller{
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
  public function actionIndex($docid){
	#echo $docid;
	$shhet = $this->Uchet->get_document($docid);
	// Create new PHPExcel object
	$objPHPExcel = new PHPExcel();

	// Set document properties
	$objPHPExcel->getProperties()->setCreator("RUSIMPORT")
								 ->setLastModifiedBy("RUSIMPORT")
								 ->setTitle("Накладная покупателя")
								 ->setSubject("Накладная покупателя");

	// Add some data
	$active_sheet = $objPHPExcel->getActiveSheet();
	$active_sheet->getColumnDimension('A')->setAutoSize (true);
	$active_sheet->getColumnDimension('B')->setAutoSize (true);
	$active_sheet->getColumnDimension('C')->setAutoSize (true);
	$active_sheet->getColumnDimension('D')->setAutoSize (true);
	$active_sheet->getColumnDimension('E')->setAutoSize (true);
	$active_sheet->getColumnDimension('F')->setAutoSize (true);
	$active_sheet->getColumnDimension('G')->setAutoSize (true);
	$active_sheet->getColumnDimension('H')->setAutoSize (true);
	$active_sheet->getColumnDimension('I')->setAutoSize (true);
	$active_sheet->getColumnDimension('J')->setAutoSize (true);

	$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('A1', 'Код каталога')
				->setCellValue('B1', 'Товар (Наименование)')
				->setCellValue('C1', 'Цена')
				->setCellValue('D1', 'Заказанное кол-во')
				->setCellValue('E1', 'Единица измерения')
				->setCellValue('F1', 'Валюта')
				->setCellValue('G1', 'ГТД')
				->setCellValue('H1', 'Общая стоимость')
				->setCellValue('I1', 'Класс')
				->setCellValue('J1', 'Страна');
	$row_start = 2;
	$total = 0;
	$i=1;
	foreach($shhet as $item) {
		$row_next = $row_start + $i;
		
		$active_sheet->setCellValue('A'.$row_next,$item['linecode']);
		$active_sheet->setCellValue('B'.$row_next,$item['goods_name']);
		$active_sheet->setCellValue('C'.$row_next,number_format($item['price'],2,'.',','));
		$active_sheet->setCellValue('D'.$row_next,number_format($item['quantity'],2,'.',','));
		$active_sheet->setCellValue('E'.$row_next,$item['unit']);
		$active_sheet->setCellValue('F'.$row_next,$item['currency']);
		$active_sheet->setCellValue('G'.$row_next,$item['parcel']);
		$active_sheet->setCellValue('H'.$row_next,number_format($item['amount'],2,'.',','));
		$active_sheet->setCellValue('I'.$row_next,$item['class_name']);
		$active_sheet->setCellValue('J'.$row_next,$item['country']);
		$i++;
		$total = number_format($total+$item['amount'],2,'.',',');
	}
	$row_next = $row_start + $i;
	$active_sheet->setCellValue('G'.$row_next,'ИТОГО');
	$active_sheet->setCellValue('H'.$row_next,number_format($total,2,'.',','));
	//стили для данных в таблице прайс-листа
	$style_price = array(
		'alignment' => array(
			'horizontal' => PHPExcel_STYLE_ALIGNMENT::HORIZONTAL_LEFT,
		)

	);
	$active_sheet->getStyle('A2:J'.($i+2))->applyFromArray($style_price);
	// Rename worksheet
	$objPHPExcel->getActiveSheet()->setTitle('order');


	// Set active sheet index to the first sheet, so Excel opens this as the first sheet
	$objPHPExcel->setActiveSheetIndex(0);


	// Redirect output to a client’s web browser (Excel2007)
	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	header('Content-Disposition: attachment;filename="order.xlsx"');
	header('Cache-Control: max-age=0');

	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	$objWriter->save('php://output');
  }
}