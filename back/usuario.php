<?php
require_once 'conexion.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $sql = "SELECT id, usuario, password, correo, id_rol, id_estado FROM usuarios WHERE id = $id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $usuario = $result->fetch_assoc();
            echo json_encode($usuario);
        } else {
            echo json_encode(["error" => "Usuario no encontrado"]);
        }
    } else {
        $sql = "SELECT id, usuario, password, correo, id_rol, id_estado FROM usuarios";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $usuarios = [];

            while($row = $result->fetch_assoc()) {
                $usuarios[] = $row;
            }

            echo json_encode($usuarios);
        } else {
            echo json_encode([]);
        }
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    if (isset($data['usuario']) && isset($data['password']) && isset($data['correo']) && isset($data['id_rol']) && isset($data['id_estado'])) {
        $usuario = $data['usuario'];
        $password = password_hash($data['password'], PASSWORD_BCRYPT); 
        $correo = $data['correo'];
        $id_rol = $data['id_rol'];
        $id_estado = $data['id_estado'];

        $sql = "INSERT INTO usuarios (usuario, password, correo, id_rol, id_estado) VALUES ('$usuario', '$password', '$correo', $id_rol, $id_estado)";
        
        if ($conn->query($sql) === TRUE) {
            $nuevo_usuario = [
                'id' => $conn->insert_id,
                'usuario' => $usuario,
                'correo' => $correo,
                'id_rol' => $id_rol,
                'id_estado' => $id_estado
            ];
            echo json_encode($nuevo_usuario);
        } else {
            echo json_encode(["error" => "Error al insertar el usuario: " . $conn->error]);
        }
    } else {
        echo json_encode(["error" => "Faltan datos para crear el usuario"]);
    }
}

$conn->close();
?>
