function change_start (date_s,date_e,uid){
	$('#returns').html('<tbody><tr><td colspan=5><img src=\"images/load.gif\" alt=\"\" /></td></tr></tbody>');
	var url = '/cabinet/change/';
	$.get(
		url,
		'&retuns&start=' + date_s + '&end=' +date_e+ '&uid='+uid,
		function (result) {
			var thead = '<table class=\"CityTable\" cellpadding=\"0\" cellspacing=\"0\" id=\"returns\"><thead><tr><th style=\"width:10%\">Дата</th><th style=\"width:10%\">Производитель</th><th style=\"width:10%\">Код</th><th style=\"width:45%\">Наименование</th><th>Кол-во</th><th>Цена</th><th>Сумма</th></tr></thead><tbody>';
			var table = '';
			var tend = '</tbody></table>';
			var i = '1';
			$(result.sheet).each(function() {
				table += '<tr><td class=\'brand\'>'+$(this).attr('date')+'</td><td class=\'brand\'>'+$(this).attr('brand')+'</td><td class=\'brand\'>'+$(this).attr('vendor')+'</td><td class=\'brand\'>'+$(this).attr('name')+'</td><td class=\'vend\'>'+$(this).attr('qty')+' шт.</td><td class=\'vend\'>'+$(this).attr('price')+' '+$(this).attr('cur')+'</td><td class=\'vend\'>'+$(this).attr('amount')+' '+$(this).attr('cur')+'</td></tr>';
			});
			$('#returns').html(thead+table+tend);
		}, 'json');
}
function change_end (date_s,date_e,uid){
		$('#returns').html('<table class=\"CityTable\" rules=\"all\" cellpadding=\"0\" cellspacing=\"0\"><tbody><tr><td colspan=5><img src=\"images/load.gif\" alt=\"\" /></td></tr></tbody></table>');
		var url = '/cabinet/change/';
		$.get(
			url,
			'retuns&start=' + date_s + '&end=' +date_e+ '&uid='+uid,
			function (result) {
				var thead = '<table class=\"CityTable\" rules=\"all\" cellpadding=\"0\" cellspacing=\"0\" id=\"returns\"><thead><tr><th style=\"width:10%\">Дата</th><th style=\"width:10%\">Производитель</th><th style=\"width:10%\">Код</th><th style=\"width:45%\">Наименование</th><th>Кол-во</th><th>Цена</th><th>Сумма</th></tr></thead><tbody>';
				var table = '';
				var tend = '</tbody></table>';
				var i = '1';
				$(result.sheet).each(function() {
					table += '<tr><td class=\'brand\'>'+$(this).attr('date')+'</td><td class=\'brand\'>'+$(this).attr('brand')+'</td><td class=\'brand\'>'+$(this).attr('vendor')+'</td><td class=\'brand\'>'+$(this).attr('name')+'</td><td class=\'vend\'>'+$(this).attr('qty')+' шт.</td><td class=\'vend\'>'+$(this).attr('price')+' '+$(this).attr('cur')+'</td><td class=\'vend\'>'+$(this).attr('amount')+' '+$(this).attr('cur')+'</td></tr>';
				});
				$('#returns').html(thead+table+tend);
			}, 'json');
}