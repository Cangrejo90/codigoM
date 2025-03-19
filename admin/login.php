<?php
session_start();

if (isset($_SESSION['user_id'])) {
    header("Location: perfil.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $correo = $_POST['correo'];
    $clave = md5($_POST['clave']);

    require_once '../back/conexion.php';

    $stmt = $conn->prepare("SELECT id, correo FROM usuarios WHERE correo = ? AND clave = ?");
    $stmt->bind_param("ss", $correo, $clave);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $usuario = $result->fetch_assoc();

        // Configura la sesión
        $_SESSION['user_id'] = $usuario['id'];
        $_SESSION['correo'] = $usuario['correo'];
        $_SESSION['usuario'] = $usuario['usuario'];
        $_SESSION['id_rol'] = $usuario['id_rol'];
        // Redirige al perfil
        header("Location: perfil.php");
        exit;
    } else {
        echo "Credenciales incorrectas. Intenta nuevamente.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Medusa Admin</title>

    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="css/custom.css" rel="stylesheet">
</head>

<body class="bg-gradient-primary">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">¡Bienvenido de nuevo!</h1>
                                    </div>
                                    <form class="user" id="loginForm">
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp" name="correo"
                                                placeholder="Ingrese correo">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                id="exampleInputPassword" placeholder="Contraseña" name="clave">
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Acuérdate de mí</label>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Entrar
                                        </button>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="../forgot-password.html">¿Has olvidado tu contraseña?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="../register.html">¡Crea una cuenta!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</body>
</html>
<div id="loadContainer" class="hidden">
    <div class="spinner-border">
        <span class="sr-only">Loading...</span>
    </div>
</div>
<?php
include('footer.php'); 
?>

<script>
    $('#loginForm').on('submit', function (event) {
        event.preventDefault();
        let formData = JSON.stringify(Object.fromEntries(new FormData(this).entries()));
        $("html").css("opacity","0.8");
        $("#loadContainer").removeClass("hidden")
        $.ajax({
            url: 'http://localhost/codigo%20m/admin/login.php', 
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
            },
            error: function (error) {
                debugger;
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    html: error,
                });
            }
        });
    });
</script>