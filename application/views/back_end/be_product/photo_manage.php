<?php
$option =  generateSelectOption($items,'product_id','product_sn','','');
?>
<script>
$(function(){
	$('#photo_upload').click(function(){
			var form = new FormData(document.getElementById("product_form"));
			//$.post($('#PROJECT_DIR').val() + 'BE_Product/photo_upload',form,showResult);
			 $.ajax({
					url:$('#PROJECT_DIR').val() + 'BE_Product/photo_upload',
					type:"post",
					data:form,
					processData:false,
					contentType:false,
					success:function(data){
						showResult(data);
					},
					error:function(e){
						alert(e);
					}
				});        
	});
	$('#product_id').change(function(){
		var product_sn = $('#product_id').find('option:selected').text();
		$('#product_sn').val(product_sn);
		var par = {product_id:$("#product_id").val(),product_sn:product_sn};
		$.post($('#PROJECT_DIR').val() + 'BE_Product/photo_read',par,showResult);
	});
	$(document).on('click','.delete',function(){
		var par = {photo_name:$(this).attr('name'),product_id:$("#product_id").val(),product_sn:$('#product_sn').val()};
		$.post($('#PROJECT_DIR').val() + 'BE_Product/photo_delete',par,showResult);
	});
	$(document).on('click','.photo_div',function(){
		$('.photo_div').removeClass('main_photo');
		var par = {photo_name:$(this).children(0).attr('name'),product_id:$("#product_id").val()};
		$.post($('#PROJECT_DIR').val() + 'BE_Product/main_photo_update',par,showResult);
		$(this).addClass('main_photo');
	});
});

	
function showResult(data){
	var names = JSON.parse(data);
	var picStr = '';
	for( var i = 0;i<names.length;i++){
		picStr += '<div class="photo_div'
		if(names[i].charAt(0) == 'M' ){
			names[i] = names[i].substring(1);
			picStr += ' main_photo ';
		}
		picStr += '"><div class="delete" name="' + names[i] + '"><img src=\'../static/img/delete.png \' /></div><div><img class=\'photo\' src=\'../static/upload/product_photo/' + $('#product_sn').val() + '/' + names[i] + '\' height=\'200px\'></div></div>';
	}
	$("#photos").html(picStr);
}
</script>
<style>
.photo_div{
	display:inline-block;
	position:relative;
	z-index:0;
	margin:1rem;
}
.photo_div .delete{
	position:absolute;
	top:0;
	right:0;
	z-index:1;
	text-align:right;	
}
.main_photo{
	border:#000 2px solid;
}
</style>
<div id="main_page_content">
    <div class="main_container">
        <div class="main_content_container row">
            <div class="col-12 bigger-font title_bottom_line"></div>
            <form id="product_form" action="" method="post" >
            <div class="col-3 horizontal_layout ">
                <?php echo $title?>
            </div>
            <div class="col-4 horizontal_layout">
                <select id="product_id" name="product_id" class="grey_border">
                    <?php echo $option?>
                </select>
            </div>
            <div class="col-4 horizontal_layout">
                <input type="file" name="photo[]" size="2" multiple />
            </div>
            <div class="col-12  input_margin" id="photos">
                
            </div>
            <div class="col-12 title_top_line input_margin">
                <input type="button" name="photo_deleteall" id="photo_deleteall" class="black_button" value="Alle Fotos L&ouml;schen"/>
                <input type="button" name="photo_upload" id="photo_upload" class="black_button" value="HOCHLADEN"/>
            </div>
            <input type="hidden" name="product_sn" id="product_sn" value="" />
            <input type="hidden" name="PROJECT_DIR" id="PROJECT_DIR" value="<?php echo PROJECT_DIR ?>" /> 
            <input type="hidden" name="originator" value="<?php echo $originator ?>" /> 
            </form>
        </div>
    </div>
</div>
            
