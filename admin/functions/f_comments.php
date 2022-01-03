<?php

//Page variables
$post_id = isset($_GET['post']) ? InputHandler::escape($_GET['post']) : NULL;
$author_id = isset($_GET['author']) ? InputHandler::escape($_GET['author']) : NULL;
$comment_id = set_comment_id();

function set_comment_id () {
    $id = NULL;
    if (isset($_GET['delete'])) $id = InputHandler::escape($_GET['delete']);
    if (isset($_GET['approve'])) $id = InputHandler::escape($_GET['approve']);
    if (isset($_GET['unapprove'])) $id = InputHandler::escape($_GET['unapprove']);
    return $id;
}

function comment_approve_unapprove_delete () { 
    global $comment_id;

    if (isset($_GET['delete'])) {
        Comment::delete($comment_id);
        Notifications::set_toastr_session(Notifications::COMMENT_DELETED);
    }
    if (isset($_GET['approve'])) {
        Comment::approve($comment_id);
        Notifications::set_toastr_session(Notifications::COMMENT_APPROVED);
    }
    if (isset($_GET['unapprove'])) {
        Comment::unapprove($comment_id);
        Notifications::set_toastr_session(Notifications::COMMENT_UNAPPROVED);
    }
    if ($comment_id) choose_correct_redirection();
}

function choose_correct_redirection () {
    global $post_id, $author_id;
    if ($post_id) {
        Permissions::redirect("admin/comments/post/{$post_id}");
    } else if ($author_id) {
        Permissions::redirect("admin/comments/post/{$author_id}");
    } else {
        Permissions::redirect('admin/comments');
    }
}

function echo_page_header () {
    global $post_id, $author_id;
    
    if ($post_id) {
        $post_title = Post::get_post_title_by_id($post_id);
        echo "Comments of Post '<a href='".Config::REL_PATH."post/{$post_id}'>{$post_title}</a>' Id: {$post_id} ";
    } else if ($author_id) {
        $author_name = User::select_user_name_by_id($author_id);
        echo "Comments of Author '<a href='".Config::REL_PATH."author/{$author_id}'>{$author_name}</a>' Id: {$author_id} ";   
    } else {
        echo "Comments";
    }
    
}

function echo_form_action_link () {
    global $post_id, $author_id;
    if ($post_id) {
        echo Config::ADMIN_REL_PATH."comments/post/".$post_id;
    } else if ($author_id) {
        echo Config::ADMIN_REL_PATH."comments/author/".$author_id;
    } else {
        echo Config::ADMIN_REL_PATH."comments";
    }
}

function catch_comment_id_array () {
    if (isset($_POST['checkboxArray'])) {
        $option = $_POST['bulk_options'];

        foreach ($_POST['checkboxArray'] as  $comment_id) {
            comment_action_switch($option, $comment_id);
        }

        toastr_correct_option($option);
        choose_correct_redirection();
    }
}

function comment_action_switch ($option, $comment_id) {
    switch ($option) {
        case 'null': break;
        case '1': Comment::approve($comment_id); break;
        case '2': Comment::unapprove($comment_id); break;
        case 'delete': Comment::delete($comment_id); break;
    }
}

function toastr_correct_option ($option) {
    switch ($option) {
        case 'null': break;
        case '1': Notifications::set_toastr_session(Notifications::COMMENT_SELECTION_APPROVED); break;
        case '2': Notifications::set_toastr_session(Notifications::COMMENT_SELECTION_UNAPPROVED); break;
        case 'delete': Notifications::set_toastr_session(Notifications::COMMENT_SELECTION_DELETED); break;
    }
}

function display_comments_on_table () {
    global $post_id, $author_id;
    $stmt = NULL;

    if ($post_id) {
        $stmt = Comment::TEST_select_all_to_display_on_table($post_id, 'post');
    } else if ($author_id) {
        $stmt = Comment::TEST_select_all_to_display_on_table($author_id, 'author');
    } else {
        $stmt = Comment::TEST_select_all_to_display_on_table();
    }
    
    mysqli_stmt_bind_result($stmt, $comment_id, $comment_content, $comment_datetime, $post_id, $post_title, $author_id, $author_name, $status_title);
    while(mysqli_stmt_fetch($stmt)) {
        comments_html_table_row($comment_id, $comment_content, $comment_datetime, $post_id, $post_title, $author_id, $author_name, $status_title);
    }
}

function comments_html_table_row ($comment_id, $comment_content, $comment_datetime, $post_id, $post_title, $author_id, $author_name, $status_title) {
    echo "<tr>";
    echo "<td> <input class='checkBoxes' type='checkbox' name='checkboxArray[]' value='{$comment_id}'> </td>";
    echo "<td>{$comment_id}</td>";
    echo "<td> <a href='".Config::REL_PATH."post/{$post_id}'>{$post_title}</a> </td>";
    echo "<td> <a href='".Config::REL_PATH."author/{$author_id}'>{$author_name}</a> </td>";
    echo "<td>".TextHandler::text_shrink($comment_content, 45)."</td>";
    echo "<td>{$status_title}</td>";
    echo "<td>{$comment_datetime}</td>";
    if (isset($_GET['post'])) {
        echo "<td> <a href='".Config::ADMIN_REL_PATH."comments/post/{$post_id}/approve/{$comment_id}'> Approve </a> </td>";
        echo "<td> <a href='".Config::ADMIN_REL_PATH."comments/post/{$post_id}/unapprove/{$comment_id}'> Unapprove </a> </td>";
        echo "<td> <a class='delete-comment' data-toggle='modal' data-target='#myModal' href='' cid='{$comment_id}' pid='{$post_id}'> Delete </a> </td>";
     } else if (isset($_GET['author'])) {
        echo "<td> <a href='".Config::ADMIN_REL_PATH."comments/author/{$author_id}/approve/{$comment_id}'> Approve </a> </td>";
        echo "<td> <a href='".Config::ADMIN_REL_PATH."comments/author/{$author_id}/unapprove/{$comment_id}'> Unapprove </a> </td>";
        echo "<td> <a class='delete-comment' data-toggle='modal' data-target='#myModal' href='' cid='{$comment_id}' aid='{$author_id}'> Delete </a> </td>";
     } else {
         echo "<td> <a href='".Config::ADMIN_REL_PATH."comments/approve/{$comment_id}'> Approve </a> </td>";
         echo "<td> <a href='".Config::ADMIN_REL_PATH."comments/unapprove/{$comment_id}'> Unapprove </a> </td>";
         echo "<td> <a class='delete-comment' data-toggle='modal' data-target='#myModal' href='' cid='{$comment_id}'> Delete </a> </td>";
     }
}

?>