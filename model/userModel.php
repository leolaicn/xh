<?php

/**
 * 用户表模型
 * @author leo lai  <leolai@outlook.com>
 * @version 1.0
 */
class userModel extends modelClass {

    /**
     * 验证用户
     */
    public static function verifyUser($email = '', $password = '') {
        try {
            $password = md5($password);
            $stmt = db::$_conn->prepare('SELECT id FROM xh_user where email=:email AND password=:password LIMIT 1');
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':password', $password, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            //预留LOG部分
            $e->getMessage('数据查询失败!');
            exit();
        }
    }

    /**
     * 读取所有用户信息
     */
    public static function getUserInfo($uid) {
        try {
            $stmt = db::$_conn->prepare("select * from ");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        } catch (PDOException $exc) {
            echo $exc->getTraceAsString();
        }
    }

    /**
     * 获取最新用户
     */
    public static function getNewUser($num = 6) {
        try {
            $sql = "select xh_user.name,xh_user_propety.demand from xh_user,xh_user_propety
where xh_user.id=xh_user_propety.id and xh_user.id=1 order by xh_user.registertime DESC limit 0,$num";
            $result = db::$_conn->query($sql);
            $re = $result->fetchAll(PDO::FETCH_ASSOC);
            return $re;
        } catch (PDOException $e) {
            $e->getTraceAsString();
        }
    }

    /**
     * 获取用户列表BY地区
     */
    public static function getUserByArea($area = '', $page, $pagesize = 12) {
        $page*=$pagesize;
        $sql = "select * from xh_user,xh_user_basicinfo where xh_user_basicinfo.livecity='$area' 
                order by xh_user.lastlogin DESC limit $page,$pagesize";
        try {
            $result = db::$_conn->query($sql);
            return $result->fetchAll();
        } catch (PDOException $exc) {
            echo $exc->getTraceAsString();
        }
    }

    /**
     * 获取总的地区用户数
     */
    public static function getTotalUserByArea($area = '',$gender=0) {
        $sql = "select count(*) as countuser from xh_user,xh_user_basicinfo where xh_user_basicinfo.livecity='$area'
                and xh_user.gender='$gender'";
        try {
            $result = db::$_conn->query($sql);
            $re = $result->fetch();
            return $re['countuser'];
        } catch (PDOException $exc) {
            echo $exc->getTraceAsString();
        }
    }
    
    /**
     * 获取该地区用户数
     */
    public static function getUserByLivecity($area = '',$gender=0,$p=1){
        $p-=1;
        $p*=12;
        $sql = "select 
user.id,user.name,propety.single,propety.education,
propety.work,propety.demand,info.livecity,info.hometown  
from xh_user user left join xh_user_basicinfo info on user.id=info.uid
left join xh_user_propety propety on user.id=propety.uid
            where info.livecity='$area' and user.gender='$gender' limit $p,12";
        try {
            $result = db::$_conn->query($sql);
            $re = $result->fetchAll();
            return $re;
        } catch (PDOException $exc) {
            echo $exc->getTraceAsString();
        }
    }
    
     /**
     * 获取家乡用户数
     */
    public static function getUserByHometown(){
        
    }
    /**
     * 获取用户性别、所在地区、家乡
     */
    public static function getUserBasicInfo($uid){
        $sql="select xh_user.name,xh_user.gender,xh_user_basicinfo.hometown,xh_user_basicinfo.livecity 
from xh_user_basicinfo,xh_user where xh_user_basicinfo.uid=xh_user.id and xh_user.id=$uid limit 1";
        try {
            $result = db::$_conn->query($sql);
            $re = $result->fetch();
            return $re;
        } catch (PDOException $exc) {
            echo $exc->getTraceAsString();
        }
    }
}