<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Compras - PintaEskabio</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="estilos/estilos_admin.css">
    <link rel="stylesheet" type="text/css" href="normalize.css">
    <style>
        .container {
            margin-top: 20px;
        }
        .custom-btn {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 11px 18px;
            cursor: pointer;
            text-decoration: none;
            font-size: 15px;
            border-radius: 6px;
            transition: background-color 0.3s ease;
            font-family: "HelveticaNeue-Light", "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif;
        }
        .custom-btn:hover {
            background-color: #c82333;
        }
        .header a img {
            vertical-align: middle;
            max-width: 100%;
            max-height: 100%;
        }
        .modal-content h4 {
            margin-bottom: 20px;
        }
        .modal-content p {
            margin: 10px 0;
        }
        .modal-footer a {
            margin-right: 10px;
        }
        .product-detail {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }
        .product-detail img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border: 1px solid #000;
            margin-right: 20px;
        }
        .product-detail-info {
            display: flex;
            flex-direction: column;
        }
        .divider {
            height: 2px;
            background-color: #000;
            margin: 20px 0;
        }
        .total-venta {
            font-weight: bold;
            margin-top: 20px;
            text-align: right;
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
    if ($_SESSION['admin'] != 1) {
        header('Location: index_cliente.php');
        exit();
    }
?>
<header class="header">
    <a href="index_admin.php">
        <img src="imagenes/asd.png" alt="Logo de la página" class="logo">
    </a>
    <form action="cerrar_sesion.php" method="post" style="display: inline;">
        <button type="submit" class="custom-btn">Cerrar Sesión</button> 
    </form>
</header>
<div class="container">
    <nav>
        <div class="nav-wrapper blue-grey darken-1">
            <div class="col s12">
                <a href="index_admin.php" class="breadcrumb">Inicio</a>
                <a href="#" class="breadcrumb">Compras</a>
            </div>
        </div>
    </nav>
    <div class="card">
        <div class="card-content">
            <span class="card-title">Registro de Compras</span>
            <table id="salesTable" class="highlight">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Importe</th>
                        <th>Mayorista</th>
                        <th>Detalles de Compra</th>
                    </tr>
                </thead>
                <tbody id="salesTableBody">
                    <?php
                    include 'conexion.php';
                    $query = "SELECT c.ID, c.Fecha AS Fecha, GROUP_CONCAT(p.nombre SEPARATOR ', ') AS Productos, SUM(dc.Precio) AS TotalPrecio, u.nombre AS Cliente
                              FROM compra c
                              JOIN detalle_compra dc ON c.ID = dc.ID_Compra
                              JOIN producto p ON dc.ID_Producto = p.id
                              JOIN proveedor u ON c.ID_Proveedor = u.id
                              GROUP BY c.ID, c.Fecha, u.nombre
                              ORDER BY c.ID DESC";
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
                        echo "<tr><td colspan='6'>No hay Compras registradas</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="fixed-action-btn">
        <a class="btn-floating btn-large waves-light blue modal-trigger" href="#modalAddSale">
            <i class="large material-icons">add</i>
        </a>
    </div>
    <div id="modalAddSale" class="modal">
        <div class="modal-content">
            <h4>Agregar Compra</h4>
            <form id="formAddSale" method="POST" action="consultarCompra.php">
                <div id="productsContainer">
                    <div class="row product-row">
                        <div class="input-field col s12">
                            <i class="material-icons prefix">local_bar</i>
                            <select id="product_0" name="products[0][product]" class="validate product-select" required>
                                <?php
                                $consulta_productos = mysqli_query($conexion, "SELECT id, nombre, PrecioCompra FROM producto");
                                if (mysqli_num_rows($consulta_productos) > 0) {
                                    echo '<option value="" disabled selected>Selecciona un producto</option>';
                                    while ($fila = mysqli_fetch_assoc($consulta_productos)) {
                                        echo '<option value="' . $fila['id'] . '" data-price="' . $fila['PrecioCompra'] . '">' . $fila['nombre'] . '</option>';
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
                <div class="center">
                    <button id="btnAgregar" name="btnAgregar" class="btn waves-effect waves-light" type="button"><i class="material-icons left">add_circle</i>
                        Agregar Producto
                    </button>
                </div>
                <div class="input-field col s12">
                    <i class="material-icons prefix">local_bar</i>
                    <?php
                    $consulta_proveedor = mysqli_query($conexion, "SELECT id, nombre FROM proveedor");
                    if (mysqli_num_rows($consulta_proveedor) > 0) {
                        echo '<select id="client" name="client" class="validate" required>';
                        echo '<option value="" disabled selected>Selecciona el Proveedor</option>';
                        while ($fila = mysqli_fetch_assoc($consulta_proveedor)) {
                            echo '<option value="' . $fila['id'] . '">' . $fila['nombre'] . '</option>';
                        }
                        echo '</select>';
                    } else {
                        echo 'No hay productos disponibles';
                    }
                    ?>
                    <label for="client">Proveedor</label>
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
    <div id="modalViewSale" class="modal">
        <div class="modal-content">
            <h4>Detalles de la Compra</h4>
            <div id="saleDetailsContainer"></div>
        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-close waves-effect waves-light btn blue">Cerrar</a>
        </div>
    </div>
    <script>
        function showSaleDetails(compraID) {
            fetch(`obtenerDetallesCompra.php?compraID=${compraID}`)
                .then(response => response.json())
                .then(data => {
                    const container = document.getElementById('saleDetailsContainer');
                    container.innerHTML = '';
                    let totalVenta = 0;
                    if (data.length > 0) {
                        data.forEach(item => {
                            totalVenta += parseFloat(item.Precio);
                            const detail = document.createElement('div');
                            detail.classList.add('product-detail');
                            detail.innerHTML = `
                                <img src="uploads/${item.Imagen}" alt="Producto">
                                <div class="product-detail-info">
                                    <p>Producto: ${item.Producto}</p>
                                    <p>Descripción: ${item.Descripcion}</p>
                                    <p>Cantidad: ${item.Cantidad}</p>
                                    <p>Tipo de bebida: ${item.Tipo}</p>
                                    <p>Proveedor: ${item.Proveedor}</p>
                                    <p>Precio: $${item.Precio}</p>
                                </div>
                            `;
                            container.appendChild(detail);
                            const divider = document.createElement('div');
                            divider.classList.add('divider');
                            container.appendChild(divider);
                        });
                        const totalVentaText = document.createElement('p');
                        totalVentaText.classList.add('total-venta');
                        totalVentaText.textContent = `TOTAL: $${totalVenta.toFixed(2)}`;
                        container.appendChild(totalVentaText);
                    } else {
                        container.innerHTML = '<p>No hay detalles disponibles.</p>';
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
                            $consulta_productos = mysqli_query($conexion, "SELECT id, nombre, PrecioCompra FROM producto");
                            if (mysqli_num_rows($consulta_productos) > 0) {
                                echo '<option value="" disabled selected>Selecciona un producto</option>';
                                while ($fila = mysqli_fetch_assoc($consulta_productos)) {
                                    echo '<option value="' . $fila['id'] . '" data-price="' . $fila['PrecioCompra'] . '">' . $fila['nombre'] . '</option>';
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
<footer class="footer">
    <p>&copy; 2024 Mi Página. Todos los derechos reservados.</p>
</footer>
</body>