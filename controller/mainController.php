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
}