<?php
 
class AccountController extends Controller{
     public function index1(){
		$this->assign('title','Anmeldung');
		$this->assign('postUrl',PROJECT_DIR.'account/login');
        $this->render();
    }
	public function index2(){
		$this->assign('title','Registrieren');
		$this->assign('postUrl',PROJECT_DIR.'account/register');
        $this->render();
    }
    public function login(){
        $data = array(sprintf('`customer_email` like \'%s\' AND `customer_password` like \'%s\'',$_POST['customer_email'],$_POST['customer_password']));
		$im = new AccountModel(1);
		$im->where($data);
		$items = $im->selectAll();
		if(count($items) != 0){
			//echo $items[0]['customer_id'];
			setcookie('customer_id',$items[0]['customer_id'], time()+3600,'/');
			echo 'success';
			
		}
		else{
			echo 'error';
		}
    }
	 public function logout(){
		setcookie('customer_id','', time()-3600,'/');
    }
    public function register(){
		$count = 0;
		if(checkUnique($_POST['originator'])){
			$data['customer_id'] = md5(uniqid());
			$data['customer_sn'] = 'C' . date("Ymdhs");
			$data['customer_registration_time'] = date("Y-m-d H:i:s");
			$data['customer_is_activated'] = 0;
			$data['customer_firstname'] = isset($_POST['customer_firstname']) ? strtoupper($_POST['customer_firstname']) : '';
			$data['customer_lastname'] = isset($_POST['customer_lastname']) ? strtoupper($_POST['customer_lastname']) : '';
			$data['customer_gender'] = isset($_POST['customer_gender']) ? $_POST['customer_gender'] : '';
			$data['customer_birthday'] = isset($_POST['customer_birthday']) ? $_POST['customer_birthday'] : '';
			$data['customer_email'] = isset($_POST['customer_email']) ? $_POST['customer_email'] : '';
			$data['customer_username'] = isset($_POST['customer_username']) ? $_POST['customer_username'] : '';
			$data['customer_password'] = isset($_POST['customer_password']) ? $_POST['customer_password'] : '';
			$data['customer_phone'] = isset($_POST['customer_phone']) ? $_POST['customer_phone'] : '';
			$data['customer_mobile'] = isset($_POST['customer_mobile']) ? $_POST['customer_mobile'] : '';
			$data['customer_fax'] = isset($_POST['customer_fax']) ? $_POST['customer_fax'] : '';
			
			$data1['address_id'] = md5(uniqid());
			$data1['customer_id'] = $data['customer_id'];
			$data1['address_country'] = isset($_POST['address_country']) ? $_POST['address_country'] : '';
			$data1['address_city'] = isset($_POST['address_city']) ? $_POST['address_city'] : '';
			$data1['address_street'] = isset($_POST['address_street']) ? $_POST['address_street'] : '';
			$data1['address_street_number'] = isset($_POST['address_street_number']) ? $_POST['address_street_number'] : '';
			$data1['address_zipcode'] = isset($_POST['address_zipcode']) ? $_POST['address_zipcode'] : '';
			$data1['address_is_default_for_goods'] = 1;
			$im = new AccountModel(1);
			$count = $im->add($data);
			$im = new AccountModel(2);
			$count = $im->add($data1);
		}
        $this->render();
    }
}