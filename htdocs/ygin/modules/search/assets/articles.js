function AddSubscription(codeU,codeG,type,show){
	url = '/search/add/subscription/';
	$.get(url,'codeU='+codeU+'&codeG='+codeG+'&type='+type+'&show='+show,function (sub) {
		if (sub[0].result >0){
			$('#sub_'+codeG).html("<input type='button' onclick='DelSub("+sub[0].result+","+codeU+","+codeG+","+type+","+show+")' value='Отписаться'/>")
		}else{
			$('#sub_'+codeG).html("<input type='button' value='Запись уже есть'/>")
		}
	}, 'json');
}
function DelSub(id,codeU,codeG,type,show){
	url = '/user/change/subscription/';
	$.get(url,'id='+id,function (result) {
			$('#sub_'+codeG).html("<input type='button' onclick='AddSubscription("+codeU+","+codeG+","+type+","+show+")' value='Оповестить'/>")
		}, 'json');
}
function AddBasket(codeU,wh,ib,qnt,name,price,codeG,bra,art,i){
	$.get('/search/cart/add/',
		{codeU: codeU,
		 wh: wh,
		 ib: ib,
		 qnt: qnt,
		 name: name,
		 price: price,
		 codeG: codeG,
		 bra: bra,
		 art: art,
		 i: i
		}).done(function (data){
			data = JSON.parse(data)
			if (data[0].res<0){
				$('#basket_'+i).html(data[0].msg)
			}else{
				inp = '<input type="button" value="Из корзины" onclick="DellBasket(\''+codeU+'\','+wh+','+ib+','+qnt+',\''+name+'\',\''+price+'\','+codeG+',\''+bra+'\',\''+art+'\','+i+','+data[0].res+')">'
				$('#basket_'+i).html(inp)
			}
		})
		.fail($('#basket_'+i).html('Обрабатываем'));
		
		//<td id="basket_45105">
			//<input style="width:50px;" type="text" id="basket_v_45105"><input type="button" value="В корзину" onclick="AddBasket(&quot;29jt4606sj9gkmk7c581jcut17&quot;,3,1,$(&quot;#basket_v_45105&quot;).val(),&quot;Маслянный фильтр ACCORD IX&quot;,&quot;108.90&quot;,45105,0,0,45105)">
		//</td>
}
function DellBasket(codeU,wh,ib,qnt,name,price,codeG,bra,art,i,id){
	$.get('/search/cart/DeleteBasket/',
		{codeU: codeU,
		 id: id
		}).done(function (data){
				inp = '<input style="width:50px;" type="text" id="basket_v_'+i+'">\
				<input type="button" value="В корзину" onclick="AddBasket(\''+codeU+'\','+wh+','+ib+',$(\'#basket_v_'+i+'\').val(),\''+name+'\',\''+price+'\','+codeG+',\''+bra+'\',\''+art+'\','+i+')">'
				$('#basket_'+i).html(inp)
		})
		.fail($('#basket_'+i).html('Обрабатываем'));
}