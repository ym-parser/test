<?php

error_reporting(E_ALL);

require_once('../../../oops/start.inc');
require_once('../../adm/search/searcher.inc');

$NAVLINE['search-test'] = 'Поиск-тест';
$NAVLINE['search-test/articles'] = ''.htmlentities($BRAND).' -> '.htmlentities($TQ);

$BODY = new OOPSBuffer();

$BODY->Send('<div style="margin: 15px; float:right">');

if($xTrash->C()) {
	$BODY->Send('<a href="../cart/">в корзине '.$xTrash->C().OOPSSpell($xTrash->C(),' товар',array('','а','ов')).'</a>');
} else {
	$BODY->Send('в корзине нет товаров');
}
$BODY->Send('</div>');


$BODY->Send('<div style="margin: 15px;">');

$BODY->Send('<form action="/search-test/" method=GET>');
$BODY->Send('<div style="display:inline-block;*display: inline;*zoom: 1;vertical-align:bottom" >');
$BODY->Send('<input type=text value="'.htmlspecialchars($TQ).'" name=TQ style="width: 300px; font: bold 18px Arial; border: 1px solid red; padding: 3px 3px 3px 3px; margin-right: 5px;">');
$BODY->Send('<input type=submit value="Найти" style="padding: 5px;">');
$BODY->Send('</div>');

$ban_1 = $OOPSGlobal["SES"]->db->QueryObjects("SELECT * FROM baners WHERE baner_status=1 ORDER BY baner_id ASC");
$SC = count($ban_1);
for($i=0;$i<$SC;$i++) {
	$baner = $ban_1[$i];
	$file = $baner->file_name;
	$type = substr($file, -3);
		if ($type == 'swf'){
			$BODY->Send('<div style="display:inline-block;*display: inline;*zoom: 1;vertical-align:bottom;margin-left:55px" >
				<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="150" height="120" id="1_ready" align="middle">
				<param name="allowScriptAccess" value="sameDomain" />
				<param name="wmode" value="transparent">
				<param name="wmode" value="opaque">
				<param name="movie" value="/img/'.$file.'" /><param name="quality" value="high" /><param name="bgcolor" value="#ffffff" /><embed src="/img/'.$file.'" wmode="transparent" quality="high" bgcolor="#ffffff" width="150" height="120" name="1_ready" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
				</object></div>
			');	
		} else {
			$BODY->Send('<div style="display:inline-block;*display: inline;*zoom: 1;vertical-align:bottom;margin-left:35px"><img src="/img/'.$file.'" alt="'.$baner->baner_name.'" /></div>');
		}
	}
	

$BODY->Send('</form>');
$BODY->Send('<br>ВНИМАНИЕ!!!<br>У разных производителей одному коду могут соответствовать совершенно разные детали, даже в одной товарной группе!<br>
Поиск аналогов по коду может давать неправильные варианты! Обязательно проверяйте применяемость по каталогу!<br>');

$BODY->Send('<img src="/img/complain.png" alt="Пожаловаться" title="Пожаловаться"/>Если вы не довольны результатами выдачи, вы можете пожаловаться, заполнив <a href="#" title="Пожаловаться">форму</a>');
$SEARCHER = new Searcher($OOPSGlobal["SES"]->db);
$ARTS = $SEARCHER->SearchArticles($TQ,$BRAND);
/*echo '<pre>';
var_dump($ARTS);
echo '</pre>';*/

if($DEBUG) {
	print('<pre>');
	print_r($ARTS);
}


$SKLADS = $SEARCHER->getSklads();

function getSkidka($USR,$ART) {

	$skidka = 0.0;

	if($USR->k1 > 0)
		$skidka = $USR->k1/100;

	$W = $ART[0];
	if($W > 4000) $W = 4;

	$brand = $ART[1];

	switch($W) {
		case 2:
		case 3:
			if(isset($USR->x_skidka2brand[$brand])) {
				$skidka = $USR->x_skidka2brand[$brand];
			}
			break;
		case 4:
			if(isset($USR->x_skidka2sklad[$ART[0]])) {
				$skidka = $USR->x_skidka2sklad[$ART[0]];
			} else {
				$skidka = 0.0;
			}
			break;
	}

	return $skidka;

}

function drawLine($ART,$ALERT='') {

	global $BODY;
	global $OOPSGlobal;
	global $xTrash;

	static $num = 0;

	$USR = $OOPSGlobal['SES']->uid;
	$k1 = $USR->k1 / 100;
	$k2 = $USR->k2 / 100;
	$curs = $USR->curs/100;

		$B1 = '';
		$B2 = '';
		$bg0 = 'border-bottom: 1px solid #eee;';
		$bg1 = 'background-color: #eeeeee; border-bottom: 1px solid #ccc; border-left: 1px solid #ccc; border-right: 1px solid #ccc;';
		$bg2 = 'background-color: #eeeeee; border-bottom: 1px solid #ccc; border-right: 1px solid #ccc;';

		if($ART[0] == 2) {
			$B1 = '<strong>';
			$B2 = '</strong>';
			//$BODY->Send("<tr bgcolor=#ffdddd valign=top>");
			$BODY->Send("<tr bgcolor='white' valign=top style=\"{$bg0}\">");
		} elseif($ART[0] == 3) {
			$B1 = '<b>';
			$B2 = '</b>';
			//$BODY->Send("<tr bgcolor=#ddffdd valign=top>");
			$BODY->Send("<tr bgcolor='white' valign=top style=\"{$bg0}\">");
		} elseif($ART[0] > 4000) {
			$B1 = '<b>';
			$B2 = '</b>';
			//$BODY->Send("<tr bgcolor=#ddddff valign=top>");
			$BODY->Send("<tr bgcolor='white' valign=top style=\"{$bg0}\">");
		} else {
			$BODY->Send("<tr bgcolor='white' valign=top style=\"{$bg0}\">");
			$bg1 = $bg2 = '';
		}

		$ART[1] = strtoupper($ART[1]);
		//склад
		//$BODY->Send("<td class='prtd' align=left nowrap>");
		//$BODY->Send($B1.getSklad($ART[0]).'/'.$ART[0].$B2);
		//$BODY->Send("</td>");
		// бренд
		$BODY->Send("<td class='prtd' align=left nowrap>");
		$BODY->Send($B1.$ART[1].$B2);
		$BODY->Send("</td>");
		// артикул
		$BODY->Send("<td class='prtd' align=left nowrap>");
		$BODY->Send("<a href='/search-test/?TQ=".$ART[2]."'>".$B1.$ART[2].$B2."</a>");
		$BODY->Send("</td>");
		// название
		$BODY->Send("<td class='prtd' align=left>");
		$BODY->Send("<a href='/item/?art=".$ART[2]."&brand=".$ART[1]."'>".$B1.$ART[3].$B2."</a>");
		$BODY->Send("</td>");
		//склад
		$BODY->Send("<td class='prtd' align=center nowrap style=\"{$bg1}\">");
		$BODY->Send($B1.$ART[4].$B2);
		$BODY->Send("</td>");
		// поступление
		$BODY->Send("<td class='prtd' align=center style=\"{$bg2}\">");
		$BODY->Send($B1.$ART[6].$B2);
		$BODY->Send("</td>");

		$skidka = getSkidka($USR,$ART);
		$nacenka= $k2 * 1.0;
		$source = $ART[5];

		$BODY->Send("<td class='prtd' align=right nowrap>");
		if($ART[0] != 1)
			$source_source = number_format($source,2,'.','').'&nbsp;&euro;';
		else
			$source_source = '';
		$BODY->Send($B1.$source_source.$B2);
		$BODY->Send("</td>");

		if($ART[0] != 1)
			$skidka_source = number_format($skidka,2,'.','').'%';
		else
			$skidka_source = '';
		//$BODY->Send("<td class='prtd' align=right nowrap>");
		//$BODY->Send($B1.$skidka_source.$B2);
		//$BODY->Send("</td>");

		if($ART[0] != 1)
			$source_nacenka = number_format($nacenka,2,'.','').'%';
		else
			$source_nacenka = '';
		//$BODY->Send("<td class='prtd' align=right nowrap>");
		//$BODY->Send($B1.$source_nacenka.$B2);
		//$BODY->Send("</td>");

		if($ART[0] != 1) {
			$price = $source - $source * $skidka/100;
			$price = $price + $price * $nacenka/100;
			$source_price = number_format($price,2,'.','').'&nbsp;&euro;';
		} else {
			$price = 0;
			$source_price = '';
		}
		$BODY->Send("<td class='prtd' align=right nowrap>");
		$BODY->Send($B1.$source_price.$B2);
		$BODY->Send("</td>");

		if($ART[0] != 1) {
			if($curs > 0) {
				$client = $price * $curs;
				$source_client = number_format($client,2,'.','').'&nbsp;руб.';
			} else {
				$client = $price * 1;
				$source_client = number_format($client,2,'.','').'&nbsp;&euro;';
			}
		} else
			$source_client = '';
		$BODY->Send("<td class='prtd' align=right nowrap>");
		$BODY->Send($B1.$source_client.$B2);
		$BODY->Send("</td>");

		$BODY->Send("<td class='prtd' align=right nowrap>");

		if($ART[0] != 1 AND $ART[4] != '') {

			if(!$xTrash->Check2($ART)) {

				$BODY->Send('<form name="f'.$num.'" action="./add/" method=POST>');
					$BODY->Send('<input type=hidden name="t[xsklad]"	value="'.($ART[0]).'">');
					$BODY->Send('<input type=hidden name="t[xbrand]"	value="'.($ART[1]).'">');
					$BODY->Send('<input type=hidden name="t[xarticle]"	value="'.($ART[2]).'">');
					$BODY->Send('<input type=hidden name="t[xname]"		value="'.($ART[3]).'">');
					$BODY->Send('<input type=hidden name="t[xacode]"	value="'.($ART[7]).'">');

					$BODY->Send('<input type=hidden name="t[xsource]"	value="'.($ART[5]).'">');
					$BODY->Send('<input type=hidden name="t[xskidka]"	value="'.($skidka).'">');
					$BODY->Send('<input type=hidden name="t[xprice]"	value="'.($price).'">');
					$BODY->Send('<input type=hidden name="t[xcurs]"		value="'.($curs).'">');
					$BODY->Send('<input type=hidden name="t[xclient]"	value="'.($client).'">');
					$BODY->Send('<input type=hidden name="t[xcode]"		value="'.($USR->ccode).'">');
					$BODY->Send('<input type=text   name="t[xcnt]"		value="0" style="width:40px; text-align: right; border: 1px solid #555;">');

					if($ART[0] > 4000) {
						$BODY->Send('&nbsp;<a href="javascript:viod();" onclick="if( confirm(\''.$ALERT.'\') ) {document.forms[\'f'.$num.'\'].submit();} return false;">в корзину</a>');
					} else {
						$BODY->Send('&nbsp;<a href="javascript:viod();" onclick="document.forms[\'f'.$num.'\'].submit(); return false;">в корзину</a>');
					}

				$BODY->Send('</form>');

				$num++;
			} else {
				$BODY->Send('<a href="./del/?id='.$xTrash->getID($ART).'" >из корзины</a>');
			}
		} else {
			$BODY->Send('&nbsp;');
		}

		$BODY->Send("</td>");

		$BODY->Send("</tr>");



}

if(count($ARTS)) {

	$BODY->Send('<table class="prtb" style="margin-top: 5px; width: 95%;">');

	$BODY->Send('<tr class="prtrr">');
		//$BODY->Send("<th class='prtdw' nowrap>Где</th>");
		$BODY->Send("<th class='prtdw' nowrap>Бренд</th>");
		$BODY->Send("<th class='prtdw' nowrap>Артикул</th>");
		$BODY->Send("<th class='prtdw' width=100%>Наименование</th>");
		$BODY->Send("<th class='prtdw' nowrap>На складе</th>");
		$BODY->Send("<th class='prtdw' nowrap>Поступл.</th>");
		$BODY->Send("<th class='prtdw' nowrap>Опт.</th>");
		//$BODY->Send("<th class='prtdw' nowrap>Скид.</th>");
		//$BODY->Send("<th class='prtdw' nowrap>Нац.</th>");
		$BODY->Send("<th class='prtdw' nowrap>Цена.</th>");
		$BODY->Send("<th class='prtdw' nowrap>Клиент</th>");
		$BODY->Send("<th class='prtdw' nowrap>Корзина</th>");
	$BODY->Send("</tr>");

	$first = true;
	foreach($ARTS as $KEY => $ART) {

		$B1 = '';
		$B2 = '';
		if($ART[0] == 1) {
			continue;
		} elseif($ART[0] > 4000 ) {
			continue;
		} 

		if($first) {
			$BODY->Send('<tr class="prtrr">');
				$BODY->Send("<th class='prtdw' style='background-color:#ccc; color: black; text-align:center;' colspan=15>Склад</th>");
			$BODY->Send('</tr>');
			$first = false;
		}

		drawLine($ART);

		unset($ARTS[$KEY]);
	
	}
	/*echo '<pre>';
	var_dump($SKLADS);
	echo '</pre>';//*

	$first_el = current($ARTS);
	foreach ($ARTS as $art){
		$a = $first_el[3];
		$b = substr($a, 0, 3);
		echo $b."<br/>";
		if(strstr($a, $b)){
			$tmp_1[]=$art;
			echo $tmp_1[3]."<br/>";
		}
	}//*/
	//$ARTS = $tmp_1;
	foreach($SKLADS as $SKLADKEY => $SKLAD) {
	
		reset($ARTS);
		$first = true;
		foreach($ARTS as $KEY => $ART) {


			if($ART[0] != $SKLADKEY ) {
				continue;
			}

			if($first) {
				$BODY->Send('<tr class="prtrr">');
					$BODY->Send("<th class='prtdw' style='background-color:#ccc; color: black; text-align:center;' colspan=15>".$SKLADS[$ART[0]]->sklad_short."</th>");
				$BODY->Send('</tr>');
				$BODY->Send('<tr class="prtrr">');
					$BODY->Send("<th class='prtdw' style='border-bottom: 1px solid #ccc; background-color:#eeeeee; color: black; text-align:left;' colspan=15>".$SKLADS[$ART[0]]->sklad_rem."</th>");
				$BODY->Send('</tr>');
				$first = false;
			}

			drawLine($ART,$SKLADS[$ART[0]]->sklad_rem);

			unset($ARTS[$KEY]);
		
		}
	}

	reset($ARTS);
	/*$first = true;
	foreach($ARTS as $KEY => $ART) {

		if($first) {
			$BODY->Send('<tr class="prtrr">');
				$BODY->Send("<th class='prtdw' style='background-color:#ccc; color: black;' colspan=15>Аналоги</th>");
			$BODY->Send('</tr>');
			$first = false;
		}

		drawLine($ART);

	}*/
	
	$BODY->Send("</table>");

}


$BODY->Send('</div>');

require_once('../../../oops/stop.inc');

?>