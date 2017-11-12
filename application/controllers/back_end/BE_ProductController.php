<?php
 
class BE_ProductController extends Controller{
    // 首页方法，测试框架自定义DB查询
    public function index(){
        $keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';
		$im = new ProductModel();
        if ($keyword) {
            $items = $im->search($keyword);
        } else {
			$im->order(array('product_sn'));
            $items = $im->joinSelect(array(
				array('sc_product_category_level_one','category_level_1_id','i'),
				array('sc_product_category_level_two','category_level_2_id','i')	
			));
        }

        $this->assign('title', 'Produkt List');
        $this->assign('keyword', $keyword);
        $this->assign('items', $items);
        $this->render();
    }
    
    // 添加记录，测试框架DB记录创建（Create）
    public function add(){
		$count = 0;
		if(checkUnique($_POST['originator'])){
			$data['product_id'] = md5(uniqid());
			$data['product_sn'] = isset($_POST['product_sn']) ? $_POST['product_sn'] : '';
			$data['product_name'] = isset($_POST['product_name']) ? $_POST['product_name'] : '';
			$data['product_description'] = isset($_POST['product_description']) ? $_POST['product_description'] : '';
			$data['product_size'] = isset($_POST['product_size']) ? $_POST['product_size'] : '';
			
			$data['category_level_1_id'] = isset($_POST['category_level_1_id']) ? $_POST['category_level_1_id'] : '';
			$data['category_level_2_id'] = isset($_POST['category_level_2_id']) ? $_POST['category_level_2_id'] : '';
			$data['product_selling_price'] = isset($_POST['product_selling_price']) ? $_POST['product_selling_price'] : '';
			$data['product_materials'] = isset($_POST['product_materials']) ? $_POST['product_materials'] : '';
			$data['product_is_new'] = isset($_POST['product_is_new']) ? 1 : 0;		
			
			$im = new ProductModel();
			$count = $im->add($data);
			//hier man must add product at first, because of the cascade of database.
			if(isset($_POST['product_sale'])){
				$data1['sale_id'] = md5(uniqid());
				$data1['product_id'] = $data['product_id'];
				$data1['sale_start_time'] = isset($_POST['sale_start_time']) ? $_POST['sale_start_time'] : '0000-00-00 00:00:00';
				$data1['sale_end_time'] = isset($_POST['sale_end_time']) ? $_POST['sale_end_time'] : '0000-00-00 00:00:00';
				$data1['sale_product_amount'] = isset($_POST['sale_product_amount']) ? $_POST['sale_product_amount'] : '0';
				$data1['sale_price'] = isset($_POST['sale_price']) ? $_POST['sale_price'] : '0';
				$im = new ProductSaleModel();
				$im->add($data1);
			}
			if(isset($_POST['product_color'])){
				//echo count($_POST['product_color']);
				
				$im = new MappingProductColorModel();
				for($i = 0;$i < count($_POST['product_color']); $i++){
					$data2['mapping_pc_id'] = md5(uniqid());
					$data2['color_id'] = isset($_POST['product_color'][$i]) ? $_POST['product_color'][$i] : '0';
					$data2['product_id'] = $data['product_id'];
					$im->add($data2);	
				}
			}
		}
        $this->assign('title', 'Erfolgreich Hinzuf&uuml;gung');
		$this->assign('class_desc', 'Produkt');
		$this->assign('action_desc', 'hinzugef&uuml;gt');
        $this->assign('count', $count);
		$this->assign('redirectPage', 'feedback');
		$this->assign('goback',  PROJECT_DIR . $this->_controller . '/index');
        $this->render();
    }
   
    // 操作管理
    public function manage($id = 0){
        $item = array();
		$items = array();
        $postUrl = PROJECT_DIR.'BE_product/add';
		$title = 'Einen neuen Produkt hinzuf&uumlgen';
		$im = new CategoryModel(1);
       	$im->order(array('category_level_1_name'));
        $menu_1_items = $im->selectAll();
		$im = new ColorModel();
       	$im->order(array('color_name_de'));
		//print_r($im);
        $color_items = $im->selectAll();
		//print_r($color_items);
        if ($id) {
			$im = new MappingProductColorModel();
			$im->where(array(sprintf('`product_id` = \'%s\'',$id)));
        	$color_product_items = $im->selectAll();
			$im = new ProductModel();
			$im->where(array(sprintf('`sc_products`.`product_id` = \'%s\'',$id)));
            $items = $im->joinSelect(array(
				array('sc_product_category_level_one','category_level_1_id','i'),
				array('sc_product_category_level_two','category_level_2_id','i'),
				array('sc_product_sale','product_id','l')	
			));
			$items[0]['product_id'] = $id;
			$im = new CategoryModel(2);
			$im->where(array(sprintf('`category_level_1_id` = \'%s\'',$items[0]['category_level_1_id'])));
			$im->order(array('category_level_2_name'));
        	$menu_2_items = $im->selectAll();
            $postUrl = PROJECT_DIR.'BE_product/update';
			$title = 'Einen Produkt &auml;ndern';
			$this->assign('color_product_items', $color_product_items);
			$this->assign('items', $items);
			$this->assign('menu_2_items', $menu_2_items);
        }
		
        $this->assign('title', $title);        
		$this->assign('menu_1_items', $menu_1_items);
        $this->assign('color_items', $color_items);
        $this->assign('postUrl', $postUrl);
        $this->render();
    }
    
	
    // 更新记录，测试框架DB记录更新（Update）
    public function update(){
		$count = 0;
		if(checkUnique($_POST['originator'])){
			$data['product_id'] = isset($_POST['product_id']) ? $_POST['product_id'] : '';
			$data['product_sn'] = isset($_POST['product_sn']) ? $_POST['product_sn'] : '';
			$data['product_name'] = isset($_POST['product_name']) ? $_POST['product_name'] : '';
			$data['product_description'] = isset($_POST['product_description']) ? $_POST['product_description'] : '';
			$data['product_size'] = isset($_POST['product_size']) ? $_POST['product_size'] : '';
			
			$data['category_level_1_id'] = isset($_POST['category_level_1_id']) ? $_POST['category_level_1_id'] : '';
			$data['category_level_2_id'] = isset($_POST['category_level_2_id']) ? $_POST['category_level_2_id'] : '';
			$data['product_selling_price'] = isset($_POST['product_selling_price']) ? $_POST['product_selling_price'] : '';
			$data['product_materials'] = isset($_POST['product_materials']) ? $_POST['product_materials'] : '';
			$data['product_is_new'] = isset($_POST['product_is_new']) ? 1 : 0;		
			
			$im = new ProductModel();
			$count = $im->update('product_id',$data['product_id'],$data);
			//hier man must add product at first, because of the cascade of database.
			$data1['sale_id'] = isset($_POST['sale_id']) ? $_POST['sale_id'] : '';
			$im = new ProductSaleModel();
			$im->delete('sale_id',$data1['sale_id']);
			if(isset($_POST['product_sale'])){
				$data1['sale_id'] = $data1['sale_id'] == '' ? md5(uniqid()) : '';
				$data1['product_id'] = $data['product_id'];
				$data1['sale_start_time'] = isset($_POST['sale_start_time']) ? $_POST['sale_start_time'] : '0000-00-00 00:00:00';
				$data1['sale_end_time'] = isset($_POST['sale_end_time']) ? $_POST['sale_end_time'] : '0000-00-00 00:00:00';
				$data1['sale_product_amount'] = isset($_POST['sale_product_amount']) ? $_POST['sale_product_amount'] : '0';
				$data1['sale_price'] = isset($_POST['sale_price']) ? $_POST['sale_price'] : '0';
				$im = new ProductSaleModel();
				$count = $im->add($data1);
			}
			if(isset($_POST['product_color'])){
				//echo count($_POST['product_color']);
				$im = new MappingProductColorModel();
				$im->delete('product_id',$data['product_id']);
				for($i = 0;$i < count($_POST['product_color']); $i++){
					$data2['mapping_pc_id'] = md5(uniqid());
					$data2['color_id'] = isset($_POST['product_color'][$i]) ? $_POST['product_color'][$i] : '0';
					$data2['product_id'] = $data['product_id'];
					$count = $im->add($data2);	
				}
			}
		}
        $this->assign('title', 'Erfolgreich &Auml;nderung');
		$this->assign('class_desc', 'Produkt');
		$this->assign('action_desc', 'ge&auml;ndert');
        $this->assign('count', $count);
		$this->assign('redirectPage', 'feedback');
		$this->assign('goback',  PROJECT_DIR . $this->_controller . '/index');
        $this->render();
    }
   
    // 删除记录，测试框架DB记录删除（Delete）
    public function delete($product_id = null){
		$im = new ProductModel();
        $count = $im->delete('product_id',$product_id);
		$this->assign('title', 'Erfolgreich L&ouml;sung');
		$this->assign('class_desc', 'Produkt');
		$this->assign('action_desc', 'gel&ouml;scht');
        $this->assign('count', $count);
		$this->assign('redirectPage', 'feedback');
		$this->assign('goback',  PROJECT_DIR . $this->_controller . '/index');
        $this->render();
    }
	public function get_menu2(){
		$category_level_1_id = $_POST['category_level_1_id'];
		$im = new CategoryModel(2);
        //echo $category_level_1_id;
		$im->where(array('`category_level_1_id` like \'' . $category_level_1_id . '\''));
		$menu_2_items = $im->selectAll();
		//print_r($menu_1_items);
		echo json_encode($menu_2_items);
	}
	public function photo_manage(){
		$this->assign('title', 'Bitte w&auml;hlen Sie ein Produkt.');
		$im = new ProductModel();
		$im->order(array('product_sn'));
		$items = $im->selectAll();
		$this->assign('items', $items);
        $this->render();
	}
	public function photo_upload(){
		$count = 0;
		if(checkUnique($_POST['originator'])){
			$product_id = isset($_POST['product_id']) ?  $_POST['product_id'] :'';   
			$product_sn = isset($_POST['product_sn']) ?  $_POST['product_sn'] :'';
			$dest_folder   =  APP_PATH . 'static/upload/product_photo/' . $product_sn . '/';   //上传图片保存的路径 图片放在跟你upload.php同级的picture文件夹里
			//echo $dest_folder;
			$arr=array();   //定义一个数组存放上传图片的名称方便你以后会用的。
			if(!file_exists($dest_folder)){
				mkdir($dest_folder,700); // 创建文件夹，并给予最高权限
			}
			//print_r($_FILES['photo']);
			$names = array();
			foreach($_FILES['photo']['name'] as $key=>$value) {      	
				$fileTypes = array('jpg','jpeg','gif','png'); // 允许的后缀扩展 
				$fileParts = pathinfo($value);
				//print_r($fileParts); 
				if (in_array(strtolower($fileParts['extension']),$fileTypes)) { 
					$name = md5(uniqid()) . '.'. $fileParts['extension'];
					array_push($names,$name);
				 //将上传的文件移动到新位置
					move_uploaded_file($_FILES['photo']['tmp_name'][$key], $dest_folder.'/'.$name); 
				} else { 
					echo 'the upload file is not a picture.'; 
				} 
			}
			$im = new ProductPhotoModel();
			foreach($names as $key=>$value){
				$data['product_id'] = $product_id;
				$data['photo_name'] = $value;
				$im->add($data);
			}
			$this->photo_read($product_id,$product_sn);
		}
	}
	public function photo_read($product_id = null,$product_sn = null){
		//echo $product_id.'a<br>';
		//echo $product_sn.'a<br>';
		if(isset($product_id))
			$product_id = isset($_POST['product_id']) ?  $_POST['product_id'] :'';   
		if(isset($product_sn))
  			$product_sn = isset($_POST['product_sn']) ?  $_POST['product_sn'] :'';
		//echo $product_id.'a<br>';
		//echo $product_sn.'a<br>';
		$im = new ProductPhotoModel();
		$im->where(array(sprintf('`product_id` like \'%s\'',$product_id)));
		$items = $im->selectAll();
		$names = array();
		for($i = 0 ; $i<count($items) ; $i++){
			if($items[$i]['main_photo'] == 1)
				array_push($names, 'M'.$items[$i]['photo_name']);
			else
				array_push($names, $items[$i]['photo_name']);
		}

		echo json_encode($names);
	}
	public function photo_delete(){	
  		$photo_name = isset($_POST['photo_name']) ?  $_POST['photo_name'] :'';
		$product_id = isset($_POST['product_id']) ?  $_POST['product_id'] :'';   
		$product_sn = isset($_POST['product_sn']) ?  $_POST['product_sn'] :'';
		//echo $photo_name;
		$im = new ProductPhotoModel();		
		$items = $im->delete('photo_name',$photo_name);
		$this->photo_read($product_id,$product_sn);
	}
	public function main_photo_update(){	
  		$photo_name = isset($_POST['photo_name']) ?  $_POST['photo_name'] :'';
		$product_id = isset($_POST['product_id']) ?  $_POST['product_id'] :'';
		//echo $photo_name;
		$im = new ProductPhotoModel();		
		$data['main_photo'] = 0;
		$items = $im->update('product_id',$product_id,$data);
		$data['main_photo'] = 1;
		$items = $im->update('photo_name',$photo_name,$data);
	}
}