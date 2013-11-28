	<style type="text/css">*{font-size: 10px;} </style>
	<div>www.rusimport.com - <?=date('d.m.Y H:i')?></div>
	<table border=0 cellpadding=5>
	<tr style="background-color: #555; color: white;">
		<th>Склад</th>
		<th>Производитель</th>
		<th>Код</th>
		<th>Описание</th>
		<th>Кол-во</th>
		<th>Цена</th>
	</tr>
	<?if (isset($codeU)):
			$total = 0;
			$i=0;
			if (isset($cart['0'])):
			foreach ($cart as $row):
				$total = $row['cost']*$row['cnt']+$total;
				$sklad  = $row['sid'];
				if ($sklad == '3'):
					$sklad = 'РусИмпорт';
				else:
					$sklad = Items::get_sklad_item($sklad);
				endif;
			?>
				<tr style="border-bottom: 1px solid #ddd;">
				<td><?=$sklad?></td>
				<td class="prtd" nowrap=""><?=$row['brand']?></td>
				<td class="prtd" nowrap=""><?=$row['art']?></td>
				<td class="prtd" nowrap="" width="100%"><?=$row['name']?></td>
				<td class="prtd" nowrap=""><span><?=$row['cnt']?></span></td>
				<td class="prtd" nowrap="" align="right"><span id="cost-<?=$i?>"><?=$row['cost']?></span> руб.</td>
				</tr>
			<?$i++;
			endforeach;
			endif;?>
	<?else:?>
	<?	
		$total = 0;
		$i=0;
		if (isset($cart['0'])):
			foreach ($cart as $row):
			$sklad  = $row['sid'];
				if ($sklad == '3'):
					$sklad = 'РусИмпорт';
				else:
					$sklad = Items::get_sklad_item($sklad);
				endif;
			$total = $row['cost']*$row['cnt']+$total;?>
			<tr style="border-bottom: 1px solid #ddd;">
				<td><?=$sklad?></td>
				<td class="prtd" nowrap=""><?=$row['brand']?></td>
				<td class="prtd" nowrap=""><?=$row['art']?></td>
				<td class="prtd" nowrap="" width="100%"><?=$row['name']?></td>
				<td class="prtd" nowrap=""><span><?=$row['cnt']?></span></td>
				<td class="prtd" nowrap="" align="right"><span id="cost-<?=$i?>"><?=$row['cost']?></span> руб.</td>
			</tr>
			<?endforeach;?>
		<?endif;?>
	<?endif;?>
	<tr style="background-color: #eeeeee">
		<td nowrap colspan=5>ИТОГО</td>
		<td nowrap align=right><?=number_format($total,2,'.','')?>&nbsp;руб.</td>
	</tr>
	</table>
<script>
var OLECMDID = 6;
/* OLECMDID values:
* 6 - печать
* 7 - предпросмотр
* 1 - открыть
* 4 - сохранить как
*/
var PROMPT = 1; // 2 - не выводить окно с выбором принтеров
var WebBrowser = \'<OBJECT ID="WebBrowser1" WIDTH=0 HEIGHT=0 CLASSID="CLSID:8856F961-340A-11D0-A96B-00C04FD705A2"></OBJECT>\';
document.body.insertAdjacentHTML(\'beforeEnd\', WebBrowser);
WebBrowser1.ExecWB(OLECMDID, PROMPT);
WebBrowser1.outerHTML = ""; 
</script>


<script>
window.print();
</script>