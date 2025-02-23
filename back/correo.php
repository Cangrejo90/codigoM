<?php 
use PHPMailer\PHPMailer;
use PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

$mail = new PHPMailer(true);

try{
    $mail->isSMTP();
    $mail->SMTPAuth = true;
    $mail->Username = $emailFromConfig->getValor();
    $mail->Password = $emailPassConfig->getValor();
    $mail->SMTPSecure = $emailSecureConfig->getValor();
    $mail->Port = $emailPortConfig->getValor();
    $mail->Host = $emailHostConfig->getValor();
    
    $mail->SMTPDebug = 0;
    $mail->setFrom("luis.gnr@hotmail.com");
    $mail->addAddress($item);
    $mail->Subject = $email->getAsunto();
    $mail->Body = $email->getMensaje();
    $mail->CharSet = "UTF-8";
    $mail->send();
}catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

?>