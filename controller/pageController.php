<?php

class pageController extends mainController{
    
    
    
    
    public function index(){
        //获取用户基本信息
        $model=new feedbackModel();
        $data=$model->getAllData();
        var_dump($data);
        $this->template('index.php');
    }
}