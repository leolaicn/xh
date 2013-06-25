<?php
/**
 * @param $host,$dbname,$port,$username,$passowrd 数据库连接使用的必要参数
 * 数据库类存放数据库链接已经常用方法
 * @author leo lai  <leolai@outlook.com>
 * @version 1.0
 */
class db{
    public static $_conn=NULL;//存储PDO对象
    public $_dbconntemp=NULL;//临时存放PDO对象
    
    /**
     * 构造函数建立新连接
     * @param $host,$dbname,$port,$username,$passowrd
     */
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
    /**
     * 查询一个数据结果集合
     * @param string $table 表名
     * @param str   $fix 表前缀
     * @param column $columns 要获取的字段
     * @param string $condition 约束条件
     * @return array 返回一个数组
     */
    public static function queryAll($table,$fix,$colums='',$condition=''){
        try {
            $re=self::$_conn->query("select ".$colums." from `".$fix.$table.'` '.$condition);
            return $re->fetchAll();
           
        } catch (PDOException $exc) {
            echo '数据查询失败，请重试！';
            echo $exc->getTraceAsString();
        }
        }
    /**
     * 查询一个数据并返回一个数组
     * @param string $table 要查询的表名
     * @param int $id 要查询的主键列
     * @param string $columns 要获取的字段
     * @param string $condithion 预留
     * @return array 返回一个数组
     */
        public static function queryARow($table,$id,$fix,$columns='*',$condition=''){
            try{
                $stmt=  self::$_conn->prepare("select ".$columns." from `".$fix.$table."` where id=:id");
                $stmt->bindParam(':id',$id,PDO::PARAM_INT);
                $stmt->execute();
                return $stmt->fetch(PDO::FETCH_ASSOC);
            }  catch (PDOException $exc){
                echo '数据查询失败，请重试！';
             echo $exc->getTraceAsString();
            }
        }
        /**
         *条件查询 预留接口
         */
        public static function queryResultByCondition($column='*',$fix='xh',$table='',$where='1',$param=array()){
            try{
                
                }catch(PDOException $e){
                echo '数据查询失败，请重试！';
                echo $e->getTraceAsString();
            }
        }
        /**
         * 自定义查询 预留接口
         */
        public function normalQuery(){
            
        }
        
}