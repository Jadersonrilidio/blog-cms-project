
<?php

// page variables - problems with use inside function;
$register = isset($_POST['user_register']) ? $_POST['user_register'] : NULL;
$username = !empty($_POST['user_name']) ? $_POST['user_name'] : NULL;
$email = !empty($_POST['user_email']) ? $_POST['user_email'] : NULL;
$password = !empty($_POST['user_password']) ? $_POST['user_password'] : NULL;
$password_rpt = !empty($_POST['repeat_password']) ? $_POST['repeat_password'] : NULL;


function register_user() {
    if (!is_valid_inserted_data()) return '';

    $username = InputHandler::escape($_POST['user_name']);
    $email = InputHandler::escape($_POST['user_email']);
    $password = InputHandler::password_handler($_POST['user_password']);

    $stmt = User::create_subscriber($username, $password, $email);
    $user_id = mysqli_stmt_insert_id($stmt);

    $user = User::get_last_inserted_user($user_id);
    MySessionHandler::login_registered_user($user);
    Notifications::set_toastr_session(Notifications::REGISTERED);
    Permissions::redirect('index');
}

function is_valid_inserted_data () {
    if (!isset($_POST['user_register'])) return false;
    if (empty($_POST['user_name'])) return false;
    if (empty($_POST['user_email'])) return false;
    if (empty($_POST['user_password'])) return false;
    if (empty($_POST['repeat_password'])) return false;
    if ($_POST['user_password'] != $_POST['repeat_password']) return false;
    if (User::username_exists($_POST['user_name'])) return false;
    if (User::email_exists($_POST['user_email'])) return false;
    return true;
}

?>