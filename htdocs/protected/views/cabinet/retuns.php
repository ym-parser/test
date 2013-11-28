	<script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.js"></script>
	<script type="text/javascript" src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
	<script src="/js/jquery.ui.datepicker-ru.js" type="text/javascript"></script>
	<script type="text/javascript" src="/js/retuns.js"></script>
	<script type='text/javascript'>
		$(document).ready(function () {
			$('#start').change(function(){change_start (this.value,$('#end').val(),<?=$codeU?>)} );
			$('#end').change(function () {change_end ($('#start').val(),this.value,<?=$codeU?>)} );
		});
	</script>
	<link type="text/css" href="/css/retuns.css" rel="stylesheet" />
	<link type="text/css" href="/css/jquery-ui-1.7.2.cust.css" rel="stylesheet" />
	<table width="100%" style="border-collapse:collapse">
		<tbody>
		<tr>
			<td>
				<span style="color:#666">
				Показаны:</span> <span id="litDateFilter" class="datefilter""><form action="#" method="get"> <input style="width:65px;" id="start" name="start" value="<?=$dates?>" /> — <input style="width:65px;" id="end" name="end" value="<?=$datee?>" /> </form></span>
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
		<?if (!empty($retuns)):?>
		<?foreach ($retuns as $ch):
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
