<?php $MSG_STATUS = create_comment(); ?>
<?php $post = get_post_by_id(); ?>


<!-- post tags -->
<p class='lead'> by <a href='index.php?page=author&author=<?php echo $post['post_author']; ?>'>
    <?php echo select_user_name_by_id($post['post_author']); ?> </a>
    <?php admin_posts_btn(); ?> 
</p>

<p>
    <span class='glyphicon glyphicon-time'> </span> Posted on <?php echo $post['post_date_time']; ?>
</p>

<hr>

<img class='img-responsive' src="./images/<?php echo $post['post_image']; ?>" alt=''>

<hr>

<p> <?php echo $post['post_content']; ?> </p>

<hr>
<!-- Post tags end -->


<!-- Comment form -->
<div class="well">
    <h4> Leave a comment </h4>
    
    <?php echo "<p class='my-status-msg-box'> <i>" . $MSG_STATUS . "</i> </p>"; ?>

    <form role="form" action="index.php?page=post&post_id=<?php echo $_GET['post_id']; ?>" method="POST">
        
        <div class="form-group">
            <label for="comment_author"> Author </label>
            <input class="form-control" type="text" name="comment_author">
        </div>

        <div class="form-group">
            <label for="comment_email"> Email </label>
            <input class="form-control" type="email" name="comment_email">
        </div>
        
        <div class="form-group">
            <label for="comment_content"> Comment </label>
            <textarea class="form-control" rows="3" name="comment_content"></textarea>
        </div>
        
        <button type="submit" class="btn btn-primary" name="create_comment"> Send </button>
    
    </form>
</div>
<!-- Comment form end -->


<!-- Posted Comments -->
<?php display_comments_by_post_id(); ?>





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
