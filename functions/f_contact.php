<?php 

function set_user_email () {
    if (Permissions::is_logged()) {
        echo $_SESSION['user_email'];
    } else if (!empty($_POST['email'])){
        echo $_POST['email'];
    }
}

function set_subject () {
    if (!empty($_POST['subject'])) echo $_POST['subject'];
} 

function set_message () {
    if (!empty($_POST['message'])) echo $_POST['message'];
}

function send_email () {
    if (!isset($_POST['submit'])) return false;
    if (empty($_POST['email']) || empty($_POST['subject']) || empty($_POST['message'])) return false;
    
    $to = $_POST['email'];
    $subject = $_POST['subject'];
    $message =$_POST['message'];
    $body = <<<EOT
            <p> <strong> Email: </strong> {$to} </p>
            <p> <strong> Subject: </strong> {$subject} </p>
            <p style='text-align:justify'> {$message} </p>
        EOT;
    
    $result = send_email_by_phpmailer ($to, $subject, $body);

    Notifications::set_toastr_session(Notifications::MAIL_SENT);
    Permissions::redirect('contact');
    return $result ? true : false;
}

?>