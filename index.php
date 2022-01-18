<?php include './includes/header.php'; ?>

<!-- PHP page function set -->
<?php include './functions/f_index.php'; ?>

<?php 
    if (!isset($_SESSION['welcome_modal'])) {
        $_SESSION['welcome_modal'] = true;
        include 'includes/modals/modal_welcome_session.php';
    } 
?>

<!-- Navigation Menu -->
<?php include './includes/navigationbar.php'; ?>

<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Main Column -->
        <div class="col-md-8">
            
            <?php RedLink::github_repo_link(); ?>
           
            <!-- Page Header -->
            <h1 class='page-header'> <?php echo PAGE_HEADER; ?> </h1>
            
            <!-- Blog Posts -->
            <?php display_published_posts(); ?>

            <!-- Pager -->
            <?php $pager->display_pager(); ?>
            <?php RedLink::github_PagerDisplayer_link(); ?>

        </div>

        <!-- Blog Sidebar Widgets Column -->
        <?php include './includes/sidebar.php'; ?>

    </div>

    <hr>

<!-- Footer -->
<?php include './includes/footer.php'; ?>

<script> 
    $(window).on('load', function() {
        $('#welcomeSessionModal').modal('show');
    });
</script>