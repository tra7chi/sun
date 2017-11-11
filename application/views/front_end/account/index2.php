<?php $dir = $_SERVER['REQUEST_URI']?>
<style>
.title{
	text-align:center;
}
input.grey_border,select.grey_border{
	border:1px solid #CCC;
	height:2rem;
	width:20rem;
	font-size:1rem;
	margin-right:0.5rem;
}
input.middle_textbox{
	width:15rem;	
}
input.small_textbox{
	width:4rem;
}
input.black_button{
	width:10rem;
	height:2rem;
	font-size:1rem;
	background-color:#000;
	color:#FFF;
	font-weight:bold;
}
input.black_button:hover{
	background-color:#999;
	color:#000;
}
div.input_margin{
	margin:0.3rem 0;
}
</style>

<div id="main_page_content">
    <div class="main_container">
        <div class="main_content_container row">
            <div class="content_box contact_info  col-12 title uppercase bold-font input_margin">
                <?php echo $title?>
            </div>
            <div class="content_box contact_info  col-12  uppercase input_margin">
                Kontoinformationen
            </div>
            <form action="<?php echo $postUrl; ?>" method="post">
            <div class="horizontal_layout  col-2 big_font input_margin">
                <label for="customer_email">Email-Adresse:*</label>
            </div>
            <div class="horizontal_layout  col-9 input_margin" >
                <input type="text" id="customer_email" name="customer_email" class="grey_border" />
            </div>
            <div class="horizontal_layout  col-2 big_font input_margin">
                <label for="customer_username">Benutzername:</label>
            </div>
            <div class="horizontal_layout  col-9 input_margin">
                <input type="text" id="customer_username" name="customer_username" class="grey_border" />
            </div>
            <div class="horizontal_layout  col-2 big_font input_margin">
                <label for="customer_password">Passwort:*</label>
            </div>
            <div class="horizontal_layout  col-9 input_margin">
                <input type="password" id="customer_password" name="customer_password" class="grey_border" />
            </div>
            <div class="horizontal_layout  col-2 big_font input_margin">
                <label for="customer_password1">Passwort best&auml;tigen:*</label>
            </div>
            <div class="horizontal_layout  col-9 input_margin">
                <input type="password" id="customer_password1" name="customer_password1" class="grey_border" />
            </div>

            <div class="content_box contact_info  col-12  uppercase input_margin">
                Rechnungsadresse
            </div>
            <div class="horizontal_layout  col-2 big_font input_margin">
                <label for="customer_gender">Anrede:</label>
            </div>
            <div class="horizontal_layout  col-9 input_margin">
                <select name="customer_gender" id="customer_gender" class="grey_border">
                    <option value="1">Herr</option>
                    <option value="0">Frau</option>
                </select>
            </div>
            <div class="horizontal_layout  col-2 big_font input_margin">
                <label for="customer_lastname">Vorname:*</label>
            </div>
            <div class="horizontal_layout  col-9 input_margin">
                <input type="text" id="customer_lastname" name="customer_lastname" class="grey_border" />
            </div>
            <div class="horizontal_layout  col-2 big_font input_margin">
                <label for="customer_firstname">Nachname:*</label>
            </div>
            <div class="horizontal_layout  col-9 input_margin">
                <input type="text" id="customer_firstname" name="customer_firstname" class="grey_border" />
            </div>
            <div class="horizontal_layout  col-2 big_font input_margin">
                <label for="customer_birthday">Geburtstag:</label>
            </div>
            <div class="horizontal_layout  col-9 input_margin">
                <input type="text" id="customer_birthday" name="customer_birthday" class="grey_border" />
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
                <label for="customer_phone">Telefon:*</label>
            </div>
            <div class="horizontal_layout  col-9 input_margin">
                <input type="text" id="customer_phone" name="customer_phone" class="grey_border" />
            </div>
            <div class="horizontal_layout  col-2 big_font input_margin">
                <label for="customer_fax">Telefax:</label>
            </div>
            <div class="horizontal_layout  col-9 input_margin">
                <input type="text" id="customer_fax" name="customer_fax" class="grey_border" />
            </div>
            <div class="horizontal_layout  col-2 big_font input_margin">
                <label for="customer_mobile">Mobiltelefon::</label>
            </div>
            <div class="horizontal_layout  col-9 input_margin">
                <input type="text" id="customer_mobile" name="customer_mobile" class="grey_border" />
            </div>
            <div class="horizontal_layout middle_font  col-12 input_margin">
                * Pflichtfeld
            </div>
            <div class="horizontal_layout middle_font  col-12 input_margin">
            <input type="hidden" name="originator" value="<?php echo $originator ?>" />
                <input type="submit" value="Speichen" class="black_button" />
            </div>
            </form>
        </div>
    </div>
</div>
