<?php
/**
 * 模型抽象类
 * @author leo lai  <leolai@outlook.com>
 * @version 1.0
 */
abstract class modelClass{
    protected static $_tableName='';//表名
    protected static $_tablePreFix='xh_';
    protected static $_column;
    /**
     * 获取表单所有数据的方法
     */
    public function getAllData(){
        return db::queryAll($this->_tableName, $this->_tablePreFix);
    }
    /**
     * 获取一个数据，根据主键
     */
    public function getByPk($table,$keyid){
        return db::queryARow($table,$keyid,self::$_tablePreFix);
        
    }
    /**
     * 表单数据类型验证方法
     */
    public function verifyData(){
        
    }
}