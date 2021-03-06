<?php 

class Sql{
    protected $_dbHandle;
    protected $_result;
    private $filter = '';
    // 连接数据库
    public function connect($host, $username, $password, $dbname){
        try {
            $dsn = sprintf("mysql:host=%s;dbname=%s;charset=utf8", $host, $dbname);
			//echo $dsn;
            $option = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC);
            $this->_dbHandle = new PDO($dsn, $username, $password, $option);
			//print_r($this->_dbHandle);
        } catch (PDOException $e) {
            exit('错误: ' . $e->getMessage());
        }
    }

    // 查询条件
    public function where($where = array()){
        if (isset($where)) {
            $this->filter .= ' WHERE ';
            $this->filter .= implode(' ', $where);
        }

        return $this;
    }

    // 排序条件
    public function order($order = array()){
        if(isset($order)) {
            $this->filter .= ' ORDER BY ';
            $this->filter .= implode(',', $order);
        }

        return $this;
    }

    // 查询所有
    public function selectAll(){
        $sql = sprintf("select * from `%s` %s", $this->_table, $this->filter);
        //echo $sql.'<br>';
		$sth = $this->_dbHandle->prepare($sql);
        $sth->execute();

        return $sth->fetchAll();
    }

    // 根据条件 (id) 查询
    public function select($id_name,$id){
        $sql = sprintf("select * from `%s` where `%s` like '%s' %s", $this->_table, $id_name,$id,$this->filter);
		//echo $sql;
        $sth = $this->_dbHandle->prepare($sql);
        $sth->execute();

        return $sth->fetch();
    }

    // 根据条件 (id) 删除
    public function delete($id_name,$id){
        $sql = sprintf("delete from `%s` where `%s` = '%s'", $this->_table, $id_name,$id);
        //echo $sql;
		$sth = $this->_dbHandle->prepare($sql);
        $sth->execute();

        return $sth->rowCount();
    }

    // 自定义SQL查询，返回查询结果
    public function query_r($sql){
		//echo $this->filter;
        $sth = $this->_dbHandle->prepare($sql.$this->filter);
        $sth->execute();

        return $sth->fetchAll();
    }

    // 自定义SQL查询，返回影响的行数
    public function query_c($sql){
		//echo $sql;
        $sth = $this->_dbHandle->prepare($sql);
        $sth->execute();

        return $sth->rowCount();
    }

    // 新增数据
    public function add($data){
        $sql = sprintf("insert into `%s` %s", $this->_table, $this->formatInsert($data));
		//echo $sql.'<br>';
        return $this->query_c($sql);
    }

    // 修改数据
    public function update($id_name,$id, $data){
        $sql = sprintf("update `%s` set %s where `%s` = '%s'", $this->_table, $this->formatUpdate($data),$id_name, $id);
		echo $sql;
        return $this->query_c($sql);
    }

	
	//data[0][0]->join table,data[0][1]->join column,data[0][2]->join type:i,l,r
	public function joinSelect($data){
		$sql = sprintf("SELECT `%s`.* %s %s",$this->_table,$this->formatJoin($this->_table,$data),$this->filter);
		//echo $sql;
		$sth = $this->_dbHandle->prepare($sql);
		$sth->execute();
        return $sth->fetchAll();
	}
    // 将数组转换成插入格式的sql语句
    private function formatInsert($data){
        $fields = array();
        $values = array();
        foreach ($data as $key => $value) {
            $fields[] = sprintf("`%s`", $key);
            $values[] = sprintf("'%s'", $value);
        }

        $field = implode(',', $fields);
        $value = implode(',', $values);

        return sprintf("(%s) values (%s)", $field, $value);
    }

    // 将数组转换成更新格式的sql语句
    private function formatUpdate($data){
        $fields = array();
        foreach ($data as $key => $value) {
            $fields[] = sprintf("`%s` = '%s'", $key, $value);
        }

        return implode(',', $fields);
    }
	// 将数组转换成连接格式的sql语句
    private function formatJoin($table,$data){
        $fields = array();
		$sql = '';
        for($i = 0;$i<count($data);$i++) {
			$sql = $sql . ',`' . $data[$i][0] ."`.*"; 
			if($data[$i][2] == 'i')
            	$fields[] = sprintf("INNER JOIN `%s` ON `%s`.`%s` = `%s`.`%s`", $data[$i][0],$table, $data[$i][1],$data[$i][0],$data[$i][1]);
			elseif($data[$i][2] == 'l')
            	$fields[] = sprintf("LEFT JOIN `%s` ON `%s`.`%s` = `%s`.`%s`", $data[$i][0],$table, $data[$i][1],$data[$i][0],$data[$i][1]);
			elseif($data[$i][2] == 'r')
            	$fields[] = sprintf("RIGHT JOIN `%s` ON `%s`.`%s` = `%s`.`%s`", $data[$i][0],$table, $data[$i][1],$data[$i][0],$data[$i][1]);
        }
		$sql = $sql . ' FROM `' . $table . '` ';
		$sql = $sql .implode(' ', $fields);
		
        return $sql;
    }
}