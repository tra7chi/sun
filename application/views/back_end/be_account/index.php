<div id="main_page_content">
    <div class="main_container">
        <div class="main_content_container row">
        	<div class="col-12 bigger-font title_bottom_line"><?php echo $title?></div>
			<table class="black">
    			<tr>
                	<th><div>Vorname</div></th>
                	<th><div>Nachname</div></th>
        			<th><div>Email</div></th>
                    <th><div>Telefon</div></th>
                    <th><div>Handy</div></th>                    
        			<th>Verwaltung</div></th>
    			</tr>
    			<?php foreach ($items as $item): ?>
        		<tr>
            		<td class="big_font"><?php echo $item['customer_lastname'] ?></td>
                    <td class="big_font"><?php echo $item['customer_firstname'] ?></td>
                    <td class="big_font"><?php echo $item['customer_email'] ?></td>
                    <td class="big_font"><?php echo $item['customer_phone'] ?></td>
                    <td class="big_font"><?php echo $item['customer_mobile'] ?></td>
            		<td>
                		<a class="black_button" href="<?php echo PROJECT_DIR?>BE_account/manage/<?php echo $item['customer_id'] ?>">&Auml;nderung</a>
                		<a class="black_button" href="<?php echo PROJECT_DIR?>BE_account/delete/<?php echo $item['customer_id'] ?>">L&ouml;schung </a>
            		</td>
        		</tr>
   			 <?php endforeach ?>
			</table>
		</div>
	</div>
</div>