<?php
/**
 * 前端控制器
 * @author leo lai  <leolai@outlook.com>
 * @version 1.0
 */
class frontController{
    
    public function __construct() {
        $controller=new mainController();
        if(empty($_REQUEST['r'])){//空查询跳转到首页
            $controller->run('page','index');
        }else{
            $c=$this->parseUrl($this->clearUrl());//解析请求并分发
            $controller->run($c[0],$c[1]);
        }
        
    }
    /**
     * 对URL进行解码
     */
    public function clearUrl(){
        return htmlentities(trim($_REQUEST['r']));
        
    }
    /**
     * 存放解析URL的方法
     */
    public function parseUrl($url){
       return explode('-', $url);
    }
    /**
     * 预留filter接口
     */
    public function doFilter(){
        
        
    }
}