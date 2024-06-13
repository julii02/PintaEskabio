
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Ventas - Empresa de Alcohol</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="estilos/estilos_admin.css">
    <link rel="stylesheet" type="text/css" href="normalize.css">
    <style>
        /* Agrega un margen superior a la tabla */
        .container {
            margin-top: 20px;
        }
    </style>
</head>
<body>
<?php
    session_start();
    if (!isset($_SESSION['usuario'])) {
        header('Location: form_iniciosesion.html');
        exit();
    }

    // Código de la página protegida
?>
<header class="header">
        <a href="index_admin.php">
            <img src="imagenes/asd.png" alt="Logo de la página" class="logo">
        </a>
</header>
<div class="container">
    <!-- Breadcrumbs -->
    <nav>
        <div class="nav-wrapper blue-grey darken-1">
            <div class="col s12">
                <a href="index_admin.php" class="breadcrumb">Inicio</a>
                <a href="#" class="breadcrumb">Ventas</a>
            </div>
        </div>
    </nav>

    <!-- Tabla de mostrado -->
    <div class="card">
        <div class="card-content">
            <span class="card-title">Registro de Ventas</span>
            <table id="salesTable" class="highlight">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Importe</th>
                        <th>Cliente</th>
                        <th>Detalles de Venta</th>
                    </tr>
                </thead>
                <tbody id="salesTableBody">
                    <?php
                    include 'conexion.php';
                    $query = "SELECT v.ID, v.Fecha, GROUP_CONCAT(p.nombre SEPARATOR ', ') AS Productos, SUM(dv.Precio) AS TotalPrecio, u.nombre AS Cliente
                              FROM venta v
                              JOIN detalle_venta dv ON v.ID = dv.ID_Venta
                              JOIN producto p ON dv.ID_Producto = p.id
                              JOIN usuario u ON v.ID_Usuario = u.id
                              GROUP BY v.ID, v.Fecha, u.nombre
                              ORDER BY v.Fecha DESC";
                    $result = mysqli_query($conexion, $query);
                    $totalVentas = 0;
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $totalVenta = $row['TotalPrecio'];
                            $totalVentas += $totalVenta;
                            echo "<tr>
                                    <td>{$row['Fecha']}</td>
                                    <td>\${$totalVenta}</td>
                                    <td>{$row['Cliente']}</td>
                                    <td>
                                        <a class='btn green modal-trigger' href='#modalViewSale' onclick='showSaleDetails({$row['ID']})'><i class='material-icons'>remove_red_eye</i></a>
                                    </td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>No hay ventas registradas</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Boton del ojito -->
    <div class="fixed-action-btn">
        <a class="btn-floating btn-large waves-light blue modal-trigger" href="#modalAddSale">
            <i class="large material-icons">add</i>
        </a>
    </div>

    <!-- Tabla de adición -->
    <div id="modalAddSale" class="modal">
        <div class="modal-content">
            <h4>Agregar Venta</h4>
            <form id="formAddSale" method="POST" action="consultarVenta.php">
                <div id="productsContainer">
                    <div class="row product-row">
                        <div class="input-field col s12">
                            <i class="material-icons prefix">local_bar</i>
                            <select id="product_0" name="products[0][product]" class="validate product-select" required>
                                <?php
                                $consulta_productos = mysqli_query($conexion, "SELECT id, nombre, PrecioVenta FROM producto");
                                if (mysqli_num_rows($consulta_productos) > 0) {
                                    echo '<option value="" disabled selected>Selecciona un producto</option>';
                                    while ($fila = mysqli_fetch_assoc($consulta_productos)) {
                                        echo '<option value="' . $fila['id'] . '" data-price="' . $fila['PrecioVenta'] . '">' . $fila['nombre'] . '</option>';
                                    }
                                } else {
                                    echo '<option value="" disabled>No hay productos disponibles</option>';
                                }
                                ?>
                            </select>
                            <label for="product_0">Producto</label>
                        </div>
                        <div class="input-field col s12">
                            <i class="material-icons prefix">confirmation_number</i>
                            <input type="number" id="quantity_0" name="products[0][quantity]" class="validate" required>
                            <label for="quantity_0">Cantidad</label>
                        </div>
                        <div class="input-field col s12">
                            <i class="material-icons prefix">attach_money</i>
                            <input type="number" step="0.01" id="price_0" name="products[0][price]" class="validate" required readonly>
                            <label id="price_label_0" for="price_0">Precio</label>
                        </div>
                        <script>
                            document.getElementById("product_0").addEventListener("change", function() {
                                var selectedOption = this.options[this.selectedIndex];
                                var price = selectedOption.getAttribute("data-price");
                                document.getElementById("price_0").value = price;
                                document.getElementById("price_label_0").classList.add("active");
                            });
                        </script>
                        <script>
                            document.getElementById("quantity_0").addEventListener("input", function() {
                                var quantity = parseFloat(this.value);
                                var selectedOption = document.getElementById("product_0").options[document.getElementById("product_0").selectedIndex];
                                var price = parseFloat(selectedOption.getAttribute("data-price"));
                                var totalPrice = quantity * price;
                                document.getElementById("price_0").value = totalPrice;
                            });
                        </script>
                    </div>
                </div>
                <!-- Botón para agregar un nuevo producto -->
                <div class="center">
                    <button id="btnAgregar" name="btnAgregar" class="btn waves-effect waves-light" type="button"><i class="material-icons left">add_circle</i>
                        Agregar Producto
                    </button>
                </div>
                <div class="input-field col s12">
                    <i class="material-icons prefix">local_bar</i>
                    <?php
                    $consulta_cliente = mysqli_query($conexion, "SELECT id, nombre FROM usuario");
                    if (mysqli_num_rows($consulta_cliente) > 0) {
                        echo '<select id="client" name="client" class="validate" required>';
                        echo '<option value="" disabled selected>Selecciona un cliente</option>';
                        while ($fila = mysqli_fetch_assoc($consulta_cliente)) {
                            echo '<option value="' . $fila['id'] . '">' . $fila['nombre'] . '</option>';
                        }
                        echo '</select>';
                    } else {
                        echo 'No hay productos disponibles';
                    }
                    ?>
                    <label for="client">Cliente</label>
                </div>
                <div class="input-field col s12">
                    <i class="material-icons prefix">date_range</i>
                    <input type="text" class="datepicker" id="date" name="date" required>
                    <label for="date">Fecha</label>
                </div>
                <div class="col s12">
                    <div class="center">
                        <button type="submit" id="btnAceptar" class="waves-effect waves-light btn blue">Agregar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
    <!-- Vista con detalles de la venta -->
    <div id="modalViewSale" class="modal">
        <div class="modal-content">
            <h4>Detalles de la Venta</h4>
            <p>Fecha: <span id="viewDate"></span></p>
            <p>Productos: <span id="viewProducts"></span></p>
            <p>Cantidades: <span id="viewQuantities"></span></p>
            <p>Precios: <span id="viewPrices"></span></p>
            <p>Cliente: <span id="viewCustomer"></span></p>
        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-close waves-effect waves-light btn blue">Cerrar</a>
        </div>
    </div>

    <script>
    function showSaleDetails(ventaID) {
    fetch(`obtenerDetallesVenta.php?ventaID=${ventaID}`)
        .then(response => response.json())
        .then(data => {
            if (data.length > 0) {
                document.getElementById('viewDate').textContent = data[0].Fecha;
                let productos = [], cantidades = [], precios = [];
                data.forEach(item => {
                    productos.push(item.Producto);
                    cantidades.push(item.Cantidad);
                    precios.push(item.Precio);
                });
                document.getElementById('viewProducts').textContent = productos.join(', ');
                document.getElementById('viewQuantities').textContent = cantidades.join(', ');
                document.getElementById('viewPrices').textContent = precios.map(price => `$${price}`).join(', ');
                document.getElementById('viewCustomer').textContent = data[0].Cliente;
            } else {
                document.getElementById('viewDate').textContent = '';
                document.getElementById('viewProducts').textContent = '';
                document.getElementById('viewQuantities').textContent = '';
                document.getElementById('viewPrices').textContent = '';
                document.getElementById('viewCustomer').textContent = '';
            }
            var modal = document.getElementById('modalViewSale');
            var instance = M.Modal.getInstance(modal);
            instance.open();
        })
        .catch(error => console.error('Error:', error));
    }
    </script>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script src="js/materialize.js"></script>

<script>
        $(document).ready(function() {
            $('.modal').modal();
            $('select').formSelect();
            $('.datepicker').datepicker({
                format: 'yyyy-mm-dd'
            });

            $('#btnAgregar').click(function() {
                var productIndex = $('.product-row').length;
                var productRow = `
                    <div class="row product-row">
                        <div class="input-field col s12">
                            <i class="material-icons prefix">local_bar</i>
                            <select id="product_${productIndex}" name="products[${productIndex}][product]" class="validate product-select" required>
                                <?php
                                $consulta_productos = mysqli_query($conexion, "SELECT id, nombre, PrecioVenta FROM producto");
                                if (mysqli_num_rows($consulta_productos) > 0) {
                                    echo '<option value="" disabled selected>Selecciona un producto</option>';
                                    while ($fila = mysqli_fetch_assoc($consulta_productos)) {
                                        echo '<option value="' . $fila['id'] . '" data-price="' . $fila['PrecioVenta'] . '">' . $fila['nombre'] . '</option>';
                                    }
                                } else {
                                    echo '<option value="" disabled>No hay productos disponibles</option>';
                                }
                                ?>
                            </select>
                            <label for="product_${productIndex}">Producto</label>
                        </div>
                        <div class="input-field col s12">
                            <i class="material-icons prefix">confirmation_number</i>
                            <input type="number" id="quantity_${productIndex}" name="products[${productIndex}][quantity]" class="validate" required>
                            <label for="quantity_${productIndex}">Cantidad</label>
                        </div>
                        <div class="input-field col s12">
                            <i class="material-icons prefix">attach_money</i>
                            <input type="number" step="0.01" id="price_${productIndex}" name="products[${productIndex}][price]" class="validate" required readonly>
                            <label id="price_label_${productIndex}" for="price_${productIndex}">Precio</label>
                        </div>
                    </div>
                `;
                $('#productsContainer').append(productRow);

                $('#product_' + productIndex).formSelect();

                $('#product_' + productIndex).change(function() {
                    var selectedOption = this.options[this.selectedIndex];
                    var price = selectedOption.getAttribute("data-price");
                    $('#price_' + productIndex).val(price);
                    $('#price_label_' + productIndex).addClass('active');
                });

                $('#quantity_' + productIndex).on('input', function() {
                    var quantity = parseFloat(this.value);
                    var selectedOption = $('#product_' + productIndex).find('option:selected');
                    var price = parseFloat(selectedOption.attr('data-price'));
                    var totalPrice = quantity * price;
                    $('#price_' + productIndex).val(totalPrice);
                });
            });
        });
    </script>
</div>
<footer class="footer">
    <p>&copy; 2024 Mi Página. Todos los derechos reservados.</p>
</footer>
</body>
</html>
