<?php

//echo 'DefaultController';

class DefaultController extends Controller {
    
    protected $urlAlias = "brand";  

    /**
    * Список брендов
    */

    public function actionIndex() {

        $criteria = new CDbCriteria();
        $criteria->select = '*';
        //$criteria->alias = 'brand_alias';
        $criteria->condition = 'is_visible = 1';
        //$criteria->join = 'LEFT JOIN `da_files` ON brand_alias.img = da_files.id_file';
        $criteria->order = 'sequence DESC';
        //$criteria->together = true;
        $criteria->mergeWith(array(
                                    'with' => 'image',
                                   // 'order' => "$alias.date DESC",
                                    //'limit' => $limit,
                            ));

        $dataProvider = new CActiveDataProvider('Brand', array(
                                                                'criteria' => $criteria,
        ));

        $brand = Brand::model()->findAll($criteria);

        $this->render('index', array(
                                    'brand' => $brand,  // список брендов
                                  ));

    }
    
    /**
   * Одиночный бренд
   * @param int $id
   */
    public function actionView($id) {

      $brand = $this->loadModelOr404('Brand', $id); 
      $this->caption = $brand->name;
      $this->render('view', array(
                                'model'=>$brand
      ));
    }
        
        
}