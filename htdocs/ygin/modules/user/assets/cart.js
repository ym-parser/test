function DelBasketItem(id){
	var url = '/search/cart/DeleteBasket/';
	$.get(url,'id='+id,function (result) {
			location.reload();
		}, 'json');
}
function ChangeBasket(id,val){
	var url = '/search/cart/ChangeBasket/';
	$.get(url,'id='+id+'&val='+val,function (result) {
			location.reload();
		}, 'json');
}