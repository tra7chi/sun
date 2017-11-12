<?php 
$buttonValue = 'Hinzuf&uuml;gen';
if(strpos($postUrl,'update')){
	$buttonValue = '&Auml;nderung';
	$option_menu2 =  generateSelectOption($menu_2_items,'category_level_2_id','category_level_2_name',$items[0]['category_level_2_name'],'');
}
else{
	$buttonValue = 'Hinzuf&uuml;gen';

}
$option_menu1 = generateSelectOption($menu_1_items,'category_level_1_id','category_level_1_name',$items[0]['category_level_1_name'],'');

$option_color = '';
foreach ($color_items as $item){
	$option_color = $option_color . ' <input type="checkbox" id="c' . $item['color_id'] . '" name="product_color[]" value="' . $item['color_id'] . '"';
	if(isset($color_product_items[0]['color_id'])){
		for($i = 0; $i < count($color_product_items);$i++){
			if($item['color_id']==$color_product_items[$i]['color_id'])
				$option_color = $option_color . ' checked ';
		}
	}
	$option_color = $option_color . '/> ' . $item['color_name_de'];
}

?>

<script src="<?php echo $relativePath?>static/js/jquery-ui.min.js"></script>
<script src="<?php echo $relativePath?>static/js/jquery-ui-timepicker-addon.js"></script>
<script src="<?php echo $relativePath?>static/js/kindeditor/kindeditor-all-min.js"></script>
<script src="<?php echo $relativePath?>static/js/kindeditor/lang/en.js"></script>
<script>
KindEditor.ready(function(K){
	window.editor = K.create('#product_description');
});
$(function(){
	$("#sale_start_time").datetimepicker({  
		defaultDate: $('.ui_timepicker').val(),  
		dateFormat: "yy-mm-dd",  
		showSecond: true,  
		timeFormat: 'hh:mm:ss',  
		stepHour: 1,  
		stepMinute: 1,  
		stepSecond: 1  
    });
	$("#sale_end_time").datetimepicker({  
		defaultDate: $('.ui_timepicker').val(),  
		dateFormat: "yy-mm-dd",  
		showSecond: true,  
		timeFormat: 'hh:mm:ss',  
		stepHour: 1,  
		stepMinute: 1,  
		stepSecond: 1  
    })    
	$('#category_level_1_id').change(function(){
		var par = {category_level_1_id:$("#category_level_1_id").val()};
		$.post($('#PROJECT_DIR').val() + 'BE_Product/get_menu2',par,set_menu2);
	});
	
	$('#product_sale').change(function(){
		if($('#product_sale').prop('checked')){
			$('.product_sale').prop('disabled',false);
		}
		else{
			$('.product_sale').prop('disabled',true);
		}
	});
	if($('#sale_price').val()!='' && $('#sale_start_time').val()!=''){
		$('#product_sale').prop('checked',true);
		$('.product_sale').prop('disabled',false);
	}
});
function set_menu2(data){
	//alert(data);
	var menus = JSON.parse(data);
	setOptions('#category_level_2_id',menus)
}

function setOptions(component_name,list){
	$(component_name).html('');
	var optionStr = '';
	for(var i = 0; i < list.length;i++){
		optionStr += '<option value=\'' + list[i].category_level_2_id + '\'>' + list[i].category_level_2_name + '</option>';
	}
	$(component_name).append(optionStr);
}
</script>
<div id="main_page_content">
    <div class="main_container">
        <div class="main_content_container row">
            <div class="col-12 bigger-font title_bottom_line"><?php echo $title?></div>
            <form id="product_form" action="<?php echo $postUrl; ?>" method="post" >
            <div class="col-2 horizontal_layout big_font input_margin">
                <label for="product_sn">Produkt SN:</label>
            </div>
            <div class="col-4 horizontal_layout input_margin">
                <input class="grey_border" type="text" name="product_sn" id="product_sn" value="<?php echo isset($items[0]['product_sn']) ? $items[0]['product_sn'] : '' ?>" />
            </div>
            
            <div class="col-2 horizontal_layout big_font input_margin">
                <label for="product_name">Produkt Name:</label>
            </div>
            <div class="col-3 horizontal_layout input_margin">
                <input class="grey_border" type="text" name="product_name" id="product_name" value="<?php echo isset($items[0]['product_name']) ? $items[0]['product_name'] : '' ?>" />
            </div>
            

            
            <div class="col-2 horizontal_layout big_font input_margin">
                <label for="category_level_1_id">1-Ebener Men&uuml;:</label>
            </div>
            <div class="col-4 horizontal_layout input_margin">
                <select class="grey_border" name="category_level_1_id" id="category_level_1_id">
                	<?php echo $option_menu1?>
                </select>
            </div>
            <div class="col-2 horizontal_layout big_font input_margin">
                <label for="category_level_2_id">2-Ebener Men&uuml;:</label>
            </div  class="col-3 horizontal_layout input_margin">
                <select class="grey_border" name="category_level_2_id" id="category_level_2_id">
                	<?php echo $option_menu2?>
                </select>
            <div class="col-2 horizontal_layout big_font input_margin">
                <label for="color_id">Farbe:</label>
            </div>
            <div class="col-4 horizontal_layout big_font input_margin">
                	<?php echo $option_color?>
            </div>
            
            <div class="col-2 horizontal_layout big_font input_margin">
                <label for="product_size">Gr&ouml;&szlig;e:</label>
            </div>
            <div class="col-3 horizontal_layout input_margin">
                <input class="grey_border" type="text" name="product_size" id="product_size" value="<?php echo isset($items[0]['product_size']) ? $items[0]['product_size'] : '' ?>" />
            </div>
            <div class="col-2 horizontal_layout big_font input_margin">
                <label for="product_selling_price">Preis:</label>
            </div>
            <div class="col-4 horizontal_layout input_margin">
                <input class="grey_border" type="text" name="product_selling_price" id="product_selling_price" value="<?php echo isset($items[0]['product_selling_price']) ? $items[0]['product_selling_price'] : '' ?>" />
            </div>
            
            <div class="col-2 horizontal_layout big_font input_margin">
                <label for="product_materials">Material:</label>
            </div>
            <div class="col-3 horizontal_layout input_margin">
                <input class="grey_border" type="text" name="product_materials" id="product_materials" value="<?php echo isset($items[0]['product_materials']) ? $items[0]['product_materials'] : '' ?>" />
            </div>
             <div class="col-2 horizontal_layout big_font input_margin">
                <label for="product_sale">Angebot:</label>
            </div>
            <div class="col-4 horizontal_layout input_margin">
                <input name="product_sale" id="product_sale" type="checkbox" />
            </div>
            <div class="col-2 horizontal_layout big_font input_margin">
                <label for="product_is_new">Neu:</label>
            </div>
            <div class="col-3 horizontal_layout input_margin">
                <input name="product_is_new" id="product_is_new" type="checkbox" value="" <?php echo isset($items[0]['product_is_new']) ? handleSelectComponent($items[0]['product_is_new'],'1','c') : ''?> />
            </div>

           
            <div class="col-2 horizontal_layout big_font input_margin">
                <label for="sale_start_time">Startzeit:</label>
            </div>
            <div class="col-4 horizontal_layout input_margin">
                <input class="grey_border product_sale" type="text" name="sale_start_time" id="sale_start_time" disabled="disabled" value="<?php echo isset($items[0]['sale_start_time']) ? $items[0]['sale_start_time'] : '' ?>" />
            </div>
            
            <div class="col-2 horizontal_layout big_font input_margin">
                <label for="sale_end_time">EndZeit:</label>
            </div>
            <div class="col-3 horizontal_layout input_margin">
                <input class="grey_border product_sale" type="text" name="sale_end_time" id="sale_end_time" disabled="disabled" value="<?php echo isset($items[0]['sale_end_time']) ? $items[0]['sale_end_time'] : '' ?>" />
            </div>
            
            <div class="col-2 horizontal_layout big_font input_margin">
                <label for="sale_product_amount">Angebot Menge:</label>
            </div>
            <div class="col-4 horizontal_layout input_margin">
                <input class="grey_border product_sale" type="text" name="sale_product_amount" id="sale_product_amount" disabled="disabled" value="<?php echo isset($items[0]['sale_product_amount']) ? $items[0]['sale_product_amount'] : '' ?>" />
            </div>
            
            <div class="col-2 horizontal_layout big_font input_margin">
                <label for="sale_price">Angebot Preis:</label>
            </div>
            <div class="col-3 horizontal_layout input_margin">
                <input class="grey_border product_sale" type="text" name="sale_price" id="sale_price" disabled="disabled" value="<?php echo isset($items[0]['sale_price']) ? $items[0]['sale_price'] : '' ?>" />
            </div>
            <div class="col-12 horizontal_layout big_font input_margin">
                <label for="sale_price">Beschreibung:</label>
            </div>
            <div class="col-12 horizontal_layout input_margin">
                <textarea class="grey_border" id="product_description" name="product_description" ><?php echo isset($items[0]['product_description']) ? $items[0]['product_description'] : '' ?></textarea>
            </div>
            <div class="col-12 title_top_line input_margin">
                <input class="black_button" type="submit" value="<?php echo $buttonValue?>">
            </div>
            <input type="hidden" name="originator" value="<?php echo $originator ?>" />
            <input type="hidden" name="product_id" id="product_id" value="<?php echo isset($items[0]['product_id']) ? $items[0]['product_id'] : '' ?>" />
            <input type="hidden" name="sale_id" id="sale_id" value="<?php echo isset($items[0]['sale_id']) ? $items[0]['sale_id'] : '' ?>" />
            <input type="hidden" name="PROJECT_DIR" id="PROJECT_DIR" value="<?php echo PROJECT_DIR ?>" />  
            </form>
        </div>
    </div>
</div>
	


