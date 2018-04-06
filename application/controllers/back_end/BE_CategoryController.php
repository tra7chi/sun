<?php
 
class BE_CategoryController extends Controller{
    // 首页方法，测试框架自定义DB查询
    public function index1(){
        $keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';
		$im = new CategoryModel(1);
        if ($keyword) {
            $items = $im->search($keyword);
        } else {
			$im->order(array('category_level_1_name'));
            $items = $im->selectAll();
        }

        $this->assign('title', 'Men&uuml; List');
        $this->assign('keyword', $keyword);
        $this->assign('items', $items);
        $this->render();
    }
     public function index2(){
        $keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';
		//echo $keyword;
		$im = new CategoryModel(2);
        if ($keyword) {			
            $items = $im->search($keyword);
        } else {
			$im->order(array('sc_product_category_level_one.category_level_1_name'));
			$data = array(
						array('sc_product_category_level_one','category_level_1_id','i')
					);
            $items = $im->joinselect($data);
			//print_r($items);
        }

        $this->assign('title', 'Men&uuml; List');
        $this->assign('keyword', $keyword);
        $this->assign('items', $items);
        $this->render();
    }
    // 添加记录，测试框架DB记录创建（Create）
    public function add1(){
		$count = 0;
		if(checkUnique($_POST['originator'])){
		    $data['category_level_1_id'] = substr(md5(uniqid()),0,12);
			$data['category_level_1_name'] = $_POST['category_level_1_name'];
			//echo $_POST['category_level_1_name'];
			$im = new CategoryModel(1);
			$count = $im->add($data);
		}
		$this->assign('title', 'Erfolgreich Hinzuf&uuml;gung');
		$this->assign('class_desc', 'Men&uuml;');
		$this->assign('action_desc', 'hinzugef&uuml;gt');
		$this->assign('count', $count);
		$this->assign('redirectPage', 'feedback');
		$this->assign('goback',  PROJECT_DIR . $this->_controller . '/index1');
		$this->render();
		


    }
    // 添加记录，测试框架DB记录创建（Create）
    public function add2(){
		$count = 0;
		if(checkUnique($_POST['originator'])){
			$data['category_level_2_id'] = substr(md5(uniqid()),0,12);
			$data['category_level_1_id'] = $_POST['category_level_1_id'];
			$data['category_level_2_name'] = $_POST['category_level_2_name'];
			//echo $_POST['category_level_1_name'];
			$im = new CategoryModel(2);
			$count = $im->add($data);
		}
		$this->assign('title', 'Erfolgreich Hinzuf&uuml;gung');
		$this->assign('class_desc', 'Men&uuml;');
		$this->assign('action_desc', 'hinzugef&uuml;gt');
        $this->assign('count', $count);
		$this->assign('redirectPage', 'feedback');
		$this->assign('goback',  PROJECT_DIR . $this->_controller . '/index2');
        $this->render();
    }
    // 操作管理
    public function manage1($id = 0){
        $item = array();
        $postUrl = PROJECT_DIR.'BE_category/add1';
		$title = 'Einen neuen 1-Ebene Men&uuml hinzuf&uumlgen';
        if ($id) {
			$im = new CategoryModel(1);
            $item = $im->select('category_level_1_id',$id);
            $postUrl = PROJECT_DIR.'BE_category/update1';
			$title = 'Einen 1-Ebene Men&uuml &auml;ndern';
        }
		
        $this->assign('title', $title);
        $this->assign('item', $item);
        $this->assign('postUrl', $postUrl);
        $this->render();
    }
    
	public function manage2($id = 0){
        $postUrl = PROJECT_DIR.'BE_category/add2';
		$title = 'Einen neuen 2-Ebene Men&uuml hinzuf&uumlgen';
        if ($id) {
			$im = new CategoryModel(2);
			$im->where(array('sc_product_category_level_two.category_level_2_id like \'' . $id . '\''));
            $item = $im->joinSelect(array(
										array('sc_product_category_level_one','category_level_1_id','i')
									));
            $postUrl = PROJECT_DIR.'BE_category/update2';
			$title = 'Einen 2-Ebene Men&uuml &auml;ndern';
			$this->assign('item', $item);
        }
		else{
			$im = new CategoryModel(1);
			$im->order(array('category_level_1_name'));
			$items = $im->selectAll();
			$this->assign('items', $items);
		}   
        $this->assign('title', $title);
        $this->assign('postUrl', $postUrl);
        $this->render();
    }
	
    // 更新记录，测试框架DB记录更新（Update）
    public function update1(){
		$count = 0;
		if(checkUnique($_POST['originator'])){
			$data = array('category_level_1_id' => $_POST['category_level_1_id'], 'category_level_1_name' => $_POST['category_level_1_name']);
			//print_r($data);
			$im = new CategoryModel(1);
			$count = $im->update('category_level_1_id',$data['category_level_1_id'], $data);
		}
		$this->assign('title', 'Erfolgreich &Auml;nderung');
		$this->assign('class_desc', 'Men&uuml;');
		$this->assign('action_desc', '&Auml;nderung');
        $this->assign('count', $count);
		$this->assign('goback',  PROJECT_DIR . $this->_controller . '/index1');
		$this->assign('redirectPage', 'feedback');
        $this->render();
    }
        // 更新记录，测试框架DB记录更新（Update）
    public function update2(){
		$count = 0;
		if(checkUnique($_POST['originator'])){
			$data = array('category_level_2_id' => $_POST['category_level_2_id'], 'category_level_2_name' => $_POST['category_level_2_name']);
			//print_r($data);
			$im = new CategoryModel(2);
			$count = $im->update('category_level_2_id',$data['category_level_2_id'], $data);
		}
		$this->assign('title', 'Erfolgreich &Auml;nderung');
		$this->assign('class_desc', 'Men&uuml;');
		$this->assign('action_desc', '&Auml;nderung');
        $this->assign('count', $count);
		$this->assign('goback',  PROJECT_DIR . $this->_controller . '/index2');
		$this->assign('redirectPage', 'feedback');
        $this->render();
    }
    // 删除记录，测试框架DB记录删除（Delete）
    public function delete1($category_level_1_id = null){
		$im = new CategoryModel(1);
        $count = $im->delete('category_level_1_id',$category_level_1_id);
		$this->assign('title', 'Erfolgreich L&ouml;sung');
		$this->assign('class_desc', 'Men&uuml;');
		$this->assign('action_desc', 'gel&ouml;scht');
        $this->assign('count', $count);
		$this->assign('redirectPage', 'feedback');
		$this->assign('goback',  PROJECT_DIR . $this->_controller . '/index1');
        $this->render();
    }
	// 删除记录，测试框架DB记录删除（Delete）
    public function delete2($category_level_2_id = null){
		$im = new CategoryModel(2);
        $count = $im->delete('category_level_2_id',$category_level_2_id);
		$this->assign('title', 'Erfolgreich L&ouml;sung');
		$this->assign('class_desc', 'Men&uuml;');
		$this->assign('action_desc', 'gel&ouml;scht');
        $this->assign('count', $count);
		$this->assign('redirectPage', 'feedback');
		$this->assign('goback',  PROJECT_DIR . $this->_controller . '/index2');
        $this->render();
    }

}