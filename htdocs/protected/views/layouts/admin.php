<!DOCTYPE html>
<html lang="en" ng-app="adminka">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>RUSIMPORT - Администрирование - Сессии</title>
	<script src="/js/angular/lib/angular.js"></script>
	<script src="/js/angular/lib/angular-resource.js"></script>
	<script src="/js/app.js"></script>
	<script src="/js/controllers.js"></script>
	<link rel="stylesheet" type="text/css" media="all" href="/css/admin.css">
</head>
<body>
	<table width="100%" height="100%" cellspacing="0" cellpadding="0" border="0">
		<tbody>
			<tr>
				<td>
					<table width="100%" cellspacing="0" cellpadding="10" border="0" bgcolor="#003366">
						<tbody>
							<tr valign="top">
								<td width="100%">
									<table>
										<tbody>
											<tr>
												<td><a href="/admin/" class="topmnu"><b>Система</b></a></td>
												<td>|</td>
												<td><a href="/admin/#/search" class="topmnu"><b>Аналитика поиска</b></a></td>
												<td>|</td>
												<td><a href="/admin/#/sklads" class="topmnu"><b>Склады</b></a></td>
												<td>|</td>
												<td><a href="/admin/#/baners" class="topmnu"><b>Банеры</b></a></td>
												<td>|</td>
												<td><a href="/admin/#brands" class="topmnu"><b>Бренды</b></a></td>
												<td>|</td>
											</tr>
										</tbody>
									</table>
								</td>
								<td nowrap=""><font color="white"><?=$data['admin']['login']?> • <?=$data['admin']['name']?> • <?=date('Y.m.d')?></font></td>
							</tr>
						</tbody>
					</table>
				</td>
			</tr>
			<tr>
				<td height="100%">
					<table width="100%" height="100%" cellspacing="0" cellpadding="10" border="0">
						<tbody>
							<tr valign="top" ng-view>
							</tr>
						</tbody>
					</table>
				</td>
			</tr>
			<tr>
				<td align="center" bgcolor="#003366"><div style="margin: 5px"><font color="white">OOPS™ v 9.2 ((RUSIMPORT EDITION)) | 2000-2008 © 440hz™</font></div></td>
			</tr>
		</tbody>
	</table>
	</body>
</html>