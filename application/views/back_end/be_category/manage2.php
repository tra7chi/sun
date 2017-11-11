<?php
//print_r($item); 
if(strpos($postUrl,'update')){
	$buttonValue = '&Auml;nderung';
	$option = '<option>' . $item[0]['category_level_1_name'] . '</option>';
}
else{
	$buttonValue = 'Hinzuf&uuml;gen';
	$option = '<option value="0">--Bitte w&auml;hlen Sie--</option>';
	foreach ($items as $item){
		$option = $option . '<option value="' . $item['category_level_1_id'] . '">' . $item['category_level_1_name'] . '</option>';
	}
}

?>
<div id="main_page_content">
    <div class="main_container">
        <div class="main_content_container row">
            <div class="col-12 bigger-font title_bottom_line"><?php echo $title?></div>
            <form action="<?php echo $postUrl; ?>" method="post">
            <div class="col-2 horizontal_layout big_font box">
                <label for="category_level_1_name">1-Ebene Men&uuml; Name:</label>
            </div>
            <div class="col-9 horizontal_layout box">
                <select class="grey_border" name="category_level_1_id" id="category_level_1_id">
                	<?php echo $option?>
                </select>
            </div>
            <div class="col-2 horizontal_layout big_font box">
                <label for="category_level_1_name">Name:</label>
            </div>
            <div class="col-6 horizontal_layout box">
                <input class="grey_border" type="text" name="category_level_2_name" value="<?php echo isset($item[0]['category_level_2_name']) ? $item[0]['category_level_2_name'] : '' ?>" />
            </div>
            <div class="col-12 title_top_line">
                <input class="black_button" type="submit" value="<?php echo $buttonValue?>">
            </div>
            <input type="hidden" name="category_level_2_id" value="<?php echo isset($item[0]['category_level_2_id']) ? $item[0]['category_level_2_id'] : '' ?>" />  
             <input type="hidden" name="originator" value="<?php echo $originator ?>" />
            </form>
        </div>
    </div>
</div>
	


