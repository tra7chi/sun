<?php

/**
 * 用户Model
 */
class ProductModel extends Model{
    public $_table = 'sc_products';
	public function select_from_cart($ids){
		$join_table = 'sc_product_photos';
		$sql = sprintf('SELECT `%s`.*,`%s`.`photo_name` FROM `%s` INNER JOIN `%s` ON `%s`.`product_id` = `%s`.`product_id` WHERE `%s`.`product_id` IN (%s) AND `%s`.`main_photo` = 1',$this->_table,$join_table,$this->_table,$join_table,$this->_table,$join_table,$this->_table,$ids,$join_table);
		//echo $sql;
		$sth = $this->_dbHandle->prepare($sql);
        $sth->execute();

        return $sth->fetchAll();
	} 
}