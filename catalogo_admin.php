<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo de Bebidas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/3e32f3aa7a.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="estilos/estilos_catalogos.css">
    <link rel="stylesheet" type="text/css" href="normalize.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Orbitron:wght@900&family=Righteous&family=Seymour+One&display=swap');
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
    <!-- Contenedor para las notificaciones -->
    <div id="notification-container" style="position: fixed; top: 10px; right: 10px; z-index: 1000;"></div>
        <header>
        <div class="nav-arriba">
            <div class="Icono">
                <a href="index.php">
                    <img src="imagenes/asd.png" alt="Logo de la página" class="logo">
                </a>
            </div>
            <div class="Iconos-sesion">
                <form action="cerrar_sesion.php" method="post" style="display: inline;"> <button type="submit" class="btn btn-danger">Cerrar Sesión</button> </form>
            </div>
            <div class="efecto">
                <a href="index_admin.php">Volver al menu Admin -></a>
            </div>
        </div>
        
        <nav class="menu">
            <ul>
                <li><a href="index_cliente.php">Inicio</a></li>
                <li><a href="catalogo_log.php">Catalogo</a></li>
                <li><a href="index_cliente.php#sobre-nosotros">Nosotros</a></li>
                <li><a href="index_cliente.php#Formulario">Contacto</a></li>
            </ul>
        </nav>
    </header>
    <br>

    <main>
        <section class="contenedor_form">
            <div class="form-filtros-contenedor">
                <!-- Campo de búsqueda de palabra clave -->
                <div class="form-filtros">
                    <label>Buscar producto</label>
                    <input type="text" id="PalabraClave" placeholder="Buscar...">
                </div>
                <div class="form-filtros">
                    <label>Precio</label>
                    <select name="Precio" id="Precio">
                        <option value="Todos">Todos</option>
                        <option value="DESC">De mayor a menor</option>
                        <option value="ASC">De menor a mayor</option>
                    </select>
                </div>
                <div class="form-filtros">
                    <label>Tipo de bebida</label>
                    <select name="Tipo" id="Tipo">
                        <option value="Todos">Todos</option>
                        <option value="Aperitivo">Aperitivos</option>
                        <option value="Vodka">Vodkas</option>
                        <option value="Cerveza">Cervezas</option>
                        <option value="Whisky">Whiskys</option>
                        <option value="Vino">Vinos</option>
                        <option value="Champagne">Champagnes</option>
                        <option value="Jugos">Jugos</option>
                        <option value="Energizante">Energizantes</option>
                        <option value="Gaseosa">Gaseosas</option>
                        <option value="Licor">Licores</option>
                    </select>
                </div>
                <div class="form-filtros">
                    <label>Alcohol</label>
                    <select name="Alcohol" id="Alcohol">
                        <option value="Todos">Todos</option>
                        <option value="0">Sin alcohol</option>
                        <option value="1">Con alcohol</option>
                    </select>
                </div>
                <div class="button-container">
                    <button class="botonfiltros" type="button" onclick="buscar_filtro($('#PalabraClave').val(), $('#Precio').val(), $('#Tipo').val(), $('#Alcohol').val())">Buscar</button>
                </div>
            </div>
        </section>
        <section>
            <div class="Catalogo" id="resultado_busqueda">
                <!-- Los resultados de la búsqueda se mostrarán aquí -->
            </div>
        </section>
    </main>

    <!-- Modal Carrito -->
    <div class="modal fade" id="carritoModal" tabindex="-1" aria-labelledby="carritoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="carritoModalLabel">Carrito de Compras</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="carrito-contenido"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-danger" onclick="vaciarCarrito()">Vaciar Carrito</button>
                    <button type="button" class="btn btn-success" onclick="iniciarPagoMercadoPago()">Confirmar compra</button>
                </div>
            </div>
        </div>
    </div>

    <a href="https://api.whatsapp.com/send?phone=1123836055" class="wpp-boton" target="_blank"> 
        <i class="fab fa-whatsapp"></i>
    </a>
    <a class="wpp-boton2" data-bs-toggle="modal" data-bs-target="#carritoModal" style="cursor: pointer;">
        <i class="fas fa-shopping-cart"></i>
    </a>
    <footer class="footer-modern">
        <div class="footer-container">
            <div class="footer-section about">
                <h2 class="footer-title">Sobre Nosotros</h2>
                <p>Somos una tienda dedicada a ofrecer los mejores licores de todo el mundo. Con más de 20 años de experiencia, nos enorgullecemos de nuestra selección de productos de alta calidad y nuestro excelente servicio al cliente.</p>
            </div>
            <div class="footer-section links">
                <h2 class="footer-title">Enlaces Rápidos</h2>
                <ul>
                    <li><a href="index_cliente.php">Inicio</a></li>
                    <li><a href="catalogo_log.php">Productos</a></li>
                    <li><a href="index_cliente.php#sobre-nosotros">Nosotros</a></li>
                    <li><a href="index_cliente.php#Formulario">Contacto</a></li>
                </ul>
            </div>
            <div class="footer-section contact">
                <h2 class="footer-title">Contáctanos</h2>
                <ul>
                    <li><i class="fas fa-phone"></i> +54 1123836055</li>
                    <li><i class="fas fa-envelope"></i> info@tuempresa.com</li>
                    <li><i class="fas fa-map-marker-alt"></i> Calle Falsa 123, Buenos Aires, Argentina</li>
                </ul>
            </div>
            <div class="footer-section social">
                <h2 class="footer-title">Síguenos</h2>
                <div class="social-icons">
                    <a href="https://www.facebook.com"><i class="fab fa-facebook-f"></i></a>
                <a href="https://x.com/home"><i class="fab fa-twitter"></i></a>
                <a href="https://www.instagram.com/"><i class="fab fa-instagram"></i></a>
                <a href="https://www.linkedin.com/feed/"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; UTN FRH – Todos los derechos reservados - 2024</p>
        </div>
    </footer>
    <script>
        let carrito = JSON.parse(localStorage.getItem('carrito')) || [];

        function agregarAlCarrito(id, nombre, imagen, precio, cantidad) {
            const producto = {
                id,
                nombre,
                imagen,
                precio,
                cantidad
            };

            const productoExistente = carrito.find(item => item.id === id);

            if (productoExistente) {
                productoExistente.cantidad += cantidad;
            } else {
                carrito.push(producto);
            }

            localStorage.setItem('carrito', JSON.stringify(carrito));
            actualizarCarrito();
            mostrarNotificacion(`${nombre} se ha añadido al carrito.`);
        }

        function actualizarCarrito() {
            const carritoContenido = document.getElementById('carrito-contenido');
            carritoContenido.innerHTML = '';

            let totalGeneral = 0;

            carrito.forEach((producto, index) => {
                const subtotal = producto.precio * producto.cantidad;
                totalGeneral += subtotal;

                const item = document.createElement('div');
                item.classList.add('producto-en-carrito');
                item.innerHTML = `
                    <div class="producto-detalles">
                        <img src="uploads/${producto.imagen}" alt="${producto.nombre}" class="img-carrito">
                        <div class="producto-info">
                            <p class="negrita">${producto.nombre}</p>
                            <p>Cantidad: ${producto.cantidad}</p>
                            <p>Precio unitario: $${producto.precio.toFixed(2)}</p>
                            <p>Subtotal: $${subtotal.toFixed(2)}</p>
                        </div>
                        <button class="btn btn-danger btn-sm" onclick="eliminarDelCarrito(${index})">Eliminar</button>
                    </div>
                    <hr class="linea-separadora">
                `;
                carritoContenido.appendChild(item);
            });

            const totalElement = document.createElement('div');
            totalElement.classList.add('total-general');
            totalElement.innerHTML = `<p class="negrita">Subtotal: $${totalGeneral.toFixed(2)}</p>`;
            carritoContenido.appendChild(totalElement);
        }

        function eliminarDelCarrito(index) {
            carrito.splice(index, 1);
            localStorage.setItem('carrito', JSON.stringify(carrito));
            actualizarCarrito();
        }

        function vaciarCarrito() {
            carrito.length = 0;
            localStorage.setItem('carrito', JSON.stringify(carrito));
            actualizarCarrito();
        }

        function mostrarNotificacion(mensaje) {
            const notificationContainer = document.getElementById('notification-container');
            const notification = document.createElement('div');
            notification.className = 'alert alert-success';
            notification.textContent = mensaje;
            notificationContainer.appendChild(notification);

            // Eliminar la notificación después de 3 segundos
            setTimeout(() => {
                notification.remove();
            }, 3000);
        }
        
        function confirmarCompra() {
            let carrito = JSON.parse(localStorage.getItem('carrito')) || [];

            // Verificar si el carrito está vacío
            if (carrito.length === 0) {
                mostrarNotificacion('El carrito está vacío');
                return;
            }

            // Crear un objeto FormData para enviar los datos
            let formData = new FormData();
            carrito.forEach((producto, index) => {
                formData.append(`productos[${index}][id]`, producto.id);
                formData.append(`productos[${index}][nombre]`, producto.nombre);
                formData.append(`productos[${index}][precio]`, producto.precio);
                formData.append(`productos[${index}][cantidad]`, producto.cantidad);
            });

            // Realizar la solicitud AJAX para confirmar la compra
            $.ajax({
                url: 'guardar_compra.php',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    let res = JSON.parse(response);
                    mostrarNotificacion(res.message);
                    if (res.status === 'success') {
                        // Vaciar el carrito localmente después de una compra exitosa
                        localStorage.removeItem('carrito');
                        actualizarCarrito(); // Actualizar la visualización del carrito en la página
                    }
                },
                error: function(xhr, status, error) {
                    mostrarNotificacion('Error al confirmar la compra');
                }
            });
        }

        function actualizarTablaVentas() {
            fetch('obtener_ventas.php')
                .then(response => response.json())
                .then(data => {
                    const salesTableBody = document.getElementById('salesTableBody');
                    salesTableBody.innerHTML = ''; // Limpiar tabla existente

                    data.forEach(venta => {
                        const row = document.createElement('tr');
                        row.innerHTML = `
                            <td>${venta.Fecha}</td>
                            <td>${venta.Importe}</td>
                            <td>${venta.Cliente}</td>
                            <td>
                                <a class="btn green modal-trigger" href="#modalViewSale" onclick="showSaleDetails(${venta.ID})"><i class="material-icons">remove_red_eye</i></a>
                            </td>
                        `;
                        salesTableBody.appendChild(row);
                    });
                })
                .catch(error => console.error('Error:', error));
        }

        function buscar_filtro(PalabraClave, Precio, Tipo, Alcohol) {
            var parametros = {"buscar": 1, "PalabraClave": PalabraClave, "Precio": Precio, "Tipo": Tipo, "Alcohol": Alcohol};
            $.ajax({
                data: parametros,
                url: 'buscador.php',
                type: 'POST',
                timeout: 10000,
                success: function(response) {
                    document.getElementById("resultado_busqueda").innerHTML = response;
                    agregarEventosCarrito();
                },
                error: function(response, error) {
                    document.getElementById("resultado_busqueda").innerHTML = '<p>Se produjo un error al buscar los productos.</p>';
                }
            });
        }

        function agregarEventosCarrito() {
            const botonesAgregarCarrito = document.querySelectorAll('.btn-anadir-carrito');
            botonesAgregarCarrito.forEach((boton) => {
                boton.addEventListener('click', () => {
                    const producto = boton.closest('.producto');
                    const id = producto.dataset.id;
                    const nombre = producto.querySelector('h2').innerText;
                    const imagen = producto.querySelector('img').src.split('/').pop();
                    const precioTexto = producto.querySelector('.precio').innerText;
                    const precio = parseFloat(precioTexto.replace('Precio: $', '').replace(',', ''));
                    const cantidad = parseInt(producto.querySelector('.stock').value);
                    agregarAlCarrito(id, nombre, imagen, precio, cantidad);
                });
            });
        }

        $(document).ready(function() {
            buscar_filtro('', 'Todos', 'Todos', 'Todos');
            actualizarCarrito(); // Cargar carrito desde localStorage al cargar la página
        });
    </script>
    <!-- Scripts al final del body -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/script.js"></script>
    <script src="https://sdk.mercadopago.com/js/v2"></script>
    <script>
        // Función para iniciar el pago con Mercado Pago
        function iniciarPagoMercadoPago() {
            let carrito = JSON.parse(localStorage.getItem('carrito')) || [];

            // Verificar si el carrito está vacío
            if (carrito.length === 0) {
                mostrarNotificacion('El carrito está vacío');
                return;
            }

            // Preparar los items para enviar a Mercado Pago
            let items = carrito.map((producto) => ({
                id: producto.id.toString(),
                title: producto.nombre,
                description: `Cantidad: ${producto.cantidad}`,
                quantity: producto.cantidad,
                currency_id: 'ARS', // Moneda (ejemplo: ARS para Pesos Argentinos)
                unit_price: producto.precio,
            }));

            // Crear la preferencia de pago en Mercado Pago
            fetch('crear_preferencia.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    items: items,
                    payer: {
                        email: 'usuario123@example.com', // Usar un email ficticio válido
                    },
                }),
            })
            .then(response => response.json())
            .then(data => {
                // Verificar si se recibió el init_point en la respuesta
                if (data.init_point) {
                    // Redirigir a la página de Mercado Pago para completar el pago
                    window.location.href = data.init_point;
                } else {
                    console.error('Error al obtener init_point de Mercado Pago:', data);
                    mostrarNotificacion('Error al iniciar el pago con Mercado Pago');
                }
            })
            .catch(error => {
                console.error('Error al crear la preferencia:', error);
                mostrarNotificacion('Error al iniciar el pago con Mercado Pago');
            });
        }

        // Función para mostrar notificaciones
        function mostrarNotificacion(mensaje) {
            const notificationContainer = document.getElementById('notification-container');
            const notification = document.createElement('div');
            notification.className = 'alert alert-success';
            notification.textContent = mensaje;
            notificationContainer.appendChild(notification);

            // Eliminar la notificación después de 3 segundos
            setTimeout(() => {
                notification.remove();
            }, 3000);
        }

        // Document ready
        $(document).ready(function() {
            // Llamar a la función para cargar los productos al inicio
            buscar_filtro('', 'Todos', 'Todos', 'Todos');
        });
    </script>
</body>
</html>
