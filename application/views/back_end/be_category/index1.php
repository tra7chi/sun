<div id="main_page_content">
    <div class="main_container">
        <div class="main_content_container row">
        	<div class="col-12 bigger-font title_bottom_line"><?php echo $title?></div>
			<table class="black">
    			<tr>
        			<th>Name</div></th>
        			<th>Verwaltung</div></th>
    			</tr>
    			<?php foreach ($items as $item): ?>
        		<tr>
            		<td><?php echo $item['category_level_1_name'] ?></td>
            		<td>
                		<a class="black_button" href="<?php echo PROJECT_DIR?>BE_category/manage1/<?php echo $item['category_level_1_id'] ?>">&Auml;nderung</a>
                		<a class="black_button" href="<?php echo PROJECT_DIR?>BE_category/delete1/<?php echo $item['category_level_1_id'] ?>">L&ouml;schung </a>
            		</td>
        		</tr>
   			 <?php endforeach ?>
			</table>
		</div>
	</div>
</div>