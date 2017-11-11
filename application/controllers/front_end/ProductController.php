<?php
 
class ProductController extends Controller{
    // 首页方法，测试框架自定义DB查询
    public function index($keyword){
        $title = '';
		$pm = new ProductModel();
		if ($keyword) {
			$pm->where(array(sprintf('`category_level_1_id` like \'%s\'',$keyword),' AND main_photo = 1'));            
			$cm = new CategoryModel(1);
			$cm->where(array(sprintf('`category_level_1_id` =\'%s\'',$keyword )));
			$category = $cm->selectAll('category_level_1_id',$keyword);
			$title = $category[0]['category_level_1_name'];
        } else {
			$pm->where(array('main_photo = 1'));
			
        }
		$data = array(
					array('sc_product_photos','product_id','i')
				);			
		$products = $pm->joinSelect($data);
		$this->assign('title',$title);
        $this->assign('keyword', $keyword);
        $this->assign('products', $products);
        $this->render();
    }
    public function manage($id = 0){
        $item = array();
        $postUrl = PROJECT_DIR.'product/update';
        if ($id) {
			$im = new ProductModel();
			$im->where(array(sprintf('`product_id` like \'%s\'',$id)));
            $item = $im->joinSelect(array(
				array('sc_product_category_level_one','category_level_1_id','i'),
				array('sc_product_category_level_two','category_level_2_id','i')
			));
			//print_r($item);
			$im = new MappingProductColorModel();
            $item_colors = $im->get_Color($id);
			$im = new ProductPhotoModel();
			$im->where(array(sprintf('`product_id` like \'%s\'',$id)));
			$im->order(array('main_photo'));
            $item_photos = $im->selectAll();		    		        
			$this->assign('item', $item);
			$this->assign('item_photos', $item_photos);
			$this->assign('item_colors', $item_colors);
			$this->assign('postUrl', $postUrl);
			$this->render();			
        }
    }
}