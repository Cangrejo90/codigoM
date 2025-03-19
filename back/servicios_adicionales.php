<?php
// Incluir el archivo de conexión utilizando require_once
require_once 'conexion.php';

// Encabezados para indicar que la respuesta será en formato JSON
header('Content-Type: application/json');

// Verificar si la solicitud es GET, POST o PUT
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Si es una solicitud GET, verificar si se pasó un parámetro 'id'
    if (isset($_GET['id'])) {
        // Obtener el ID del servicio desde la URL
        $id = $_GET['id'];

        // Consulta para obtener el servicio por ID
        $sql = "SELECT id, descripcion FROM serviciosadicionales WHERE id = $id";
        $result = $conn->query($sql);

        // Verificar si se encontró el servicio
        if ($result->num_rows > 0) {
            // Obtener el servicio
            $servicio = $result->fetch_assoc();
            // Devolver el servicio en formato JSON
            echo json_encode($servicio);
        } else {
            // Si no se encuentra el servicio, devolver un mensaje de error
            echo json_encode(["error" => "Servicio no encontrado"]);
        }
    } else {
        // Si no se pasó un ID, obtener todos los servicios
        $sql = "SELECT id, descripcion FROM serviciosadicionales WHERE id_estado = 1";
        $result = $conn->query($sql);

        // Verificar si hay resultados
        if ($result->num_rows > 0) {
            // Crear un array para almacenar los servicios
            $servicios = [];

            // Obtener cada fila de la consulta y agregarla al array
            while($row = $result->fetch_assoc()) {
                $servicios[] = $row;
            }

            // Devolver todos los servicios en formato JSON
            echo json_encode($servicios);
        } else {
            // Si no hay servicios, devolver un array vacío
            echo json_encode([]);
        }
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Si es una solicitud POST, insertar un nuevo servicio

    // Obtener los datos del cuerpo de la solicitud JSON
    $data = json_decode(file_get_contents('php://input'), true);

    // Verificar si el campo 'descripcion' está presente
    if (isset($data['descripcion'])) {
        // Preparar los datos para la inserción
        $descripcion = $data['descripcion'];

        // Consulta para insertar el nuevo servicio
        $sql = "INSERT INTO serviciosadicionales (descripcion) VALUES ('$descripcion')";

        if ($conn->query($sql) === TRUE) {
            // Si la inserción es exitosa, devolver el nuevo servicio con su ID
            $nuevo_servicio = [
                'id' => $conn->insert_id, // Obtener el ID generado
                'descripcion' => $descripcion
            ];
            echo json_encode($nuevo_servicio);
        } else {
            // Si hay un error en la inserción, devolver un mensaje de error
            echo json_encode(["error" => "Error al insertar el servicio: " . $conn->error]);
        }
    } else {
        // Si falta el campo 'descripcion', devolver un mensaje de error
        echo json_encode(["error" => "Falta el campo 'descripcion'"]);
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    // Si es una solicitud PUT, actualizar la descripción de un servicio

    // Obtener los datos del cuerpo de la solicitud JSON
    $data = json_decode(file_get_contents('php://input'), true);

    // Verificar si el ID del servicio y la nueva descripción están presentes
    if (isset($data['id']) && isset($data['descripcion'])) {
        $id = $data['id'];
        $descripcion = $data['descripcion'];

        // Consulta para actualizar la descripción del servicio
        $sql = "UPDATE serviciosadicionales SET descripcion = '$descripcion' WHERE id = $id";

        if ($conn->query($sql) === TRUE) {
            // Si la actualización es exitosa, devolver el ID y la nueva descripción
            echo json_encode(['id' => $id, 'descripcion' => $descripcion]);
        } else {
            // Si hay un error en la actualización, devolver un mensaje de error
            echo json_encode(["error" => "Error al actualizar el servicio: " . $conn->error]);
        }
    } else {
        // Si falta alguno de los campos, devolver un mensaje de error
        echo json_encode(["error" => "Faltan datos necesarios (id, descripcion)"]);
    }
}

// Cerrar la conexión
$conn->close();
?>
