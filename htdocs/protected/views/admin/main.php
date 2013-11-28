<td nowrap="" width="15%" bgcolor="#EEEEEE">
									<b>СИСТЕМА</b>
									<div style="margin-left:15px; margin-top: 5px; margin-bottom: 10px;">
										•&nbsp;<a href="/">На главную</a><br>
										•&nbsp;<a href="/logout/">Выход</a><br>
									</div>
									<?if ($data['admin']['role'] == '1'):?>
									<b>ПОЛЬЗОВАТЕЛИ</b>
										<div style="margin-left:15px; margin-top: 5px; margin-bottom: 10px;">
											•&nbsp;<a href="/admin/usercreate">Добавить</a><br>
											•&nbsp;<a href="/admin/users/">Список</a><br>
										</div>
									<b>ГРУППЫ</b>
										<div style="margin-left:15px; margin-top: 5px; margin-bottom: 10px;">
											•&nbsp;<a href="/adm/groups/create/">Добавить</a><br>
											•&nbsp;<a href="/adm/groups/">Список</a><br>
										</div>
									<?endif;?>
								</td>
								<td width="85%">
									[[name]]
								</td>