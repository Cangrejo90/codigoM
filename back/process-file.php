<?php
require_once 'conexion.php';

header('Content-Type: application/json');

$uploadDir = 'uploads/';
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

$total = count($_FILES['images']['name']);
$id_usuario = $_POST['id_usuario'] ?? 1;
$visible = $_POST['visible'] ?? 1;
$allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];

for ($i = 0; $i < $total; $i++) {
    $tmpFilePath = $_FILES['images']['tmp_name'][$i];

    if ($tmpFilePath != "") {
        // Validar tipo de archivo
        $fileType = strtolower(pathinfo($_FILES['images']['name'][$i], PATHINFO_EXTENSION));
        
        if (!in_array($fileType, $allowedTypes)) {
            echo json_encode(["status" => "error", "message" => "Tipo de archivo no permitido para {$_FILES['images']['name'][$i]}"]);
            continue; 
        }

        // Evitar sobreescritura usando un nombre único
        $newFilePath = $uploadDir . uniqid() . '_' . basename($_FILES['images']['name'][$i]);

        if (move_uploaded_file($tmpFilePath, $newFilePath)) {
            // Insertar en la base de datos
            $stmt = $conn->prepare("INSERT INTO fotos (url_foto, id_usuario, visible) VALUES (?, ?, ?)");
            $stmt->bind_param("sii", $newFilePath, $id_usuario, $visible);
            $stmt->execute();
            echo json_encode(["status" => "success", "url" => $newFilePath]);
        } else {
            echo json_encode(["status" => "error", "message" => "Error al mover el archivo."]);
        }
    }
}

?>
