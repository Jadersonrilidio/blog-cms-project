
<!-- Header Settings -->
<?php include 'includes/header.php'; ?>

<!-- PHP page function set -->
<?php include 'functions/f_category.php'; ?> 

<!-- Navigation Menu -->
<?php include 'includes/navigationbar.php'; ?>

<!-- Page Content -->
<div class="container">

    <div class="row">



        <!-- Blog Main Column -->
        <div class="col-md-8">
           
            <!-- Page Header -->
            <h1 class='page-header'> <?php display_category_title(); ?> </h1>
            
            <!-- Blog Posts -->
            <?php display_published_posts_by_category(); ?>

            <!-- Pager -->
            <?php $pager->display_pager(); ?> 

        </div>



        <!-- Blog Sidebar Widgets Column -->
        <?php include 'includes/sidebar.php'; ?>

    </div>

    <hr>

<!-- Footer -->
<?php include 'includes/footer.php'; ?>
