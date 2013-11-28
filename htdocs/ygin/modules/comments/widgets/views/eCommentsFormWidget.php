<?php 
/**
 * @var Comment model
 * @var CActiveForm $form
 */
$form=$this->beginWidget('CActiveForm', array(
  'action' => Yii::app()->urlManager->createUrl($this->postCommentAction),
  'enableAjaxValidation' => false,
  'enableClientValidation' => true,
  'htmlOptions' => array(
    'class' => 'b-comment-form form-horizontal',
    'name' => 'commentform',
  ),
  'clientOptions' => array(
    'validateOnSubmit' => true,
    'validateOnChange' => false,
   //'beforeValidate' => 'js:function(form){  }',
  ),
));
?>
  <fieldset>
    <legend>Добавить комментарий</legend>
  <?php //echo $form->errorSummary($newComment); ?>
  <?php 
    echo $form->hiddenField($newComment, 'id_object'); 
    echo $form->hiddenField($newComment, 'id_instance'); 
    echo $form->hiddenField($newComment, 'id_parent', array('class'=>'parent_comment_id'));
  ?>
    <div class="control-group">
      <?php echo $form->labelEx($newComment, 'comment_name', array('class'=>'control-label')); ?>
      <div class="controls">
       <?php if(Yii::app()->user->isGuest === true):?>
       <?php 
         echo $form->textField($newComment,'comment_name', array(
           'size' => 40,
           'class' => 'input-xlarge',
           'title' => 'Ваше имя',
           'autocomplete' => 'off',
         )); 
       ?>
       <?php echo $form->error($newComment,'comment_name'); ?>
       <?php else:?>
       <?php $curUser = Yii::app()->user->getModel();?>
       <?php echo '<div class="commentator_name">'.$curUser->full_name.'</div>'; ?>
       <?php
       /*<?php if (($preview = $curUser->getImagePreview('_small')) !== null && in_array($curUser->id_group, array(BlogUser::GROUP_ID, BlogUser::ADMINBLOG_GROUP))):?>
       <img alt="<?=$curUser->full_name;?>" src="<?=$preview->getUrlPath();?>">
       <?php endif;?>
       <?php echo $curUser->full_name;?>
       */?>
       <?php endif; ?>
      </div>
    </div>
    
    <div class="control-group">
      <?php echo $form->labelEx($newComment, 'comment_theme', array('class'=>'control-label')); ?>
      <div class="controls">
        <?php 
          echo $form->textField($newComment, 'comment_theme', array(
            'size' => 40,            
            'class' => 'input-xlarge',
            'title' => 'Тема',
            'autocomplete' => 'off',
         )); 
        ?>
        <?php echo $form->error($newComment, 'comment_theme'); ?>
      </div>
    </div>
    
    <div class="control-group">
      <?php echo $form->labelEx($newComment, 'comment_text', array('class'=>'control-label')); ?>
      <div class="controls">
        <?php 
          echo $form->textArea($newComment, 'comment_text', array(
            'rows' => 8,
            'style' => 'width:380px',
            'class' => 'input-xlarge',
            'title' => 'Комментарий',
            'placeholder' => 'Комментарий',
            'autocomplete' => 'off',
          ));
        ?>
        <?php echo $form->error($newComment, 'comment_text'); ?>
      </div>
    </div>

    <?php  if($this->useCaptcha === true && extension_loaded('gd')): ?>
    <div class="control-group">
      <?php echo $form->labelEx($newComment, 'verifyCode', array('class'=>'control-label')); ?>
      <div class="controls">
        <?php echo $form->textField($newComment, 'verifyCode', array('title' => 'Укажите код с картинки', 'autocomplete' => 'off', 'class' => 'input-mini')); ?>
        <?php echo $form->error($newComment, 'verifyCode', array(), true, false); ?>
        <div class="captcha">
        <?php $this->widget('CCaptcha', array(
                'clickableImage' => true,
                'captchaAction'  => CommentsModule::CAPTCHA_ACTION_ROUTE,
              )); ?>
        </div>
      </div>
    </div>
    <?php endif; ?>
    
    <div class="form-actions">
      <?php echo CHtml::htmlButton('Отправить', array(
        'name' => 'btn',
        'type' => 'submit',
        'class' => 'btn submit',
        'data-loading-text' => 'Отправляется...',
      )); ?>
    </div>
  </fieldset>
<?php $this->endWidget(); ?>