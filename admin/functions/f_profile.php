<?php

// function edit_user () {
//     if (!isset($_POST['user_edit'])) return "";

//     if (empty($_POST['user_name'])) return "Must insert username...";
//     if (empty($_POST['user_firstname'])) return "Must insert first name...";
//     if (empty($_POST['user_lastname'])) return "Must insert last name...";
//     if (empty($_POST['user_email'])) return "Must insert email...";
//     if (empty($_POST['user_role_id'])) return "Must insert role...";

//     $user_id = $_GET['user_id'];
//     $user_name = $_POST['user_name'];
//     $user_firstname = $_POST['user_firstname'];
//     $user_lastname = $_POST['user_lastname'];
//     $user_email = $_POST['user_email'];
//     $user_role_id = $_POST['user_role_id'];

//     $user_image = $_FILES['user_image']['name'];
//     if (empty($user_image)) $user_image = get_user_image_by_id($user_id);
//     $user_image_temp = $_FILES['user_image']['tmp_name'];

//     $query = "UPDATE users SET ";
//     $query .= "user_name = '$user_name', ";
//     $query .= "user_firstname = '$user_firstname', ";
//     $query .= "user_lastname = '$user_lastname', ";
//     $query .= "user_email = '$user_email', ";
//     $query .= "user_image = '$user_image', ";
//     $query .= "user_role_id = '$user_role_id' ";
//     $query .= "WHERE user_id = $user_id ";

//     QueryHandler::query_handler($query, 'result');

//     move_uploaded_file($user_image_temp, "../images/$user_image");

//     return "User successfully updated!";
// }

// function get_user_image_by_id ($user_id) { 
//     $query = "SELECT * FROM users WHERE user_id = $user_id";
//     $result = QueryHandler::query_handler($query, 'result');

//     $register = mysqli_fetch_assoc($result);

//     return $register['user_image'];
// }

// function get_session_admin_variables () {
//     if ($_SESSION['user_id'] !== null && isset($_POST['user_edit'])) {
//         $_SESSION['user_name'] = $_POST['user_name'];
//         $_SESSION['user_firstname'] = $_POST['user_firstname'];
//         $_SESSION['user_lastname'] = $_POST['user_lastname'];
//         $_SESSION['user_role_id'] = $_POST['user_role_id'];
//         $_SESSION['user_email'] = $_POST['user_email'];
//     } 
// }

// function get_user_by_session_id () { 
//     $user_id = $_SESSION['user_id'];

//     $query = "SELECT * FROM users WHERE user_id = $user_id";
//     $result = QueryHandler::query_handler($query, 'result');

//     $register = mysqli_fetch_assoc($result);

//     return $register;
// }


// TODO - Newly exported functions 


$user_id = $_SESSION['user_id'];
$user_name = $_SESSION['user_name'];
$user_email = $_SESSION['user_email'];
$user_role_id = $_SESSION['user_role_id'];
$user_image = isset($_SESSION['user_img']) ? $_SESSION['user_img'] : NULL;


function select_user_language ($lang) {
    $user_lang = User::select_user_lang($_SESSION['user_id']);
    if ($user_lang == $lang) echo "selected='selected'";
}

function profile_image_source () {
    global $user_image;
    return ($user_image != NULL) 
        ? Config::REL_PATH."images/{$user_image}"
        : "http://placehold.it/240x240/000000/FFFFFF?text=".PROFILE_IMG_PLACEHOLD;
}

function change_password () {
    if(!isset($_POST['change_password'])) return false;
    if (empty($_POST['old_password']) || empty($_POST['new_password']) || empty($_POST['rpt_password'])) return false;
    if (!validate_password()) return false;
    if ($_POST['new_password'] != $_POST['rpt_password']) return false;

    $password = InputHandler::password_handler($_POST['new_password']);
    $id = $_SESSION['user_id'];

    $stmt = User::update_password_by_id($password, $id);
    
    if ($stmt) {
        $user = User::get_last_inserted_user($id);
        MySessionHandler::login_registered_user($user);
        Notifications::set_toastr_session(Notifications::PASSWORD_RESET);
        Permissions::redirect('admin/profile');
        return true;
    }
    return false;
}

function validate_password () {
    $user_password = InputHandler::escape($_POST['old_password']);
    $password = User::select_password($_SESSION['user_id']);
    return password_verify($user_password, $password);
}

function update_user () {
    if(!isset($_POST['submit'])) return false;
    if(empty($_POST['user_name']) || empty($_POST['user_email'])) return false;
    if(User::username_exists($_POST['user_name']) && $_POST['user_name'] != $_SESSION['user_name']) return false;
    if(User::email_exists($_POST['user_email']) && $_POST['user_email'] != $_SESSION['user_email']) return false;

    $id = $_SESSION['user_id'];
    $username = InputHandler::escape($_POST['user_name']);
    $email = InputHandler::escape($_POST['user_email']);
    $language = isset($_POST['user_lang']) ? $_POST['user_lang'] : NULL;

    $image = (!empty($_FILES['user_img']['name'])) ? ($_FILES['user_img']['name']) : NULL;
    $image_temp = (!empty($_FILES['user_img']['name'])) ? $_FILES['user_img']['tmp_name']: NULL;

    $stmt = User::update_user($id, $username, $email, $language, $image);
    if ($stmt) {
        move_uploaded_file($image_temp, Config::REL_PATH."images/{$image}");
        MySessionHandler::session_login($id, $username, $_SESSION['user_role_id'], $email, $language, $image);
        Notifications::set_toastr_session(Notifications::USER_UPDATED);
        Permissions::redirect('admin/profile');
        return true;
    }
    return false;
}




?>