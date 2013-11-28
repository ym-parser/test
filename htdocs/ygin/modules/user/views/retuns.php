<?
$cs = Yii::app()->clientScript;
$this->registerJsFile('retuns.js');
?>
<script type='text/javascript'>
		$(document).ready(function () {
			$('#start').change(function(){change_start (this.value,$('#end').val(),<?=$model['cInfo']['company_code']?>)} );
			$('#end').change(function () {change_end ($('#start').val(),this.value,<?=$model['cInfo']['company_code']?>)} );
		});
</script>
	<table width="100%" style="border-collapse:collapse">
		<tbody>
		<tr>
			<td>
				<span style="color:#666">Показаны:</span>
				<span id="litDateFilter" class="datefilter"><input type='date' id="start" name="start" value="<?=date('Y-m-d',strtotime($model['fInfo']['start_date']))?>" /> — <input type='date' id="end" name="end" value="<?=date('Y-m-d', time());?>" /></span>
			</td>
		</tr>
		</tbody>
	</table>
<table id="returns" class="CityTable" cellpadding="0" cellspacing="0" >
		<thead>
			<tr>
				<th style="width:10%">Дата</th>
				<th style="width:10%">Производитель</th>
				<th style="width:10%">Код</th>
				<th style="width:45%">Наименование</th>
				<th>Кол-во</th>
				<th>Цена</th>
				<th>Сумма</th>
			</tr>
		</thead>
		<tbody>
		<?if (!empty($model['retuns'])):?>
		<?foreach ($model['retuns'] as $ch):
						$ch['brand'] = str_replace(' - Амортизаторы', ' ',$ch['brand']);
						$ch['brand'] = str_replace('-', ' ',$ch['brand']);?>
			<tr>
				 <td class="brand"><?=$ch['date']?></td>
				 <td class="brand"><?=$ch['brand']?></td>
				 <td class="brand"><?=$ch['vendor']?></td>
				 <td calss="brand"><?=$ch['name']?></td>
				 <td class="vend"><?=$ch['qty']?> шт.</td>
				 <td class="vend"><?=$ch['price']?> <?=$ch['cur']?></td>
				 <td class="vend"><?=$ch['amount']?> <?=$ch['cur']?></td>
			</tr>
		<?endforeach;?>
		<?endif;?>
		</tbody>
	</table>