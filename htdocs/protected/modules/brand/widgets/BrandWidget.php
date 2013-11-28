<?php

//die('Widget Brand');
//Widget`
class BrandWidget extends DaWidget{
	
    
    
    /*
    public function getBrand() {
        return Brand::model()->last($this->maxNews)->findAll();
    }
    */
    
    public function run() {
        
        /*
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
         */
        
        
        $brand = Brand::model()->findAll();
        
        
        
        $this->render('brandWidget', array('brand'=>$brand));
   }
}