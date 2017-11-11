<?php $dir = $_SERVER['REQUEST_URI'];
//print_r($item);
$shareUrl = 'www.sun-cashmere/product/manage/' . $item[0]['product_id'];
$html_str = '<div class="col-5 horizontal_layout product_cell">
				<div class="product_text big_font uppercase bold-font">
					<a href="' . PROJECT_DIR . 'product/index/' . $item[0]['category_level_1_id'] . '">'.$item[0]['category_level_1_name'].'</a>/
					<a href="' . PROJECT_DIR . 'product/index/' . $item[0]['category_level_2_id'] . '">'.$item[0]['category_level_2_name'].'</a>
				</div>
				<img id="main_photo" src="../../static/upload/product_photo/' . $item[0]['product_sn'] . '/' . $item_photos[0]['photo_name'] . '" width="100%" />';
for($i = 0;$i < count($item_photos);$i++){
	$html_str = $html_str .'<div class="horizontal_layout"><img class="photos link" src="../../static/upload/product_photo/' . $item[0]['product_sn'] . '/' . $item_photos[$i]['photo_name'] . '" height="100px" /></div>';
}
$html_str .= '</div>
			 <div class="col-6 horizontal_layout">
			 	<div class="product_text bigger_font uppercase" id="product_name">'.$item[0]['product_name'].'</div>
				<div class="product_text big_font uppercase">Produkt SN: '.$item[0]['product_sn'].'</div>
				<div class="product_text big_font uppercase">Farbe: ';
							//print_r($item_colors);
for($i = 0;$i < count($item_colors);$i++){
	$html_str = $html_str .'<div class="horizontal_layout">
							<div>
								<img name="' . $item_colors[$i]['color_name_de'] . '" class="colors link" src="../../static/upload/color/' . $item_colors[$i]['color_id'] . '.jpg" height="30px" />
							</div>
							<div class="middle_font">' . $item_colors[$i]['color_name_de'] . '</div></div>';
}								
$html_str .= '</div>
			  	<div class="product_text big_font uppercase">Gr&ouml;&szlig;e: '.$item[0]['product_size'].'</div>
				<div class="product_text bigger_font">Preis: <span id="product_price">'.$item[0]['product_selling_price'].'</span> &euro; <span class="big_font">(inkl. Mwst 19%)</span></div>
				<div class="product_text big_font uppercase">Menge: <input type="number" id="product_count" class="grey_border small_textbox" value="1"></div>
				<div>Beschreibung:</div>
				<div>' . $item[0]['product_description'] . '</div>
				<div class="product_text big_font">
					<a href="#" class="black_button uppercase" id="insertTowunschlist"><span class="middle_font">In dem Wunschlist</span></a>
					<a href="#" class="black_button uppercase" id="insertToCart"><span class="middle_font">In dem Warenkorb</span></a>
				</div>
				<div id="share"></div>
			  </div>
<input type="hidden" id="product_id" value="'.$item[0]['product_id'].'"><input type="hidden" id="PROJECT_DIR" value="'.PROJECT_DIR.'">';
?>
<style>
input.grey_border,select.grey_border{
	border:1px solid #CCC;
	height:2rem;
	width:20rem;
	font-size:1rem;
	margin-right:0.5rem;
}
input.small_textbox{
	width:4rem;
}
.feedback{
	width:50rem;
	height:30rem;
	position:absolute;
	left:25%;
	top:10rem;
	background:#FFF;
	border-radius:0.5rem;
	border:0.02rem solid #000;
	display:none;
}
.feedback .button1{
	position:absolute;
	width:30%;
	top:85%;
	left:15%;
}
.feedback .button2{
	position:absolute;
	width:30%;
	top:85%;
	left:60%
}
.feedback #feedback_photo_div{
	position:absolute;
	width:50%;
	top:10%;
	left:25%;
	height:50%;
}
.feedback #detail{
	position:absolute;
	top:60%;
	left:10%;
	font-size:1.5rem;
}
#cart{
	display:none;
}
.cart_product_div{
    display: inline-block;
    width: 10%;
    margin: 1%;
    vertical-align: top;
	
}
.cart_product_div div{
	width:100%;
	font-size:1.2rem;
	text-align:center;	
}
.cart_view_container{
	display:none;
	position: absolute;
    top: 10rem;
    left: 0;
    width: 100%;
    height: 30rem;
    z-index: 1000;
    background-color: #FFF;
}
.cart_view_cell1{
    position: absolute;
    left: 0;
    top: 0;
    width: 60%;
    height: 100%;
    font-size: 1.2rem;
    text-align: center;
}
.cart_view_cell2{
	position:absolute;
	left:61%;
	top:0;
	width:39%;
	height:100%;
	font-size:1.2rem;
}
#cart_view_container_close{
	width: 3rem;
	height: 3rem;
	background-color: #000;
	right: 0;
	top: 0;
	position: absolute;
	color: white;
	text-align: center;
	line-height: 3rem;
}
</style>

<script>
$(function(){
	$('img.photos').click(function(){
		$("#main_photo").attr('src' , $(this).attr('src'));
	});
	$('img.colors').click(function(){
		$('img.colors').each(function(index, element) {
            $(element).css('border','1px solid #000');			
        });
		$(this).css('border','2px solid #000');
		$('#product_color').val($(this).attr('name'));
	});
	$('#continuous').click(function(){
		$('#feedback').hide();
	});
	$('#tocart').click(function(){
		window.location.href = $('#PROJECT_DIR').val() + 'order/cart';
	});
	$('#header_cart').click(function(){
		$('.cart_view_container').show();
	});
	$('#cart_view_container_close').click(function(){
		$('.cart_view_container').hide();
	});
	$('#insertToCart').click(function(){
		var url =$('#PROJECT_DIR').val() + "Cart/add";
		var par = {product_id:$('#product_id').val(),product_count:$('#product_count').val(),product_price:$('#product_price').text()};
		$.ajax({
			url: url,
			data:par,
			type:'POST',
			cache: false,
			success: function(data){
				var temp = data.split('$$');
				$('#header_cart').html(temp[0]);
				$('#sum_money').html(temp[1]);
				$('#feedback_count').text($('#product_count').val());
				$('#feedback_name').text($('#product_name').text());
				$('#feedback_photo').attr('src',$('#main_photo').attr('src'));
				$('#feedback').show();
				setCart()
		  	},
			beforeSend:function(){
				
			}, 
			complete:function(){
				
			} 
		});
	});
	$('#insertTowunschlist').click(function(){
		var url =$('#PROJECT_DIR').val() + "customer/wish_list_add";
		var par = {product_id:$('#product_id').val()};
		$.post(url,par,function(data){
			if(data == 'success'){
				alert('Sie haben schon diese Produkt in Ihre Wunschlist hinzugefügt.');
			}	
		});
	});
	$('.to_cart').click(function(){
		window.location.href = $('#PROJECT_DIR').val() + 'order/cart';
	});
	$('#to_check_out').click(function(){
		window.location.href = $('#PROJECT_DIR').val() + 'order/checkout';
	});
	$("#share").jsSocials({
            shares: ["email", "twitter", "facebook", "googleplus",  "whatsapp"]
     });
});
function setCart(){
	$.post($('#PROJECT_DIR').val() + "Cart/setCartView",function(data){
		$('#cart_view').html(data);	
	});
}
</script>
<div id="main_page_content">
    <div class="main_container">
        <div class="main_content_container row">
            <div class="col-12">
                <?php echo $html_str;?>
            </div>
        </div>
    </div>		
</div>
<input type="hidden" id="PROJECT_DIR"  value="<?php echo PROJECT_DIR?>" />
<input type="hidden" id="product_color"  value="" />
<div id="feedback" class="feedback">
    <div id="feedback_photo_div"><img id='feedback_photo' height="100%" /></div>
    <div id="detail">Sie haben schon <span id="feedback_count"></span> '<span id="feedback_name"></span>' im Warenkorb eingef&uuml;gt.</div>
    <div class="button1"><input id="continuous" class="black_button" value="WEITER KAUFEN" /></div>
    <div class="button2"><input id="to_cart1" class="black_button to_cart" value="ZUM WARENKORB" /></div>
</div>
<div class="cart_view_container">
    <div class="cart_view_cell1" id="cart_view"></div>
    <div class="cart_view_cell2">
        <div id="cart_view_container_close">X</div>
        GESAMTBETRAG: <span id="sum_money"></span> &euro;
        <div class="button1"><input id="to_cart2" class="black_button to_cart" value="WARENKORB ZEIGEN" /></div>
        <div class="button1"><input id="to_check_out" class="black_button" value="ZUR KASSE" /></div>
    </div>
</div>
