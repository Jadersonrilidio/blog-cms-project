<?php users_online_count(); ?>

<?php 

# ===================================================================================================
# TODO - Admin category functions 

function ACTUAL_display_categories ($case) { #OPTIMIZE - test this function 
    $query = 'SELECT * FROM categories';
    $result =  MyDB::query_handler($query, 'result');
    
    while ($register = mysqli_fetch_assoc($result)) {
        if ($case == 'link') ACTUAL_category_html_link($register);
        if ($case == 'table') ACTUAL_category_html_table_row($register);
    }
}

function display_categories ($case) { #OPTIMIZE - test this function 
    global $connection;
    
    $query = 'SELECT * FROM categories';
    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    mysqli_stmt_bind_result($stmt, $cat_id, $cat_title);
    #$result =  MyDB::query_handler($query, 'result');
    
    while (mysqli_stmt_fetch($stmt)) {
        if ($case == 'link') category_html_link($cat_id, $cat_title);
        if ($case == 'table') category_html_table_row($cat_id, $cat_title);
    }
}

function add_category () { // OPTIMIZE statement 
    global $connection;

    if (!isset($_POST['cat_add'])) return '';
    if (!is_admin()) return '';
    if (empty($_POST['cat_title'])) return "Must insert category name ...";

    $cat_title = escape($_POST['cat_title']);

    $query = "INSERT INTO categories(cat_title) VALUES (?)";
    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, 's', $cat_title);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    #MyDB::query_handler($query, 'result');

    return "Category added!";
}

function delete_category () {
    global $connection;

    if (!isset($_GET['cat_delete'])) return '';
    if (!is_admin()) return '';

    $cat_id = escape($_GET['cat_delete']);

    $query = "DELETE FROM categories WHERE cat_id = ? ";
    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, 'i', $cat_id);
    mysqli_stmt_execute($stmt);

    #MyDB::query_handler($query, 'result');

    redirect('index.php?page=categories&msg=category deleted');
}

function update_category () {
    global $connection;

    if (!isset($_POST['cat_update'])) return '';
    if (!is_admin()) return '';
    if ($_POST['cat_title'] == " " || empty($_POST['cat_title'])) return "Must insert category name ...";

    $cat_title = escape($_POST['cat_title']);
    $cat_id = escape($_POST['cat_id']);

    $query = "UPDATE categories SET cat_title = ? WHERE cat_id = ? ";
    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, 'si', $cat_title, $cat_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    #MyDB::query_handler($query, 'result');

    return "Category updated!";
}

function get_category_to_edit ($category_id) {
    $register = get_category_info ($category_id, 'cat_id');
    category_html_update_form($register);
}

function category_selector_menu ($category_id = null) {
    $query = "SELECT * FROM categories";
    $result =  MyDB::query_handler($query, 'result');
    
    while ($register = mysqli_fetch_assoc($result)) {
        echo (isset($category_id) && $register['cat_id'] == $category_id)
            ? "<option selected='selected' value='{$register['cat_id']}'>" . $register['cat_title'] . "</option>"
            : "<option value='{$register['cat_id']}'>" . $register['cat_title'] . "</option>";
    }
}

function get_category_info ($value, string $key = 'cat_id', string $attribute = NULL) {
    $value = escape($value);

    $query = (is_string($value))
        ? "SELECT * FROM categories WHERE $key = '$value'"
        : "SELECT * FROM categories WHERE $key = $value";

    $register = MyDB::query_handler($query, 'assoc_array');

    return ($attribute) ? $register[$attribute] : $register;
}

# ===================================================================================================
#TODO - Admin post functions 

// $IDEAL_QUERY = "SELECT 
//     p.id, p.category_id, p.title, p.uthor, p.date_time, p.image, p.content, p.tags, p.status_id, 
//     c.title AS post_category, u.name AS author, ps.title AS post_status 
//     /*foreach co.post_id : post_comment_count++; */
//     FROM posts p 
//     LEFT JOIN categories c ON p.category_id = c.cat_id 
//     LEFT JOIN users u ON p.author = u.id  
//     LEFT JOIN post_status ps ON p.status_id = ps.id 
//     /* LEFT JOIN comments co ON p.id = co.post_id */ 
//     GROUP BY p.id ";

// $query = "SELECT 
//     p.post_id, p.post_category_id, p.post_title, p.post_author, p.post_date_time, p.post_image, p.post_content, p.post_tags, p.post_status_id, 
//     /*c.cat_id*/, c.cat_title AS post_category, 
//     /*u.user_id*/, u.user_name AS author, 
//     /*ps.post_status_id*/, ps.post_status_title AS post_status 
//     FROM posts p LEFT JOIN categories c ON p.post_category_id = c.cat_id 
//     LEFT JOIN users u ON p.post_author = u.user_id  
//     LEFT JOIN post_status ps ON p.post_status_id = ps.post_status_id 
//     GROUP BY p.post_id ";

// $query .= " ";

function display_posts_on_table () {
    $query = "SELECT P.post_id, P.post_category_id, P.post_title, P.post_author, P.post_date_time, 
        P.post_image, P.post_content, P.post_tags, P.post_status_id, 
        C.cat_id, C.cat_title AS post_category, 
        U.user_id, U.user_name AS author, 
        PS.post_status_id, PS.post_status_title AS post_status 
        FROM posts P 
        LEFT JOIN categories C ON P.post_category_id = C.cat_id 
        LEFT JOIN users U ON P.post_author = U.user_id 
        LEFT JOIN post_status PS ON P.post_status_id = PS.post_status_id ";

    if (isset($_GET['user_id'])) {
        $user_id = escape($_GET['user_id']);
        $query .= "WHERE P.post_author = $user_id ";
    }

    $result = MyDB::query_handler($query, 'result');

    while($register = mysqli_fetch_assoc($result)) {
        posts_html_table_row($register);
    }
}

// function display_posts_on_table () {
//     $query = "SELECT * FROM posts";

//     if (isset($_GET['user_id'])) {
//         $user_id = escape($_GET['user_id']);
//         $query = "SELECT * FROM posts WHERE post_author = $user_id";
//     }

//     $result = MyDB::query_handler($query, 'result');

//     while($register = mysqli_fetch_assoc($result)) {
//         posts_html_table_row($register);
//     }
// }

function create_post () : string {
    if (!isset($_POST['create_post'])) return "";
    if (!is_admin()) return "";

    if (empty($_POST['post_title'])) return "Must insert title ...";
    if (empty($_POST['post_author'])) return "Must select author ...";
    if (empty($_POST['post_category_id'])) return "Must select category ...";
    if (empty($_POST['post_status_id'])) return "Must select status ...";
    if (empty($_FILES['post_image']['name'])) return "Must upload image ...";
    if (empty($_POST['post_content'])) return "Must insert content ...";

    $post_category_id = escape($_POST['post_category_id']);
    $post_title = escape($_POST['post_title']);
    $post_author = escape($_POST['post_author']);
    $post_status_id = escape($_POST['post_status_id']);
    $post_content = ($_POST['post_content']); # FIXME - how to escape content ? 
    
    $post_tags = null;
    if (!empty($_POST['post_tags'])) $post_tags = escape($_POST['post_tags']);
    
    $post_image = $_FILES['post_image']['name'];
    $post_image_temp = $_FILES['post_image']['tmp_name'];
    
    $query = "INSERT INTO posts(post_category_id,post_title,post_author,post_image,post_content,post_tags,post_status_id) ";
    $query .= " VALUES($post_category_id,'$post_title',$post_author,'$post_image','$post_content','$post_tags',$post_status_id)";
    
    MyDB::query_handler($query, 'result');
    
    move_uploaded_file($post_image_temp, "../images/$post_image");

    return "Post created!";
}

function update_post () {
    if (!isset($_POST['edit_post'])) return "";
    if (!is_admin()) return "";

    if (empty($_POST['post_category_id'])) return "Must select category ...";
    if (empty($_POST['post_title'])) return "Must insert title ...";
    if (empty($_POST['post_author'])) return "Must select author ...";
    if (empty($_POST['post_status_id'])) return "Must select status ...";
    if (empty($_POST['post_content'])) return "Must insert content ...";
    
    $post_id = escape($_POST['post_id']);
    $post_category_id = escape($_POST['post_category_id']);
    $post_title = escape($_POST['post_title']);
    $post_author = escape($_POST['post_author']);
    $post_status_id = escape($_POST['post_status_id']);
    $post_content = ($_POST['post_content']); # FIXME - how to escape content ? 
    $post_tags = escape($_POST['post_tags']);
    $post_date_time = escape($_POST['post_date_time']);
    
    $post_image = $_FILES['post_image']['name'];
    if (empty($post_image)) $post_image = select_image_from_post_id($post_id);
    $post_image_temp = $_FILES['post_image']['tmp_name'];

    if (empty($post_image)) return "Must upload image ...";
    
    $query = "UPDATE posts SET ";
    $query .= "post_category_id = $post_category_id, ";
    $query .= "post_title = '$post_title', ";
    $query .= "post_author = $post_author, ";
    $query .= "post_date_time = '$post_date_time', ";
    $query .= "post_image = '$post_image', ";
    $query .= "post_content = '$post_content', ";
    $query .= "post_tags = '$post_tags', ";
    $query .= "post_status_id = '$post_status_id' ";
    $query .= "WHERE post_id = $post_id";
    
    MyDB::query_handler($query, 'result');
    
    move_uploaded_file($post_image_temp, "../images/$post_image");

    return "Post updated!";
}

function clone_post ($post_id) {
    if (!is_admin()) return "";

    $query = "SELECT * FROM posts WHERE post_id = $post_id";
    $post = MyDB::query_handler($query, 'assoc_array');
    
    $post_category_id = $post['post_category_id'];
    $post_title = $post['post_title'];
    $post_author = $post['post_author'];
    $post_content = $post['post_content'];
    $post_image = $post['post_image'];
    
    $post_tags = null;
    if (!empty($post['post_tags'])) $post_tags = $post['post_tags'];
    
    $query = "INSERT INTO posts(post_category_id,post_title,post_author,post_image,post_content,post_tags) ";
    $query .= " VALUES($post_category_id,'$post_title',$post_author,'$post_image','$post_content','$post_tags')";
    
    MyDB::query_handler($query, 'result');
    
    return "Post cloned!";
}

function delete_post () {
    $post_id = escape($_GET['post_id']);
    if (!is_admin()) return "";

    $query = "DELETE FROM posts WHERE post_id = $post_id ";
    MyDB::query_handler($query, 'result');

    return "Post deleted!";
}

function select_post_to_edit () {  # OPTIMIZE - insert variable $post_id as parameter 
    if (!isset($_GET['source'])) return "";

    $post_id = escape($_GET['post_id']);

    $query = "SELECT* FROM posts WHERE post_id = $post_id";
    $register = MyDB::query_handler($query, 'assoc_array');

    return $register;
}

function select_image_from_post_id ($post_id) { # OPTIMIZE - insert variable $post_id as parameter - select wanted attribute 
    $query = "SELECT * FROM posts WHERE post_id = $post_id";
    $register = MyDB::query_handler($query, 'assoc_array');

    return $register['post_image'];
}

function select_post_title_by_id ($post_id) { # OPTIMIZE - insert variable $post_id as parameter - select wanted attribute 
    $query = "SELECT * FROM posts WHERE post_id = $post_id";
    $register = MyDB::query_handler($query, 'assoc_array');

    return $register['post_title'];
}

function catch_post_id_array () {
    if (isset($_POST['checkboxArray'])) {
        foreach ($_POST['checkboxArray'] as  $post_id) {
            post_action_switch($_POST['bulk_options'], $post_id);
        }

        if ($_POST['bulk_options'] == 'null') return "Select a valid option...";
        if ($_POST['bulk_options'] == 'delete') return "Selected posts deleted!";
        if ($_POST['bulk_options'] == 'clone') return "Selected posts cloned";
        return "selected posts status updated!";
    }
}

function post_action_switch ($option, $post_id) {
    switch ($option) {
        case 'null':
            break;
        case '1':
            if (!is_admin()) break;
            $query = "UPDATE posts SET post_status_id = $option WHERE post_id = $post_id";
            MyDB::query_handler($query, 'result');
            break;
        case '2':
            if (!is_admin()) break;
            $query = "UPDATE posts SET post_status_id = $option WHERE post_id = $post_id";
            MyDB::query_handler($query, 'result');
            break;
        case 'clone':
            clone_post($post_id);
            break;
        case 'delete':
            if (!is_admin()) break;
            $query = "DELETE FROM posts WHERE post_id = $post_id";
            MyDB::query_handler($query, 'result');
            break;
    }
}

function get_last_created_post_id () {
    global $connection;
    return mysqli_insert_id($connection);
}

function post_comment_count ($post_id) {
    $query = "SELECT * FROM comments WHERE comment_post_id = $post_id";
    $num_rows = MyDB::query_handler($query, 'num_rows');
    return $num_rows;
}

# ===================================================================================================
#TODO - Admin status/roles functions 

function post_status_selector_menu ($post_status_id = null) {
    $query = "SELECT * FROM post_status";
    $result = MyDB::query_handler($query, 'result');
    
    while ($register = mysqli_fetch_assoc($result)) {
        echo (isset($post_status_id) && $register['post_status_id'] == $post_status_id)
            ? "<option selected='selected' value='{$register['post_status_id']}'>" . $register['post_status_title'] . "</option>"
            : "<option value='{$register['post_status_id']}'>" . $register['post_status_title'] . "</option>";
    }
}

function select_post_status_title_by_id ($post_status_id) { #OPTIMIZE - make a more general function with more parameters
    $query = "SELECT * FROM post_status WHERE post_status_id = $post_status_id";
    $result = MyDB::query_handler($query, 'result');

    $register = mysqli_fetch_assoc($result);
    
    return $register['post_status_title'];
}

function select_comment_status_title_by_id ($comment_status_id) { #OPTIMIZE - make a more general function with more parameters
    $query = "SELECT * FROM comment_status WHERE comment_status_id = $comment_status_id";
    $result = MyDB::query_handler($query, 'result');

    $register = mysqli_fetch_assoc($result);
    
    return $register['comment_status_title'];
}

function user_role_selector_menu ($user_role_id = null) {
    $query = "SELECT * FROM roles";
    $result = MyDB::query_handler($query, 'result');
    
    while ($register = mysqli_fetch_assoc($result)) {
        echo (isset($user_role_id) && $register['role_id'] == $user_role_id)
            ? "<option selected='selected' value='{$register['role_id']}'>" . $register['role_title'] . "</option>"
            : "<option value='{$register['role_id']}'>" . $register['role_title'] . "</option>";
    }
}

function select_user_role_title_by_id ($user_role_id) { #OPTIMIZE - make a more general function with more parameters
    $query = "SELECT * FROM roles WHERE role_id = $user_role_id";
    $result = MyDB::query_handler($query, 'result');

    $register = mysqli_fetch_assoc($result);
    
    return $register['role_title'];
}

# ===================================================================================================
#TODO - Admin comment functions 

function display_all_comments_on_table () {
    $query = "SELECT * FROM comments ";
    
    if (isset($_GET['post_id'])) {
        $post_id = $_GET['post_id'];
        $query = "SELECT * FROM comments WHERE comment_post_id = $post_id";
    }
    
    $result = MyDB::query_handler($query, 'result');

    while($register = mysqli_fetch_assoc($result)) {
        comments_html_table_row($register);
    }
}

function catch_comment_id_array () {
    if (isset($_POST['checkboxArray'])) {
        foreach ($_POST['checkboxArray'] as  $comment_id) {
            comment_action_switch($_POST['bulk_options'], $comment_id);
        }

        if ($_POST['bulk_options'] == 'null') return "Select a valid option...";
        if ($_POST['bulk_options'] == 'delete') return "Selected comments deleted!";
        if ($_POST['bulk_options'] == '1') return "Selected comments approved!";
        if ($_POST['bulk_options'] == '2') return "Selected comments unapproved!";
    }
}

function comment_action_switch ($option, $comment_id) {
    switch ($option) {
        case 'null':
            break;
        case '1':
            $query = "UPDATE comments SET comment_status_id = $option WHERE comment_id = $comment_id";
            MyDB::query_handler($query, 'result');
            break;
        case '2':
            $query = "UPDATE comments SET comment_status_id = $option WHERE comment_id = $comment_id";
            MyDB::query_handler($query, 'result');
            break;
        case 'delete':
            $query = "DELETE FROM comments WHERE comment_id = $comment_id";
            MyDB::query_handler($query, 'result');
            break;
    }
}

function delete_comment () {
    $comment_id = $_GET['comment_id'];

    $query = "DELETE FROM comments WHERE comment_id = $comment_id";
    MyDB::query_handler($query, 'result');

    return "Comment deleted!";
}

function approve_comment () { # OPTIMIZE - insert variable $comment_id as parameter 
    $comment_id = $_GET['comment_id'];

    $query = "UPDATE comments SET comment_status_id = 1 WHERE comment_id = $comment_id";
    MyDB::query_handler($query, 'result');

    return "Comment approved!";
}

function unapprove_comment () { # OPTIMIZE - insert variable $comment_id as parameter 
    $comment_id = $_GET['comment_id'];

    $query = "UPDATE comments SET comment_status_id = 2 WHERE comment_id = $comment_id";
    MyDB::query_handler($query, 'result');

    return "Comment unapproved!";
}

# ===================================================================================================
#TODO - Admin user functions 

function display_all_users_on_table () {
    $query = "SELECT * FROM users ";
    $result = MyDB::query_handler($query, 'result');

    while ($register = mysqli_fetch_assoc($result)) {
        users_html_table_row($register);
    }
}

function add_user () {
    if (!isset($_POST['user_add'])) return "";



    if (empty($_POST['user_name'])) return "Must insert username...";
    if (username_exists($_POST['user_name'])) return 'Username already exists...';
    if (empty($_POST['user_firstname'])) return "Must insert first name...";
    if (empty($_POST['user_lastname'])) return "Must insert last name...";
    if (empty($_POST['user_email'])) return "Must insert email...";
    if (email_exists($_POST['user_email'])) return 'Email already exists...';
    if (empty($_POST['user_role_id'])) return "Must insert role...";
    if (empty($_POST['user_password'])) return "Must insert password...";
    if (empty($_FILES['user_image']['name'])) return "Must upload image...";
    
    $user_name = escape($_POST['user_name']);
    $user_firstname = escape($_POST['user_firstname']);
    $user_lastname = escape($_POST['user_lastname']);
    $user_email = escape($_POST['user_email']);
    $user_role_id = escape($_POST['user_role_id']);

    $user_password = password_handle($_POST['user_password']);

    $user_image = $_FILES['user_image']['name']; # FIXME - how to treat/escape image files? 
    $user_image_temp = $_FILES['user_image']['tmp_name'];

    $query = "INSERT INTO users(user_name,user_password,user_firstname,user_lastname,user_email,user_image,user_role_id) ";
    $query .= "VALUES('$user_name','$user_password','$user_firstname','$user_lastname','$user_email','$user_image',$user_role_id) ";
    MyDB::query_handler($query, 'result');

    move_uploaded_file($user_image_temp, "../images/$user_image");

    return "User Added!";
}

function edit_user () {
    if (!isset($_POST['user_edit'])) return "";

    if (empty($_POST['user_name'])) return "Must insert username...";
    if (empty($_POST['user_firstname'])) return "Must insert first name...";
    if (empty($_POST['user_lastname'])) return "Must insert last name...";
    if (empty($_POST['user_email'])) return "Must insert email...";
    if (empty($_POST['user_role_id'])) return "Must insert role...";

    $user_id = $_GET['user_id'];
    $user_name = $_POST['user_name'];
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_email = $_POST['user_email'];
    $user_role_id = $_POST['user_role_id'];

    $user_image = $_FILES['user_image']['name'];
    if (empty($user_image)) $user_image = get_user_image_by_id($user_id);
    $user_image_temp = $_FILES['user_image']['tmp_name'];

    $query = "UPDATE users SET ";
    $query .= "user_name = '$user_name', ";
    $query .= "user_firstname = '$user_firstname', ";
    $query .= "user_lastname = '$user_lastname', ";
    $query .= "user_email = '$user_email', ";
    $query .= "user_image = '$user_image', ";
    $query .= "user_role_id = '$user_role_id' ";
    $query .= "WHERE user_id = $user_id ";

    MyDB::query_handler($query, 'result');

    move_uploaded_file($user_image_temp, "../images/$user_image");

    return "User successfully updated!";
}

function delete_user () { # OPTIMIZE - insert variable $comment_id as parameter 
    $user_id = $_GET['user_id'];
    
    $query = "DELETE FROM users WHERE user_id = $user_id ";
    MyDB::query_handler($query, 'result');

    return "User deleted!";
}

function get_user_by_id () { # OPTIMIZE - insert variable $comment_id as parameter 
    $user_id = $_GET['user_id'];

    $query = "SELECT * FROM users WHERE user_id = $user_id";
    $result = MyDB::query_handler($query, 'result');

    $register = mysqli_fetch_assoc($result);

    return $register;
}

function get_user_by_session_id () { # OPTIMIZE - insert variable $comment_id as parameter - or use the function above 
    $user_id = $_SESSION['user_id'];

    $query = "SELECT * FROM users WHERE user_id = $user_id";
    $result = MyDB::query_handler($query, 'result');

    $register = mysqli_fetch_assoc($result);

    return $register;
}

function get_user_image_by_id ($user_id) { # OPTIMIZE - make a more general function, for get all parameters wanted 
    $query = "SELECT * FROM users WHERE user_id = $user_id";
    $result = MyDB::query_handler($query, 'result');

    $register = mysqli_fetch_assoc($result);

    return $register['user_image'];
}

function user_admin_selector_menu ($user_id = null) {
    $query = "SELECT * FROM users WHERE user_role_id = 1";
    $result = MyDB::query_handler($query, 'result');
    
    while ($register = mysqli_fetch_assoc($result)) {
        echo (isset($user_id) && $register['user_id'] == $user_id)
            ? "<option selected='selected' value='{$register['user_id']}'>" . $register['user_name'] . "</option>"
            : "<option value='{$register['user_id']}'>" . $register['user_name'] . "</option>";
    }
}

function select_user_name_by_id ($user_id) { # OPTIMIZE - make a more general function, for get all parameters wanted 
    $query = "SELECT * FROM users WHERE user_id = $user_id";
    $result = MyDB::query_handler($query, 'result');

    $register = mysqli_fetch_assoc($result);
    
    return $register['user_name'];
}

function user_posts_count ($user_id) {
    $query = "SELECT * FROM posts WHERE post_author = $user_id";
    $num_rows = MyDB::query_handler($query, 'num_rows');
    return $num_rows;
}

function username_exists($username) {
    $query = "SELECT user_name FROM users WHERE user_name = '$username'";
    $num_rows = MyDB::query_handler($query, 'num_rows');
    return ($num_rows == 0) ? false : true;
}

function email_exists($email) {
    $query = "SELECT U.user_email FROM users U WHERE U.user_email = '$email' ";
    $num_rows = MyDB::query_handler($query, 'num_rows');
    return ($num_rows == 0) ? false : true;
}

# ===================================================================================================
#TODO - Admin session functions 

function get_session_admin_variables () {
    if ($_SESSION['user_id'] !== null && isset($_POST['user_edit'])) {
        $_SESSION['user_name'] = $_POST['user_name'];
        $_SESSION['user_firstname'] = $_POST['user_firstname'];
        $_SESSION['user_lastname'] = $_POST['user_lastname'];
        $_SESSION['user_role_id'] = $_POST['user_role_id'];
        $_SESSION['user_email'] = $_POST['user_email'];
    } 
}

function session_admin_logout () {
    $_SESSION['user_id'] = null;
    $_SESSION['user_name'] = null;
    $_SESSION['user_firstname'] = null;
    $_SESSION['user_lastname'] = null;
    $_SESSION['user_role_id'] = null;
    $_SESSION['user_email'] = null;

    header('Location: ../index.php');
}

function display_admin_user_name () {
    if (isset($_SESSION['user_name'])) echo $_SESSION['user_name'];
}

function users_online_count () { #FIXME - such complicated function, understand it better 
    if (isset($_GET['onlineusers'])) {
        global $connection;

        if (!$connection) {
            session_start();
            include '../../includes/db.php';
        }
        
        $session = session_id();
        $time = time();
        $timeout_seconds = 30;
        $timeout = $time - $timeout_seconds;

        $query = "SELECT * FROM users_online WHERE users_online_session = '$session'";
        $num_rows = MyDB::query_handler($query, 'num_rows');

        if ($num_rows == NULL) {
            $query = "INSERT INTO users_online(users_online_session,users_online_time) VALUES('$session','$time') ";
            MyDB::query_handler($query, 'result');
        } else {
            $query = "UPDATE users_online SET  users_online_time = '$time' WHERE users_online_session = '$session' ";
            MyDB::query_handler($query, 'result');
        }
        
        $query = "SELECT * FROM users_online WHERE users_online_time > '$timeout' ";
        $num_rows = MyDB::query_handler($query, 'num_rows');

        echo $num_rows;
    }
}

function is_admin () {
    return (isset($_SESSION['user_id']) && $_SESSION['user_role_id'] == 1) ? true : false;
}

function has_admin_permission () {
    (is_admin()) ? '' : header('Location: ../index.php');
}

# ===================================================================================================
#TODO - admin dashboard page functions 

function dashboard_count ($table) {
    $query = "SELECT * FROM $table";
    return MyDB::query_handler($query, 'num_rows');
}

# ===================================================================================================
#TODO - Admin html-embeed functions 

function ACTUAL_category_html_link ($category) {
    echo "<li> <a href='#'>" . $category['cat_title'] . "</a> </li>";
}

function ACTUAL_category_html_table_row ($category) {
    echo "<tr>";
    echo "<td>" . $category['cat_id'] . "</td>";
    echo "<td>" . $category['cat_title'] . "</td>";
    echo "<td> <a class='delete-category' data-toggle='modal' data-target='#myModal' href='' rel='{$category['cat_id']}'> Delete </a> </td>";
    // echo "<td> <a href='index.php?page=categories&cat_delete=" . $category['cat_id'] . "'> Delete </a> </td>";
    echo "<td> <a href='index.php?page=categories&cat_update=" . $category['cat_id'] . "'> Edit </a> </td>";
    echo "</tr>";
}

function category_html_link ($cat_id, $cat_title) {
    echo "<li> <a href='{$cat_id}'>{$cat_title}</a> </li>";
}

function category_html_table_row ($cat_id, $cat_title) {
    echo "<tr>";
    echo "<td>{$cat_id}</td>";
    echo "<td>{$cat_title}</td>";
    echo "<td> <a class='delete-category' data-toggle='modal' data-target='#myModal' href='' rel='{$cat_id}'> Delete </a> </td>";
    // echo "<td> <a href='index.php?page=categories&cat_delete=" . $cat_id . "'> Delete </a> </td>";
    echo "<td> <a href='index.php?page=categories&cat_update={$cat_id}'> Edit </a> </td>";
    echo "</tr>";
}

function category_html_update_form ($category) {
    ?>
    <form action="./index.php?page=categories" method="POST">                   
        <div class="form-group">
            <label for="cat_title"> Update category - Id <?php echo $category['cat_id']; ?> </label>
            <input value="<?php echo $category['cat_title']; ?>" type="text" name="cat_title" class="form-control" placeholder="Type the category name here...">
            
            <input value="<?php echo $category['cat_id']; ?>" type="hidden" name="cat_id" class="form-control">
        </div>

        <div class="form-group">
            <input class="btn btn-primary" type="submit" name="cat_update" value="Update category">
        </div>
    </form> 
    <?php
}

function posts_html_table_row ($register) {
    echo "<tr>";
    echo "<td> <input class='checkBoxes' type='checkbox' name='checkboxArray[]' value='" . $register['post_id'] . "'> </td>";
    echo "<td>" . $register['post_id'] . "</td>";
    // echo "<td> <a href='../index.php?page=author&author=" . $register['post_author'] . "'>" . select_user_name_by_id($register['post_author']) . "</a> </td>";
    echo "<td> <a href='../index.php?page=author&author=" . $register['post_author'] . "'>" . $register['author'] . "</a> </td>";
    echo "<td> <a href='../index.php?page=post&post_id=" . $register['post_id'] . "'>" . $register['post_title'] . "</a> </td>";
    // echo "<td>" . get_category_info($post['post_category_id'], 'cat_id', 'cat_title') . "</td>";
    echo "<td>" . $register['post_category'] . "</td>";
    // echo "<td>" . select_post_status_title_by_id($register['post_status_id']) . "</td>";
    echo "<td>" . $register['post_status'] . "</td>";
    echo "<td> <img width='100' src='../images/".$register['post_image']."' alt='image'> </td>";
    echo "<td>" . $register['post_tags'] . "</td>";
    echo "<td>" . substr(htmlspecialchars($register['post_content']), 0, 70) . "</td>"; 
    echo "<td> <a href='index.php?page=comments&post_id={$register['post_id']}'>" . post_comment_count($register['post_id']) . "</a> </td>";
    echo "<td>" . $register['post_date_time'] . "</td>";
    echo (isset($_GET['user_id']))
        ? "<td> <a class='delete-post' data-toggle='modal' data-target='#myModal' href='' rel='{$register['post_id']}' rel2='{$_GET['user_id']}'> Delete </a> </td>"       
        : "<td> <a class='delete-post' data-toggle='modal' data-target='#myModal' href='' rel='{$register['post_id']}'> Delete </a> </td>";
        // ? "<td> <a onClick=\"javascript: return confirm('Delete post?');\" href='index.php?page=posts&source=delete_post&user_id=" . $_GET['user_id'] . "&post_id=" . $register['post_id'] . "'> Delete </a> </td>"       
        // : "<td> <a onClick=\"javascript: return confirm('Delete post?');\" href='index.php?page=posts&source=delete_post&post_id=" . $register['post_id'] . "'> Delete </a> </td>";
    echo "<td> <a href='index.php?page=posts&source=edit_post&post_id=" . $register['post_id'] . "'> Edit </a> </td>"; 
    echo "</tr>";
}

function comments_html_table_row ($comment) {
    echo "<tr>";
    echo "<td> <input class='checkBoxes' type='checkbox' name='checkboxArray[]' value='" . $comment['comment_id'] . "'> </td>";
    echo "<td>" . $comment['comment_id'] . "</td>";
    echo "<td> <a href='../index.php?page=post&post_id=" . $comment['comment_post_id'] . "'>" . select_post_title_by_id($comment['comment_post_id']) . "</a> </td>";
    echo "<td>" . $comment['comment_author'] . "</td>";
    echo "<td>" . $comment['comment_email'] . "</td>";
    echo "<td>" . substr($comment['comment_content'], 0, 40) . "</td>";
    echo "<td>" . select_comment_status_title_by_id($comment['comment_status_id']) . "</td>";
    echo "<td>" . $comment['comment_date_time'] . "</td>";
    echo (isset($_GET['post_id']))
        ? "<td> <a href='index.php?page=comments&post_id=" . $_GET['post_id'] . "&source=approve_comment&comment_id=" . $comment['comment_id'] . "'> Approve </a> </td>"
            . "<td> <a href='index.php?page=comments&post_id=" . $_GET['post_id'] . "&source=unapprove_comment&comment_id=" . $comment['comment_id'] . "'> Unapprove </a> </td>"
            . "<td> <a class='delete-comment' data-toggle='modal' data-target='#myModal' href='' rel='{$comment['comment_id']}' rel2='{$_GET['post_id']}'> Delete </a> </td>"
            // . "<td> <a href='index.php?page=comments&post_id=" . $_GET['post_id'] . "&source=delete_comment&comment_id=" . $comment['comment_id'] . "'> Delete </a> </td>"
        : "<td> <a href='index.php?page=comments&source=approve_comment&comment_id=" . $comment['comment_id'] . "'> Approve </a> </td>"
            . "<td> <a href='index.php?page=comments&source=unapprove_comment&comment_id=" . $comment['comment_id'] . "'> Unapprove </a> </td>"
            . "<td> <a class='delete-comment' data-toggle='modal' data-target='#myModal' href='' rel='{$comment['comment_id']}'> Delete </a> </td>";
            // . "<td> <a href='index.php?page=comments&source=delete_comment&comment_id=" . $comment['comment_id'] . "'> Delete </a> </td>";
    echo "</tr>";
}

function users_html_table_row ($user) {
    echo "<tr>";
    echo "<td>" . $user['user_id'] . "</td>";
    echo "<td>" . $user['user_name'] . "</td>";
    echo "<td>" . $user['user_firstname'] . "</td>";
    echo "<td>" . $user['user_lastname'] . "</td>";
    echo "<td>" . $user['user_email'] . "</td>";
    echo "<td>" . $user['user_image'] . "</td>";
    echo "<td> <a href='index.php?page=posts&user_id=" . $user['user_id'] . "'>" . user_posts_count($user['user_id']) . "</td>";
    echo "<td>" . select_user_role_title_by_id($user['user_role_id']) . "</td>";
    echo "<td> <a class='delete-user' data-toggle='modal' data-target='#myModal' href='' rel='{$user['user_id']}'> Delete </a> </td>";
    // echo "<td> <a onClick=\"javascript: return confirm('Delete user?');\" href='index.php?page=users&source=user_delete&user_id=" . $user['user_id'] . "'> Delete </a> </td>";
    echo "<td> <a href='index.php?page=users&source=user_edit&user_id=" . $user['user_id'] . "'> Edit </a> </td>";
    echo "</tr>";
}

# ===================================================================================================
#TODO - Js scripts functions 

function dashboard_chart_script () {
    ?>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['bar']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
            ['Data', 'count'],
            ['Posts', <?php echo (int) dashboard_count('posts'); ?>],
            ['Comments', <?php echo (int) dashboard_count('comments'); ?>],
            ['Users', <?php echo (int) dashboard_count('users'); ?>],
            ['Categories', <?php echo (int) dashboard_count('categories'); ?>]
            ]);

            var options = {
            chart: {
                title: 'Statistics',
                subtitle: '',
            }
            };

            var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

            chart.draw(data, google.charts.Bar.convertOptions(options));
        }
    </script>
    <?php
}

# ===================================================================================================
#TODO - switcher functions 

function switch_page_content () { 
    if (isset($_GET['page'])) {
        switch ($_GET['page']) {
            case 'dashboard':
                include './includes/pg_dashboard.php';
                break;
            case 'posts':
                include './includes/pg_posts.php';
                break;
            case 'categories':
                include './includes/pg_categories.php';
                break;
            case 'comments':
                include './includes/pg_comments.php';
                break;
            case 'users':
                include './includes/pg_users.php';
                break;
            case 'profile':
                include './includes/pg_profile.php';
                break;
            case 'under_construction':
                include './includes/pg_under_construction.php';
                break;
            case 'logout':
                session_admin_logout();
                break;
        }
    } else {
        include './includes/pg_dashboard.php';
    }
}

function posts_page_switch () {
    if (isset($_GET['source'])) {
        switch ($_GET['source']) {
            case 'add_post':
                include "includes/post_add.php";
                break;
            case 'edit_post':
                include "includes/post_edit.php";
                break;
            case 'delete_post':
                $msg = delete_post();
                (isset($_GET['user_id']))
                    ? header("Location: index.php?page=posts&user_id={$_GET['user_id']}&msg=$msg")
                    : header("Location: index.php?page=posts&msg=$msg");
                break;
            default:
                include "includes/post_view_all.php";
                break;
        }
    } else {
        include "includes/post_view_all.php";
    }
}

function comments_switch () {
    if (isset($_GET['source'])) {
        switch ($_GET['source']) {
            case 'approve_comment':
                $msg = approve_comment();
                (isset($_GET['post_id']))
                    ? header("Location: index.php?page=comments&post_id={$_GET['post_id']}&msg=$msg")
                    : header("Location: index.php?page=comments&msg=$msg");
                break;
            case 'unapprove_comment':
                $msg = unapprove_comment();
                (isset($_GET['post_id']))
                    ? header("Location: index.php?page=comments&post_id={$_GET['post_id']}&msg=$msg")
                    : header("Location: index.php?page=comments&msg=$msg");
                break;
            case 'delete_comment':
                $msg = delete_comment();
                (isset($_GET['post_id']))
                    ? header("Location: index.php?page=comments&post_id={$_GET['post_id']}&msg=$msg")
                    : header("Location: index.php?page=comments&msg=$msg");
                break;
            default:
                header("Location: index.php?page=comments");
                break;
        }
    }
}

function users_page_switch () {
    if (isset($_GET['source'])) {
        switch ($_GET['source']) {
            case 'user_add':
                include "includes/user_add.php";
                break;
            case 'user_edit':
                include "includes/user_edit.php";
                break;
            case 'user_delete':
                $msg = delete_user();
                header("Location: index.php?page=users&source=view_all&msg=$msg");
                break;
            case 'view_all':
                include "includes/user_view_all.php";
                break;
        }
    }
}

# ===================================================================================================
#TODO - random functions 

function escape ($input) {
    global $connection;
    return mysqli_real_escape_string($connection, trim(strip_tags($input)));
}

function password_handle ($password) {
    $password = escape($password);
    $password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));
    return $password;
}

function redirect ($location) {
    header("Location: " . $location);
    exit;
}


?>