<?php
 
class OrderController extends Controller{
    
    function cart(){
		$cart = new CartModel();
		$product_id_list = $cart->implode_id(); 
		$im = new ProductModel();
		$items = $im->select_from_cart($product_id_list);
		$this->assign('items',$items);
		$this->assign('cart',$cart);
		$this->assign('title','WARENKORB');		
		//print_r($cart);
		$this->render();
	}
	//There are two cases
	//1. The code is invalid.
	//2. The code has been used by the current user  
	//We are currently only considering the case 1.
	function coupon_check(){
		$im = new CouponModel(0);
		$item = $im->select('coupon_code',$_POST['coupon_code']);
		echo json_encode($item);
	}
	function address(){
		$coupon_id = isset($_POST['coupon_id']) ? $_POST['coupon_id'] : '';
		$this->assign('title','ADRESSDATEN');
		if (isset($_COOKIE["customer_id"])){
			$im = new AccountModel(1);
			$items = $im->select_all_address($_COOKIE["customer_id"]);
			$this->assign('coupon_id',$coupon_id);
			$this->assign('items',$items);		
		}
		else{
			$this->assign('rewritePath','address_or_login');
				
		}
		$this->render();
	}
	function dispatch(){
		$coupon_id = isset($_POST['coupon_id']) ? $_POST['coupon_id'] : '';
		$address_id = isset($_POST['address_id']) ? $_POST['address_id'] : '';
		$this->assign('title','VERSAND & BEZAHLMETHODE');
		$this->assign('address_id',$address_id);
		$this->assign('coupon_id',$coupon_id);		
		$this->render();
	}
	function validate(){
		$address_id = isset($_POST['address_id']) ? $_POST['address_id'] : '';
		$coupon_id = isset($_POST['coupon_id']) ? $_POST['coupon_id'] : '';
		$logistics_id = isset($_POST['logistics_id']) ? $_POST['logistics_id'] : '';
		$order_payment_type = isset($_POST['order_payment_type']) ? $_POST['order_payment_type'] : '';
		$cart = new CartModel();
		$this->assign('cart',$cart);
		
		$product_id_list = $cart->implode_id(); 
		
		$im = new ProductModel();
		$items = $im->select_from_cart($product_id_list);
		$this->assign('items',$items);
		
		$im = new CouponModel(0);
		$coupon = $im->select('coupon_id',$coupon_id);
		$this->assign('coupon',$coupon);
		
		$im = new AccountModel(1);
		$address = $im->select_address($address_id);
		$this->assign('address',$address);
		
		
		
		
		$this->assign('title','BEST&Auml;TIGUNG');
		$this->assign('order_payment_type',$order_payment_type);
		$this->assign('logistics_id',$logistics_id);		
		$this->render();
	}
	function add(){
		$count = 0;
		if(checkUnique($_POST['originator'])){
			$address_id = isset($_POST['address_id']) ? $_POST['address_id'] : '';
			$im = new AccountModel(1);
			$address = $im->select_address($address_id);
			$coupon_value = isset($_POST['coupon_value']) ? $_POST['coupon_value'] : 0;
			$coupon_id = isset($_POST['coupon_id']) ? $_POST['coupon_id'] : '';
			$logistics_id = isset($_POST['logistics_id']) ? $_POST['logistics_id'] : ''; // not use now
			$order_payment_type = isset($_POST['order_payment_type']) ? $_POST['order_payment_type'] : '';
			$customer_id = isset($_COOKIE['customer_id']) ? $_COOKIE['customer_id'] : '';
			$cart = new CartModel();
			$order_id =  md5(uniqid());
			$data['order_id'] = $order_id;
			$data['order_sn'] = date('YmdHis');
			$data['customer_id'] = $customer_id;
			$data['order_time'] = date('Y-m-d H:i:s');
			$data['order_sum_price'] = $cart->sum('money');
			$data['order_sum_weight'] = 0;//not use now
			$data['order_status'] = 1;
			$data['order_memo'] = '';//not use now
			$data['order_payment_type'] = $order_payment_type;
			$data['order_address_country'] = isset($address[0]['address_country']) ? $address[0]['address_country'] : '';
			$data['order_address_state'] = isset($address[0]['address_state']) ? $address[0]['address_state'] : '';;
			$data['order_address_city'] = isset($address[0]['address_city']) ? $address[0]['address_city']: '';
			$data['order_address_county'] = isset($address[0]['address_county']) ? $address[0]['address_county']: '';
			$data['order_address_street'] = isset($address[0]['address_street']) ? $address[0]['address_street']: '';
			$data['order_address_street_number'] = isset($address[0]['address_street_number']) ? $address[0]['address_street_number']: '';
			$data['order_address_zipcode'] = isset($address[0]['address_zipcode']) ? $address[0]['address_zipcode']: '';
			$data['coupon_fee'] = $coupon_value;
			$data['order_invoice_fee'] = '0';//not use now
			$data['order_delivery_fee'] = '0';//not use now
			$data['order_other_fee'] = '0';
			$data['order_contact_phone_number'] = isset($address[0]['address_tel']) ? $address[0]['address_tel']: '';
			$data['order_receiver_firstname'] = isset($address[0]['address_firstname']) ? $address[0]['address_firstname']: '';
			$data['order_receiver_lastname'] = isset($address[0]['address_lastname']) ? $address[0]['address_lastname']: '';
			$im = new OrderModel(0);
			$count = $im->add($data);
		}
		if($count != 0){			
			foreach($cart->data AS $key=>$value){
				$data1['order_details_id'] = md5(uniqid());
				$data1['order_id'] = $order_id;
				$data1['product_id'] = $key;
				$data1['product_sold_amount'] = $value['count'];
				$data1['product_selling_price'] = $value['price'];
				$data1['product_color'] = $value['color'];
				$im = new OrderModel(1);
				$im->add($data1);
			}
			if($customer_id!=''){
				$data2['customer_coupon_id'] = md5(uniqid());
				$data2['order_id'] = $order_id;
				$data2['customer_id'] = $customer_id;
				$data2['coupon_id'] = $coupon_id;
				$im = new CouponModel(1);
				$im->add($data2);
			}
			$this->assign('title','Erfolg!');
			
			//send email
			//create pdf-order
			require_once('../../frameworkCore/tcpdf/tcpdf.php');
			// create new PDF document
			$pdf = new PDFModel(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);	
			// set document information
			$pdf->SetCreator(PDF_CREATOR);
			$pdf->SetAuthor('sun-cashmere');
			$pdf->SetTitle('sun-cashmere order');
			$pdf->SetSubject('order');
		
			// set default header data
			$pdf->SetHeaderData();
			$pdf->setFooterData();
		
			// set header and footer fonts
			$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
			$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
		
			// set default monospaced font
			$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
			
			// set margins
			$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
			$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
			$pdf->SetFooterMargin(PDF_MARGIN_FOOTER+20);
			
			// set auto page breaks
			$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM+15);
			
			// set image scale factor
			$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
			
			// set some language-dependent strings (optional)
			if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
				require_once(dirname(__FILE__).'/lang/eng.php');
				$pdf->setLanguageArray($l);
			}	
			// set font
			$pdf->SetFont('stsongstdlight', '', 12);
			$pdf->AddPage();
			$html = <<< EOD
EOD;

			// output the HTML content
			$pdf->writeHTML($html, true, false, true, false, '');

			// reset pointer to the last page
			$pdf->lastPage();
			// Close and output PDF document
			// This method has several options, check the source code documentation for more information.
			$pdf->Output('upload/payment/' . $data['order_sn'] . '.pdf', 'F');
			
			//send email
			require_once("../../frameworkCore/email/class.phpmailer.php");
			
				$mail  = new PHPMailer();
				$mail->SMTPDebug = 1;
				$mail->CharSet    = "UTF-8";
				$mail->IsSMTP(); // telling the class to use SMTP
				$mail->SMTPAuth   = true;
				$mail->Host       = "smtp.1und1.de"; // SMTP server
				$mail->SMTPSecure = 'ssl';
				$mail->Port       = 465;  
				$mail->Username   = "system@sun-cashmere.com";
				$mail->Password   = "12345asd";
				$mail->From       = "system@sun-cashmere.com";
				$mail->FromName   = "Sun-cashmere System";
				$mail->Subject    = "Sun cashmere order";
				$body = ""; // optional, comment out and test
				$mail->MsgHTML($body);
				$mail->AddAttachment('upload/payment/' . $data['order_sn'] . '.pdf');
				//get $customer_email and $customer_username.
				$im = new AccountModel(1);
				$item  = $im->select('customer_id',$customer_id);
				
				$mail->AddAddress($item['customer_email'], $item['$customer_username']);
				
				if($mail->Send()) {
					echo "success";
				}
				else
					echo "error". $mail->ErrorInfo;
			
			
			$this->render();			
		}
		else{
			$this->assign('rewritePath','order_error');
			$this->render();	
		}
	}

}