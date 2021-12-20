<?php 

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                   //Enable verbose debug output
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable implicit TLS encryption
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Host       = Config::SMPT_HOST;                      //Set the SMTP server to send through
    $mail->Username   = Config::SMTP_USER;                      //SMTP username
    $mail->Password   = Config::SMTP_PASSWORD;                  //SMTP password
    $mail->Port       = Config::SMPT_PORT;                      //SMTP port
    $mail->isSMTP();                                            //Send using SMTP
    $mail->isHTML(true);                                        //Set email format to HTML
    $mail->CharSet = 'UTF-8';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}


function send_email_by_phpmailer ($from, $to, $subject, $body, $from_name=NULL, $to_name=NULL, $alt_body=NULL) {
    global $mail;

    $mail->setFrom($from, $from_name);
    $mail->addAddress($to, $to_name); 

    $mail->Subject = $subject;
    $mail->Body    = $body;
    $mail->AltBody = $alt_body;

    return $mail->send() ? true : false;
}

?>