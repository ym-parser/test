<div class="wrapper">
	<div class="balance">
		<?$os1 = $flientInfo['deferment'];
		if (empty($os1)){
			$ots = 'не предоставлено';
			$ots2 = '0';
		}else{
			$ots = 'предоставлена';
			$ots2 = $flientInfo['deferment'];
		}
		if (empty($flientInfo['max_debt'])){
			$lim = '0.00';
		}else{
			$lim = $flientInfo['max_debt'];
		}
		if (empty($flientInfo['status_name'])){
			$status = 'не установлен';
		}else{
			$status = $flientInfo['status_name'];
		}
		if (empty($clientInfo['discount'])){
			$skid = '0.00';
		}else{
			$skid = number_format($clientInfo['discount'],2);
		}//*/
		if ($flientInfo['balance'] > 0){
			$dolg = 'предоплата';
		}elseif($flientInfo['balance'] < 0){
			$dolg = 'долг';
		}else{
			$dolg = '';
		}?>

	<table class="bal-table">
	<thead>
		<tr>
			<th colspan="2">Общая информация</th>
		<tr>
	</thead>
	<tbody>
		<tr>
			<td>Статус клиента</td>
			<td><?=$status?></td>
		</tr>
		<tr>
			<td>Скидка %</td>
			<td><?=$skid?>%</td>
		</tr>
	</tbody>
</table>
<table class="bal-table">
	<thead>
		<tr>
			<th colspan="2">Предоставление услуг<th>
		</tr>
	</thead>
	<tbody>
		<!--<tr>
			<td>Услуга отсрочки платежа</td>
			<td>'.$ots.'</td>
		</tr>-->
		<tr>
			<td>Лимит (руб.)</td>
			<td><?=$lim?> руб.</td>
		</tr>
		<tr>
			<td>Отсрочка (дней)</td>
			<td><?=$ots2?> дней</td>
		</tr>
		<tr>
			<td>Услуга сборки заказа</td>
			<td>Не предоставлена</td>
		</tr>
	</tbody>
</table>
<table class="bal-table">
	<thead>
		<tr>
			<th colspan="2">Ваши параметры<th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>Торговая наценка</td>
			<td><input type="text" value="<?=number_format($clientInfo['extra_charge'] ,2)?>" style="width:25px;"/>%<input type="button" value="сохранить" disabled/></td>
		</tr>
	</tbody>
</table>
<table class="bal-table">
	<thead>
		<tr>
			<th colspan="2">Ваш Баланс<th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>Баланс (руб.)</td>
			<td><?=$flientInfo['balance']?> (<?=$dolg?>)</td>
		</tr>
	</tbody>
</table>
	</div>
	<div class="skidki">

<br />E-mail менеджера:<br />
<input type=text name=eman class=in value="<?=$clientInfo['manager_mail']?>">

<br />Ваш код клиента:<br />
<input type=text name=eman class=in value="<?=$codeU?>">

	</div>
</div>