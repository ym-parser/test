function saveSklad(sid){
	var name	= $('#name').val();
	var sname	= $('#sname').val();
	var code	= $('#code').val();
	var sort	= $('#sort').val();
	var des		= $('#des').val();
	//alert ("Имя:"+name+"\nИмя для сайта"+sname+"\nКод учета"+code+"\nСорт"+sort+"n\Описание"+des);
	$.post('/admin/sklad/save/',{ id: sid, name: name, sname: sname, code: code, sort: sort, des: des }).done(function (data){
			$('#ressMess').html(data)
		})
		.fail($('#ressMess').html('<p>Грузимся</p>'));
}