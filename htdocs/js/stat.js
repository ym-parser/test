function number_format( number, decimals, dec_point, thousands_sep ) {	// Format a number with grouped thousands
	// 
	// +   original by: Jonas Raoni Soares Silva (http://www.jsfromhell.com)
	// +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
	// +	 bugfix by: Michael White (http://crestidg.com)

	var i, j, kw, kd, km;

	// input sanitation & defaults
	if( isNaN(decimals = Math.abs(decimals)) ){
		decimals = 2;
	}
	if( dec_point == undefined ){
		dec_point = ",";
	}
	if( thousands_sep == undefined ){
		thousands_sep = ".";
	}

	i = parseInt(number = (+number || 0).toFixed(decimals)) + "";

	if( (j = i.length) > 3 ){
		j = j % 3;
	} else{
		j = 0;
	}

	km = (j ? i.substr(0, j) + thousands_sep : "");
	kw = i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thousands_sep);
	//kd = (decimals ? dec_point + Math.abs(number - i).toFixed(decimals).slice(2) : "");
	kd = (decimals ? dec_point + Math.abs(number - i).toFixed(decimals).replace(/-/, 0).slice(2) : "");


	return km + kw + kd;
}

function change_start (date_s,date_e,uid){
/*var date_s = this.value;
		var date_e = $('#end').val();
		var uid = '".$user_id."';*/
		$('#gvData').html('<tr><td colspan=5>Загрузка...</td></tr>');
		var url = '/cabinet/change/';
		
		$.get(
			url,
			'stat&start=' + date_s + '&end=' +date_e+ '&uid='+uid,
			function (result) {
			var head = '<thead><tr class=\"trh\"><th class=\"header\">Дата</th><th class=\"header\">Время</th><th class=\"header\">Номер накладной</th><th class=\"header\">Операция</th><th class=\"header\">Расчет</th><th class=\"header\">Сумма</th><th class=\"header\">Промежуточные итоги</th></tr></thead>';
			var pay_it1 = '<tr><th class=\"header\" scope=\"col\"></th><th class=\"header\" scope=\"col\"></th><th class=\"header\" scope=\"col\"></th><th class=\"header\" scope=\"col\"></th><th class=\"header\" scope=\"col\" style=\"text-align:right;\"><span>Итого оплачено:</span></th><th class=\"header\" scope=\"col\" style=\"text-align:right;\">';
			var pay_it2 =' руб.</span></th></tr>';
			var otg_it1 = '<tr><th class=\"header\" scope=\"col\"></th><th class=\"header\" scope=\"col\"></th><th class=\"header\" scope=\"col\"></th><th class=\"header\" scope=\"col\"></th><th class=\"header\" scope=\"col\" style=\"text-align:right;\"><span>Итого отгружено:</span></th><th class=\"header\" scope=\"col\" style=\"text-align:right;\">';
			var otg_it2 =' руб.</span></th></tr>';
			var all_it1 = '<tr><th class=\"header\" scope=\"col\"></th><th class=\"header\" scope=\"col\"><th class=\"header\" scope=\"col\"></th></th><th class=\"header\" scope=\"col\"></th><th class=\"header\" scope=\"col\" style=\"text-align:right;\"><span>Общий итог:</span></th><th class=\"header\" scope=\"col\" style=\"text-align:right;\">';
			var all_it2 =' руб.</span></th></tr>';
			var tot_p = '';
			var tot_o = '';
			var tot_v = '';
			var tot_a = '';
			//var thead = '<colgroup></colgroup>';
			var tbody = '<tbody id=\"sheets\">';
			var tbody1 = '';
			var tbody2 = '';
			var nom = '';
			var potgr ='';
			var tend = '</tbody></table>';
			if (result.type == 'none') {
				tbody += '<tr><td colspan=\"5\">За выбранный период взаиморасчетов не было</td></tr>';
			} else {
				var bal ='';
				var p = '';
				$(result.full).each(function() {
						if ($(this).attr('code') =='Получено'){
							tbody += '<tr onclick=\"window.open(\'download.php?docid='+$(this).attr('docid')+'\');\" class=\"emptydaterow\" align=\"center\" style=\"background-color:LightGrey;font-weight:bold;height:40px;\"><td>'+$(this).attr('date')+'</td><td>'+$(this).attr('time')+'</td><td>'+$(this).attr('nomnak')+'</td><td><div style=\"width:110px;text-align:left;\">'+$(this).attr('code')+'</div></td><td><div style=\"width:110px;text-align:left;\">'+$(this).attr('payment')+'</div></td><td><div style=\"width:110px;text-align:left;\">'+$(this).attr('amount')+'</div></td><td>'+$(this).attr('prom')+' руб.</td></tr>';
							nom = 'Взаиморасчеты('+$(this).attr('nom_s')+')';
						}else if ($(this).attr('code') == 'Оплачено'){
							tbody += '<tr class=\"emptydaterow\" align=\"center\" style=\"background-color:LightGrey;font-weight:bold;height:40px;\"><td>'+$(this).attr('date')+'</td><td>'+$(this).attr('time')+'</td><td>'+$(this).attr('nomnak')+'</td><td><div style=\"width:110px;text-align:left;\">'+$(this).attr('code')+'</div></td><td><div style=\"width:110px;text-align:left;\">'+$(this).attr('payment')+'</div></td><td><div style=\"width:110px;text-align:left;\">'+$(this).attr('amount')+'</div></td><td>'+$(this).attr('prom')+' руб.</td></tr>';
							nom = 'Взаиморасчеты('+$(this).attr('nom_s')+')';
						}else if ($(this).attr('code') == 'Возврат'){
							tbody += '<tr class=\"emptydaterow\" align=\"center\" style=\"background-color:LightGrey;font-weight:bold;height:40px;\"><td>'+$(this).attr('date')+'</td><td>'+$(this).attr('time')+'</td><td>'+$(this).attr('nomnak')+'</td><td><div style=\"width:110px;text-align:left;\">'+$(this).attr('code')+'</div></td><td><div style=\"width:110px;text-align:left;\">'+$(this).attr('payment')+'</div></td><td><div style=\"width:110px;text-align:left;\">'+$(this).attr('amount')+'</div></td><td>'+$(this).attr('prom')+' руб.</td></tr>';
							nom = 'Взаиморасчеты('+$(this).attr('nom_s')+')';
						}
						//tot_o = $(this).attr('total');
						if ($(this).attr('it_pay') !== undefined) {
							p = $(this).attr('it_pay');
							tot_p = p;
						}
						bal = $(this).attr('balance');
						if ( bal == null){
							bal = 0;
						}
						//tot_o = $(this).attr('it_otg');
						if ($(this).attr('it_otg') !== undefined) {
							p = $(this).attr('it_otg');
							tot_o = p;
						}
						
						if ($(this).attr('it_vozv') !== undefined) {
							p = $(this).attr('it_vozv');
							tot_v = p;
						}
						$('#balance_s').html('Баланс на начало периода: '+bal+' руб.');
						tot_a = $(this).attr('balance');
						
					});
			}
					var itogs = '';
					tot_p = Math.round(tot_p*100)/100;
					//tot_p = Math.round(tot_p*100)/100;
					tot_p = Math.round(tot_p*100)/100;
					tot_o = Math.round(tot_o*100)/100;
					tot_v = Math.round(tot_v*100)/100;
					tot_a = tot_p + tot_o + tot_v + Math.round(bal*100)/100;
					//tot_a = tot_a + tot_v;
					tot_a = Math.round(tot_a*100)/100;
					itogs = '</tbody><tbody><tr><th class=\"header\" colspan=\"6\" style=\"text-align:right;\">Итого оплачено:</th><th class=\"header\">'+number_format(tot_p, 2, '.', '')+' руб.</th></tr><tr><th class=\"header\" colspan=\"6\" style=\"text-align:right;\">Итого отгружено:</th><th class=\"header\">'+number_format(tot_o, 2, '.', '')+' руб.</th></tr><tr><th class=\"header\" colspan=\"6\" style=\"text-align:right;\">Итого возвращено:</th><th class=\"header\">'+number_format(tot_v, 2, '.', '')+' руб.</th></tr><tr><th class=\"header\" colspan=\"6\" style=\"text-align:right;\">Общий итог:</th><th class=\"header\">'+number_format(tot_a, 2, '.', '')+' руб.</th></tr>';
					$('#hlHistory').html(nom);
					//$('#gvData').html(thead+head+tbody+itogs+tend);
					$('#gvData').html('');
					$('#gvData').append(head+tbody+itogs+tend); // сообщаем плагину, что нужно обновить отображение 
					$('#gvData').trigger('update'); 
			}, 'json');
}
function change_end (date_s,date_e,uid){
		$('#gvData').html('<tr><td colspan=5>Загрузка...</td></tr>');
		var url = '/cabinet/change/';
		
		$.get(
			url,
			'&stat&start==' + date_s + '&end=' +date_e+ '&uid='+uid,
			function (result) {
			var head = '<thead><tr class=\"trh\"><th class=\"header\">Дата</th><th class=\"header\">Время</th><th class=\"header\">Номер накладной</th><th class=\"header\">Операция</th><th class=\"header\">Расчет</th><th class=\"header\">Сумма</th><th class=\"header\">Промежуточные итоги</th></tr></thead>';
			var pay_it1 = '<tr><th class=\"header\" scope=\"col\"></th><th class=\"header\" scope=\"col\"></th><th class=\"header\" scope=\"col\"></th><th class=\"header\" scope=\"col\"></th><th class=\"header\" scope=\"col\" style=\"text-align:right;\"><span>Итого оплачено:</span></th><th class=\"header\" scope=\"col\" style=\"text-align:right;\">';
			var pay_it2 =' руб.</span></th></tr>';
			var otg_it1 = '<tr><th class=\"header\" scope=\"col\"></th><th class=\"header\" scope=\"col\"></th><th class=\"header\" scope=\"col\"></th><th class=\"header\" scope=\"col\"></th><th class=\"header\" scope=\"col\" style=\"text-align:right;\"><span>Итого отгружено:</span></th><th class=\"header\" scope=\"col\" style=\"text-align:right;\">';
			var otg_it2 =' руб.</span></th></tr>';
			var all_it1 = '<tr><th class=\"header\" scope=\"col\"></th><th class=\"header\" scope=\"col\"><th class=\"header\" scope=\"col\"></th></th><th class=\"header\" scope=\"col\"></th><th class=\"header\" scope=\"col\" style=\"text-align:right;\"><span>Общий итог:</span></th><th class=\"header\" scope=\"col\" style=\"text-align:right;\">';
			var all_it2 =' руб.</span></th></tr>';
			var tot_p = '';
			var tot_o = '';
			var tot_v = '';
			var tot_a = '';
			//var thead = '<colgroup></colgroup>';
			var tbody = '<tbody id=\"sheets\">';
			var tbody1 = '';
			var tbody2 = '';
			var nom = '';
			var potgr ='';
			var tend = '</tbody></table>';
			if (result.type == 'none') {
				tbody += '<tr><td colspan=\"5\">За выбранный период взаиморасчетов не было</td></tr>';
			} else {
				var bal ='';
				var p = '';
				$(result.full).each(function() {
						if ($(this).attr('code') =='Получено'){
							tbody += '<tr onclick=\"window.open(\'download.php?docid='+$(this).attr('docid')+'\');\" class=\"emptydaterow\" align=\"center\" style=\"background-color:LightGrey;font-weight:bold;height:40px;\"><td>'+$(this).attr('date')+'</td><td>'+$(this).attr('time')+'</td><td>'+$(this).attr('nomnak')+'</td><td><div style=\"width:110px;text-align:left;\">'+$(this).attr('code')+'</div></td><td><div style=\"width:110px;text-align:left;\">'+$(this).attr('payment')+'</div></td><td><div style=\"width:110px;text-align:left;\">'+$(this).attr('amount')+'</div></td><td>'+$(this).attr('prom')+' руб.</td></tr>';
							nom = 'Взаиморасчеты('+$(this).attr('nom_s')+')';
						}else if ($(this).attr('code') == 'Оплачено'){
							tbody += '<tr class=\"emptydaterow\" align=\"center\" style=\"background-color:LightGrey;font-weight:bold;height:40px;\"><td>'+$(this).attr('date')+'</td><td>'+$(this).attr('time')+'</td><td>'+$(this).attr('nomnak')+'</td><td><div style=\"width:110px;text-align:left;\">'+$(this).attr('code')+'</div></td><td><div style=\"width:110px;text-align:left;\">'+$(this).attr('payment')+'</div></td><td><div style=\"width:110px;text-align:left;\">'+$(this).attr('amount')+'</div></td><td>'+$(this).attr('prom')+' руб.</td></tr>';
							nom = 'Взаиморасчеты('+$(this).attr('nom_s')+')';
						}else if ($(this).attr('code') == 'Возврат'){
							tbody += '<tr class=\"emptydaterow\" align=\"center\" style=\"background-color:LightGrey;font-weight:bold;height:40px;\"><td>'+$(this).attr('date')+'</td><td>'+$(this).attr('time')+'</td><td>'+$(this).attr('nomnak')+'</td><td><div style=\"width:110px;text-align:left;\">'+$(this).attr('code')+'</div></td><td><div style=\"width:110px;text-align:left;\">'+$(this).attr('payment')+'</div></td><td><div style=\"width:110px;text-align:left;\">'+$(this).attr('amount')+'</div></td><td>'+$(this).attr('prom')+' руб.</td></tr>';
							nom = 'Взаиморасчеты('+$(this).attr('nom_s')+')';
						}
						//tot_o = $(this).attr('total');
						if ($(this).attr('it_pay') !== undefined) {
							p = $(this).attr('it_pay');
							tot_p = p;
						}
						bal = $(this).attr('balance');
						if ( bal == null){
							bal = 0;
						}
						//tot_o = $(this).attr('it_otg');
						if ($(this).attr('it_otg') !== undefined) {
							p = $(this).attr('it_otg');
							tot_o = p;
						}
						
						if ($(this).attr('it_vozv') !== undefined) {
							p = $(this).attr('it_vozv');
							tot_v = p;
						}
						$('#balance_s').html('Баланс на начало периода: '+bal+' руб.');
						tot_a = $(this).attr('balance');
					});
			}
					var itogs = '';
					tot_p = Math.round(tot_p*100)/100;
					//tot_p = Math.round(tot_p*100)/100;
					tot_p = Math.round(tot_p*100)/100;
					tot_o = Math.round(tot_o*100)/100;
					tot_v = Math.round(tot_v*100)/100;
					tot_a = tot_p + tot_o + tot_v + Math.round(bal*100)/100;
					//tot_a = tot_a + tot_v;
					tot_a = Math.round(tot_a*100)/100;
					itogs = '</tbody><tbody><tr><th class=\"header\" colspan=\"6\" style=\"text-align:right;\">Итого оплачено:</th><th class=\"header\">'+number_format(tot_p, 2, '.', '')+' руб.</th></tr><tr><th class=\"header\" colspan=\"6\" style=\"text-align:right;\">Итого отгружено:</th><th class=\"header\">'+number_format(tot_o, 2, '.', '')+' руб.</th></tr><tr><th class=\"header\" colspan=\"6\" style=\"text-align:right;\">Итого возвращено:</th><th class=\"header\">'+number_format(tot_v, 2, '.', '')+' руб.</th></tr><tr><th class=\"header\" colspan=\"6\" style=\"text-align:right;\">Общий итог:</th><th class=\"header\">'+number_format(tot_a, 2, '.', '')+' руб.</th></tr>';
					$('#hlHistory').html(nom);
					//$('#gvData').html(thead+head+tbody+itogs+tend);
					$('#gvData').html('');
					$('#gvData').append(head+tbody+itogs+tend); // сообщаем плагину, что нужно обновить отображение 
					$('#gvData').trigger('update'); 
			}, 'json');
	}