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
                        	<div class="padding_both">
								<div class="horizontal_layout">
									<div class="horizontal_layout  col-2 input_margin">
                                        <label for="address_email">Email:</label>
                                    </div>
                                    <div class="horizontal_layout  col-9 input_margin">
                                       <input type="text" id="address_email" name="address_email" class="grey_border" />
                                    </div>
                                    <div class="horizontal_layout  col-2 big_font input_margin">
                                        <label for="address_lastname">Vorname:*</label>
                                    </div>
                                    <div class="horizontal_layout  col-9 input_margin">
                                        <input type="text" id="address_lastname" name="address_lastname" class="grey_border" />
                                    </div>
                                    <div class="horizontal_layout  col-2 big_font input_margin">
                                        <label for="address_firstname_edit">Nachname:*</label>
                                    </div>
                                    <div class="horizontal_layout  col-9 input_margin">
                                        <input type="text" id="address_firstname" name="address_firstname" class="grey_border" />
                                    </div>
                                    <div class="horizontal_layout  col-2 big_font input_margin">
                                        <label for="address_street">Stra&szlig;e,Nr.:*</label>
                                    </div>
                                    <div class="horizontal_layout  col-9 input_margin">
                                        <input type="text" id="address_street" name="address_street" class="grey_border middle_textbox" />
                                        <input type="text" id="address_street_number" name="address_street_number" class="grey_border small_textbox" />
                                    </div>
                                    <div class="horizontal_layout  col-2 big_font input_margin">
                                        <label for="address_zipcode">PLZ,Ort:*</label>
                                    </div>
                                    <div class="horizontal_layout  col-9 input_margin">
                                        <input type="text" id="address_zipcode" name="address_zipcode" class="grey_border small_textbox" />
                                        <input type="text" id="address_city" name="address_city" class="grey_border middle_textbox" />
                                    </div>
                                    <div class="horizontal_layout  col-2 big_font input_margin">
                                        <label for="address_country">Land:*</label>
                                    </div>
                                    <div class="horizontal_layout  col-9 input_margin">
                                        <input type="text" id="address_country" name="address_country" class="grey_border" />
                                    </div>
                                    <div class="horizontal_layout  col-2 big_font input_margin">
                                        <label for="address_tel">Telefon:*</label>
                                    </div>
                                    <div class="horizontal_layout  col-9 input_margin">
                                        <input type="text" id="address_tel" name="address_tel" class="grey_border" />
                                    </div>
					   			</div>
					  		</div>
                        </div>
                    </div>
                    <div class="horizontal_layout">
                        <div>LIEFERSADRESSE</div>
                        <div class="font_small padding_both"><input id="delivery_address" name="delivery_address" type="checkbox" value="1" /> Rechnungaddress als Lieferadress verwenden</div>
                        <div class="big_margin">NEWSLETTER</div>
                        <div class="font_small padding_both"><input name="news" type="checkbox" value="1" /> Newsletter abonnieren</div>
                    </div>
                </div>
                <div class="col-9 horizontal_layout padding_both"></div>
                <div class="col-1 horizontal_layout padding_both"><input type="button" value="ZUR KASSE" class="black_button to_check_out"></div>
                
        </div>
    </div>		
</div>
<input type="hidden" value="<?php echo PROJECT_DIR?>" id="PROJECT_DIR" />