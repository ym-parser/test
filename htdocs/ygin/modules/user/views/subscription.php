<?
$cs = Yii::app()->clientScript;
$this->registerJsFile('client.js');
?>
<?if(is_array($model['subscriptions'])):?>
	<table>
	<thead>
		<tr>
			<th>Дата создания</th>
			<th>Бренд</th>
			<th>Артикул</th>
			<th>Тип новости</th>
			<th>Тип оповещения</th>
			<th>действия</th>
		</tr>
	</thead>
	<?foreach ($model['subscriptions'] as &$subs):?>
		<tr>
			<td><?=$subs['created']?></td>
			<td><?=$subs['brand']?></td>
			<td><?=$subs['art']?></td>
			<td><?=$subs['type']?></td>
			<td><?=$subs['show']?></td>
			<td onclick='delSub(<?=$subs['id']?>)'>удалить</td>
		</tr>
	<?endforeach;?>
	</table>
<?endif;?>