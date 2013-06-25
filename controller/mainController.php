<?php

class mainController implements controllerInterface{
    public $_runController='page';
    public function __construct() {

    }

    /**
     * 获取当前控制器名称（不含后缀）
     */
    protected function getClassName(){
        $class=  get_class($this);
        return substr($class, 0,  strpos($class, 'Controller'));
    }


    final public function run($controller,$action){
        $this->_runController=$controller;
        $cname=$controller.'Controller';
        $controller=new $cname();
        $controller->$action();
    }
    /**
     * 预留解析方法
     */
    public function parseParam(){
        
    }
    
    /**
     * 权限检查
     */
    public function checkPermission(){
        
    }
    /**
     * 传入自定义模板引擎 预留
     */
    public function template($page){
        //include './view/'.$this->_runController.'/'.$page;
    }
    /**
     * 页面跳转
     */
    public function urlChange($page,$info=''){
        if($page == 404){
            header('HTTP/1.0 404 Not Found');
            exit();
        }else{
            if($info!=''){
                echo $info;
            }
           
            echo '<meta http-equiv="refresh" content=3; url=http://localhost/xh/index.php?r=page-home" />';
            
        }
    }
}