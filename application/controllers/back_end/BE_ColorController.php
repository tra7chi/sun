<?php
 
class BE_ColorController extends Controller{
    // 首页方法，测试框架自定义DB查询
    public function index(){
        $keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';
		$im = new ColorModel();
		$im->order(array('color_name_de'));
        $items = $im->selectAll();
        $this->assign('title', 'Farbe List');
        $this->assign('keyword', $keyword);
        $this->assign('items', $items);
        $this->render();
    }
    
    // 添加记录，测试框架DB记录创建（Create）
    public function add(){
		$count = 0;
		if(checkUnique($_POST['originator'])){
			$data['color_name_en'] = $_POST['color_name_en'];
			$data['color_name_de'] = $_POST['color_name_de'];
			//echo $_POST['category_level_1_name'];
			$im = new ColorModel();
			$count = $im->add($data);
		}
        $this->assign('title', 'Erfolgreich Hinzuf&uuml;gung');
		$this->assign('class_desc', 'Farbe');
		$this->assign('action_desc', 'hinzugef&uuml;gt');
        $this->assign('count', $count);
		$this->assign('redirectPage', PROJECT_DIR.'feedback');
        $this->render();
    }
   
    // 操作管理
    public function manage($id = 0){
        $item = array();
        $postUrl = PROJECT_DIR.'BE_color/add';
		$title = 'Einen neuen Farbe hinzuf&uumlgen';
        if ($id) {
			$im = new ColorModel();
            $item = $im->select('color_id',$id);
            $postUrl = PROJECT_DIR.'BE_color/update';
			$title = 'Einen Farbe &auml;ndern';
        }
		
        $this->assign('title', $title);
        $this->assign('item', $item);
        $this->assign('postUrl', $postUrl);
        $this->render();
    }
    
	
	
    // 更新记录，测试框架DB记录更新（Update）
    public function update(){
        $data = array('color_id' => $_POST['color_id'], 'color_name_en' => $_POST['color_name_en'], 'color_name_de' => $_POST['color_name_de']);
		//print_r($data);
		$im = new ColorModel();
        $count = $im->update('color_id',$data['color_id'], $data);

		$this->assign('title', 'Erfolgreich &Auml;nderung');
		$this->assign('class_desc', 'Farbe');
		$this->assign('action_desc', '&Auml;nderung');
        $this->assign('count', $count);
		$this->assign('redirectPage', 'feedback');
        $this->render();
    }

    // 删除记录，测试框架DB记录删除（Delete）
    public function delete($color_id = null){
		$im = new ColorModel();
        $count = $im->delete('color_id',$color_id);
		$this->assign('title', 'Erfolgreich L&ouml;sung');
		$this->assign('class_desc', 'Farbe');
		$this->assign('action_desc', 'gel&ouml;scht');
        $this->assign('count', $count);
		$this->assign('redirectPage', 'feedback');
        $this->render();
    }
	

}