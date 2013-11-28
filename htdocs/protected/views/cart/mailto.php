<?/*
<form style="margin-top: 10px;" name="tr" id="tr" method="post">
	Почтовый ящик менеджера:<font style="color: red" color="red">(*)</font><br>
	<input style="border: 1px solid black; padding: 3px; width: 300px;" type="text" name="mailto" value="gentosh_e@mail.ru"><br>
	например: some@domain.ru<br><br>
	Ваш почтовый ящик:<font style="color: red" color="red">(*)</font><br>
	<input style="border: 1px solid black; padding: 3px; width: 300px;" type="text" name="reply" value="gentosh_t2@mail.ru"><br>
	например: me@domain.ru<br><br>
	Примечания:<font style="color: red" color="red">(*)</font><br>
	<textarea name="text" style="pading: 3px; border: 1px solid black;width: 300px;" rows="10">Гентош Е.                               
	</textarea><br>
	Поля отмеченные звездочкой <font style="color: red" color="red">(*)</font> обязательны для заполнения<br><br>
	<input type="submit" value="Отправить"/>
	</form>
	/**/?>
	
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.js"></script>
	<script type="text/javascript" src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
	<script type="text/javascript" src="/js/mailto.js"></script>
	<link type="text/css" rel="stylesheet" href="/css/mailto.css" media="all" />
	<div class="form_box">
		<form action="/cart/mailto" method="post" class="rf">
			<label for="user_name">Почтовый ящик менеджера:</label>
			<input type="text" class="rfield" name="mailto" id="user_name" />
			<p>например: some@domain.ru</p>
			<p class="msg"></p>
			<label for="user_family">Ваш почтовый ящик:</label>
			<input type="text" class="rfield" name="reply" id="user_family" />
			<p>например: me@domain.ru</p>
			<p class="msg"></p>
			<label for="user_phone">Примечания:</label>
			<textarea class="rfield" name="text" id="user_work"> </textarea>
			<input type="submit" class="btn_submit disabled" value="Отправить данные" />
		</form>
	</div>