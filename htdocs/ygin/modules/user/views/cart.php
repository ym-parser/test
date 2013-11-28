<?
$cs = Yii::app()->clientScript;
$this->registerJsFile('cart.js');
?>
<pre>
<?=var_dump($data)?>
</pre>
<?if($model['codeU'] == 0):?>
<h5 style="color:red;">Вы не авторизированы, пожалуйста авторизируйтесь, но вы потеряете корзину собранную без авторизации</h5>
<?endif;?>
<div class="b-search">
<?if(is_array($data)):?>
	<table>
		<thead>
		<tr>
			<th>Производитель</th>
			<th>Код</th>
			<th>Описание</th>
			<th>Кол-во</th>
			<th>Цена</th>
			<th>Всего</th>
			<th></th>
		</tr>
		<thead>
		<?$total =0;?>
	<?foreach ($data as $row):?>
		<tr style='border-bottom: 1px solid #eee;'>
			<td><?=$row['brand']?></td>
			<td><?=$row['linecode']?></td>
			<td><?=$row['name']?></td>
			<td><input type='text' style='width:35px;' onchange='ChangeBasket(<?=$row['id']?>,this.value)' value='<?=number_format($row['quantity'],2,'.',',')?>'></td>
			<td><?=number_format($row['price'],2,'.',',')?> руб.</td>
			<td><?=number_format($row['quantity']*$row['price'],2,'.',',')?></td>
			<td><input type='button' onclick='DelBasketItem(<?=$row['id']?>)' value='удалить'/></td>
		</tr>
		<?$total = $total+$row['quantity']*$row['price'];?>
	<?endforeach;?>
		<tr>
			<td colspan='6'>ИТОГО:</td>
			<td><?=number_format($total,2,'.',',')?> руб.</td>
		</tr>
	</table>
<?endif;?>
</div>