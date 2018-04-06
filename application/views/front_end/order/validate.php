<?php
print_r($address);
$coupon_value = isset($coupon['coupon_value']) ? $coupon['coupon_value'] : 0;
$product_list = '<div class="bottom_line font_small">
                 	<div class="col-5 horizontal_layout">ARTKEL</div>
					<div class="col-2 horizontal_layout">ANZAHL</div>
					<div class="col-2 horizontal_layout">EINZELPREIS</div>
					<div class="col-2 horizontal_layout">GESAMTBETRAG</div>
                </div>';
$i = 0;
foreach($cart->data AS $key=>$value){
	$product_list .= '<div class="bottom_line font_small">
						 <div class="col-5 horizontal_layout">
						 	<div class="horizontal_layout"><img class="product_delete" id="i' . $items[$i]['product_id'] . '" src="../static/img/delete.png" /></div>
							<div class="horizontal_layout"><img src="../static/upload/product_photo/' . $items[$i]['product_sn'] . '/' . $items[$i]['photo_name'] . '" width="50rem" /></div>
							<div class="horizontal_layout">
								<div>' . $items[$i]['product_sn'] . '</div>
								<div class="bold-font">' . $items[$i]['product_name'] . '</div>
								<div>' . $items[$i]['product_size'] . '</div>
								<div>' . $value['color'] . '</div>
							</div>
						 </div>
						 <div class="col-2 horizontal_layout"><input type="number" class="grey_border small_textbox product_sold_amount" name="count_' . $items[$i]['product_id'] . '"  value="' . $value['count'] . '"/></div>
						 <div class="col-2 horizontal_layout"><span id="price_' . $items[$i]['product_id'] . '">' . $value['price'] . '</span> &euro;</div>
						 <div class="col-2 horizontal_layout"><span id="money_' . $items[$i]['product_id'] . '" class="money">' . $value['money'] . '</span> &euro;</div>
                     </div>';
	$i++;
}
?>
<style>
input.grey_border,select.grey_border{
	border:1px solid #CCC;
	height:2rem;
	width:20rem;
	font-size:1rem;
}
ul.buy_process{
	list-style:none;
	width:90%;
	border-bottom:1px solid #000;
	padding-bottom:1.5rem;
	
}
ul.buy_process li{
	float:left;
	font-size:0.8rem;
	margin-right:8rem;
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
div.padding_top{
	padding-top:2rem;
}
div.padding_bottom{
	padding-bottom:1rem;
}
div.padding_both{
	padding:1rem;
}
div.font_small{
	font-size:1rem;
}
div.bottom_bold_line{
	border-bottom:2px solid #000
}
div.bottom_line{
	border-bottom:1px solid #000
}
input.middle_textbox{
	width:8rem;
}
input.small_textbox{
	width:4rem;
}
div.right{
	text-align:right;
}
div.big_margin{
	margin-top:5rem;
}
div.bottom_grey_line{
	border-bottom:#CCC 1px solid;	
	padding:1rem;
}
div.sub_title{
	margin:2rem 0;
	border-bottom:#CCC 1px solid;	
}
input.lang{
	width:20rem;
}
</style>
<script>
$(function(){
	$('.edit_view').hide();
	$('#add_order').click(function(){
		if($('#abg').prop('checked')){
			document.frmValidate.submit();
		}
	});
	$('#change_to_edit').click(function(){
		$('.show_view').hide();
		$('.edit_view').show();
	});
	$('#change_to_show').click(function(){
		$('#customer_email').text($('#customer_email_edit').val());
		$('#customer_mobile').text($('#customer_mobile_edit').val());
		$('#customer_firstname').text($('#customer_firstname_edit').val());
		$('#customer_lastname').text($('#customer_lastname_edit').val());
		$('#address_street').text($('#address_street_edit').val());
		$('#address_street_number').text($('#address_street_number_edit').val());
		$('#address_zipcode').text($('#address_zipcode_edit').val());
		$('#address_city').text($('#address_city_edit').val());
		$('#address_country').text($('#address_country_edit').val());
		$('.show_view').show();
		$('.edit_view').hide();
	});
	$('#no_change_to_show').click(function(){
		$('#customer_email_edit').val($('#customer_email').text());
		$('#customer_mobile_edit').val($('#customer_mobile').text());
		$('#customer_firstname_edit').val($('#customer_firstname').text());
		$('#customer_lastname_edit').val($('#customer_lastname').text());
		$('#address_street_edit').val($('#address_street').text());
		$('#address_street_number_edit').val($('#address_street_number').text());
		$('#address_zipcode_edit').val($('#address_zipcode').text());
		$('#address_city_edit').val($('#address_city').text());
		$('#address_country_edit').val($('#address_country').text());
		$('.show_view').show();
		$('.edit_view').hide();
	});
});
</script>
<div id="main_page_content">
    <div class="main_container">
        <div class="main_content_container row">
            <div class="col-12">
                <ul class="buy_process">
                <li>WARENKORB</li>
                <li>ADRESSDATEN</li>
                <li>VERSAND & BEZAHLMETHODE</li>
                <li class="current">BEST&Auml;TIGUNG</li>
                </ul>    
            </div>
            <form name="frmValidate" id="frmValidate" action="<?php echo PROJECT_DIR?>order/add" method="post">
            <div class="col-12">
            	<div class="bottom_bold_line">
                    <div class="col-12 horizontal_layout padding_both"><?php echo $title?></div>
                </div>
                <?php echo $product_list?>    

                <div class="bottom_bold_line font_small">
                	<div class="col-7 horizontal_layout"></div>
                    <div class="col-4 horizontal_layout">
                    	<div class="horizontal_layout right col-8">SUMME ARTIKEL (NETTO):</div><div class="horizontal_layout col-3 right"><span id="sum_price_netto"><?php echo number_format($cart->sum('money')*0.81,2)?></span> &euro;</div>
                        <div class="horizontal_layout right col-8">ZZGL. 19% MWST, BETRAG:</div><div class="horizontal_layout col-3 right"><span id="sum_price_mwst"><?php echo number_format($cart->sum('money')*0.19,2)?></span> &euro;</div>
                        <div class="horizontal_layout right col-8">SUMME ARTIKEL (BRUTTO):</div><div class="horizontal_layout col-3 right"><span id="sum_price_brotto"><?php echo number_format($cart->sum('money'),2)?></span> &euro;</div>
                        <div class="bottom_line padding_bottom">
                        	<div class="horizontal_layout right col-8">GUTSCHEIN:</div><div class="horizontal_layout col-3  right"><span id="coupon"><?php echo $coupon_value?></span> &euro;</div>
                        </div>
                        <div class="horizontal_layout bold-font right col-8">GESAMTBETRAG:</div><div class="horizontal_layout col-3 bold-font right"><span  id="sum_price"><?php echo number_format($cart->sum('money') - $coupon_value,2)?></span> &euro;</div>
                        
                        
                    </div>
                </div>
                 <div class=" font_small">RECHNUNGADRESS:</div>
                 <div class="show_view font_small">
                 	<div class="padding_bottom"><span id="change_to_edit" style="cursor:pointer">&Auml;ndern</span></div>
                 	<div class="padding_bottom"><span id="customer_email">Email: <?php echo isset($address[0]['customer_email'])?$address[0]['customer_email']:''?></span></div>
                    <div class="padding_bottom">Tel.: <span id="customer_mobile"><?php echo isset($address[0]['customer_mobile'])?$address[0]['customer_mobile']:''?></span></div>
                    <div class="padding_bottom"><span id="customer_firstname"><?php echo isset($address[0]['customer_firstname'])?$address[0]['customer_firstname']:''?></span> <span id="customer_lastname"><?php echo isset($address[0]['customer_lastname'])?$address[0]['customer_lastname']:''?></span></div>
                    <div class="padding_bottom"><span id="address_street"><?php echo isset($address[0]['address_street'])?$address[0]['address_street']:''?></span> <span id="address_street_number"><?php echo isset($address[0]['address_street_number'])?$address[0]['address_street_number']:''?></span></div>
                    <div class="padding_bottom"><span id="address_zipcode"><?php echo isset($address[0]['address_zipcode'])?$address[0]['address_zipcode']:''?></span> <span id="address_city"><?php echo isset($address[0]['address_city'])?$address[0]['address_city']:''?></span></div>
                    <div class="padding_bottom"><span id="address_country"><?php echo isset($address[0]['address_country'])?$address[0]['address_country']:''?></span></div>
                    
                 </div>
                 
                 <div class="edit_view font_small">
                 	<div class="padding_bottom"><span id="change_to_show" style="cursor:pointer">Speichen</span>&nbsp;&nbsp;<span id="no_change_to_show" style="cursor:pointer">Abbrechen</span></div>
                 	<div class="padding_bottom">Email: <input class='grey_border big_textbox' type="text" name="customer_email_edit" id="customer_email_edit" value="<?php echo isset($address[0]['customer_email'])?$address[0]['customer_email']:''?>" /></div>
                    <div class="padding_bottom">Tel.: &nbsp;&nbsp; <input class='grey_border big_textbox' type="text" name="customer_mobile_edit" id="customer_mobile_edit" value="<?php echo isset($address[0]['customer_mobile'])?$address[0]['customer_mobile']:''?>" /> </div>
                    <div class="padding_bottom"><input class='grey_border middle_textbox' type="text" name="customer_firstname_edit" id="customer_firstname_edit" value="<?php echo isset($address[0]['customer_firstname'])?$address[0]['customer_firstname']:''?>" /> <input class='grey_border middle_textbox' type="text" name="customer_lastname_edit" id="customer_lastname_edit" value="<?php echo isset($address[0]['customer_lastname'])?$address[0]['customer_lastname']:''?>" /></div>
                    <div class="padding_bottom"><input class='grey_border middle_textbox' type="text" name="address_street_edit" id="address_street_edit" value="<?php echo isset($address[0]['address_street'])?$address[0]['address_street']:''?>" /> <input class='grey_border middle_textbox' type="text" name="address_street_number_edit" id="address_street_number_edit" value="<?php echo isset($address[0]['address_street_number'])?$address[0]['address_street_number']:''?>" /></div>
                    <div class="padding_bottom"><input class='grey_border middle_textbox' type="text" name="address_zipcode_edit" id="address_zipcode_edit" value="<?php echo isset($address[0]['address_zipcode'])?$address[0]['address_zipcode']:''?>" /> <input class='grey_border middle_textbox' type="text" name="address_city_edit" id="address_city_edit" value="<?php echo isset($address[0]['address_city'])?$address[0]['address_city']:''?>" /></div>
                    <div class="padding_bottom"><input class='grey_border middle_textbox' type="text" name="address_state_edit" id="address_state_edit" value="<?php echo isset($address[0]['address_state'])?$address[0]['address_state']:''?>" /> <input class='grey_border middle_textbox' type="text" name="address_country_edit" id="address_country_edit" value="<?php echo isset($address[0]['address_country'])?$address[0]['address_country']:''?>" /></div>
                    
                 </div>
                 
                 <div class="bottom_grey_line"></div>
                 <div class="font_small">
                 <input id="abg" name="abg" type="checkbox" value="" /> Ich habe die <a href="">AGB</a> gelesen und erkl&auml;re mich mit ihnen einverstanden. Ich wurd &uuml;ber mein <a href="">Widerrufsrecht</a> informiert.	
                 </div>
                <div class="col-9 horizontal_layout padding_both">
               		<input type="hidden" name="originator" value="<?php echo $originator ?>" />
                	<input type="hidden" value="<?php echo isset($address[0]['address_id'])?$address[0]['address_id']:''?>" id="address_id" name="address_id" />
                    <input type="hidden" value="<?php echo isset($coupon['coupon_value']) ? $coupon['coupon_value'] : 0;?>" id="coupon_value" name="coupon_value" />
                    <input type="hidden" value="<?php echo isset($coupon['coupon_id']) ? $coupon['coupon_id'] : 0;?>" id="coupon_id"  name="coupon_id" />
                    <input type="hidden" value="<?php echo isset($order_payment_type) ? $order_payment_type : 0;?>" id="order_payment_type" name="order_payment_type" />
                    <input type="hidden" value="<?php echo isset($logistics_id) ? $$logistics_id : 0;?>" id="logistics_id" name="logistics_id" />
                </div>
                <div class="col-1 horizontal_layout padding_both"><input id="add_order" type="button" value="ZAHLUNGSPFLICHTIG BESTELLEN" class="black_button to_check_out lang"></div>
            </div>   
            </form>    
        </div>
    </div>		
</div>
<input type="hidden" value="<?php echo PROJECT_DIR?>" id="PROJECT_DIR" />