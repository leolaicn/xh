<?php
/**
 * PAGE控制器 主要负责全局页面的管理
 * @author leo lai  <leolai@outlook.com>
 * @version 1.0
 */
class pageController extends mainController{
    

    
    /**
     * 首页
     */
    public function index(){
        //获取用户基本信息
        $model=new feedbackModel();
        $data=$model->getByPk('feedback',1);
        xh::$_smarty->assign('feedback',$data);
        xh::$_smarty->display($this->getClassName().'/index.html');
        var_dump(xh::$_redis->get('site_conf'));
    }
}