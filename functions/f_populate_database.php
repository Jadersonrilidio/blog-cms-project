<?php

// TODO - populate-related constants

const BASE_POST_CONTENT = "
<h2 style='text-align:center'> Important!! </h2>
<br>
<p style='text-align:justify'> 
    Go to the page <strong> populate_database </strong> to create site content
    <a href='https://www.jadersonrodrigues.com/populate_database'> https://www.jadersonrodrigues.com/populate_database</a>. 
    On the same page you can also reset the site to default by clicking on the button <strong>Reset Database to Default</strong>.
</p>
<br>
<p style='text-align:justify'> 
    Along the site will be found 
    <a class='btn my-github-btn' href='#'>
        Red link buttons 
    </a>
    , which were inserted to provide features' further information. 
</p>
<br>
<p>
    In order to access the CMS system, login with the account:
    <p style='text-align:center'> 
        <strong> username: </strong> &emsp; admin <br> 
        <strong> password: </strong> &emsp; admin123 
    </p>
</p>
<br>

<hr>
<h2 style='text-align:center'> About the Project </h2>
<br>
<p style='text-align:justify'> &emsp;&emsp; The project is a simple blog where users can view the posts and leave comments, since they were registered. Also counts with a self-developed CMS system for priviledged users (so-called admin) to manage posts, categories, comments and users attributes. Also some features were implemented, as write bellow: </p>
<p> &emsp;&emsp; <b>-&gt</b> Search box, where the search is performed according to the posts' tags; </p>
<p> &emsp;&emsp; <b>-&gt</b> Notification boxes for actions and events </p>
<p> &emsp;&emsp; <b>-&gt</b> Select Language feature for all blog pages (CMS system and populate_database-related content are english only) </p>
<p> &emsp;&emsp; <b>-&gt</b> User profile editor and mail directed forgot password request; </p>
<p> &emsp;&emsp; <b>-&gt</b> Online users display; </p>
<p> &emsp;&emsp; and more... </p>
<p style='text-align:justify'> Worth to say that not all actions are enabled on this portfolio model website, as some CRUD actions, or alter the admin user attributes, as well the default categories, posts and comments. </p>

<br>
<p> <strong> <big> Languages / tools: </big> </strong> </p>
<p> &emsp;&emsp; HTML / CSS  - frontend </p>
<p> &emsp;&emsp; javascript  - frontend </p>
<p> &emsp;&emsp; jquery      - frontend </p>
<p> &emsp;&emsp; Bootstrap   - frontend </p>
<p> &emsp;&emsp; PHP         - backend </p>
<p> &emsp;&emsp; MySQL       - database </p>
<p> &emsp;&emsp; Composer    - as package and dependencies manager and classes autoload </p> 
<p> &emsp;&emsp; PHPMailer   - mailer handler </p>
<p> &emsp;&emsp; Summernotes - as enahnced text editor for post </p> 
<p> &emsp;&emsp; Toastr      - for action notifications </p>
<br>
<p> 
    <strong> <big> Project Github repository: </big> </strong>
    &emsp;&emsp; <a href='https://github.com/Jadersonrilidio/cms' target='_blank'> https://github.com/Jadersonrilidio/cms </a>
</p>
<br>

<hr>
<h2 style='text-align:center'> Author's Notes </h2>
<br>
<p style='text-align:justify'> 
    <b>-&gt</b> The project layout is provided within the course 
    <a href='https://www.udemy.com/course/php-for-complete-beginners-includes-msql-object-oriented' target='_blank'>\"PHP for Beginners - Become a PHP Master - CMS Project\"</a>
    by <b>Edwin Diaz</b>. Although, most of the layout and code behind was altered, improved and added. 
</p>
<br>
<p style='text-align:justify'> 
    <b>-&gt</b> Due to learning purposes, the project has been built according to different programming paradigm, folllowing the order: 
    <p style='text-align:center'> Imperative -> procedural -> object-oriented </p>
    <p style='text-align:center'> The currently programming paradigm stage is procedural with a pinch of OOP to handle more complex functionality.
    Although, a complete OOP paradigm may be implemented on the following major release. </p> 
</p>
<br>
<p style='text-align:justify'>
    <b>-&gt</b> For learning purposes, the project was not based on a existent software design nor architecture, but created from the author's best guess of how to organize the code,
    and yet the author himself has some knowledge of commom designs and architecture to be based on, details which can be noted on the code.
    On future releases, the MVC model may be implemented as well. 
</p>
<br>
<p style='text-align:justify'>
    <b>-&gt</b> The page 'populate_database.php' and all relative files, and the class GitHubLinks and all relative code are all part of the guide system created to demonstrate to project capabilities, thus their programming paradigm and architecture do not fit the one followed by the project.
</p>
";

const BASE_COMMENT_CONTENT = "If you want to leave us a message, please send an email from the page 'Contact'.";

const POST_CONTENT = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus sed ullamcorper augue. Vivamus eu risus urna. Suspendisse efficitur euismod iaculis. Suspendisse elementum, nibh in convallis euismod, sapien odio ultrices mi, ac commodo augue urna eget neque. Proin at turpis lobortis nibh aliquam posuere at et lorem. Integer ut bibendum augue, eu lacinia felis. Nulla fringilla accumsan libero at tincidunt. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.
    Maecenas sagittis risus luctus consequat dignissim. Mauris id mi volutpat, vestibulum nulla sed, dictum est. Duis eu convallis dui. Quisque auctor imperdiet lorem, a mollis augue rhoncus quis. Nulla vulputate nunc sem, nec mattis enim porta vel. Phasellus iaculis nibh at nunc ultrices fringilla. Mauris nec erat pulvinar felis pharetra imperdiet sit amet vitae erat. Sed volutpat id est a blandit. Pellentesque vel blandit diam. Nullam at suscipit metus, non molestie tortor. Etiam egestas quam ut finibus congue. Aliquam dictum lobortis diam sed tincidunt. Morbi semper quam quis nunc pellentesque, vel dignissim neque fringilla. Donec et leo sit amet elit interdum malesuada nec posuere dolor.
    Sed non neque varius, tempor magna ut, lacinia risus. Pellentesque eu tempor lorem. Cras pulvinar auctor mollis. Vivamus hendrerit nisl sapien, et pretium ante lobortis vel. Phasellus quis justo porta, molestie metus ac, volutpat neque. Nam ac ipsum est. Pellentesque egestas elementum velit at mollis.
    Quisque vel dignissim nulla. Sed et ipsum justo. Etiam malesuada cursus blandit. Mauris non euismod libero, ac lacinia magna. Mauris porttitor est efficitur, tempor felis eget, vulputate mauris. Nulla ac convallis tellus. Sed molestie sed libero in hendrerit. Nunc pellentesque a tortor a sodales. Donec consectetur non ipsum fringilla convallis. Etiam auctor ullamcorper metus sit amet mollis. Donec blandit orci nulla, in scelerisque lorem congue et. Morbi aliquam dui nisl, vitae tempor erat efficitur a. Morbi tristique, nibh sed lobortis egestas, sapien ante maximus ante, non pharetra risus nisl et enim. Nullam euismod ut mauris nec tristique.
    Sed vel ex metus. Suspendisse semper magna eget diam posuere aliquam. Morbi vel facilisis elit, vitae scelerisque metus. Nullam ac vulputate arcu. Aliquam erat volutpat. Donec sodales vitae enim et vestibulum. Sed ultrices sed diam id tristique. Morbi tristique turpis ut mi placerat, id posuere odio dictum. Cras molestie consequat arcu, et sodales est sagittis sit amet. Integer lobortis lectus et nisl lobortis commodo. Mauris tempus molestie sodales. ";

const COMMENT_CONTENT = [
    "Sed non neque varius, tempor magna ut, lacinia risus. Pellentesque eu tempor lorem. Cras pulvinar auctor mollis. Vivamus hendrerit nisl sapien, et pretium ante lobortis vel. Phasellus quis justo porta, molestie metus ac, volutpat neque. Nam ac ipsum est. Pellentesque egestas elementum velit at mollis. ",
    "Sed non neque varius, tempor magna ut, lacinia risus. Pellentesque eu tempor lorem. Cras pulvinar auctor mollis. Vivamus hendrerit nisl sapien, et pretium ante lobortis vel.",
    "Sed non neque varius, tempor magna ut, lacinia risus.",
    "Maecenas sagittis risus luctus consequat dignissim. Mauris id mi volutpat, vestibulum nulla sed, dictum est. Duis eu convallis dui. Quisque auctor imperdiet lorem, a mollis augue rhoncus quis. Nulla vulputate nunc sem, nec mattis enim porta vel. Phasellus iaculis nibh at nunc ultrices fringilla. Mauris nec erat pulvinar felis pharetra imperdiet sit amet vitae erat. Sed volutpat id est a blandit. Pellentesque vel blandit diam. Nullam at suscipit metus, non molestie tortor. Etiam egestas quam ut finibus congue. Aliquam dictum lobortis diam sed tincidunt. Morbi semper quam quis nunc pellentesque, vel dignissim neque fringilla. Donec et leo sit amet elit interdum malesuada nec posuere dolor. ",
    "Sed non neque varius, tempor magna ut, lacinia risus. Pellentesque eu tempor lorem. Cras pulvinar auctor mollis. Vivamus hendrerit nisl sapien, et pretium ante lobortis vel. Phasellus quis justo porta, molestie metus ac, volutpat neque. Nam ac ipsum est. Pellentesque egestas elementum velit at mollis. Quisque vel dignissim nulla. Sed et ipsum justo. Etiam malesuada cursus blandit. Mauris non euismod libero, ac lacinia magna. Mauris porttitor est efficitur, tempor felis eget, vulputate mauris. Nulla ac convallis tellus. Sed molestie sed libero in hendrerit. Nunc pellentesque a tortor a sodales. Donec consectetur non ipsum fringilla convallis. Etiam auctor ullamcorper metus sit amet mollis. Donec blandit orci nulla, in scelerisque lorem congue et. Morbi aliquam dui nisl, vitae tempor erat efficitur a. Morbi tristique, nibh sed lobortis egestas, sapien ante maximus ante, non pharetra risus nisl et enim. Nullam euismod ut mauris nec tristique. "
];

const PROFILE_PIC = [
    "profile-pic-01.jpg",
    "profile-pic-02.jpg",
    "profile-pic-03.jpg",
    "profile-pic-04.jpg",
    "profile-pic-05.jpg",
    "profile-pic-06.jpg"
];

const POST_IMG = [
    "post_img_black.png",
    "post_img_blue.png",
    "post_img_ciano.png",
    "post_img_green.png",
    "post_img_light_green.png",
    "post_img_light_pink.png",
    "post_img_orange.png",
    "post_img_purple.png",
    "post_img_red.png",
    "post_img_scarlat.png",
    "post_img_white.png",
    "post_img_yellow.png"
];

// TODO - populate-related functions

function populate_database () {
    if (!isset($_POST['populate'])) return false;
    if (check_invalid_entries()) return false;

    $num_cat = $_POST['category'];
    $num_user = $_POST['user'];
    $num_post = $_POST['post'];
    $num_comment = $_POST['comment'];

    // empty all tables used
    truncate_table_comments();
    truncate_table_posts();
    truncate_table_categories();
    truncate_table_users();
    //create base category, post and admin user
    create_base_category();
    create_master_admin();
    create_base_post();
    create_base_comment();
    //populate the database with the choosen parameters
    create_test_categories($num_cat);
    create_test_users($num_user);
    create_test_posts($num_post);    
    create_test_comments($num_comment);

    Notifications::set_toastr_session(Notifications::POPULATE_SUCCESS);
    Permissions::redirect('populate_database');
}

function create_test_categories ($num_cat) {
    for ($i=1; $i<=$num_cat; $i++) {
        $cat_title = "TestCategory{$i}";
        $query = "INSERT INTO categories(cat_title) VALUES(?) ";
        QueryHandler::statement_handler($query, 's', $cat_title);
    }
}

function create_test_users ($num_user) {
    for ($i=1; $i<=$num_user; $i++) {
        $user_name = "testuser{$i}";
        $user_email = "testuser{$i}@example.com";
        $user_role_id = rand(1, 2);
        $user_password = InputHandler::password_handler("testuser{$i}");
        $user_img = select_random_user_image();
        $query = "INSERT INTO users(user_name,user_email,user_role_id,user_password,user_image) VALUES(?,?,?,?,?) ";
        QueryHandler::statement_handler($query, 'ssiss', $user_name, $user_email, $user_role_id, $user_password, $user_img);
    }
}

function create_test_posts ($num_post) {
    $cat_id_array = create_cat_id_array();
    $author_id_array = create_author_id_array();

    for ($i=1; $i<=$num_post; $i++) {
        $post_title = "Test Post {$i}";
        $post_content = POST_CONTENT;
        $post_status_id = rand(1, 2);
        $post_category_id = sort_cat_id($cat_id_array);
        $post_image = select_random_post_image();
        $post_author = sort_author_id($author_id_array);
        $post_tags = "testtags, tags, search, jay, test, user, blog, cms";
        $query = "INSERT INTO posts(post_title,post_content,post_status_id,post_category_id,post_image,post_author,post_tags) VALUES(?,?,?,?,?,?,?) ";
        QueryHandler::statement_handler($query, 'ssiisis', $post_title,$post_content,$post_status_id,$post_category_id,$post_image,$post_author,$post_tags);
        if ($i == $num_post)
            create_base_post();
    }
}

function create_test_comments ($num_comment) {
    $post_id_array = create_post_id_array();
    $author_id_array = create_author_id_array();

    for ($i=1; $i<=$num_comment; $i++) {
        $comment_author = sort_author_id($author_id_array);
        $comment_post_id = sort_post_id($post_id_array);
        $comment_content = select_random_comment_content();
        $comment_status_id = rand(1, 2);
        $query = "INSERT INTO comments(comment_author,comment_post_id,comment_content,comment_status_id) VALUES(?,?,?,?) ";
        QueryHandler::statement_handler($query, 'iisi', $comment_author,$comment_post_id,$comment_content,$comment_status_id);
    }
}

//TODO - Auxiliary functions

function check_invalid_entries () : bool {
    if (empty($_POST['category']) || empty($_POST['user']) || empty($_POST['post']) || empty($_POST['comment'])) return true;
    if (!is_numeric($_POST['category']) || !is_numeric($_POST['user']) || !is_numeric($_POST['post']) || !is_numeric($_POST['comment'])) return true;
    if ($_POST['category']<=0 || $_POST['category']>10) return true;
    if ($_POST['user']<=0 || $_POST['user']>50) return true; 
    if ($_POST['post']<=0 || $_POST['post']>70) return true;
    if ($_POST['comment']<=0 || $_POST['comment']>500) return true;
    return false;
}

function select_random_user_image () : string {
    $rand_num = rand(0, 5);
    return PROFILE_PIC[$rand_num];
}

function select_random_post_image () : string {
    $rand_num = rand(0, 11);
    return POST_IMG[$rand_num];
}

function select_random_comment_content () : string {
    $rand_num = rand(0, 4);
    return COMMENT_CONTENT[$rand_num];
}

function create_author_id_array () {
    $author_id_array = [];    
    $query = "SELECT user_id FROM users ";
    $result = QueryHandler::statement_handler($query);
    mysqli_stmt_bind_result($result, $author_id);
    while (mysqli_stmt_fetch($result)) {
        array_push($author_id_array, $author_id);
    }
    return $author_id_array;
}

function sort_author_id ($author_id_array) {
    $total_author_id = count($author_id_array);
    $rand_num = rand(1, ($total_author_id - 1));
    return $author_id_array[$rand_num];
}

function create_cat_id_array () {
    $cat_id_array = [];    
    $query = "SELECT cat_id FROM categories ";
    $result = QueryHandler::statement_handler($query);
    mysqli_stmt_bind_result($result, $cat_id);
    while (mysqli_stmt_fetch($result)) {
        array_push($cat_id_array, $cat_id);
    }
    return $cat_id_array;
}

function sort_cat_id ($cat_id_array) {
    $total_cat_id = count($cat_id_array);
    $rand_num = rand(1, ($total_cat_id - 1));
    return $cat_id_array[$rand_num];
}

function create_post_id_array () {
    $post_id_array = [];    
    $query = "SELECT post_id FROM posts ";
    $result = QueryHandler::statement_handler($query);
    mysqli_stmt_bind_result($result, $post_id);
    while (mysqli_stmt_fetch($result)) {
        array_push($post_id_array, $post_id);
    }
    return $post_id_array;
}

function sort_post_id ($post_id_array) {
    $total_post_id = count($post_id_array);
    $rand_num = rand(1, ($total_post_id - 2));
    return $post_id_array[$rand_num];
}

// TODO - truncate_db-related functions

function truncate_all_tables () {
    if (!isset($_POST['truncate'])) return false;
    
    truncate_table_comments();
    truncate_table_posts();
    truncate_table_users();
    truncate_table_categories();
    
    create_master_admin();
    create_base_category();
    create_base_post();
    create_base_comment();
    
    Notifications::set_toastr_session(Notifications::TRUNCATE_SUCCESS);
    Permissions::redirect('populate_database');
    
    return true;
}

function truncate_table_categories () {
    $query = " TRUNCATE TABLE categories ";
    QueryHandler::query_handler($query);
}

function truncate_table_users () {
    $query = " TRUNCATE TABLE users ";
    QueryHandler::query_handler($query);
}

function truncate_table_posts () {
    $query = " TRUNCATE TABLE posts ";
    QueryHandler::query_handler($query);
}

function truncate_table_comments () {
    $query = " TRUNCATE TABLE comments ";
    QueryHandler::query_handler($query);
}

function create_master_admin () {
    $user_name = "admin";
    $user_password = InputHandler::password_handler("admin123");
    $user_email = "admin@example.com";
    $user_role_id = 1;
    $user_image = "user-img-1.jpeg";
    $query = " INSERT INTO users(user_name,user_password,user_email,user_role_id,user_image) VALUES(?,?,?,?,?) ";
    QueryHandler::statement_handler($query, 'sssis', $user_name, $user_password, $user_email, $user_role_id, $user_image);
}

function create_base_category () {
    $cat_title = "Blog_CMS Project";
    $query = " INSERT INTO categories(cat_title) VALUES(?) ";
    QueryHandler::statement_handler($query, 's', $cat_title);
}

function create_base_post () {
    $post_title = "Blog_CMS information & author notes";
    $post_content = BASE_POST_CONTENT;
    $post_status_id = 1;
    $post_category_id = 1;
    $post_author = 1;
    $post_image = "base_post.png";
    $post_tags = "author, jay, jaderson, cms project, blog cms";
    $query = "INSERT INTO posts(post_title,post_content,post_status_id,post_category_id,post_image,post_author,post_tags) VALUES(?,?,?,?,?,?,?) ";
    QueryHandler::statement_handler($query, 'ssiisis', $post_title,$post_content,$post_status_id,$post_category_id,$post_image,$post_author,$post_tags);
}

function create_base_comment () {
    $comment_author = 1;
    $comment_post_id = 1;
    $comment_content = BASE_COMMENT_CONTENT;
    $comment_status_id = 1;
    $query = "INSERT INTO comments(comment_author,comment_post_id,comment_content,comment_status_id) VALUES(?,?,?,?) ";
    QueryHandler::statement_handler($query, 'iisi', $comment_author,$comment_post_id,$comment_content,$comment_status_id);
}

// TODO - Classes

class InputErrorMsg {

    static public function cat_empty () {
        if ( isset($_POST['populate']) && empty($_POST['category']) )
            echo "<span class='my-msg-status'> Category number not defined... </span>";
    }

    static public function cat_not_numeric () {
        if (!empty($_POST['category']))
            if (!is_numeric($_POST['category']))
                echo "<span class='my-msg-status'> Category field must be a number! </span>";
    }

    static public function cat_out_of_range () {
        if ( !empty($_POST['category']) && is_numeric($_POST['category']) )
            if ($_POST['category']<=0 || $_POST['category']>10)
                echo "<span class='my-msg-status'> Category number out of range... </span>";
    }

    static public function user_empty () {
        if ( isset($_POST['populate']) && empty($_POST['user']) )
            echo "<span class='my-msg-status'> Users number not defined... </span>";
    }

    static public function user_not_numeric () {
        if (!empty($_POST['user']))
            if (!is_numeric($_POST['user']))
                echo "<span class='my-msg-status'> Users field must be a number! </span>";
    }

    static public function user_out_of_range () {
        if ( !empty($_POST['user']) && is_numeric($_POST['user']) )
            if ($_POST['user']<=0 || $_POST['user']>50)
                echo "<span class='my-msg-status'> Users number out of range... </span>";
    }

    static public function post_empty () {
        if ( isset($_POST['populate']) && empty($_POST['post']) )
            echo "<span class='my-msg-status'> Post number not defined... </span>";
    }

    static public function post_not_numeric () {
        if (!empty($_POST['post']))
            if (!is_numeric($_POST['post']))
                echo "<span class='my-msg-status'> Post field must be a number! </span>";
    }

    static public function post_out_of_range () {
        if ( !empty($_POST['post']) && is_numeric($_POST['post']) )
            if ($_POST['post']<=0 || $_POST['post']>70)
                echo "<span class='my-msg-status'> Post number out of range... </span>";
    }

    static public function comment_empty () {
        if ( isset($_POST['populate']) && empty($_POST['comment']) )
            echo "<span class='my-msg-status'> Comment number not defined... </span>";
    }

    static public function comment_not_numeric () {
        if (!empty($_POST['comment']))
            if (!is_numeric($_POST['comment']))
                echo "<span class='my-msg-status'> Comment field must be a number! </span>";
    }

    static public function comment_out_of_range () {
        if ( !empty($_POST['comment']) && is_numeric($_POST['comment']) )
            if ($_POST['comment']<=0 || $_POST['comment']>500)
                echo "<span class='my-msg-status'> Comment number out of range... </span>";
    }
}

?>