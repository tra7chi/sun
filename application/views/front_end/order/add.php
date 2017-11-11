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
                    <div class="col-12 big_font input_margin">
						<p>Sie haben eine E-Mail von uns erhalten, die Ihre Bestellung best&auml;tigt.</p>
                        <p>&nbsp;</p>
                        <p>&nbsp;</p>
                        <p>Vielen Dank.</p>
                    </div>

				</div>
			</div>
		</div>
	</div>
