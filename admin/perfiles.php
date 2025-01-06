<?php
include('header.php');
?>


<h1 class="h3 mb-2 text-gray-800">Perfiles</h1>
                
<div class="card shadow mb-4">
    
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTablePerfil" width="100%" cellspacing="0">
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
                    </tr>
                </thead>
                <tbody id="tabla-perfiles">               
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
                    <td>${perfil.descripcion_corta || "N/A"}</td>
                    <td>${perfil.valor || "N/A"}</td>
                    <td>${perfil.telefono || "N/A"}</td>
                    <td>${perfil.redes || "N/A"}</td>
                    <td>${perfil.edad || "N/A"}</td>
                    <td>${perfil.id_ciudad || "N/A"}</td>
                    <td>${perfil.id_genero || "N/A"}</td>
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

    document.addEventListener("DOMContentLoaded", () => {
    const endpoint = "http://localhost/codigo%20m/back/ciudades.php"; // URL del endpoint
    const selectCiudad = document.getElementById("selectCiudad"); // Referencia al select

    // Realizar la solicitud al endpoint
    fetch(endpoint)
        .then(response => {
            if (!response.ok) {
                throw new Error("Error al obtener los datos: " + response.statusText);
            }
            return response.json(); // Convertir la respuesta a JSON
        })
        .then(data => {
            // Limpiar las opciones del select
            selectCiudad.innerHTML = '<option value="">Selecciona una ciudad</option>';

            // Iterar sobre los datos y crear las opciones
            data.forEach(ciudad => {
                const option = document.createElement("option");
                option.value = ciudad.id; // Valor del atributo "value"
                option.textContent = ciudad.descripcion; // Texto que se muestra
                selectCiudad.appendChild(option);
            });
        })
        .catch(error => {
            console.error("Error al cargar los datos:", error);
            selectCiudad.innerHTML = '<option value="">Error al cargar ciudades</option>';
        });
    });

    document.addEventListener("DOMContentLoaded", () => {
    const endpoint = "http://localhost/codigo%20m/back/generos.php"; // URL del endpoint
    const selectGenero = document.getElementById("selectGenero"); // Referencia al select

    // Realizar la solicitud al endpoint
    fetch(endpoint)
        .then(response => {
            if (!response.ok) {
                throw new Error("Error al obtener los datos: " + response.statusText);
            }
            return response.json(); // Convertir la respuesta a JSON
        })
        .then(data => {
            // Limpiar las opciones del select
            selectGenero.innerHTML = '<option value="">Selecciona un genero</option>';

            // Iterar sobre los datos y crear las opciones
            data.forEach(genero => {
                const option = document.createElement("option");
                option.value = genero.id; // Valor del atributo "value"
                option.textContent = genero.descripcion; // Texto que se muestra
                selectGenero.appendChild(option);
            });
        })
        .catch(error => {
            console.error("Error al cargar los datos:", error);
            selectGenero.innerHTML = '<option value="">Error al cargar generos</option>';
        });
    });

    document.getElementById("crearPerfilForm").addEventListener("submit", function(event) {
        event.preventDefault(); // Evitar el envío predeterminado del formulario

        // Crear un objeto con los datos del formulario
        const formData = new FormData(event.target);
        const data = Object.fromEntries(formData.entries());

        // Enviar los datos mediante POST
        fetch("http://localhost/codigo%20m/back/perfiles.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify(data)
        })
        .then(response => {
            if (!response.ok) {
                throw new Error("Error al enviar los datos.");
            }
            return response.json();
        })
        .then(result => {
            console.log("Respuesta del servidor:", result);
            alert("Perfil creado con éxito.");
            $('#crearPerfilModal').modal('hide');
            $('#dataTablePerfil').DataTable().ajax.reload();
        })
        .catch(error => {
            console.error("Error:", error);
            alert("Hubo un error al enviar el formulario.");
        });
    });

</script>
