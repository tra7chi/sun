<?php

/**
 * 用户Model
 */
class MappingProductColorModel extends Model{
    public $_table = 'sc_mapping_product_color';

	public function get_Color($id){
		$table1 = 'sc_colors';
		$sql = sprintf('select m.*,c.color_name_de from `%s` AS m INNER JOIN `%s` AS c
		 ON m.color_id = c.color_id  WHERE m.`product_id` like \'%s\'',$this->_table,$table1,$id);
		//echo $sql;
		$sth = $this->_dbHandle->prepare($sql);
        $sth->execute();

        return $sth->fetchAll();
	}
}