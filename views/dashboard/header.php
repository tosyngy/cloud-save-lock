



<!DOCTYPE html>
<!-- saved from url=(0031)http://localhost/school/classes -->
<html lang="en" style="overflow: hidden;">
    <head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content=""> 

        <title>Save Lock Panel </title>

        <!-- Bootstrap core CSS -->
        <script src="<?php echo URL ?>public/jquery2.1.3.min.js"></script>
        <script src='<?php echo URL ?>public/jqueryUI/jquery-ui.js'></script>
        <script src='<?php echo URL ?>public/bootstrap/js/bootstrap.js'></script>
        <link rel='stylesheet' href="<?php echo URL ?>public/jqueryUI/jquery-ui.css" />
        <link rel='stylesheet' href="<?php echo URL ?>public/bootstrap/css/bootstrap.css" />
        <link rel="stylesheet" href="<?php echo URL ?>views/dashboard/css/styles.css">
        <link rel="stylesheet" href="<?php echo URL ?>views/index/css/style.css" media="screen" type="text/css" />
        <link rel="stylesheet" href="<?php echo URL ?>public/font-awesome/css/font-awesome.css" media="screen" type="text/css" />
        <!--external css-->
        <link rel="stylesheet" type="text/css" href="<?php echo URL ?>views/dashboard/resources/style.css">    

        <!-- Custom styles for this template -->
        <link href="<?php echo URL ?>views/dashboard/assets/css/style.css" rel="stylesheet">


        <link href="<?php echo URL ?>views/dashboard/file_upload/css/fileinput.css" media="all" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>views/dashboard/datetimepicker/build/css/bootstrap-datetimepicker.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo URL ?>views/dashboard/resources/jquery.gritter.css">
        <link rel="stylesheet" type="text/css" href="<?php echo URL ?>views/dashboard/resources/zabuto_calender.css" />
        <script src="<?php echo URL ?>views/dashboard/file_upload/js/fileinput.js" type="text/javascript"></script>
        <script src="<?php echo URL ?>public/js/moment.js"></script>

        <script src="<?php echo URL; ?>views/dashboard/datetimepicker/src/js/bootstrap-datetimepicker.js"></script>
        <script src='<?php echo URL ?>views/dashboard/resources/jquery.nicescroll.js'></script>
        <script src='<?php echo URL ?>views/dashboard/resources/jquery.scrollTo.min.js'></script>
        <script src='<?php echo URL ?>views/dashboard/resources/jquery.dcjqaccordion.2.7.js'></script>
        <script src='<?php echo URL ?>views/dashboard/resources/script.js'></script>
        <script src='<?php echo URL ?>views/dashboard/resources/common-scripts.js'></script>
        <script src='<?php echo URL ?>views/dashboard/resources/jquery.gritter.js'></script>
        <script src='<?php echo URL ?>views/dashboard/resources/gritter-conf.js'></script>
        <script src='<?php echo URL ?>views/dashboard/resources/jquery.sparkline.js'></script>
        <script src='<?php echo URL ?>views/dashboard/resources/sparkline-chart.js'></script>
        <script src='<?php echo URL ?>views/dashboard/resources/Chart.js'></script>
        <script src='<?php echo URL ?>views/dashboard/resources/zabuto_calender.js'></script>


    </head>
    <body style="">
        <header class="header" style="  background-color: rgb(66, 133, 244);">
            <div class="sidebar-toggle-box">
                <div class="fa fa-bars tooltips" data-placement="right" data-original-title=""></div>
            </div>
            <!--logo start-->
            <a href="http://localhost/savelock" class="logo"><b>Save <i class="fa fa-lock"></i> Panel</b></a>
            <!--logo end-->
            <div class="nav notify-row" id="top_menu">


            </div>
            <div class="top-menu">
                <ul class="nav pull-right top-menu">
                    <li id="logout"><a style="background: red" class="logout" href="http://localhost/savelock/index/logout">Logout</a></li>
                </ul>
            </div>
        </header>
   

        <aside>
            <div id="sidebar" class="nav-collapse " style="margin-left: 0px;">
                <!-- sidebar menu start-->
                <ul class="sidebar-menu" id="nav-accordion" style="display: block;">
                    <?php if (Session::get("usertype") == 2) { ?>
                        <li class="sub-menu">
                            <a href="http://localhost/savelock/dashboard/users">
                                <i class="fa fa-user"></i>
                                <span>Users</span>
                            </a>

                        </li>
                        <li class="sub-menu">
                            <a href="http://localhost/savelock/dashboard/documents">
                                <i class="fa fa-save"></i>
                                <span>Documents</span>
                            </a>
                        </li>
                    <?php }?>
                        <li class="sub-menu">
                            <a href="http://localhost/savelock/dashboard/save">
                                <i class="fa fa-file"></i>
                                <span>Add New</span>
                            </a>

                        </li>
                        <li class="sub-menu">
                            <a href="http://localhost/savelock/dashboard/my_documents">
                                <i class="fa fa-save"></i>
                                <span>My Documents</span>
                            </a>
                        </li>
                </ul>
                <!-- sidebar menu end-->
            </div>
        </aside>
        <!--sidebar end-->
        <div class="container kv-main">