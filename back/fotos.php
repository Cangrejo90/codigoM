<?php
// Incluir el archivo de conexión utilizando require_once
require_once 'conexion.php';

// Encabezados para indicar que la respuesta será en formato JSON
header('Content-Type: application/json');

// Verificar si la solicitud es GET, POST o PUT
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Si es una solicitud GET, verificar si se pasó un parámetro 'id'
    if (isset($_GET['id'])) {
        // Obtener el ID de la foto desde la URL
        $id = $_GET['id'];

        // Consulta para obtener la foto por ID
        $sql = "SELECT id, url_foto, id_usuario, visible FROM fotos WHERE id = $id";
        $result = $conn->query($sql);

        // Verificar si se encontró la foto
        if ($result->num_rows > 0) {
            // Obtener la foto
            $foto = $result->fetch_assoc();
            // Devolver la foto en formato JSON
            echo json_encode($foto);
        } else {
            // Si no se encuentra la foto, devolver un mensaje de error
            echo json_encode(["error" => "Foto no encontrada"]);
        }
    }if (isset($_GET['id_usuario'])) {
        // Obtener el ID de la foto desde la URL
        $id_usuario = $_GET['id_usuario'];

        // Consulta para obtener la foto por ID
        $sql = "SELECT id, url_foto, id_usuario, visible FROM fotos WHERE id_usuario = $id_usuario";
        $result = $conn->query($sql);

        // Verificar si se encontró la foto
        if ($result->num_rows > 0) {
            // Crear un array para almacenar las fotos
            $fotos = [];

            // Obtener cada fila de la consulta y agregarla al array
            while($row = $result->fetch_assoc()) {
                $fotos[] = $row;
            }

            // Devolver todas las fotos en formato JSON
            echo json_encode($fotos);
        } else {
            // Si no hay fotos, devolver un array vacío
            echo json_encode([]);
        }
    }if (isset($_GET['id_perfil'])) {
        // Obtener el ID de la foto desde la URL
        $id_perfil = $_GET['id_perfil'];

        // Consulta para obtener la foto por ID
        $sql = "SELECT url_foto FROM `fotos`
                LEFT JOIN perfiles ON perfiles.id_usuario = fotos.id_usuario
                WHERE perfiles.id = $id_perfil AND fotos.visible = 1;";
        $result = $conn->query($sql);

        // Verificar si se encontró la foto
        if ($result->num_rows > 0) {
            // Crear un array para almacenar las fotos
            $fotos = [];

            // Obtener cada fila de la consulta y agregarla al array
            while($row = $result->fetch_assoc()) {
                $fotos[] = $row;
            }

            // Devolver todas las fotos en formato JSON
            echo json_encode($fotos);
        } else {
            // Si no hay fotos, devolver un array vacío
            echo json_encode([]);
        }
    }else {
        // Si no se pasó un ID, obtener todas las fotos
        $sql = "SELECT id, url_foto, id_usuario, visible FROM fotos";
        $result = $conn->query($sql);

        // Verificar si hay resultados
        if ($result->num_rows > 0) {
            // Crear un array para almacenar las fotos
            $fotos = [];

            // Obtener cada fila de la consulta y agregarla al array
            while($row = $result->fetch_assoc()) {
                $fotos[] = $row;
            }

            // Devolver todas las fotos en formato JSON
            echo json_encode($fotos);
        } else {
            // Si no hay fotos, devolver un array vacío
            echo json_encode([]);
        }
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Si es una solicitud POST, insertar una nueva foto

    // Obtener los datos del cuerpo de la solicitud JSON
    $data = json_decode(file_get_contents('php://input'), true);

    // Verificar si los campos necesarios están presentes
    if (isset($data['url_foto']) && isset($data['id_usuario']) && isset($data['visible'])) {
        // Preparar los datos para la inserción
        $url_foto = $data['url_foto'];
        $id_usuario = $data['id_usuario'];
        $visible = $data['visible'];

        // Consulta para insertar la nueva foto
        $sql = "INSERT INTO fotos (url_foto, id_usuario, visible) VALUES ('$url_foto', $id_usuario, $visible)";

        if ($conn->query($sql) === TRUE) {
            // Si la inserción es exitosa, devolver la nueva foto con su ID
            $nueva_foto = [
                'id' => $conn->insert_id, // Obtener el ID generado
                'url_foto' => $url_foto,
                'id_usuario' => $id_usuario,
                'visible' => $visible
            ];
            echo json_encode($nueva_foto);
        } else {
            // Si hay un error en la inserción, devolver un mensaje de error
            echo json_encode(["error" => "Error al insertar la foto: " . $conn->error]);
        }
    } else {
        // Si falta alguno de los campos, devolver un mensaje de error
        echo json_encode(["error" => "Faltan datos necesarios (url_foto, id_usuario, visible)"]);
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    // Si es una solicitud PUT, actualizar la visibilidad de una foto

    // Obtener los datos del cuerpo de la solicitud JSON
    $data = json_decode(file_get_contents('php://input'), true);

    // Verificar si el ID de la foto y la visibilidad están presentes
    if (isset($data['id']) && isset($data['visible'])) {
        $id = $data['id'];
        $visible = $data['visible'];

        // Consulta para actualizar la visibilidad de la foto
        $sql = "UPDATE fotos SET visible = $visible WHERE id = $id";

        if ($conn->query($sql) === TRUE) {
            // Si la actualización es exitosa, devolver el ID y el nuevo valor de visibilidad
            echo json_encode(['id' => $id, 'visible' => $visible]);
        } else {
            // Si hay un error en la actualización, devolver un mensaje de error
            echo json_encode(["error" => "Error al actualizar la foto: " . $conn->error]);
        }
    } else {
        // Si falta alguno de los campos, devolver un mensaje de error
        echo json_encode(["error" => "Faltan datos necesarios (id, visible)"]);
    }
}

// Cerrar la conexión
$conn->close();
?>
