Корзина
<script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script type="text/javascript" src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script type="text/javascript" src="/js/basket.js"></script>
	<div style="margin: 15px;">
	<table class="prtb" style="margin-top: 5px; width: 95%;">
		<tbody>
			<tr class="prtrr">
				<th class="prtdw">Производитель</th><th class="prtdw">Код</th><th class="prtdw">Описание</th><th class="prtdw">Кол-во</th><th class="prtdw">Цена</th><th class="prtdw">Всего</th><th class="prtdw"></th>
			</tr>
		<?if (isset($codeU)):
			$total = 0;
			$i=0;
			if (isset($cart['0'])){
			foreach ($cart as $row){
				$total = $row['cost']*$row['cnt']+$total;
			?>
				<tr style="border-bottom: 1px solid #ddd;">
				<td class="prtd" nowrap=""><?=$row['brand']?></td>
				<td class="prtd" nowrap=""><?=$row['art']?></td>
				<td class="prtd" nowrap="" width="100%"><?=$row['name']?></td>
				<td class="prtd" nowrap=""><input name="cnt-<?=$i?>" id="cnt-<?=$i?>" style="border: 1px solid black; padding: 1px; width: 40px; text-align: right;" type="text" value="<?=$row['cnt']?>" onchange="change(<?=$row['id']?>,this.value)" /></td>
				<td class="prtd" nowrap="" align="right"><span id="cost-<?=$i?>"><?=$row['cost']?></span> руб.</td>
				<td class="prtd" nowrap="" align="right"><a href="#" onclick="confirmItemDel(<?=$row['id']?>,'Вы действительно хотите удалить <?=$row['brand']?> <?=$row['art']?> из корзины?');return false;">удалить</a></td>
				</tr>
			<?$i++;}
			}?>
		<?else:
			echo 'Не авторизированный пользователь';
			$total = 0;
			$i=0;
			if (isset($cart['0'])):
			foreach ($cart as $row):
				$total = $row['cost']*$row['cnt']+$total;
			?>
				<tr style="border-bottom: 1px solid #ddd;">
				<td class="prtd" nowrap=""><?=$row['brand']?></td>
				<td class="prtd" nowrap=""><?=$row['art']?></td>
				<td class="prtd" nowrap="" width="100%"><?=$row['name']?></td>
				<td class="prtd" nowrap=""><input name="cnt-<?=$i?>" id="cnt-<?=$i?>" style="border: 1px solid black; padding: 1px; width: 40px; text-align: right;" type="text" value="<?=$row['cnt']?>" onchange="change(<?=$row['id']?>,this.value)" /></td>
				<td class="prtd" nowrap="" align="right"><span id="cost-<?=$i?>"><?=$row['cost']?></span> руб.</td>
				<td class="prtd" nowrap="" align="right"><a href="#" onclick="confirmItemDel(<?=$row['id']?>,'Вы действительно хотите удалить <?=$row['brand']?> <?=$row['art']?> из корзины?');return false;">удалить</a></td>
				</tr>
			<?$i++;
			endforeach;
			endif;
		endif;?>
		<tr style="background-color: #eeeeee">
				<td class="prtd" nowrap="" colspan="5">ИТОГО</td><td class="prtd" nowrap="" align="right"><span id="total"><?=number_format($total,2,'.','')?></span>&nbsp;руб.</td><td class="prtd" nowrap="" colspan="5"></td>
			</tr>
		</tbody>
	</table>
	<?if (count($cart)>0):?>
	<table width="600" style="margin-top: 20px;">
	 <tbody>
		<tr>
			<td align="center"><button style="padding: 5px;" onclick="deliteAll()">очисть все</button></td>
			<td align="center"><button style="padding: 5px;" onclick="document.location.href='/search/print'; return false;">распечатать</button></td>
			<td align="center"><button style="padding: 5px;" onclick="document.location.href='/search/exel'; return false;">EXCEL</button></td>
			<td align="center"><button style="padding: 5px;" onclick="document.location.href='/cart/mailto'; return false;">заказать по почте</button></td>
		</tr>
	 </tbody>
	</table>
	<?endif;?>
	</div>