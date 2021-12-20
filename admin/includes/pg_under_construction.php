
<!-- Page Function Set -->
<?php include 'functions/f_admin_navigationbar.php'; ?>

<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
   
    


    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span> 
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
    
        <a class="navbar-brand">CMS Admin System</a> 
        
    </div>

    




    <!-- Top Menu Items -->
    <ul class="nav navbar-right top-nav">
    
        <li> <a> Users online: <span class="users-admin-online"> </span> </a> </li>
    
        <li title="homepage"> <a href="<?php echo Config::REL_PATH."index"; ?>"> <i class="fa fa-fw fa-home"> </i> Home </a> </li>
    






        <!-- MESSAGES DROPDOWN -->
        <li class="dropdown" title="messages">
    
            <a style="color:red" href="#" class="dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-envelope"> </i> <b class="caret"> </b> </a>
            
            <ul class="dropdown-menu message-dropdown">
    
                <!-- MESSAGE EXAMPLE 01 -->
                <li class="message-preview">
                    <a href="#">
                        <div class="media">
    
                            <span class="pull-left"> <img class="media-object" src="http://placehold.it/50x50" alt=""> </span>
    
                            <div class="media-body">
    
                                <h5 class="media-heading"> <strong> John Smith </strong> </h5>
    
                                <p class="small text-muted"> <i class="fa fa-clock-o"> </i> Yesterday at 4:32 PM </p>
                                <p> Lorem ipsum dolor sit amet, consectetur... </p>
    
                            </div>
                        </div>
                    </a>
                </li>
    
                <li class="message-footer"> <a href="#"> Read All New Messages </a> </li>
    
            </ul>
        </li>
    
    






        <!-- ALERTS BELL DROPDOWN -->
        <li class="dropdown" title="alerts">
    
            <a style="color:red" href="#" class="dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-bell"> </i>  <b class="caret"> </b> </a>
            
            <ul class="dropdown-menu alert-dropdown">
    
                <li> <a href="#"> Alert Name <span class="label label-default"> Alert Badge </span> </a> </li>
    
                <li class="divider"> </li>
                <li> <a href="#"> View All </a> </li>
    
            </ul>
        </li>
    
    






        <!-- MENU PROFILE DROPDOWN -->
        <li class="dropdown" title="profile">
    
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i>
                <?php echo_admin_username(); ?>
            <b class="caret"></b></a>
            
            <ul class="dropdown-menu">
                
                <li> <a href="<?php echo Config::ADMIN_REL_PATH."profile"; ?>"> <i class="fa fa-fw fa-user"> </i> Profile </a> </li>
                <li> <a style="color:red"> <i class="fa fa-fw fa-envelope"> </i> Inbox </a> </li>
                <li> <a style="color:red"> <i class="fa fa-fw fa-gear"> </i> Settings </a> </li>
                <li class="divider"> </li>
                <li> <a href="<?php echo Config::REL_PATH."logout"; ?>"> <i class="fa fa-fw fa-power-off"> </i> Log Out </a> </li>
    
            </ul>
        </li>
        
    </ul>






















    <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
    <div class="collapse navbar-collapse navbar-ex1-collapse">

        <ul class="nav navbar-nav side-nav">

            <li> <a href="<?php echo Config::ADMIN_REL_PATH."index"; ?>"> <i class="fa fa-fw fa-dashboard"> </i> Dashboard </a> </li>

            <li>
                <a href="javascript:;" data-toggle="collapse" data-target="#posts"> <i class="fa fa-fw fa-arrows-v"> </i> Posts <i class="fa fa-fw fa-caret-down"> </i> </a>
                <ul id="posts" class="collapse">
                    <li> <a href="<?php echo Config::ADMIN_REL_PATH."posts"; ?>"> <i class="fa fa-fw fa-file-text"> </i> View All Posts </a> </li>
                    <li> <a href="<?php echo Config::ADMIN_REL_PATH."posts/add"; ?>"> <i class="fa fa-fw fa-plus"> </i> Add Posts </a> </li>
                </ul>
            </li>

            <li> <a href="<?php echo Config::ADMIN_REL_PATH."categories"; ?>"> <i class="fa fa-fw fa-tags"> </i> Categories </a> </li> 
            <li> <a href="<?php echo Config::ADMIN_REL_PATH."comments"; ?>"> <i class="fa fa-fw fa-comments"> </i> Comments </a> </li>
            
            <li>
                <a href="javascript:;" data-toggle="collapse" data-target="#users"> <i class="fa fa-fw fa-arrows-v"> </i> Users <i class="fa fa-fw fa-caret-down"> </i> </a>
                <ul id="users" class="collapse">
                    <li> <a href="<?php echo Config::ADMIN_REL_PATH."users"; ?>"> <i class="fa fa-fw fa-users"> </i> View All Users </a> </li>
                    <li> <a href="<?php echo Config::ADMIN_REL_PATH."users/1"; ?>"> <i class="fa fa-fw fa-user"> </i> Admin </a> </li>
                    <li> <a href="<?php echo Config::ADMIN_REL_PATH."users/2"; ?>"> <i class="fa fa-fw fa-user"> </i> Subscribers </a> </li>
                </ul>
            </li>

        </ul>

    </div>

    <!-- /.navbar-collapse -->
</nav>
