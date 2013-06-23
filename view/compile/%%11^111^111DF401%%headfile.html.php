<?php /* Smarty version 2.6.26, created on 2013-06-23 20:53:24
         compiled from headfile.html */ ?>
<?php 
        foreach (explode(',',xh::$_redis->get('cssfile')) as $file) {
            
            echo '<link href="./bootstrap/css/'.trim($file).'" rel="stylesheet" media="screen">'.PHP_EOL;
            
        }
        
        foreach (explode(',',xh::$_redis->get('jsfile')) as $file) {
            
            echo '<script src="./bootstrap/js/'.trim($file).'"></script>'.PHP_EOL;
            
        }
 ?>