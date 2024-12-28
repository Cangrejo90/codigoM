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

<?php
include('footer.php');  // Incluir el archivo footer.php
?>
<script>
    $(document).ready(function () {
        $('#tabla-ciudades').DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/2.1.8/i18n/es-CL.json',
            },
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
                }
            ],
        });
    });

    $(document).ready(function () {
        $('#tabla-generos').DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/2.1.8/i18n/es-CL.json',
            },
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
                }
            ],
        });
    });

    $(document).ready(function () {
        $('#tabla-servicios').DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/2.1.8/i18n/es-CL.json',
            },
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
                }
            ],
        });
    });

    document.getElementById('btnGuardarCiudad').addEventListener('click', async () => {
      const descripcion = document.getElementById('exampleInputDescripcion').value;

      if (!descripcion.trim()) {
          alert('Por favor ingrese una descripción válida.');
          return;
      }

      const data = { descripcion };

      try {
          const response = await fetch('http://localhost/codigo%20m/back/ciudades.php', {
              method: 'POST',
              headers: {
                  'Content-Type': 'application/json',
              },
              body: JSON.stringify(data),
          });

          if (response.ok) {
              const result = await response.json(); 
              alert(result.message || 'Ciudad creada exitosamente.');
              document.getElementById('crearCiudadForm').reset();
              $('#crearCiudadModal').modal('hide');
              $('#tabla-ciudades').DataTable().ajax.reload();
          } else {
              const error = await response.json();
              alert(error.message || 'Hubo un problema al crear la ciudad.');
          }
      } catch (error) {
          console.error('Error:', error);
          alert('No se pudo enviar la solicitud.');
      }
    });

    document.getElementById('btnGuardarGenero').addEventListener('click', async () => {
      const descripcion = document.getElementById('txtGenero').value;

      if (!descripcion.trim()) {
          alert('Por favor ingrese una descripción válida.');
          return;
      }

      const data = { descripcion };

      try {
          const response = await fetch('http://localhost/codigo%20m/back/generos.php', {
              method: 'POST',
              headers: {
                  'Content-Type': 'application/json',
              },
              body: JSON.stringify(data),
          });

          if (response.ok) {
              const result = await response.json(); 
              alert(result.message || 'Genero creado exitosamente.');
              document.getElementById('crearGeneroForm').reset();
              $('#crearGeneroModal').modal('hide');
              $('#tabla-generos').DataTable().ajax.reload();
          } else {
              const error = await response.json();
              alert(error.message || 'Hubo un problema al crear la ciudad.');
          }
      } catch (error) {
          console.error('Error:', error);
          alert('No se pudo enviar la solicitud.');
      }
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
</script>
