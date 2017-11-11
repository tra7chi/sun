<div id="main_page_content">
    <div class="main_container">
        <div class="main_content_container row">
        	<div class="col-12 bigger-font title_bottom_line"><?php echo $title?></div>
			<table class="black">
    			<tr>
                	<th><div>Bestellung Nr.</div></th>
                    <th><div>Kunden</div></th>
        			<th><div>Daten der Bestellung</div></th>
                    <th><div>Bezahlen</div></th>
                    <th><div>Bestellung Zustand</div></th>                    
                    <th><div>Adress</div></th>
                    <th><div>Verwaltung</div></th>
    			</tr>
    			<?php foreach ($items as $item): ?>
        		<tr>
            		<td class="big_font"><?php echo $item['order_sn'] ?></td>
                    <td class="big_font"><?php echo $item['customer_firstname']	. ' ' . $item['customer_lastname'] . '(' . $item['order_receiver_firstname'] . ' ' . $item['order_receiver_lastname'] . ')' ?></td>
                    <td class="big_font"><?php echo $item['order_time'] ?></td>
                    <td class="big_font"><?php echo $item['order_sum_price'] - $item['coupon_fee']  + $item['order_invoice_fee'] + $item['order_delivery_fee'] + $item['order_other_fee']?> &euro;</td>                   
                    <td class="big_font"><?php if($item['order_status'] == '1') echo 'Zu bezahlen'; elseif($item['order_status'] == '2') echo 'Bezahlt'; elseif($item['order_status'] == '3') echo 'Versendt'; else if($item['order_status'] == '4') 'Zugestellt'?></td>
                    <td class="big_font"><?php echo $item['order_address_street'] . ' ' . $item['order_address_street_number'] . ' ' . $item['order_address_city'] .  ' ' . $item['order_address_zipcode'] ?></td>
            		<td>
                		<a class="black_button" href="<?php echo PROJECT_DIR?>BE_order/manage/<?php echo $item['order_id'] ?>">&Auml;nderung</a>
                		<a class="black_button" href="<?php echo PROJECT_DIR?>BE_order/delete/<?php echo $item['order_id'] ?>">L&ouml;schung</a>
            		</td>
        		</tr>
   			 <?php endforeach ?>
			</table>
		</div>
	</div>
</div>