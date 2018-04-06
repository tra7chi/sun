<?php
/**
 * core框架核心
 */

class FrameWorkCore{
    protected $_config = array();

    public function __construct($config){
        $this->_config = $config;
    }

    // 运行程序
    public function run(){
        //
		spl_autoload_register(array($this, 'loadClass'));
        $this->setReporting();
        $this->removeMagicQuotes();
        $this->unregisterGlobals();
        $this->setDbConfig();
        $this->route();
    }

    // 路由处理
    public function route(){
        $controllerName = $this->_config['defaultController'];
		//echo 'controllerName: ' . $controllerName . '<br />';
        $actionName = $this->_config['defaultAction'];
		//echo 'actionName: ' . $actionName . '<br />';
        $param = array();

        $url = $_SERVER['REQUEST_URI'];
		//$url = '/products/index/32refsadfqre';
		//echo 'url: ' . $url . '<br />';
        // 清除?之后的内容
        $position = strpos($url, '?');
        $url = $position === false ? $url : substr($url, 0, $position);
        // 删除前后的“/”
        $url = trim($url, '/');
		//echo 'url: ' . $url . '<br />';
        if ($url) {
            // 使用“/”分割字符串，并保存在数组中
            $urlArray = explode('/', $url);
            // 删除空的数组元素
            $urlArray = array_filter($urlArray);
			//print_r($urlArray);
			//echo "<br>".strpos(PROJECT_DIR,$urlArray[0]);
			if(strpos(PROJECT_DIR,$urlArray[0]) === 1)
				array_shift($urlArray);
			//}
			
            // 获取控制器名
			//print_r($urlArray);
			if($urlArray!=null){
				if(strpos($urlArray[0],'BE_') === 0){
					$controllerName = substr($urlArray[0],0,3) . ucfirst(substr($urlArray[0],3));
				}
				else
					$controllerName = ucfirst($urlArray[0]);
			}
			else
				$controllerName = 'Index';
            //echo 'controllerName: ' . $controllerName . '<br />';
            // 获取动作名
            array_shift($urlArray);
            $actionName = $urlArray ? $urlArray[0] : $actionName;
            //echo 'actionName: ' . $actionName . '<br />';
            // 获取URL参数
            array_shift($urlArray);
            $param = $urlArray ? $urlArray[0] : array();
			//echo 'param: ' . $param . '<br />';
        }
		
        // 判断控制器和操作是否存在
        $controller = $controllerName . 'Controller';
		//echo $controller;
        if (!class_exists($controller)) {
            //exit();
			exit($controller . '控制器不存在');
        }
        if (!method_exists($controller, $actionName)) {
            //exit();
			exit($actionName . '方法不存在');
        }

        // 如果控制器和操作名存在，则实例化控制器，因为控制器对象里面
        // 还会用到控制器名和操作名，所以实例化的时候把他们俩的名称也
        // 传进去。结合Controller基类一起看
        $dispatch = new $controller($controllerName, $actionName);

        // $dispatch保存控制器实例化后的对象，我们就可以调用它的方法，
        // 也可以像方法中传入参数，以下等同于：
		$dispatch->$actionName($param);
        //call_user_func_array(array($dispatch, $actionName), $param);
    }

    // 检测开发环境
    public function setReporting(){
        if (APP_DEBUG === true) {
            error_reporting(E_ALL);
            ini_set('display_errors','On');
        } else {
            error_reporting(E_ALL);
            ini_set('display_errors','Off');
            ini_set('log_errors', 'On');
        }
    }

    // 删除敏感字符
    public function stripSlashesDeep($value){
        $value = is_array($value) ? array_map(array($this, 'stripSlashesDeep'), $value) : stripslashes($value);
        return $value;
    }

    // 检测敏感字符并删除
    public function removeMagicQuotes(){
        if (get_magic_quotes_gpc()) {
            $_GET = isset($_GET) ? $this->stripSlashesDeep($_GET ) : '';
            $_POST = isset($_POST) ? $this->stripSlashesDeep($_POST ) : '';
            $_COOKIE = isset($_COOKIE) ? $this->stripSlashesDeep($_COOKIE) : '';
            $_SESSION = isset($_SESSION) ? $this->stripSlashesDeep($_SESSION) : '';
        }
    }

    // 检测自定义全局变量并移除。因为 register_globals 已经弃用，如果
    // 已经弃用的 register_globals 指令被设置为 on，那么局部变量也将
    // 在脚本的全局作用域中可用。 例如， $_POST['foo'] 也将以 $foo 的
    // 形式存在，这样写是不好的实现，会影响代码中的其他变量。 相关信息，
    // 参考: http://php.net/manual/zh/faq.using.php#faq.register-globals
    public function unregisterGlobals(){
        if (ini_get('register_globals')) {
            $array = array('_SESSION', '_POST', '_GET', '_COOKIE', '_REQUEST', '_SERVER', '_ENV', '_FILES');
            foreach ($array as $value) {
                foreach ($GLOBALS[$value] as $key => $var) {
                    if ($var === $GLOBALS[$key]) {
                        unset($GLOBALS[$key]);
                    }
                }
            }
        }
    }

    // 配置数据库信息
    public function setDbConfig(){
        if ($this->_config['db']) {
            Model::setDbConfig($this->_config['db']);
        }
    }

    // 自动加载控制器和模型类 
    public static function loadClass($class){
		//echo '$class:'.$class.'<br />';
        $frameworks = __DIR__ .'/'. $class . '.php';
		//echo $frameworks.'<br />';
		if(substr($class,0,3)=='BE_'){
		 	$controllers = APP_PATH . 'application/controllers/back_end/' . $class . '.php';
        	$models = APP_PATH . 'application/models/' . substr($class,3) . '.php';
		}
		else{
		    $controllers = APP_PATH . 'application/controllers/front_end/' . $class . '.php';
        	$models = APP_PATH . 'application/models/' . $class . '.php';
		}
		//echo '$frameworks:'.$frameworks.'<br />';
		//echo '$controllers:'.$controllers.'<br />';
		//echo '$models:'.$models.'<br />';
        if (file_exists($frameworks)) {
            // 加载框架核心类
            include $frameworks;
			//echo "加载框架核心类:" .$frameworks.'成功<br />';
        } elseif (file_exists($controllers)) {
            // 加载应用控制器类
            include $controllers;
			//echo "加载应用控制器类:" .$controllers.'成功<br />';
        } elseif (file_exists($models)) {
            //加载应用模型类
            include $models;
			//echo "加载应用模型类:" .$models.'成功<br />';
        } else {
            // 错误代码
        }
    }
}