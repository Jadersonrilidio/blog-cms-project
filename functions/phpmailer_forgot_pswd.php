<?php 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->SMTPDebug = 2;
    $mail->SMTPSecure = 'ssl';
    $mail->SMTPAuth   = true; 
    $mail->Host       = Config::SMPT_HOST;
    $mail->Username   = Config::SMTP_USER;
    $mail->Password   = Config::SMTP_PASSWORD;
    $mail->Port       = Config::SMPT_PORT;
    $mail->isHTML(true);
    $mail->CharSet = 'UTF-8';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}


function send_email_by_phpmailer ($to, $subject, $body) {
    global $mail;

    $mail->setFrom('email@example.com');
    $mail->addAddress($to); 
    $mail->Subject = $subject;
    $mail->Body    = $body;
    $mail->AltBody = $alt_body;

    return $mail->send() ? true : false;
}

?>
