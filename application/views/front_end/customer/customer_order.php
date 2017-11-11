<?php
$order_detail = '<table class="black"><tr><th width="15%">BESTELLUNG CODE</th><th>BESTELLUNG ZEIT</th><th>PREIS</th><th>STATE</th></tr>';
//echo print_r($items);
if(isset($items)){
	$order_sn = '';
	for($i = 0; $i < count($items) ; $i++){
		if($order_sn != $items[$i]['order_sn']){
			if($i != 0)
				$order_detail .= '</table></td></tr>';
			$price = $items[$i]['order_sum_price'] - $items[$i]['coupon_fee'] + $items[$i]['order_invoice_fee'] + $items[$i]['order_delivery_fee']  + $items[$i]['order_other_fee'];
			$status = '';
			if($items[$i]['order_status'] == 1){
				$status = 'Zu bezahlen';
			}
			else if($items[$i]['order_status'] == 2){
				$status = 'Bezahlt';
			}
			else if($items[$i]['order_status'] == 3){
				$status = 'Versandt';
			}
			else if($items[$i]['order_status'] == 4){
				$status = 'Zugestellt';
			}
			$order_detail .= '<tr>
								<td>' . $items[$i]['order_sn'] . '</td>
								<td>' . $items[$i]['order_time'] . '</td>
								<td>' . $price . '</td>
								<td>' . $status . '</td>
							</tr>';
			$order_detail .='<tr>
								<td></td><td colspan="3">
									<table class="black">
										<tr>
											<th></th><th>PRODUKT NAME</th><th>ANZAHL</th><th>PREIS</th>
										</tr>';
			$order_sn = $items[$i]['order_sn'];
		}
		else{
			
			$order_detail .= '<tr>								
								<td><img src="../static/upload/product_photo/' . $items[$i]['product_sn'] . '/' . $items[$i]['photo_name'] . '" height="80 rem"></td>
								<td>' . $items[$i]['product_name'] . '</td>
								<td>' . $items[$i]['product_sold_amount'] . '</td>
								<td>' . $items[$i]['product_selling_price'] . '</td>
							</tr>';
		}
	}
}
$order_detail .= '</table>';
?>
<style>
ul.buy_process{
	list-style:none;
	width:90%;
	border-bottom:1px solid #000;
	padding-bottom:1.5rem;
	
}
ul.buy_process li{
	float:left;
	font-size:0.8rem;
	margin-right:6rem;
}
ul.buy_process li.current {
	position: relative;
}
	
ul.buy_process li.current:after{
	content: "";
	height:0;
	width: 0;
	border-bottom: 5px solid #000;
	border-left: 5px solid transparent;
	border-right: 5px solid transparent;
	position: absolute;
	bottom: -0.5rem;
    left: 2rem;
}
table.black{
	width:98%;
	border:0;
	border-collapse:collapse;
	
}
table.black th{
	background-color:#000;
	color:#FFF;
	font-weight:bold;	
}
table.black td{
	border-bottom:#000 1px solid;
	text-align:center;
}
div.bottom_bold_line{
	text-align:center;
	border-bottom:2px solid #000
}
div.padding_both{
	padding:2rem;
}
div.bottom_line{
	border-bottom:1px solid #000;
	padding:1rem 0;
	cursor:pointer;
}
div#address,div#address_update{
	padding:2rem;
}
div#address_update{
	display:none;
}
div.font_small{
	font-size:1rem;
}
</style>
<script>
$(function(){

});

</script>
<div id="main_page_content">
    <div class="main_container">
        <div class="main_content_container row">
           <div class="col-12">
                <ul class="buy_process">
                <li class="current">MEINE BESTELLUNGEN</li>
                <li><a href="<?php echo PROJECT_DIR?>customer/wish_list">MEINE WUNSCHLIST</a></li>
                <li><a href="<?php echo PROJECT_DIR?>customer/">BESTELLUNGENRECHNUNGS- UND LIEFERADRESSE</a></li>
                <li><a href="<?php echo PROJECT_DIR?>customer/password">PASSWORT ÄNDERN</a></li>
                </ul>    
            </div>
            <div class="bottom_bold_line">
                    <div class="col-12 padding_both"><?php echo $title?></div>
            </div>
            <div class="bottom_line">
				<?php echo $order_detail?>
            </div>
        </div>
    </div>		
</div>
