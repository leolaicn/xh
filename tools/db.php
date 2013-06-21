<?php
/**
 * 数据库类存放数据库链接已经常用方法
 * @author leo lai  <leolai@outlook.com>
 * @version 1.0
 */
class db{
    public static $_conn=NULL;//存储PDO对象
    public $_dbconntemp=NULL;//临时存放PDO对象
    private function __construct($host,$dbname,$port,$username,$passowrd) {
        try {
            $dsn="mysql:host=$host;port=$port;dbname=$dbname";
            $conn=new PDO($dsn,$username,$passowrd);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conn->exec("set character set UTF8");
            $this->dbconntemp = $conn;
        } catch (PDOException $exc) {
            echo '数据库连接失败';
            echo $exc->getTraceAsString();
        }
        }
    public static function getConn($host,$dbname,$port,$username,$passowrd){
        if(empty(self::$_conn)){
            $db=new self($host,$dbname,$port,$username,$passowrd);
            self::$_conn=$db->dbconntemp;
        }
        return self::$_conn;
    }
    public static function queryAll($table,$fix,$condition=''){
        try {
            $re=self::$_conn->query("select * from `".$fix.$table.'` '.$condition);
            return $re->fetchAll();
           
        } catch (PDOException $exc) {
            echo $exc->getTraceAsString();
        }
        }
    
}