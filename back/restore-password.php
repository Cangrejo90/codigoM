<?php 

require_once 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['key'])) {
        $key_restore = $_GET['key'];

        $sql = "SELECT key_restore FROM codigo_restore WHERE key_restore = '$key_restore'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $restore = $result->fetch_assoc();
            echo json_encode($restore);
        } else {
            header("Location: 404.html");
            exit;
        }
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

    <title>Medusa Forgot Password</title>

    <!-- Custom fonts for this template-->
    <link href="../admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../admin/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">
    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-password-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-2">Cambiar la contraseña</h1>
                                        <p class="mb-4">Una contraseña segura contribuye a evitar el acceso no autorizado a la cuenta</p>
                                    </div>
                                    <form class="user" id="changePassword" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user"
                                                id="password" name="password"
                                                placeholder="Contraseña nueva">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user"
                                                id="password2" name="password2"
                                                placeholder="Confirmar contraseña nueva">
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">Cambiar contraseña</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="../admin/vendor/jquery/jquery.min.js"></script>
    <script src="../admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../admin/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../admin/js/sb-admin-2.min.js"></script>

</body>

</html>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $('#changePassword').on('submit', function (event) {
        event.preventDefault();
        const formData = JSON.stringify(Object.fromEntries(new FormData(this).entries()));
        
        $.ajax({
            url: 'http://localhost/codigo%20m/back/usuario.php?key=<?=$key_restore?>', 
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                if(response == "OK"){
                    Swal.fire({
                        icon: 'success',
                        title: 'Actualización Exitosa',
                        text: 'Cambio de Contraseña Realizada Correctamente',
                    }).then(function() {
                        window.location = "../admin/login.php";
                    });
                }
                if(response.error){
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        html: response.error,
                    });
                }
            },
            error: function (error) {
                console.error(error);
            }
        });
    });
</script>