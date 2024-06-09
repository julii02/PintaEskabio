<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Página</title>
    <link rel="stylesheet" type="text/css" href="estilos/estilos_proveedores.css">
    <link rel="stylesheet" type="text/css" href="normalize.css">
</head>
<body class="body-principal">
    <?php  session_start()  ?>
    <header class="header">
        <a href="index_admin.php">
            <img src="imagenes/asd.png" alt="Logo de la página" class="logo">
        </a>
    </header>
    <main>
        <div class="table-container">
            <?php
                include 'conexion.php';

                $consulta = mysqli_query($conexion, "SELECT * FROM proveedor");

                if (mysqli_num_rows($consulta) > 0) {
                    echo '<table class="provider-table">';
                    echo '<thead><tr><th>ID</th><th>Nombre</th><th>Apellido</th><th>Email</th><th>Teléfono</th><th>Localidad</th><th>Dirección</th><th>Acciones</th></tr></thead>';
                    echo '<tbody>';
                    while ($resultado = mysqli_fetch_array($consulta)) {
                        echo '<tr>';
                        echo '<td>' . $resultado["ID"] . '</td>';
                        echo '<td>' . $resultado["Nombre"] . '</td>';
                        echo '<td>' . $resultado["Apellido"] . '</td>';
                        echo '<td>' . $resultado["Email"] . '</td>';
                        echo '<td>' . $resultado["Telefono"] . '</td>';
                        echo '<td>' . $resultado["Localidad"] . '</td>';
                        echo '<td>' . $resultado["Direccion"] . '</td>';
                        echo '<td><button class="provider-edit-button" onclick="openEditModal(' . $resultado["ID"] . ', \'' . $resultado["Nombre"] . '\', \'' . $resultado["Apellido"] . '\', \'' . $resultado["Email"] . '\', \'' . $resultado["Telefono"] . '\', \'' . $resultado["Localidad"] . '\', \'' . $resultado["Direccion"] . '\')">Editar</button></td>';
                        echo '</tr>';
                    }
                    echo '</tbody>';
                    echo '</table>';
                } else {
                    echo '<p>No hay datos disponibles.</p>';
                }

                mysqli_close($conexion);
            ?> 
            
            <!-- Botón flotante -->
            <button class="add-button" onclick="openAddModal()">+</button>
        </div>
        
        <!-- Modal para editar -->
        <div id="editModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal('editModal')">&times;</span>
                <form action="actualizar_proveedor.php" method="POST" class="edit-form">
                    <input type="hidden" id="edit-id" name="ID">
                    <label for="edit-nombre">Nombre:</label>
                    <input type="text" id="edit-nombre" name="Nombre"><br><br>
                    <label for="edit-apellido">Apellido:</label>
                    <input type="text" id="edit-apellido" name="Apellido"><br><br>
                    <label for="edit-email">Email:</label>
                    <input type="email" id="edit-email" name="Email"><br><br>
                    <label for="edit-telefono">Teléfono:</label>
                    <input type="text" id="edit-telefono" name="Telefono"><br><br>
                    <label for="edit-localidad">Localidad:</label>
                    <input type="text" id="edit-localidad" name="Localidad"><br><br>
                    <label for="edit-direccion">Dirección:</label>
                    <input type="text" id="edit-direccion" name="Direccion"><br><br>
                    <input type="submit" value="Actualizar" class="edit-submit">
                </form>
            </div>
        </div>

        <!-- Modal para agregar -->
        <div id="addModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal('addModal')">&times;</span>
                <form action="agregar_proveedor.php" method="POST" class="edit-form">
                    <label for="add-nombre">Nombre:</label>
                    <input type="text" id="add-nombre" name="Nombre"><br><br>
                    <label for="add-apellido">Apellido:</label>
                    <input type="text" id="add-apellido" name="Apellido"><br><br>
                    <label for="add-email">Email:</label>
                    <input type="email" id="add-email" name="Email"><br><br>
                    <label for="add-telefono">Teléfono:</label>
                    <input type="text" id="add-telefono" name="Telefono"><br><br>
                    <label for="add-localidad">Localidad:</label>
                    <input type="text" id="add-localidad" name="Localidad"><br><br>
                    <label for="add-direccion">Dirección:</label>
                    <input type="text" id="add-direccion" name="Direccion"><br><br>
                    <input type="submit" value="Agregar" class="edit-submit">
                </form>
            </div>
        </div>
        
        <script>
            function openEditModal(id, nombre, apellido, email, telefono, localidad, direccion) {
                document.getElementById('edit-id').value = id;
                document.getElementById('edit-nombre').value = nombre;
                document.getElementById('edit-apellido').value = apellido;
                document.getElementById('edit-email').value = email;
                document.getElementById('edit-telefono').value = telefono;
                document.getElementById('edit-localidad').value = localidad;
                document.getElementById('edit-direccion').value = direccion;
                document.getElementById('editModal').style.display = "block";
            }

            function openAddModal() {
                document.getElementById('addModal').style.display = "block";
            }

            function closeModal(modalId) {
                document.getElementById(modalId).style.display = "none";
            }

            window.onclick = function(event) {
                if (event.target == document.getElementById('editModal')) {
                    closeModal('editModal');
                }
                if (event.target == document.getElementById('addModal')) {
                    closeModal('addModal');
                }
            }
        </script>
    </main>
    <footer class="footer">
        <p>&copy; 2024 Mi Página. Todos los derechos reservados.</p>
    </footer>
</body>
</html>
