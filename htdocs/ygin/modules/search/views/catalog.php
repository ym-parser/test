<?php
$this->registerCssFile("search.css");
$this->registerJsFile('catalog.js');
?>
	<script type='text/javascript'>
		$(document).ready(function () {
			GetCatalog(<?=$model['mfaId']?>,<?=$model['modId']?>)
		});
	</script>
<div class="b-search">
	<menu>
		<div class="dropdown" style="display: block;" id='catsList'>
		</div>
	</menu>
	<menu class="options models">
		<div class="dropdown" style="display: block;" id='modelsList'>
		</div>
	</menu>
	<menu class="types">
		<div class="dropdown" style="width: 750px; display: block" id='typesList'>
		</div>
	</menu>
</div>