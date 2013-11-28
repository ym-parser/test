<?php
Class SkladLoader{
	protected $dir = '/var/www/rusimport/data/www/rusimport.majordomo.ru/htdocs/protected/commands/prices/zip/';
	protected $decode;
	public function __construct(){
		$this->decode = new Decode();
	}
	# Входные параметры массив прайса,ид склада, процент наценки
	# Сохраняем склад в базу
	public function save_db($price,$sid,$num){
		$i =0;
		$end = count ($price);
		if ($num == 1){
			Yii::app()->db->createCommand()->delete('goods_sklad', 'gs_sid=:gs_sid', array(':gs_sid'=>$sid));
		}
		foreach ($price as $id=>&$p){
			flush();
			$values[] = '(:gs_sid'.$i.', :gs_brand'.$i.', :gs_art'.$i.', :gs_name'.$i.', :gs_search'.$i.', :gs_cnt'.$i.', :gs_price'.$i.')';
			$tmp[]=$p;
			unset($price["$id"]);
			if ($i == 30000){
				$command = Yii::app()->db->createCommand("INSERT INTO `goods_sklad` (
                                 `gs_sid`,
                                 `gs_brand`,
                                 `gs_art`,
								 `gs_name`,
								 `gs_search`,
								 `gs_cnt`,
								 `gs_price`
                              ) VALUES ".implode(', ', $values));
				$i=0;
				foreach ($tmp as &$v){
					echo $v['brand'].' '.$v['art'].' '.$v['search'].' '.$v['name'].' '.$v['cnt'].' '.$v['price'].'<br/>'."\n";
					$command->bindParam(':gs_sid'.$i, $sid, PDO::PARAM_INT);
					$command->bindParam(':gs_brand'.$i, $v['brand'], PDO::PARAM_STR);
					$command->bindParam(':gs_art'.$i, $v['art'], PDO::PARAM_STR);
					$command->bindParam(':gs_name'.$i, $v['name'], PDO::PARAM_STR);
					$command->bindParam(':gs_search'.$i, $v['search'], PDO::PARAM_STR);
					$command->bindParam(':gs_cnt'.$i, $v['cnt'], PDO::PARAM_STR);
					$command->bindParam(':gs_price'.$i, $v['price'], PDO::PARAM_STR);
					++$i;
				}
				$command->execute();
				$i=0;
				$values = array();
				$tmp = array();
			}else{
				++$i;
			}
		}
		if ($i>0){
			$i =0;
			$command = Yii::app()->db->createCommand("INSERT INTO `goods_sklad` (
                                 `gs_sid`,
                                 `gs_brand`,
                                 `gs_art`,
								 `gs_name`,
								 `gs_search`,
								 `gs_cnt`,
								 `gs_price`
                              ) VALUES ".implode(', ', $values));
			foreach ($tmp as &$v){
				echo $v['brand'].' '.$v['art'].' '.$v['search'].' '.$v['name'].' '.$v['cnt'].' '.$v['price'].'<br/>'."\n";
				
				$command->bindParam(':gs_sid'.$i, $sid, PDO::PARAM_INT);
				$command->bindParam(':gs_brand'.$i, $v['brand'], PDO::PARAM_STR);
				$command->bindParam(':gs_art'.$i, $v['art'], PDO::PARAM_STR);
				$command->bindParam(':gs_name'.$i, $v['name'], PDO::PARAM_STR);
				$command->bindParam(':gs_search'.$i, $v['search'], PDO::PARAM_STR);
				$command->bindParam(':gs_cnt'.$i, $v['cnt'], PDO::PARAM_STR);
				$command->bindParam(':gs_price'.$i, $v['price'], PDO::PARAM_STR);
				++$i;
			}
			$command->execute();
		}
		return $end;
	}
	# форматирование массива (получаем массив, наценку, и колонки с брендом,артикулом,именем,кол-вом,ценой)
	public function get_arr_txt($price,$per,$col_b,$col_a,$col_n,$col_c,$col_p,$char){
		$srch = array("'",'"',);
		foreach ($price as $id=>$skl){
			if (isset($skl["$col_b"]) and isset($skl["$col_a"]) and isset($skl["$col_n"]) and isset($skl["$col_c"]) and isset($skl["$col_p"])){
				if ($char == 'win'){
					$skl["$col_b"] = iconv('windows-1251','utf-8',$skl["$col_b"]);//1
					$skl["$col_a"] = iconv('windows-1251','utf-8',$skl["$col_a"]);//0
					$skl["$col_n"] = iconv('windows-1251','utf-8',$skl["$col_n"]);//2
					$skl["$col_p"] = iconv('windows-1251','utf-8',$skl["$col_p"]);//4
				}
				#echo $id."\n";
				#var_dump($price[$id]);
				unset($price["$id"]);
				$price["$id"]['brand']	= trim(str_replace($srch,'',$skl["$col_b"]));//1
				$price["$id"]['art']	= str_replace($srch,'',$skl["$col_a"]);//0
				$price["$id"]['name']	= str_replace($srch,'',$skl["$col_n"]);//2
				$price["$id"]['cnt']	= str_replace($srch,'',$skl["$col_c"]);//3
				$price["$id"]['price']	= str_replace($srch,'',$skl["$col_p"]);//4
				$xprice		= str_replace(',','.',$price["$id"]['price']);
				$cost =  $per*$xprice;
				$cost =  round($cost,4);
				$cost =  round($cost,3);
				$cost =  round($cost,2);
				$xprice		= $cost;
				$price["$id"]['price'] =$xprice;
				$price["$id"]['search'] = preg_replace('/[^0-9a-z]+/i','',$skl["$col_a"]);
			}else{
				unset($price["$id"]);
			}
		}
		return $price;
	}
	# Подготовить строку для отправки в учёт
	public function get_arr_uchet($price,$per,$col_b,$col_a,$col_n,$col_c,$col_p,$char){
		$srch = array('\\','\'',"'",'"',"\n","\t","\0");
		$lines ='';
		foreach ($price as $id=>$skl){
			if (isset($skl["$col_b"]) and isset($skl["$col_a"]) and isset($skl["$col_n"]) and isset($skl["$col_c"]) and isset($skl["$col_p"])){
				if ($char == 'win'){
					$skl["$col_b"] = iconv('windows-1251','utf-8',$skl["$col_b"]);//1
					$skl["$col_a"] = iconv('windows-1251','utf-8',$skl["$col_a"]);//0
					$skl["$col_n"] = iconv('windows-1251','utf-8',$skl["$col_n"]);//2
					$skl["$col_p"] = iconv('windows-1251','utf-8',$skl["$col_p"]);//4
				}
				#echo $id."\n";
				#var_dump($price[$id]);
				unset($price["$id"]);
				$lines	.= trim(str_replace($srch,"",$skl["$col_b"]))."\t";//1	   # Бренд
				$lines	.= str_replace($srch,"",$skl["$col_a"])."\t";//0			   # Артикул
				$lines	.= str_replace($srch,"",$skl["$col_n"])."\t";//2			   # Наименование
				$lines	.= preg_replace('/[^0-9a-z]+/i','',$skl["$col_a"])."\t";	   # Очищенный артикул
				$lines	.= str_replace($srch,'',$skl["$col_c"])."\t";# Кол-во
				$price["$id"]['price']	= str_replace($srch,'',$skl["$col_p"]);//4
				$xprice		= str_replace(',','.',$price["$id"]['price']);
				$cost =  $per*$xprice;
				$cost =  round($cost,4);
				$cost =  round($cost,3);
				$cost =  round($cost,2);
				$xprice		= number_format($cost,2,'.','');
				$lines .=$xprice."\t\n";							   # Цена
			}else{
				unset($price["$id"]);
			}
		}
		#echo $lines;
		return iconv('utf-8','windows-1251//TRANSLIT',$lines);
		#return $lines;
	}
	# Получить вложения от указанного адресата с темой
	public function get_mail($from,$subj,$m){
		$mailbox = new ImapMailbox('{imap.gmail.com:993/imap/ssl}INBOX', GMAIL_EMAIL, GMAIL_PASSWORD, ATTACHMENTS_DIR, 'utf-8');
		$mails = array();

		# Получаем письма с указанной темой
		$mailsIds = $mailbox->searchMailBox('FROM "'.$from.'" SUBJECT "'.$subj.'"');
		if(!$mailsIds) {
			die('Mailbox is empty');
		}
		$num = count ($mailsIds);
		$end = $num-$m;
		$mailId = reset($mailsIds);
		$price_arr = array();
		$mail = $mailbox->getMail($mailsIds[$end]);
		# Получаем вложения 
			$attah = $mail->getAttachments();
			foreach ($attah as $k=>$a){
				$patch[] = $a->filePath;
				$file_name[] = $a->name;
				$att_id[] = $a->id;
			}
			$dat_let = $mail->date;
		$id_let = $mail->id;
		$from_let = $mail->fromAddress;
		$subj_let = $mail->subject;
			return array(
							'patch'		=> $patch,
							'file_name'	=> $file_name,
							'dat_let'	=> $mail->date,
							'id_let'	=> $mail->id,
							'from_let'	=> $mail->fromAddress,
							'subj_let'	=> $mail->subject,
							'att_id'	=> $att_id
						);
	}
	# Парсим xlsx файл
	public function get_arr_xlsx($patch,$col_b,$col_a,$col_n,$col_c,$col_p,$i){
		$file=file_get_contents('zip://'.$patch.'#xl/sharedStrings.xml');
		$xml=(array)simplexml_load_string($file);
		$sst=array();
		
		foreach ($xml['si'] as $item=>&$val)$sst[]=(string)$val->t;
		$file=file_get_contents('zip://'.$patch.'#xl/worksheets/sheet1.xml');

		$xml=simplexml_load_string($file);
		$price=array();
		#$i = 1;
		foreach ($xml->sheetData->row as $row){
			$currow=array();
			foreach ($row->c as $c){
				$value=(string)$c->v;
				$attrs=$c->attributes();
				switch ($attrs['r']) {
					case $col_b.$i:
					if ($attrs['t']=='s'){
						$currow['brand']=$sst[$value];
					}else{
						$currow['brand']=$value;
					}
					break;
					case $col_a.$i:
					if ($attrs['t']=='s'){
						$currow['art']=$sst[$value];
					}else{
						$currow['art']=$value;
					}
					break;
					case $col_n.$i:
					if ($attrs['t']=='s'){
						$currow['name']=$sst[$value];
					}else{
						$currow['name']=$value;
					}
					break;
					case $col_c.$i:
					if ($attrs['t']=='s'){
						$currow['cnt']=$sst[$value];
					}else{
						$currow['cnt']=$value;
					}
					break;
					case $col_p.$i:
					if ($attrs['t']=='s'){
						$currow['price']=$sst[$value];
					}else{
						$currow['price']=$value;
					}
					break;
				}
			}
			$i++;
			$price[]=$currow;
		}
		return $price;
	}
	# Получить данные для письма по sklad_id из базы
	public function loadData($sid){
		$result = Yii::app()->dbM->createCommand()
			->select("*")
			->from("rem_sklad_auto_data")
			->where("sid = :sid",array(":sid"=>$sid))
			->queryRow();
		return $result;
	}
	# Сгенерировать тему письма
	public function getSubj($row){
		if (empty($row["use_date"])){
			$subj = $row["subj_lett"];
		}else{
			$subj = $row["subj_lett"];
			if (empty($row["default_date"])){
				$date = date($row["format_date"]);
			}else{
				$d = getdate(strtotime('yesterday'));
				if ($d['weekday'] == 'Sunday'){
					$date = date($row["format_date"], strtotime('-2 day'));
				}else{
					$date = date($row["format_date"], strtotime('yesterday'));
				}
			}
			$subj = $subj." ".$date;
		}
		return $subj;
	}
	# Получаем расширение файла
	private function getExt($arr){
		$types = array();
		foreach ($arr as $id=>&$file){
			$tmp = explode('.',$file);
			$types[$id] = $tmp[count($tmp)-1];
		}
		return $types;
	}
	# Определяем что делать с вложениями
	private function whatAttach($exts,$mail,$data){
		$price = array();
		foreach ($exts as $id=>&$type){
			switch ($type){
				case 'zip':
					$price = $this->parseZip($mail['file_name'][$id],$mail['patch'][$id],$data);
					unlink($mail['patch'][$id]);
					break;
				case 'rar':
					$price = $this->parseRar($mail['file_name'][$id],$mail['patch'][$id],$data);
					unlink($mail['patch'][$id]);
					break;
				case 'txt':
					$price = $this->parseTxt($mail['file_name'][$id],$mail['patch'][$id],$data);
					unlink($mail['patch'][$id]);
					break;
				case 'csv':
					$price = $this->parseTxt($mail['file_name'][$id],$mail['patch'][$id],$data);
					unlink($mail['patch'][$id]);
					break;
				case 'xls':
					$price = $this->parseXls($mail['file_name'][$id],$mail['patch'][$id],$data);
					unlink($mail['patch'][$id]);
					break;
				case 'xlsx':
					$price = $this->parseXlsx($mail['file_name'][$id],$mail['patch'][$id],$data);
					unlink($mail['patch'][$id]);
					break;
				default:
					echo "type: ".$type."\r\n";
						unlink($mail['patch'][$id]);
			}
		}
		return $price;
	}
	# Парсим Zip
	private function parseZip($name,$patch,$data){
		if(!is_dir($this->dir .$data['sid'])) mkdir($this->dir .$data['sid']); 
		exec('cd '.$this->dir .$data['sid'].'; unzip '.$patch);
		$f = scandir($this->dir .$data['sid']);
		$i=0;
		foreach ($f as $file){
			$patch = '/var/www/rusimport/data/www/rusimport.majordomo.ru/htdocs/protected/commands/prices/zip/'.$data['sid'].'/'.$file;
			if ($file != '.' AND $file != '..') {
				$mail['file_name'][$i] = $file;
				$mail['patch'][$i] = $patch;
				++$i;
			}
		}
		#var_dump($mail);
		$exts = $this->getExt($mail['file_name']);
		$price = $this->whatAttach($exts,$mail,$data);
		return $price;
	}
	# Парсим Rar
	private function parseRar($name,$patch,$data){
		if(!is_dir($this->dir .$data['sid'])) mkdir($this->dir .$data['sid']); 
		exec('cd '.$this->dir .$data['sid'].'; unrar e '.$patch);
		$f = scandir($this->dir .$data['sid']);
		$i=0;
		foreach ($f as $file){
			$patch = '/var/www/rusimport/data/www/rusimport.majordomo.ru/htdocs/protected/commands/prices/zip/'.$data['sid'].'/'.$file;
			if ($file != '.' AND $file != '..') {
				$mail['file_name'][$i] = $file;
				$mail['patch'][$i] = $patch;
				++$i;
			}
		}
		$exts = $this->getExt($mail['file_name']);
		$price = $this->whatAttach($exts,$mail,$data);
		return $price;
	}
	private function utf8($s){
		$s=urlencode($s); // в некоторых случаях - лишняя операция (закоментируйте)
		$res='0';
		$j=strlen($s);
		$s2=strtoupper($s);
		$s2=str_replace("%D0",'',$s2);
		$s2=str_replace("%D1",'',$s2);
		$k=strlen($s2);
		$m=1;
		if ($k>0){
			$m=$j/$k;
			if (($m>1.2)&&($m<2.2)){ $res='1'; }
		}
		return $res;
	}
	# Парсим текст и CSV
	private function parseTxt($name,$patch,$data){
		$file_array = file($patch); # Считывание файла в массив $file_array
		$price = array();
		$n=1;
			foreach ($file_array as &$row){
				$tmp[] = explode(';',$row);
			}
			foreach ($tmp as $id=>&$row){
				$i=$n;
				foreach ($row as &$val){
					$val = $this->decode->charset_x_utf($val);
					#$p = $this->utf8($val);
					#if ($p=='0'){
					#	$val = iconv('windows-1251','utf-8',$val);
					#}
					$price[$id][$i]=$val;
					++$i;
				}
			}
			#var_dump($price);
		return $price;
	}
	# Прасим вложения
	public function parse_attach($data,$mail){
		$exts = $this->getExt($mail['file_name']);
		$price = $this->whatAttach($exts,$mail,$data);
		return $price;
	}
	# готовим линии/строки для загрузки файла в учёт
	# Подготовить строку для отправки в учёт
	public function get_arr_uchetAuto($price,$per,$col_b,$col_a,$col_n,$col_c,$col_p){
		$srch = array('\\','\'',"'",'"',"\n","\t","\0");
		$lines ='';
		$ary = 'auto';
		foreach ($price as $id=>$skl){
			if (isset($skl["$col_b"]) and isset($skl["$col_a"]) and isset($skl["$col_n"]) and isset($skl["$col_c"]) and isset($skl["$col_p"])){
				#echo $id."\n";
				#var_dump($price[$id]);
				unset($price["$id"]);
				$lines	.= trim(str_replace($srch,"",$skl["$col_b"]))."\t";//1	   # Бренд
				$lines	.= str_replace($srch,"",$skl["$col_a"])."\t";//0			   # Артикул
				$lines	.= str_replace($srch,"",$skl["$col_n"])."\t";//2			   # Наименование
				$lines	.= preg_replace('/[^0-9a-z]+/i','',$skl["$col_a"])."\t";	   # Очищенный артикул
				$lines	.= str_replace($srch,'',$skl["$col_c"])."\t";# Кол-во
				$price["$id"]['price']	= str_replace($srch,'',$skl["$col_p"]);//4
				$xprice		= str_replace(',','.',$price["$id"]['price']);
				$cost =  $per*$xprice;
				$cost =  round($cost,4);
				$cost =  round($cost,3);
				$cost =  round($cost,2);
				$xprice		= number_format($cost,2,'.','');
				$lines .=$xprice."\t\n";							   # Цена
			}else{
				unset($price["$id"]);
			}
		}
		#var_dump($lines);
		return iconv('utf-8','windows-1251//TRANSLIT',$lines);
		#return $lines;
	}
}