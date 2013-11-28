<?php
/* @var UserController $this */
/*
$cs = Yii::app()->clientScript;
$this->registerJsFile('user.js');
$cs->registerScript(
  "profileForm",
  "User.showPassBind('showPass','profile-form','".CHtml::activeName($model, "user_password")."');",
  CClientScript::POS_READY
);

if (Yii::app()->user->hasFlash('profileSuccess')) {
  $this->widget('AlertWidget', array(
    'title' => $this->caption,
    'message' => Yii::app()->user->getFlash('profileSuccess'),
  ));
}

if (Yii::app()->user->hasFlash('registerSuccess')) {
  $this->widget('AlertWidget', array(
    'title' => 'Успешная регистрация',
    'message' => Yii::app()->user->getFlash('registerSuccess'),
  ));
}

$form = $this->beginWidget('CActiveForm', array(
  'id' => 'profile-form',
  'enableAjaxValidation' => true,
  'enableClientValidation' => true,
  'focus' => array($model, 'mail'),
  'htmlOptions' => array(
    'class' => 'form-horizontal',
  ),
  'clientOptions' => array(
    'validateOnSubmit' => true,
    'validateOnChange' => false,
  ),
  'errorMessageCssClass' => 'label label-important',
));
?>
  <?php echo $form->errorSummary($model, false); ?>
  <fieldset>
    <div class="control-group">
      <?php echo $form->labelEx($model, 'name', array('class'=>'control-label')); ?>
      <div class="controls">
        <?php echo $model->getEncodedName(); ?>
      </div>
    </div>
<!-- +not-encode-mail -->
    <div class="control-group">
      <?php echo $form->labelEx($model, 'mail', array('class'=>'control-label')); ?>
      <div class="controls">
        <?php echo $form->textField($model, 'mail', array('class' => 'input-xlarge', 'type' => 'email')); ?>
        <?php echo $form->error($model, 'mail'); ?>
      </div>
    </div>
<!-- -not-encode-mail -->
    <div class="control-group">
      <div class="controls">
        <button type="button" class="btn btn-small" onclick="$(this).parent().remove(); $('#passRow').show();">Изменить пароль</button>
      </div>
      <div id="passRow" style="display:none">
        <?php echo $form->labelEx($model, 'user_password', array('class'=>'control-label')); ?>
        <div class="controls">
          <?php echo $form->passwordField($model, 'user_password', array('class' => 'input-xlarge')); ?>
          <?php echo $form->error($model, 'user_password'); ?>
          <label for="showPass" class="checkbox">
            <input type="checkbox" id="showPass">
            Показать пароль
          </label>
        </div>
      </div>
    </div>
    <div class="control-group">
      <?php echo $form->labelEx($model, 'full_name', array('class'=>'control-label')); ?>
      <div class="controls">
        <?php echo $form->textField($model, 'full_name', array('class'=>'input-xlarge', 'rows' => '8')); ?>
        <?php echo $form->error($model, 'full_name'); ?>
      </div>
    </div>
    <div class="form-actions">
    <?php echo CHtml::submitButton('Сохранить', array('class' => 'btn btn-success')); ?>
    </div>
  </fieldset>
<?php $this->endWidget(); ?>
*/
$cs = Yii::app()->clientScript;
$this->registerJsFile('client.js');
?>
<style>
.onoffswitch {
    position: relative; width: 120px;
    -webkit-user-select:none; -moz-user-select:none; -ms-user-select: none;
}
.onoffswitch-checkbox {
    display: none;
}
.onoffswitch-label {
    display: block; overflow: hidden; cursor: pointer;
    border: 2px solid #999999; border-radius: 20px;
}
.onoffswitch-inner {
    width: 200%; margin-left: -100%;
    -moz-transition: margin 0.3s ease-in 0s; -webkit-transition: margin 0.3s ease-in 0s;
    -o-transition: margin 0.3s ease-in 0s; transition: margin 0.3s ease-in 0s;
}
.onoffswitch-inner:before, .onoffswitch-inner:after {
    float: left; width: 50%; height: 30px; padding: 0; line-height: 30px;
    font-size: 14px; color: white; font-family: Trebuchet, Arial, sans-serif; font-weight: bold;
    -moz-box-sizing: border-box; -webkit-box-sizing: border-box; box-sizing: border-box;
}
.onoffswitch-inner:before {
    content: "Показано";
    padding-left: 10px;
    background-color: #2FCCFF; color: #FFFFFF;

}
.onoffswitch-inner:after {
    content: "Скрыто";
    padding-right: 10px;
    background-color: #EEEEEE; color: #999999;
    text-align: right;
}
.onoffswitch-switch {
    width: 18px; margin: 6px;
    background: #FFFFFF;
    border: 2px solid #999999; border-radius: 20px;
    position: absolute; top: 0; bottom: 0; right: 85px;
    -moz-transition: all 0.3s ease-in 0s; -webkit-transition: all 0.3s ease-in 0s;
    -o-transition: all 0.3s ease-in 0s; transition: all 0.3s ease-in 0s; 
}
.onoffswitch-checkbox:checked + .onoffswitch-label .onoffswitch-inner {
    margin-left: 0;
}
.onoffswitch-checkbox:checked + .onoffswitch-label .onoffswitch-switch {
    right: 0px; 
}
</style>
<div style="margin: 50px;">
	<!--<form id="regform" name="regform" method="post">-->
		<div style="float:left;">
			Логин:<br />
			<?=$model['login']?><br />
			<br />E-mail:<br />
			<?=$model['login']?><br />
			<br />E-mail менеджера:<br />
			<?=$model['cInfo']['manager_mail']?><br />
			<br />Имя:<br />
			<?=$model['cInfo']['name']?><br />
			<br />Фирма:<br />
			<?=$model['cInfo']['company']?><br />
			<br />Код клиента:<br />
			<?=$model['cInfo']['company_code']?><br />
		</div>
		<div style="float:left;margin-left:25px;">
		<table>
		<td>
			<br />Скидка %:<br />
			<?=number_format($model['cInfo']['discount'],2)?><br />
			<br />Наценка %:<br />
			<input type="text" id="k2" name="k2" class="in" value="<?=number_format($model['cInfo']['extra_charge'] ,2)?>">
			<? if(!empty($model['skid'])):?> 
			<br />Скидки на бренды %<br />
			<?foreach($model['skid'] as $b => $s):?>
				<?if($s <= 0) continue;?>
				<input disabled type='text' name='x_skidka2brandb[]' class='in' style='width:200px' value='<?=$b?>'>&nbsp;
				<input disabled type='text' name='x_skidka2brands[]' class='in' value='<?=number_format($s,2)?>' style='width:50px'>%<br />
			<?endforeach;?>
			<?endif;?>
		</td>
		</table>
		</div>
		<br /><input type='button' onclick='changeExtra(<?=$model['cInfo']['company_code']?>,$("#k2").val())' value="изменить" class="fltbut">
	<!--</form>-->
<div style="clear:both;"></div>
<?/********/?>
<div>Показывать колонку с моей ценой:</div>
	<?if ($model['cInfo']['show_price_column'] == 1):
		$chek_p = 'checked';
	else:
		$chek_p = '';
	endif;?>
<div class="onoffswitch">
    <input type="checkbox" name="onoffswitch" value="<?=$model['cInfo']['company_code']?>" <?=$chek_p?> class="onoffswitch-checkbox" id="myonoffswitch" onchange="ShowMyPrice(this.checked,this.value)"/>
    <label class="onoffswitch-label" for="myonoffswitch">
        <div class="onoffswitch-inner"></div>
        <div class="onoffswitch-switch"></div>
    </label>
</div>
<?/********/?>
<p style="margin-top:20px;font-weight:bold;"><a href="/cabinet/change/?pass" title="Cменить пароль">Cменить пароль</a></p>
</div>