<?php
/**
 * 前端控制器
 * @author leo lai  <leolai@outlook.com>
 * @version 1.0
 */
class frontController{
    
    public function __construct($query='') {
        $controller=new mainController();
        if(empty($query)){//空查询跳转到首页
            $controller->run('page','index');
        }else{
            $c=$this->parseUrl($this->clearUrl(''));//解析请求并分发
            $controller->run($c[0],$c[1]);
        }
        
    }
    /**
     * 对URL进行解码
     */
    public function clearUrl($url){
        return htmlentities($url);
        
    }
    /**
     * 存放解析URL的方法
     */
    public function parseUrl(){
        preg_match('|^(\w+)-(\w+)/|', $subject,$arr);
        return array($arr[1],$arr[2]);
    }
    /**
     * 预留filter接口
     */
    public function doFilter(){
        
        
    }
}