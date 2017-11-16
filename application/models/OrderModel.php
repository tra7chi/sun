<?php
/**
* 
*/
class OrderModel extends Model {
	public $_table = 'sc_orders';

	public function __construct($level = 0){
		parent::__construct();
		if($level == 1){
			$this->_table = 'sc_order_details';
		}
		else{
			$this->_table = 'sc_orders';
		}
	}
	
	public function selectAll(){
		$sql = sprintf('SELECT `%s`.*,`sc_customers`.`customer_firstname`,`sc_customers`.`customer_lastname` FROM `%s` INNER JOIN `sc_customers` ON `%s`.`customer_id` = `sc_customers`.`customer_id` ORDER BY `order_time`',$this->_table,$this->_table,$this->_table);
		//echo $sql;
		$sth = $this->_dbHandle->prepare($sql);
        $sth->execute();

        return $sth->fetchAll();
	}
	public function select($id_name = 'order_id',$id){
		$sql = sprintf('SELECT `%s`.*,`sc_customers`.`customer_firstname`,`sc_customers`.`customer_lastname` FROM `%s` INNER JOIN `sc_customers` ON `%s`.`customer_id` = `sc_customers`.`customer_id` WHERE `%s`.`%s` = \'%s\' ORDER BY `order_time`',$this->_table,$this->_table,$this->_table,$this->_table,$id_name,$id);
		//echo $sql;
		$sth = $this->_dbHandle->prepare($sql);
        $sth->execute();

        return $sth->fetch();
	}
	public function select_all_with_detail($customer_id){
		$sql = sprintf('SELECT `%s`.*,`sc_order_details`.*,p.* FROM `%s` INNER JOIN `sc_order_details` ON `%s`.`order_id` = `sc_order_details`.`order_id` INNER JOIN (SELECT `sc_products`.* ,`sc_product_photos`.`photo_name` FROM `sc_products` INNER JOIN `sc_product_photos` ON `sc_products`.`product_id` = `sc_product_photos`.`product_id` WHERE `main_photo` = 1
) AS p ON `sc_order_details`.`product_id` = p.`product_id` WHERE `%s`.`customer_id` = \'%s\' ORDER BY `order_time`',$this->_table,$this->_table,$this->_table,$this->_table,$customer_id);
		//echo $sql;
		$sth = $this->_dbHandle->prepare($sql);
        $sth->execute();

        return $sth->fetchAll();
	}
}