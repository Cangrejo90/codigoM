<?php
include('header.php');
?>


<h1 class="h3 mb-2 text-gray-800">Perfiles</h1>
                
<div class="card shadow mb-4">
    
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Position</th>
                        <th>Office</th>
                        <th>Age</th>
                        <th>Start date</th>
                        <th>Salary</th>
                    </tr>
                </thead>
                <tbody id="tabla-perfiles">               
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
include('footer.php');  // Incluir el archivo footer.php
?>
<script>
    document.addEventListener("DOMContentLoaded", () => {
        // URL del endpoint que lista los perfiles
        const endpoint = "http://localhost/codigo%20m/back/perfiles.php";

        // Realizar la solicitud al servicio
        fetch(endpoint)
            .then(response => {
                if (!response.ok) {
                    throw new Error("Error al obtener los datos: " + response.statusText);
                }
                return response.json();
            })
            .then(data => {
                // Referencia al tbody
                const tbody = document.getElementById("tabla-perfiles");

                // Limpiar el tbody (por si acaso)
                tbody.innerHTML = "";

                // Iterar sobre los datos y crear las filas
                data.forEach(perfil => {
                    const row = document.createElement("tr");

                    // Crear las celdas para cada campo
                    row.innerHTML = `
                        <td>${perfil.nombre}</td>
                        <td>${perfil.descripcion_corta || "N/A"}</td>
                        <td>${perfil.valor || "N/A"}</td>
                        <td>${perfil.edad || "N/A"}</td>
                        <td>${perfil.id_ciudad || "N/A"}</td>
                        <td>${perfil.telefono || "N/A"}</td>
                    `;

                    // Añadir la fila al tbody
                    tbody.appendChild(row);
                });
            })
            .catch(error => {
                console.error("Error al cargar los datos:", error);
            });
    });
</script>
