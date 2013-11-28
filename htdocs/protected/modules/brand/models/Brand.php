<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

//echo ' BrandModel ';

class Brand extends DaActiveRecord{
    
    const ID_OBJECT = 'project-brendy';
    
    protected $idObject = self::ID_OBJECT;
    
    
   public static function model($className=__CLASS__){
      return parent::model($className);
   }
    
    /**
   * @return string the associated database table name
   */
    public function tableName(){
      return 'pr_brand';
    }
    
    public function getUrl() {
        return Yii::app()->createUrl('brand/brand/index');
    }
    
    public function relations() {
        return array(
          'image' => array(self::HAS_ONE, 'File', array('id_file' => 'img'), 'select' => 'id_file, file_path, id_object, id_instance, id_parameter, id_property'),
          //'category' => array(self::BELONGS_TO, 'NewsCategory', 'id_news_category'),
        );
    }

}


?>