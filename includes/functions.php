
<?php

# ===================================================================================
# TODO - Category-related functions 

function cat_links ($cat_id=NULL) {
    $query = 'SELECT * FROM categories ';

    $stmt = MyDB::statement_handler($query);
    mysqli_stmt_bind_result($stmt, $id, $title);
    
    while (mysqli_stmt_fetch($stmt)) {
        echo (isset($cat_id) && $id == $cat_id)
            ? "<li class='active' > <a href='index.php?page=category&cat_id={$id}'>{$title}</a> </li>"
            : "<li> <a href='index.php?page=category&cat_id={$id}'>{$title}</a> </li>";
    }
}

function ACTUAL_display_categories_links () {
    $query = 'SELECT * FROM categories';
    $result = MyDB::query_handler($query, 'result');

    while ($register = mysqli_fetch_assoc($result)) {
        echo (isset($_GET['cat_id']) && $register['cat_id'] == $_GET['cat_id'])
            ? "<li class='active' > <a href='index.php?page=category&cat_id=" . $register['cat_id'] . "'>" . $register['cat_title'] . "</a> </li>"
            : "<li> <a href='index.php?page=category&cat_id=" . $register['cat_id'] . "'>" . $register['cat_title'] . "</a> </li>";
    }
}

function get_category_title_from_id () {
    if(!isset($_GET['cat_id'])) return '';
    $cat_id = $_GET['cat_id'];

    $query = "SELECT * FROM categories WHERE cat_id = $cat_id";
    $register = MyDB::query_handler($query, 'assoc_array');

    return $register['cat_title'];
}

# ===================================================================================
# TODO - Post-related functions 

function display_all_posts ($pg = 1, $limit = 5) { 
    $start = ($pg * $limit) - $limit;
    
    $query = "SELECT * FROM posts WHERE post_status_id = 1 ORDER BY post_date_time DESC LIMIT $start, $limit";
    $result = MyDB::query_handler($query, 'result');

    if (mysqli_num_rows($result) == 0) {
        echo "<h2 class='text-center'> No posts </h2>";
        return '';
    }

    while ($register = mysqli_fetch_assoc($result)) {
        ACTUAL_post_html_preview($register); // FIXME 
    }
}

//OPTIMIZE - testing
function display_posts_by_category ($post_category_id, $pg = 1, $limit = 5) { 
    global $connection; 

    $start = ($pg * $limit) - $limit;

    $query = " SELECT * FROM posts WHERE post_category_id = ? AND post_status_id = 1 LIMIT $start, $limit ";
    $stmt = mysqli_prepare($connection, $query);

    mysqli_stmt_bind_param($stmt, 'i', $post_category_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    mysqli_stmt_bind_result($stmt, $post_id, $post_category_id, $post_title, $post_author, $post_date_time, $post_image, $post_content, $post_tags, $post_status_id);

    if (mysqli_stmt_num_rows($stmt) == 0) {
        echo "<h2 class='text-center'> No posts on this category </h2>";
        return ''; 
    }

    while (mysqli_stmt_fetch($stmt)) {
        post_html_preview($post_id, $post_title, $post_author, $post_date_time, $post_image, $post_content);
    }
}

function ACTUAL_display_posts_by_category ($pg = 1, $limit = 5) {  // FIXME 
    $start = ($pg * $limit) - $limit;

    if (!isset($_GET['cat_id'])) return "";
    $cat_id = $_GET['cat_id'];

    $query = "SELECT * FROM posts WHERE post_category_id = $cat_id AND post_status_id = 1 LIMIT $start, $limit";
    $result = MyDB::query_handler($query, 'result');

    if (mysqli_num_rows($result) == 0) {
        echo "<h2 class='text-center'> No posts on this category </h2>";
        return '';
    }

    while ($register = mysqli_fetch_assoc($result)) {
        ACTUAL_post_html_preview($register); // FIXME 
    }
}

function display_posts_by_author ($pg = 1, $limit = 5) { 
    $start = ($pg * $limit) - $limit;

    if (!isset($_GET['author'])) return "";
    $author = $_GET['author'];

    $query = "SELECT * FROM posts WHERE post_author = $author AND post_status_id = 1 LIMIT $start, $limit";
    $result = MyDB::query_handler($query, 'result');

    if (mysqli_num_rows($result) == 0) {
        echo "<h2 class='text-center'> No posts from this author </h2>";
        return '';
    }

    while ($register = mysqli_fetch_assoc($result)) {
        ACTUAL_post_html_preview($register); // FIXME 
    }
}

function post_search_results ($pg = 1, $limit = 5) { 
    $start = ($pg * $limit) - $limit;

    $search_pattern = $_GET['pattern'];

    $query = "SELECT * FROM posts WHERE post_tags LIKE '%$search_pattern%' AND post_status_id = 1 LIMIT $start, $limit";
    $result = MyDB::query_handler($query, 'result');

    if (mysqli_num_rows($result) == 0) return "<h2 class='text-center'> No results found for '{$search_pattern}'  </h2>";

    while ($match = mysqli_fetch_assoc($result)) {
        ACTUAL_post_html_preview($match); // FIXME 
    }
    
}

function get_post_by_id () {
    $post_id = $_GET['post_id'];

    $query = "SELECT * FROM posts WHERE post_id = $post_id";
    $register = MyDB::query_handler($query, 'assoc_array');
    return $register;
}

function get_post_title_from_id () {
    $register = get_post_by_id();
    return $register['post_title'];
}

function get_total_pages ($limit = 5) { 
    $total_posts = post_counter();
    return ceil($total_posts / $limit);
}

function display_pages_link ($limit = 5) {
    $total_pg = get_total_pages($limit);
    for ($i=1; $i<=$total_pg; $i++) {
        if (isset($_GET['page'])) {
            switch ($_GET['page']) {
                case 'search':
                    echo (isset($_GET['pg']) && $i == $_GET['pg'])
                        ? "<li> <a class='active_link' href='index.php?page={$_GET['page']}&pattern={$_GET['pattern']}&pg=$i'> $i </a> </li>"
                        : "<li> <a href='index.php?page={$_GET['page']}&pattern={$_GET['pattern']}&pg=$i'> $i </a> </li>";
                    break;
                case 'category':
                    echo (isset($_GET['pg']) && $i == $_GET['pg'])
                        ? "<li> <a class='active_link' href='index.php?page={$_GET['page']}&cat_id={$_GET['cat_id']}&pg=$i'> $i </a> </li>"
                        : "<li> <a href='index.php?page={$_GET['page']}&cat_id={$_GET['cat_id']}&pg=$i'> $i </a> </li>";
                    break;
                case 'author':
                    echo (isset($_GET['pg']) && $i == $_GET['pg'])
                        ? "<li> <a class='active_link' href='index.php?page={$_GET['page']}&author={$_GET['author']}&pg=$i'> $i </a> </li>"
                        : "<li> <a href='index.php?page={$_GET['page']}&author={$_GET['author']}&pg=$i'> $i </a> </li>";
                    break;
                default:
                    echo (isset($_GET['pg']) && $i == $_GET['pg'])
                        ? "<li> <a class='active_link' href='index.php?page={$_GET['page']}&pg=$i'> $i </a> </li>"
                        : "<li> <a href='index.php?page={$_GET['page']}&pg=$i'> $i </a> </li>";
                    break;
            }
        } else {
            echo (isset($_GET['pg']) && $i == $_GET['pg'])
                ? "<li> <a class='active_link' href='index.php?page=default&pg=$i'> $i </a> </li>"
                : "<li> <a href='index.php?page=default&pg=$i'> $i </a> </li>";
        }
    }
}

function get_previous_page () {
    $pg = 1;
    if(isset($_GET['pg']) && $_GET['pg'] >= 2) $pg = $_GET['pg'] - 1;

    if (isset($_GET['page'])) {
        switch ($_GET['page']) {
            case 'search':
                echo "index.php?page={$_GET['page']}&pattern={$_GET['pattern']}&pg=$pg";
                break;
            case 'category':
                echo "index.php?page={$_GET['page']}&cat_id={$_GET['cat_id']}&pg=$pg";
                break;
            case 'author':
                echo "index.php?page={$_GET['page']}&author={$_GET['author']}&pg=$pg";
                break;
            default:
                echo "index.php?page={$_GET['page']}&pg=$pg";
                break;
        }
    } else {
        echo "index.php?page=default&pg=$pg";
    }
}

function get_next_page () { 
    $pg = 2;
    if ($pg > get_total_pages()) $pg = get_total_pages();
    if (isset($_GET['pg'])) $pg = $_GET['pg'] + 1;
    if (isset($_GET['pg']) && $_GET['pg'] == get_total_pages()) $pg = $_GET['pg']; 

    if (isset($_GET['page'])) {
        switch ($_GET['page']) {
            case 'search':
                echo "index.php?page={$_GET['page']}&pattern={$_GET['pattern']}&pg=$pg";
                break;
            case 'category':
                echo "index.php?page={$_GET['page']}&cat_id={$_GET['cat_id']}&pg=$pg";
                break;
            case 'author':
                echo "index.php?page={$_GET['page']}&author={$_GET['author']}&pg=$pg";
                break;
            default:
                echo "index.php?page={$_GET['page']}&pg=$pg";
                break;
        }
    } else {
        echo "index.php?page=default&pg=$pg";
    }
}

function post_counter () { 

    if(isset($_GET['page'])) {
        switch ($_GET['page']) {
            case 'category':
                return posts_count_by_category();
                break;
            case 'search':
                return posts_count_by_search();
                break;
            case 'author':
                return posts_count_by_author();
                break;
            default:
                return posts_count_total();
                break;
        }
    } else {
        return posts_count_total();
    }
}

function posts_count_total () {
    $query = "SELECT * FROM posts WHERE post_status_id = 1";
    $result = MyDB::query_handler($query, 'result');
    return mysqli_num_rows($result);
}

function posts_count_by_category () {
    $cat_id = $_GET['cat_id'];
    $query = "SELECT * FROM posts WHERE post_category_id = $cat_id AND post_status_id = 1 ";
    $result = MyDB::query_handler($query, 'result');
    return mysqli_num_rows($result);
}

function posts_count_by_search () {
    $search_pattern = $_GET['pattern'];
    $query = "SELECT * FROM posts WHERE post_tags LIKE '%$search_pattern%' AND post_status_id = 1 ";
    $result = MyDB::query_handler($query, 'result');
    return mysqli_num_rows($result);
}

function posts_count_by_author () {
    $author = $_GET['author'];
    $query = "SELECT * FROM posts WHERE  post_author = $author AND post_status_id = 1 ";
    $result = MyDB::query_handler($query, 'result');
    return mysqli_num_rows($result);
}

# ===================================================================================
# TODO - comment functions 

function display_comments_by_post_id () {
    $post_id = $_GET['post_id'];

    $query = "SELECT * FROM comments WHERE comment_post_id = $post_id AND comment_status_id = 1 ORDER BY comment_date_time DESC ";
    $result = MyDB::query_handler($query, 'result');

    while ($register = mysqli_fetch_assoc($result)) {
        comment_html($register);
    }
}

function create_comment () {
    if (!isset($_POST['create_comment'])) return "";

    if (empty($_POST['comment_author'])) return "Must insert author...";
    if (empty($_POST['comment_email'])) return "Must insert email...";
    if (empty($_POST['comment_content'])) return "Must insert content...";

    $comment_author = $_POST['comment_author'];
    $comment_email = $_POST['comment_email'];
    $comment_content = $_POST['comment_content'];
    $comment_post_id = $_GET['post_id'];
    
    $query = "INSERT INTO comments(comment_post_id,comment_author,comment_email,comment_content) ";
    $query .= "VALUES($comment_post_id,'$comment_author','$comment_email','$comment_content')";
    MyDB::query_handler($query, 'result');

    return "Comment created!";
}

# ===================================================================================
# TODO - login functions 

function user_login_verification () {
    if (!isset($_POST['user_login'])) return '';
    if (empty($_POST['user_name'])) return 'Insert username';
    if (empty($_POST['user_password'])) return 'Insert password';

    $user_name = escape($_POST['user_name']);
    $user_password = escape($_POST['user_password']);

    $query = "SELECT * FROM users WHERE user_name = '$user_name' ";
    $result = MyDB::query_handler($query, 'result');

    while ($register = mysqli_fetch_assoc($result)) {
        if (password_verify($user_password, $register['user_password'])) {
            login_session_handler ($register['user_id']);
        }
    }
    return 'Incorrect username or password...';
}

function login_session_handler ($user_id) {
    $query = "SELECT * FROM users WHERE user_id = $user_id";
    $register = MyDB::query_handler($query, 'assoc_array');

    set_session_user_variables($register);

    ($_SESSION['user_role_id'] == 1)
        ? header ('Location: ./admin/index.php')
        : header ('Location: index');
}

function select_user_name_by_id ($user_id) {
    $query = "SELECT * FROM users WHERE user_id = $user_id";
    $register = MyDB::query_handler($query, 'assoc_array');
    return $register['user_name'];
}

function username_exists($username) {
    $query = "SELECT user_name FROM users WHERE user_name = '$username'";
    $num_rows = MyDB::query_handler($query, 'num_rows');
    return ($num_rows == 0) ? false : true;
}

function email_exists($email) {
    $query = "SELECT user_email FROM users WHERE user_email = '$email' ";
    $num_rows = MyDB::query_handler($query, 'num_rows');
    return ($num_rows == 0) ? false : true;
}

function forgot_password_mail () {
    if (!isset($_POST['send_email'])) return '';
    if (empty($_POST['user_email'])) return 'Must insert email...';
    if (!email_exists($_POST['user_email'])) return 'Invalid email...';

    $email = $_POST['user_email'];
    $length = 50; //FIXME
    $token = bin2hex(openssl_random_pseudo_bytes($length)); //FIXME

    $query = "UPDATE users SET user_token = ? WHERE user_email = ? ";
    $stmt = MyDB::statement_handler($query, 'ss', $token, $email);
    mysqli_stmt_close($stmt);   

    $from = 'mail@mail.com';
    $to = $email;
    $subject = 'testing';
    $body = "<p> Please click on the link below to reset your password: </p> <br>
        <a href='http://localhost/myphp/my-course-php/projectCMS/reset_password?email={$email}&token={$token}'> 
        http://localhost/myphp/my-course-php/projectCMS/reset_password?email={$email}&token={$token} </a> ";

    return send_email_test($from, $to, $subject, $body,) ? 'email sent' : 'error...';
}

function reset_password () {
    //TODO
    if (!isset($_POST['reset_password']) || !isset($_GET['email']) || !isset($_GET['token'])) return '';
    if (empty($_POST['user_password'])) return 'Must insert password';
    if (empty($_POST['repeat_password'])) return 'Must repeat password';
    if ($_POST['user_password'] != $_POST['repeat_password']) return 'Passwords do not match';

    $password = password_handle($_POST['user_password']);
    $email = escape($_GET['email']);

    $query = "UPDATE users SET user_token = null, user_password = ? WHERE user_email = ? ";
    $stmt = MyDB::statement_handler($query, 'ss', $password, $email);

    if (mysqli_stmt_affected_rows($stmt) > 0) return "password changed!";
    return "errors...BAD QUERY"; 
}

# ===================================================================================
# TODO - Registration functions 

function register_new_user () {
    if (!isset($_POST['user_register'])) return '';

    if (empty($_POST['user_name'])) return 'Must insert username...';
    if (username_exists($_POST['user_name'])) return 'Username already exists...';
    if (empty($_POST['user_email'])) return 'Must insert email...';
    if (email_exists($_POST['user_email'])) return 'Email already exists...';
    if (empty($_POST['user_password'])) return 'Must insert password...';
    if (empty($_POST['repeat_password'])) return 'Must repeat password...';
    if ($_POST['user_password'] !== $_POST['repeat_password']) return 'Passwords not matching';

    $user_name = escape($_POST['user_name']);
    $user_email = escape($_POST['user_email']);
    $user_password = password_handle($_POST['user_password']);

    $query = "INSERT INTO users(user_name,user_password,user_email) VALUES('$user_name','$user_password','$user_email') ";
    MyDB::query_handler($query);

    $user_id = get_new_user_by_id();
    set_session_user_variables($user_id);

    redirect('./index.php');
}

function get_new_user_by_id () {
    global $connection;
    $user_id = mysqli_insert_id($connection);

    $query = "SELECT * FROM users WHERE user_id = $user_id";
    $register = MyDB::query_handler($query, 'assoc_array');
    return $register;
}

# ===================================================================================
# TODO - Session functions 

function set_session_user_variables ($user) {
    $_SESSION['user_id'] = $user['user_id'];
    $_SESSION['user_name'] = $user['user_name'];
    $_SESSION['user_firstname'] = $user['user_firstname'];
    $_SESSION['user_lastname'] = $user['user_lastname'];
    $_SESSION['user_role_id'] = $user['user_role_id'];
    $_SESSION['user_email'] = $user['user_email'];
}

function session_admin_logout () {
    unset($_SESSION['user_id']);
    unset($_SESSION['user_name']);
    unset($_SESSION['user_firstname']);
    unset($_SESSION['user_lastname']);
    unset($_SESSION['user_role']);
    unset($_SESSION['user_email']);
}

function send_email () {
    if (!isset($_POST['submit'])) return '';

    $to = 'jadersonrilidio@gmail.com';
    $subject = wordwrap($_POST['subject'], 70, "\n", true);
    $message = $_POST['message'];
    $from = "From: " . $_POST['email'];

    mail($to, $subject, $message, $from);
    return "Email sent";
}

function admin_posts_btn () {
    if (is_admin()) {
        echo "<a class='btn btn-success my-float-right' href='./admin/index.php?page=posts&source=default'> View all posts </a>";
        echo "<a class='btn btn-primary my-float-right' href='./admin/index.php?page=posts&source=edit_post&post_id={$_GET['post_id']}'> Edit post </a>";
    }
}

# ===================================================================================
# TODO - HTML-embeed functions 

function post_html_preview ($post_id, $post_title, $post_author, $post_date_time, $post_image, $post_content) {
    ?>
    <h2> <a href='index.php?page=post&post_id=<?php echo $post_id; ?>'> <?php echo $post_title; ?> </a> </h2>

    <p class='lead'> by <a href='index.php?page=author&author=<?php echo $post_author; ?>'>
        <?php echo select_user_name_by_id($post_author); ?>
    </a> </p>

    <p>
        <span class='glyphicon glyphicon-time'> </span>
        Posted on <?php echo $post_date_time; ?>, &emsp;
         <small style="color:gray"> last updated: <?php echo '1111-11-11 11:11:11'; #OPTIMIZE - include last update date/time on all posts automatically ?> </small>
    </p>

    <hr>

    <a href='index.php?page=post&post_id=<?php echo $post_id; ?>'>
        <img class='img-responsive' src="./images/<?php echo $post_image; ?>">
    </a>

    <hr>

    <p> <?php echo $post_content; ?> </p>

    <a class='btn btn-primary' href='index.php?page=post&post_id=<?php echo $post_id; ?>'>
        Read More <span class='glyphicon glyphicon-chevron-right'> </span>
    </a>

    <hr>
    <?php
}


function ACTUAL_post_html_preview ($post) { // FIXME 
    ?>
    <h2> <a href='index.php?page=post&post_id=<?php echo $post['post_id']; ?>'> <?php echo $post['post_title']; ?> </a> </h2>

    <p class='lead'> by <a href='index.php?page=author&author=<?php echo $post['post_author']; ?>'>
        <?php echo select_user_name_by_id($post['post_author']); ?>
    </a> </p>

    <p>
        <span class='glyphicon glyphicon-time'> </span>
        Posted on <?php echo $post['post_date_time']; ?>, &emsp;
         <small style="color:gray"> last updated: <?php echo '1111-11-11 11:11:11'; #OPTIMIZE - include last update date/time on all posts automatically ?> </small>
    </p>

    <hr>

    <a href='index.php?page=post&post_id=<?php echo $post['post_id']; ?>'>
        <img class='img-responsive' src="./images/<?php echo $post['post_image']; ?>">
    </a>

    <hr>

    <p> <?php echo $post['post_content']; ?> </p>

    <a class='btn btn-primary' href='index.php?page=post&post_id=<?php echo $post['post_id']; ?>'>
        Read More <span class='glyphicon glyphicon-chevron-right'> </span>
    </a>

    <hr>
    <?php
}

function comment_html ($comment) {
    ?>
    <div class="media">
    
        <a class="pull-left" href="#">
            <img class="media-object" src="http://placehold.it/64x64/000000/FFFFFF?text=User+Image">
        </a>
        
        <div class="media-body">
            <h4 class="media-heading">
                <?php echo $comment['comment_author']; ?> 
                <small>
                    <?php echo (string) $comment['comment_date_time']; ?>
                </small>
            </h4>

            <p>
                <?php echo $comment['comment_content']; ?>
            </p>
        </div>

    </div>
    <?php
}

function greeting_logged_user () { 
    if (isset($_SESSION['user_name'])) {
        echo "<li> <a>";
        echo "<b> Welcome back, " .  $_SESSION['user_name'] . "! </b>";
        echo "</a> </li>";
    }
}

function display_navigation_bar () {
    if (is_admin()) {
        greeting_logged_user();
        ?>
        <li> <a href='#'> &emsp; </a> </li>
        <li class='awaitContact'> <a href='contact'> Contact </a> </li>
        <li> <a href='./admin/index.php'> Admin </a> </li>
        <li> <a href='./index.php?page=logout'> Logout </a> </li>
        <li> <a href='#'> Profile </a> </li>
        <?php
    } else if (is_logged()) {
        greeting_logged_user();
        ?>
        <li> <a href='#'> &emsp; </a> </li>
        <li class='awaitContact'> <a href='contact'> Contact </a> </li>
        <li> <a href='./index.php?page=logout'> Logout </a> </li>
        <li> <a href='#'> Profile </a> </li>
        <?php
    } else {
        ?>
        <li class='awaitContact'> <a href='contact'> Contact </a> </li>
        <li class='awaitLogin'> <a href='./login'> Login </a> </li>
        <li class='awaitRegister ml-auto'> <a href='./registration'> Register </a> </li>
        <?php
    } 
}

function dislplay_pager () {
    $num_rows = post_counter();
    if ($num_rows == 0) {
        ?>
        <ul class="pager">
            <li class="previous"> <a href="#" onClick="history.go(-1);"> &crarr; Return </a> </li> 
        </ul>
        <?php
        return '';
    }

    if (isset($_GET['page']) && $_GET['page'] == 'post') {
        ?>
        <ul class="pager">
            <li class="previous"> <a href="#" onClick="history.go(-1);"> &crarr; Return </a> </li> 
        </ul>
        <?php
    } else {
        ?>
        <ul class="pager">
            <li class="previous"> <a href="<?php get_previous_page(); ?>"> &larr; Previous </a> </li>
            <?php display_pages_link() ; ?>
            <li class="next"> <a href="<?php get_next_page(); ?>"> Next &rarr; </a> </li>
        </ul>
        <?php
    }
}

# ===================================================================================
# TODO - switcher functions 

function page_switcher () {
    if (isset($_GET['page'])) {        
        switch ($_GET['page']) {
            case 'search':
                isset($_GET['pg'])
                    ? $status = post_search_results($_GET['pg'])
                    : $status = post_search_results();
                if (!empty($status)) echo $status;
                break;
            case 'category':
                isset($_GET['pg'])
                    ? display_posts_by_category($_GET['cat_id'], $_GET['pg'])
                    : display_posts_by_category($_GET['cat_id']);
                break;
            case 'post': 
                include "./includes/post.php";
                break;
            case 'author':
                isset($_GET['pg'])
                    ? display_posts_by_author($_GET['pg'])
                    : display_posts_by_author();
                break;
            case 'logout':
                session_admin_logout();
                header('Location: ./index.php');
                break;
            default:
                isset($_GET['pg'])
                    ? display_all_posts($_GET['pg'])
                    : display_all_posts();
                break;
        }
    } else {
        isset($_GET['pg'])
            ? display_all_posts($_GET['pg'])
            : display_all_posts();
    }
}

function heading_title_switcher () {
    if (isset($_GET['page'])) {        
        switch ($_GET['page']) {
            case 'search':
                echo "<h1 class='page-header'> Search <small> results for '" . $_GET['pattern'] . "' </small> </h1>";
                break;
            case 'category':
                echo "<h1 class='page-header'> " . get_category_title_from_id() . "</h1>";
                break;
            case 'post':
                echo "<h1 class='page-header'>" . get_post_title_from_id() . "</h1>";
                break;
            case 'author':
                echo "<h1 class='page-header'>" . select_user_name_by_id($_GET['author']) . "'s posts </h1>";
                break;
        }
    } else {
        echo "<h1 class='page-header'> Most Recent posts </h1>";
    }
}

# ===================================================================================================
#TODO - language functions 

function set_lang () {
    if (isset($_GET['lang'])) {
        $lang = escape($_GET['lang']);

        if (isset($_SESSION['lang']) && $_SESSION['lang'] != $_GET['lang']) {
            $_SESSION['lang'] = $lang;
            echo "<script type='text/javascript'> location.reload(); </script>";
        }
        $_SESSION['lang'] = $lang;
    }
}

function include_lang_file () {
    include isset($_SESSION['lang'])
        ? "./includes/languages/{$_SESSION['lang']}.php"
        : "./includes/languages/en.php";
}

function select_lang ($lang) {
    if (isset($_SESSION['lang']) && $_SESSION['lang'] == $lang) echo "selected";
}

# ===================================================================================================
#TODO - random functions 

function escape ($input) {
    global $connection;
    return mysqli_real_escape_string($connection, trim(strip_tags($input)));
}

function password_handle ($password, $cost=12) {
    $password = escape($password);
    $password = password_hash($password, PASSWORD_BCRYPT, array('cost' => $cost));
    return $password;
}

function is_logged () {
    return (isset($_SESSION['user_id'])) ? true : false;
}

function is_admin () {
    return (isset($_SESSION['user_id']) && $_SESSION['user_role_id'] == 1) ? true : false;
}

function is_method ($method=NULL) {
    return ($_SERVER['REQUEST_METHOD'] == strtoupper($method)) ? true : false;
}

function redirect ($location) {
    header("Location: " . $location);
}

function redirect_logged ($location) {
    if (is_logged()) redirect($location);
}

function redirect_not_allowed ($location) {
    !isset($_GET['forgot']) ? redirect($location) : '';
}

function redirect_not_valid_token ($location) {
    if (!isset($_GET['email']) || !isset($_GET['token'])) redirect($location);

    $email = escape($_GET['email']);
    $token = escape($_GET['token']);

    $query = "SELECT user_token FROM users WHERE user_email = ? ";
    $stmt = MyDB::statement_handler($query, 's', $email);
    mysqli_stmt_bind_result($stmt, $user_token);
    mysqli_stmt_fetch($stmt);

    if ($token != $user_token) redirect($location);
    
    mysqli_stmt_close($stmt);
}


?>