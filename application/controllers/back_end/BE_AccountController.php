<?php
 
class BE_AccountController extends Controller{
    public function index($keyword){
        $keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';
		$im = new AccountModel(1);
        if ($keyword) {
            $items = $im->search($keyword);
        } else {
			$im->order(array('customer_firstname'));
            $items = $im->selectAll();
        }

        $this->assign('title', 'Kunden List');
        $this->assign('keyword', $keyword);
        $this->assign('items', $items);
        $this->render();
    }
	public function manage($id = 0){
		$item = array();
		$item_address = array();
        $postUrl = PROJECT_DIR.'be_account/add';
		$title = 'Einen neuen Kunde hinzuf&uumlgen';
        if ($id) {
			$im = new AccountModel(1);
            $item = $im->select('customer_id',$id);
            $postUrl = PROJECT_DIR.'be_account/update';
			$title = 'Einen Kunde &auml;ndern';
			$im = new AccountModel(2);
			$item_address = $im->select('customer_id',$id);
        }
		
        $this->assign('title', $title);
        $this->assign('item', $item);
		$this->assign('item_address', $item_address);
        $this->assign('postUrl', $postUrl);
        $this->render();
    }
    public function add(){
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
		$this->assign('title', 'Erfolgreich Registrierung');
		$this->assign('class_desc', 'Kunde');
		$this->assign('action_desc', 'hinzugef&uuml;gt');
        $this->assign('count', $count);
		$this->assign('redirectPage', 'feedback');
		$this->assign('goback',  PROJECT_DIR . $this->_controller . '/index');
        $this->render();
    }
	public function delete($customer_id){
		$im = new AccountModel(1);
        $count = $im->delete('customer_id',$customer_id);
		$this->assign('title', 'Erfolgreich L&ouml;sung');
		$this->assign('class_desc', 'Kunde');
		$this->assign('action_desc', 'gel&ouml;scht');
        $this->assign('count', $count);
		$this->assign('redirectPage', 'feedback');
		$this->assign('goback',  PROJECT_DIR . $this->_controller . '/index');
        $this->render();
	}
	public function update($customer_id){
		$data['customer_id'] = isset($_POST['customer_id']) ? $_POST['customer_id'] : '';
		$data['customer_sn'] = isset($_POST['customer_sn']) ? $_POST['customer_sn'] : '';
		$data['customer_registration_time'] = isset($_POST['customer_registration_time']) ? $_POST['customer_registration_time'] : '';
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
		
		$data1['address_id'] = isset($_POST['address_id']) ? $_POST['address_id'] : '';
		$data1['address_country'] = isset($_POST['address_country']) ? $_POST['address_country'] : '';
		$data1['address_city'] = isset($_POST['address_city']) ? $_POST['address_city'] : '';
		$data1['address_street'] = isset($_POST['address_street']) ? $_POST['address_street'] : '';
		$data1['address_street_number'] = isset($_POST['address_street_number']) ?  $_POST['address_street_number'] : '';
		$data1['address_zipcode'] = isset($_POST['address_zipcode']) ? $_POST['address_zipcode'] : '';
		$data1['address_is_default_for_goods'] = 1;
		$im = new AccountModel(1);
        $count = $im->update('customer_id',$data['customer_id'],$data);
		$im = new AccountModel(2);
        $count = $im->update('address_id',$data1['address_id'],$data1);
		$this->assign('count', 1);
		$this->assign('title', 'Erfolgreich Registrierung');
		$this->assign('class_desc', 'Kunde');
		$this->assign('action_desc', 'hinzugef&uuml;gt');
        $this->assign('count', $count);
		$this->assign('redirectPage', 'feedback');
		$this->assign('goback',  PROJECT_DIR . $this->_controller . '/index');
        $this->render();
	}
}