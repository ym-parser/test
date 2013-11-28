function changeExtra(uid,val){
	var url = '/user/change/client/';
	$.get(url,'extra&uid='+uid+'&extra='+val,function (result) {
			
		}, 'json');
}
function ShowMyPrice(val,uid){
	var url = '/user/change/client/';
	$.get(url,'show&uid='+uid+'&val='+val,function (result) {
			
		}, 'json');
}
function delSub(id){
	var url = '/user/change/subscription/';
	$.get(url,'id='+id,function (result) {
			location.reload();
		}, 'json');
}