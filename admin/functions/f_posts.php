<?php

// Page Variables
$post_id = set_post_id();
$author = isset($_GET['author']) ? InputHandler::escape($_GET['author']) : NULL;

//TODO - Post Page Functions: 

function set_post_id () {
    $id = NULL;
    if (isset($_GET['edit'])) $id = InputHandler::escape($_GET['edit']);
    if (isset($_GET['publish'])) $id = InputHandler::escape($_GET['publish']);
    if (isset($_GET['draft'])) $id = InputHandler::escape($_GET['draft']);
    if (isset($_GET['delete'])) $id = InputHandler::escape($_GET['delete']);
    return $id;
}

function post_page_title () {
    global $post_id, $author;
    $post_title = ($post_id) ? Post::get_post_title_by_id($post_id) : NULL;

    if (isset($_GET['add'])) return "Add Post";
    if (isset($_GET['edit'])) return "Edit Post '<a href='".Config::REL_PATH."post/{$post_id}'>{$post_title}</a>' Id: {$post_id}";
    if (isset($_GET['author'])) return User::select_user_name_by_id($author)."'s Posts";
    return "Posts";
}

function posts_page_includes () {
    if (isset($_GET['add'])) {
        include "includes/post_add.php";
    } else if (isset($_GET['edit'])) {
        include "includes/post_edit.php";
    } else {
        include "includes/post_view_all.php";
    }
}

//TODO - Post View All Functions 

function post_view_all_form_action_link () {
    global $author;
    return ($author) ? Config::ADMIN_REL_PATH."posts/{$author}" : Config::ADMIN_REL_PATH."posts";
}

function catch_post_id_array () {
    if (isset($_POST['checkboxArray'])) {
        $option = $_POST['bulk_options'];

        foreach ($_POST['checkboxArray'] as $post_id) {
            post_action_switch($option, $post_id);
        }
        toastr_correct_option($option);
        choose_correct_redirection();
    }
}

function post_action_switch ($option, $post_id) {
    if (!Permissions::is_admin()) return false;
    
    if ($post_id == 1) return false; /* restriction: cannot delete nor alter base post */
    
    switch ($option) {
        case 'null': break;
        case '1': Post::publish($post_id); break;
        case '2': Post::draft($post_id); break;
        case 'clone': Post::clone($post_id); break;
        case 'delete': Post::delete($post_id); break;
    }
}

function toastr_correct_option ($option) {
    switch ($option) {
        case 'null': break;
        case '1': Notifications::set_toastr_session(Notifications::POST_SELECTION_PUBLISHED); break;
        case '2': Notifications::set_toastr_session(Notifications::POST_SELECTION_TO_DRAFT); break;
        case 'clone': Notifications::set_toastr_session(Notifications::POST_SELECTION_CLONED); break;
        case 'delete': Notifications::set_toastr_session(Notifications::POST_SELECTION_DELETED); break;
    }
}

function choose_correct_redirection () {
    global $author;
    if ($author) {
        Permissions::redirect("admin/posts/{$author}");
    } else {
        Permissions::redirect('admin/posts');
    }
}

function display_posts_on_table () {
    global $author;
    $stmt = $author ? Post::select_posts_to_display_on_table($author) : Post::select_posts_to_display_on_table();
    mysqli_stmt_bind_result($stmt, $post_id, $post_title, $post_datetime, $post_image, $post_content, $post_tags, $cat_title, $author_id, $author_name, $status_title);
    while(mysqli_stmt_fetch($stmt)) {
        posts_html_table_row($post_id, $post_title, $post_datetime, $post_image, $post_content, $post_tags, $cat_title, $author_id, $author_name, $status_title);
    }
}

function posts_html_table_row ($post_id, $post_title, $post_datetime, $post_image, $post_content, $post_tags, $cat_title, $author_id, $author_name, $status_title) {
    global $author;
    echo "<tr>";
    echo "<td style='vertical-align:middle;'> <input class='checkBoxes' type='checkbox' name='checkboxArray[]' value='{$post_id}'> </td>";
    echo "<td style='vertical-align:middle;'>{$post_id}</td>";
    echo "<td style='vertical-align:middle;'> <a href='".Config::REL_PATH."author/{$author_id}'>{$author_name}</a> </td>";
    echo "<td style='vertical-align:middle;'> <a href='".Config::REL_PATH."post/{$post_id}'>{$post_title}</a> </td>";
    echo "<td style='vertical-align:middle;'>{$cat_title}</td>";
    echo "<td style='vertical-align:middle;'>{$status_title}</td>";
    echo "<td style='vertical-align:middle;'> <img width='100' src='".Config::REL_PATH."images/{$post_image}' alt='image'> </td>";
    echo "<td style='vertical-align:middle;'>{$post_tags}</td>";
    echo "<td style='text-align:center'>".TextHandler::text_shrink($post_content, 45)."</td>"; 
    echo "<td style='vertical-align:middle;'> <a href='".Config::ADMIN_REL_PATH."comments/post/{$post_id}'>".Post::post_comment_count($post_id)."</a> </td>";
    echo "<td style='vertical-align:middle;'>{$post_datetime}</td>";
    echo ($author)
        ? "<td style='vertical-align:middle;'> <a class='delete-post' data-toggle='modal' data-target='#myModal' href='' pid='{$post_id}' uid='{$author}'> Delete </a> </td>"       
        : "<td style='vertical-align:middle;'> <a class='delete-post' data-toggle='modal' data-target='#myModal' href='' pid='{$post_id}'> Delete </a> </td>";
    echo ($post_id == 1)
        ? "<td style='vertical-align:middle;'> <a href='#'> Edit </a> </td>" /* restriction: cannot delete nor alter base post */
        : "<td style='vertical-align:middle;'> <a href='".Config::ADMIN_REL_PATH."posts/edit/{$post_id}'> Edit </a> </td>"; 
    echo "</tr>";
}

function delete_post () {
    global $post_id, $author;
    
     if ($post_id == 1) return false; /* restriction: cannot delete nor alter base post */
    
    if (!isset($_GET['delete']) || !Permissions::is_admin()) return false;
    $stmt = Post::delete($post_id);
    if ($stmt) {
        Notifications::set_toastr_session(Notifications::POST_DELETED);
        Permissions::redirect($author ? "admin/posts/{$author}" : "admin/posts");
        return true;
    } else {
        return false;
    }
}

//TODO - Post Add Functions 

function echo_post_title () {
    if (!empty($_POST['post_title'])) echo $_POST['post_title'];
}
function echo_post_tags () {
    if (!empty($_POST['post_tags'])) echo $_POST['post_tags'];
}
function echo_post_content () {
    if (!empty($_POST['post_content'])) echo $_POST['post_content'];
}

function create_post () {
    if (!before_create_validate()) return false;

    $title = InputHandler::escape($_POST['post_title']);
    $cat_id = InputHandler::escape($_POST['post_category_id']);
    $author = InputHandler::escape($_POST['post_author']);
    $status_id = InputHandler::escape($_POST['post_status_id']);
    $content = ($_POST['post_content']);
    $tags = !empty($_POST['post_tags']) ? InputHandler::escape($_POST['post_tags']) : NULL;
    $image = $_FILES['post_image']['name'];
    $image_temp = $_FILES['post_image']['tmp_name'];
    
    $stmt = Post::create($title, $cat_id, $author, $content, $image, $tags, $status_id);
    move_uploaded_file($image_temp, "../images/$image");
    if ($stmt) {
        Notifications::set_toastr_session(Notifications::POST_CREATED);
        Permissions::redirect('admin/posts');
        return true;
    } else {
        return false;
    }
}

function before_create_validate () {
    if (!isset($_POST['submit'])) return false;
    if (!Permissions::is_admin()) return false;
    if (empty($_POST['post_title'])) return false;
    if (empty($_POST['post_author'])) return false;
    if (empty($_POST['post_category_id'])) return false;
    if (empty($_POST['post_status_id'])) return false;
    if (empty($_FILES['post_image']['name'])) return false;
    if (empty($_POST['post_content'])) return false;
    return true;
}

function user_admin_options_menu ($author_id=NULL) {
    $author = get_correct_author($author_id);
    $stmt = User::select_all_admin_id_name();
    mysqli_stmt_bind_result($stmt, $id, $name);
    
    while (mysqli_stmt_fetch($stmt)) {
        echo ($id == $author)
            ? "<option selected='selected' value='{$id}'>{$name}</option>"
            : "<option value='{$id}'>{$name}</option>";
    }
}
function get_correct_author ($author_id=null) {
    $author = ($author_id) 
        ? $author_id 
        : (!empty($_POST['post_author']) ? $_POST['post_author'] : NULL);
    return $author;
}

function category_options_menu ($cat_id=NULL) {
    $cat_id = get_correct_cat_id($cat_id);
    $stmt = Category::select_category_id_title();
    mysqli_stmt_bind_result($stmt, $id, $title);

    while (mysqli_stmt_fetch($stmt)) {
        echo ($id == $cat_id) 
            ? "<option selected='selected' value='{$id}'>{$title}</option>" 
            : "<option value='{$id}'>{$title}</option>";
    }
}
function get_correct_cat_id ($cat_id=NULL) {
    $cat_id = ($cat_id) 
        ? $cat_id 
        : (!empty($_POST['post_category_id']) ? $_POST['post_category_id'] : NULL);
    return $cat_id;
}

function post_status_options_menu ($status_id=NULL) {
    $status = get_correct_status($status_id);
    $stmt = Post::select_post_status_id_title();
    mysqli_stmt_bind_result($stmt, $id, $title);

    while (mysqli_stmt_fetch($stmt)) {
        echo ($id == $status)
            ? "<option selected='selected' value='{$id}'>{$title}</option>"
            : "<option value='{$id}'>{$title}</option>";
    }
}
function get_correct_status ($status_id=NULL) {
    $status = ($status_id) 
        ? $status_id
        : (!empty($_POST['post_status_id']) ? $_POST['post_status_id'] : NULL);
    return $status;
}

//TODO - Post Edit Functions

function echo_post_edit_form_action () {
    global $post_id;
    echo Config::ADMIN_REL_PATH."posts/edit/{$post_id}";
}

function update_post () {
    if (!before_update_validate()) return false;
    
    if ($_POST['post_id'] == 1) return false; /* restriction: cannot delete nor alter base post */
    
    $id = InputHandler::escape($_POST['post_id']);
    $title = InputHandler::escape($_POST['post_title']);
    $tags = InputHandler::escape($_POST['post_tags']);
    $content = ($_POST['post_content']);
    $cat_id = ($_POST['post_category_id']);
    $author = ($_POST['post_author']);
    $status_id = ($_POST['post_status_id']);
    $datetime = ($_POST['post_date_time']);
    
    $image = (!empty($_FILES['post_image']['name'])) ? ($_FILES['post_image']['name']) : Post::get_image_by_id($id);
    $image_temp = $_FILES['post_image']['tmp_name'];

    if (empty($image)) return false;
      
    $stmt = Post::update($cat_id, $title, $author, $datetime, $image, $content, $tags, $status_id, $id);    
    move_uploaded_file($image_temp, "../images/$image");
    if ($stmt) {
        Notifications::set_toastr_session(Notifications::POST_UPDATED);
        Permissions::redirect('admin/posts');
        return true;
    } else {
        return false;
    }
}

function before_update_validate () {
    if (!isset($_POST['submit'])) return false;
    if (!Permissions::is_admin()) return false;
    if (empty($_POST['post_category_id'])) return false;
    if (empty($_POST['post_title'])) return false;
    if (empty($_POST['post_author'])) return false;
    if (empty($_POST['post_status_id'])) return false;
    if (empty($_POST['post_content'])) return false;
    return true;
}

function select_post_attr_to_edit () {
    global $post_id;
    return Post::get_post_attr_to_edit($post_id);
}

?>