<?php 

// Page Variables
$page_role = (isset($_GET['role'])) ? InputHandler::escape($_GET['role']) : NULL;

function echo_form_action_link () {
    global $page_role;
    if ($page_role) {
        echo Config::ADMIN_REL_PATH."users/".$page_role;
    } else {
        echo Config::ADMIN_REL_PATH."users";
    }
}

function catch_user_id_array () {
    if (isset($_POST['checkboxArray'])) {
        $option = $_POST['bulk_options'];

        foreach ($_POST['checkboxArray'] as  $user_id) {
            user_action_switch($option, $user_id);
        }
        toastr_correct_option($option);
        choose_correct_redirection();
    }
}

function user_action_switch ($option, $user_id) {
    
    if ($user_id == 1) return false; /* restriction: avoiding malicious user to alter master admin */
    
    switch ($option) {
        case 'null': break;
        case '1': User::change_role(1, $user_id); break;
        case '2': User::change_role(2, $user_id); break;
    }
}

function toastr_correct_option ($option) {
    switch ($option) {
        case 'null': break;
        case '1': Notifications::set_toastr_session(Notifications::USER_SELECTION_ROLE_ADMIN); break;
        case '2': Notifications::set_toastr_session(Notifications::USER_SELECTION_ROLE_SUBSCRIBER); break;
    }
}

function choose_correct_redirection () {
    global $page_role;
    if ($page_role) {
        Permissions::redirect("admin/users/{$page_role}");
    } else {
        Permissions::redirect('admin/users');
    }
}

function echo_user_page_head () {
    echo (isset($_GET['role'])) 
        ? ( ($_GET['role']==1) ? "Admin Users" : "Subscribers" ) 
        : "Users";
}

function display_all_users_on_table () {
    global $page_role;

    $stmt = User::select_all_to_display_on_table($page_role);
    mysqli_stmt_bind_result($stmt, $id, $name, $email, $image, $lang, $role_title);
    while (mysqli_stmt_fetch($stmt)) {
        users_html_table_row($id, $name, $email, $image, $lang, $role_title);
    }
}

function users_html_table_row ($id, $name, $email, $image, $lang, $role_title) {
    global $page_role;
    echo "<tr>";
    echo "<td> <input class='checkBoxes' type='checkbox' name='checkboxArray[]' value='{$id}'> </td>";
    echo "<td>{$id}</td>";
    echo "<td> <a href='".Config::REL_PATH."author/{$id}'>{$name}</a></td>";
    echo "<td>{$email}</td>";
    echo "<td>{$image}</td>";
    echo "<td>{$lang}</td>";
    echo "<td> <a href='".Config::ADMIN_REL_PATH."posts/{$id}'>".User::posts_count($id)."</td>";
    echo "<td> <a href='".Config::ADMIN_REL_PATH."comments/author/{$id}'>".User::comments_count($id)."</td>";
    echo "<td>{$role_title}</td>";
    if ($page_role) {
        echo "<td> <a href='".Config::ADMIN_REL_PATH."users/{$page_role}/toadm/{$id}'> Admin </td>";
        echo "<td> <a href='".Config::ADMIN_REL_PATH."users/{$page_role}/tosub/{$id}'> Subscriber </td>";
    } else {
        echo "<td> <a href='".Config::ADMIN_REL_PATH."users/toadm/{$id}'> Admin </td>";
        echo "<td> <a href='".Config::ADMIN_REL_PATH."users/tosub/{$id}'> Subscriber </td>";
    }
    echo "</tr>";
}

function update_role () {
    global $page_role;
    if (!isset($_GET['toadm']) && !isset($_GET['tosub'])) return false;
    
    $stmt = NULL;
    if (isset($_GET['toadm'])) {
        
        if ($_GET['toadm'] == 1) return false; /* restriction: avoiding malicious user to alter master admin */
        
        $user_id = $_GET['toadm'];
        $stmt = User::change_role(1, $user_id);
        if ($stmt) Notifications::set_toastr_session(Notifications::USER_ROLE_ADMIN);
    } else if (isset($_GET['tosub'])) {
        
        if ($_GET['tosub'] == 1) return false; /* restriction: avoiding malicious user to alter master admin */
        
        $user_id = $_GET['tosub'];
        $stmt = User::change_role(2, $user_id);
        if ($stmt) Notifications::set_toastr_session(Notifications::USER_ROLE_SUBSCRIBER);
    }
    return ($stmt) ? Permissions::redirect($page_role ? "admin/users/{$page_role}" : 'admin/users') : false;
}

?>