
<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
   
    <!-- Set of top navigation menus -->
    <?php include 'admin_dropdowns.php'; ?>

    <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
    <div class="collapse navbar-collapse navbar-ex1-collapse">

        <ul class="nav navbar-nav side-nav">

            <li> <a href="./index.php?page=dashboard"> <i class="fa fa-fw fa-dashboard"> </i> Dashboard </a> </li>

            <li>
                <a href="javascript:;" data-toggle="collapse" data-target="#posts"> <i class="fa fa-fw fa-arrows-v"> </i> Posts <i class="fa fa-fw fa-caret-down"> </i> </a>
                <ul id="posts" class="collapse">
                    <li> <a href="index.php?page=posts&source=default"> <i class="fa fa-fw fa-file-text"> </i> View All Posts </a> </li>
                    <li> <a href="index.php?page=posts&source=add_post"> <i class="fa fa-fw fa-plus"> </i> Add Posts </a> </li>
                </ul>
            </li>

            <li> <a href="index.php?page=categories"> <i class="fa fa-fw fa-tags"> </i> Categories </a> </li> 
            <li> <a href="index.php?page=comments"> <i class="fa fa-fw fa-comments"> </i> Comments </a> </li>
            
            <li>
                <a href="javascript:;" data-toggle="collapse" data-target="#users"> <i class="fa fa-fw fa-arrows-v"> </i> Users <i class="fa fa-fw fa-caret-down"> </i> </a>
                <ul id="users" class="collapse">
                    <li> <a href="./index.php?page=users&source=view_all"> <i class="fa fa-fw fa-users"> </i> View All Users </a> </li>
                    <li> <a href="./index.php?page=users&source=user_add"> <i class="fa fa-fw fa-plus"> </i> Add User </a> </li>
                </ul>
            </li>

            <li> <a href="./index.php?page=profile"> <i class="fa fa-fw fa-user"> </i> Profile </a> </li>

        </ul>

    </div>

    <!-- /.navbar-collapse -->
</nav>
