<?
$cs = Yii::app()->clientScript;
$this->registerJsFile('stat.js');
?>
<script type='text/javascript'>
		$(document).ready(function () {
			$('#start').change(function(){change_start (this.value,$('#end').val(),<?=$model['cInfo']['company_code']?>)} );
			$('#end').change(function () {change_end ($('#start').val(),this.value,<?=$model['cInfo']['company_code']?>)} );
		});
	</script>
	<link type="text/css" href="/css/stat.css" rel="stylesheet" />
<table width="100%" style="border-collapse:collapse">
	<tbody>
		<tr>
			<td><span style="color:#666">Показаны:</span>
			<span id="litDateFilter" class="datefilter"><input type='date' id="start" name="start" value="<?=date('Y-m-d',strtotime($model['fInfo']['start_date']))?>" /> — <input type='date' id="end" name="end" value="<?=date('Y-m-d', time());?>" /></span>
			</td>
		</tr>
		<tr>
			<td>
				<div class="menu-tab blTab">
				<ul>
					<li><a id="hlHistory" class="selected-button" href="#">Взаиморасчеты (<?=$model['nom1']?>)</a></li>
					<li style="position:relative; left:465px;"><a id="balance_s" class="selected-button" >Баланс на начало периода: <?=$model['sheet']['0']['balance']?> руб.</a></li>
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
		<?if (isset($model['sheet']['0']['balance'])){$pit=$model['sheet']['0']['balance'];}else{$pit=0;}
		$pb=$pit;
		if (isset($model['sheet'])):
		foreach ($model['sheet'] as $sh){
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
				<?echo '<tr onclick="window.open(\'/user/download/?docid='.$sh['docid'].'\');" class="emptydaterow" align="center" style="background-color:LightGrey;font-weight:bold;height:40px;">';?>
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
				<?echo '<tr onclick="window.open(\'/user/download/?docid='.$sh['docid'].'\');" class="emptydaterow" align="center" style="background-color:LightGrey;font-weight:bold;height:40px;">';?>
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
				if (isset($model['pay']['0']['total'])){$paym=$model['pay']['0']['total'];}else{$paym=0;}
				if (isset($model['sheet']['0']['balance'])){$pit=$model['sheet']['0']['balance'];}else{$pit=0;}
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
						<?if(isset($model['otgruz']['0']['total'])){?>
						<?=number_format($model['otgruz']['0']['total'],2,'.','')?>
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
						<?if(isset($model['vozvrat']['0']['total'])){?>
						<?=number_format($model['vozvrat']['0']['total'],2,'.','')?>
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
						<?if(isset($model['otgruz']['0']['total']) and isset($model['pay']['0']['total'])){
						$razn = $model['sheet']['0']['balance']+$model['pay']['0']['total']-$model['otgruz']['0']['total'];?>
						<?=$pb?>
						<?}elseif (isset ($model['otgruz']['0']['total']) and !isset($model['pay']['0']['total'])){
							$razn = $model['sheet']['0']['balance']-$model['otgruz']['0']['total'];?>
						<?=$pb?>
						<?}elseif (!isset ($model['otgruz']['0']['total']) and isset($model['pay']['0']['total'])){
							$razn = $model['sheet']['0']['balance']+$model['pay']['0']['total'];?>
						<?=$pb?>
						<?}else{?>
						0
						<?}?>
	 руб.</span>
				</th></tr>
	</tbody>
	<?endif;?>
	</table>