<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Clientes - PintaEskabio</title>
    <link rel="stylesheet" type="text/css" href="estilos/estilos_clientes.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="normalize.css">
    <style>
        .add-button {
            color: #ffffff;
            position: fixed;
            font-size: 40px;
            bottom: 20px;
            top: 90%;
            right: 20px;
            z-index: 100;
            box-shadow: 0px 1px 10px rgba(0, 0, 0, 0.3);
            transition: transform 0.3s ease;
            border-radius: 50%;
            padding: 15px;
            text-align: center;
            text-decoration: none;
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #007bff;
            border: none;
            cursor: pointer;
        }
        .add-button:hover {
            transform: scale(1.1);
        }
        .edit-button, .delete-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin: 0 5px;
        }
        .edit-button {
            color: #ffffff;
            background-color: #009879;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
        }
        .edit-button:hover {
            background-color: #007f65;
        }
        .delete-button {
            color: #ffffff;
            background-color: #dc3545;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
        }
        .delete-button:hover {
            background-color: #c82333;
        }
        .delete-button i {
            color: #ffffff;
        }
        td.actions-cell {
            display: flex;
            align-items: center;
            justify-content: center;
        }
        th {
            text-align: center;
        }
        td {
            text-align: center;
        }
    </style>
</head>
<body class="body-principal">
    <?php
        session_start();
        if (!isset($_SESSION['usuario'])) {
            header('Location: form_iniciosesion.html');
            exit();
        }
        // Verificar si el usuario es administrador
        if ($_SESSION['admin'] != 1) {
            header('Location: index_cliente.php'); // Redirige a una página de acceso denegado
            exit();
        }
        // Código de la página protegida
    ?>
    <header class="header">
        <a href="index_admin.php">
            <img src="imagenes/asd.png" alt="Logo de la página" class="logo">
        </a>
        <div class="Iconos-sesion">
            <form action="cerrar_sesion.php" method="post" style="display: inline;"> <button type="submit" class="btn btn-danger">Cerrar Sesión</button> </form>
        </div>
    </header>
    <main>
        <div class="table-container">
            <?php
                include 'conexion.php';

                $consulta = mysqli_query($conexion, "SELECT * FROM usuario");

                if (mysqli_num_rows($consulta) > 0) {
                    echo '<table class="styled-table">';
                    echo '<thead><tr><th>Nombre</th><th>Apellido</th><th>Email</th><th>Localidad</th><th>Dirección</th><th>Admin</th><th>Acciones</th></tr></thead>';
                    echo '<tbody>';
                    while ($resultado = mysqli_fetch_array($consulta)) {
                        echo '<tr id="row-' . $resultado["ID"] . '">';
                        echo '<td>' . $resultado["Nombre"] . '</td>';
                        echo '<td>' . $resultado["Apellido"] . '</td>';
                        echo '<td>' . $resultado["Email"] . '</td>';
                        echo '<td>' . $resultado["Localidad"] . '</td>';
                        echo '<td>' . $resultado["Direccion"] . '</td>';
                        echo '<td>' . ($resultado["Admin"] ? 'Sí' : 'NULL') . '</td>';
                        echo '<td class="actions-cell">
                            <button class="edit-button" onclick="openEditModal(' . $resultado["ID"] . ', \'' . $resultado["Nombre"] . '\', \'' . $resultado["Apellido"] . '\', \'' . $resultado["Email"] . '\', \'' . $resultado["Localidad"] . '\', \'' . $resultado["Direccion"] . '\', ' . $resultado["Admin"] . ')">Editar</button>
                            <button class="delete-button" onclick="deleteUser(' . $resultado["ID"] . ')"><i class="fas fa-trash-alt"></i></button></td>';

                        echo '</tr>';
                    }
                    echo '</tbody>';
                    echo '</table>';
                } else {
                    echo '<p>No hay datos disponibles.</p>';
                }

                mysqli_close($conexion);
            ?>

            <button class="add-button" onclick="openAddModal()">+</button>
            
        </div>

        <!-- Modal Editar -->
        <div id="editModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal('editModal')">&times;</span>
                <form action="actualizar_usuario.php" method="POST" class="edit-form">
                    <input type="hidden" id="edit-id" name="ID">
                    <label for="edit-nombre">Nombre:</label>
                    <input type="text" id="edit-nombre" name="Nombre"><br>
                    <label for="edit-apellido">Apellido:</label>
                    <input type="text" id="edit-apellido" name="Apellido"><br>
                    <label for="edit-email">Email:</label>
                    <input type="email" id="edit-email" name="Email"><br>
                    <label for="edit-localidad">Localidad:</label>
                    <input type="text" id="edit-localidad" name="Localidad"><br>
                    <label for="edit-direccion">Dirección:</label>
                    <input type="text" id="edit-direccion" name="Direccion"><br>
                    <label for="edit-admin">Admin:</label>
                    <input type="checkbox" id="edit-admin" name="Admin"><br>
                    <input type="submit" value="Actualizar" class="edit-submit">
                </form>
            </div>
        </div>

        <!-- Modal Agregar -->
        <div id="addModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal('addModal')">&times;</span>
                <form action="agregar_usuario.php" method="POST" class="edit-form">
                    <label for="add-nombre">Nombre:</label>
                    <input type="text" id="add-nombre" name="Nombre" required><br>
                    <label for="add-apellido">Apellido:</label>
                    <input type="text" id="add-apellido" name="Apellido" required><br>
                    <label for="add-email">Email:</label>
                    <input type="email" id="add-email" name="Email" required><br>
                    <label for="add-localidad">Localidad:</label>
                    <input type="text" id="add-localidad" name="Localidad" required><br>
                    <label for="add-direccion">Dirección:</label>
                    <input type="text" id="add-direccion" name="Direccion" required><br>
                    <label for="add-contrasena">Contraseña:</label>
                    <input type="text" id="add-contrasena" name="Contraseña" required><br>
                    <label for="add-admin">Admin:</label>
                    <input type="checkbox" id="add-admin" name="Admin"><br>
                    <input type="submit" value="Agregar" class="edit-submit">
                </form>
            </div>
        </div>

        <script>
            function openEditModal(id, nombre, apellido, email, localidad, direccion, admin) {
                document.getElementById('edit-id').value = id;
                document.getElementById('edit-nombre').value = nombre;
                document.getElementById('edit-apellido').value = apellido;
                document.getElementById('edit-email').value = email;
                document.getElementById('edit-localidad').value = localidad;
                document.getElementById('edit-direccion').value = direccion;
                document.getElementById('edit-admin').checked = admin;
                document.getElementById('editModal').style.display = "block";
            }

            function openAddModal() {
                document.getElementById('addModal').style.display = "block";
            }

            function closeModal(modalId) {
                document.getElementById(modalId).style.display = "none";
            }

            window.onclick = function(event) {
                const editModal = document.getElementById('editModal');
                const addModal = document.getElementById('addModal');
                if (event.target == editModal) {
                    closeModal('editModal');
                } else if (event.target == addModal) {
                    closeModal('addModal');
                }
            }

            function deleteUser(id) {
                if (confirm("¿Estás seguro de que deseas eliminar este usuario?")) {
                    var xhr = new XMLHttpRequest();
                    xhr.open("POST", "eliminar_usuario.php", true);
                    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                    xhr.onreadystatechange = function () {
                        if (xhr.readyState == 4 && xhr.status == 200) {
                            var row = document.getElementById("row-" + id);
                            row.parentNode.removeChild(row);
                        }
                    };
                    xhr.send("ID=" + id);
                }
            }
        </script>
    </main>
    <footer class="footer">
        <p>&copy; 2024 Mi Página. Todos los derechos reservados.</p>
    </footer>
</body>
</html>