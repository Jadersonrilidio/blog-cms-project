<?php 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->SMTPDebug = 2;
    $mail->SMTPAuth   = true;
    $mail->SMTPSecure = 'ssl';
    $mail->Host       = 'smtp.titan.email';
    $mail->Username   = 'contato@jadersonrodrigues.com';
    $mail->Password   = 'hyXhqCBF6e';
    $mail->Port       = 465;
    $mail->isHTML(true);
    $mail->CharSet = 'UTF-8';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

function send_email_by_phpmailer ($to, $subject, $body) {
    global $mail;

    $mail->setFrom('contato@jadersonrodrigues.com');
    $mail->addAddress('contato@jadersonrodrigues.com');
    $mail->addReplyTo($to);
    $mail->Subject = $subject;
    //$mail->msgHTML(file_get_contents('message.html'), __DIR__);
    $mail->Body    = $body;

    if(!$mail->Send()) {
       echo "Mailer Error: " . $mail->ErrorInfo;
    } else {
       echo "Mensagem enviada com sucesso";
    }
}

?>