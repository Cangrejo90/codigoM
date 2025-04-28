<?php
require_once 'conexion.php';

header('Content-Type: application/json');


if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $sql = "SELECT id, descripcion FROM ciudades WHERE id = $id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $ciudad = $result->fetch_assoc();
            echo json_encode($ciudad);
        } else {
            echo json_encode(["error" => "Ciudad no encontrada"]);
        }
    } else {
        $sql = "SELECT id, descripcion FROM ciudades WHERE id_estado = 1";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $ciudades = [];

            while($row = $result->fetch_assoc()) {
                $ciudades[] = $row;
            }

            echo json_encode($ciudades);
        } else {
            echo json_encode([]);
        }
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    if (isset($data['descripcion'])) {
        $descripcion = $data['descripcion'];

        $sql = "INSERT INTO ciudades (descripcion) VALUES ('$descripcion')";
        
        if ($conn->query($sql) === TRUE) {
            $nueva_ciudad = [
                'id' => $conn->insert_id, 
                'descripcion' => $descripcion
            ];
            echo json_encode($nueva_ciudad);
        } else {
            echo json_encode(["error" => "Error al insertar la ciudad: " . $conn->error]);
        }
    } else {
        echo json_encode(["error" => "Falta la descripción de la ciudad"]);
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $data = json_decode(file_get_contents('php://input'), true);

    if (isset($data['id']) && isset($data['descripcion'])) {
        $id = $data['id'];
        $descripcion = $data['descripcion'];

        $sql = "UPDATE ciudades SET descripcion = '$descripcion' WHERE id = $id";

        if ($conn->query($sql) === TRUE) {
            echo json_encode(['id' => $id, 'descripcion' => $descripcion]);
        } else {
            echo json_encode(["error" => "Error al actualizar el género: " . $conn->error]);
        }
    } else {
        echo json_encode(["error" => "Faltan datos necesarios (id, descripcion)"]);
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $data = json_decode(file_get_contents('php://input'), true);

    if (isset($data['id'])) {
        $id = $data['id'];

        $sql = "UPDATE ciudades SET id_estado = 0 WHERE id = $id";

        if ($conn->query($sql) === TRUE) {
            echo json_encode(['id' => $id]);
        } else {
            echo json_encode(["error" => "Error al actualizar el género: " . $conn->error]);
        }
    } else {
        echo json_encode(["error" => "Faltan datos necesarios (id)"]);
    }
}

$conn->close();
?>
