<?php
// Incluir el archivo de conexión utilizando require_once
require_once 'conexion.php';

// Encabezados para indicar que la respuesta será en formato JSON
header('Content-Type: application/json');

// Verificar si la solicitud es GET, POST o PUT
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Si es una solicitud GET, verificar si se pasó un parámetro 'id'
    if (isset($_GET['id'])) {
        // Obtener el ID del perfil desde la URL
        $id = $_GET['id'];

        // Consulta para obtener el perfil por ID
        $sql = "SELECT id, descripcion, descripcion_corta, nombre, valor, telefono, redes, edad, id_ciudad, id_sector, id_genero, medidas, peso, altura, disponible, visible, verificada, servicios, servicios_adicionales FROM perfiles WHERE id = $id AND id_estado = 1";
        $result = $conn->query($sql);

        // Verificar si se encontró el perfil
        if ($result->num_rows > 0) {
            // Obtener el perfil
            $perfil = $result->fetch_assoc();
            // Devolver el perfil en formato JSON
            echo json_encode($perfil);
        } else {
            // Si no se encuentra el perfil, devolver un mensaje de error
            echo json_encode(["error" => "Perfil no encontrado"]);
        }
    }else if(isset($_GET['id_usuario'])){
        $id_usuario = $_GET['id_usuario'];

        // Consulta para obtener el perfil por ID
        $sql = "SELECT id, descripcion, descripcion_corta, nombre, valor, telefono, redes, edad, id_ciudad, id_sector, id_genero, medidas, peso, altura, disponible, visible, verificada , servicios, servicios_adicionales FROM perfiles WHERE id_usuario = $id_usuario AND id_estado = 1";
        $result = $conn->query($sql);

        // Verificar si se encontró el perfil
        if ($result->num_rows > 0) {
            // Obtener el perfil
            $perfil = $result->fetch_assoc();
            // Devolver el perfil en formato JSON
            echo json_encode($perfil);
        } else {
            // Si no se encuentra el perfil, devolver un mensaje de error
            echo json_encode(["error" => "Perfil no encontrado"]);
        }
    }else if(isset($_GET['all'])){
        $id_usuario = $_GET['all'];

        // Consulta para obtener el perfil por ID
        $sql = "SELECT perfiles.id, perfiles.nombre,perfiles.edad,perfiles.valor, perfiles.id_ciudad,perfiles.disponible,perfiles.id_tipo_perfil,ciudades.descripcion AS ciudad, usuarios.id_rol,
                (SELECT url_foto FROM fotos WHERE fotos.id_usuario = perfiles.id_usuario and fotos.visible = 1 LIMIT 1) as foto
                FROM `perfiles`
                INNER JOIN usuarios ON usuarios.id = perfiles.id_usuario
                LEFT JOIN ciudades on ciudades.id = perfiles.id_ciudad
                WHERE perfiles.id_estado = 1;";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Crear un array para almacenar los perfiles
            $perfiles = [];

            // Obtener cada fila de la consulta y agregarla al array
            while($row = $result->fetch_assoc()) {
                $perfiles[] = $row;
            }

            // Devolver todos los perfiles en formato JSON
            echo json_encode($perfiles);
        } else {
            // Si no hay perfiles, devolver un array vacío
            echo json_encode([]);
        }
    }else {
        // Si no se pasó un ID, obtener todos los perfiles
        $sql = "SELECT id, descripcion, descripcion_corta, nombre, valor, telefono, redes, edad, id_ciudad, id_sector, id_genero, medidas, peso, altura, disponible, visible, verificada FROM perfiles WHERE id_estado = 1";
        $result = $conn->query($sql);

        // Verificar si hay resultados
        if ($result->num_rows > 0) {
            // Crear un array para almacenar los perfiles
            $perfiles = [];

            // Obtener cada fila de la consulta y agregarla al array
            while($row = $result->fetch_assoc()) {
                $perfiles[] = $row;
            }

            // Devolver todos los perfiles en formato JSON
            echo json_encode($perfiles);
        } else {
            // Si no hay perfiles, devolver un array vacío
            echo json_encode([]);
        }
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    if (isset($data['nombre']) && isset($data['valor']) && isset($data['telefono']) && 
    isset($data['redes']) && isset($data['edad']) && isset($data['selectCiudad']) && 
    isset($data['selectGenero']) && isset($data['medidas']) && isset($data['peso']) && 
    isset($data['altura']) && isset($data['disponible']) && isset($data['visible'])) {
        $descripcion = $data['descripcion'];
        $descripcion_corta = $data['descripcion_corta'];
        $nombre = $data['nombre'];
        $valor = $data['valor'];
        $telefono = $data['telefono'];
        $redes = $data['redes'];
        $edad = $data['edad'];
        $id_ciudad = $data['selectCiudad'];
       // $id_sector = $data['id_sector'];
        $id_genero = $data['selectGenero'];
        $medidas = $data['medidas'];
        $peso = $data['peso'];
        $altura = $data['altura'];
        $disponible = $data['disponible'];
        $visible = $data['visible'];
        $verificada = 0;
        $servicios = $data['txtServicioIncluidos'];
        $servicios_adicionales = $data['txtServicioAdicionales'];

        $sql = "INSERT INTO perfiles (descripcion, descripcion_corta, nombre, valor, telefono, redes, edad, id_ciudad, id_genero, medidas, peso, altura, disponible, visible, verificada,servicios,servicios_adicionales) 
                VALUES ('$descripcion', '$descripcion_corta', '$nombre', '$valor', '$telefono', '$redes', $edad, $id_ciudad, $id_genero, '$medidas', $peso, $altura, $disponible, $visible, $verificada,$servicios,$servicios_adicionales)";

        if ($conn->query($sql) === TRUE) {
            $nuevo_perfil = [
                'id' => $conn->insert_id, // Obtener el ID generado
                'descripcion' => $descripcion,
                'descripcion_corta' => $descripcion_corta,
                'nombre' => $nombre,
                'valor' => $valor,
                'telefono' => $telefono,
                'redes' => $redes,
                'edad' => $edad,
                'id_ciudad' => $id_ciudad,
                'id_genero' => $id_genero,
                'medidas' => $medidas,
                'peso' => $peso,
                'altura' => $altura,
                'disponible' => $disponible,
                'visible' => $visible,
                'verificada' => $verificada,
            ];
            echo json_encode($nuevo_perfil);
        } else {
            // Si hay un error en la inserción, devolver un mensaje de error
            echo json_encode(["error" => "Error al insertar el perfil: " . $conn->error]);
        }
    } else {
        // Si falta alguno de los campos necesarios, devolver un mensaje de error
        echo json_encode(["error" => "Faltan datos necesarios"]);
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $data = json_decode(file_get_contents('php://input'), true);

    // Verificar si el ID del perfil y los datos a actualizar están presentes
    if (isset($data['id']) && isset($data['nombre']) && isset($data['valor']) && isset($data['telefono']) && 
    isset($data['redes']) && isset($data['edad']) && isset($data['selectCiudad']) && 
    isset($data['selectGenero']) && isset($data['medidas']) && isset($data['peso']) && 
    isset($data['altura']) && isset($data['disponible']) && isset($data['visible'])) {

        // Preparar los datos para la actualización
        $id = $data['id'];
        $descripcion = $data['descripcion'];
        $descripcion_corta = $data['descripcion_corta'];
        $nombre = $data['nombre'];
        $valor = $data['valor'];
        $telefono = $data['telefono'];
        $redes = $data['redes'];
        $edad = $data['edad'];
        $id_ciudad = $data['selectCiudad'];
       // $id_sector = $data['id_sector'];
        $id_genero = $data['selectGenero'];
        $medidas = $data['medidas'];
        $peso = $data['peso'];
        $altura = $data['altura'];
        $disponible = $data['disponible'];
        $visible = $data['visible'];
        $servicios = $data['txtServicioIncluidos'];
        $servicios_adicionales = $data['txtServicioAdicionales'];

        // Consulta para actualizar los datos del perfil
        $sql = "UPDATE perfiles SET descripcion = '$descripcion', descripcion_corta = '$descripcion_corta', 
        nombre = '$nombre', valor = $valor, telefono = '$telefono', redes = '$redes', edad = $edad, 
        id_ciudad = $id_ciudad, id_genero = $id_genero, medidas = '$medidas', peso = $peso, altura = $altura, 
        disponible = $disponible, visible = $visible, servicios = '$servicios', servicios_adicionales = '$servicios_adicionales' WHERE id = $id";

        if ($conn->query($sql) === TRUE) {
            // Si la actualización es exitosa, devolver los datos actualizados
            echo json_encode(['id' => $id, 'descripcion' => $descripcion, 'descripcion_corta' => $descripcion_corta, 'nombre' => $nombre]);
        } else {
            // Si hay un error en la actualización, devolver un mensaje de error
            echo json_encode(["error" => "Error al actualizar el perfil: " . $conn->error]);
        }
    } else {
        // Si falta alguno de los campos, devolver un mensaje de error
        echo json_encode(["error" => "Faltan datos necesarios"]);
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $data = json_decode(file_get_contents('php://input'), true);

    if (isset($data['id'])) {
        $id = $data['id'];

        $sql = "UPDATE perfiles SET id_estado = 0 WHERE id = $id";

        if ($conn->query($sql) === TRUE) {
            echo json_encode(['id' => $id]);
        } else {
            echo json_encode(["error" => "Error al actualizar el género: " . $conn->error]);
        }
    } else {
        echo json_encode(["error" => "Faltan datos necesarios (id)"]);
    }
}

// Cerrar la conexión
$conn->close();
?>
