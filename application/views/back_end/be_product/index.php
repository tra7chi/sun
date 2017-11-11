<div id="main_page_content">
    <div class="main_container">
        <div class="main_content_container row">
        	<div class="col-12 bigger-font title_bottom_line"><?php echo $title?></div>
			<table class="black">
    			<tr>
                	<th><div>Foto</div></th>
                	<th><div>Product Nr.</div></th>
        			<th><div>Product Name</div></th>
                    <th><div>Men&uuml; 1</div></th>
                    <th><div>Men&uuml; 2</div></th>                    
                    <th><div>Product Preis</div></th>
        			<th><div>Verwaltung</div></th>
    			</tr>
    			<?php foreach ($items as $item): ?>
        		<tr>
                	<td><img src='../static/upload/product_photo/<?php echo $item['product_sn'] ?>/1.jpg' width='50px' /> </td>
            		<td class="big_font"><?php echo $item['product_sn'] ?></td>
                    <td class="big_font"><?php echo $item['product_name'] ?></td>
                    <td class="big_font"><?php echo $item['category_level_1_name'] ?></td>
                    <td class="big_font"><?php echo $item['category_level_2_name'] ?></td>
                    <td class="big_font"><?php echo $item['product_selling_price'] ?></td>
            		<td>
                		<a class="black_button" href="<?php echo PROJECT_DIR?>BE_product/manage/<?php echo $item['product_id'] ?>">&Auml;nderung</a>
                		<a class="black_button" href="<?php echo PROJECT_DIR?>BE_product/delete/<?php echo $item['product_id'] ?>">L&ouml;schung </a>
            		</td>
        		</tr>
   			 <?php endforeach ?>
			</table>
		</div>
	</div>
</div>