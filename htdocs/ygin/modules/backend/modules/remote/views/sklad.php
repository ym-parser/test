<?
$cs = Yii::app()->clientScript;
$this->registerJsFile('sklad.js');
$this->registerCssFile('sklad.css');
?>
<pre>
<?=var_dump($auto)?>
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
		<td><span class='left15'><input type='text' id='email' name='email' value=''/></span></td>
	</tr>
	<tr>
		<td>Наименование для сайта</td>
		<td><input type='text' id='sname' name='sname' value='<?=iconv('windows-1251','utf-8',$sklad['sklad_sname'])?>'/></td>
		<td><label class='left15'>Используется ли дата?</label></td>
		<td><span class='left15'><input type='checkbox' id='ifdate' name='ifdate' value=''/></span></td>
	</tr>
	<tr>
		<td>Код в учёте</td>
		<td><input type='number' id='code' name='code' value='<?=$sklad['sklad_code']?>'/></td>
		<td><label class='left15'>Тема письма:</label></td>
		<td><span class='left15'><input type='text' id='subj' name='subj' value=''/></span></td>
	</tr>
	<tr>
		<td>Сортировка (порядок выдачи)</td>
		<td><input type='number' id='sort' name='sort' value='<?=$sklad['sklad_sort']?>'/></td>
		<td><label class='left15'>Наценка</label></td>
		<td><span class='left15'><input type='text' id='markup' name='markup' value=''/></span></td>
	</tr>
	<tr>
		<td>Описание склада</td>
		<td><textarea id='des' name='des'><?=iconv('windows-1251','utf-8',$sklad['sklad_des'])?></textarea></td>
		<td><label class='left15'>Колонка с наименованием бренда</label></td>
		<td><span class='left15'><input type='text' id='col_brand' name='col_brand' value=''/></span></td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td><label class='left15'>Колонка с наименованием артикула</label></td>
		<td><span class='left15'><input type='text' id='col_art' name='col_art' value=''/></span></td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td><label class='left15'>Колонка с наименованием</label></td>
		<td><span class='left15'><input type='text' id='col_name' name='col_name' value=''/></span></td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td><label class='left15'>Колонка с кол-вом</label></td>
		<td><span class='left15'><input type='text' id='col_cnt' name='col_cnt' value=''/></span></td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td><label class='left15'>Колонка с ценой</label></td>
		<td><span class='left15'><input type='text' id='col_price' name='col_price' value=''/></span></td>
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