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
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Descripción corta</th>
                        <th>Valor</th>
                        <th>Teléfono</th>
                        <th>Redes</th>
                        <th>Edad</th>
                        <th>Ciudad</th>
                        <th>Sector</th>
                        <th>Género</th>
                        <th>Medidas</th>
                        <th>Peso</th>
                        <th>Altura</th>
                        <th>Disponible</th>
                        <th>Visible</th>
                        <th>Verificada</th>
                    </tr>
                </thead>
                <tbody id="tabla-perfiles">               
                </tbody>
            </table>
        </div>
        <hr>
        <div class="div-footer-card">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#crearCiudadModal">
                Crear perfil
            </button>
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
                    <td>${perfil.id}</td>
                    <td>${perfil.nombre}</td>
                    <td>${perfil.descripcion}</td>
                    <td>${perfil.descripcion_corta || "N/A"}</td>
                    <td>${perfil.valor || "N/A"}</td>
                    <td>${perfil.telefono || "N/A"}</td>
                    <td>${perfil.redes || "N/A"}</td>
                    <td>${perfil.edad || "N/A"}</td>
                    <td>${perfil.id_ciudad || "N/A"}</td>
                    <td>${perfil.id_sector || "N/A"}</td>
                    <td>${perfil.id_genero || "N/A"}</td>
                    <td>${perfil.medidas || "N/A"}</td>
                    <td>${perfil.peso || "N/A"}</td>
                    <td>${perfil.altura || "N/A"}</td>
                    <td>${perfil.disponible === "1" ? "Sí" : "No"}</td>
                    <td>${perfil.visible === "1" ? "Sí" : "No"}</td>
                    <td>${perfil.verificada === "1" ? "Sí" : "No"}</td>
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
