<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo de Bebidas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/3e32f3aa7a.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="estilos/estilo_catalogos.css">
    <link rel="stylesheet" type="text/css" href="normalize.css">
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="body-principal">
    <?php session_start() ?>
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
        </div>
        
        <nav class="menu">
            <ul>
                <li><a href="index.php">Inicio</a></li>
                <li><a href="catalogo_sinlog.php">Catalogo</a></li>
                <li><a href="index.php#sobre-nosotros">Nosotros</a></li>
                <li><a href="index.php#Formulario">Contacto</a></li>
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
                    <button type="button" class="btn btn-success" onclick="confirmarCompra()">Confirmar compra</button>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/script.js"></script>
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

        async function confirmarCompra() {
            const { jsPDF } = window.jspdf;

            const doc = new jsPDF();

            // Título del documento
            doc.setFontSize(18);
            doc.text('Resumen de la Compra', 20, 20);

            // Variables de posicionamiento en el PDF
            let yPos = 30;

            carrito.forEach((producto, index) => {
                doc.setFontSize(12);
                doc.text(`Producto: ${producto.nombre}`, 20, yPos);
                doc.text(`Cantidad: ${producto.cantidad}`, 20, yPos + 10);
                doc.text(`Precio: $${(producto.precio * producto.cantidad).toFixed(2)}`, 20, yPos + 20);
                yPos += 30;
            });

            // Precio total
            const precioTotal = carrito.reduce((total, producto) => total + (producto.precio * producto.cantidad), 0);
            doc.setFontSize(14);
            doc.text(`Total: $${precioTotal.toFixed(2)}`, 20, yPos);

            // Guardar el PDF
            doc.save('Resumen_de_compra.pdf');
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
    <script>
        async function confirmarCompra() {
            const { jsPDF } = window.jspdf;

            const doc = new jsPDF();

            // Título del documento
            doc.setFontSize(18);
            doc.text('Resumen de la Compra', 20, 20);

            // Variables de posicionamiento en el PDF
            let yPos = 30;

            carrito.forEach((producto, index) => {
                doc.setFontSize(12);
                doc.text(`Producto: ${producto.nombre}`, 20, yPos);
                doc.text(`Cantidad: ${producto.cantidad}`, 20, yPos + 10);
                doc.text(`Precio: $${(producto.precio * producto.cantidad).toFixed(2)}`, 20, yPos + 20);
                yPos += 30;
            });

            // Precio total
            const precioTotal = carrito.reduce((total, producto) => total + (producto.precio * producto.cantidad), 0);
            doc.setFontSize(14);
            doc.text(`Total: $${precioTotal.toFixed(2)}`, 20, yPos);

            // Guardar el PDF
            doc.save('Resumen_de_compra.pdf');
        }
    </script>
</body>
</html>
