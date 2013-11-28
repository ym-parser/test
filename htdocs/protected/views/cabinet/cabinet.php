<style>
.lk-c1 {margin-top:10px; float: left;width: 48%;margin-right: 2%;}
.lk-c2 {margin-top:10px;float: left;width: 49%;}
.lk-sd {margin-top:10px;width: 24%;float: right;}
div.fieldset {width: 90%;float: left;padding: 5px 5% 15px;}
.fieldset {background: #F7F2E3;border: 1px solid transparent;color: #363636;padding: 5px 15px 15px;margin: 0 0 10px;border-radius: 5px;-moz-border-radius: 5px;}

div.cat-block {width: 94%;min-height: 70px;margin: 0 0 10px;padding: 10px 3%;}
.cat-block {width: 43%;float: left;margin: 0 2% 15px 0;padding: 10px 2%;position: relative;}
.gray-form {background: #ccc;border-radius: 5px;-moz-border-radius: 5px;-webkit-border-radius: 5px;border: 1px solid #ececec;}
.drop-car {width: 14px;height: 14px;background: url(http://s.exist.ru/img2/drop-car.png) top left no-repeat;padding: 0 7px 0 7px;float: left;position: relative;margin-left: 10px;text-indent: -9999px;}
.drop-car {display: none;}
.cat-block .title a {line-height: 33px;padding-left: 40px;background-image: url("/i/lk-icons.png");background-repeat: no-repeat;height: 32px;display: block !important;float: left; color:red;}
.cat-block a {font-size: 17px;text-decoration: none;display: block;float: left;}
.cat-block div {clear: both;}.cat-block div {clear: both;}
.clear {clear: both;}
.funcdesc {padding-left: 40px;font-size: 11px;}
.lk-us {width: 100%;overflow: hidden;margin-bottom: 5px;padding-bottom: 5px;}
.lk-us div {margin-right: 2%;float: left;width: 36%;zoom: 1;}
.lk-us div a b {background: url("http://s.exist.ru/img2/user.png") left top no-repeat;width: 16px;height: 16px;display: inline-block;}
.trdBtn {background-color: #7F9DB9;border-radius: 3px;-moz-border-radius: 3px;-webkit-border-radius: 3px;padding: 2px 5px;color: #fff;border: 1px solid #526C91;}
.lk-st {display: inline-block;float: right;}
.lk-st i {background: url("http://s.exist.ru/img2/icons.png") -192px top no-repeat;width: 16px;height: 16px;display: block;float: left;margin-right: 3px;}
</style>
<div class="lk-us">
					<div>
						<a class="lk-nm" href="/cabinet/profile">
							<b></b>
							<? echo $name;?>
						</a>
						<a href="/cabinet/profile" class="lk-st trdBtn"><i></i>Настройки</a>
					</div>
					<div>
						Ваш менеджер:
						<a id="ctl00_ctl00_b_b_hlManagerName" class="linkPtr" href="#" style="padding-right:5px"><? echo $manager_mail;?></a>
					</div>
			</div>
<div style="width:75%;">
<div class="lk-c1">
			<div class="gray-form cat-block">
				<span class="drop-car">
				</span><span class="title">
					<a style="background-position:left -32px;" href="./?r=search/cart">Корзина</a></span>
				<!--<div class="funcdesc">
						Содержимое вашей виртуальной корзины.
				</div>-->
			</div>
			<!--<div class="gray-form cat-block">
				<span class="drop-car">&nbsp;</span>
				<span class="title"><a style="background-position:left -288px" href="notebook/">Записная книжка</a></span>
				<div class="funcdesc">Добавляйте найденное в каталогах в записную книжку. Срок хранения - неограничен</div>
			</div>-->
			<div class="gray-form cat-block">
				<span class="drop-car">&nbsp;</span>
				<span class="title"><a style="background-position:left -320px" href="/cabinet/stat">Взаиморасчёты</a></span>
				<!--<div class="funcdesc">Статистика работы в магазине - таблица взаиморасчётов</div>-->
			</div>
</div>
<div class="lk-c2">
			<div class="gray-form cat-block">
				<span class="drop-car">&nbsp;</span>
				<span class="title"><a href="/cabinet/orders">История заказов</a></span>
				<!--<div class="funcdesc">
					Мониторинг ваших активных заказов. Список всех ваших выполненных заказов
				</div>-->
			</div>
			<div class="gray-form cat-block">
				<span class="drop-car">
				</span><span class="title"><a href="/cabinet/retuns" style="background-position:left -160px">История Возвратов</a></span>
					<!--<div class="funcdesc">
						Мониторинг ваших возвратов. Список всех ваших возвратов
				</div>-->
			</div>
			<div class="gray-form cat-block">
				<span class="drop-car">
				</span><span class="title">
					<a href="/cabinet/balance" style="background-position:left -64px">Карточка клиента</a></span>
				<!--<div class="funcdesc">
						Состояние вашего наличного и безналичного счета
				</div>-->
			</div>
</div>
</div>
<div class="clear"></div>