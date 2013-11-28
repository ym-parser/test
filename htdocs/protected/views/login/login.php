<?php
if (isset($_POST)){
	if ($subj == 1 ){
		//header('Location: ./?p=cabinet');
	}else{?>
	<form name="SEC" action="/login" method="post">
	<table width="500" border="0" cellspacing="5" cellpadding="0" style="margin: 50px;">
		<tbody>
			<tr valign="middle" bgcolor="#EEEEEE">
				<td colspan="2"><p>Добро пожаловать на наш сервер.</p></td>
			</tr>
			<tr valign="middle">
				<td width="30%" align="right" class="ftit"><b>Логин:</b></td>
				<td width="70%"><input type="text" style="width: 150px" class="in" name="login" value="<?=$login?>"><br/><?=$subj?></td>
			</tr>
			<tr valign="middle">
				<td align="right" class="ftit"><b>Пароль:</b></td>
				<td align="left"><input type="password" style="width: 150px" class="in" name="passw" value=""><br/><?=$subj?></td>
			</tr>
			<tr valign="middle">
				<td align="right" class="ftit"><b>Условия:</b></td>
				<td class="ftxt">
					<input type="radio" name="ENT" value="1">&nbsp;вход с <b>публичного</b> компьютера<br>
					<input type="radio" name="ENT" value="2" checked="">&nbsp;вход с <b>корпоративного</b> компьютера (рекомендуется)<br>
					<input type="radio" name="ENT" value="3">&nbsp;вход с <b>личного</b> компьютера</td>
				</tr>
			<tr valign="middle" bgcolor="#EEEEEE">
				<td align="right" class="ftit">&nbsp;</td>
				<td><input type="submit" value=" войти " class="but" name="GO"></td>
			</tr>
		</tbody>
	</table>
</form>
	<?}
}