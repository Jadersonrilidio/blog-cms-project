<?php

//Page variables
$update_id = (isset($_GET['update'])) ? InputHandler::escape($_GET['update']) : NULL;
$delete_id = (isset($_GET['delete'])) ? InputHandler::escape($_GET['delete']) : NULL;

function add_category () {
    if (!isset($_POST['add']) || !Permissions::is_admin() || empty($_POST['cat_title'])) return false;

    $title = InputHandler::escape($_POST['cat_title']);
    $stmt = Category::create($title);
    if ($stmt) {
        Notifications::set_toastr_session(Notifications::CAT_CREATED);
        Permissions::redirect('admin/categories');
        return true;
    } else {
        return false;
    }
}

function delete_category () {
    global $delete_id;
    
    if ($delete_id == 1) return false; /* restriction: cannot delete neither alter base category */
    
    if (!isset($_GET['delete']) || !Permissions::is_admin() || !$delete_id) return false;

    $stmt = Category::delete($delete_id);
    if ($stmt) {
        Notifications::set_toastr_session(Notifications::CAT_DELETED);
        Permissions::redirect("admin/categories");
        return true;
    } else {
        return false;
    }
}

function update_category () {
    global $update_id;
    
    if ($update_id == 1 || $_POST['cat_id'] == 1) return false; /* restriction: cannot delete neither alter base category */
    
    if (!isset($_POST['update']) || !Permissions::is_admin() || empty($_POST['cat_title'])) return false;

    $title = InputHandler::escape($_POST['cat_title']);
    $id = $_POST['cat_id'];
    $stmt = Category::update($title, $id);
    if ($stmt) {
        Notifications::set_toastr_session(Notifications::CAT_UPDATED);
        Permissions::redirect("admin/categories");
        return true;
    } else {
        return false;
    }
}

function display_category_to_update () {
    global $update_id;
    if (!$update_id) return false;
    $stmt = Category::get_category_by_id($update_id);
    mysqli_stmt_bind_result($stmt, $id, $title);
    mysqli_stmt_fetch($stmt);
    category_html_update_form($id, $title);
}

function category_html_update_form ($id, $title) {
    ?>
    <form action="<?php echo Config::ADMIN_REL_PATH."categories/update/{$id}"; ?>" method="POST">                   
        <div class="form-group">
            <label for="cat_title"> Update category <?php echo $title." - ".$id; FormErrorMsg::category_has_title_to_edit(); ?> </label>
            <input value="<?php echo $title; ?>" type="text" name="cat_title" class="form-control" placeholder="Type the category name here...">
            <input value="<?php echo $id; ?>" type="hidden" name="cat_id" class="form-control">
        </div>
        <div class="form-group">
            <input class="btn btn-primary" type="submit" name="update" value="Update category">
        </div>
    </form> 
    <?php
}

function display_categories_on_table () {
    $stmt = Category::select_to_display_on_table();
    mysqli_stmt_bind_result($stmt, $id, $title);

    while (mysqli_stmt_fetch($stmt)) {
        category_html_table_row($id, $title);
    }
}

function category_html_table_row ($id, $title) {
    echo "<tr>";
    echo "<td>{$id}</td>";
    echo "<td>{$title}</td>";
    echo "<td> <a class='delete-category' data-toggle='modal' data-target='#myModal' href='' rel='{$id}'> Delete </a> </td>";
    echo "<td> <a href='".Config::ADMIN_REL_PATH."categories/update/{$id}'> Edit </a> </td>";
    echo "</tr>";
}

?>