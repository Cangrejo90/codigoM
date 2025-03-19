<?php 

use PHPMailer\PHPMailer\PHPMailer;

require_once 'PHPMailer/Exception.php';
require_once 'PHPMailer/PHPMailer.php';
require_once 'PHPMailer/SMTP.php';

require_once 'conexion.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    if (isset($data['correo'])) {
        $email = $data['correo'];

        $sql = "SELECT id,correo FROM usuarios WHERE correo = '$email'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $idUsuario = $row["id"];

            $sql2 = "SELECT id FROM codigo_restore WHERE id_usuario = $idUsuario";
            $result2 = $conn->query($sql2);
            if($result2->num_rows > 0){
                echo json_encode(["error" => "correo ya fue enviado revise spam"]);
            }else{
                $key_restore = substr(md5(time()), 0, 20);
                $sql = "INSERT INTO codigo_restore (key_restore,id_usuario) VALUES ('$key_restore',$idUsuario)";
                if ($conn->query($sql) === true) {
                    sendEmail($email,$key_restore);
                    echo json_encode("OK");
                }else{
                    echo json_encode(["error" => "Error al crea key de restaruacion: " . $conn->error]);
                }
            }
        } else {
            echo json_encode(["error" => "no se encontro correo" . $conn->error]);
        }
    } else {
        echo json_encode(["error" => "Falta el campo 'correo'"]);
    }
}

function sendEmail($email,$body){
    
    try{
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->SMTPAuth = true;
        $mail->Username = "contacto.codigomedusa@gmail.com";
        $mail->Password = "kiom ihxi tjcm mzht";
        $mail->SMTPSecure = "ssl";
        $mail->Port = 465;
        $mail->Host = "smtp.gmail.com";
        
        $mail->SMTPDebug = 0;
        $mail->setFrom('contacto.codigomedusa@gmail.com', 'Codigo M');
        $mail->addAddress($email);
        $mail->Subject = "Restarua contraseña";
        $mail->Body = "Ingrese al siguiente link http://localhost/codigo%20m/back/restore-password.php?key=$body";
        $mail->CharSet = "UTF-8";
        $mail->send();
    }catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>