<?php
?>
<style>
.onoffswitch {
    position: relative; width: 120px;
    -webkit-user-select:none; -moz-user-select:none; -ms-user-select: none;
}
.onoffswitch-checkbox {
    display: none;
}
.onoffswitch-label {
    display: block; overflow: hidden; cursor: pointer;
    border: 2px solid #999999; border-radius: 20px;
}
.onoffswitch-inner {
    width: 200%; margin-left: -100%;
    -moz-transition: margin 0.3s ease-in 0s; -webkit-transition: margin 0.3s ease-in 0s;
    -o-transition: margin 0.3s ease-in 0s; transition: margin 0.3s ease-in 0s;
}
.onoffswitch-inner:before, .onoffswitch-inner:after {
    float: left; width: 50%; height: 30px; padding: 0; line-height: 30px;
    font-size: 14px; color: white; font-family: Trebuchet, Arial, sans-serif; font-weight: bold;
    -moz-box-sizing: border-box; -webkit-box-sizing: border-box; box-sizing: border-box;
}
.onoffswitch-inner:before {
    content: "Показано";
    padding-left: 10px;
    background-color: #2FCCFF; color: #FFFFFF;

}
.onoffswitch-inner:after {
    content: "Скрыто";
    padding-right: 10px;
    background-color: #EEEEEE; color: #999999;
    text-align: right;
}
.onoffswitch-switch {
    width: 18px; margin: 6px;
    background: #FFFFFF;
    border: 2px solid #999999; border-radius: 20px;
    position: absolute; top: 0; bottom: 0; right: 85px;
    -moz-transition: all 0.3s ease-in 0s; -webkit-transition: all 0.3s ease-in 0s;
    -o-transition: all 0.3s ease-in 0s; transition: all 0.3s ease-in 0s; 
}
.onoffswitch-checkbox:checked + .onoffswitch-label .onoffswitch-inner {
    margin-left: 0;
}
.onoffswitch-checkbox:checked + .onoffswitch-label .onoffswitch-switch {
    right: 0px; 
}
</style>
<div style="margin: 50px;">
	<form id="regform" name="regform" method="post">
		<div style="float:left;">
			Логин:<br />
			<?=Yii::app()->session['login']?><br />
			<br />E-mail:<br />
			<?=Yii::app()->session['login']?><br />
			<br />E-mail менеджера:<br />
			<?=$clientInfo['manager_mail']?><br />
			<br />Имя:<br />
			<?=$clientInfo['name']?><br />
			<br />Фирма:<br />
			<?=$clientInfo['company']?><br />
			<br />Код клиента:<br />
			<?=Yii::app()->session['codeU']?><br />
		</div>
		<div style="float:left;margin-left:25px;">
		<table>
		<td>
			<br />Скидка %:<br />
			<?=number_format($clientInfo['discount'],2)?><br />
			<br />Наценка %:<br />
			<input type="text"  name="k2" class="in" value="<?=number_format($clientInfo['extra_charge'] ,2)?>">
			<? if(!empty($skids)):?> 
			<br />Скидки на бренды %<br />
			<?foreach($skids as $b => $s):?>
				<?if($s <= 0) continue;?>
				<input disabled type='text' name='x_skidka2brandb[]' class='in' style='width:200px' value='<?=$b?>'>&nbsp;
				<input disabled type='text' name='x_skidka2brands[]' class='in' value='<?=number_format($s,2)?>' style='width:50px'>%<br />
			<?endforeach;?>
			<?endif;?>
		</td>
		</table>
		</div>
		<br /><input type=submit value="изменить" class="fltbut">
	</form>
<div style="clear:both;"></div>
<?/********/?>
<div>Показывать колонку с моей ценой:</div>
	<?if ($clientInfo['show_price_column'] == 1):
		$chek_p = 'checked';
	else:
		$chek_p = '';
	endif;?>
<div class="onoffswitch">
    <input type="checkbox" name="onoffswitch" value="<?=Yii::app()->session['codeU']?>" <?=$chek_p?> class="onoffswitch-checkbox" id="myonoffswitch" onchange="location.href='/cabinet/change/?price&check='+this.checked+'&uid='+this.value"/>
    <label class="onoffswitch-label" for="myonoffswitch">
        <div class="onoffswitch-inner"></div>
        <div class="onoffswitch-switch"></div>
    </label>
</div>
<?/********/?>
<p style="margin-top:20px;font-weight:bold;"><a href="/cabinet/change/?pass" title="Cменить пароль">Cменить пароль</a></p>
</div>