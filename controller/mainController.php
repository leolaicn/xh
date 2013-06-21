<?php

class mainController implements controllerInterface{
    public $_runController='page';
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
     * 传入模板
     */
    public function template($page){
        include './view/'.$this->_runController.'/'.$page;
    }
}