<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"/>
<html  xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru" lang="ru">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
		<link rel="stylesheet" type="text/css" media="all" href="/css/style.css"/>
		<title><?php echo $this->pageTitle; ?></title>
		<meta name="description" content="" />
		<meta name="keywords" content="" />
	</head>
	<body>
	<div class="wrapper w100">
  <div class="header">
	<div style="height:115px;">
	<div class="t011"></div>
	<div class="t012">
		<div class="t11"></div>
	</div>
	</div>
	<div class="wraper t04">
		<div class="cellLeft w125">
		</div>
		<div class="cellMiddle per50">
			<div class="head_line pad15">Главная</div> <?//после добавить строку навигации?>
		</div>
		<div class="cellRight">
			<form action="/search" class="fltfrm" method="get"><input type="text" class="flttxt" name="tq" value="">&nbsp;<input type="submit" value="найти" class="fltbut"></form>
		</div>
	</div>
  </div>
  <div class="wrapper w100">
  <div class="cellLeft w125 border_grey">
	<div class="left_col w125">
    <div class="leftmenu">вход</div>
		<?//форма входа в лк и меню клиента
		if (!isset(Yii::app()->session['codeU'])){?>
			<form  name="loginform" id="loginform" action="/login" method="post">
				<label>E-mail:</label><br/>
				<input type="text" name="login" value=""/><br/>
				<label>Пароль:</label><br/>
				<input type="password" name="passw" value=""/><br/>
				<input class="fltbut" type="submit" value="войти"/><br/>
			</form>
		<?}else{?>
		<div>
			<div class="leftmenu2"><a href="/cabinet" class="leftmenua">Личный кабинет</a></div>
			<div class="leftmenu2"><a href="/logout" class="leftmenua">Выход</a></div>
		</div>
	<?}?>
	<div class="leftmenu">Поставщики</div>
		<?
		foreach ($data['left'] as $row){
			?><div class="leftmenu2"><a href="/brands/<?=$row['brand_alias']?>" class="leftmenua"><?=$row['brand_name']?></a></div><?
		}
		?>
		<div class="leftmenu">авто-спорт</div><div class="leftmenu2"><a href="http://www.ricsport.com/" target="_blank" class="leftmenua">Экипаж РИК</a></div>
	<div class="leftmenu">курсы валют</div>
		<div style="margin: 5px 10px 5px 10px">
			<script>document.write( '<a href="http://www.informer.ru/cgi-bin/redirect.cgi?id=177_1_1_52_40_1-0&url=http://www.rbc.ru/cash/&src_url=usd/eur_cb_forex_cf320e_88x90.gif" target="_blank"><img src="http://pics.rbc.ru/img/grinf/usd/eur_cb_forex_cf320e_88x90.gif?'+ Math.floor( 100000*Math.random() ) + '" WIDTH=88 HEIGHT="90" border=0></a>');</script>
			<a href="http://www.informer.ru/cgi-bin/redirect.cgi?id=177_1_1_52_40_1-0&amp;url=http://www.rbc.ru/cash/&amp;src_url=usd/eur_cb_forex_cf320e_88x90.gif" target="_blank"><img src="http://pics.rbc.ru/img/grinf/usd/eur_cb_forex_cf320e_88x90.gif?81794" width="88" height="90" border="0"></a>
		</div>
		<div class="leftmenu">погода</div>
			<div style="margin: 5px 10px 5px 10px">
				<script>document.write( '<a href="http://www.informer.ru/cgi-bin/redirect.cgi?id=30_4_1_16_1_3-0&url=http://www.rbc.ru/meteo&src_url=weather/81x63_26063_red.gif" target="_blank"><img src="http://pics.rbc.ru/img/grinf/weather/81x63_26063_red.gif?'+ Math.floor( 100000*Math.random() ) + '" WIDTH=81 HEIGHT="63" border=0></a>');</script>
				<a href="http://www.informer.ru/cgi-bin/redirect.cgi?id=30_4_1_16_1_3-0&amp;url=http://www.rbc.ru/meteo&amp;src_url=weather/81x63_26063_red.gif" target="_blank"><img src="http://pics.rbc.ru/img/grinf/weather/81x63_26063_red.gif?38490" width="81" height="63" border="0"></a>
			</div>
  </div>
  </div>
	<? echo $content;?>
  </div>
  <div class ="footer">
	<div class="wraper t04">
		<div class="cellLeft w125 border_grey">
		</div>
		<div class="cellMiddle">
			<div class="botmenu"><a href="/" class="bmenu">компания</a> | <a href="/news/" class="bmenu">новости</a> | <a href="/servise/" class="bmenu">услуги</a> | <a href="/brands/" class="bmenu">бренды</a> | <a href="/contacts/" class="bmenu">контакты</a> | <a href="/search/" class="bmenu">online-заказ</a></div>
		</div>
	</div>
  </div>
</div>
</body>
</html>