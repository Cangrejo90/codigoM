<?php
include('header.php');
$user_id = $_SESSION['user_id'];
$key = $_SESSION["session_info"]["data"]["key"];
?>

<h1 class="h3 mb-2 text-gray-800">Perfil</h1>
                
<div class="card shadow mb-4">
    
    <div class="card-body">
        <form id="crearPerfilForm">
            <input type="hidden" id="id" name="id" value="">
            <div class="row">
                <div class="form-group col-md-4">
                    <label for="nombre">Nombre</label>
                    <input type="text" id="nombre" class="form-control" name="nombre" placeholder="Ingrese el nombre">
                </div>
                <div class="form-group col-md-4">
                    <label for="edad">Edad</label>
                    <input type="number" id="edad" class="form-control" name="edad" placeholder="Ingrese la edad">
                </div>
                <div class="form-group col-md-4">
                    <label for="valor">Valor</label>
                    <input type="number" id="valor" class="form-control" name="valor" placeholder="Ingrese el valor">
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-6">
                    <label for="descripcion">Descripción</label>
                    <textarea id="descripcion" class="form-control" name="descripcion" rows="3" placeholder="Ingrese la descripción"></textarea>
                </div>
                <div class="form-group col-md-6">
                    <label for="descripcion_corta">Descripción Corta</label>
                    <input type="text" id="descripcion_corta" class="form-control" name="descripcion_corta" placeholder="Ingrese descripción corta">
                </div>
            </div>
            
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="telefono">Teléfono</label>
                    <input type="text" id="telefono" class="form-control" name="telefono" placeholder="Ingrese el teléfono">
                </div>
                <div class="form-group col-md-6">
                    <label for="redes">Redes Sociales</label>
                    <input type="text" id="redes" class="form-control" name="redes" placeholder="Ingrese redes sociales">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="selectCiudad">Selecciona una ciudad:</label>
                    <select id="selectCiudad" class="form-control" name="selectCiudad">
                        <option value="">Cargando ciudades...</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="selectGenero">Genero</label>
                    <select id="selectGenero" class="form-control" name="selectGenero">
                        <option value="">Cargando generos...</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-4">
                    <label for="medidas">Medidas</label>
                    <input type="text" id="medidas" class="form-control" name="medidas" placeholder="Ingrese medidas">
                </div>
                <div class="form-group col-md-4">
                    <label for="peso">Peso</label>
                    <input type="number" id="peso" class="form-control" name="peso" placeholder="Ingrese el peso">
                </div>
                <div class="form-group col-md-4">
                    <label for="altura">Altura</label>
                    <input type="number" id="altura" class="form-control" name="altura" placeholder="Ingrese la altura">
                </div>
            </div>
            <div class="row">
                
                <div class="form-group col-md-4">
                    <label for="disponible">Disponible</label>
                    <select id="disponible" class="form-control" name="disponible">
                        <option value="1">Sí</option>
                        <option value="0">No</option>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="visible">Visible</label>
                    <select id="visible" class="form-control" name="visible">
                        <option value="1">Sí</option>
                        <option value="0">No</option>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="verificada">Verificada</label>
                    <select id="verificada" class="form-control" disabled>
                        <option value="0">No</option>
                        <option value="1">Sí</option>
                    </select>
                </div>
            </div>
            <hr>
            <div class="form-group">
                <h4>Servicios incluidos</h4>
                <div id="serviciosIncluidosContainer" style="columns:3">
                </div>
                <input type="hidden" id="txtServicioIncluidos" name="txtServicioIncluidos">
            </div>
            <hr>
            <div class="form-group">
                <h4>Servicios adicionales</h4>
                <div id="serviciosAdicionalesContainer" style="columns:3">
                </div>
                <input type="hidden" id="txtServicioAdicionales" name="txtServicioAdicionales">
            </div>
            <div class="row">
                <div class="col-12 text-right">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </form>
    </div>
</div>

<h1 class="h3 mb-2 text-gray-800">Fotos</h1>

<div class="card shadow mb-4">
    
    <div class="card-body">
        
        <!-- Input para cargar imágenes -->
        <form id="uploadForm" enctype="multipart/form-data">
            <input type="hidden" value="<?php echo($_SESSION['user_id'])?>">
            <div class="custom-file">
                <input type="file" class="form-control-file" id="fileInput" name="images[]" multiple accept="image/*">
                <label class="custom-file-label" for="fileInput">Seleccione Imagenes</label>
            </div>
            <!-- Contenedor para previsualizar las imágenes -->
            <div class="row mt-4" id="imagePreview"></div>

            <!-- Botón para enviar el formulario -->
            <button type="submit" class="btn btn-primary mt-3">Enviar Imágenes</button>
        </form>
    </div>
</div>

<?php
include('footer.php');  // Incluir el archivo footer.php
?>
<script>

    Fancybox.bind("[data-fancybox]", {
    // Your custom options
    });
    const baseUrl = "http://localhost/codigo%20m/back/";


    $(document).ready(function () {
        cargarSelect(baseUrl + "ciudades.php", $("#selectCiudad"), "Selecciona una ciudad");
        cargarSelect(baseUrl + "generos.php", $("#selectGenero"), "Selecciona un género");

        setTimeout(() => {
            cargarPerfil();
        }, 2000);
    });

    
    function cargarSelect(endpoint, selectElement, placeholder) {
        $.ajax({
            url: endpoint,
            method: "GET",
            dataType: "json",
            xhrFields: { withCredentials: true },
            headers : { 'api-key' : '<?=$key;?>'},
            success: function (data) {
                selectElement.empty().append(`<option value="">${placeholder}</option>`);
                data.forEach(item => {
                    selectElement.append(`<option value="${item.id}">${item.descripcion}</option>`);
                });
            },
            error: function (xhr, status, error) {
                console.error(`Error al cargar datos desde ${endpoint}:`, error);
                selectElement.html(`<option value="">Error al cargar datos</option>`);
            }
        });
    }

    function cargarPerfil() {
        $.ajax({
            url: baseUrl + "perfiles.php?id_usuario=<?=$user_id?>",
            method: "GET",
            dataType: "json",
            success: function (data) {
                $('#id').val(data.id)
                $('#nombre').val(data.nombre);
                $('#valor').val(data.valor);
                $('#descripcion').val(data.descripcion);
                $('#descripcion_corta').val(data.descripcion_corta);
                $('#telefono').val(data.telefono);
                $('#redes').val(data.redes);
                $('#edad').val(data.edad);
                $('#selectCiudad ').val(data.id_ciudad).change();;
                $('#selectGenero').val(data.id_genero).change();;
                $('#medidas').val(data.medidas);
                $('#peso').val(data.peso);
                $('#altura').val(data.altura);
                $('#disponible').val(data.disponible);
                $('#visible').val(data.visible);
                $('#verificada').val(data.verificada);
                $('#txtServicioIncluidos').val(data.servicios);
                $('#txtServicioAdicionales').val(data.servicios_adicionales);
                cargarServicios();
                cargarServiciosAdicionales();
            },
            error: function (xhr, status, error) {
                console.error(`Error al cargar datos desde perfil:`);
            }
        });
    }

    $(document).ready(function () {
        $('#fileInput').on('change', function (event) {
            const files = event.target.files;

            $.each(files, function (index, file) {
                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        $('#imagePreview').append(`
                            <div class="col-md-3 mb-3">
                                <a href="${e.target.result}" data-fancybox="gallery" data-caption="Caption #2">
                                    <img src="${e.target.result}" class="img-thumbnail" alt="Imagen subida" >
                                </a>
                            </div>
                        `);
                    }
                    reader.readAsDataURL(file);
                } else {
                    alert('Solo se pueden subir archivos de imagen.');
                }
            });
        });

        $('#uploadForm').on('submit', function (event) {
            event.preventDefault();  // Evitar la recarga de la página
            const formData = new FormData(this);

            // Agregar el id_usuario al FormData
            formData.append('id_usuario', 4);  // Aquí añades el id de forma correcta

            $.ajax({
                url: baseUrl + 'process-file.php', 
                type: 'POST',
                data: formData,
                processData: false,  // No procesar los datos automáticamente
                contentType: false,  // No establecer tipo de contenido automáticamente
                success: function (response) {
                    alert('Imágenes enviadas con éxito.');
                    console.log(response);  // Para verificar la respuesta del servidor
                },
                error: function (error) {
                    alert('Error al enviar las imágenes.');
                    console.error(error);  // Para ver detalles del error
                }
            });
        });

        $.ajax({
            url: baseUrl + "fotos.php",
            method: "GET",
            dataType: "json",
            success: function (data) {
                $('#imagePreview').empty();
                data.forEach(function(item) {
                    $('#imagePreview').append(`
                        <div class="col-md-3 mb-3">
                            <a href="${baseUrl}${item.url_foto}" data-fancybox="gallery" data-caption="Caption #2">
                                <img src="${baseUrl}${item.url_foto}" class="img-thumbnail" alt="Imagen subida" style="width:240px;height:160px">
                            </a>
                        </div>
                    `);
                });
            },
            error: function (error) {
                console.error("Error al cargar las imágenes:", error);
                alert("Hubo un error al cargar las imágenes.");
            }
        });

    });

    $("#crearPerfilForm").submit(function (event) {
        event.preventDefault(); // Evitar comportamiento predeterminado

        let formData = JSON.stringify(Object.fromEntries(new FormData(this).entries()));
        let idPerfil =  $("#id").val();
        let method = "POST";
        if(idPerfil){
            method = "PUT";
        }

        $.ajax({
            url: baseUrl + "perfiles.php",
            method: method,
            contentType: "application/json",
            data: formData,
            success: function (response) {
                if(response.error){
                    console.log(response);
                }
                else{
                    Swal.fire({
                        icon: 'success',
                        title: 'Perfil creado',
                        text: response.message || 'Perfil creado con exito',
                    });
                }
            },
            error: function (xhr, status, error) {
                console.error("Error al enviar los datos:", error);
                alert("Hubo un error al enviar el formulario.");
            }
        });
    });

    function cargarServicios() {
        const servicios = $("#txtServicioIncluidos").val().split(',');
        $.ajax({
            url: baseUrl + "servicios.php",
            method: "GET",
            dataType: "json",
            success: function (data) {
                data.forEach(element => {
                    const isCheck = servicios.find((x) => x == element.id) != undefined;
                    $('#serviciosIncluidosContainer').append(`
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input check-incluidos" ${isCheck?"checked":""}
                            id="${element.id}_1" value="${element.id}" onchange="toggleCheckbox(this)">
                            <label class="form-check-label" for="${element.id}_1">${element.descripcion}</label>
                        </div>
                    `);
                });
            },
            error: function (xhr, status, error) {
                console.error(`Error al cargar datos desde perfil:`);
            }
        });
    }

    function cargarServiciosAdicionales() {
        const servicios = $("#txtServicioAdicionales").val().split(',');
        $.ajax({
            url: baseUrl + "servicios_adicionales.php",
            method: "GET",
            dataType: "json",
            success: function (data) {
                data.forEach(element => {
                    const isCheck = servicios.find((x) => x == element.id) != undefined;
                    $('#serviciosAdicionalesContainer').append(`
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input check-adicionales" ${isCheck?"checked":""}
                            id="${element.id}_2" value="${element.id}" onchange="toggleCheckbox(this)">
                            <label class="form-check-label" for="${element.id}_2">${element.descripcion}</label>
                        </div>
                    `);
                });
            },
            error: function (xhr, status, error) {
                console.error(`Error al cargar datos desde perfil:`);
            }
        });
    }

    function toggleCheckbox() {
        const checkServicios = $(".check-incluidos:checkbox:checked");
        const checkServicios2 = $(".check-adicionales:checkbox:checked");

        let check = [];
        let check2 = [];
        for (let index = 0; index < checkServicios.length; index++) {
            check.push(checkServicios[index].value);
        }
        for (let index = 0; index < checkServicios2.length; index++) {
            check2.push(checkServicios2[index].value);
        }
        let serviciosIncluidos = check.join(',');
        let serviciosAdicionales = check2.join(',');

        $("#txtServicioIncluidos").val(serviciosIncluidos);
        $("#txtServicioAdicionales").val(serviciosAdicionales);
    }
</script>