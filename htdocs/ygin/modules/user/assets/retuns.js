function change_start (date_s,date_e,uid){
	$('#returns').html('<tbody><tr><td colspan=5><img src=\"images/load.gif\" alt=\"\" /></td></tr></tbody>');
	var url = '/user/change/retuns/';
	$.get(
		url,'start=' + date_s + '&end=' +date_e+ '&uid='+uid,
		function (result) {
			var thead = getTHead()
			var table = '';
			var tend = '</tbody></table>';
			var i = '1';
			$(result.sheet).each(function() {
				table += getTbody($(this).attr('date'),$(this).attr('brand'),$(this).attr('vendor'),$(this).attr('name'),$(this).attr('qty'),$(this).attr('price'),$(this).attr('cur'),$(this).attr('amount'))
			});
			$('#returns').html(thead+table+tend);
		}, 'json');
}
function change_end (date_s,date_e,uid){
		$('#returns').html('<table class=\"CityTable\" rules=\"all\" cellpadding=\"0\" cellspacing=\"0\"><tbody><tr><td colspan=5><img src=\"images/load.gif\" alt=\"\" /></td></tr></tbody></table>');
		var url = '/user/change/retuns/';
		$.get(url,'start=' + date_s + '&end=' +date_e+ '&uid='+uid,
			function (result) {
				var thead = getTHead()
				var table = '';
				var tend = '</tbody></table>';
				var i = '1';
				$(result.sheet).each(function() {
					table += getTbody($(this).attr('date'),$(this).attr('brand'),$(this).attr('vendor'),$(this).attr('name'),$(this).attr('qty'),$(this).attr('price'),$(this).attr('cur'),$(this).attr('amount'))
				});
				$('#returns').html(thead+table+tend);
			}, 'json');
}
function getTHead (){
	thead = '<table class=\"CityTable\" cellpadding=\"0\" cellspacing=\"0\" id=\"returns\"><thead><tr>\
							<th style=\"width:10%\">Дата</th>\
							<th style=\"width:10%\">Производитель</th>\
							<th style=\"width:10%\">Код</th>\
							<th style=\"width:45%\">Наименование</th>\
							<th>Кол-во</th><th>Цена</th><th>Сумма</th>\
						</tr></thead><tbody>'
	return thead
}
function getTbody(date,brand,vendor,name,qty,price,cur,amount){
	tbody = '<tr>\
							<td class=\'brand\'>'+date+'</td>\
							<td class=\'brand\'>'+brand+'</td>\
							<td class=\'brand\'>'+vendor+'</td>\
							<td class=\'brand\'>'+name+'</td>\
							<td class=\'vend\'>'+qty+' шт.</td>\
							<td class=\'vend\'>'+price+' '+cur+'</td>\
							<td class=\'vend\'>'+amount+' '+cur+'</td>\
						</tr>'
	return tbody
}