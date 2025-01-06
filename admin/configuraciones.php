<?php
include('header.php');
?>

<h1 class="h3 mb-2 text-gray-800">Ciudades</h1>
                
<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="tabla-ciudades" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Descripcion</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody >               
                </tbody>
            </table>
        </div>
        <hr>
        <div class="div-footer-card">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#crearCiudadModal">
                Crear ciudad
            </button>
        </div>
    </div>
</div>

<h1 class="h3 mb-2 text-gray-800">Generos</h1>
                
<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="tabla-generos" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Descripcion</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody >               
                </tbody>
            </table>
        </div>
        <hr>
        <div class="div-footer-card">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#crearGeneroModal">
                Crear genero
            </button>
        </div>
    </div>
</div>

<h1 class="h3 mb-2 text-gray-800">Servicios</h1>
                
<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="tabla-servicios" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Descripcion</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody >               
                </tbody>
            </table>
        </div>
        <hr>
        <div class="div-footer-card">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#crearServicioModal">
                Crear servicio
            </button>
        </div>
    </div>
</div>

<!-- Modal crear Ciudad-->
<div class="modal fade" id="crearCiudadModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Crear Ciudad</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="crearCiudadForm">
            <div class="form-group">
                <label for="exampleInputDescripcion">Descripcion</label>
                <input type="text" class="form-control" id="exampleInputDescripcion" placeholder="Ingrese ciudad">
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" id="btnGuardarCiudad">Guardar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Editar Ciudad-->
<div class="modal fade" id="editarCiudadModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar Ciudad</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="editarCiudadForm">
            <div class="form-group">
                <label for="txtCiudadEdit">Descripcion</label>
                <input type="text" class="form-control" id="txtCiudadEdit" placeholder="Ingrese ciudad">
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" id="btnEditarCiudad">Guardar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal crear Genero-->
<div class="modal fade" id="crearGeneroModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Crear Genero</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="crearGeneroForm">
            <div class="form-group">
                <label for="txtGenero">Descripcion</label>
                <input type="text" class="form-control" id="txtGenero" placeholder="Ingrese genero">
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" id="btnGuardarGenero">Guardar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal editar Genero-->
<div class="modal fade" id="editarGeneroModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Editar Genero</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="editarGeneroForm">
            <div class="form-group">
                <label for="txtGeneroEdit">Descripcion</label>
                <input type="text" class="form-control" id="txtGeneroEdit" placeholder="Ingrese genero">
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" id="btnEditarGenero">Guardar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal crear Servicio-->
<div class="modal fade" id="crearServicioModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Crear Servicio</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="crearServicioForm">
            <div class="form-group">
                <label for="txtServicio">Descripcion</label>
                <input type="text" class="form-control" id="txtServicio" placeholder="Ingrese Servicio">
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" id="btnGuardarServicio">Guardar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal editar Servicio-->
<div class="modal fade" id="editarServicioModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Editar Servicio</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="crearServicioForm">
            <div class="form-group">
                <label for="txtServicioEdit">Descripcion</label>
                <input type="text" class="form-control" id="txtServicioEdit" placeholder="Ingrese Servicio">
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" id="btnEditarServicio">Guardar</button>
      </div>
    </div>
  </div>
</div>
<?php
include('footer.php');  // Incluir el archivo footer.php
?>
<script>
    //ciudad
    $(document).ready(function () {
        $('#tabla-ciudades').DataTable({
            ajax: {
                url: 'http://localhost/codigo%20m/back/ciudades.php',
                dataSrc: '' 
            },
            columns: [
                { data: 'id' },
                { data: 'descripcion' },
            ],
            pageLength: 5,
            lengthMenu: [5, 10, 25, 50, 100],
            columnDefs: [
                { 
                    targets: 0,
                    type: 'num' 
                },
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
                    targets: 2
                }
            ],
        });
    });

    $('#tabla-ciudades tbody').on('click', '.editar-btn', function () {
        var id = $(this).data('id');
        var descripcion = $(this).data('descripcion');

        $('#txtCiudadEdit').val(descripcion);
        
        $('#editarCiudadModal').modal('show');

        $('#btnEditarCiudad').data('id', id);
    });

    $('#tabla-ciudades tbody').on('click', '.eliminar-btn', function () {
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
                        url: 'http://localhost/codigo%20m/back/ciudades.php',
                        type: 'DELETE',
                        contentType: 'application/json',
                        data: data,  
                        success: function (response) {
                            Swal.fire({
                                title: "Deleted!",
                                text: "Your file has been deleted.",
                                icon: "success"
                            });
                            $('#tabla-ciudades').DataTable().ajax.reload();
                        },
                        error: function () {
                            alert('Error al actualizar la ciudad.');
                        }
                    });
                    
                }
        });
    });

    $('#btnGuardarCiudad').click(function () {
        var descripcion = $('#exampleInputDescripcion').val().trim();

        if (!descripcion) {
            Swal.fire({
                icon: 'warning',
                title: 'Campo vacío',
                text: 'Por favor ingrese una descripción válida.',
            });
            return;
        }

        const data = JSON.stringify({ descripcion });

        $.ajax({
            url: 'http://localhost/codigo%20m/back/ciudades.php',
            type: 'POST',
            contentType: 'application/json',
            data: data,
            success: function (response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Ciudad creada con éxito',
                    text: response.message || 'Se ha añadido una nueva ciudad.',
                });
                $('#crearCiudadForm')[0].reset();
                $('#crearCiudadModal').modal('hide');
                $('#tabla-ciudades').DataTable().ajax.reload();
            },
            error: function (xhr) {
                let errorMessage = xhr.responseJSON?.message || 'Error al crear la ciudad.';
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: errorMessage,
                });
            }
        });
    });

    $('#btnEditarCiudad').click(function () {
        var id = $(this).data('id');
        var descripcion = $('#txtCiudadEdit').val();

        const data = JSON.stringify({ id, descripcion });

        $.ajax({
            url: 'http://localhost/codigo%20m/back/ciudades.php',
            type: 'PUT',
            contentType: 'application/json',
            data: data,  
            success: function (response) {
                Swal.fire("SweetAlert2 is working!");
                $('#editarCiudadModal').modal('hide');
                $('#tabla-ciudades').DataTable().ajax.reload();
            },
            error: function () {
                alert('Error al actualizar la ciudad.');
            }
        });
    });

    //genero
    $(document).ready(function () {
        $('#tabla-generos').DataTable({
            ajax: {
                url: 'http://localhost/codigo%20m/back/generos.php',
                dataSrc: '' 
            },
            columns: [
                { data: 'id' },
                { data: 'descripcion' },
            ],
            pageLength: 5,
            lengthMenu: [5, 10, 25, 50, 100],
            columnDefs: [
                { 
                    targets: 0,
                    type: 'num' 
                },
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
                    targets: 2
                }
            ],
        });
    });

    $('#tabla-generos tbody').on('click', '.editar-btn', function () {
        var id = $(this).data('id');
        var descripcion = $(this).data('descripcion');

        $('#txtGeneroEdit').val(descripcion);
        
        $('#editarGeneroModal').modal('show');

        $('#btnEditarGenero').data('id', id);
    });

    $('#tabla-generos tbody').on('click', '.eliminar-btn', function () {
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
                        url: 'http://localhost/codigo%20m/back/generos.php',
                        type: 'DELETE',
                        contentType: 'application/json',
                        data: data,  
                        success: function (response) {
                            Swal.fire({
                                title: "Deleted!",
                                text: "Your file has been deleted.",
                                icon: "success"
                            });
                            $('#tabla-generos').DataTable().ajax.reload();
                        },
                        error: function () {
                            alert('Error al actualizar la ciudad.');
                        }
                    });
                    
                }
        });
    });

    $('#btnGuardarGenero').click(function () {
        var descripcion = $('#txtGenero').val().trim();

        if (!descripcion) {
            Swal.fire({
                icon: 'warning',
                title: 'Atención',
                text: 'Por favor ingrese una descripción válida.'
            });
            return;
        }

        const data = JSON.stringify({ descripcion });

        $.ajax({
            url: 'http://localhost/codigo%20m/back/generos.php',
            type: 'POST',
            contentType: 'application/json',
            data: data,
            success: function (response) {
                Swal.fire({
                    icon: 'success',
                    title: '¡Éxito!',
                    text: response.message || 'Género creado exitosamente.'
                });
                $('#crearGeneroForm')[0].reset();
                $('#crearGeneroModal').modal('hide');
                $('#tabla-generos').DataTable().ajax.reload();
            },
            error: function (xhr) {
                let errorMsg = xhr.responseJSON ? xhr.responseJSON.message : 'Hubo un problema al crear el género.';
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: errorMsg
                });
            }
        });
    });

    $('#btnEditarGenero').click(function () {
        var id = $(this).data('id');
        var descripcion = $('#txtGeneroEdit').val();

        const data = JSON.stringify({ id, descripcion });

        $.ajax({
            url: 'http://localhost/codigo%20m/back/generos.php',
            type: 'PUT',
            contentType: 'application/json',
            data: data,  
            success: function (response) {
                Swal.fire("SweetAlert2 is working!");
                $('#editarGeneroModal').modal('hide');
                $('#tabla-generos').DataTable().ajax.reload();
            },
            error: function () {
                alert('Error al actualizar la ciudad.');
            }
        });
    });

    //Servicio
    $(document).ready(function () {
        $('#tabla-servicios').DataTable({
            ajax: {
                url: 'http://localhost/codigo%20m/back/servicios.php',
                dataSrc: '' 
            },
            columns: [
                { data: 'id' },
                { data: 'descripcion' },
            ],
            pageLength: 5,
            lengthMenu: [5, 10, 25, 50, 100],
            columnDefs: [
                { 
                    targets: 0,
                    type: 'num' 
                },
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
                    targets: 2
                }
            ],
        });
    });

    $('#tabla-servicios tbody').on('click', '.editar-btn', function () {
        var id = $(this).data('id');
        var descripcion = $(this).data('descripcion');

        $('#txtServicioEdit').val(descripcion);
        
        $('#editarServicioModal').modal('show');

        $('#btnEditarServicio').data('id', id);
    });

    $('#tabla-servicios tbody').on('click', '.eliminar-btn', function () {
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
                        url: 'http://localhost/codigo%20m/back/servicios.php',
                        type: 'DELETE',
                        contentType: 'application/json',
                        data: data,  
                        success: function (response) {
                            Swal.fire({
                                title: "Deleted!",
                                text: "Your file has been deleted.",
                                icon: "success"
                            });
                            $('#tabla-generos').DataTable().ajax.reload();
                        },
                        error: function () {
                            alert('Error al actualizar la ciudad.');
                        }
                    });
                    
                }
        });
    });

    document.getElementById('btnGuardarServicio').addEventListener('click', async () => {
      const descripcion = document.getElementById('txtServicio').value;

      if (!descripcion.trim()) {
          alert('Por favor ingrese una descripción válida.');
          return;
      }

      const data = { descripcion };

      try {
          const response = await fetch('http://localhost/codigo%20m/back/servicios.php', {
              method: 'POST',
              headers: {
                  'Content-Type': 'application/json',
              },
              body: JSON.stringify(data),
          });

          if (response.ok) {
              const result = await response.json(); 
              alert(result.message || 'Genero creado exitosamente.');
              document.getElementById('crearServicioForm').reset();
              $('#crearServicioModal').modal('hide');
              $('#tabla-servicios').DataTable().ajax.reload();
          } else {
              const error = await response.json();
              alert(error.message || 'Hubo un problema al crear la ciudad.');
          }
      } catch (error) {
          console.error('Error:', error);
          alert('No se pudo enviar la solicitud.');
      }
    });

    $('#btnEditarServicio').click(function () {
        var id = $(this).data('id');
        var descripcion = $('#txtServicioEdit').val();

        const data = JSON.stringify({ id, descripcion });

        $.ajax({
            url: 'http://localhost/codigo%20m/back/servicios.php',
            type: 'PUT',
            contentType: 'application/json',
            data: data,  
            success: function (response) {
                Swal.fire("SweetAlert2 is working!");
                $('#editarServicioModal').modal('hide');
                $('#tabla-servicios').DataTable().ajax.reload();
            },
            error: function () {
                alert('Error al actualizar la ciudad.');
            }
        });
    });
</script>
