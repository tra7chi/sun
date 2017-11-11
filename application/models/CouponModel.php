<?php
/**
* 
*/
class CouponModel extends Model {
	public $_table = 'sc_coupons';
	public function __construct($level = 0){
		parent::__construct();
		if($level == 1){
			$this->_table = 'sc_customer_coupon';
		}
		else{
			$this->_table = 'sc_coupons';
		}
	}
}