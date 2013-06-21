<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $app->conf->info->site_title ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Bootstrap -->
        <?php
        foreach (xh::$_conf->server->cssfile->file as $file) {
            ?>
            <link href="./bootstrap/css/<?php echo $file ?>" rel="stylesheet" media="screen">
            <?php
        }
        ?>
<?php
        foreach (xh::$_conf->server->jsfile->file as $file) {
            ?>
            <script src="./bootstrap/js/<?php echo $file ?>"></script>
            <?php
        }
        ?>
    </head>
    <body>

        
        <div class="container-fluid">
            <div class="row-fluid">
                <div class="span4">

                </div>
                <div class="span8">
                    
                </div>
            </div>
        </div>
    </body>
</html>