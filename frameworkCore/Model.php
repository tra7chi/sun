<?php

class Model extends Sql{
    protected $_model;
    protected $_table;
    protected static $_dbConfig = array();

    public function __construct(){
        // connect to DB
        $this->connect(self::$_dbConfig['host'], self::$_dbConfig['username'], self::$_dbConfig['password'],
            self::$_dbConfig['dbname']);

        // get DB table name
        if (!$this->_table) {
            // get the name of Model class 
            $this->_model = get_class($this);
            // delete 'Model' substring from Model class name 
            $this->_model = substr($this->_model, 0, -5);

            // make DB table name and class name consistent (either uppercase or lowercase)
            // or in strict way, make them to be the same
            $this->_table = strtolower($this->_model);
        }
    }

    public static function setDbConfig($config){
        self::$_dbConfig = $config;
    }
}