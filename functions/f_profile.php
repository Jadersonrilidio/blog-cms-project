
<?php

Permissions::redirect_not_logged('index');

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
        Permissions::redirect('profile');
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
        Permissions::redirect('profile');
        return true;
    }
    return false;
}

?>