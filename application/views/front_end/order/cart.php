<?php
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
</style>
<script>
$(function(){
	$('.product_sold_amount').change(function(){
		if(parseInt($(this).val()) >= 1){
			var key = $(this).attr('name').substring(6);
			$('#money_'+key).html($(this).val()*$('#price_'+key).html());
			var data = {product_id:key,product_count:$(this).val()};
			$.post($('#PROJECT_DIR').val() + 'Cart/update',data,function(){			
				price_compute();
			});	
		}
		else
			$(this).val(1);
	});
	$('#coupon_check').click(function(){
		$.post($('#PROJECT_DIR').val() + 'order/coupon_check',{coupon_code:$('#coupon_code').val()},coupon_feedback);
	});
	$('.product_delete').click(function(){
		var product_id = $(this).prop('id').substring(1,$(this).prop('id').length);
		$.post($('#PROJECT_DIR').val() + 'cart/delete',{product_id:product_id},product_delete_feedback);
	});
});
function product_delete_feedback(){
	location.reload(true);   
}
function coupon_feedback(data){
	if(data!='false'){
		var coupon = JSON.parse(data);
		$('#coupon').html(coupon.coupon_value);
		$('#coupon_id').val(coupon.coupon_id);
		price_compute();
	}
}
function price_compute(){
	var sum_money = 0;
	$('.money').each(function(index, element) {
		sum_money += parseFloat($(element).html());
	}); 
	$('#sum_price_netto').html((sum_money*0.81).toFixed(2));
	$('#sum_price_mwst').html((sum_money*0.19).toFixed(2));
	$('#sum_price_brotto').html(sum_money.toFixed(2));
	$('#sum_price').html(sum_money - parseFloat($('#coupon').html()));
}
</script>
<div id="main_page_content">
    <div class="main_container">
        <div class="main_content_container row">
            <div class="col-12">
                <ul class="buy_process">
                <li class="current">WARENKORB</li>
                <li>ADRESSDATEN</li>
                <li>VERSAND & BEZAHLMETHODE</li>
                <li>BEST&Auml;TIGUNG</li>
                </ul>    
            </div>
            <div class="col-10 ">
            	<form method="post" action="<?php echo PROJECT_DIR?>order/address">
                <div class="bottom_bold_line">
                    <div class="col-9 horizontal_layout padding_both"><?php echo $title?></div>
                    <div class="col-1 horizontal_layout padding_both"><input type="submit" value="ZUR KASSE" class="black_button to_check_out"></div>
                </div>
                <?php echo $product_list?>    
                <div class="bottom_line font_small">
                    <div class="col-2  horizontal_layout padding_both">GUTSCHEINCODE:</div>
                    <div class="horizontal_layout padding_both"><input type="text" id="coupon_code" value="" class="grey_border middle_textbox"></div>
                    <div class="horizontal_layout padding_both"><input type="button" id="coupon_check" value="ABSENDEN" class="black_button"></div>
                    <div class="horizontal_layout padding_both" id="coupon_feedback"></div>
                </div>
                <div class="bottom_bold_line font_small">
                	<div class="col-7 horizontal_layout"></div>
                    <div class="col-4 horizontal_layout">
                    	<div class="horizontal_layout right col-8">SUMME ARTIKEL (NETTO):</div><div class="horizontal_layout col-3 right"><span id="sum_price_netto"><?php echo number_format($cart->sum('money')*0.81,2)?></span> &euro;</div>
                        <div class="horizontal_layout right col-8">ZZGL. 19% MWST, BETRAG:</div><div class="horizontal_layout col-3 right"><span id="sum_price_mwst"><?php echo number_format($cart->sum('money')*0.19,2)?></span> &euro;</div>
                        <div class="horizontal_layout right col-8">SUMME ARTIKEL (BRUTTO):</div><div class="horizontal_layout col-3 right"><span id="sum_price_brotto"><?php echo number_format($cart->sum('money'),2)?></span> &euro;</div>
                        <div class="bottom_line padding_bottom">
                        	<div class="horizontal_layout right col-8">GUTSCHEIN:</div><div class="horizontal_layout col-3  right"><span id="coupon">0</span> &euro;</div>
                        </div>
                        <div class="horizontal_layout bold-font right col-8">GESAMTBETRAG:</div><div class="horizontal_layout col-3 bold-font right"><span  id="sum_price"><?php echo number_format($cart->sum('money'),2)?></span> &euro;</div>
                        
                        
                    </div>
                </div>
                <div class="col-9 horizontal_layout padding_both"><input type="hidden" value="" id="coupon_id" name="coupon_id"></div>
                <div class="col-1 horizontal_layout padding_both"><input type="submit" value="ZUR KASSE" class="black_button to_check_out"></div>
                </form>
        </div>
    </div>		
</div>
<input type="hidden" value="<?php echo PROJECT_DIR?>" id="PROJECT_DIR" />