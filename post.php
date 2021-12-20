
<!-- Header Settings -->
<?php include 'includes/header.php'; ?>

<!-- PHP page function set -->
<?php include 'includes/modals/modal_login.php'; ?> 
<?php include 'includes/modals/modal_registration.php'; ?> 
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
                    
                    <!-- <button type="submit" class="btn btn-primary" name="create_comment" onclick=""> Send </button> -->
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


 <!-- ####### DRAFT ######################################################### -->

    <!-- Comment -->
    <!-- <div class="media">
        <a class="pull-left" href="#">
            <img class="media-object" src="http://placehold.it/64x64" alt="">
        </a>
        <div class="media-body">
            <h4 class="media-heading">Start Bootstrap
                <small>August 25, 2014 at 9:30 PM</small>
            </h4>
            Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
        </div>
    </div>

<p> Comment </p>
    <div class="media">
        <a class="pull-left" href="#">
            <img class="media-object" src="http://placehold.it/64x64" alt="">
        </a>
        <div class="media-body">
            <h4 class="media-heading">Start Bootstrap
                <small>August 25, 2014 at 9:30 PM</small>
            </h4>
            Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
        <p> Nested Comment </p>
            <div class="media">
                <a class="pull-left" href="#">
                    <img class="media-object" src="http://placehold.it/64x64" alt="">
                </a>
                <div class="media-body">
                    <h4 class="media-heading">Nested Start Bootstrap
                        <small>August 25, 2014 at 9:30 PM</small>
                    </h4>
                    Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                </div>
            </div>
        <p> End Nested Comment </p>
        </div>
    </div> -->

 <!-- ####### END DRAFT ##################################################### -->