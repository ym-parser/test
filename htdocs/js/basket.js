function remoteadd(codeU,ses,codeG,sklad,name,art,brand,cnt,cost,num,str){
	var r=confirm(str);
	if (r==true){
		add(codeU,ses,codeG,sklad,name,art,brand,cnt,cost,num);
	}
}
function remotedel(id,codeU,ses,codeG,sklad,name,art,brand,cnt,cost,num,str){
	$('#cart-'+num).html('<a href="#" onclick="remoteadd('+codeU+',\''+ses+'\','+codeG+','+sklad+',\''+name+'\',\''+art+'\',\''+brand+'\','+cnt+',\''+cost+'\','+num+',\''+str+'\');return false;">В корзину</a>');
	var url = '/new_site/obmen/basket.php';
	$.get(
		url,
			'dell&id='+id,
			function (result) {
				var button = 'из корзины';
				}, 'json');
}
function confirmItemDel(id,str){
	var r=confirm(str);
	if (r==true){
		itemDel(id);
	}
}
function add(codeU,ses,codeG,sklad,name,art,brand,cnt,cost,num){
	$('#cart-'+num).html('Из корзины  шт.');
	var url = '/new_site/obmen/basket.php';
	var id ='';
	var str='';
	$.get(
			url,
			'add&codeU='+codeU+'&ses='+ses+'&codeG='+codeG+'&sklad='+sklad+'&name='+name+'&art='+art+'&brand='+brand+'&cnt='+cnt+'&cost='+cost,
			function (result) {
				id = result.id;
				str = '<a href="#" onclick="del('+id+','+codeU+',\''+ses+'\','+codeG+','+sklad+',\''+name+'\',\''+art+'\',\''+brand+'\','+cnt+',\''+cost+'\',\''+num+'\');return false;">Из корзины</a>';
				$('#cart-'+num).html(str);
				}, 'json');
}
function del(id,codeU,ses,codeG,sklad,name,art,brand,cnt,cost,num){
	$('#cart-'+num).html('<a href="#" onclick="add('+codeU+',\''+ses+'\','+codeG+','+sklad+',\''+name+'\',\''+art+'\',\''+brand+'\','+cnt+',\''+cost+'\',\''+num+'\');return false;">В корзину</a>');
	var url = '/new_site/obmen/basket.php';
	$.get(
		url,
			'dell&id='+id,
			function (result) {
				var button = 'из корзины';
				}, 'json');
}
function change(id,cnt){
	var url = '/new_site/obmen/basket.php';
	$.get(
		url,
			'cheng&id='+id+'&cnt='+cnt,
			function (result) {
				location.reload();
				}, 'json');
}
function itemDel(id){
	var url = '/new_site/obmen/basket.php';
	$.get(
		url,
			'dell&id='+id,
			function (result) {
				location.reload();
				}, 'json');
}
function deliteAll(){
	var url = '/new_site/obmen/basket.php';
	$.get(
		url,
			'delAll',
			function (result) {
				location.reload();
				}, 'json');
}