<?php

require_once 'conexion.php';

// Encabezados para indicar que la respuesta será en formato JSON
header('Content-Type: application/json');

// Verificar si la solicitud es GET, POST o PUT
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Si es una solicitud GET, verificar si se pasó un parámetro 'id'
    if (isset($_GET['id'])) {
        // Obtener el ID del género desde la URL
        $id = $_GET['id'];

        // Consulta para obtener el género por ID
        $sql = "SELECT id, descripcion FROM generos WHERE id = $id";
        $result = $conn->query($sql);

        // Verificar si se encontró el género
        if ($result->num_rows > 0) {
            // Obtener el género
            $genero = $result->fetch_assoc();
            // Devolver el género en formato JSON
            echo json_encode($genero);
        } else {
            // Si no se encuentra el género, devolver un mensaje de error
            echo json_encode(["error" => "Género no encontrado"]);
        }
    } else {
        // Si no se pasó un ID, obtener todos los géneros
        $sql = "SELECT id, descripcion FROM generos WHERE id_estado = 1";
        $result = $conn->query($sql);

        // Verificar si hay resultados
        if ($result->num_rows > 0) {
            // Crear un array para almacenar los géneros
            $generos = [];

            // Obtener cada fila de la consulta y agregarla al array
            while($row = $result->fetch_assoc()) {
                $generos[] = $row;
            }

            // Devolver todos los géneros en formato JSON
            echo json_encode($generos);
        } else {
            // Si no hay géneros, devolver un array vacío
            echo json_encode([]);
        }
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Si es una solicitud POST, insertar un nuevo género

    // Obtener los datos del cuerpo de la solicitud JSON
    $data = json_decode(file_get_contents('php://input'), true);

    // Verificar si el campo 'descripcion' está presente
    if (isset($data['descripcion'])) {
        // Preparar los datos para la inserción
        $descripcion = $data['descripcion'];

        // Consulta para insertar el nuevo género
        $sql = "INSERT INTO generos (descripcion) VALUES ('$descripcion')";

        if ($conn->query($sql) === TRUE) {
            // Si la inserción es exitosa, devolver el nuevo género con su ID
            $nuevo_genero = [
                'id' => $conn->insert_id, // Obtener el ID generado
                'descripcion' => $descripcion
            ];
            echo json_encode($nuevo_genero);
        } else {
            // Si hay un error en la inserción, devolver un mensaje de error
            echo json_encode(["error" => "Error al insertar el género: " . $conn->error]);
        }
    } else {
        // Si falta el campo 'descripcion', devolver un mensaje de error
        echo json_encode(["error" => "Falta el campo 'descripcion'"]);
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    // Si es una solicitud PUT, actualizar la descripción de un género

    // Obtener los datos del cuerpo de la solicitud JSON
    $data = json_decode(file_get_contents('php://input'), true);

    // Verificar si el ID del género y la nueva descripción están presentes
    if (isset($data['id']) && isset($data['descripcion'])) {
        $id = $data['id'];
        $descripcion = $data['descripcion'];

        // Consulta para actualizar la descripción del género
        $sql = "UPDATE generos SET descripcion = '$descripcion' WHERE id = $id";

        if ($conn->query($sql) === TRUE) {
            // Si la actualización es exitosa, devolver el ID y la nueva descripción
            echo json_encode(['id' => $id, 'descripcion' => $descripcion]);
        } else {
            // Si hay un error en la actualización, devolver un mensaje de error
            echo json_encode(["error" => "Error al actualizar el género: " . $conn->error]);
        }
    } else {
        // Si falta alguno de los campos, devolver un mensaje de error
        echo json_encode(["error" => "Faltan datos necesarios (id, descripcion)"]);
    }
}elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    // Si es una solicitud PUT, actualizar la descripción de un género

    // Obtener los datos del cuerpo de la solicitud JSON
    $data = json_decode(file_get_contents('php://input'), true);

    // Verificar si el ID del género y la nueva descripción están presentes
    if (isset($data['id'])) {
        $id = $data['id'];

        // Consulta para actualizar la descripción del género
        $sql = "UPDATE generos SET id_estado = 0 WHERE id = $id";

        if ($conn->query($sql) === TRUE) {
            // Si la actualización es exitosa, devolver el ID y la nueva descripción
            echo json_encode(['id' => $id]);
        } else {
            // Si hay un error en la actualización, devolver un mensaje de error
            echo json_encode(["error" => "Error al actualizar el género: " . $conn->error]);
        }
    } else {
        // Si falta alguno de los campos, devolver un mensaje de error
        echo json_encode(["error" => "Faltan datos necesarios (id)"]);
    }
}

// Cerrar la conexión
$conn->close();
?>
