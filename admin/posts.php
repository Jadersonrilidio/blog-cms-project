<?php include 'includes/admin_header.php'; ?>

<!-- Navigation -->
<?php include 'includes/admin_navigationbar.php'; ?>

<!-- Page Function Set -->
<?php include 'functions/f_posts.php'; ?>
<?php include 'includes/modals/modal_delete_post.php'; ?>

    <div id="wrapper">

        <!-- Page Heading -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        
                        <h1 class="page-header"> <?php echo post_page_title(); ?> <small> &ensp; Admin <?php echo_admin_username(); ?> </small> </h1>
                        
                        <div class="well col-xs-12">

                            <?php posts_page_includes(); ?>

                        </div>

                        <br>
                        <ol class="breadcrumb">
                            <li> <i class="fa fa-dashboard"> </i>  <a href="<?php echo Config::ADMIN_REL_PATH."index"; ?>"> Dashboard </a> </li>   
                        </ol>

                    </div>
                </div>
            </div>
        </div>
        <!-- End Page Heading -->

    </div>

<!-- Footer -->
<?php include 'includes/admin_footer.php'; ?>
