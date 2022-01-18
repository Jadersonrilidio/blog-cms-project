<?php include 'includes/header.php'; ?>

<!-- PHP page function set -->
<?php include 'includes/modals/modal_redirect.php'; ?> 
<?php include 'functions/f_post.php'; ?> 

<!-- PHP functions -->
<?php get_post_attr_by_id_to_display(); ?>
<?php create_comment(); ?>

<!-- Navigation Menu -->
<?php include 'includes/navigationbar.php'; ?>

<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Main Column -->
        <div class="col-md-8">
           
            <!-- Page Header -->
            <h1 class='page-header'> <?php echo $title; ?> </h1>
            
            <!-- Blog Post -->
            <p class='lead'> <?php echo PAGE_POST_AUTHOR; ?> <a href='<?php echo Config::REL_PATH."author/{$author_id}"; ?>'>
                <?php echo $author_name; ?> </a>
                <?php admin_posts_btn(); ?> 
            </p>

            <p> <span class='glyphicon glyphicon-time'> </span> <?php echo PAGE_POST_POSTED_ON.$datetime; ?> </p> <hr>

            <img class='img-responsive' src="<?php echo Config::REL_PATH."images/{$image}"; ?>"> <hr>

            <p> <?php echo $content; ?> </p> <hr>
            <!-- Blog Post end -->




            <!-- Comment form -->
            <div class="well">
                <h4> <?php echo COMMENT_TITLE; ?> </h4>
                
                <form role="form" action="<?php echo Config::REL_PATH."post/{$post_id}"; ?>" method="POST">
                    
                    <?php FormErrorMsg::comment_has_message(); ?>

                    <div class="form-group">
                        <label for="comment_content"> <?php echo COMMENT_CONTENT_LABEL; ?> </label>
                        <textarea class="form-control" rows="3" name="comment_content"><?php set_comment_content(); ?></textarea>
                    </div>
                    
                    <?php leave_comment_button(); ?>

                </form>
            </div>
            <!-- Comment form end -->




            <!-- Posted Comments -->
            <?php display_comments_by_post_id(); ?>


            

            <!-- Pager -->
            <ul class="pager">
                <li class="previous"> <a href="#" onClick="history.go(-1);"> &crarr; <?php echo PAGER_RETURN; ?> </a> </li> 
            </ul>

        </div>


        <!-- Blog Sidebar Widgets Column -->
        <?php include 'includes/sidebar.php'; ?>

    </div>

    <hr>

<!-- Footer -->
<?php include 'includes/footer.php'; ?>
