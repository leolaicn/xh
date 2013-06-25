<?php
/**
 * PAGE控制器 主要负责全局页面的管理
 * @author leo lai  <leolai@outlook.com>
 * @version 1.0
 */
class pageController extends mainController{
    /**
     * 登录
     */
    public function login(){ 
        $email=$_POST['email'];
        $password=$_POST['password'];
        if(!filter_var($email,FILTER_VALIDATE_EMAIL))
            $this->urlChange('page-index','邮箱格式错误!');
        if(strlen(trim($password))>32)    
            $this->urlChange('page-index','密码超出范围!');
        $result=userModel::verifyUser($email, $password);
        if(!empty($result['id'])){
            $_SESSION['uid']=$result['id'];
            setcookie('email',$email,time()+3600*30);
            header('Location:index.php?r=page-home');
            
        }else{
            header('Location:index.php');
        }
    }
    /**
     * 用户首页
     */
    public function home(){
        //页码
        isset($_REQUEST['p']) ? $p=(int)$_REQUEST['p']:$p=1;
        //xh::$_redis->spop('newuser');
        //查找新用户
        if(date('i',time())%10 == 0 || xh::$_redis->ssize('newuser') === 0){
            $newuser=userModel::getNewUser();
            foreach($newuser as $n){
                //存储最新用户
                xh::$_redis->sadd('newuser',serialize($n));
            }
        }
        
        //获取用户消息条数
        $noreadMsg=messageModel::getUnreaderMsg($_SESSION['uid']);
        //获取用户好友请求条数
        //获取用户基本信息 
        $userBasicInfo=  userModel::getUserInfo($_SESSION['uid']);
        //获取当地用户数量
        $totalLocalUser=  userModel::getTotalUserByArea($userBasicInfo['livecity'],$userBasicInfo['gender']);
        //获取当地用户列表按照用户注册时间排序
        $localUser=  userModel::getUserByLivecity($userBasicInfo['livecity'],$userBasicInfo['gender'],$p);
        //$page=new page(array('total_rows'=>$totalLocalUser));
        //获取推荐的当地用户
        //获取推荐的家乡用户
    }
    /**
     * 首页
     */
    public function index(){
        //获取用户状态
        if(isset($_SESSION['uid'])){
            header('Location:index.php?r=page-home');
        }
        isset($_COOKIE['email']) ? $email=$_COOKIE['email'] :$email='';
        
        
        xh::$_smarty->assign('email',$email);
        xh::$_smarty->display($this->getClassName().'/index.html');
    }
}