
<?php

// Pager object instance
$pager = new PagerDisplayer(1);



function display_published_posts ($limit = 5) {
    $pg = (isset($_GET['pg'])) ? InputHandler::escape($_GET['pg']) : 1;
    $start = ($pg * $limit) - $limit;
    $stmt = Post::select_published_to_display($start, $limit); 
    if (mysqli_stmt_num_rows($stmt) === 0) {
        echo "<h2 class='text-center'>".PAGE_NO_POSTS."</h2>";
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
        <?php echo PAGE_POST_POSTED_ON; ?> <?php echo $date_time; ?>, &emsp;
        <small style="color:gray"> <?php echo PAGE_POST_LAST_UPDATE; ?> 1111-11-11 11:11:11 </small>
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

// function _TEST_2_post_html_preview ($id, $title, $author_name, $date_time, $img, $content, $user_id) { 
//     echo "<h2> <a href='post?post_id={$id}'>{$title}</a> </h2>";
//     echo "<p class='lead'> by <a href='author?author={$user_id}'>{$author_name}</a> </p>";
//     echo "<p> <span class='glyphicon glyphicon-time'> </span> Posted on {$date_time}, &emsp; <small style='color:gray'> last updated: 1111-11-11 11:11:11 </small> </p> <hr>";
//     echo "<a href='post?post_id={$id}'> <img class='img-responsive' src='./images/{$img}'> </a> <hr>";
//     echo "<p>{$content}</p>";
//     echo "<a class='btn btn-primary' href='post?post_id={$id}'> Read More <span class='glyphicon glyphicon-chevron-right'> </span> </a> <hr>";
// }

// function display_all_posts ($pg = 1, $limit = 5) {
//     $start = ($pg * $limit) - $limit;
    
//     $query = "SELECT * FROM posts WHERE post_status_id = 1 ORDER BY post_date_time DESC LIMIT $start, $limit";
//     $result = MyDB::query_handler($query, 'result');

//     if (mysqli_num_rows($result) == 0) {
//         echo "<h2 class='text-center'> No posts </h2>";
//         return '';
//     }

//     while ($register = mysqli_fetch_assoc($result)) {
//         post_html_preview($register);
//     }
// }

// function index_total_pages ($limit = 5) { 
//     $total_posts = posts_count_total();
//     return ceil($total_posts / $limit);
// }

// function posts_count_total () {
//     $query = "SELECT * FROM posts WHERE post_status_id = 1";
//     $num_rows = MyDB::query_handler($query, 'num_rows');
//     return $num_rows;
// }

?>