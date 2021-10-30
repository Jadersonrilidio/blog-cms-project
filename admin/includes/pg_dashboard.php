
<!-- Page Heading -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                
                <h1 class="page-header"> Dashboard <small> &ensp; Admin <?php display_admin_user_name(); ?> </small> </h1>
                
                <div class="col-xs-12">

                <div class="row">

                    <!-- dashboad widgets -->
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-file-text fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                <div class='huge'> <?php echo dashboard_count('posts'); ?> </div>
                                        <div> Posts </div>
                                    </div>
                                </div>
                            </div>
                            <a href="index.php?page=posts&source=default">
                                <div class="panel-footer">
                                    <span class="pull-left"> View Details </span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-comments fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                    <div class='huge'>  <?php echo dashboard_count('comments'); ?> </div>
                                    <div> Comments </div>
                                    </div>
                                </div>
                            </div>
                            <a href="./index.php?page=comments&source=default">
                                <div class="panel-footer">
                                    <span class="pull-left"> View Details </span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-users fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                    <div class='huge'> <?php echo dashboard_count('users'); ?> </div>
                                        <div> Users </div>
                                    </div>
                                </div>
                            </div>
                            <a href="./index.php?page=users&source=view_all">
                                <div class="panel-footer">
                                    <span class="pull-left"> View Details </span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-tags fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class='huge'> <?php echo dashboard_count('categories'); ?> </div>
                                        <div> Categories </div>
                                    </div>
                                </div>
                            </div>
                            <a href="index.php?page=categories">
                                <div class="panel-footer">
                                    <span class="pull-left"> View Details </span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>

                </div>
                <!-- dashboad widgets end -->
                
                <!-- chart js script end-->
                <div class="row">
                    <?php dashboard_chart_script(); ?>
                </div>

                <div id="columnchart_material" style="width: 1000px; height: 300px;"></div>
                <!-- chart js script end-->

                <ol class="breadcrumb">
                    <li> <i class="fa fa-dashboard"> </i>  <a href="index.php"> Dashboard </a> </li>   
                    <li class="active"> <i class="fa fa-file"> </i> Blank Page </li>
                </ol>

            </div>
        </div>
    </div>
</div>
<!-- End Page Heading -->