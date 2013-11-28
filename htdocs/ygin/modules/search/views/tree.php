<?php
$this->registerCssFile("search.css");
$this->registerJsFile('catalog.js');
?>
	<script type='text/javascript'>
		$(document).ready(function () {
			GetTree(<?=$model['typId']?>,<?=$model['node']?>)
		});
	</script>
<div class="b-search">
	<table class="listing centered">
		<tbody id='nodeLists'>
		</tbody>
	</table>
	<div class="goods">
		<table id="crosses-simple" style="">
		</table>

    

</div>
</div>