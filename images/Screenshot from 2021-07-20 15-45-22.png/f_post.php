
<?php

// Page variables //
$post_id = InputHandler::escape($_GET['post_id']);
$title = $datetime = $image = $content = $author_id = $author_name = NULL;

// Page post functions //

function get_post_attr_by_id_to_display () {
    global $post_id, $title, $datetime, $image, $content, $author_id, $author_name;
    
    $stmt = Post::select_by_id_to_display($post_id);
    mysqli_stmt_bind_result($stmt, $post_title, $post_datetime, $post_image, $post_content, $user_id, $user_name);
    mysqli_stmt_fetch($stmt);

    $title = $post_title;
    $datetime = $post_datetime;
    $image = $post_image;
    $content = $post_content;
    $author_id = $user_id;
    $author_name = $user_name;
}

// Page comment functions //

function create_comment () {
    global $post_id;

    if (!isset($_POST['create_comment'])) return false;
    if (!isset($_SESSION['user_id']) || empty($_POST['comment_content'])) return false;

    $comment_post_id = $post_id;
    $comment_content = InputHandler::escape($_POST['comment_content']);

    $comment_author = $_SESSION['user_id'];
    
    $stmt = Comment::create($comment_post_id, $comment_author, $comment_content);
    if ($stmt) {
        Notifications::set_toastr_session(Notifications::COMMENT_SENT);
        Permissions::redirect("post/{$post_id}");
        return true;
    } else {
        return false;
    }

}

function display_comments_by_post_id () {
    global $post_id;

    $stmt = Comment::select_approved_by_post_id($post_id);
    mysqli_stmt_bind_result($stmt, $id, $content, $datetime, $author_id, $author_name);

    while (mysqli_stmt_fetch($stmt)) {
        post_comment_html_display($content, $id, $datetime, $author_id, $author_name);
    }
}

function post_comment_html_display ($content, $id, $datetime, $author_id, $author_name) {
    ?>
        <div class="media">
            <a class="pull-left" href="#">
                <img class="media-object" src="http://placehold.it/64x64/000000/FFFFFF?text=User+Image">
            </a>
            
            <div class="media-body">

                <h4 class="media-heading">

                    <a href='<?php echo Config::REL_PATH."author/{$author_id}"; ?>'> 
                        <?php echo $author_name; ?> 
                    </a>

                    <small> <?php echo $datetime; ?> </small>

                </h4>

                <?php TextHandler::text_comment_shrink($content, 180, $id); ?>

            </div>
        </div>
    <?php
}

// Auxiliary and extra feature functions //

function set_comment_content () {
    if(!empty($_POST['comment_content'])) echo InputHandler::escape($_POST['comment_content']);
}

function admin_posts_btn () {
    if (Permissions::is_admin()) {
        echo "<a class='btn btn-success my-float-right' href='".Config::ADMIN_REL_PATH."posts'>".PAGE_POST_VIEW_ALL_POSTS."</a>";
        echo "<a class='btn btn-primary my-float-right' href='".Config::ADMIN_REL_PATH."posts/edit/{$_GET['post_id']}'>".PAGE_POST_EDIT_POST."</a>";
    }
}

function leave_comment_button () {
    if (Permissions::is_logged()) {
        echo "<button type='submit' class='btn btn-primary' name='create_comment'>".COMMENT_BTN."</button>";
    } else {
        echo "<a href='' class='btn btn-primary leave-comment' data-toggle='modal' data-target='#loginModal'>".COMMENT_BTN."</a>";
    }
}

?>