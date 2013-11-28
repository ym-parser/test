<?
		define('GMAIL_EMAIL', 'price@rusimport.com'); 							# Ящик с прайсами
		define('GMAIL_PASSWORD', 'RIKPrice2013');								# Логин от ящика
		define('ATTACHMENTS_DIR', dirname(__FILE__) . '/prices/attachments');	# Папка с вложениями
class PriceCommand extends CConsoleCommand {
	private $sklad;
	public function __construct($id,$module=null) {
		parent::__construct($id, $module);
		$this->sklad = new SkladLoader;
	}
	##### Прайсы в Учет
	public function actionUchetAutospec() {
		$sklad = new SkladLoader;
		$uchet = new Uchet;
		echo 'Парсим прайс компании Autospec'."\n";
		$today = date('d.m.Y'); // Дата на день вызова
		$subj = 'Остатки Автоспейс на '.$today;
		$from = 'romanov@autospace.ru';
		#Поучаем информацию из письма
		$mail = $sklad->get_mail($from,$subj,1);
		#$mailsIds = $mailbox->searchMailBox('SUBJECT "Остатки Автоспейс на '.$today.'"');
			echo $mail['patch'].'<br/>'."\n";
			echo $mail['file_name'].'<br/>'."\n";
			exec('cd commands/prices/zip/; unzip '.$mail['patch']);
			$file_name = substr($mail['file_name'], 0, -3);
			$file_name .='txt';
			$patch_price = 'commands/prices/zip/'.$file_name;
			unlink($mail['patch']); # удаляем аттач
		# парсим прайс в массив 
			$file_array = file($patch_price); # Считывание файла в массив $file_array
			foreach ($file_array as &$row){
				$price[] = explode(';',$row);
			}
			$lines = $sklad->get_arr_uchet($price,'1.15',1,0,2,3,4,'win');
		unlink($patch_price);# Удаляем архив
		# Отправляем в класс на запись в базу
		#var_dump($lines);
		#$file="tof_brands.txt";
		#$fp = fopen($file, "w"); // ("r" - считывать "w" - создавать "a" - добовлять к тексту), мы создаем файл
		#$txt_z="EXECUTE [Rusimport].[dbo].[rwhLoadGoods] @gs_id=37 , @goods='".$lines."'";
		#fwrite($fp, $txt_z);
		$uchet->rwhLoadGoods(37,$lines);
	}
	public function actionUchetBerg(){
		$sklad = new SkladLoader;
		$uchet = new Uchet;
		echo 'Парсим прайс компании Berg'."\n";
		$subj = 'Наличие на складе БЕРГ';
		$from = 'auto@brg.ru';
		#Поучаем информацию из письма
		$mail = $sklad->get_mail($from,$subj,1);
		# Бренд - Арт - Имя - кол-во -цена - старт
		$price = $sklad->get_arr_xlsx($mail['patch'],'C','A','B','D','E',1);
		unlink($mail['patch']); # удаляем аттач
		unset($price['0']);
		$lines = $sklad->get_arr_uchet($price,'1.15','brand','art','name','cnt','price','utf');
		#var_dump($lines);
		$uchet->rwhLoadGoods(34,$lines);
	}
	public function actionUchetShatem(){
		$sklad = new SkladLoader;
		$uchet = new Uchet;
		echo 'Парсим прайс компании Шате-М'."\n";
		$subj = 'Склад Минск. Актуальное предложение ШАТЕ-М ПЛЮС (RUR)';
		#$from = 'prices_export@shate-m.com';
		$from = 'pbunaev@mail.ru';
		#Поучаем информацию из письма
		$mail = $sklad->get_mail($from,$subj,1);
		exec('cd commands/prices/zip/; unzip '.$mail['patch']);
			#$file_name = substr($mail['file_name'], 0, -3);
			$file_name ='export_Minsk_RUR_S10209.csv';
			$patch_price = 'commands/prices/zip/'.$file_name;
		unlink($mail['patch']); # удаляем аттач
		$file_array = file("$patch_price"); // Считывание файла в массив $file_array
			foreach ($file_array as $row){
				$price[] = explode(';',$row);
			}
			unset($price['0']);
		unlink($patch_price); # удаляем архив
		$lines = $sklad->get_arr_uchet($price,'1.12',0,1,2,3,6,'win');
		#var_dump($lines);
		$uchet->rwhLoadGoods(32,$lines);
	}
	public function actionUchetFortuna(){
		$sklad = new SkladLoader;
		$uchet = new Uchet;
		echo 'Парсим прайс компании Колесо Фортуны'."\n";
		$subj = 'Прайс-лист Колеса Фортуны для клиента К3627.0';
		#$from = 'prices_export@shate-m.com';
		$from = 'getdb@fwheel.com';
		#Поучаем информацию из письма
		$mail = $sklad->get_mail($from,$subj,1);
		exec('cd commands/prices/zip/; unzip '.$mail['patch']);
			$file_name = substr($mail['file_name'], 0, -3);
			$file_name .='txt';
			$patch_price = 'commands/prices/zip/'.$file_name;
		unlink($mail['patch']); # удаляем аттач
		$file_array = file("$patch_price"); // Считывание файла в массив $file_array
			foreach ($file_array as $row){
				$price[] = explode(';',$row);
			}
			unset($price['0']);
		unlink($patch_price); # удаляем архив
		$lines = $sklad->get_arr_uchet($price,'1.15',1,2,3,4,5,'win');
		#var_dump($lines);
		$uchet->rwhLoadGoods(4,$lines);
	}
	public function actionUchetBereit(){
		$sklad = new SkladLoader;
		$uchet = new Uchet;
		echo 'Парсим прайс компании Берейт Авто (Сотранс Трейд)'."\n";
		$today = date('d.m.Y'); // Дата на день вызова
		$subj = 'FW: Прайс-лист СОТРАНС ТРЕЙД (легковые) на '.$today;
		$from = 'o.chubarov@rusimport.com';
		#Поучаем информацию из письма
		$mail = $sklad->get_mail($from,$subj,1);
		exec('cd commands/prices/zip/; unzip '.$mail['patch']);
			$file_name ='Прайс-Лист?СОТРАНС?ТРЕЙД??легковые??Авто-Лайн.xls';
			$patch_price = 'commands/prices/zip/'.$file_name;
			exec('cd commands/prices/zip/; mv '.$file_name.' bereit.xls');
			$file_name ='bereit.xls';
			$patch_price = 'commands/prices/zip/'.$file_name;
		unlink($mail['patch']); # удаляем аттач
	
		$data = new Spreadsheet_Excel_Reader($patch_price);
		$price = $data->parse_xls(true,true);
		#$price = array_chunk($price, 10);
		foreach ($price as $i=>&$row){
			$tmp = explode ("\0",$row['7']);
			if (isset($tmp['0'])){
				$price["$i"]['7'] = str_replace(',','',$tmp['0']);
			}else{
				$price["$i"]['7'] = str_replace(',','',$row['7']);
			}
			$tmp = explode ("\0",$row['4']);
			if (isset($tmp['0'])){
				$price["$i"]['4'] = $tmp['0'];
			}
			#$price["$i"]['7'] = number_format($row['7'],2,'.'',);
		}
		unset($price['1']);
		unset($price['2']);
		unset($price['3']);
		unset($price['4']);
		#var_dump($price['18']);
		#var_dump($price['115']);
		unlink($patch_price); # удаляем архив
		# Бренд - Арт - Имя - кол-во -цена
		$lines = $sklad->get_arr_uchet($price,'1.15',3,4,2,8,7,'utf');
		#var_dump($lines);
		#$file="tof_brands.txt";
		#$fp = fopen($file, "w"); // ("r" - считывать "w" - создавать "a" - добовлять к тексту), мы создаем файл
		#$txt_z="EXECUTE [Rusimport].[dbo].[rwhLoadGoods] @gs_id=5 , @goods='".$lines."'";
		#fwrite($fp, $txt_z);
		$uchet->rwhLoadGoods(5,$lines);
	}
	public function actionUchetMechanika(){
		$sklad = new SkladLoader;
		$uchet = new Uchet;
		echo 'Парсим прайс компании Механика'."\n";
		#$today = date('d.m.Y'); // Дата на день вызова
		$subj = 'FW: MehanikaSPb. Daily Price';
		$from = 'o.chubarov@rusimport.com';
		#Поучаем информацию из письма
		$mail = $sklad->get_mail($from,$subj,2);
		exec('cd commands/prices/zip/; unzip '.$mail['patch']);
		unlink($mail['patch']); # удаляем аттач
			$file_name = substr($mail['file_name'], 0, -3);
			$file_name .='xls';
		$patch_price = 'commands/prices/zip/'.$file_name;
		
		$data = new Spreadsheet_Excel_Reader($patch_price);
		$price = $data->parse_xls(true,true);
		#$price = array_chunk($price, 6);
		unset($price['1']);
		unlink($patch_price); # удаляем архив
		# Бренд - Арт - Имя - кол-во -цена
		$lines = $sklad->get_arr_uchet($price,'1.08',1,4,2,5,6,'utf');
		#var_dump($lines);
		$uchet->rwhLoadGoods(54,$lines);
	}
	public function actionUchetAutoevro(){
		$sklad = new SkladLoader;
		$uchet = new Uchet;
		echo 'Парсим прайс компании АвтоЕвро'."\n";
		$subj = 'FW: Индивидуальный Прайс от www.autoeuro.ru';
		$from = 'o.chubarov@rusimport.com';
		#Поучаем информацию из письма
		$mail = $sklad->get_mail($from,$subj,1);
		exec('cd commands/prices/zip/; unrar e '.$mail['patch']);
		unlink($mail['patch']); # удаляем аттач
		$dir = 'commands/prices/zip/';
		$f = scandir($dir);
		foreach ($f as $file){
			if(preg_match('/\.(xls)/', $file)){
				$files[] =$file;
			}
		}
		$patch_price = $dir.$files['0'];
		unlink($dir.$files['1']);
		$data = new Spreadsheet_Excel_Reader($patch_price);
		$price = $data->parse_xls(true,true);
		unlink($patch_price);
		#$price = array_chunk($price, 13);
		unset($price['1']);
		unset($price['2']);
		unset($price['3']);
		unset($price['4']);
		# Бренд - Арт - Имя - кол-во -цена
		$lines = $sklad->get_arr_uchet($price,'1.15',1,4,6,9,7,'utf');
		#var_dump($lines);
		$uchet->rwhLoadGoods(38,$lines);
	}
	public function actionUchetAutoliga(){
		$sklad = new SkladLoader;
		$uchet = new Uchet;
		echo 'Парсим прайс компании АвтоЛига'."\n";
		#$today = date('d.m');
		#$subj = 'Прайс лист '.$today;
		#$from = 'MNikiforova@autoliga.com';

		$from = 'ikudryavcev@autoliga.com';
		$subj = ' прайс автолига';
		# Поучаем информацию из письма
		$mail = $sklad->get_mail($from,$subj,1);
		# Парсим xls
		$data = new Spreadsheet_Excel_Reader($mail['patch']);
		$price = $data->parse_xls(true,true);
		unlink($mail['patch']); # удаляем аттач
		for ($i=0; $i<=32; $i++){
			unset($price[$i]);
		}
		#$price = array_chunk($price, 6);
		# Бренд - Арт - Имя - кол-во -цена
		$lines = $sklad->get_arr_uchet($price,'1.15',2,3,1,5,6,'utf');
		#var_dump($lines);
		$uchet->rwhLoadGoods(33,$lines);
	}
	public function actionUchetForumauto(){
		$sklad = new SkladLoader;
		$uchet = new Uchet;
		echo 'Парсим прайс компании Форум Авто'."\n";
		$from = 'o.chubarov@rusimport.com';
		$today = date('d-m');
		$subj = 'Отправка: FORUM-AUTO_PRICE_(o.chubarov1)_'.$today;
		# Поучаем информацию из письма
		$mail = $sklad->get_mail($from,$subj,1);
		exec('cd commands/prices/zip/; unzip '.$mail['patch']);
		unlink($mail['patch']); # удаляем аттач
		$dir = 'commands/prices/zip/';
		$f = scandir($dir);
		foreach ($f as $file){
			if(preg_match('/\.(csv)/', $file)){
				$files[] =$file;
			}
		}
		$patch_price = $dir.$files['0'];
		$file_array = file("$patch_price"); // Считывание файла в массив $file_array
		unlink($patch_price); # удаляем файл
		foreach ($file_array as $row){
			$price[] = explode(';',$row);
		}
		unset($price['0']);
		unset($price['1']);
		# Бренд - Арт - Имя - кол-во -цена
		$lines = $sklad->get_arr_uchet($price,'1.15',0,1,2,4,6,'win');
		#var_dump($lines);
		$uchet->rwhLoadGoods(48,$lines);
	}
	public function actionUchetOurum(){
		$sklad = new SkladLoader;
		$uchet = new Uchet;
		echo 'Парсим прайс компании Ourum Merca'."\n";
		$from = 'o.chubarov@rusimport.com';
		$today = date('Y-m-d');
		$subj = 'ORUM MERCA';
		# Поучаем информацию из письма
		$mail = $sklad->get_mail($from,$subj,1);
		$file_array = file($mail['patch']); // Считывание файла в массив $file_array
		unlink($mail['patch']); # удаляем аттач
		foreach ($file_array as $row){
			$price[] = explode(';',$row);
		}
		unset($price['0']);
		unset($price['1']);
		unset($price['2']);
		unset($price['3']);
		unset($price['4']);
		unset($price['5']);
		# Бренд - Арт - Имя - кол-во -цена
		$lines = $sklad->get_arr_uchet($price,'1.15',2,1,3,5,6,'win');
		#var_dump($lines);
		$uchet->rwhLoadGoods(43,$lines);
	}
	public function actionUchetAutokont($kurs){
		$sklad = new SkladLoader;
		$uchet = new Uchet;
		echo 'Парсим прайс компании Автоконтинент'."\n";
		$from = 'o.chubarov@rusimport.com';
		$d = getdate(strtotime('yesterday'));
		if ($d['weekday'] == 'Sunday'){
			$last = date('d.m.y', strtotime('-2 day'));
			#$last = date('d.m.y', strtotime('-3 day'));
		}else{
			$last = date('d.m.y', strtotime('yesterday'));
		}
		$subj = 'FW: Автоконтинент '.$last;
		# Поучаем информацию из письма
		$mail = $sklad->get_mail($from,$subj,1);
		exec('cd commands/prices/zip/; unzip '.$mail['patch']);
		unlink($mail['patch']); # удаляем аттач
		$dir = 'commands/prices/zip/';
		$f = scandir($dir);
		foreach ($f as $file){
			if(preg_match('/\.(txt)/', $file)){
				$files[] =$file;
			}
		}
		$patch_price = $dir.$files['0'];
		$file_array = file("$patch_price"); // Считывание файла в массив $file_array
		unlink($patch_price); # удаляем файл
		$i =0;
		foreach ($file_array as $row){
			$price[$i] = explode(';',$row);
			$price[$i]['5'] = $price[$i]['5']*$kurs;
			$i++;
		}
		unset($price['0']);
		# Бренд - Арт - Имя - кол-во -цена
		$lines = $sklad->get_arr_uchet($price,'1.15',0,1,2,3,5,'win');
		#var_dump($lines);
		$uchet->rwhLoadGoods(2,$lines);
	}
	public function actionUchetImpakt(){
		$sklad = new SkladLoader;
		$uchet = new Uchet;
		echo 'Парсим прайс компании Импакт'."\n";
		$from = 'o.chubarov@rusimport.com';
		$subj = 'FW: Наличие ООО ИМПАКТ.';
		$mail = $sklad->get_mail($from,$subj,1);
		exec('cd commands/prices/zip/; unzip '.$mail['patch']);
		unlink($mail['patch']); # удаляем аттач
		$dir = 'commands/prices/zip/';
		$f = scandir($dir);
		foreach ($f as $file){
			if(preg_match('/\.(xls)/', $file)){
				$files[] =$file;
			}
		}
		$patch_price = $dir.$files['0'];
		$data = new Spreadsheet_Excel_Reader($patch_price);
		$price = $data->parse_xls(true,true);
		unlink($patch_price); # удаляем файл 57
		unset($price['1']);
		unset($price['2']);
		# Бренд - Арт - Имя - кол-во -цена
		$lines = $sklad->get_arr_uchet($price,'1.15',1,3,4,6,5,'utf');
		#var_dump($lines);
		$uchet->rwhLoadGoods(57,$lines);
	}
	public function actionAutoLoad($sid){
		echo "Смотрим склад с ИД: {$sid}\r\n";
		$today = date('d.m.Y'); // Дата на день вызова
		$subj = 'Остатки Автоспейс на '.$today;
		$from = 'romanov@autospace.ru';
		$mail_data = $this->sklad->loadData($sid);
		$subj = $this->sklad->getSubj($mail_data);
		#Поучаем информацию из письма
		$mail = $this->sklad->get_mail($mail_data['from_lett'],$subj,1);
		var_dump($mail);
		$price = $this->sklad->parse_attach($mail_data,$mail);
		# Бренд - Арт - Имя - кол-во -цена
		$lines = $sklad->get_arr_uchetAuto($price,$mail_data['markup'],$mail_data['col_brand'],$mail_data['col_art'],$mail_data['col_name'],$mail_data['col_cnt'],$mail_data['col_price']);
		/* Отладка что бы найти null поле*
		$lines = '';
		#var_dump($price);
		if(is_array($price)){
		foreach ($price as $id=>&$shet){
			$lines .= "[ID] = {$id} [VAL] = ".gettype($shet)." \n";
				if(is_array($shet)){
					foreach ($shet as $id2=>&$shet2){
						$lines .= "[ID2] = {$id2} [VAL2] = ".gettype($shet2)." \n";
						if(is_array($shet2)){
							foreach ($shet2 as $id3=>&$shet3){
								$lines .= "[ID3] = {$id3} [VAL3] = ".gettype($shet3)." \n";
							}
						}
					}
				}
		}
		}
		$file="tables.txt";
		$fp = fopen($file, "w"); // ("r" - считывать "w" - создавать "a" - добовлять к тексту), мы создаем файл
		fwrite($fp, $lines);
		/**/
		#var_dump($price['1']);
		
	}
}
