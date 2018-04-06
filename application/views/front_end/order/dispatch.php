<?php 

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
	padding_top-top:2rem;
}
div.padding_bottom{
	padding_bottom:2rem;
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

</style>
<script>

</script>
<div id="main_page_content">
    <div class="main_container">
        <div class="main_content_container row">
            <div class="col-12">
                <ul class="buy_process">
                <li>WARENKORB</li>
                <li>ADRESSDATEN</li>
                <li class="current">VERSAND & BEZAHLMETHODE</li>
                <li>BEST&Auml;TIGUNG</li>
                </ul>    
            </div>
            <form action="<?php echo PROJECT_DIR?>order/validate" method="post">
            <div class="col-10">
                <div class="bottom_bold_line">
                    <div class="col-9 horizontal_layout padding_both"><?php echo $title?></div>
                    <div class="col-1 horizontal_layout padding_both"><input type="submit" value="ZUR KASSE" class="black_button to_check_out"></div>
                </div>
                <div class="col-12">
                	<div class="sub_title">1. VERSAND</div>
                    <div class="bottom_grey_line font_small"><input type="radio" name="logistics_id" value="1"> <img src="../static/img/logo_dhl.jpg"> DHL</div>
                    <div class="bottom_grey_line font_small"><input type="radio" name="logistics_id" value="2"> <img src="../static/img/logo_ups.jpg"> UPS Standard</div>
                    <div class="bottom_grey_line font_small"><input type="radio" name="logistics_id" value="3"> <img src="../static/img/logo_ups.jpg"> UPS Express</div>   
                </div>
                <div class="col-12">
                   <div class="sub_title">2. BEZAHLMETHODE</div>
                   <div class="bottom_grey_line font_small"><input type="radio" name="order_payment_type" value="1"> <img src="../static/img/logo_kreditcard.jpg"> Kredit Karte</div>
                   <div class="bottom_grey_line font_small"><input type="radio" name="order_payment_type" value="2"> <img src="../static/img/logo_ueberweisung.jpg"> &Uuml;berweisung</div>
                   <div class="bottom_grey_line font_small"><input type="radio" name="order_payment_type" value="3"> <img src="../static/img/logo_paypal.jpg"> Paypal</div>    
                </div>
                <div class="col-9 horizontal_layout padding_both">
                	<input type="hidden" value="<?php echo $address_id?>" id="address_id" name="address_id" >
                	<input type="hidden" value="<?php echo $coupon_id?>" id="coupon_id" name="coupon_id" >
                    <input type="hidden" value="<?php echo $guest_address['customer_email']?>" id="customer_email" name="customer_email" >
                    <input type="hidden" value="<?php echo $guest_address['order_receiver_lastname']?>" id="order_receiver_lastname" name="order_receiver_lastname" >
                    <input type="hidden" value="<?php echo $guest_address['order_receiver_firstname']?>" id="order_receiver_firstname" name="order_receiver_firstname" >
                    <input type="hidden" value="<?php echo $guest_address['order_address_street']?>" id="order_address_street" name="order_address_street" >
                    <input type="hidden" value="<?php echo $guest_address['order_address_street_number']?>" id="order_address_street_number" name="order_address_street_number" >
                    <input type="hidden" value="<?php echo $guest_address['order_address_zipcode']?>" id="order_address_zipcode" name="order_address_zipcode" >
                    <input type="hidden" value="<?php echo $guest_address['order_address_city']?>" id="order_address_city" name="order_address_city" >
                    <input type="hidden" value="<?php echo $guest_address['order_address_country']?>" id="order_address_country" name="order_address_country" >
                    <input type="hidden" value="<?php echo $guest_address['order_contact_phone_number']?>" id="order_contact_phone_number" name="order_contact_phone_number" >
                </div>
                <div class="col-1 horizontal_layout padding_both"><input type="submit" value="ZUR KASSE" class="black_button to_check_out"></div>
             </div>
             </form>   
        </div>
    </div>		
</div>
<input type="hidden" value="<?php echo PROJECT_DIR?>" id="PROJECT_DIR" />