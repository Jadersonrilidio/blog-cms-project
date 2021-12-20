
<?php

function forgot_password_mail () {
    if (!isset($_POST['send_email'])) return false;
    if (empty($_POST['user_email'])) return false;

    $email = InputHandler::escape($_POST['user_email']);
    if (!User::email_exists($email)) return false;

    $length = 50;
    $token = bin2hex(openssl_random_pseudo_bytes($length));

    $stmt = User::set_token($token, $email);
    mysqli_stmt_close($stmt);   

    $from = 'system.bot@mail.com';
    $to = $email;
    $subject = 'Reset password';
    $body = "<p> Please click on the link below to reset your password: </p> <br>
        <a href='http://localhost/projects/cms/reset?email={$email}&token={$token}'> 
        http://localhost/projects/cms/reset?email={$email}&token={$token} </a> ";

    $result = send_email_by_phpmailer($from, $to, $subject, $body,) ? true : false;

    if ($result) Notifications::set_toastr_session(Notifications::MAIL_SENT);

    return MySessionHandler::uniqid_handler($result) ? true : false;
}


?>