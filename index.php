<?php
/**
 * 主入口文件
 * @author leo lai  <leolai@outlook.com>
 * @version 1.0
 */
ini_set('display_errors', 'On');
error_reporting(E_ALL);

class xh{
    public static $_conf=NULL;
    public static $_redis=NULL;
    /**
     * 构造函数，引入配置文件
     * 启动前端控制器
     * 路由解析分发
     */
    public function __construct($confFile='./conf/conf.xml') {
        //注册autoload
        
        spl_autoload_register(array($this,'loadClass'));
        //解析配置文件信息
        $conf=  simplexml_load_file($confFile);
        self::$_conf=$conf;
        // 启动REDIES
        self::$_redis=new Redis();

        self::$_redis->connect((string)$conf->cache->redis->host,(string)$conf->cache->redis->port);
        //存入常用配置信息
        self::$_redis->set('cssfile',$conf->server->cssfile->file);
        self::$_redis->set('jsfile',$conf->server->jsfile->file);
        //链接数据库
        $this->dbConn(self::$_conf->db->host,self::$_conf->db->dbname,self::$_conf->db->port,self::$_conf->db->username,self::$_conf->db->password);
        //运行控制器 
        $controller=new frontController($_SERVER['QUERY_STRING']);
        
    }
    
    
    
    /***/
    
    
    /**
     * 生成数据库链接
     * @param String $host 主机名称...
     * 用db::$_conn可以获取
     */
    public function dbConn($host='localhost',$dbname='xh',$port='3306',$username='root',$passowrd='root'){
        db::getConn($host, $dbname, $port, $username, $passowrd);
    }


    /**
     * 接管autoload方法
     * @param string $classname 调用的类名
     */
    public static function loadClass($classname){
        if(is_file('./'.$classname.'.php')){
            include_once $classname.'.php';
        }elseif(is_file('./model/'.$classname.'.php')){
            include_once './model/'.$classname.'.php';
        }elseif(is_file('./view/'.$classname.'.php')) {
            include_once './view/'.$classname.'.php';
        }elseif(is_file('./controller/'.$classname.'.php')){
            include_once './controller/'.$classname.'.php';
        }else{
            include_once './tools/'.$classname.'.php';
        }
    }
    
}
//实例化运行
$app=new xh();
