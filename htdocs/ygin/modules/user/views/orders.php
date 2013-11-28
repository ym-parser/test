<?
$cs = Yii::app()->clientScript;
$this->registerJsFile('orders.js');
$this->registerCssFile('orders.css');
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
<table class="tbl" cellspacing="1" cellpadding="4" id="gvData">
		<thead>
		<tr class="trh">
			<th class="header nopad" scope="col">
					<div class="headercell">
						<span>Дата</span>
					</div>
				</th><th class="header nopad" scope="col">
					<div class="headercell">
						<span>№ Заказа</span>
					</div>
				</th>
				<th class="header nopad" scope="col">
					<div class="headercell">
						<span>Сумма</span>
					</div>
				</th>
				<th class="header nopad" scope="col">
					<div class="headercell">
						<span>Дата изменения</span>
					</div>
				</th>
				<th class="header nopad" scope="col">
					<div class="headercell">
						<span>Состояние</span>
					</div>
				</th>
		</tr>
		</thead>
		<tbody>
		<tr>
			<td class="nopad" colspan="5" id="orders">
			<?if (isset($model['orders'])):?>
			<?$i=1;?>
			<?foreach ($model['orders'] as $id => $or){
		$n_stat = count($model['orders']["$id"]['children']);
		$n_stat = $n_stat-1;
		?>
			<div>
			<input id="ac-<?=$i?>" name="accordion-1" type="checkbox" />
				<label for="ac-<?=$i?>">
			<table class="CityTable" rules="all" cellpadding="0" cellspacing="0">
					<thead>
					<tr>
							<th style="width:20%"><?=$or['date']?></th>
							<th style="width:20%"><?=$id?></th>
							<th style="width:20%"><?=$or['total']?> <?=$or['children']['0']['cur']?></th>
							<th style="width:20%"><?=$or['children']["$n_stat"]['date']?></th>
							<th style="width:20%"><?=$model['orders_status']["$id"]['it_st']?></th>
					</tr>
					</thead>
			</table>
				</label>
					<div id='article' class="ac-large">
					<table class="CityTable" rules="all" cellpadding="0" cellspacing="0">
					<tbody>
					<tr>
							<th style="width:65px;">Бренд</th>
							<th style="width:140px">Артикул</th>
							<th style="width:380px">Название</th>
							<th>Кол-во</th>
							<th>Цена</th>
							<th>Стоимость</th>
							<th>Статус</th>
					</tr>
					<?foreach ($or['children'] as $ch){
						$ch['brand'] = str_replace(' - Амортизаторы', ' ',$ch['brand']);
						$ch['brand'] = str_replace('-', ' ',$ch['brand']);?>
						<tr>
						 <td style="width:65px; class="brand"><?=$ch['brand']?></td>
						 <td style="width:140px" class="brand"><?=$ch['vendor']?></td>
						 <td style="width:380px" class="brand"><?=$ch['name']?></td>
						 <td class="vend"><?=$ch['qty']?> шт.</td>
						 <td class="vend"><?=$ch['price']?> <?=$ch['cur']?></td>
						 <td class="vend"><?=$ch['amount']?> <?=$ch['cur']?></td>
						 <td class="vend"><?=$ch['status']?></td>
						</tr>
					<?}
					$i++;?>
					</tbody>
					</table>
					</div>
			</div>
		<?}?>
		<?endif;?>
			</td>
		</tr>
		</tbody>
	</table>