<?php

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
input.grey_border,select.grey_border{
	border:1px solid #CCC;
	height:2rem;
	width:20rem;
	font-size:1rem;
}
input.small_textbox{
	width:7.5rem;
}
input.middle_textbox{
	width:12rem;
}
</style>
<script>
$(function(){
	$('#update').click(function(){
		$('#address').hide();
		$('#address_update').show();
	});
});
</script>
<div id="main_page_content">
    <div class="main_container">
        <div class="main_content_container row">
           <div class="col-12">
                <ul class="buy_process">
                <li><a href="<?php echo PROJECT_DIR?>customer/customer_order">MEINE BESTELLUNGEN</a></li>
                <li><a href="<?php echo PROJECT_DIR?>customer/wish_list">MEINE WUNSCHLIST</a></li>
                <li class="current">BESTELLUNGENRECHNUNGS- UND LIEFERADRESSE</li>
                <li><a href="<?php echo PROJECT_DIR?>customer/password">PASSWORT ÄNDERN</a></li>
                </ul>    
            </div>
            <div class="bottom_bold_line">
                    <div class="col-12 padding_both"><?php echo $title?></div>
            </div>
            <div class="bottom_line">
                    <div class="bold-font">Rechnungsadresse</div>
                    <div id="address" class="font_small">
                    	<p>Email:<?php echo $item[0]['customer_email']?></p>
                        <p><?php echo $item[0]['customer_firstname']?> <?php echo $item[0]['customer_lastname']?></p>
                        <p><?php echo $item[0]['address_street']?> <?php echo $item[0]['address_street_number']?></p>
                        <p><?php echo $item[0]['address_zipcode']?> <?php echo $item[0]['address_city']?></p>
                        <p><?php echo $item[0]['address_country']?></p>
                        <p>Tel:<?php echo $item[0]['customer_phone']?></p>
                        <p>&nbsp;</p>
                        <p><div id="update">&Auml;ndern</div></p>
                    </div>
                    <div id="address_update">
                    	<form action="<?php echo $postUrl; ?>" method="post">
                            <div class="horizontal_layout  col-2 big_font input_margin">
                                <label for="customer_email">Email-Adresse:*</label>
                            </div>
                            <div class="horizontal_layout  col-9 input_margin" >
                                <input type="text" id="customer_email" name="customer_email" class="grey_border" value="<?php echo isset($item[0]['customer_email']) ? $item[0]['customer_email'] : ''?>" />
                            </div>
                            <div class="horizontal_layout  col-2 big_font input_margin">
                                <label for="customer_gender">Anrede:</label>
                            </div>
                            <div class="horizontal_layout  col-9 input_margin">
                                <select name="customer_gender" id="customer_gender" class="grey_border">
                                    <option value="1" <?php echo dealSelectComponent($item[0]['customer_gender'],'1','s')?> >Herr</option>
                                    <option value="0" <?php echo dealSelectComponent($item[0]['customer_gender'],'0','s')?> >Frau</option>
                                </select>
                            </div>
                            <div class="horizontal_layout  col-2 big_font input_margin">
                                <label for="customer_lastname">Vorname:*</label>
                            </div>
                            <div class="horizontal_layout  col-9 input_margin">
                                <input type="text" id="customer_lastname" name="customer_lastname" class="grey_border" value="<?php echo isset($item[0]['customer_firstname']) ? $item[0]['customer_firstname'] : ''?>" />
                            </div>
                            <div class="horizontal_layout  col-2 big_font input_margin">
                                <label for="customer_firstname">Nachname:*</label>
                            </div>
                            <div class="horizontal_layout  col-9 input_margin">
                                <input type="text" id="customer_firstname" name="customer_firstname" class="grey_border" value="<?php echo isset($item[0]['customer_lastname']) ? $item[0]['customer_lastname'] : ''?>" />
                            </div>
                            <div class="horizontal_layout  col-2 big_font input_margin">
                                <label for="customer_birthday">Geburtstag:</label>
                            </div>
                            <div class="horizontal_layout  col-9 input_margin">
                                <input type="text" id="customer_birthday" name="customer_birthday" class="grey_border" value="<?php echo isset($item[0]['customer_birthday']) ? $item[0]['customer_birthday'] : ''?>" />
                            </div>
                            <div class="horizontal_layout  col-2 big_font input_margin">
                                <label for="address_street">Stra&szlig;e,Nr.:*</label>
                            </div>
                            <div class="horizontal_layout  col-9 input_margin">
                                <input type="text" id="address_street" name="address_street" class="grey_border middle_textbox"  value="<?php echo isset($item[0]['address_street']) ? $item[0]['address_street'] : ''?>" />
                                <input type="text" id="address_street_number" name="address_street_number" class="grey_border small_textbox"  value="<?php echo isset($item[0]['address_street_number']) ? $item[0]['address_street_number'] : ''?>" />
                            </div>
                            <div class="horizontal_layout  col-2 big_font input_margin">
                                <label for="address_zipcode">PLZ,Ort:*</label>
                            </div>
                            <div class="horizontal_layout  col-9 input_margin">
                                <input type="text" id="address_zipcode" name="address_zipcode" class="grey_border small_textbox"  value="<?php echo isset($item[0]['address_zipcode']) ? $item[0]['address_zipcode'] : ''?>" />
                                <input type="text" id="address_city" name="address_city" class="grey_border middle_textbox"   value="<?php echo isset($item[0]['address_city']) ? $item[0]['address_city'] : ''?>" />
                            </div>
                            <div class="horizontal_layout  col-2 big_font input_margin">
                                <label for="address_country">Land:*</label>
                            </div>
                            <div class="horizontal_layout  col-9 input_margin">
                                <input type="text" id="address_country" name="address_country" class="grey_border"  value="<?php echo isset($item[0]['address_country']) ? $item[0]['address_country'] : ''?>" />
                            </div>
                            <div class="horizontal_layout  col-2 big_font input_margin">
                                <label for="customer_phone">Telefon:*</label>
                            </div>
                            <div class="horizontal_layout  col-9 input_margin">
                                <input type="text" id="customer_phone" name="customer_phone" class="grey_border"  value="<?php echo isset($item[0]['customer_phone']) ? $item[0]['customer_phone'] : ''?>" />
                            </div>
                            <div class="horizontal_layout  col-2 big_font input_margin">
                                <label for="customer_fax">Telefax:</label>
                            </div>
                            <div class="horizontal_layout  col-9 input_margin">
                                <input type="text" id="customer_fax" name="customer_fax" class="grey_border"  value="<?php echo isset($item[0]['customer_fax']) ? $item[0]['customer_fax'] : ''?>" />
                            </div>
                            <div class="horizontal_layout  col-2 big_font input_margin">
                                <label for="customer_mobile">Mobiltelefon::</label>
                            </div>
                            <div class="horizontal_layout  col-9 input_margin">
                                <input type="text" id="customer_mobile" name="customer_mobile" class="grey_border"  value="<?php echo isset($item[0]['customer_mobile']) ? $item[0]['customer_mobile'] : ''?>" />
                            </div>
                            <div class="horizontal_layout middle_font  col-12 input_margin">
                                * Pflichtfeld
                            </div>

                            
                    </div>
            </div>
            <div class="bottom_line">
                    <div class="bold-font">Lieferadressen</div>
                    <div id="address" class="font_small">
                    	<input name="liefer" type="checkbox" value="" /> Rechnungsadresse als Lieferadresse verwenden
                    </div>
            </div>
            <div class="col-9 horizontal_layout">
                 
            </div>
            <div class="col-2 horizontal_layout padding_both">
                  <input type="button" value="SPEICHEN" name="submit" id="submit" class="black_button" >  
                  </form>
            </div>
        </div>
    </div>		
</div>
