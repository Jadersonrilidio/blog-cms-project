
<?php 


$cat_id = (isset($_GET['cat_id'])) ? InputHandler::escape($_GET['cat_id']) : NULL;

$pager = new PagerDisplayer(4, $cat_id);


function display_category_title () {
    global $cat_id;
    $cat_title = Category::select_cat_title_by_id($cat_id);
    echo $cat_title;
}

function display_published_posts_by_category ($pg = 1, $limit = 5) { 
    global $cat_id;

    if (isset($_GET['pg'])) $pg = InputHandler::escape($_GET['pg']);
    
    $start = ($pg * $limit) - $limit;

    $stmt = Post::select_published_by_category_to_display($cat_id, $start, $limit);

    if (mysqli_stmt_num_rows($stmt) === 0) {
        echo "<h2 class='text-center'>".PAGE_CATEGORY_NO_POSTS."</h2>";
        return ''; 
    }

    mysqli_stmt_bind_result($stmt, $id, $post_category, $title, $author_name, $date_time, $img, $content, $tags, $post_status, $cat_id, $user_id, $post_status_id);

    while (mysqli_stmt_fetch($stmt)) {
        display_post_html_preview($id, $title, $author_name, $date_time, $img, $content, $user_id);
    }
}

function display_post_html_preview ($id, $title, $author_name, $date_time, $img, $content, $user_id) { 
    ?>
    <h2> <a href='<?php echo Config::REL_PATH."post/{$id}"; ?>'> <?php echo $title; ?> </a> </h2>

    <p class='lead'> <?php echo PAGE_POST_AUTHOR; ?> <a href='<?php echo Config::REL_PATH."author/{$user_id}"; ?>'> <?php echo $author_name; ?> </a> </p>

    <p>
        <span class='glyphicon glyphicon-time'> </span>
        <?php echo PAGE_POST_POSTED_ON; ?> <?php echo DateTimeFormater::display_post_datetime($date_time); ?>
    </p> <hr>

    <a href='<?php echo Config::REL_PATH."post/{$id}"; ?>'>
        <img class='img-responsive' src="<?php echo Config::REL_PATH."images/{$img}"; ?>">
    </a> <hr>

    <p style="text-align:justify"> <?php echo TextHandler::text_shrink($content, 400); ?> </p>

    <a class='btn btn-primary' href='<?php echo Config::REL_PATH."post/{$id}"; ?>'>
    <?php echo PAGE_READ_MORE_BTN; ?> <span class='glyphicon glyphicon-chevron-right'> </span>
    </a> <hr>
    <?php
}


?>