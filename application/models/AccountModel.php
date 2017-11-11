<?php

/**
 * 用户Model
 */
class AccountModel extends Model{
	public $_table = 'sc_customers';
	public function __construct($level = 0){
		parent::__construct();
		if($level == 1){
			$this->_table = 'sc_customers';
		}
		else{
			$this->_table = 'sc_customer_address';
		}
	}
	public function select_all_address($id){
		$sql = sprintf('SELECT `%s`.*,`%s`.* FROM `%s` LEFT JOIN `%s` ON `%s`.`customer_id` = `%s`.`customer_id` WHERE `%s`.`customer_id` LIKE \'%s\' ORDER BY address_is_default_for_goods', 'sc_customer_address',$this->_table,'sc_customer_address', $this->_table,'sc_customer_address',$this->_table,$this->_table,$id);
        //echo $sql.'<br>';
		$sth = $this->_dbHandle->prepare($sql);
        $sth->execute();

        return $sth->fetchAll();
	}
	public function select_address($address_id){
		$sql = sprintf('SELECT `%s`.*,`%s`.* FROM `%s` LEFT JOIN `%s` ON `%s`.`customer_id` = `%s`.`customer_id` WHERE `%s`.`address_id` LIKE \'%s\'' , 'sc_customer_address',$this->_table,'sc_customer_address', $this->_table,'sc_customer_address',$this->_table,'sc_customer_address',$address_id);
        //echo $sql.'<br>';
		$sth = $this->_dbHandle->prepare($sql);
        $sth->execute();

        return $sth->fetchAll();
	}
}