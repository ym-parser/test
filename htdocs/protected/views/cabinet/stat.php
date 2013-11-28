	<script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.js"></script>
	<script type="text/javascript" src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
	<script src="/js/jquery.ui.datepicker-ru.js" type="text/javascript"></script>
	<script type="text/javascript" src="/js/stat.js"></script>
	<script type='text/javascript'>
		$(document).ready(function () {
			$('#start').change(function(){change_start (this.value,$('#end').val(),<?=$codeU?>)} );
			$('#end').change(function () {change_end ($('#start').val(),this.value,<?=$codeU?>)} );
		});
	</script>
	<link type="text/css" href="/css/stat.css" rel="stylesheet" />
	<link type="text/css" href="/css/jquery-ui-1.7.2.cust.css" rel="stylesheet" />
<table width="100%" style="border-collapse:collapse">
	<tbody>
		<tr>
			<td><span style="color:#666">Показаны:</span>
			<span id="litDateFilter" class="datefilter""><form action="#" method="get"> <input style="width:65px;" id="start" name="start" value="<?=$dates?>" /> — <input style="width:65px;" id="end" name="end" value="<?=$datee?>" /> </form></span>
			<script type="text/javascript">
				$(function(){
					$.datepicker.setDefaults($.extend($.datepicker.regional["ru"]));
					$("#start").datepicker({dateFormat: "dd.mm.yy"});
				});
			</script>
			<script type="text/javascript">
				$(function(){
					$.datepicker.setDefaults($.extend($.datepicker.regional["ru"]));
					$("#end").datepicker({dateFormat: "dd.mm.yy"});
				});
			</script>
			<div style="float:right;bottom:-25px">
				Показать цены в:
				<select name="ctl00$ctl00$b$b$ddlValute" id="ddlValute" class="inp" style="width:50px;font-size:11px">
					<option selected="selected" value="RU">Руб.</option>
				</select>
			</div>
			</td>
		</tr>
		<tr>
			<td>
				<div class="menu-tab blTab">
				<ul>
					<li><a id="hlHistory" class="selected-button" href="#">Взаиморасчеты (<?=$nom1?>)</a></li>
					<li style="position:relative; left:465px;"><a id="balance_s" class="selected-button" >Баланс на начало периода: <?=$sheet['0']['balance']?> руб.</a></li>
				</ul>
				</div>
			</td>
		</tr>
	</tbody></table>
<table class="tbl" cellspacing="1" cellpadding="4" id="gvData">
		<thead><tr>
			<th class="header" >Дата</th>
				<th class="header" >Время</th>
				<th class="header" >Номер накладной</th>
				<th class="header" >Операция</th>
				<th class="header" >Расчет</th>
				<th class="header" >Сумма</th>
				<th class="header" >Промежуточные итоги</th>
		</tr></thead><tbody id="sheets">
		<?if (isset($sheet['0']['balance'])){$pit=$sheet['0']['balance'];}else{$pit=0;}
		$pb=$pit;
		if (isset($sheet)):
		foreach ($sheet as $sh){
			if ($sh['code']=='Оплачено'){?>
				<tr class="emptydaterow" align="center" style="background-color:LightGrey;font-weight:bold;height:40px;">
				<?$sh['time'] = substr($sh['time'], 0, 8); //смотрим первые 8 символов?>
				<td><?=$sh['date']?></td>
				<td><?=$sh['time']?></td>
				<td><?=$sh['nomnak']?></td>
				<td><div style="padding-right:45px;text-align:right;"><?=$sh['code']?></div></td>
				<td><div style="text-align:right;"><?=$sh['payment']?></div></td>
				<td><div style="text-align:right;"><?=number_format($sh['amount'],2,'.','')?> руб.</div></td>
				<?$pb = $pb+$sh['amount'];?>
				<td><div style="text-align:right;"><?=number_format($pb,2,'.','')?> руб.</div></td>
				</tr>
			<?}elseif ($sh['code']== 'Получено'){?>
				<tr onclick="window.open(\'download.php?docid='.$sh['docid'].'\');" class="emptydaterow" align="center" style="background-color:LightGrey;font-weight:bold;height:40px;">
				<?$sh['time'] = substr($sh['time'], 0, 8); //смотрим первые 8 символов?>
				<td><?=$sh['date']?></td>
				<td><?=$sh['time']?></td>
				<td><?=$sh['nomnak']?></td>
				<td><div style="padding-right:45px;text-align:right;"><?=$sh['code']?></div></td>
				<td></td>
				<td><div style="text-align:right;"><?=number_format($sh['amount'],2,'.','')?> руб.</div></td>
				<?$pb = $pb-$sh['amount'];?>
				<td><div style="text-align:right;"><?=number_format($pb,2,'.','')?> руб.</div></td>
				</tr>
			<?}elseif ($sh['code']== 'Возврат'){?>
				<tr onclick="window.open(\'download.php?docid=<?=$sh['docid']?>\" class="emptydaterow" align="center" style="background-color:LightGrey;font-weight:bold;height:40px;">
				<?$sh['time'] = substr($sh['time'], 0, 8); //смотрим первые 8 символов?>
				<td><?=$sh['date']?></td>
				<td><?=$sh['time']?></td>
				<td><?=$sh['nomnak']?></td>
				<td><div style="padding-right:45px;text-align:right;"><?=$sh['code']?></div></td>
				<td></td>
				<td><div style="text-align:right;"><?=number_format($sh['amount'],2,'.','')?> руб.</div></td>
				<?$pb = $pb+$sh['amount'];?>
				<td><div style="text-align:right;"><?=number_format($pb,2,'.','')?> руб.</div></td>
				</tr>
			<?}
			
		}
				if (isset($pay['0']['total'])){$paym=$pay['0']['total'];}else{$paym=0;}
				if (isset($sheet['0']['balance'])){$pit=$sheet['0']['balance'];}else{$pit=0;}
		 $itog = $pit+$paym;
?>
		</tbody><tbody>
	<tr>
				<th class="header" scope="col"></th>
				<th class="header" scope="col"></th>
				<th class="header" scope="col"></th>
				<th class="header" scope="col"></th>
				<th class="header" scope="col"></th>
				<th></th>
				<th class="header" scope="col" style="text-align:right;">
						<span>Итого оплачено:</span>
						<span>
						<?/*if(isset($sheet['0']['balance']) ){?>
						<?=number_format($sheet['0']['balance']+$paym,2,'.','')?>
						<?}else{?>
							0
						<?}*/?><?=number_format($paym,2,'.','')?>
	 руб.</span>
				</th></tr>
	<tr><th class="header" scope="col"></th>
				<th class="header" scope="col"></th>
				<th class="header" scope="col"></th>
				<th class="header" scope="col"></th>
				<th class="header" scope="col"></th>
				<th></th>
				<th class="header" scope="col" style="text-align:right;">
						<span>Итого отгружено:</span>
						<span>
						<?if(isset($otgruz['0']['total'])){?>
						<?=number_format($otgruz['0']['total'],2,'.','')?>
						<?}else{?>
							0
						<?}?>
	 руб.</span>
				</th></tr>
	<tr><th class="header" scope="col"></th>
				<th class="header" scope="col"></th>
				<th class="header" scope="col"></th>
				<th class="header" scope="col"></th>
				<th class="header" scope="col"></th>
				<th></th>
				<th class="header" scope="col" style="text-align:right;">
						<span>Итого возвращено:</span>
						<span>
						<?if(isset($vozvrat['0']['total'])){?>
						<?=number_format($vozvrat['0']['total'],2,'.','')?>
						<?}else{?>
							0
						<?}?>
	 руб.</span>
				</th></tr>
	<tr><th class="header" scope="col"></th>
				<th class="header" scope="col"></th>
				<th class="header" scope="col"></th>
				<th class="header" scope="col"></th>
				<th class="header" scope="col"></th>
				<th class="header" scope="col" style="text-align:right;">
				</th>
				<th class="header" scope="col" style="text-align:right;">
				<span>Общий итог:</span>
						<span>
						<?if(isset($otgruz['0']['total']) and isset($pay['0']['total'])){
						$razn = $sheet['0']['balance']+$pay['0']['total']-$otgruz['0']['total'];?>
						<?=$pb?>
						<?}elseif (isset ($otgruz['0']['total']) and !isset($pay['0']['total'])){
							$razn = $sheet['0']['balance']-$otgruz['0']['total'];?>
						<?=$pb?>
						<?}elseif (!isset ($otgruz['0']['total']) and isset($pay['0']['total'])){
							$razn = $sheet['0']['balance']+$pay['0']['total'];?>
						<?=$pb?>
						<?}else{?>
						0
						<?}?>
	 руб.</span>
				</th></tr>
	</tbody>
	<?endif;?>
	</table>