<?php 
/**
 *  Base Class of Controller
 */
class Controller {
    protected $_controller;
    protected $_action;
    protected $_view;
 
    // constructor: initiate properties, instantiate View
    public function __construct($controller, $action){
        $this->_controller = $controller;
        $this->_action = $action;
        $this->_view = new View($controller, $action);
    }

    // assign values to variables
    public function assign($name, $value){
        $this->_view->assign($name, $value);
    }

    // render view
    public function render(){
        $this->_view->render();
    }
}