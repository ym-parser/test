function GetCatalog(id,mod){
		url = '/catalog/mainJson/?mfaId='+id+'&modId='+mod
	$.getJSON(url,function(data){
		li_brands =''
			$.each(data.manufacturers, function(i, item){      
				li_brands += getBrands(item);
			})
			if (data.models){
				li_models = '<li class="selected"><a class="selected"><span>Выбрать серию</span></a></li>'
				$.each(data.models, function(i, item){
					li_models+=getModels(item)
				})
				$('#modelsList').html(li_models)
			}
			if (data.types){
				tr_types ='<tr>\
                        <th>Модификация</th>\
                        <th width="220">Период выпуска</th>\
                        <th width="70">Мощность</th>\
                        <th width="70">Объем</th>\
                    </tr>'
				$.each(data.types, function(i, item){
					tr_types+=getTypes(item)
				})
				$('#typesList').html(tr_types)
			}
			$('#catsList').html(li_brands)
		}
	);
}
function GetTree(typId,node){
	url = '/catalog/treeJson/?typId='+typId+'&node='+node
	$.getJSON(url,function(data){
			tr ='';
			$.each(data.result, function(i, item){      
				tr += getNodes(typId,item);
			})
			$('#nodeLists').html(tr)
			if (data.RIK){
				table = '<tbody>\
				<tr>\
					<th class="first">Артикул</th>\
					<th class="other left">Наименование</th>\
					<th class="other">Цена</th>\
					<th>&nbsp;</th>\
				</tr>'
				$.each(data.RIK, function(i, item){
					table += getGoods(typId,item)
				})
				table += '</tbody>'
				$('#crosses-simple').html(table)
			}
		}
	);
}
function getBrands(brand){
	li ='';
	li +='<li>\
			<a href="/catalog/main/'+brand.mfa_id+'">\
				<img src="http://laf24.ru/i/logotypes/num/'+brand.mfa_id+'.png" alt="'+brand.mfa_brand+'">\
				<span>'+brand.mfa_brand+'</span>\
			</a>\
		</li>'
	return li
}
function getModels(model){
	li=''
	li +='<li>\
			<a class="sublink " href="/catalog/main/'+model.mod_mfa_id+'/'+model.mod_id+'">\
				<span>'+model.mod_name+' ('+model.period+')</span>\
			</a>\
		</li>';
	return li
}
function getTypes(type){
	tr=''
	tr +='<tr>\
			<td><a href="/catalog/tree/'+type.typ_id+'">'+type.typ_cds+'</a></td>\
			<td>'+type.period+'</td>\
			<td>'+type.typ_hp_from+' лс</td>\
			<td>'+type.typ_ccm+' см<sup>3<sup></td>\
		</tr>'
	return tr
}
function getNodes(typId,node){
	tr =''
	if (node.goodscount == 0){
		style = 'empty'
	}else{
		style = ''
	}
	tr += '<tr>\
				<td><span class="module"><a href="/catalog/tree/'+typId+'/'+node.str_id+'" class="'+style+'">'+node.str_des+'</a></span></td>\
			</tr>';
	return tr
}
function getGoods(typId,good){
	tr = ''
	tr += '<tr class="cat1item ">\
					<td class="first"><a target="_blank" class="blacklink" href="#-'+good.linecode+'/'+good.brand+'/">'+good.linecode+'</a><p>'+good.brand+'</p></td>\
					<td class="second">\
						<a target="_blank" class="blacklink" href="#-'+good.linecode+'/'+good.brand+'/"><b>'+good.name+'</b></a><br>\
						<!--<div id="art_'+good.art_id+'_usage" class="usage"><a href="#loadUsage('+good.art_id+')" class="usage">Где используется?</a></div>\
						<div id="art_'+good.art_id+'_send_error" class="send_error"><a href="#openErrorDialog2('+good.art_id+')" class="send_error">Сообщить об ошибке</a></div>-->\
					</td>\
					<td class="price">Цена&nbsp;<span class="rouble">'+good.price+' руб.</span></td>\
					<td class="order">\
						<div class="buy-preloader"></div>\
						<div class="buy-wrapper">\
							<div class="not-in-basket" style="">\
								<a href="#" class="buy id-">'+good.qty+'</a>\
							</div>\
						</div>\
					</td>\
				</tr>\
			</tbody>'
	return tr
}