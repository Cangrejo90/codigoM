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
</script>
