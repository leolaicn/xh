<?php
/**
 * PAGE控制器 主要负责全局页面的管理
 * @author leo lai  <leolai@outlook.com>
 * @version 1.0
 */
class pageController extends mainController{
    
    
    
    
    public function index(){
        //获取用户基本信息
        $model=new feedbackModel();
        $data=$model->getByPk('feedback',1);
        var_dump($data);
        $this->template('index.php');
    }
}