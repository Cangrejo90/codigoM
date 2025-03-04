<?php 
    $idPerfil = $_GET['id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/media.css">
    <title>Medusa Escort - El mejor portal de Escort de Chile</title>
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
    <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css"
    />
</head>
<body>
    <input type="hidden" id="idPerfil" value="<?=$idPerfil?>">
    <div class="header">
        <a href="index.php" title="home"><img src="img/logo.png" alt="medusa" class="logo"></a>
        <!--<ul class="menu">
            <li><a href="index.html#premium">Premium</a></li>
            <li><a href="index.html#vip">Vip</a></li>
            <li><a href="index.html#classic">Classic</a></li>
        </ul>-->
        <ul>
            <li><a href="#" class="anuncio">Publica con nosotros</a></li>
        </ul>
    </div>
    <div class="content">
        <div class="breadcum">
            Santiago / Las Condes / <span class="bold" id="spanNombre"></span>
        </div>
        <div class="data">
            <img src="" alt="Camila" id="fotoPerfil">
            <div class="contact-escort">
                <h1 id="h1Nombre"></h1>
                <p class="detail" id="pDescripcion"></p>
                <p>Contacto <span id="spanContacto"></span></p>
                <p>Tarifa <span id="spanValor"></span> - por hora</p>
            </div>
        </div>
        <div class="service">
            <h2>Servicios incluidos</h2>
            <ul class="service-include">
                <li>
                    <p>la que te gusta</p>
                </li>
                <li>
                    <p>la que te gusta</p>
                </li>
                <li>
                    <p>la que te gusta</p>
                </li>
                <li>
                    <p>la que te gusta</p>
                </li>
            </ul>
            <h2>Servicios adicionales</h2>
            <ul class="service-add">
                <li>
                    <p>la que te gusta</p>
                </li>
                <li>
                    <p>la que te gusta</p>
                </li>
                <li>
                    <p>la que te gusta</p>
                </li>
                <li>
                    <p>la que te gusta</p>
                </li>
            </ul>
        </div>
        <h2>Galería</h2>
        <ul class="gallery" id="gallery">
        </ul>
    </div>
    <div class="footer">
        <p>Portal sobre escorts y masajistas para mayores de 18. No poseemos vinculación laboral con las anunciantes y nos limitamos exclusivamente a brindar un servicio publicitario. Nos reservamos el derecho a publicación.</p>
        <p class="bold">Todos los derechos reservados</p>
    </div>
</body>
</html>
<script src="admin/vendor/jquery/jquery.min.js"></script>
<script src="admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="admin/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="admin/js/sb-admin-2.min.js"></script>
<script>
    const baseUrl = "http://localhost/codigo%20m/back/";
    
    Fancybox.bind("[data-fancybox]", {
    // Your custom options
    });

    $(document).ready(function () {
        loadPerfil();
        loadFotos();
    });

    function loadPerfil() {
        let idPerfil = $("#idPerfil").val();

        $.ajax({
            url: baseUrl + 'perfiles.php?id='+idPerfil,
            method: "GET",
            dataType: "json",
            success: function (perfil) {
                let disponible = perfil.disponible == 1? 'active':'pronto';
                let title = '' + perfil.nombre + '<span> | ' + perfil.edad + ' años</span> <div class="' + disponible + '"></div>';


                $("#spanNombre").html(perfil.nombre);
                $("#h1Nombre").html(title);
                $("#pDescripcion").html(perfil.descripcion);
                $("#spanContacto").html(perfil.telefono);
                $("#spanValor").html(perfil.valor);
            },
            error: function (xhr, status, error) {
                console.error(`Error al cargar datos desde ${endpoint}:`, error);
                selectElement.html(`<option value="">Error al cargar datos</option>`);
            }
        });
    }

    function loadFotos() {
        let idPerfil = $("#idPerfil").val();

        $.ajax({
            url: baseUrl + 'fotos.php?id_perfil='+idPerfil,
            method: "GET",
            dataType: "json",
            success: function (fotos) {
                $("#fotoPerfil").attr("src","back/"+fotos[0].url_foto);
                $('#gallery').empty();
                fotos.forEach(function(item) {
                    $('#gallery').append(`<li>
                                <a href="${baseUrl}${item.url_foto}" data-fancybox="gallery" data-caption="Caption #2">
                                    <img src="${baseUrl}${item.url_foto}" class="img-thumbnail" alt="Imagen subida" style="width:240px;height:160px">
                                </a>
                            </li>
                    `);
                });
            },
            error: function (xhr, status, error) {
                console.error(`Error al cargar datos desde ${endpoint}:`, error);
                selectElement.html(`<option value="">Error al cargar datos</option>`);
            }
        });
    }

    function format1(n) {
        let x = Number(n);
        return '$' + x.toFixed(0).replace(/./g, function(c, i, a) {
            return i > 0 && c !== "." && (a.length - i) % 3 === 0 ? "." + c : c;
        });
    }
</script>
