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
    $mail->Host       = 'smtp.titan.email';
    $mail->Username   = 'message.bot@jadersonrodrigues.com';
    $mail->Password   = 'Fx0JGrEVOo';
    $mail->Port       = 465;
    $mail->isHTML(true);
    $mail->CharSet = 'UTF-8';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}


function send_email_by_phpmailer ($to, $subject, $body) {
    global $mail;

    $mail->setFrom('message.bot@jadersonrodrigues.com');
    $mail->addAddress($to); 
    $mail->Subject = $subject;
    $mail->Body    = $body;
    $mail->AltBody = $alt_body;

    return $mail->send() ? true : false;
}

?>