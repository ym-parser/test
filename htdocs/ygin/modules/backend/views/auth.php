<?php
  $this->layout = 'backend.views.layouts.auth';
  $this->setPageTitle('Панель управления');
  
  if (Yii::app()->user->returnUrl == null) Yii::app()->user->returnUrl = Yii::app()->homeUrl;
  
  // автофокус
  $elementId = null;
  if ($model->username != null) {
    $elementId = '#LoginForm_password';
  } else {
    $elementId = '#LoginForm_username';
  }
  Yii::app()->clientScript->registerScript('auth.init', '
    $(".b-field-notnull")
      .live({
        keyup  : function(){$(this).daNotNullChange();},
        blur   : function(){$(this).daNotNullChange(); },
        click  : function(){$(this).daNotNullChange();},
        change : function(){$(this).daNotNullChange();},
      })
      .daNotNullChange();
  $("'.$elementId.'").focus();
  $(":submit").button({icons:{primary:"ui-icon-key"}});
  ', CClientScript::POS_READY);
  

  $form = $this->beginWidget('CActiveForm', array(
    'id'=>'login-form',
    'enableAjaxValidation' => false,
    'enableClientValidation' => false,
    'clientOptions' => array(
      'validateOnSubmit' => false,
      'validateOnChange' => false,
    ),
    'action' => Yii::app()->createUrl(UserModule::ROUTE_ADMIN_LOGIN),
    'errorMessageCssClass' => 'label label-important',
    'htmlOptions' => array(
      'class' => 'b-login-form form-horizontal'
    ),
  ));
?>

<fieldset class="well">
  <div class="control-group">
    <label for="LoginForm_username">Логин:</label>
    <div>
      <?php echo $form->textField($model, 'username', array('class'=>'input-xlarge nullField', 'size'=>15, 'autofocus'=>'autofocus')); ?>
    </div>
  </div>
  <div class="control-group">
    <label for="LoginForm_password">Пароль:</label>
    <div>
      <?php echo $form->passwordField($model, 'password', array('class'=>'input-xlarge nullField', 'size'=>15)); ?>
    </div>
  </div>
  <div>
    <table><tr>
    <td>
      <button type="submit" class="btn btn-large"><i class="icon-check"></i> Войти</button>
    </td>
    <td>
      <label class="checkbox">
        <?php echo $form->checkBox($model, 'rememberMe', array('class' => 'remind')); ?> <?php echo $form->label($model, 'rememberMe', array('label' => 'запомнить меня')); ?>
      </label>
    </td>
    </tr>
    </table>
  </div>
</fieldset>

<div class="ygin-copy"><a target="_blank" href="http://ygin.ru">&copy; 2013, ygin</a></div>
<?php $this->endWidget(); ?>
<?php
  if ($model->username != null || $model->password != null) {  // TODO: пользователь также может быть заблокирован. Или не иметь в принципе доступа в админку
    echo '<div class="alert alert-error">
            <i class="icon-warning-sign"></i> Вы ввели неверный логин или пароль.
          </div>';
  }
?>