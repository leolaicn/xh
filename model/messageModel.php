<?php
/**
 * 信息表模型
 * @author leo lai  <leolai@outlook.com>
 * @version 1.0
 */
class messageModel extends modelClass{
    /**
     * 获取用户未读信息 
     */
    public static function getUnreaderMsg($uid){
        $sql="select count(*) as countmsg from xh_message,xh_user where xh_user.id=xh_message.to and xh_message.readed=0";
        try{
            $result=db::$_conn->query($sql);
            $re=$result->fetch();
            return $re['countmsg'];
        }  catch (PDOException $e){
            $e->getTraceAsString();
        }
    }
}