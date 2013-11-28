<?
$cs = Yii::app()->clientScript;
$this->registerJsFile('sklad.js');
?>
<pre>
<?#=var_dump($items)?>
</pre>
<label>Наименование склада</label><input type='text' id='name' name='name' value='<?=iconv('windows-1251','utf-8',$sklad['sklad_name'])?>'/><br/>
<label>Наименование для сайта</label><input type='text' id='sname' name='sname' value='<?=iconv('windows-1251','utf-8',$sklad['sklad_sname'])?>'/><br/>
<label>Код в учёте</label><input type='number' id='code' name='code' value='<?=$sklad['sklad_code']?>'/><br/>
<label>Сортировка (порядок выдачи)</label><input type='number' id='sort' name='sort' value='<?=$sklad['sklad_sort']?>'/> <br/>
<label>Описание склада</label><textarea id='des' name='des'><?=iconv('windows-1251','utf-8',$sklad['sklad_des'])?></textarea><br/>
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