<?php
include('header.php');
?>


<h1 class="h3 mb-2 text-gray-800">Usuarios</h1>
                
<div class="card shadow mb-4">
    
    <div class="card-body">
        <div class="table-responsive">

            <table class="table table-bordered" id="tabla-usuarios" width="100%" cellspacing="0">
            <thead>
                    <tr>
                        <th>ID</th>
                        <th>Usuario</th>
                        <th>Correo</th>
                        <th>Rol</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody >               
                </tbody>
            </table>
        </div>
        <hr>
        <div class="div-footer-card">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#crearUsuarioModal">
                Crear usuario
            </button>
        </div>
    </div>
</div>

<!-- Modal crear Genero-->
<div class="modal fade" id="crearUsuarioModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Crear Usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="crearUsuarioForm">
            <div class="form-group">
                <label for="txtUsuario">Usuario</label>
                <input type="text" class="form-control" id="txtUsuario" name="usuario" placeholder="Ingrese usuario">
            </div>
            <div class="form-group">
                <label for="txtPassword">Contraseña (temporal)</label>
                <input type="text" class="form-control" id="txtPassword" name="password" placeholder="Ingrese contraseña">
            </div>
            <div class="form-group">
                <label for="txtPassword2">Confirmar contraseña</label>
                <input type="text" class="form-control" id="txtPassword2" placeholder="Ingrese contraseña">
            </div>
            <div class="form-group">
                <label for="txtCorreo">Correo</label>
                <input type="email" class="form-control" id="txtCorreo" name="correo" placeholder="Ingrese correo">
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

<?php
include('footer.php');  // Incluir el archivo footer.php
?>
<script>
    $(document).ready(function () {
        $('#tabla-usuarios').DataTable({
            ajax: {
                url: 'http://localhost/codigo%20m/back/usuario.php', // Verifica esta URL
                dataSrc: '',
                error: function (xhr, error, thrown) {
                    console.error('Error al cargar los datos:', xhr.responseText);
                }
            },
            columns: [
                { data: 'id' },
                { data: 'usuario' },
                { data: 'correo' },
                { data: 'rol' },
                { data: 'estado' },
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
                    targets: 5
                }
            ]
        });
    });

    $("#crearUsuarioForm").submit(function (event) {
        event.preventDefault(); // Evitar comportamiento predeterminado

        var usuario = $('#txtUsuario').val().trim();
        var password = $('#txtPassword').val().trim();
        var password2 = $('#txtPassword2').val().trim();
        var correo = $('#txtCorreo').val().trim();

        if (!usuario) {
            Swal.fire({
                icon: 'warning',
                title: 'Campo vacío',
                text: 'Por favor ingrese usuario válida.',
            });
            return;
        }

        if (!password || !password2) {
            Swal.fire({
                icon: 'warning',
                title: 'Campo vacío',
                text: 'Por favor ingrese password válida.',
            });
            return;
        }

        if (password != password2) {
            Swal.fire({
                icon: 'warning',
                title: 'Campo vacío',
                text: 'Contraseñas no coinciden',
            });
            return;
        }

        if (!correo) {
            Swal.fire({
                icon: 'warning',
                title: 'Campo vacío',
                text: 'Ingrese correo',
            });
            return;
        }

        const formData = JSON.stringify(Object.fromEntries(new FormData(this).entries()));
        $.ajax({
            url: 'http://localhost/codigo%20m/back/usuario.php',
            type: 'POST',
            contentType: 'application/json',
            data: formData,
            success: function (response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Usuario creada con éxito',
                    text: response.message || 'Se ha añadido un nuevo usuario.',
                });
                $('#crearUsuarioForm')[0].reset();
                $('#crearUsuarioModal').modal('hide');
                $('#tabla-usuarios').DataTable().ajax.reload();
            },
            error: function (xhr) {
                let errorMessage = xhr.responseJSON?.message || 'Error al crear usuario';
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: errorMessage,
                });
            }
        });
    });

    $('#tabla-usuarios tbody').on('click', '.eliminar-btn', function () {
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
                        url: 'http://localhost/codigo%20m/back/usuario.php',
                        type: 'DELETE',
                        contentType: 'application/json',
                        data: data,  
                        success: function (response) {
                            Swal.fire({
                                title: "Deleted!",
                                text: "Your file has been deleted.",
                                icon: "success"
                            });
                            $('#tabla-usuarios').DataTable().ajax.reload();
                        },
                        error: function () {
                            alert('Error al actualizar la ciudad.');
                        }
                    });
                    
                }
        });
    });

</script>