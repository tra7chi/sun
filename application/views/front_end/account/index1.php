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
<script>
$(function(){
	$("#error_feedback").hide();
	$('#login').click(function(){
		var par = {customer_email: $("#customer_email").val(),customer_password: $("#customer_password").val()};
		$.post($('#PROJECT_DIR').val() + 'account/login',par,feedback);
	});
});
function feedback(data){
	if(data == 'error')
		$("#error_feedback").show();
	else
		window.location.href=$('#PROJECT_DIR').val() + "index";
}
</script>

<div id="main_page_content">
    <div class="main_container">
        <div class="main_content_container row">
            <div class="content_box contact_info  col-12 title uppercase bold-font input_margin">
                <?php echo $title?>
            </div>
            <div class="content_box contact_info  col-12 error_feedback big_font hide" id="error_feedback">Ihr Benutzername oder Passwort ist ung&uuml;ltig.</div>
            <div class="col-12 middle_font input_margin">
                Falls Sie schon Kunde bei uns sind, melden Sie sich bitte hier mit Ihrer E-Mail-Adresse und Passwort an.
            </div>
            <div class="horizontal_layout  col-2 big_font input_margin">
                <label for="customer_email">Email:</label>
            </div>
            <div class="horizontal_layout  col-9 input_margin">
                <input type="text" id="customer_email" name="customer_email" class="grey_border" />
            </div>
            <div class="horizontal_layout  col-2 big_font input_margin">
                <label for="customer_password">Passwort:</label>
            </div>
            <div class="horizontal_layout  col-9 input_margin">
                <input type="password" id="customer_password" name="customer_password" class="grey_border" />
            </div>
            <div class="horizontal_layout middle_font  col-12 input_margin">
                <input type="submit" value="Anmelden" class="black_button" id="login" />
            </div>
            <div class="horizontal_layout middle_font  col-12 input_margin">
                <div class="input_margin"><a href="<?php echo PROJECT_DIR?>account/register">Konto er&ouml;ffnen</a></div> 
                <div class="input_margin"><a href="<?php echo PROJECT_DIR?>account/passwortForgot">Passwort vergessen?</a></div> 
            </div>
            <input type="hidden" id="PROJECT_DIR"  value="<?php echo PROJECT_DIR?>">
        </div>
    </div>
</div>
