<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
  <meta name="viewport" content="width=device-width">
  <meta http-equiv="content-language" content="ru" > 
  <?php
  //Регистрируем файлы скриптов в <head>
  if (YII_DEBUG){
    Yii::app()->assetManager->publish(YII_PATH.'/web/js/source', false, -1, true);
  }
  Yii::app()->clientScript->registerCoreScript('jquery');
  Yii::app()->clientScript->registerCoreScript('bootstrap'); 
  $this->registerJsFile('modernizr-2.6.1-respond-1.1.0.min.js', 'ygin.assets.js');

  Yii::app()->clientScript->registerScriptFile('/themes/rusimport/js/main.js', CClientScript::POS_HEAD);
  
  Yii::app()->clientScript->registerScript('setScroll', "setAnchor();", CClientScript::POS_READY);
  Yii::app()->clientScript->registerScript('menu.init', "$('.dropdown-toggle').dropdown();", CClientScript::POS_READY);

  $ass = Yii::getPathOfAlias('ygin.assets.bootstrap.img').DIRECTORY_SEPARATOR;
  Yii::app()->clientScript->addDependResource('bootstrap.min.css', array(
                                                                        $ass.'glyphicons-halflings.png' => '../img/',
                                                                        $ass.'glyphicons-halflings-white.png' => '../img/',
                                                                        $ass.'glyphicons-halflings-red.png' => '../img/',
                                                                        $ass.'glyphicons-halflings-green.png' => '../img/',
                                                                    ));
  
  Yii::app()->clientScript->registerCssFile('/themes/rusimport/css/main.css');
  Yii::app()->clientScript->registerCssFile('/themes/rusimport/css/content.css');

  $nAss = Yii::getPathOfAlias('ygin.assets.gfx').DIRECTORY_SEPARATOR;
  Yii::app()->clientScript->addDependResource('page.css', array(
                                                                $nAss.'loading_s.gif' => '../../../ygin/assets/gfx/',
                                                          ));
  ?>
  <title><?php echo CHtml::encode($this->getPageTitle()); ?></title>
</head>

<body>
    
    <div id="wrapper">
      <div id="header">
        <div id="container_header">
            <div id="header_left">
                <div id="logo" style="height:100px; background-color:#42b570;">
                    <a href="/">ЛОГОТИП РИК-АВТО</a>
                </div>
                <div id="region">
                    Город/регион: <b>Cанкт-Петербург</b>
                </div>
            </div>

            <div id="header_right">
               <b>Вход/выход пользователя<br>
               Корзина<br>
               Дополнительная информация</b>
           </div> 

            <div id="header_center">
                <b>РИК АВТОЗАПЧАСТИ ВЕДУЩИХ ПРОИЗВОДИТЕЛЕЙ ЗАПАДНОЙ ЕВРОПЫ</b>
            </div>
        </div>

        <div id="menu_main">
            <?php 
            if(true)
            $this->widget('MenuWidget', array(
                                    'rootItem' => Yii::app()->menu->all,
                                    'htmlOptions' => array('class' => 'nav nav-pills'), // корневой ul
                                    'submenuHtmlOptions' => array('class' => 'dropdown-menu'), // все ul кроме корневого
                                    'activeCssClass' => 'active', // активный li
                                    'activateParents' => 'true', // добавлять активность не только для конечного раздела, но и для всех родителей
                                    //'labelTemplate' => '{label}', // шаблон для подписи
                                    'labelDropDownTemplate' => '{label} <b class="caret"></b>', // шаблон для подписи разделов, которых есть потомки
                                    //'linkOptions' => array(), // атрибуты для ссылок
                                    'linkDropDownOptions' => array('data-target' => '#', 'class' => 'dropdown-toggle', 'data-toggle' => 'dropdown'), // атрибуты для ссылок для разделов, у которых есть потомки
                                    'linkDropDownOptionsSecondLevel' => array('data-target' => '#', 'data-toggle' => 'dropdown'), // атрибуты для ссылок для разделов, у которых есть потомки
                                    //'itemOptions' => array(), // атрибуты для li
                                    'itemDropDownOptions' => array('class' => 'dropdown'),  // атрибуты для li разделов, у которых есть потомки
                                    'itemDropDownOptionsSecondLevel' => array('class' => 'dropdown-submenu'),
                                  //  'itemDropDownOptionsThirdLevel' => array('class' => ''),
                                    'maxChildLevel' => 2,
                                    'encodeLabel' => false,
                                ));
            ?>
       </div>
        <?php //$this->widget('BlockWidget', array("place" => SiteModule::PLACE_TOP)); ?>
    </div>
        
   
      <div id="container">
          <div id='left'>
            <h3>Приходы на склад</h3>
            <?php $this->widget('BlockWidget', array("place" => SiteModule::PLACE_LEFT)); ?>
          </div>
          <div id="right">
            <?php $this->widget('BlockWidget', array("place" => SiteModule::PLACE_RIGHT)); ?>
          </div>
          <div id="center">
            <?php $this->widget('BlockWidget', array("place" => SiteModule::PLACE_CONTENT_TOP)); ?>
            <?php 
            if($this->useBreadcrumbs && isset($this->breadcrumbs)){
              $this->widget('BreadcrumbsWidget', array(
                                                      'homeLink' => array('Главная' => Yii::app()->homeUrl),
                                                      'links' => $this->breadcrumbs,
                                                      )); 
            }
            ?>
            <h1><?php echo $this->caption; ?></h1>            
            <?php echo $content; ?>
          </div>
      </div>
      <div class="clear"></div>
      <div id="spacer"></div>
    </div>
    
    
    <div id="footer">
        <?php $this->widget('BlockWidget', array("place" => SiteModule::PLACE_BOTTOM)); ?>
    </div>

</body>
</html>