<?php

// // Advantage - With only one query it is possible to pull all infos needed to handle the page features;
// class SeachPage extends mysqli_stmt {
//     public $status_msg = null;
//     public $search_pattern, $pg, $limit;
//     public $total_posts, $total_pages;



//     public function __construct($search_pattern=NULL, $pg=1, $limit=5) {
//         $this->search_pattern = $search_pattern;
//         $this->pg = $pg;
//         $this->limit = $limit;

//         $start = ($pg * $limit) - $limit;

//         $this->stmt = Post::select_published_match_to_display($search_pattern, $start, $limit);
//         $this->total_posts = mysqli_stmt_num_rows($this->stmt);

//         if ($this->total_posts === 0) {
//             $this->status_msg = "<h2 class='text-center'> No results found for '{$search_pattern}' </h2>";
//         }
//     }


//     public function TEMP_CODES () {
//         mysqli_stmt_bind_result($stmt, $id, $title, $author_name, $date_time, $img, $content, $user_id);

//         while (mysqli_stmt_fetch($stmt)) {
//             display_post_html_preview($id, $title, $author_name, $date_time, $img, $content, $user_id);
//         }
//     }

//     public function create_search_pattern () {
//         Self::$search_pattern = (isset($_GET['pattern'])) ? InputHandler::escape($_GET['pattern']) : NULL;
//     }
// }

$search_pattern = (isset($_GET['pattern'])) ? InputHandler::escape($_GET['pattern']) : NULL;

// Page object instances
$pager = new PagerDisplayer(2, $search_pattern);



function post_search_results ($pg = 1, $limit = 5) {
    global $search_pattern;

    if (!$search_pattern)  {
        echo "<h2 class='text-center'>".PAGE_SEARCH_NO_POSTS."<i>'{$search_pattern}'</i> </h2>";
        return false;
    }

    if (isset($_GET['pg'])) $pg = InputHandler::escape($_GET['pg']);
    
    $start = ($pg * $limit) - $limit;

    $stmt = Post::select_published_match_to_display($search_pattern, $start, $limit);

    if (mysqli_stmt_num_rows($stmt) === 0) {
        echo "<h2 class='text-center'>".PAGE_SEARCH_NO_POSTS."<i>'{$search_pattern}'</i> </h2>";
        return false;
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

?>