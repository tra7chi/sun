<script>
$(function(){
	$("#error_feedback").hide();
	$('#login').click(function(){
		var par = {employee_username: $("#employee_username").val(),employee_password: $("#employee_password").val()};
		$.post($('#PROJECT_DIR').val() + 'BE_Login/login',par,feedback);
	});
});
function feedback(data){
	if(data == 'error')
		$("#error_feedback").show();
	else
		window.location.href=$('#PROJECT_DIR').val() + "BE_Login/welcome";
}
</script>

<div id="main_page_content">
    <div class="main_container col-lg-4">
        <div class="main_content_container row">
        	<div class="col-12 bold-font title_bottom_line uppercase"><?php echo $title?></div>
            <div class="col-12 error_feedback big_font hide" id="error_feedback">Ihr Benutzername oder Passwort ist ung&uuml;ltig.</div>
            
                <div class="col-3 horizontal_layout big_font">
                    <label for="employee_username">Benutzername:</label>
                </div>
                <div class="col-8 horizontal_layout">
                    <input class="grey_border" type="text" name="employee_username" id="employee_username"  />
                </div>
                <div class="col-3 horizontal_layout big_font">
                    <label for="employee_password">Passwort:</label>
                </div>
                <div class="col-8 horizontal_layout">
                    <input class="grey_border" type="password" name="employee_password" id="employee_password"  />
                </div>
                <div class="col-12 title_top_line">
                	<input type="hidden" id="PROJECT_DIR"  value="<?php echo PROJECT_DIR?>">
                    <input class="black_button" type="button" id="login"  value="Log in">
                </div>         

		</div>
	</div>
</div>
