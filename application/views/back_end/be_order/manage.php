<?php
//echo $product_list;

$order_detail = '<table class="black"><tr><th>Name</th><th>Menge</th><th>Preis</th><th></th></tr>';
if(isset($product_list)){
	for($i = 0; $i < count($product_list) ; $i++){
		$order_detail .= '<tr class="tr' . $product_list[$i]['order_details_id'] . '"><td>' . $product_list[$i]['product_name'] . '</td><td class="edit">' . $product_list[$i]['product_sold_amount'] . '</td><td class="edit">' . $product_list[$i]['product_selling_price'] . '</td><td><input type="button" class="black_button row_edit" value="Verwaltung" id="' . $product_list[$i]['order_details_id'] . '" > <input type="button" class="black_button delete" value="L&ouml;schung" id="' . $product_list[$i]['order_details_id'] . '" ></td></tr>';
	}
$order_detail .= '</table>';
	
}
?>
<script>
$(function(){
	$('#customer_name_check').click(function(){
		$.post($('#PROJECT_DIR').val() + 'BE_Order/check_customer_name',{customer_firstname:$('#customer_firstname').val(),customer_lastname:$('#customer_lastname').val()},customer_check_feedback);
	});
	$('.row_edit').click(function(){
		if($(this).val() == 'Verwaltung'){
			row_edit('tr' + $(this).attr('id'),'e');
			$(this).val('Speichen');
		}
		else{
			row_edit('tr' + $(this).attr('id'),'s');
			update_order_detail($(this).attr('id'));
			$(this).val('Verwaltung');
		}
			
	});
	$('.delete').click(function(){
		$('tr').remove('.tr' + $(this).attr('id'));
		var order_details_id = $(this).attr('id');
		$.post($('#PROJECT_DIR').val() + 'BE_Order/delete_order_detail',{order_details_id:order_details_id});
	});
});
function update_order_detail(id){
	var order_details_id = id;
	var product_sold_amount = $('.tr' + id).children()[1].innerHTML;
	var product_selling_price = $('.tr' + id).children()[2].innerHTML;;
	$.post($('#PROJECT_DIR').val() + 'BE_Order/update_order_detail',{order_details_id:order_details_id,product_sold_amount:product_sold_amount,product_selling_price:product_selling_price},function(){alert('Die Änderung ist Erflog.')});
}
function customer_check_feedback(data){
	if(data!='error'){
		$('#customer_id').val(data);
		alert('Richtig');
	}
	else{
		alert('Wir haben diese Kunde nicht gefunden, bitte &uuml;berpr&uuml;fen Sie nochmal.');
	}
}
function row_edit(id,flag){
	$('.'+ id + ' td').each(function(index, element) {
        if(flag == 'e'){
			if($(element).attr('class') == 'edit'){
				var value = $(element).text();
				$(element).html('<input type = "text" value = "' + value + '" class = "grey_border small_textbox">');
			}
		}
		else if(flag == 's'){
			var value = $(element).children().val();
			if($(element).attr('class') == 'edit'){
				$(element).html(value);
			}
		}

    });
}
</script>
<style>
.black{
	font-size:1rem;
}
</style>
<div id="main_page_content">
    <div class="main_container">
        <div class="main_content_container row">
        	<div class="col-12 bigger-font title_bottom_line"><?php echo $title?></div>
            
        	<form action="<?php echo $postUrl; ?>" method="post">
                    <div class="horizontal_layout  col-2 big_font input_margin">
						<label for="order_sn">Bestellungsnummber:</label>
                    </div>
                    <div class="horizontal_layout  col-4 input_margin" >
						<input type="text" id="order_sn" name="order_sn" class="grey_border" value="<?php echo isset($item['order_sn']) ?  $item['order_sn'] :  '';?>" />
                    </div>
                    <div class="horizontal_layout  col-2 big_font input_margin">
						<label for="customer_id">Kunden Name:</label>
                    </div>
                    <div class="horizontal_layout  col-3 input_margin">
						<input type="text" id="customer_firstname" name="customer_firstname" class="grey_border small_textbox" value="<?php echo isset($item['customer_firstname']) ?  $item['customer_firstname'] :  '';?>" />  <input type="text" id="customer_lastname" name="customer_lastname" class="grey_border small_textbox" value="<?php echo isset($item['customer_lastname']) ?  $item['customer_lastname'] :  '';?>" /> <input type="button" id="customer_name_check" value="&Uuml;berpr&uuml;fung" class="small_black_button">
                    </div>
                    <div class="horizontal_layout  col-2 big_font input_margin">
						<label for="order_time">Daten der Bestellung:</label>
                    </div>
                    <div class="horizontal_layout  col-4 input_margin">
						<input type="text" id="order_time" name="order_time" class="grey_border" value="<?php echo isset($item['order_time']) ?  $item['order_time'] :  '';?>" />
                    </div>
                    <div class="horizontal_layout  col-2 big_font input_margin">
						<label for="order_status">Bestellungszustand:</label>
                    </div>
                    
                    <div class="horizontal_layout  col-3 input_margin">
						<select name="order_status" id="order_status" class="grey_border">
                        	<option value="1" <?php echo isset($item['order_status']) ? dealSelectComponent($item['order_status'],'1','s') : '' ?> >Zu bezahlen</option>
                            <option value="2" <?php echo isset($item['order_status']) ? dealSelectComponent($item['order_status'],'2','s') : '' ?> >Bezahlt</option>
                            <option value="3" <?php echo isset($item['order_status']) ? dealSelectComponent($item['order_status'],'3','s') : '' ?> >Versandt</option>
                            <option value="4" <?php echo isset($item['order_status']) ? dealSelectComponent($item['order_status'],'4','s') : '' ?> >Zugestellt</option>
                        </select>
                    </div>
					<div class="horizontal_layout  col-2 big_font input_margin">
						<label for="order_sum_weight">Gesamtmasse:</label>
                    </div>
                    <div class="horizontal_layout  col-4 input_margin">
						<input type="text" id="order_sum_weight" name="order_sum_weight" class="grey_border" value="<?php echo isset($item['order_sum_weight']) ?  $item['order_sum_weight'] :  '';?>" />
                    </div>

                    <div class="horizontal_layout  col-2 big_font input_margin">
						<label for="order_sum_price">Bezahlen:</label>
                    </div>
                    <div class="horizontal_layout  col-3 input_margin">
						<input type="text" id="order_sum_price" name="order_sum_price" class="grey_border" value="<?php echo isset($item['order_sum_price']) ?  $item['order_sum_price'] :  '';?>" />
                    </div>
                   
                    <div>
                    	<?php echo $order_detail?>
                    </div>
                    <div class="horizontal_layout  col-2 big_font input_margin">
						<label for="order_payment_type">Zahlungsarten:</label>
                    </div>
                    <div class="horizontal_layout  col-4 input_margin">
						<select name="order_payment_type" id="customer_gender" class="grey_border">
                        	<option value="1" <?php echo isset($item['order_payment_type']) ? dealSelectComponent($item['order_payment_type'],'1','s') : '' ?> >Kredit Karte</option>
                            <option value="2" <?php echo isset($item['order_payment_type']) ? dealSelectComponent($item['order_payment_type'],'2','s') : '' ?> >&Uuml;berweisung</option>
                            <option value="3" <?php echo isset($item['order_payment_type']) ? dealSelectComponent($item['order_payment_type'],'3','s') : '' ?> >PayPal</option>
                        </select>
                    </div>
					
                    <div class="horizontal_layout  col-2 big_font input_margin">
						<label for="coupon_id">Coupon:</label>
                    </div>
                    <div class="horizontal_layout  col-3 input_margin">
						<input type="text" id="coupon_fee" name="coupon_fee" class="grey_border" value="<?php echo isset($item['coupon_fee']) ?  $item['coupon_fee'] :  '';?>" />
                    </div>
					<div class="horizontal_layout  col-2 big_font input_margin">
						<label for="order_invoice_fee">Quittung:</label>
                    </div>
                    <div class="horizontal_layout  col-4 input_margin">
						<input type="checkbox" id="order_invoice_fee" name="order_invoice_fee" class="" value="<?php echo isset($item['order_invoice_fee']) ? dealSelectComponent($item['order_invoice_fee'],'1','c') : '' ?>" />
                    </div>
                    <div class="horizontal_layout  col-2 big_font input_margin">
						<label for="order_delivery_fee">Geb&uuml;hren f&uuml;r Lieferung:</label>
                    </div>
                    <div class="horizontal_layout  col-3 input_margin">
						<input type="text" id="order_delivery_fee" name="order_delivery_fee" class="grey_border" value="<?php echo isset($item['order_delivery_fee']) ? $item['order_delivery_fee'] : '' ?>" />
                    </div>
                    <div class="horizontal_layout  col-2 big_font input_margin">
						<label for="order_other_fee">Andere Kosten:</label>
                    </div>
                    <div class="horizontal_layout  col-9 input_margin">
						<input type="text" id="order_other_fee" name="order_other_fee" class="grey_border" value="<?php echo isset($item['order_other_fee']) ? $item['order_other_fee'] : '' ?>" />
                    </div>
                     <div class="horizontal_layout  col-2 big_font input_margin">
						<label for="order_memo">Anmerkung:</label>
                    </div>
                    <div class="horizontal_layout  col-9 input_margin">
						<textarea id="order_memo" name="order_memo" class="grey_border" > <?php echo isset($item['order_memo']) ?  $item['order_memo'] : ''?>
						</textarea>

                    </div>
                    <div class="content_box contact_info  col-12  uppercase input_margin">
						Versendsaddresse:
                    </div>
                    <div class="horizontal_layout  col-2 big_font input_margin">
						<label for="order_address_country">Staat:</label>
                    </div>
                    <div class="horizontal_layout  col-4 input_margin">
						<input type="text" id="order_address_country" name="order_address_country" class="grey_border"  value="<?php echo isset($item['order_address_country']) ?  $item['order_address_country'] :  '';?>" />
                    </div>
                    <div class="horizontal_layout  col-2 big_font input_margin">
						<label for="order_address_state">Bundesland:</label>
                    </div>
                    <div class="horizontal_layout  col-3 input_margin">
						<input type="text" id="order_address_state" name="order_address_state" class="grey_border" value="<?php echo isset($item['order_address_state']) ?  $item['order_address_state'] :  '';?>" />
                    </div>
                    <div class="horizontal_layout  col-2 big_font input_margin">
						<label for="order_address_street">Stra&szlig;e,Nr.:*</label>
                    </div>
                    <div class="horizontal_layout  col-4 input_margin">
						<input type="text" id="order_address_street" name="order_address_street" class="grey_border middle_textbox" value="<?php echo isset($item['order_address_street']) ?  $item['order_address_street'] :  '';?>" />
                        <input type="text" id="order_address_street_number" name="order_address_street_number" class="grey_border small_textbox" value="<?php echo isset($item['order_address_street_number']) ?  $item['order_address_street_number'] :  '';?>" />
                    </div>
                    <div class="horizontal_layout  col-2 big_font input_margin">
						<label for="order_address_zipcode">PLZ,Ort:*</label>
                    </div>
                    <div class="horizontal_layout  col-3 input_margin">
						<input type="text" id="order_address_zipcode" name="order_address_zipcode" class="grey_border small_textbox" value="<?php echo isset($item['order_address_zipcode']) ?  $item['order_address_zipcode'] :  '';?>" />
                        <input type="text" id="order_address_city" name="order_address_city" class="grey_border middle_textbox" value="<?php echo isset($item['order_address_city']) ?  $item['order_address_city'] :  '';?>" />
                    </div>
                    <div class="horizontal_layout  col-2 big_font input_margin">
						<label for="order_contact_phone_number">Telefon:*</label>
                    </div>
                    <div class="horizontal_layout  col-4 input_margin">
						<input type="text" id="order_contact_phone_number" name="order_contact_phone_number" class="grey_border" value="<?php echo isset($item['order_contact_phone_number']) ?  $item['order_contact_phone_number'] :  '';?>" />
                    </div>
                    <div class="horizontal_layout  col-2 big_font input_margin">
						<label for="order_receiver">Vorname, Nachname:</label>
                    </div>
                    <div class="horizontal_layout  col-3 input_margin">
						<input type="text" id="order_receiver_firstname" name="order_receiver_firstname" class="grey_border small_textbox" value="<?php echo isset($item['order_receiver_firstname']) ?  $item['order_receiver_firstname'] :  '';?>" />
						<input type="text" id="order_receiver_lastname" name="order_receiver_lastname" class="grey_border small_textbox" value="<?php echo isset($item['order_receiver_lastname']) ?  $item['order_receiver_lastname'] :  '';?>" />
                    </div>
                    <div class="horizontal_layout middle_font  col-12 input_margin">
						* Pflichtfeld
                    </div>
                    <div class="horizontal_layout middle_font  col-12 input_margin">
						<input type="submit" value="Speichen" class="black_button" />
                        <input type="hidden" value="<?php echo isset($item['customer_id']) ?  $item['customer_id'] :  '';?>" id="customer_id" name="customer_id" />
                        <input type="hidden" value="<?php echo isset($item['order_id']) ?  $item['order_id'] :  '';?>" id="order_id" name="order_id" />
                        <input type="hidden" name="originator" value="<?php echo $originator ?>" />
                        <input type="hidden" name="PROJECT_DIR" id="PROJECT_DIR" value="<?php echo PROJECT_DIR ?>" /> 
                    </div>
                    </form>
        </div>
	</div>
</div>
