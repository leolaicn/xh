<?php /* Smarty version 2.6.26, created on 2013-06-24 16:51:07
         compiled from page/index.html */ ?>
<!DOCTYPE html>
<html>
    <head>
        <title><?php echo xh::$_redis->get('site_title') ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <!-- Bootstrap -->
        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'headfile.html', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
        <?php echo '
        <script>
            $(function(){
                $(\'.dropdown-toggle\').dropdown();
                $(".collapse").collapse();
                
            });
            
        </script>
        '; ?>

    </head>
    <body>
        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'nav.html', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
        
    <div class="container-fluid">
    <div class="row-fluid">
        <div class='span8'>
            <img src='' alt='' />
            <p>#介绍。。。</p>
        </div>
    <div class="span4">
    <!--登录框-->
        <ul class="nav nav-tabs" id="myTab">
<li class="active"><a href="#login">login</a></li>
<li><a href="#reg">reg</a></li>
</ul>
 
<div class="tab-content">
<div class="tab-pane active" id="login">
    
    <form class="form-inline" action='index.php?r=page-login' method='post'>
    <input name="email" type="text" class="input-small" placeholder="Email" <?php if ($this->_tpl_vars['email'] != ''): ?>value="<?php echo $this->_tpl_vars['email']; ?>
" <?php endif; ?>>
    <input name="password" type="password" class="input-small" placeholder="Password">
    <label class="checkbox">
    <input type="checkbox">记住我
    </label>
    <input type="submit" value='提交'/>
    </form>
</div>
<div class="tab-pane" id="reg">
        <form action='index.php?r=page-reg' class="form-inline" method='post'>
    <input type="text" class="input-small" placeholder="Email">
    <input type="password" class="input-small" placeholder="Password">
    <label class="checkbox">
    <input type="checkbox"> Remember me
    </label>
    <button type="submit" class="btn">Sign in</button>
    </form>
    
</div>
</div>
    
    <!--login-->
    </div>
        
    </div>
    </div>
</html>