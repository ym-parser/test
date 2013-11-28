<?php
/**
 * @var $this SearchController
 */

$this->registerCssFile("search.css");
?>

<div class="b-search">

  <form class="form-search well" action="<?php echo Yii::app()->createUrl(SearchModule::ROUTE_SEARCH_VIEW); ?>" method="get">
    <div class="input-append">
      <input class="search-query span4" placeholder="Поиск" value="<?php echo CHtml::encode($tq) ?>" name="TQ" autocomplete="off">
      <button class="btn btn-inverse" type="submit"><i class="icon-search icon-white"></i> Найти</button>
    </div>
  </form>

<?#var_dump($details)?>
<?if(is_array($details)):?>
	<table>
		<thead>
			<th>Бренд</th>
			<th>Артикул</th>
			<th>Описание</th>
			<th></th>
		</thead>
	<?foreach($details as $det):?>
		<tr>
			<td><?=iconv('windows-1251','utf-8',$det['brand'])?></td>
			<td><?=$det['search_code']?></td>
			<td><?=iconv('windows-1251','utf-8',$det['description'])?></td>
			<td><a href='/search/articles/?TQ=<?=$det['search_code']?>&BRAND=<?=$det['brand']?>&bra_id=<?=$det['brand_id']?>'>Найти</a></td>
		</tr>
	<?endforeach;?>
	</table>
<?endif;?>
  <?php
  if ($error != null) {
    echo '<div class="alert alert-error"><b>Ошибка:</b> '.$error.'</div></div>';
    return;
  }
  $inc = $paginator->getCurrentPage() * $paginator->getPageSize();
  $cResult = count($searchResult);
?>
  <div class="result-count">Найдено: <span class="badge"><?php echo $total; ?></span></div>
  <ol class="result-list" start="<?php echo ($inc+1) ?>">

<?php
  foreach ($searchResult AS $cur) {
    $title = $addTitle = "";
    $link = $content = null;
    
    $title = $cur->title;
    $link = $cur->link;
    $content = $cur->getContent();
    if (!is_null($link)) $title = '<a href="'.$link.'">'.$title.'</a>'.$addTitle;

    $this->renderPartial('/_item', array(
      'title' => $title,
      'content' => $content,
      'searchResult' => $cur,
    ));
  }
?>
  </ol>
<?php  $this->widget('LinkPagerWidget', array('pages' => $paginator,)); ?>
</div>