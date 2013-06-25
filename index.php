<?php

/**
 * 主入口文件 实例化APP
 * @author leo lai  <leolai@outlook.com>
 * @version 1.0
 */
ini_set('display_errors', 'On');
error_reporting(E_ALL);

class xh {
    private $_dbConfFile='./conf/db.xml';
    public static $_conf = NULL; //存储配置文件  （预留）
    public static $_redis = NULL; //存储redis
    public static $_smarty = NULL; //smarty对象

    /**
     * 构造函数，引入配置文件
     * 启动前端控制器
     * 路由解析分发
     */

    public function __construct() {
        session_start();
        //注册autoload
        spl_autoload_register(array($this, 'loadClass'));
        //解析配置文件信息
        $conf = simplexml_load_file($this->_dbConfFile);
        
        // 启动REDIES
        self::$_redis = new Redis();
        self::$_redis->connect((string) $conf->redis->host, (string) $conf->redis->port);
        //配置文件内容放入redis
        self::$_redis->get('site_title')? : $this->redisDataInit(array('info'));

        //Smarty配置
        include './smarty/Smarty.class.php';
        $smarty = new Smarty();
        $smarty->compile_dir = './view/compile/';
        $smarty->caching = 0;
        $smarty->template_dir = './view/';
        self::$_smarty = $smarty;
        //开启数据库连接
        $this->dbConn($conf->db->host, $conf->db->dbname, $conf->db->port, $conf->db->username,$conf->db->password);
        //运行控制器 
        $controller = new frontController($_SERVER['QUERY_STRING']);
    }



    /**
     * 生成数据库链接
     * @param String $host 主机名称...
     * 用db::$_conn可以获取
     */
    public function dbConn($host = 'localhost', $dbname = 'xh', $port = '3306', $username = 'root', $passowrd = 'root') {
        db::getConn($host, $dbname, $port, $username, $passowrd);
    }

    /**
     * 接管autoload方法
     * @param string $classname 调用的类名
     */
    public static function loadClass($classname) {
        if (is_file('./' . $classname . '.php')) {
            include_once $classname . '.php';
        } elseif (is_file('./model/' . $classname . '.php')) {
            include_once './model/' . $classname . '.php';
        } elseif (is_file('./view/' . $classname . '.php')) {
            include_once './view/' . $classname . '.php';
        } elseif (is_file('./controller/' . $classname . '.php')) {
            include_once './controller/' . $classname . '.php';
        } else {
            include_once './tools/' . $classname . '.php';
        }
    }

    /**
     * 初始化redis数据
     */
    public function redisDataInit(Array $array=array()){
        //初始化conf数据
        if(empty($array))
            return;
        foreach($array as $a){
            $xml=  file_get_contents('./conf/'.$a.'.xml');
            $iterator=new SimpleXMLIterator($xml);
            $this->insertIntoRedis($iterator);
        }
        
    }

    /**
     * 存储进redis
     */
    public function insertIntoRedis(SimpleXMLIterator $iterator){
        for($iterator->rewind();$iterator->valid();$iterator->next()){
            if($iterator->hasChildren()){
                $this->insertIntoRedis($iterator->current());
            }else{
                self::$_redis->set($iterator->key(),(string)$iterator->current());
            }
             
        }
    }
    
    /**
     * 析够函数
     */
    public function __destruct() {
        db::$_conn = NULL;
        self::$_redis->close();
    }

}

//实例化运行
$app = new xh();
