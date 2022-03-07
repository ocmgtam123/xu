<!DOCTYPE html>
<html lang="en">
    <head>        
        <?php require PATH_INCLUDES . 'admin_head.php'; ?>
    </head>
    <body>
        <div id="wrapper">
            <?php require PATH_INCLUDES . 'admin_popup.php'; ?>
            <!-- Navigation -->
            <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
                <div class="navbar-header">
                    <a class="navbar-brand" href="<?= $this->route('adminbanner') ?>">Xoài ÚC</a>
                </div>

                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <ul class="nav navbar-nav navbar-left navbar-top-links">
                    <li>
                        <a target="_block" href="<?= $this->route('home') ?>">
                            <i class="fa fa-home fa-fw"></i> Website
                        </a>
                    </li>
                </ul>

                <ul class="nav navbar-right navbar-top-links">                    
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-user fa-fw"></i> <?=$_SESSION['hollywoodadmin']['ID']?> <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="<?= $this->route('adminlogout') ?>">
                                    <i class="fa fa-sign-out fa-fw"></i> Logout</a></li>
                        </ul>
                    </li>
                </ul>
                <!-- /.navbar-top-links -->

                <div class="navbar-default sidebar" role="navigation">
                    <div class="sidebar-nav navbar-collapse">
                        <ul class="nav" id="side-menu">
                            <?php require PATH_INCLUDES . 'admin_menu_left.php'; ?>                            
                        </ul>
                    </div>
                </div>
            </nav>

            <div id="page-wrapper">
                <div class="container-fluid">
                    <?php require  $this->_fileView; ?>                    
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /#page-wrapper -->

        </div>
        <!-- /#wrapper -->

        <!-- jQuery -->
        <script src="<?=URL_PUBLIC_ADMIN?>js/jquery.min.js"></script>
        <script src="<?=URL_PUBLIC_ADMIN?>js/bootstrap.min.js"></script>
        <script src="<?=URL_PUBLIC_ADMIN?>js/metisMenu.min.js"></script>
        <!-- Morris Charts JavaScript 
        <script src="<?=URL_PUBLIC_ADMIN?>js/raphael.min.js"></script>
        <script src="<?=URL_PUBLIC_ADMIN?>js/morris.min.js"></script>
        <script src="<?=URL_PUBLIC_ADMIN?>js/morris-data.js"></script>-->
        <!-- DataTables JavaScript -->
        <script src="<?= URL_PUBLIC_ADMIN ?>js/dataTables/jquery.dataTables.min.js"></script>
        <script src="<?= URL_PUBLIC_ADMIN ?>js/dataTables/dataTables.bootstrap.min.js"></script>

        <!-- Custom Theme JavaScript -->
        <script src="<?=URL_PUBLIC_ADMIN?>js/startmin.js"></script>

        <script>
            $(document).ready(function () {
                $('#dataTables-example').DataTable({
                    responsive: true,
                    "order": [[ 0, "desc" ]],
                    "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
                });
            });
        </script>
    </body>
</html>