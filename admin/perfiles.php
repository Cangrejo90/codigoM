<?php
include('header.php');
?>


<h1 class="h3 mb-2 text-gray-800">Perfiles</h1>
                
<div class="card shadow mb-4">
    
    <div class="card-body">
        <div class="table-responsive">

            <table class="table table-bordered" id="tabla-perfiles" width="100%" cellspacing="0">
            <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Descripción corta</th>
                        <th>Valor</th>
                        <th>Teléfono</th>
                        <th>Redes</th>
                        <th>Edad</th>
                        <th>Ciudad</th>
                        <th>Género</th>
                        <th>Disponible</th>
                        <th>Visible</th>
                        <th>Verificada</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody >               
                </tbody>
            </table>
        </div>
        <hr>
        <div class="div-footer-card">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#crearPerfilModal">
                Crear perfil
            </button>
        </div>
    </div>
</div>

 <!-- Modal crear Servicio-->
<div class="modal fade" id="crearPerfilModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Crear Perfil</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="crearPerfilForm">
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="nombre">Nombre</label>
                    <input type="text" id="nombre" class="form-control" name="nombre" placeholder="Ingrese el nombre">
                </div>
                <div class="form-group col-md-6">
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
                <div class="form-group col-md-12">
                    <label for="selectCiudad">Selecciona una ciudad:</label>
                    <select id="selectCiudad" class="form-control" name="selectCiudad">
                        <option value="">Cargando ciudades...</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <!--<div class="form-group col-md-6">
                    <label for="id_sector">ID Sector</label>
                    <input type="number" id="id_sector" class="form-control" name="id_sector" placeholder="Ingrese ID sector">
                </div>-->
                <div class="form-group col-md-6">
                    <label for="selectGenero">Genero</label>
                    <select id="selectGenero" class="form-control" name="selectGenero">
                        <option value="">Cargando generos...</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="edad">Edad</label>
                    <input type="number" id="edad" class="form-control" name="edad" placeholder="Ingrese la edad">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="medidas">Medidas</label>
                    <input type="text" id="medidas" class="form-control" name="medidas" placeholder="Ingrese medidas">
                </div>
                <div class="form-group col-md-6">
                    <label for="peso">Peso</label>
                    <input type="number" id="peso" class="form-control" name="peso" placeholder="Ingrese el peso">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="altura">Altura</label>
                    <input type="number" id="altura" class="form-control" name="altura" placeholder="Ingrese la altura">
                </div>
                <div class="form-group col-md-6">
                    <label for="disponible">Disponible</label>
                    <select id="disponible" class="form-control" name="disponible">
                        <option value="1">Sí</option>
                        <option value="0">No</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="visible">Visible</label>
                    <select id="visible" class="form-control" name="visible">
                        <option value="1">Sí</option>
                        <option value="0">No</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="verificada">Verificada</label>
                    <select id="verificada" class="form-control" name="verificada">
                        <option value="1">Sí</option>
                        <option value="0">No</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-12 text-right">
                    <button type="reset" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="editarPerfilModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <!-- Encabezado -->
            <div class="modal-header">
                <h5 class="modal-title">Editar Perfil</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- Cuerpo del modal -->
            <div class="modal-body">
                <form id="editarPerfilForm">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="editarNombre">Nombre</label>
                            <input type="text" id="editarNombre" class="form-control" name="editarNombre" placeholder="Ingrese el nombre">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="editarValor">Valor</label>
                            <input type="number" id="editarValor" class="form-control" name="editarValor" placeholder="Ingrese el valor">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="editarDescripcion">Descripción</label>
                            <textarea id="editarDescripcion" class="form-control" name="editarDescripcion" rows="3" placeholder="Ingrese la descripción"></textarea>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="editarDescripcionCorta">Descripción Corta</label>
                            <input type="text" id="editarDescripcionCorta" class="form-control" name="editarDescripcionCorta" placeholder="Ingrese descripción corta">
                        </div>
                    </div>

                    

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="editarTelefono">Teléfono</label>
                            <input type="text" id="editarTelefono" class="form-control" name="editarTelefono" placeholder="Ingrese el teléfono">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="editarRedes">Redes Sociales</label>
                            <input type="text" id="editarRedes" class="form-control" name="editarRedes" placeholder="Ingrese redes sociales">
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="editarSelectCiudad">Selecciona una ciudad:</label>
                            <select id="editarSelectCiudad" class="form-control" name="editarSelectCiudad">
                                <option value="">Cargando ciudades...</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="editarSelectGenero">Género</label>
                            <select id="editarSelectGenero" class="form-control" name="editarSelectGenero">
                                <option value="">Cargando géneros...</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="editarEdad">Edad</label>
                            <input type="number" id="editarEdad" class="form-control" name="editarEdad" placeholder="Ingrese la edad">
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="editarMedidas">Medidas</label>
                            <input type="text" id="editarMedidas" class="form-control" name="editarMedidas" placeholder="Ingrese medidas">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="editarPeso">Peso</label>
                            <input type="number" id="editarPeso" class="form-control" name="editarPeso" placeholder="Ingrese el peso">
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="editarAltura">Altura</label>
                            <input type="number" id="editarAltura" class="form-control" name="editarAltura" placeholder="Ingrese la altura">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="editarDisponible">Disponible</label>
                            <select id="editarDisponible" class="form-control" name="editarDisponible">
                                <option value="1">Sí</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="editarVisible">Visible</label>
                            <select id="editarVisible" class="form-control" name="editarVisible">
                                <option value="1">Sí</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="editarVerificada">Verificada</label>
                            <select id="editarVerificada" class="form-control" name="editarVerificada">
                                <option value="1">Sí</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 text-right">
                            <button type="reset" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<?php
include('footer.php');  // Incluir el archivo footer.php
?>
<script>
    $(document).ready(function () {
        $('#tabla-perfiles').DataTable({
            ajax: {
                url: 'http://localhost/codigo%20m/back/perfiles.php', // Verifica esta URL
                dataSrc: '',
                error: function (xhr, error, thrown) {
                    console.error('Error al cargar los datos:', xhr.responseText);
                }
            },
            columns: [
                { data: 'id' },
                { data: 'nombre' },
                { data: 'descripcion_corta' },
                { data: 'valor' },
                { data: 'telefono' },
                { data: 'redes' },
                { data: 'edad' },
                { data: 'id_ciudad' },
                { data: 'id_genero' },
                { 
                    data: 'disponible',
                    render: function(data) { return data === "1" ? "Sí" : "No"; }
                },
                { 
                    data: 'visible',
                    render: function(data) { return data === "1" ? "Sí" : "No"; }
                },
                { 
                    data: 'verificada',
                    render: function(data) { return data === "1" ? "Sí" : "No"; }
                }
            ],
            pageLength: 5,
            lengthMenu: [5, 10, 25, 50, 100],
            columnDefs: [
                { targets: 0, type: 'num' },
                {
                    data: null,
                    render: function (data, type, row) {
                        return `
                            <button class="btn btn-success btn-sm editar-btn" data-id="${row.id}" data-descripcion="${row.descripcion}">
                                <i class="fas fa-fw fa-edit"></i> Editar
                            </button>
                            <button class="btn btn-danger btn-sm eliminar-btn" data-id="${row.id}">
                                <i class="fas fa-fw fa-times"></i> Eliminar
                            </button>
                        `;
                    },
                    targets: 12
                }
            ]
        });
    });

    $(document).ready(function () {
    // Función genérica para cargar selects con AJAX
    function cargarSelect(endpoint, selectElement, placeholder) {
        $.ajax({
            url: endpoint,
            method: "GET",
            dataType: "json",
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

    // Llamadas para cargar los selects
    cargarSelect("http://localhost/codigo%20m/back/ciudades.php", $("#selectCiudad"), "Selecciona una ciudad");
    cargarSelect("http://localhost/codigo%20m/back/generos.php", $("#selectGenero"), "Selecciona un género");
    cargarSelect("http://localhost/codigo%20m/back/ciudades.php", $("#editarSelectCiudad"), "Selecciona un género");
    cargarSelect("http://localhost/codigo%20m/back/generos.php", $("#editarSelectGenero"), "Selecciona un género");

    // Manejar el envío del formulario con AJAX
    $("#crearPerfilForm").submit(function (event) {
        event.preventDefault(); // Evitar comportamiento predeterminado

        const formData = JSON.stringify(Object.fromEntries(new FormData(this).entries()));

        $.ajax({
            url: "http://localhost/codigo%20m/back/perfiles.php",
            method: "POST",
            contentType: "application/json",
            data: formData,
            success: function (response) {
                alert("Perfil creado con éxito.");
                $('#crearPerfilModal').modal('hide');
                $('#tabla-ciudades').DataTable().ajax.reload();
            },
            error: function (xhr, status, error) {
                console.error("Error al enviar los datos:", error);
                alert("Hubo un error al enviar el formulario.");
            }
        });
    });

    $('#tabla-perfiles tbody').on('click', '.eliminar-btn', function () {
        var id = $(this).data('id');
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    const data = JSON.stringify({ id });

                    $.ajax({
                        url: 'http://localhost/codigo%20m/back/perfiles.php',
                        type: 'DELETE',
                        contentType: 'application/json',
                        data: data,  
                        success: function (response) {
                            Swal.fire({
                                title: "Deleted!",
                                text: "Your file has been deleted.",
                                icon: "success"
                            });
                            $('#tabla-perfiles').DataTable().ajax.reload();
                        },
                        error: function () {
                            alert('Error al actualizar la ciudad.');
                        }
                    });
                    
                }
        });
    });

    $('#tabla-perfiles tbody').on('click', '.editar-btn', function () {
        var data = $('#tabla-perfiles').DataTable().row($(this).parents('tr')).data();

        // Llenar el modal con los datos del perfil seleccionado
        $('#editarPerfilModal #editarNombre').val(data.nombre);
        $('#editarPerfilModal #editarDescripcion').val(data.descripcion);
        $('#editarPerfilModal #editarDescripcion_corta').val(data.descripcion_corta);
        $('#editarPerfilModal #editarValor').val(data.valor);
        $('#editarPerfilModal #editarTelefono').val(data.telefono);
        $('#editarPerfilModal #editarRedes').val(data.redes);
        $('#editarPerfilModal #editarEdad').val(data.edad);
        $('#editarPerfilModal #editarSelectCiudad').val(data.id_ciudad);
        $('#editarPerfilModal #editarSelectGenero').val(data.id_genero);
        $('#editarPerfilModal #editarDisponible').val(data.disponible);
        $('#editarPerfilModal #editarVisible').val(data.visible);
        $('#editarPerfilModal #editarVerificada').val(data.verificada);

        // Guardar el ID en el botón de guardar
        $('#btnEditarPerfil').data('id', data.id);

        // Mostrar el modal
        $('#editarPerfilModal').modal('show');
    });

    $('#btnEditarPerfil').on('click', function () {
        var id = $(this).data('id');
        
        var perfilEditado = {
            id: id,
            nombre: $('#editarPerfilModal #nombre').val(),
            descripcion: $('#editarPerfilModal #descripcion').val(),
            descripcion_corta: $('#editarPerfilModal #descripcion_corta').val(),
            valor: $('#editarPerfilModal #valor').val(),
            telefono: $('#editarPerfilModal #telefono').val(),
            redes: $('#editarPerfilModal #redes').val(),
            edad: $('#editarPerfilModal #edad').val(),
            id_ciudad: $('#editarPerfilModal #selectCiudad').val(),
            id_genero: $('#editarPerfilModal #selectGenero').val(),
            disponible: $('#editarPerfilModal #disponible').val(),
            visible: $('#editarPerfilModal #visible').val(),
            verificada: $('#editarPerfilModal #verificada').val()
        };

        // Enviar la actualización por AJAX
        $.ajax({
            url: 'http://localhost/codigo%20m/back/actualizar_perfil.php',
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify(perfilEditado),
            success: function (response) {
                alert('Perfil actualizado con éxito');
                $('#editarPerfilModal').modal('hide');
                $('#tabla-perfiles').DataTable().ajax.reload(); // Recargar la tabla
            },
            error: function (xhr) {
                alert('Error al actualizar el perfil');
                console.error(xhr.responseText);
            }
        });
    });


});


</script>
