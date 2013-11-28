<table class="table table-bordered b-instance-list daGallery">
<thead>
	<tr>
		<th>Склад ID</th>
		<th>Имя Склада</th>
		<th>Last Update</th>
		<th>Update</th>
		<th>Редактировать</th>
		<th></th>
	</tr>
</thead>
<tbody class="ui-sortable">
<?foreach ($sklads as $sklad):?>
<tr id="ygin_inst_1" class="base">
	<td><?=$sklad['sklad_id']?></td>
	<td><?=iconv('windows-1251','utf-8',$sklad['sklad_name'])?></td>
	<td>2013.11.27</td>
	<td>Обновить из Почты</td>
	<td class="col-ref action-edit"><a title="Изменить" href="/admin/sklad/<?=$sklad['sklad_id']?>"></a></td>
	<td>Удалить</td>
</tr>
<?endforeach;?>
</tbody>
</table>