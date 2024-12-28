<?php
// Incluir el archivo de conexión utilizando require_once
require_once 'conexion.php';

// Encabezados para indicar que la respuesta será en formato JSON
header('Content-Type: application/json');

// Verificar si la solicitud es GET o POST
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Si es una solicitud GET, verificar si se pasó un parámetro 'id'
    if (isset($_GET['id'])) {
        // Obtener el ID del estado desde la URL
        $id = $_GET['id'];

        // Consulta para obtener el estado por ID
        $sql = "SELECT id, descripcion FROM estados WHERE id = $id";
        $result = $conn->query($sql);

        // Verificar si se encontró el estado
        if ($result->num_rows > 0) {
            // Obtener el estado
            $estado = $result->fetch_assoc();
            // Devolver el estado en formato JSON
            echo json_encode($estado);
        } else {
            // Si no se encuentra el estado, devolver un mensaje de error
            echo json_encode(["error" => "Estado no encontrado"]);
        }
    } else {
        // Si no se pasó un ID, obtener todos los estados
        $sql = "SELECT id, descripcion FROM estados";
        $result = $conn->query($sql);

        // Verificar si hay resultados
        if ($result->num_rows > 0) {
            // Crear un array para almacenar los estados
            $estados = [];

            // Obtener cada fila de la consulta y agregarla al array
            while($row = $result->fetch_assoc()) {
                $estados[] = $row;
            }

            // Devolver todos los estados en formato JSON
            echo json_encode($estados);
        } else {
            // Si no hay estados, devolver un array vacío
            echo json_encode([]);
        }
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Si es una solicitud POST, insertar un nuevo estado

    // Obtener los datos del cuerpo de la solicitud JSON
    $data = json_decode(file_get_contents('php://input'), true);

    // Verificar si la descripción del estado está presente
    if (isset($data['descripcion'])) {
        // Preparar la consulta para insertar el nuevo estado
        $descripcion = $data['descripcion'];

        // Consulta para insertar el nuevo estado
        $sql = "INSERT INTO estados (descripcion) VALUES ('$descripcion')";
        
        if ($conn->query($sql) === TRUE) {
            // Si la inserción es exitosa, devolver el nuevo estado con su ID
            $nuevo_estado = [
                'id' => $conn->insert_id, // Obtener el ID generado
                'descripcion' => $descripcion
            ];
            echo json_encode($nuevo_estado);
        } else {
            // Si hay un error en la inserción, devolver un mensaje de error
            echo json_encode(["error" => "Error al insertar el estado: " . $conn->error]);
        }
    } else {
        // Si falta la descripción, devolver un mensaje de error
        echo json_encode(["error" => "Falta la descripción del estado"]);
    }
}

// Cerrar la conexión
$conn->close();
?>
