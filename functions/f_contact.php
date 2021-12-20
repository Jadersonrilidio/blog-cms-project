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

    $to = 'jadersonrilidio@gmail.com';
    
    $subject = InputHandler::escape($_POST['subject']);
    $subject = wordwrap($subject, 70, "\n", true);
    
    $message = InputHandler::escape($_POST['message']);
    
    $email = InputHandler::escape($_POST['email']);
    $from = "From: ".$email;
    
    $result = mail($to, $subject, $message, $from);

    // AFTER UPDATE MAIL FUNCTION, USE THIS CODE FOR NOTIFICATIONS
    // if ($result) {
    //     ToastrBox::set_toastr_session(ToastrBox::MAIL_SENT);
    //     Permissions::redirect('contact');
    //     return true;
    // } else {
    //     return false;
    // }

    Notifications::set_toastr_session(Notifications::MAIL_SENT);
    Permissions::redirect('contact');
    return $result ? true : false;
}

?>