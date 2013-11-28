<table>
<thead>
	<tr>
		<th>ID</th>
		<th>Логин</th>
		<th>Роль</th>
	</tr>
</thead>
<tbody>
<?foreach ($admins as $admin):?>
	<tr>
		<td><?=$admin['id']?></td>
		<td><?=$admin['login']?></td>
		<td><?=$admin['name']?></td>
	</tr>
<?endforeach;?>
</tbody>
</table>