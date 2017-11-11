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
	$('#submit').click(function(){
		if($('#customer_password').val() == '' || $('#customer_new_password').val() == '' || $('#customer_new_password1').val() == '' ){
		
		}
		else if($('#customer_new_password').val() != $('#customer_new_password1').val()){
			alert('');
		}
		else{
			$.post($('#project_dir').val()+ 'customer/password_update',{customer_password:$('#customer_password').val(),customer_new_password:$('#customer_new_password').val()},feedback)
		}
	});
});
function feedback(data){
	if(data=='success'){
		alert('Das Passwort ist geändert.');
	}
	else{
		alert('Das alt Passwort ist nicht richtig.');
	}
}
</script>
<div id="main_page_content">
    <div class="main_container">
        <div class="main_content_container row">
           <div class="col-12">
                <ul class="buy_process">
                <li><a href="<?php echo PROJECT_DIR?>customer/customer_order">MEINE BESTELLUNGEN</a></li>
                <li><a href="<?php echo PROJECT_DIR?>customer/wish_list">MEINE WUNSCHLIST</a></li>
                <li><a href="<?php echo PROJECT_DIR?>customer/">BESTELLUNGENRECHNUNGS- UND LIEFERADRESSE</a></li>
                <li class="current">PASSWORT ÄNDERN</li>
                </ul>    
            </div>
            <div class="bottom_bold_line">
                    <div class="col-12 padding_both"><?php echo $title?></div>
            </div>
            <div class="bottom_line">

                    	<form action="<?php echo PROJECT_DIR.'customer/password_update' ?>" method="post">
                            <div class="horizontal_layout  col-2 big_font input_margin">
                                <label for="customer_password">Alt Passwort:*</label>
                            </div>
                            <div class="horizontal_layout  col-9 input_margin" >
                                <input type="password" id="customer_password" name="customer_password" class="grey_border" value="" />
                            </div>
                            <div class="horizontal_layout  col-2 big_font input_margin">
                                <label for="customer_new_password">Neu Passwort:*</label>
                            </div>
                            <div class="horizontal_layout  col-9 input_margin" >
                                <input type="password" id="customer_new_password" name="customer_new_password" class="grey_border" value="" />
                            </div>
                            <div class="horizontal_layout  col-2 big_font input_margin">
                                <label for="customer_new_password1">Neu Passwort best&auml;tigen:*</label>
                            </div>
                            <div class="horizontal_layout  col-9 input_margin" >
                                <input type="password" id="customer_new_password1" name="customer_new_password1" class="grey_border" value="" />
                            </div>
                            

            </div>
            <div class="col-2 horizontal_layout padding_both">
                  <input type="button" value="SPEICHEN" name="submit" id="submit" class="black_button" >  
                  <input type="hidden" value="<?php echo PROJECT_DIR?>" name="project_dir" id="project_dir"  >  
                  </form>
            </div>
        </div>
    </div>		
</div>
