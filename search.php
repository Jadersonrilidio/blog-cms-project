
<!-- Header Settings -->
<?php include 'includes/header.php'; ?>

<!-- PHP page function set -->
<?php include 'functions/f_search.php'; ?> 

<!-- Navigation Menu -->
<?php include 'includes/navigationbar.php'; ?>

<!-- Page Content -->
<div class="container">

    <div class="row">



        <!-- Blog Main Column -->
        <div class="col-md-8">
           
            <!-- Page Header -->
            <h1 class='page-header'> <?php echo PAGE_SEARCH_TITLE; ?> <i>'<?php echo $search_pattern; ?>'</i> </h1>
            
            <!-- Blog Posts -->
            <?php post_search_results(); ?>

            <!-- Pager -->
            <?php $pager->display_pager(); ?> 

        </div>



        <!-- Blog Sidebar Widgets Column -->
        <?php include 'includes/sidebar.php'; ?>

    </div>

    <hr>

<!-- Footer -->
<?php include 'includes/footer.php'; ?>
