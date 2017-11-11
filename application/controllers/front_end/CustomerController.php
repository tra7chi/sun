<?php
 
class CustomerController extends Controller{
    public function index(){
		$im = new AccountModel(1);
		if(isset($_COOKIE['customer_id'])){
			$item = $im->select_all_address($_COOKIE['customer_id']);
			$this->assign('item',$item);
		}
		
		$this->assign('title','RECHNUNGS- UND LIEFERADRESSE');
		$this->render();
	}
	public function password(){
		$im = new AccountModel(1);
		if(isset($_COOKIE['customer_id'])){
			$item = $im->select('customer_id',$_COOKIE['customer_id']);
			$this->assign('item',$item);
		}
		$this->assign('title','PASSWORD');
		$this->render();
	}
	public function password_update(){
		$im = new AccountModel(1);
		$customer_password = isset($_POST['customer_password']) ? $_POST['customer_password'] : '';
		$customer_new_password = isset($_POST['customer_new_password']) ? $_POST['customer_new_password'] : '';
		$data = array();
		$data['customer_password'] = $customer_new_password;
		if(isset($_COOKIE['customer_id'])){
			$item = $im->select('customer_id',$_COOKIE['customer_id']);
			if($item['customer_password'] == $customer_password){
				$im->update('customer_id',$_COOKIE['customer_id'],$data);
				echo 'success';
			}
			else{
				echo 'error1';
			}
		}
	}
	public function customer_order(){
		$im = new OrderModel(0);
		if(isset($_COOKIE['customer_id'])){
			$items = $im->select_all_with_detail($_COOKIE['customer_id']);
			$this->assign('items',$items);
		}
		$this->assign('title','BESTELLUNGEN');
		$this->render();	
	}
	public function wish_list(){
		$im = new WishListModel();
		if(isset($_COOKIE['customer_id'])){
			$im->where(array(sprintf("`sc_customer_wish_list`.`customer_id` = '%s'",$_COOKIE['customer_id']),' AND `sc_product_photos`.`main_photo` = 1'));
			$data = array(array('sc_products','product_id','i'),
						  array('sc_product_photos','product_id','i')
						  );
			$items = $im->joinSelect($data);
			$this->assign('items',$items);
		}
		$this->assign('title','WUNSCHLIST');
		$this->render();	
	}
	public function wish_list_add(){	
		if(isset($_COOKIE['customer_id'])){
			$data['wish_list_id'] = md5(uniqid());
			$data['customer_id'] = $_COOKIE['customer_id'];
			$data['product_id'] = isset($_POST['product_id']) ? $_POST['product_id'] : '';
			$im = new WishListModel();
			$count = $im->add($data);
			if($count == 1)
				echo 'success';
			else
				echo 'error';
		}	
	}
	public function wish_list_delete(){
		if(isset($_COOKIE['customer_id'])){
			$wish_list_id = isset($_POST['wish_list_id']) ? $_POST['wish_list_id'] : '';
			$im = new WishListModel();
			$count = $im->delete('wish_list_id',$wish_list_id);
			if($count == 1)
				echo 'success';
			else
				echo 'error';
		}	
	}
}