<?php
 
class BE_LoginController extends Controller{
    // 首页方法，测试框架自定义DB查询
    public function index(){
        $this->assign('title', 'LOG IN');
		$this->assign('postUrl', PROJECT_DIR.'BE_login/login');
		$this->assign('header', APP_PATH . 'application/views/back_end/empty_header.php');
		$this->assign('footer', APP_PATH . 'application/views/back_end/empty_footer.php');
        $this->render();
    }
    // 操作管理
    public function login(){
      	$data = array(sprintf('employee_username =\'%s\' AND employee_password = \'%s\'',$_POST['employee_username'],$_POST['employee_password']));
		$im = new LoginModel();
		$im->where($data);
		$items = $im->selectAll();
		//print_r($items);
		if(count($items) != 0){
			//echo  $items[0];
			setcookie("employee_id",$items[0]['employee_id'], time()+3600,'/');
			setcookie("employee_username",$items[0]['employee_username'], time()+3600,'/');
			echo 'success';
			
		}
		else{
			echo "error";
		}
    }
	public function logout(){
		setcookie("employee_id",'', time()-3600);
		setcookie("employee_username",'', time()-3600);
		$this->assign('rewritePath', 'index');
		$this->index();
	}
    public function welcome(){
		$this->render();
	}
}