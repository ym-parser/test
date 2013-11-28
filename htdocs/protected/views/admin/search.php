<td nowrap="" width="15%" bgcolor="#EEEEEE">
	<b>ПОИСК</b>
	<div style="margin-left:15px; margin-top: 5px; margin-bottom: 10px;">
		•&nbsp;<a href="/admin/#/search"><b>Аналитика поиска</b></a><br>
		•&nbsp;<a href="/admin/#/search/brands">Синонимы брендов</a><br>
		•&nbsp;<a href="/admin/#/search/sklad">Аналитика склада</a><br>
		•&nbsp;<a href="/admin/#/search/price">Аналитика прайсов</a><br>
	</div>
</td><td width="85%">
	<style>
	div.code {
		margin: 20px 10px;
		border: 1px solid #969696;
	}

	div.code div {
		border-bottom: 1px solid #969696;
		background-color: #585858;
		color: #ffffff;
		padding: 4px;
		cursor: pointer;
	}


	/* TABLEEEE */
	table.result-table {
		border-collapse: collapse;
		border: 0px solid #666666;
		font: normal 11px verdana, arial, helvetica, sans-serif;
		color: #363636;
		background: #f6f6f6;
		text-align:left;
		/*width: 100%;*/
	}
	.result-table caption {
		text-align: center;
		font: bold 16px arial, helvetica, sans-serif;
		background: transparent;
		padding:6px 4px 8px 0px;
		color: #CC00FF;
		text-transform: uppercase;
	}
	.result-table thead, tfoot {
		background:url(bg1.png) repeat-x;
		text-align:left;
		height:30px;
	}
	.result-table thead th, tfoot th {
		background-color: #666666;
		color: #ffffff;
		padding:5px;
	}
	table.result-table a {
		color: #333333;
		text-decoration:none;
		font-weight: bold;
	}
	table.result-table a:hover {
		text-decoration:underline;
	}
	.result-table tr.odd, .result-table tr:nth-child(2n) {
		background: #dadada;
	}
	.result-table tbody th, tbody td {
		padding:5px;
	}
	.result-table td.bottom {
		border: 0px;
		background: #FFF;
		text-align: left;
		padding-top: 10px;
	}
	</style>
	<div width="100%" style="background-color: #EEEEEE; margin-bottom:10px; padding:10px">
	<center><b><font color="#003366">Аналитика поиска</font></b></center>
	</div>
	<table width="100%" cellspacing="0" cellpadding="5" border="0">
		<tbody>
			<tr bgcolor="#99CCFF">
				<td width="30%" class="ftit"><b>НАЙТИ:</b></td>
				<td class="ftxt"><input name="Q" type="text" class="sel" ng-model='search'/>&nbsp;<button ng-click="ShowOriginals(search)">Найти</button></td>
			</tr>
		</tbody>
	</table>
	<div class='code'>
		<div>отладка</div>
		[[result]]
	</div>
	<table style="border: 1px solid black;" cellspacing="5" class="result-table">
		<thead>
			<tr>
				<th>id</th>
				<th>bra_or</th>
				<th>code</th>
				<th>search_code</th>
				<th>brand_id</th>
				<th>description</th>
				<th>brand</th>
				<th>original</th>
				<th>link</th>
				<th>link2</th>
			</tr>
		</thead>
		<tbody >
		<tbody ng-repeat="or in originals">
			<tr>
				<td>[[or.id]]</td>
				<td></td>
				<td>[[or.code]]</td>
				<td>[[or.search_code]]</td>
				<td>[[or.brand_id]]</td>
				<td>[[or.description]]</td>
				<td>[[or.brand]]</td>
				<td>[[or.original]]</td>
				<td><a href="/admin/#/search/analitik/[[or.search_code]]/[[or.brand_id]]">Анализ поиска</a></td>
				<td><!--<a href="/adm/analitik/cross/?art_id=1372372&art=OC264&brand=34">-->Анализ кроссировок<!--</a>--></td>
				</tr>
		</tbody>
	</table>
	
	<div class="code">
	<div>показать запрос<input ng-model="show" type="checkbox"><h5>Отправили запрос в базу:</h5></div><pre ng-show='show'></pre>
	</div>
</td>
