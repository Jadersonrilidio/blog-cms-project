
<?php

function reset_password () {
    if (!isset($_POST['reset_password']) || !isset($_GET['email']) || !isset($_GET['token'])) return false;
    if (empty($_POST['user_password']) || empty($_POST['repeat_password'])) return false;
    if ($_POST['user_password'] != $_POST['repeat_password']) return false;

    $password = InputHandler::password_handler($_POST['user_password']);
    $email = InputHandler::escape($_GET['email']);

    $stmt = User::update_password_and_reset_token($password, $email);

    if (mysqli_stmt_affected_rows($stmt) > 0) {
        Notifications::set_toastr_session(Notifications::PASSWORD_RESET);
        Permissions::redirect('login');
    } else {
        return false; 
    }
}

function display_action_link () {
    $rel_path = InputHandler::escape(htmlspecialchars($_SERVER['PHP_SELF']));
    $email = InputHandler::escape($_GET['email']);
    $token = InputHandler::escape($_GET['token']);

    echo "{$rel_path}?email={$email}&token={$token}";
}

?>