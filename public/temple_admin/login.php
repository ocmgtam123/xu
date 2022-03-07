<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title><?= $this->language('l_title_admin') ?></title>
        <link href="<?=URL_PUBLIC_ADMIN?>css/style.css" rel="stylesheet">
        <!-- Bootstrap Core CSS -->
        <link href="<?=URL_PUBLIC_ADMIN?>css/bootstrap.min.css" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="<?=URL_PUBLIC_ADMIN?>css/metisMenu.min.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="<?=URL_PUBLIC_ADMIN?>css/startmin.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="<?=URL_PUBLIC_ADMIN?>css/font-awesome.min.css" rel="stylesheet" type="text/css">
    </head>
    <body>

        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <div class="login-panel panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Vui lòng đăng nhập</h3>
                        </div>
                        <?php require  $this->_fileView; ?>                        
                    </div>
                </div>
            </div>
        </div>

        <!-- jQuery -->
        <script src="<?=URL_PUBLIC_ADMIN?>js/jquery.min.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="<?=URL_PUBLIC_ADMIN?>js/bootstrap.min.js"></script>

        <!-- Metis Menu Plugin JavaScript -->
        <script src="<?=URL_PUBLIC_ADMIN?>js/metisMenu.min.js"></script>

        <!-- Custom Theme JavaScript -->
        <script src="<?=URL_PUBLIC_ADMIN?>js/startmin.js"></script>

    </body>
</html>
