function change_start (date_s,date_e,uid){
		$('#orders').html('<table class=\"CityTable\" rules=\"all\" cellpadding=\"0\" cellspacing=\"0\"><tbody><tr><td colspan=5><img src=\"images/load.gif\" alt=\"\" /></td></tr></tbody></table>');
		var url = '/cabinet/change/';
		
		$.get(
			url,
			'orders&start=' + date_s + '&end=' +date_e+ '&uid='+uid,
			function (result) {
			
			var table = '';
			var i = '1';
			$(result.sheet).each(function() {
						
				table+= '<div><input id=\"ac-'+i+'\" name=\"accordion-1\" type=\"checkbox\" /><label for=\"ac-'+i+'\"><table class=\"CityTable\" rules=\"all\" cellpadding=\"0\" cellspacing=\"0\"><thead><tr><th  style=\"width:20%\">'+$(this).attr('date')+'</th><th style=\"width:20%\">'+$(this).attr('id')+'</th><th style=\"width:20%\">'+$(this).attr('total')+' руб.</th><th style=\"width:20%\">'+$(this).attr('cheng')+'</th><th style=\"width:20%\">'+$(this).attr('status')+'</th></tr></thead></table></label><article class=\"ac-large\"><table class=\"CityTable\" rules=\"all\" cellpadding=\"0\" cellspacing=\"0\"><tbody><tr><th style=\"width:10%\">Бренд</th><th style=\"width:20%\">Артикул</th><th style=\"width:45%\">Название</th><th>Кол-во</th><th>Цена</th><th>Стоимость</th><th>Статус</th></tr>';
				
				var id = $(this).attr('id');
				$(result.type).each(function() {
					if ( $(this).attr('id') == id ){
						//table+= $(this).attr('brand')+'<br/>';
						table += '<tr><td class=\'brand\'>'+$(this).attr('brand')+'</td><td class=\'brand\'>'+$(this).attr('vendor')+'</td><td class=\'brand\'>'+$(this).attr('name')+'</td><td class=\'vend\'>'+$(this).attr('qty')+' шт.</td><td class=\'vend\'>'+$(this).attr('price')+' руб.</td><td>'+$(this).attr('amount')+' руб.</td><td class=\'vend\'>'+$(this).attr('status')+'</td></tr>';
					}
				});
				table += '</tbody></table></article></div>';
				i = i+1;
			});
					$('#orders').html(table);
			}, 'json');
	}
function change_end (date_s,date_e,uid){
		$('#orders').html('<table class=\"CityTable\" rules=\"all\" cellpadding=\"0\" cellspacing=\"0\"><tbody><tr><td colspan=5><img src=\"images/load.gif\" alt=\"\" /></td></tr></tbody></table>');
		var url = '/cabinet/change/';
		$.get(
			url,
			'orders&start=' + date_s + '&end=' +date_e+ '&uid='+uid,
			function (result) {
			
			var table = '';
			var i = '1';
			$(result.sheet).each(function() {
						
				table+= '<div><input id=\"ac-'+i+'\" name=\"accordion-1\" type=\"checkbox\" /><label for=\"ac-'+i+'\"><table class=\"CityTable\" rules=\"all\" cellpadding=\"0\" cellspacing=\"0\"><thead><tr><th  style=\"width:20%\">'+$(this).attr('date')+'</th><th style=\"width:20%\">'+$(this).attr('id')+'</th><th style=\"width:20%\">'+$(this).attr('total')+' руб.</th><th style=\"width:20%\">'+$(this).attr('cheng')+'</th><th style=\"width:20%\">'+$(this).attr('status')+'</th></tr></thead></table></label><article class=\"ac-large\"><table class=\"CityTable\" rules=\"all\" cellpadding=\"0\" cellspacing=\"0\"><tbody><tr><th style=\"width:10%\">Бренд</th><th style=\"width:20%\">Артикул</th><th style=\"width:45%\">Название</th><th>Кол-во</th><th>Цена</th><th>Стоимость</th><th>Статус</th></tr>';
				
				var id = $(this).attr('id');
				$(result.type).each(function() {
					if ( $(this).attr('id') == id ){
						//table+= $(this).attr('brand')+'<br/>';
						table += '<tr><td class=\'brand\'>'+$(this).attr('brand')+'</td><td class=\'brand\'>'+$(this).attr('vendor')+'</td><td class=\'brand\'>'+$(this).attr('name')+'</td><td class=\'vend\'>'+$(this).attr('qty')+' шт.</td><td class=\'vend\'>'+$(this).attr('price')+' руб.</td><td>'+$(this).attr('amount')+' руб.</td><td class=\'vend\'>'+$(this).attr('status')+'</td></tr>';
					}
				});
				table += '</tbody></table></article></div>';
				i = i+1;
			});
					$('#orders').html(table);
			}, 'json');
	}