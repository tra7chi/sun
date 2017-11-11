<?php

/**
 * 用户Model
 */
class CategoryModel extends Model{

	 
    public $_table = 'sc_product_category_level_one';
	public function __construct($level){
		parent::__construct();
		if($level == 1){
			$this->_table = 'sc_product_category_level_one';
		}
		else{
			$this->_table = 'sc_product_category_level_two';
		}
	}

}