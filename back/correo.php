<?php 

use PHPMailer\PHPMailer\PHPMailer;

require_once 'PHPMailer/Exception.php';
require_once 'PHPMailer/PHPMailer.php';
require_once 'PHPMailer/SMTP.php';

$mail = new PHPMailer(true);





try{
    $mail->isSMTP();
    $mail->SMTPAuth = true;
    $mail->Username = "contacto.codigomedusa@gmail.com";
    $mail->Password = "kiom ihxi tjcm mzht";
    $mail->SMTPSecure = "ssl";
    $mail->Port = 465;
    $mail->Host = "smtp.gmail.com";
    
    $mail->SMTPDebug = 0;
    $mail->setFrom('contacto.codigomedusa@gmail.com', 'Codigo M');
    $mail->addAddress("luis.gnr@hotmail.com");
    $mail->Subject = "PHPMailer Gmail";
    $mail->Body = "This is the HTML message body in bold!";
    $mail->CharSet = "UTF-8";
    $mail->send();
}catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

?>