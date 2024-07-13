<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Productos - PintaEskabio</title>
    <link rel="stylesheet" type="text/css" href="estilos/estilos_productos.css">
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
        .delete-button:hover {
            background-color: #c82333;
        }
        td.delete-cell {
            text-align: center;
        }
        .product-table th {
            text-align: center;
            vertical-align: middle;
        }
        .product-table th, .product-table td {
            padding: 12px 15px;
        }
        .product-table thead tr {
            background-color: #009879;
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

                $consulta = mysqli_query($conexion, "SELECT * FROM producto");

                if (mysqli_num_rows($consulta) > 0) {
                    echo '<table class="product-table">';
                    echo '<thead><tr><th>Nombre</th><th>Descripción</th><th>Precio Compra</th><th>Precio Venta</th><th>Stock</th><th>Alcohol</th><th>Tipo</th><th>Activo</th><th>Imagen</th><th>Acciones</th></tr>
                        </thead>';
                    echo '<tbody>';
                    while ($resultado = mysqli_fetch_array($consulta)) {
                        echo '<tr id="row-' . $resultado["ID"] . '">';
                        echo '<td>' . $resultado["Nombre"] . '</td>';
                        echo '<td>' . $resultado["Descripcion"] . '</td>';
                        echo '<td>' . $resultado["PrecioCompra"] . '</td>';
                        echo '<td>' . $resultado["PrecioVenta"] . '</td>';
                        echo '<td>' . $resultado["Stock"] . '</td>';
                        echo '<td>' . $resultado["Alcohol"] . '</td>';
                        echo '<td>' . $resultado["Tipo"] . '</td>';
                        echo '<td>' . $resultado["Activo"] . '</td>';
                        echo '<td><img src="uploads/' . $resultado["Imagen"] . '" alt="Imagen del producto" width="50"></td>';
                        echo '<td><button class="edit-button" onclick="openEditModal(' . $resultado["ID"] . ', \'' . $resultado["Nombre"] . '\', \'' . $resultado["Descripcion"] . '\', \'' . $resultado["PrecioCompra"] . '\', \'' . $resultado["PrecioVenta"] . '\', \'' . $resultado["Stock"] . '\', \'' . $resultado["Alcohol"] . '\', \'' . $resultado["Tipo"] . '\', \'' . $resultado["Activo"] . '\', \'' . $resultado["Imagen"] . '\')">Editar</button><button class="delete-button" onclick="deleteUser(' . $resultado["ID"] . ')"><i class="fas fa-trash-alt"></i></button></td>';
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
    </main>
    <footer class="footer">
        <p>&copy; 2024 Mi Página. Todos los derechos reservados.</p>
    </footer>

    <!-- Edit Modal -->
    <div id="editModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeEditModal()">&times;</span>
            <form action="actualizar_productos.php" method="POST" class="edit-form" id="editForm" enctype="multipart/form-data">
                <input type="hidden" id="editID" name="id">
                <label for="editNombre">Nombre:</label>
                <input type="text" id="editNombre" name="nombre">
                <label for="editDescripcion">Descripción:</label>
                <input type="text" id="editDescripcion" name="descripcion">
                <label for="editPrecioCompra">Precio Compra:</label>
                <input type="text" id="editPrecioCompra" name="precioCompra">
                <label for="editPrecioVenta">Precio Venta:</label>
                <input type="text" id="editPrecioVenta" name="precioVenta">
                <label for="editStock">Stock:</label>
                <input type="text" id="editStock" name="stock">
                <label for="editAlcohol">Alcohol:</label>
                <input type="text" id="editAlcohol" name="alcohol">
                <label for="editTipo">Tipo:</label>
                <input type="text" id="editTipo" name="tipo">
                <label for="editActivo">Activo:</label>
                <input type="text" id="editActivo" name="activo">
                <label for="editImagen">Imagen:</label>
                <input type="file" id="editImagen" name="imagen">
                <input type="hidden" id="editImagenActual" name="imagen_actual">
                <button type="submit" class="edit-submit">Guardar</button>
            </form>
        </div>
    </div>

    <!-- Add Modal -->
    <div id="addModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeAddModal()">&times;</span>
            <form action="agregar_productos.php" method="POST" class="edit-form" id="addForm" enctype="multipart/form-data">
                <label for="addNombre">Nombre:</label>
                <input type="text" id="addNombre" name="nombre">
                <label for="addDescripcion">Descripción:</label>
                <input type="text" id="addDescripcion" name="descripcion">
                <label for="addPrecioCompra">Precio Compra:</label>
                <input type="text" id="addPrecioCompra" name="precioCompra">
                <label for="addPrecioVenta">Precio Venta:</label>
                <input type="text" id="addPrecioVenta" name="precioVenta">
                <label for="addStock">Stock:</label>
                <input type="text" id="addStock" name="stock">
                <label for="addAlcohol">Alcohol:</label>
                <input type="text" id="addAlcohol" name="alcohol">
                <label for="addTipo">Tipo:</label>
                <input type="text" id="addTipo" name="tipo">
                <label for="addActivo">Activo:</label>
                <input type="text" id="addActivo" name="activo">
                <label for="addImagen">Imagen:</label>
                <input type="file" id="addImagen" name="imagen">
                <button type="submit" class="edit-submit">Agregar</button>
            </form>
        </div>
    </div>

    <script>
        function openEditModal(id, nombre, descripcion, precioCompra, precioVenta, stock, alcohol, tipo, activo, imagen) {
            document.getElementById('editID').value = id;
            document.getElementById('editNombre').value = nombre;
            document.getElementById('editDescripcion').value = descripcion;
            document.getElementById('editPrecioCompra').value = precioCompra;
            document.getElementById('editPrecioVenta').value = precioVenta;
            document.getElementById('editStock').value = stock;
            document.getElementById('editAlcohol').value = alcohol;
            document.getElementById('editTipo').value = tipo;
            document.getElementById('editActivo').value = activo;
            document.getElementById('editImagenActual').value = imagen;
            document.getElementById('editModal').style.display = 'block';
        }

        function closeEditModal() {
            document.getElementById('editModal').style.display = 'none';
        }

        function openAddModal() {
            document.getElementById('addModal').style.display = 'block';
        }

        function closeAddModal() {
            document.getElementById('addModal').style.display = 'none';
        }

        window.onclick = function(event) {
            const editModal = document.getElementById('editModal');
            const addModal = document.getElementById('addModal');
            if (event.target == editModal) {
                closeEditModal();
            } else if (event.target == addModal) {
                closeAddModal();
            }
        }

        function deleteUser(id) {
            if (confirm("¿Estás seguro de que deseas eliminar este producto?")) {
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "eliminar_producto.php", true);
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
</body>
</html>