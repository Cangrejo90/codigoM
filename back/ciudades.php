<?php
// Incluir el archivo de conexión utilizando require_once
require_once 'conexion.php';

// Encabezados para indicar que la respuesta será en formato JSON
header('Content-Type: application/json');

// Verificar si la solicitud es GET o POST
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Si es una solicitud GET, verificar si se pasó un parámetro 'id'
    if (isset($_GET['id'])) {
        // Obtener el ID de la ciudad desde la URL
        $id = $_GET['id'];

        // Consulta para obtener la ciudad por ID
        $sql = "SELECT id, descripcion FROM ciudades WHERE id = $id";
        $result = $conn->query($sql);

        // Verificar si se encontró la ciudad
        if ($result->num_rows > 0) {
            // Obtener la ciudad
            $ciudad = $result->fetch_assoc();
            // Devolver la ciudad en formato JSON
            echo json_encode($ciudad);
        } else {
            // Si no se encuentra la ciudad, devolver un mensaje de error
            echo json_encode(["error" => "Ciudad no encontrada"]);
        }
    } else {
        // Si no se pasó un ID, obtener todas las ciudades
        $sql = "SELECT id, descripcion FROM ciudades";
        $result = $conn->query($sql);

        // Verificar si hay resultados
        if ($result->num_rows > 0) {
            // Crear un array para almacenar las ciudades
            $ciudades = [];

            // Obtener cada fila de la consulta y agregarla al array
            while($row = $result->fetch_assoc()) {
                $ciudades[] = $row;
            }

            // Devolver todas las ciudades en formato JSON
            echo json_encode($ciudades);
        } else {
            // Si no hay ciudades, devolver un array vacío
            echo json_encode([]);
        }
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Si es una solicitud POST, insertar una nueva ciudad

    // Obtener los datos del cuerpo de la solicitud JSON
    $data = json_decode(file_get_contents('php://input'), true);

    // Verificar si la descripción de la ciudad está presente
    if (isset($data['descripcion'])) {
        // Preparar la consulta para insertar la nueva ciudad
        $descripcion = $data['descripcion'];

        // Consulta para insertar la nueva ciudad
        $sql = "INSERT INTO ciudades (descripcion) VALUES ('$descripcion')";
        
        if ($conn->query($sql) === TRUE) {
            // Si la inserción es exitosa, devolver la nueva ciudad con su ID
            $nueva_ciudad = [
                'id' => $conn->insert_id, // Obtener el ID generado
                'descripcion' => $descripcion
            ];
            echo json_encode($nueva_ciudad);
        } else {
            // Si hay un error en la inserción, devolver un mensaje de error
            echo json_encode(["error" => "Error al insertar la ciudad: " . $conn->error]);
        }
    } else {
        // Si falta la descripción, devolver un mensaje de error
        echo json_encode(["error" => "Falta la descripción de la ciudad"]);
    }
}

// Cerrar la conexión
$conn->close();
?>
