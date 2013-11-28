<?php

//echo ' BrandModule ';

class BrandModule extends DaWebModuleAbstract {

	protected $_urlRules = array(
                                    'brand/<id:\d+>' => 'brand/default/view',
                                    'brand' => 'brand/default/index',
	);
	
	public function init() {
		$this->setImport(array(
                                        $this->id.'.models.*',
                                        $this->id.'.components.*',
		));
	}

}
