<?php
$this->pageTitle = 'Переопределение представлений';
?>


<style>
.overrideList {list-style: none;}
.overrideList .parent {font-weight:bold;}
</style>

<?php
Yii::app()->clientScript->registerScript('override-init', '
  $(".checkbox input").change(function(){
    var $this = $(this);
    var checked = $this.prop("checked");
    if ($this.parent().parent().find("ul :checkbox").length > 0) {
       $(".checkbox input").each(function(){
         var name = $this.attr("name");
         if (this.name.indexOf(name.substr(0, name.length - 1)) == 0) {
           $(this).prop("checked", checked);
         }
       });
    } else {
      $this.parents(":checkbox").each(function(){
        $(this).prop("checked", checked);
      });
    }
  });',
  CClientScript::POS_READY
);

if (Yii::app()->user->hasFlash('override-error')) {
  $this->widget('AlertWidget', array(
    'type' => 'error',
    'title' => $this->pageTitle,
    'message' => Yii::app()->user->getFlash('override-error'),
  ));
}
if (Yii::app()->user->hasFlash('override-success')) {
  $this->widget('AlertWidget', array(
    'type' => 'success',
    'title' => $this->pageTitle,
    'message' => Yii::app()->user->getFlash('override-success'),
  ));
}
?>
    <form class="form-horizontal well" method="post">
 
    <div class="control-group">
      <label class="control-label">Тема</label>
      <div class="controls">
      <input type="text" id="theme" readonly="readonly" value="<?= $model->theme; ?>">
      </div>
    </div>
    <div class="control-group">
      <label class="control-label">Если файл существует, то </label>
      <div class="controls">
      <?php echo CHtml::activeDropDownList(
        $model,
        'rewriteType',
        $model->getRewriteTypes()
      ); ?>
      </div>
    </div>
    <div class="control-group">
    <label class="control-label">Представления для переопределения</label>
    <div class="controls">
    <?php $this->renderRecursive($model->overrideDataItemTree, $model->data); ?>
    </div>
    </div>
    <div class="form-actions">
      <button type="submit" class="btn btn-primary">Переопределить</button>
    </div>
    </form>
