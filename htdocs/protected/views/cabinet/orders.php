	<!--[if IE]>
		<script src='http://html5shiv.googlecode.com/svn/trunk/html5.js'></script>
	<![endif]-->
	<!--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.js"></script>-->
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.js"></script>
	<script type="text/javascript" src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
	<script src="/js/jquery.ui.datepicker-ru.js" type="text/javascript"></script>
	<script type="text/javascript" src="/js/orders.js"></script>
	<link type="text/css" href="/css/jquery-ui-1.7.2.cust.css" rel="stylesheet" />
	<link rel="stylesheet" type="text/css" media="all" href="/css/orders.css"/>
	<script type='text/javascript'>
		$(document).ready(function () {
			$('#start').change(function(){change_start (this.value,$('#end').val(),<?=$codeU?>)} );
			$('#end').change(function () {change_end ($('#start').val(),this.value,<?=$codeU?>)} );
		});
	</script>
	<table width="100%" style="border-collapse:collapse">
		<tbody>
		<tr>
			<td>
				<span style="color:#666">Показаны:</span>
				<span id="litDateFilter" class="datefilter"><form action="#" method="get"> <input style="width:65px;" id="start" name="start" value="<?=$dates?>" /> — <input style="width:65px;" id="end" name="end" value="<?=$datee?>" /> </form></span>
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
			<?if (isset($orders)):?>
			<?foreach ($orders as $id => $or){
		$n_stat = count($orders["$id"]['children']);
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
							<th style="width:20%"><?=$orders_status["$id"]['it_st']?></th>
					</tr>
					</thead>
			</table>
				</label>
					<article class="ac-large">
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
					</article>
			</div>
		<?}?>
		<?endif;?>
			</td>
		</tr>
		</tbody>
	</table>