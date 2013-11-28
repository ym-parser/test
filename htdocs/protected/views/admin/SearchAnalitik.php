<td nowrap="" width="15%" bgcolor="#EEEEEE">
	<b>ПОИСК</b>
	<div style="margin-left:15px; margin-top: 5px; margin-bottom: 10px;">
		•&nbsp;<a href="/admin/#/search"><b>Аналитика поиска</b></a><br>
		•&nbsp;<a href="/admin/#/search/brands">Синонимы брендов</a><br>
		•&nbsp;<a href="/admin/#/search/sklad">Аналитика склада</a><br>
		•&nbsp;<a href="/admin/#/search/price">Аналитика прайсов</a><br>
	</div>
</td>
<td width="85%">
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
	<center><b><font color="#003366">Анализируем поисковой запрос: search_code=[[str]] bra_id=[[brandId]]</font></b></center>
</div>
<div class='code'>
	<div>показать запрос<input ng-model="show" type="checkbox"><h5>Отладка:</h5></div>
	<pre ng-show='show'>[[result]]</pre>
</div>
	<h3>Текдок</h3>
		<h4>Поиск Оригинального номера в лукапе</h4>
			<table style="border: 1px solid black;" cellspacing="5" class="result-table">
						<thead>
						<tr>
							<th>code</th>
							<th>brand_id</th>
							<th>bra_brand</th>
						</tr>
						</thead>
						<tbody ng-repeat='on in original_numbers'>
							<tr>
								<td>[[on.code]]</td>
								<td>[[on.brand_id]]</td>
								<td>[[on.bra_brand]]</td>
							</tr>
						</tbody>
			</table>
			<div class='code'>
				<div>показать запрос<input ng-model="show2" type="checkbox"><h5>SQL-Запрос:</h5></div>
				<pre ng-show='show2'>[[result]]</pre>
			</div>
			<h4>Поиск кроссов на найденные оригиналы в текдоке</h4>
			<table style="border: 1px solid black;" cellspacing="5" class="result-table">
				<thead>
					<tr>
						<th>look_id</th>
						<th>art_id</th>
						<th>art_article_nr</th>
						<th>bra_brand</th>
						<th>bra_cat</th>
						<th>art_complete_des</th>
						<th>art_sup_id</th>
						<th>original_code</th>
						<th>original_brand</th>
						<th>arl_kind</th>
						<th>Использование связи</th>
					</tr>
				</thead>
				<tbody ng-repeat='td in tecdok_cross'>
						<tr>
							<td>[[td.look_id]]</td>
							<td>[[td.art_id]]</td>
							<td>[[td.art_article_nr]]</td>
							<td>[[td.bra_brand]]</td>
							<td>[[td.bra_cat]]</td>
							<td>[[td.art_complete_des]]</td>
							<td>[[td.art_sup_id]]</td>
							<td>[[td.original_code]]</td>
							<td>[[td.original_brand]]</td>
							<td>[[td.arl_kind]]</td>
							<td>[[td.use]] <input type="checkbox" ng-click='changUse("[[$index]]")'></td>
						</tr>
				</tbody>
			</table>
			<div class='code'>
				<div>показать запрос<input ng-model="show3" type="checkbox"><h5>SQL-Запрос:</h5></div>
				<pre ng-show='show3'>[[result]]</pre>
			</div>
			<h4>Полученные детали проверяем на наличие в номенклатуре Рика:</h4>
			<table style="border: 1px solid black;" cellspacing="5" class="result-table">
				<thead>
					<tr>
						<th>Код в Учёте</th>
						<th>bra_id</th>
						<th>brand</th>
						<th>search_code</th>
						<th>name</th>
					</tr>
				</thead>
				<tbody ng-repeat='rik in rik_sklad'>
					<tr>
						<td>[[rik.code]]</td>
						<td>[[rik.brand]]</td>
						<td></td>
						<td>[[rik.linecode]]</td>
						<td>[[rik.name]]</td>
					</tr>
				</tbody>
			</table>
			<h4>Объединенные результаты по Альт+7 и деталей на складе Рика:</h4>
			<table style="border: 1px solid black;" cellspacing="5" class="result-table">
				<thead>
					<tr>
						<th>Код в Учёте</th>
						<th>brand</th>
						<th>code</th>
						<th>name</th>
						<th>Найдено через код</th>
					</tr>
				</thead>
				<tbody ng-repeat='alt in rik_alt'>
					<tr>
						<td>[[alt.code]]</td>
						<td>[[alt.cname]][[alt.brand]]</td>
						<td>[[alt.linecode]]</td>
						<td>[[alt.name]]</td>
						<td>[[alt.etalon]]</td>
					</tr>
				</tbody>
			</table>
</td>