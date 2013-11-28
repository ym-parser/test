<div style="border-bottom: 1px solid red; padding: 5px; margin-bottom: 5px;">
		<div style="display: inline-block;  vertical-align: top;  padding-right: 10px;margin-left: 0px;/*width:150px; overflow-x:hidden */">
			<a href="/img/Delphi_RIK.pdf" target="_blank"><img src="/img/Delphi_RIK.gif" alt=""></a>
		</div>
		<div style="display: inline-block;  vertical-align: top;  padding-right: 10px;/*width:150px; overflow-x:hidden; float: left; margin-left: 120px; margin-top: -140px; */">
			<a href="/img/bilstein.pdf" target="_blank"><img src="/img/bilstein.gif" alt=""></a>
		</div>
		
		<div style="display:inline-block;*display: inline;*zoom: 1;vertical-align:bottom;margin-left:5px">
			<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="150" height="120" id="1_ready" align="middle">
			<param name="allowScriptAccess" value="sameDomain">
			<param name="wmode" value="transparent">
			<param name="wmode" value="opaque">
			<param name="movie" value="/ad/hangil.swf"><param name="quality" value="high"><param name="bgcolor" value="#ffffff"><embed src="/ad/hangil.swf" wmode="transparent" quality="high" bgcolor="#ffffff" width="150" height="120" name="1_ready" align="middle" allowscriptaccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer">
			</object>
		</div>
		<div style="display:inline-block;*display: inline;*zoom: 1;vertical-align:top;padding-right:10px;/*float:left;*/">
			<a href="/img/filtr.jpg" target="_blank"><img src="/img/filtr.png" border="0"></a>
		</div>
		<div style="display:inline-block;*display: inline;*zoom: 1;vertical-align:top;padding-right:10px;/*float:left;*/">
			<a href="/img/fonar.jpg" target="_blank"><img src="/img/fonar.png" border="0"></a>
		</div>
		<div style="display:inline-block;*display: inline;*zoom: 1;vertical-align:top;padding-right:10px;/*float:left;*/">
			<a href="/img/kofe.jpg" target="_blank"><img src="/img/kofe.png" border="0"></a>
		</div>
		<div style="display:inline-block;*display: inline;*zoom: 1;vertical-align:top;padding-right:10px;/*float:left;*/">
			<a href="/img/shur.jpg" target="_blank"><img src="/img/shur.png" border="0"></a>
		</div>
</div>
<div style="margin:0px 15px 15px 15px;">
<form action="/search" method='get'>
	<div style="display:inline-block;*display: inline;*zoom: 1;vertical-align:bottom" >
		<input type='text' value="" name='tq' style="width: 300px; font: bold 18px Arial; border: 1px solid red; padding: 3px 3px 3px 3px; margin-right: 5px;"/>
		<input type='submit' value="Найти" style="padding: 5px;"/>
	</div>
</form>
</div>
<?
	if (isset($_GET['tq'])){
	$str = str_replace("\\","",$_GET['tq']);
	//$str = Info::perfect_str($str,'art');
	$str = strtoupper($str);
	//$_SESSION['tq'] = $str;
	//var_dump($str);
	//$details = Items::get_Details($str);?>
	<table class="prtb" style="margin-top: 5px; width: 95%">
	<tbody>
	<tr class="prtrr">
		<th class="prtdw">Производитель</th>
		<th class="prtdw">Код</th>
		<th class="prtdw" width="100%">Описание</th>
		<th class="prtdw">Найти</th>
	</tr>
	<?foreach ($details as $row){
			//$row['brand'] = str_replace('?','O',$row['brand']);
			//$row['description'] = Info::charset($row['description'],'windows-1251','utf-8');
			if ($row['brand_id'] !=0){?>
			<tr style="border: 1px solid;  background: #d3e7dc;">
					<td class="prtd" nowrap=""><font style="font-weight: bold;"><?=$row['brand']?></font></td>
					<td class="prtd" nowrap=""><font style="font-weight: bold;"><?=$row['code']?></font></td>
					<td class="prtd" nowrap=""><font style="font-weight: bold;"><?=$row['description']?></font></td>
					<td class="prtd" nowrap=""><font style="font-weight: bold;"><a href="/search/articles?tq=<?=$row['search_code']?>&brand=<?=$row['brand']?>&aid=<?=$row['id']?>&bra_id=<?=$row['brand_id']?>">НАЙТИ</a></font></td>
			</tr>
		<?}}?>
	</tbody>
	<table>
	<?
	echo '<pre>';
	var_dump($details);
	echo '</pre>';
	}
?>