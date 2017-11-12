<div id="main_page_content">
    <div class="main_container">
        <div class="main_content_container row">
            <div class="col-12 bigger-font title_bottom_line"><?php echo $title?></div>
            <form action="<?php echo $postUrl; ?>" method="post">
                    <div class="horizontal_layout  col-2 big_font input_margin">
						<label for="customer_email">Email-Adresse:*</label>
                    </div>
                    <div class="horizontal_layout  col-4 input_margin" >
						<input type="text" id="customer_email" name="customer_email" class="grey_border" value="<?php echo isset($item['customer_email']) ?  $item['customer_email'] :  '';?>" />
                    </div>
                    <div class="horizontal_layout  col-2 big_font input_margin">
						<label for="customer_username">Benutzername:</label>
                    </div>
                    <div class="horizontal_layout  col-3 input_margin">
						<input type="text" id="customer_username" name="customer_username" class="grey_border" value="<?php echo isset($item['customer_username']) ?  $item['customer_username'] :  '';?>" />
                    </div>
                    <div class="horizontal_layout  col-2 big_font input_margin">
						<label for="customer_password">Passwort:*</label>
                    </div>
                    <div class="horizontal_layout  col-4 input_margin">
						<input type="password" id="customer_password" name="customer_password" class="grey_border" value="<?php echo isset($item['customer_password']) ?  $item['customer_password'] :  '';?>" />
                    </div>
                    <div class="horizontal_layout  col-2 big_font input_margin">
						<label for="customer_password1">Passwort best&auml;tigen:*</label>
                    </div>
                    <div class="horizontal_layout  col-3 input_margin">
						<input type="password" id="customer_password1" name="customer_password1" class="grey_border" value="<?php echo isset($item['customer_password']) ?  $item['customer_password'] :  '';?>" />
                    </div>
                    <?php if(isset($item['customer_id'])){?>
					<div class="horizontal_layout  col-2 big_font input_margin">
						<label for="customer_sn">Kunden SN.:*</label>
                    </div>
                    <div class="horizontal_layout  col-4 input_margin">
						<input type="text" id="customer_sn" name="customer_sn" class="grey_border" value="<?php echo isset($item['customer_sn']) ?  $item['customer_sn'] :  '';?>" />
                    </div>
                    <div class="horizontal_layout  col-2 big_font input_margin">
						<label for="customer_registration_time">Registrierungszeit:</label>
                    </div>
                    <div class="horizontal_layout  col-3 input_margin">
						<input type="text" id="customer_registration_time" name="customer_registration_time" class="grey_border" value="<?php echo isset($item['customer_registration_time']) ?  $item['customer_registration_time'] :  '';?>" />
                    </div>
                    <div class="horizontal_layout  col-2 big_font input_margin">
						<label for="customer_is_activated">Aktivierung:</label>
                    </div>
                    <div class="horizontal_layout  col-9 input_margin">
						<input name="customer_is_activated" type="checkbox" value="1"  <?php echo isset($item['customer_is_activated']) ? handleSelectComponent($item['customer_is_activated'],'1','c') : ''?>>
                    </div>
                    <?php }?>
                    <div class="content_box contact_info  col-12  uppercase input_margin">
						Rechnungsadresse
                    </div>
                    <div class="horizontal_layout  col-2 big_font input_margin">
						<label for="customer_gender">Anrede:</label>
                    </div>
                    <div class="horizontal_layout  col-4 input_margin">
						<select name="customer_gender" id="customer_gender" class="grey_border">
                        	<option value="1" <?php echo isset($item['customer_gender']) ? handleSelectComponent($item['customer_gender'],'1','s') : '' ?> >Herr</option>
                            <option value="0" <?php echo isset($item['customer_gender']) ? handleSelectComponent($item['customer_gender'],'0','s') : '' ?> >Frau</option>
                        </select>
                    </div>
                    <div class="horizontal_layout  col-2 big_font input_margin">
						<label for="customer_lastname">Vorname:*</label>
                    </div>
                    <div class="horizontal_layout  col-3 input_margin">
						<input type="text" id="customer_lastname" name="customer_lastname" class="grey_border"  value="<?php echo isset($item['customer_lastname']) ?  $item['customer_lastname'] :  '';?>" />
                    </div>
                    <div class="horizontal_layout  col-2 big_font input_margin">
						<label for="customer_firstname">Nachname:*</label>
                    </div>
                    <div class="horizontal_layout  col-4 input_margin">
						<input type="text" id="customer_firstname" name="customer_firstname" class="grey_border" value="<?php echo isset($item['customer_firstname']) ?  $item['customer_firstname'] :  '';?>" />
                    </div>
                    <div class="horizontal_layout  col-2 big_font input_margin">
						<label for="customer_birthday">Geburtstag:</label>
                    </div>
                    <div class="horizontal_layout  col-3 input_margin">
						<input type="text" id="customer_birthday" name="customer_birthday" class="grey_border" value="<?php echo isset($item['customer_birthday']) ?  $item['customer_birthday'] :  '';?>" />
                    </div>
                    <div class="horizontal_layout  col-2 big_font input_margin">
						<label for="address_street">Stra&szlig;e,Nr.:*</label>
                    </div>
                    <div class="horizontal_layout  col-4 input_margin">
						<input type="text" id="address_street" name="address_street" class="grey_border middle_textbox" value="<?php echo isset($item['address_street']) ?  $item['address_street'] :  '';?>" />
                        <input type="text" id="address_street_number" name="address_street_number" class="grey_border small_textbox" value="<?php echo isset($item['address_street_number']) ?  $item['address_street_number'] :  '';?>" />
                    </div>
                    <div class="horizontal_layout  col-2 big_font input_margin">
						<label for="address_zipcode">PLZ,Ort:*</label>
                    </div>
                    <div class="horizontal_layout  col-3 input_margin">
						<input type="text" id="address_zipcode" name="address_zipcode" class="grey_border small_textbox" value="<?php echo isset($item_address['address_zipcode']) ?  $item_address['address_zipcode'] :  '';?>" />
                        <input type="text" id="address_city" name="address_city" class="grey_border middle_textbox" value="<?php echo isset($item_address['address_city']) ?  $item_address['address_city'] :  '';?>" />
                    </div>
                    <div class="horizontal_layout  col-2 big_font input_margin">
						<label for="address_country">Land:*</label>
                    </div>
                    <div class="horizontal_layout  col-4 input_margin">
						<input type="text" id="address_country" name="address_country" class="grey_border" value="<?php echo isset($item_address['address_country']) ?  $item_address['address_country'] :  '';?>" />
                    </div>
                    <div class="horizontal_layout  col-2 big_font input_margin">
						<label for="customer_phone">Telefon:*</label>
                    </div>
                    <div class="horizontal_layout  col-3 input_margin">
						<input type="text" id="customer_phone" name="customer_phone" class="grey_border" value="<?php echo isset($item['customer_phone']) ?  $item['customer_phone'] :  '';?>" />
                    </div>
                    <div class="horizontal_layout  col-2 big_font input_margin">
						<label for="customer_fax">Telefax:</label>
                    </div>
                    <div class="horizontal_layout  col-4 input_margin">
						<input type="text" id="customer_fax" name="customer_fax" class="grey_border" value="<?php echo isset($item['customer_fax']) ?  $item['customer_fax'] :  '';?>" />
                    </div>
                    <div class="horizontal_layout  col-2 big_font input_margin">
						<label for="customer_mobile">Mobiltelefon::</label>
                    </div>
                    <div class="horizontal_layout  col-3 input_margin">
						<input type="text" id="customer_mobile" name="customer_mobile" class="grey_border" value="<?php echo isset($item['customer_mobile']) ?  $item['customer_mobile'] :  '';?>" />
                    </div>
                    <div class="horizontal_layout middle_font  col-12 input_margin">
						* Pflichtfeld
                    </div>
                    <div class="horizontal_layout middle_font  col-12 input_margin">
						<input type="submit" value="Speichen" class="black_button" />
                        <input type="hidden" name="originator" value="<?php echo $originator ?>" />
                        <input type="hidden" value="<?php echo isset($item['customer_id']) ?  $item['customer_id'] :  '';?>" id="customer_id" name="customer_id" />
                        <input type="hidden" value="<?php echo isset($item_address['address_id']) ?  $item_address['address_id'] :  '';?>" id="address_id" name="address_id" />
                    </div>
                    </form>
                </div>
			</div>
		</div>
