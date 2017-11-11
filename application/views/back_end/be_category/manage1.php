<?php 
$buttonValue = 'Hinzuf&uuml;gen';
if(strpos($postUrl,'update')){
	$buttonValue = '&Auml;nderung';
}

?>
<div id="main_page_content">
    <div class="main_container">
        <div class="main_content_container row">
            <div class="col-12 bigger-font title_bottom_line"><?php echo $title?></div>
            <form action="<?php echo $postUrl; ?>" method="post">
            <div class="col-1 horizontal_layout big_font">
                <label for="category_level_1_name">Name:</label>
            </div>
            <div class="col-6 horizontal_layout">
                <input class="grey_border" type="text" name="category_level_1_name" value="<?php echo isset($item['category_level_1_name']) ? $item['category_level_1_name'] : '' ?>" />
            </div>
            <div class="col-12 title_top_line">
                <input class="black_button" type="submit" value="<?php echo $buttonValue?>">
            </div>
            <input type="hidden" name="category_level_1_id" value="<?php echo isset($item['category_level_1_id']) ? $item['category_level_1_id'] : '' ?>" />
            <input type="hidden" name="originator" value="<?php echo $originator ?>" />  
            </form>
        </div>
    </div>
</div>
	


