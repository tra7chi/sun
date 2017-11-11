<?php
 
class IndexController extends Controller{
	// 首页方法，测试框架自定义DB查询
    public function index($keyword){
        $this->render();
    }
}