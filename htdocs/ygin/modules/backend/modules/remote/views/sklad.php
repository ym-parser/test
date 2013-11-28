<?
$cs = Yii::app()->clientScript;
$this->registerJsFile('sklad.js');
$this->registerCssFile('sklad.css');
?>
<pre>
<?=var_dump($model['auto'])?>
</pre>
<table>
	<tr>
		<th colspan='2'>Данные по складу</th>
		<th colspan='2'>Данные Автозагрузчику</th>
	<tr>
	<tr>
		<td>Наименование склада</td>
		<td><input type='text' id='name' name='name' value='<?=iconv('windows-1251','utf-8',$sklad['sklad_name'])?>'/></td>
		<td><label class='left15'>E-mail отправителя:</label></td>
		<td><span class='left15'><input type='text' id='email' name='email' value='<?=$model['auto']['from_lett']?>'/></span></td>
	</tr>
	<tr>
		<td>Наименование для сайта</td>
		<td><input type='text' id='sname' name='sname' value='<?=iconv('windows-1251','utf-8',$sklad['sklad_sname'])?>'/></td>
		<td><label class='left15'>Используется ли дата?</label></td>
		<td>
			<span class='left15'><input type='checkbox' id='ifdate' onclick='ShowDate()' name='ifdate' <?=$model['chek']?> value='<?=$model['auto']['use_date']?>'/></span>
			<table id="isDate" style="display:<?=$model['display']?>;">
				<tr>
					<td>Формат Даты</td>
					<td><input type='text' id='format_date' name='format_date' value='<?=$model['auto']['format_date']?>'/></td>
				</tr>
				<tr>
					<td>Дата по умолчанию*</td>
					<td><input type='text' id='default_date' name='default_date' value='<?=$model['auto']['default_date']?>'/></td>
				</tr>
				<tr>
					<td>Дата сначала недели**</td>
					<td><input type='text' id='monday_date' name='monday_date' value='<?=$model['auto']['monday_date']?>'/></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td>Код в учёте</td>
		<td><input type='number' id='code' name='code' value='<?=$sklad['sklad_code']?>'/></td>
		<td><label class='left15'>Тема письма:</label></td>
		<td><span class='left15'><input type='text' id='subj' name='subj' value='<?=$model['auto']['subj_lett']?>'/></span></td>
	</tr>
	<tr>
		<td>Сортировка (порядок выдачи)</td>
		<td><input type='number' id='sort' name='sort' value='<?=$sklad['sklad_sort']?>'/></td>
		<td><label class='left15'>Наценка</label></td>
		<td><span class='left15'><input type='text' id='markup' name='markup' value='<?=$model['auto']['markup']?>'/></span></td>
	</tr>
	<tr>
		<td rowspan='5'>Описание склада</td>
		<td rowspan='5'><textarea id='des' name='des' style='height:185px;'><?=iconv('windows-1251','utf-8',$sklad['sklad_des'])?></textarea></td>
		<td><label class='left15'>Колонка с наименованием бренда</label></td>
		<td><span class='left15'><input type='text' id='col_brand' name='col_brand' value='<?=$model['auto']['col_brand']?>'/></span></td>
	</tr>
	<tr>
		<td><label class='left15'>Колонка с наименованием артикула</label></td>
		<td><span class='left15'><input type='text' id='col_art' name='col_art' value='<?=$model['auto']['col_art']?>'/></span></td>
	</tr>
	<tr>
		<td><label class='left15'>Колонка с наименованием</label></td>
		<td><span class='left15'><input type='text' id='col_name' name='col_name' value='<?=$model['auto']['col_name']?>'/></span></td>
	</tr>
	<tr>
		<td><label class='left15'>Колонка с кол-вом</label></td>
		<td><span class='left15'><input type='text' id='col_cnt' name='col_cnt' value='<?=$model['auto']['col_cnt']?>'/></span></td>
	</tr>
	<tr>
		<td><label class='left15'>Колонка с ценой</label></td>
		<td><span class='left15'><input type='text' id='col_price' name='col_price' value='<?=$model['auto']['col_price']?>'/></span></td>
	</tr>
</table>
<div id="ressMess"></div>
<button onclick="saveSklad(<?=$id?>)">Сохранить</button> <button>Удалить товары со склада</button>
<table class="table table-bordered b-instance-list daGallery">
<thead>
	<tr>
		<th>Бренд</th>
		<th>Артикул</th>
		<th>Наименование</th>
		<th>Кол-во</th>
		<th>Цена</th>
	</tr>
</thead>
<tbody class="goodsSklad">
<?if(is_array($items)):?>
	<?foreach ($items as $it):?>
		<tr id="ygin_inst_1" class="base">
			<td><?=iconv('windows-1251','utf-8',$it['gs_brand'])?></td>
			<td><?=iconv('windows-1251','utf-8',$it['gs_art'])?></td>
			<td><?=iconv('windows-1251','utf-8',$it['gs_name'])?></td>
			<td><?=$it['gs_cnt']?></td>
			<td><?=number_format($it['gs_price'],2,'.','')?> руб.</td>
		</tr>
	<?endforeach;?>
<?endif?>
</tbody>
</table>