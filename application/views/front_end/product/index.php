<!DOCTYPE html>
<?php $dir = $_SERVER['REQUEST_URI'];
$html_str = '';
foreach ($products as $product){
$html_str = $html_str.'<div class="col-3 horizontal_layout product_cell">
							<a href="'.PROJECT_DIR.'product/manage/' . $product['product_id'] .'"><div>
								<img src="../../static/upload/product_photo/' .$product['product_sn'] . '/' . $product['photo_name'] . '" width="100%" />
							</div>
							<div class="product_text big_font">'
								.$product['product_name'].
							'</div>
							<div class="product_text middle_font grey">'
								.$product['product_size'].
							'</div>';
if(isset($_COOKIE['customer_id'])){
	$html_str = $html_str.'<div class="product_text big_font">'.$product['product_selling_price'].' &euro; </div>';
}							
							$html_str = $html_str.'</a>
						</div>';

}

?>


		<div id="main_page_content">
			<div class="main_container">
				<div class="main_content_container row">
					<div class="col-12 catelogy_title_short bigger_font_size">
                    	<?php echo $title;?> 
                    </div>
                    <div class="col-12">
                    	<?php echo $html_str;?>
                    </div>
				</div>
			</div>		
		</div>

