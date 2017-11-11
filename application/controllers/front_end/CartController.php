<?php
 
class CartController extends Controller{
    
    function add(){
		$product_id = isset($_POST["product_id"]) ? $_POST["product_id"] : '';
		$product_color = isset($_POST["product_color"]) ? $_POST["product_color"] : '';
		$product_count = isset($_POST["product_count"]) ? $_POST["product_count"] : '';
		$product_price = isset($_POST["product_price"]) ? $_POST["product_price"] : '';
		if($product_id != '' && $product_count != '' && $product_price != '' ){
			$cart = new CartModel();
			//update the count of an existed product
			if (isset($cart->data[$product_id])) {
				$cart->data[$product_id]['count'] += $product_count;
				$cart->data[$product_id]['money'] = $cart->data[$product_id]['count'] * $cart->data[$product_id]['price'];
			// insert a new product
			} else {
				$cart->data[$product_id]['price'] = $product_price;
				$cart->data[$product_id]['color'] = $product_color;
				$cart->data[$product_id]['count'] = $product_count;
				$cart->data[$product_id]['money'] = $product_count * $product_price;
			}
			$cart->save();
		}
		echo count($cart->data) . '$$' . $cart->sum('money');
	}
	function setCartView(){
		$ids = '';
		$cart = new CartModel();
		foreach ($cart->data AS $k => $v) {
			$ids .= ',\'' . $k . '\'';
		}
		$ids = substr($ids,1);
		//echo $ids;
		$im = new ProductModel();
		$im->where(array(sprintf('`sc_products`.`product_id` in (%s)',$ids),' AND `sc_product_photos`.`main_photo` = 1'));
		$data = array(
				array('sc_product_photos','product_id','i')
		);
		 
		$items = $im->joinSelect($data);
		//print_r($items);
		$htmlStr = '';
		for($i = 0; $i<count($items);$i++){
			$htmlStr .= '<div  class="cart_product_div"><div><img src="../../static/upload/product_photo/' . $items[$i]['product_sn'] . '/' . $items[$i]['photo_name'] . '" width="100%"/></div>
						 <div>'.$items[$i]['product_name'].'</div>
						 <div>'.$cart->data[$items[$i]['product_id']]['count'].'</div>
						 <div>'.$cart->data[$items[$i]['product_id']]['price'] * $cart->data[$items[$i]['product_id']]['count'].' &euro;</div></div>'; 
		}
		echo $htmlStr;
	}
	function update(){
		$product_id = isset($_POST["product_id"]) ? $_POST["product_id"] : '';
		$product_count = isset($_POST["product_count"]) ? $_POST["product_count"] : '';
		$cart = new CartModel();
		$cart->data[$product_id]['count'] = $product_count;
		$cart->data[$product_id]['money'] = $product_count * $cart->data[$product_id]['price'];
		$cart->save();
	}
	function delete(){
		$cart = new CartModel();
		unset($cart->data[$_POST['product_id']]);
		$cart->save();
		//$this->assign('rewritePath','cart');
		//$this->cart();
	}
}