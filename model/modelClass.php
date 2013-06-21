<?php

class modelClass{
    protected $_tableName='';//表名
    protected $_tablePreFix='xh_';
    protected $_column;
    /**
     * 获取表单所有数据的方法
     */
    public function getAllData(){
        return db::queryAll($this->_tableName, $this->_tablePreFix);
    }
    /**
     * 获取一个数据，根据主键
     */
    public function getByPk(){
        
        
    }
    /**
     * 表单数据类型验证方法
     */
    public function verifyData(){
        
    }
}