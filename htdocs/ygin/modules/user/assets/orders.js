function change_start (date_s,date_e,uid){
		$('#orders').html('<table class="CityTable" rules="all" cellpadding="0" cellspacing="0"><tbody><tr><td colspan=5><img src="images/load.gif" alt="" /></td></tr></tbody></table>');
		var url = '/user/change/orders';
		$.get(url,'start=' + date_s + '&end=' +date_e+ '&uid='+uid,
			function (result) {
			var table = '';
			var i = '1';
			$(result.sheet).each(function() {
				table+= getHead(i,$(this).attr('date'),$(this).attr('id'),$(this).attr('total'),$(this).attr('cheng'),$(this).attr('status'));
				var id = $(this).attr('id');
				$(result.type).each(function() {
					if ( $(this).attr('id') == id ){
						table += getBody($(this).attr('brand'),$(this).attr('vendor'),$(this).attr('name'),$(this).attr('qty'),$(this).attr('price'),$(this).attr('amount'),$(this).attr('status'));
					}
				});
				table += '</tbody></table></div></div>';
				i = i+1;
			});
					$('#orders').html(table);
			}, 'json');
	}
function change_end (date_s,date_e,uid){
		$('#orders').html('<table class="CityTable" rules="all" cellpadding="0" cellspacing="0"><tbody><tr><td colspan=5><img src="images/load.gif" alt="" /></td></tr></tbody></table>');
		var url = '/user/change/orders';
		$.get(
			url,'start=' + date_s + '&end=' +date_e+ '&uid='+uid,function (result) {
			var table = '';
			var i = '1';
			$(result.sheet).each(function() {
				table+= getHead(i,$(this).attr('date'),$(this).attr('id'),$(this).attr('total'),$(this).attr('cheng'),$(this).attr('status'));
				var id = $(this).attr('id');
				$(result.type).each(function() {
					if ( $(this).attr('id') == id ){
						table += getBody($(this).attr('brand'),$(this).attr('vendor'),$(this).attr('name'),$(this).attr('qty'),$(this).attr('price'),$(this).attr('amount'),$(this).attr('status'));
					}
				});
				table += '</tbody></table></div></div>';
				i = i+1;
			});
					$('#orders').html(table);
			}, 'json');
	}
function getHead(i,date,id,total,cheng,status){
	var head = '<div>\
					<input id="ac-'+i+'" name="accordion-1" type="checkbox" />\
						<label for="ac-'+i+'">\
							<table class="CityTable" rules="all" cellpadding="0" cellspacing="0">\
								<thead>\
									<tr><th style="width:20%">'+date+'</th>\
									<th style="width:20%">'+id+'</th>\
									<th style="width:20%">'+total+' руб.</th>\
									<th style="width:20%">'+cheng+'</th>\
									<th style="width:20%">'+status+'</th>\
									</tr>\
								</thead>\
							</table>\
						</label>\
					<div id="article" class="ac-large">\
					<table class="CityTable" rules="all" cellpadding="0" cellspacing="0">\
						<tbody>\
						<tr><th style="width:10%">Бренд</th>\
							<th style="width:20%">Артикул</th>\
							<th style="width:45%">Название</th>\
							<th>Кол-во</th><th>Цена</th>\
							<th>Стоимость</th>\
							<th>Статус</th></tr>';
	return head;
}
function getBody(brand,vendor,name,qty,price,amount,status){
	var body = '<tr>\
							<td class=\'brand\'>'+brand+'</td>\
							<td class=\'brand\'>'+vendor+'</td>\
							<td class=\'brand\'>'+name+'</td>\
							<td class=\'vend\'>'+qty+' шт.</td>\
							<td class=\'vend\'>'+price+' руб.</td>\
							<td>'+amount+' руб.</td>\
							<td class=\'vend\'>'+status+'</td></tr>';
	return body;
}