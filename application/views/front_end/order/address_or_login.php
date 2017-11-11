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
	padding-top:2rem;
}
div.padding_bottom{
	padding-bottom:2rem;
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
div.content{
	padding:2rem 0 3rem 0;
	height:8rem;
}
</style>
<script>
$(function(){
	$('#login').click(function(){
		var par = {customer_email: $("#customer_email").val(),customer_password: $("#customer_password").val()};
		$.post($('#PROJECT_DIR').val() + 'account/login',par,feedback);
	});
	$('#register').click(function(){
		var par = {customer_email: $("#customer_email").val(),customer_password: $("#customer_password").val()};
		$.post($('#PROJECT_DIR').val() + 'account/login',par,feedback);
	});
});
function feedback(data){
	if(data == 'error')
		$("#error_feedback").show();
	else
		window.location.href=$('#PROJECT_DIR').val() + "order/address";
}
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
            <div class="col-12">
                <div class="bottom_bold_line">
                    <div class="col-9 horizontal_layout padding_both"><?php echo $title?></div>
                    
                </div>
               
                <div class="bottom_bold_line padding_bottom">
                	<div class="col-4 horizontal_layout">
                    	<div>BESTELLUNG ALS GAST</div>
                 		<div class="content font_small">
                        	<div>Bestellen Sie ganz einfach ohne Registrierung.</div>
                        </div>
                        <div>
                            <input type="button" value="WEITER" id="gast" class="black_button"  />
                        </div>
                    </div>
                    <div class="col-4 horizontal_layout">
                    	<div>SIE SIND NEUKUNDEN?</div>
                        <div class="content font_small">
                        	<div>Profitieren Sie von den Vorteilen eines Kundenkontos:</div>
                            <div>
                                <ul>
                                    <li>Schnell und einfach bestellen</li>
                                    <li>Gutschein und Rabatte</li>
                                    <li>Bestellstatus abrufen</li>
                                    <li>Bestellhistorie verfolgen</li>
                                </ul>
                            </div>
                        </div>    
                        <div>
                        	<input type="button" value="WEITER" id="register" class="black_button"  />
                        </div>
                    </div>
                    <div class="col-3 horizontal_layout">
                    	<div>ICH BIN BEREITS KUNDE</div>
                        <div class="content font_small">
                            <div>Bestellen Sie ganz einfach ohne Registrierung.</div>
                            <div>
                                <label for="customer_email">E-mail-Adress</label>
                            </div>
                            <div>
                                <input id="customer_email" name="customer_email" type="text" class="grey_border"  />
                            </div>
                            <div>
                                <label for="customer_password">Passwort</label>
                            </div>
                            <div>
                                <input id="customer_password" name="customer_password" type="password" class="grey_border"  />
                            </div>
                            <div>
                                <a href="">Passwort vergessen?</a>
                            </div>
                        </div>
                        <div>
                            <input type="button" value="WEITER" id="login" class="black_button"  />
                        </div>
                    </div>
                </div>
                
                
        </div>
    </div>		
</div>
<input type="hidden" value="<?php echo PROJECT_DIR?>" id="PROJECT_DIR" />