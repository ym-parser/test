<?php
/**
 * @var $this ArticlesController
 */

$this->registerCssFile("search.css");
$this->registerJsFile('articles.js');
?>
<pre>
Вызывали процедуру:<br/>
<?echo "EXECUTE [Rusimport].[dbo].[GetGoodsList] '".$tq."', ".(int)$bid.", ",$model['codeU'];?><br/>
<?#var_dump($REM)?>
</pre>
<?if($model['codeU'] == 0):?>
<h5 style="color:red;">Вы не авторизированы, пожалуйста авторизируйтесь, для получения вашей цены</h5>
<?endif;?>
<div class="b-search">

  <form class="form-search well" action="<?php echo Yii::app()->createUrl(SearchModule::ROUTE_SEARCH_VIEW); ?>" method="get">
    <div class="input-append">
      <input class="search-query span4" placeholder="Поиск" value="" name="TQ" autocomplete="off">
      <button class="btn btn-inverse" type="submit"><i class="icon-search icon-white"></i> Найти</button>
    </div>
  </form>
<?if(is_array($RIK)):?>
	<table>
		<thead>
		<tr>
			<th>Бренд</th>
			<th>Артикул</th>
			<th>Описание</th>
			<th>На складе</th>
			<th>Поступл.</th>
			<th>Клиент</th>
			<th>Корзина</th>
			<th></th>
		</tr>
		<tr><th colspan='7'>Склад</th></tr>
		<thead>
	<?foreach ($RIK as $row):?>
		<tr style='border-bottom: 1px solid #eee;'>
			<td><?=$row['brand']?></td>
			<td><?=$row['linecode']?></td>
			<td><?=$row['name']?></td>
			<td><?=$row['quantity3']?></td>
			<td><?=$row['quantity4']?></td>
			<td><?=number_format($row['price'],2,'.',',')?></td>
			<td id='basket_<?=$row['code']?>'>
			<?#=$row['basket_id']?>
			<?if($row['basket_id'] == 0):?>
				<?if($row['quantity3'] != '    ' AND $model['codeU']!=0):?>
					<input style='width:50px;' type='text' id='basket_v_<?=$row['code']?>'/><input type='button' value='В корзину' onclick='AddBasket(<?=$model['codeU']?>,3,1,$("#basket_v_<?=$row['code']?>").val(),"<?=$row['name']?>","<?=number_format($row['price'],2,'.',',')?>",<?=$row['code']?>,0,0,<?=$row['code']?>)'/>
				<?elseif($row['quantity3'] != '    '):?>
					<input style='width:50px;' type='text' id='basket_v_<?=$row['code']?>'/><input type='button' value='В корзину' onclick='AddBasket("<?=$model['sid']?>",3,1,$("#basket_v_<?=$row['code']?>").val(),"<?=$row['name']?>","<?=number_format($row['price'],2,'.',',')?>",<?=$row['code']?>,0,0,<?=$row['code']?>)'/>
				<?endif;?>
			<?else:?>
				<?if ($model['codeU']!=0):?>
					<input type="button" value="Из корзины" onclick="DellBasket(<?=$model['codeU']?>,3,1,1,'<?=$row['name']?>','<?=number_format($row['price'],2,'.',',')?>',<?=$row['code']?>,0,0,<?=$row['code']?>,<?=$row['basket_id']?>)">
				<?else:?>
					<input type="button" value="Из корзины" onclick="DellBasket('<?=$model['sid']?>',3,1,1,'<?=$row['name']?>','<?=number_format($row['price'],2,'.',',')?>',<?=$row['code']?>,0,0,<?=$row['code']?>,<?=$row['basket_id']?>)">
				<?endif;?>
			<?endif;?>
			</td>
			<td id='sub_<?=$row['code']?>'><?if($row['quantity3'] == ' ' AND $model['codeU']!=0):?>
				<input type='button' value='оповестить' onclick='AddSubscription(<?=$model['codeU']?>,<?=$row['code']?>,1,1)'/>
				<?endif;?>
			</td>
		</tr>
	<?endforeach;?>
	</table>
<?endif;?>
<?if(is_array($REM)):?>
<table>
		<tr>
			<th>Бренд</th>
			<th>Артикул</th>
			<th>Описание</th>
			<th>На складе</th>
			<th>Поступл.</th>
			<th>Клиент</th>
			<th>Корзина</th>
		</tr>
		<?$i=1;?>
		<?foreach ($wh as $sklad):?>
		<?#foreach ($REM as $sname=>$row):?>
		<tr><th colspan='7'><?=$sklad['sklad_name']?></th></tr>
		<tr><th colspan='7'><?=$sklad['sklad_des']?></th></tr>
		<?foreach($REM["{$sklad['sklad_name']}_{$sklad['sklad_id']}"]['items'] as $items):?>
			<tr style='border-bottom: 1px solid #eee;'>
			<td><?=$items['gs_brand']?></td>
			<td><?=$items['gs_art']?></th>
			<td><?=$items['gs_name']?></td>
			<td><?=$items['gs_cnt']?></td>
			<td></td>
			<td><?=number_format($items['gs_price'],2,'.',',')?></td>
			<td id="basket__<?=$i?>"><?if($items['gs_cnt'] != ' ' AND $model['codeU']!=0):?>
				<input style='width:50px;' type='text' id='basket__v<?=$i?>'/><input type='button' value='В корзину' onclick='AddBasket(<?=$model['codeU']?>,<?=$items['gs_sid']?>,0,$("#basket__v<?=$i?>").val(),"<?=$items['gs_name']?>","<?=number_format($items['gs_price'],2,'.',',')?>",0,"<?=$items['gs_brand']?>","<?=$items['gs_art']?>"),<?=$i?>'/>
				<?$i++;?>
				<?endif;?>
			</td>
		</tr>
		<?endforeach;?>
<?endforeach;?>
</table>
<?endif;?>
</div>