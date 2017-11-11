<?php
/**
* 
*/
class BE_OrderController extends Controller {
	
	public function index() {
		$im = new OrderModel();
		$items = $im->selectAll();
		$this->assign('title', 'Bestellung List');
		$this->assign('items', $items);
		$this->render();
	}
	public function manage($id='') {
		$item = array();
		$im = new OrderModel();
        $postUrl = PROJECT_DIR.'BE_order/add';
		$title = 'Einen neuen Bestellung hinzuf&uumlgen';
        if ($id) {
			$im = new OrderModel();
            $item = $im -> select('order_id',$id);
            $postUrl = PROJECT_DIR.'BE_order/update';
			$im = new OrderModel(1);
			$im ->where(array(sprintf('`sc_order_details`.`order_id` = \'%s\'',$id)));
			$data = array(
				array('sc_orders','order_id','i'),
				array('sc_products','product_id','i')
			);
			$product_list = $im -> joinSelect($data);
			
			$this->assign('product_list', $product_list);
 			$title = 'Einen Bestellung &auml;ndern';
        }
		
        $this->assign('title', $title);
        $this->assign('item', $item);
        $this->assign('postUrl', $postUrl);
        $this->render();
	}
	public function add() {
		$queryExecutionFeedback = 0;
		if(checkUnique($_POST['originator'])){
			$im = new OrderModel(0);
			$data['order_id'] = md5(uniqid());
			$data['order_sn'] = isset($_POST['order_sn']) ? $_POST['order_sn'] : '';
			$data['customer_id'] = isset($_POST['customer_id']) ? $_POST['customer_id'] : '';
			$data['order_time'] = isset($_POST['order_time']) ? $_POST['order_time'] : '';
			$data['order_sum_price'] = isset($_POST['order_sum_price']) ? $_POST['order_sum_price'] : '';
			$data['order_sum_weight'] = isset($_POST['order_sum_weight']) ? $_POST['order_sum_weight'] : '';
			$data['order_status'] = isset($_POST['order_status']) ? $_POST['order_status'] : '';
			$data['order_memo'] = isset($_POST['order_memo']) ? $_POST['order_memo'] : '';
			$data['order_payment_type'] = isset($_POST['order_payment_type']) ? $_POST['order_payment_type'] : '';
			$data['order_address_country'] = isset($_POST['order_address_country']) ? $_POST['order_address_country'] : '';
			$data['order_address_state'] = isset($_POST['order_address_state']) ? $_POST['order_address_state'] : '';
			$data['order_address_city'] = isset($_POST['order_address_city']) ? $_POST['order_address_city'] : '';
			$data['order_address_county'] = isset($_POST['order_address_county']) ? $_POST['order_address_county'] : '';
			$data['order_address_street'] = isset($_POST['order_address_street']) ? $_POST['order_address_street'] : '';
			$data['order_address_street_number'] = isset($_POST['order_address_street_number']) ? $_POST['order_address_street_number'] : '';
			$data['order_address_zipcode'] = isset($_POST['order_address_zipcode']) ? $_POST['order_address_zipcode'] : '';
			$data['coupon_fee'] = isset($_POST['coupon_fee']) ? $_POST['coupon_fee'] : '';
			$data['order_invoice_fee'] = isset($_POST['order_invoice_fee']) ? $_POST['order_invoice_fee'] : '';
			$data['order_delivery_fee'] = isset($_POST['order_delivery_fee']) ? $_POST['order_delivery_fee'] : '';
			$data['order_other_fee'] = isset($_POST['order_other_fee']) ? $_POST['order_other_fee'] : '';
			$data['order_contact_phone_number'] = isset($_POST['order_contact_phone_number']) ? $_POST['order_contact_phone_number'] : '';
			$data['order_receiver_firstname'] = isset($_POST['order_receiver_firstname']) ? $_POST['order_receiver_firstname'] : '';
			$data['order_receiver_lastname'] = isset($_POST['order_receiver_lastname']) ? $_POST['order_receiver_lastname'] : '';
			$queryExecutionFeedback = $im->add($data);
		}
		$this->assign('title', 'Erfolgreich Hinzuf&uuml;gung');
		$this->assign('class_desc', 'Bestellung');
		$this->assign('action_desc', 'hinzugef&uuml;gt');
        $this->assign('count', $queryExecutionFeedback);
		$this->assign('rewritePath', 'feedback');
		$this->assign('goback',  PROJECT_DIR . $this->_controller . '/index');
        $this->render();
	}
	public function update() {
		$queryExecutionFeedback = 0;
		if(checkUnique($_POST['originator'])){
			$im = new OrderModel(0);
			$data['order_id'] = isset($_POST['order_id']) ? $_POST['order_id'] : '';
			$data['order_sn'] = isset($_POST['order_sn']) ? $_POST['order_sn'] : '';
			$data['customer_id'] = isset($_POST['customer_id']) ? $_POST['customer_id'] : '';
			$data['order_time'] = isset($_POST['order_time']) ? $_POST['order_time'] : '';
			$data['order_sum_price'] = isset($_POST['order_sum_price']) ? $_POST['order_sum_price'] : '';
			$data['order_sum_weight'] = isset($_POST['order_sum_weight']) ? $_POST['order_sum_weight'] : '';
			$data['order_status'] = isset($_POST['order_status']) ? $_POST['order_status'] : '';
			$data['order_memo'] = isset($_POST['order_memo']) ? $_POST['order_memo'] : '';
			$data['order_payment_type'] = isset($_POST['order_payment_type']) ? $_POST['order_payment_type'] : '';
			$data['order_address_country'] = isset($_POST['order_address_country']) ? $_POST['order_address_country'] : '';
			$data['order_address_state'] = isset($_POST['order_address_state']) ? $_POST['order_address_state'] : '';
			$data['order_address_city'] = isset($_POST['order_address_city']) ? $_POST['order_address_city'] : '';
			$data['order_address_county'] = isset($_POST['order_address_county']) ? $_POST['order_address_county'] : '';
			$data['order_address_street'] = isset($_POST['order_address_street']) ? $_POST['order_address_street'] : '';
			$data['order_address_street_number'] = isset($_POST['order_address_street_number']) ? $_POST['order_address_street_number'] : '';
			$data['order_address_zipcode'] = isset($_POST['order_address_zipcode']) ? $_POST['order_address_zipcode'] : '';
			$data['coupon_fee'] = isset($_POST['coupon_fee']) ? $_POST['coupon_fee'] : '';
			$data['order_invoice_fee'] = isset($_POST['order_invoice_fee']) ? $_POST['order_invoice_fee'] : '';
			$data['order_delivery_fee'] = isset($_POST['order_delivery_fee']) ? $_POST['order_delivery_fee'] : '';
			$data['order_other_fee'] = isset($_POST['order_other_fee']) ? $_POST['order_other_fee'] : '';
			$data['order_contact_phone_number'] = isset($_POST['order_contact_phone_number']) ? $_POST['order_contact_phone_number'] : '';
			$data['order_receiver_firstname'] = isset($_POST['order_receiver_firstname']) ? $_POST['order_receiver_firstname'] : '';
			$data['order_receiver_lastname'] = isset($_POST['order_receiver_lastname']) ? $_POST['order_receiver_lastname'] : '';
			$queryExecutionFeedback = $im->update('order_id',$data['order_id'],$data);
		}
		$this->assign('title', 'Erfolgreich &Auml;nderung');
		$this->assign('class_desc', 'Bestellung');
		$this->assign('action_desc', 'ge&auml;ndert');
        $this->assign('count', $queryExecutionFeedback);
		$this->assign('rewritePath', 'feedback');
		$this->assign('goback',  PROJECT_DIR . $this->_controller . '/index');
        $this->render();
	}
	public function check_customer_name(){
		$im = new AccountModel(1);
		//echo strtoupper($_POST['customer_firstname']).strtoupper($_POST['customer_lastname']);
		$im->where(array(sprintf('`customer_firstname` = \'%s\' AND `customer_lastname` = \'%s\'',strtoupper($_POST['customer_firstname']),strtoupper($_POST['customer_lastname']))));
		$items = $im->selectAll();
		if(count($items)){
			$customer_id = $items[0]['customer_id'];
		}
		else
			$customer_id = 'error';
		echo $customer_id;
	}
	public function delete($order_id = null){
		$im = new OrderModel(0);
        $count = $im->delete('order_id',$order_id);
		$this->assign('title', 'Erfolgreich L&ouml;sung');
		$this->assign('class_desc', 'Bestellung');
		$this->assign('action_desc', 'gel&ouml;scht');
        $this->assign('count', $count);
		$this->assign('rewritePath', 'feedback');
		$this->assign('goback',  PROJECT_DIR . $this->_controller . '/index');
        $this->render();
    }
	public function update_order_detail(){
		$im = new OrderModel(1);
		$data['order_details_id'] = isset($_POST['order_details_id']) ? $_POST['order_details_id'] : '';
		$data['product_sold_amount'] = isset($_POST['product_sold_amount']) ? $_POST['product_sold_amount'] : '';
		$data['product_selling_price'] = isset($_POST['product_selling_price']) ? $_POST['product_selling_price'] : '';
		$im->update('order_details_id',$data['order_details_id'],$data);
	}
	public function delete_order_detail(){
		$im = new OrderModel(1);
		$order_details_id = isset($_POST['order_details_id']) ? $_POST['order_details_id'] : '';
		$im->delete('order_details_id',$order_details_id);
	}
}