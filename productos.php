<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Página</title>
    <link rel="stylesheet" type="text/css" href="estilos/estilos_productos.css">
    <link rel="stylesheet" type="text/css" href="normalize.css">
</head>
<body class="body-principal">
    <header class="header">
        <a href="indexadmin.html">
            <img src="imagenes/asd.png" alt="Logo de la página" class="logo">
        </a>
    </header>
    <main>
        <div class="table-container">
            <button class="add-button" onclick="openAddModal()">+</button>
            <?php
                include 'conexion.php';

                $consulta = mysqli_query($conexion, "SELECT * FROM producto");

                if (mysqli_num_rows($consulta) > 0) {
                    echo '<table class="product-table">';
                    echo '<thead><tr><th>ID</th><th>Nombre</th><th>Descripción</th><th>Precio Compra</th><th>Precio Venta</th><th>Stock</th><th>Alcohol</th><th>Tipo</th><th>Activo</th><th>Imagen</th><th>Acciones</th></tr></thead>';
                    echo '<tbody>';
                    while ($resultado = mysqli_fetch_array($consulta)) {
                        echo '<tr>';
                        echo '<td>' . $resultado["ID"] . '</td>';
                        echo '<td>' . $resultado["Nombre"] . '</td>';
                        echo '<td>' . $resultado["Descripcion"] . '</td>';
                        echo '<td>' . $resultado["PrecioCompra"] . '</td>';
                        echo '<td>' . $resultado["PrecioVenta"] . '</td>';
                        echo '<td>' . $resultado["Stock"] . '</td>';
                        echo '<td>' . $resultado["Alcohol"] . '</td>';
                        echo '<td>' . $resultado["Tipo"] . '</td>';
                        echo '<td>' . $resultado["Activo"] . '</td>';
                        echo '<td><img src="uploads/' . $resultado["Imagen"] . '" alt="Imagen del producto" width="50"></td>';
                        echo '<td><button class="edit-button" onclick="openEditModal(' . $resultado["ID"] . ', \'' . $resultado["Nombre"] . '\', \'' . $resultado["Descripcion"] . '\', \'' . $resultado["PrecioCompra"] . '\', \'' . $resultado["PrecioVenta"] . '\', \'' . $resultado["Stock"] . '\', \'' . $resultado["Alcohol"] . '\', \'' . $resultado["Tipo"] . '\', \'' . $resultado["Activo"] . '\', \'' . $resultado["Imagen"] . '\')">Editar</button></td>';
                        echo '</tr>';
                    }
                    echo '</tbody>';
                    echo '</table>';
                } else {
                    echo '<p>No hay datos disponibles.</p>';
                }

                mysqli_close($conexion);
            ?> 
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
    </script>
</body>
</html>
