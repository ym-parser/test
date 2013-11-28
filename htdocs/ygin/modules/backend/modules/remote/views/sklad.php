<?
$cs = Yii::app()->clientScript;
$this->registerJsFile('sklad.js');
?>
<pre>
<?#=var_dump($items)?>
</pre>
<table>
	<tr>
		<th colspan='2'>Данные по складу</th>
		<th colspan='2'>Данные Автозагрузчику</th>
	<tr>
	<tr>
		<td>Наименование склада</td>
		<td><input type='text' id='name' name='name' value='<?=iconv('windows-1251','utf-8',$sklad['sklad_name'])?>'/></td>
		<td>E-mail отправителя:</td>
		<td></td>
	</tr>
	<tr>
		<td>Наименование для сайта</td>
		<td><input type='text' id='sname' name='sname' value='<?=iconv('windows-1251','utf-8',$sklad['sklad_sname'])?>'/></td>
		<td>Используется ли дата?</td>
		<td></td>
	</tr>
	<tr>
		<td>Код в учёте</td>
		<td><input type='number' id='code' name='code' value='<?=$sklad['sklad_code']?>'/></td>
		<td>Тема письма:</td>
		<td></td>
	</tr>
	<tr>
		<td>Сортировка (порядок выдачи)</td>
		<td><input type='number' id='sort' name='sort' value='<?=$sklad['sklad_sort']?>'/></td>
		<td>Наценка</td>
		<td></td>
	</tr>
	<tr>
		<td>Описание склада</td>
		<td><textarea id='des' name='des'><?=iconv('windows-1251','utf-8',$sklad['sklad_des'])?></textarea></td>
		<td></td>
		<td></td>
	</tr>
</table>
<form style="float:left;">
<fieldset>
<legend>Данные по складу</legend>
<label>Наименование склада</label><br/>
<label>Наименование для сайта</label><br/>
<label>Код в учёте</label><br/>
<label>Сортировка (порядок выдачи)</label> <br/>
<label>Описание склада</label><br/>
</fieldset>
</form>
<form style="float:right;">
<fieldset>
<legend>Данные Автозагрузчику</legend>
<label>Колонка с наименованием бренда</label><br/>
<label>Колонка с наименованием Артикула</label><br/>
<label>Колонка с наименованием</label><br/>
<label>Колонка с кол-ва</label><br/>
<label>Колонка с ценой</label><br/>
</fieldset>
</form>
<br style="clear:both;"/>
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