<?php
/**
 * Base Class of View
 */
class View {
    protected $variables = array();
    protected $_controller;
    protected $_action;
	protected $_feedback_content;
    function __construct($controller, $action){
        $this->_controller = strtolower($controller);
        $this->_action = strtolower($action);
    }
 
    // assign values to variables
    public function assign($name, $value){
        $this->variables[$name] = $value;
    }
 
    // render view
    public function render(){
        extract($this->variables);
		print_r($this);
		$controllerHeader = isset($header) ? $header : '';
		$controllerFooter = isset($header) ? $header : '';
		$redirectPage = isset($rewritePath) ? $rewritePath : '';
		//echo $this->_controller;
		//echo $redirectPage;
		if(strpos($this->_controller,'be_') === 0){
			$defaultHeader = APP_PATH . 'application/views/back_end/header.php';
        	$defaultFooter = APP_PATH . 'application/views/back_end/footer.php';
			//echo strpos($this->_action,'add');
			//echo $_COOKIE["employee_id"];
			if (isset($_COOKIE["employee_id"])){
				if($redirectPage != ''){
					$controllerLayout = APP_PATH . 'application/views/back_end/' . $this->_controller . '/' . $redirectPage . '.php';
				}
				else{
					$controllerLayout = APP_PATH . 'application/views/back_end/' . $this->_controller . '/' . $this->_action . '.php';
				}
				if($redirectPage == 'feedback'){
					$this->create_feedback();
					$controllerLayout = APP_PATH . 'application/views/back_end/' . $redirectPage . '.php';
				}
			}
			else{
				$title = 'Log in';
				$controllerHeader = APP_PATH . 'application/views/back_end/empty_header.php';
				$controllerFooter = APP_PATH . 'application/views/back_end/empty_footer.php';
				$controllerLayout = APP_PATH . 'application/views/back_end/be_login/index.php';
			}
			
		}
		else{
			$defaultHeader = APP_PATH . 'application/views/front_end/header.php';
        	$defaultFooter = APP_PATH . 'application/views/front_end/footer.php';
        	if($redirectPage != ''){
				$controllerLayout = APP_PATH . 'application/views/front_end/' . $this->_controller . '/' . $redirectPage . '.php';
			}
			else{
				$controllerLayout = APP_PATH . 'application/views/front_end/' . $this->_controller . '/' . $this->_action . '.php';
			}
		}
        // import page header file
		//echo '$controllerHeader:'.$controllerHeader.'<br />';
		//echo '$controllerLayout:'.$controllerLayout.'<br />';
        if (file_exists($controllerHeader)) {
            include ($controllerHeader);
        }
		else
			include ($defaultHeader); 
        include ($controllerLayout);
        
        // import page footer file
        if (file_exists($controllerFooter)) {
            include ($controllerFooter);
        }
		else{
			include ($defaultFooter);
		} 
    }
	public function create_feedback(){
		extract($this->variables);
		$this->_feedback_content = sprintf('<div id="main_page_content">
    											<div class="main_container">
        												<div class="main_content_container row">
            												<div class="col-12 bigger-font title_bottom_line">%s</div>
           													Sie habe schon %s %s erfolgreich %s, bitte klicken Sie "zur&uuml;ck" Druckknopf, umzu zur&uuml;ck.
            												<div class="col-12 bigger-font title_top_line"><a class="black_button" href="%s">Zur&uuml;ck</a></div>
        													</div>
    											</div>
											</div>',$title,$count,$class_desc,$action_desc,$goback);
	}
}