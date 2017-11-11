<?php
$address_list = '';
//print_r($items);
for($i = 0;$i<count($items);$i++){
	$address_list .= '<div class="padding_both">
						<div class="horizontal_layout">
							<input type="radio" name="address_id" value="' . $items[$i]['address_id'] . '"'; 
	if($i == 0)
		$address_list .= ' checked ';
	$address_list .= ' /></div>';
	$address_list .= '<div class="horizontal_layout">
						<div>' . $items[$i]['customer_firstname'] . ' ' . $items[$i]['customer_lastname'] . '</div>
						<div>' . $items[$i]['customer_email'] . '</div>
						<div>' . $items[$i]['customer_mobile'] . '</div>
						<div>' . $items[$i]['address_street'] . ' ' . $items[$i]['address_street_number'] . ' ' . $items[$i]['address_city'] . ' ' . $items[$i]['address_zipcode'] . ' ' . $items[$i]['address_country'] . 
						'</div>
					  </div>
					  </div>';
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
</style>
<script>
$(function(){
	$('.to_check_out').click(function(){
		if($('#delivery_address').prop('checked')){
			document.frm_address.submit();
		}
	});
});

</script>
<div id="main_page_content">
    <div class="main_container">
        <div class="main_content_container row">
            <div class="col-12">
                <ul class="buy_process">
                <li>WARENKORB</li>
                <li class="current">ADRESSDATEN</li>
                <li>VERSAND & BEZAHLMETHODE</li>
                <li>BEST&Auml;TIGUNG</li>
                </ul>    
            </div>
            <div class="col-10">
            	<form action="<?php echo PROJECT_DIR?>order/dispatch" id="frm_address" name="frm_address" method="post">
                <div class="bottom_bold_line">
                    <div class="col-9 horizontal_layout padding_both"><?php echo $title?></div>
                    <div class="col-1 horizontal_layout padding_both"><input type="button" value="ZUR KASSE" class="black_button to_check_out"></div>
                </div>
                <div>
                    <div class="horizontal_layout col-6">
                        <div>RECHNUNGSADRESSE</div>
                        <div class="font_small">
                        <?php echo $address_list?>
                        </div>
                    </div>
                    <div class="horizontal_layout">
                        <div>LIEFERSADRESSE</div>
                        <div class="font_small padding_both"><input id="delivery_address" name="delivery_address" type="checkbox" value="1" /> Rechnungaddress als Lieferadress verwenden</div>
                        <div class="big_margin">NEWSLETTER</div>
                        <div class="font_small padding_both"><input name="news" type="checkbox" value="1" /> Newsletter abonnieren</div>
                    </div>
                </div>
                <div class="col-9 horizontal_layout padding_both"><input type="hidden" value="<?php echo $coupon_id?>" id="coupon_id" name="coupon_id"></div>
                <div class="col-1 horizontal_layout padding_both"><input type="button" value="ZUR KASSE" class="black_button to_check_out"></div>
                
        </div>
    </div>		
</div>
<input type="hidden" value="<?php echo PROJECT_DIR?>" id="PROJECT_DIR" />