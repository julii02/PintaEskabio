<!DOCTYPE html>
<html>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Mi Página</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

        <script src="https://kit.fontawesome.com/3e32f3aa7a.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <link rel="stylesheet" type="text/css" href="estilos/estilo_clien_sinlog_j.css">
        <link rel="stylesheet" type="text/css" href="normalize.css">
        <link rel="stylesheet" href="estilos/lightbox.css">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css" />
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Orbitron:wght@900&family=Righteous&family=Seymour+One&display=swap');
        </style>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    </head>
    <?php
        session_start();
        if (!isset($_SESSION['usuario'])) {
            header('Location: form_iniciosesion.html');
            exit();
        }

        // Código de la página protegida
    ?>
    <body class="body-principal">
        <header>
            <div class="nav-arriba">
                <div class="Icono">
                    <a href="index_cliente.php">
                        <img src="imagenes/asd.png" alt="Logo de la página" class="logo">
                    </a>
                </div>
                <div class="Iconos-sesion">
                    <form action="cerrar_sesion.php" method="post" style="display: inline;"> <button type="submit" class="btn btn-danger">Cerrar Sesión</button> </form>
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
        <article>
            <div class="principal-carousel" id="carrusel">
                <div class="container-carousel">
                    <div class="carruseles" id="slider"> 
                        <div class="slider-section">
                            <img src="imagenes/pr1.png" alt="Imagen 1" class="gallery-image">
                        </div>
                        <div class="slider-section">
                            <img src="imagenes/principal1.jpg" alt="Imagen 2" class="gallery-image">
                        </div>
                        <div class="slider-section">
                            <img src="imagenes/principal3.jpg" alt="Imagen 3" class="gallery-image">
                        </div>
                        <div class="slider-section">
                            <img src="imagenes/principal2.jpg" alt="Imagen 4" class="gallery-image">
                        </div>
                        <div class="slider-section">
                            <img src="imagenes/principal4.jpg" alt="Imagen 5" class="gallery-image">
                        </div>
                        <div class="slider-section">
                            <img src="imagenes/principal5.jpg" alt="Imagen 6" class="gallery-image">
                        </div>
                        <div class="slider-section">
                            <img src="imagenes/principal6.jpg" alt="Imagen 7" class="gallery-image">
                        </div>
                        <div class="slider-section">
                            <img src="imagenes/principal7.jpg" alt="Imagen 8" class="gallery-image">
                        </div>
                        <div class="slider-section">
                            <img src="imagenes/principal8.jpg" alt="Imagen 9" class="gallery-image">
                        </div>
                        <div class="slider-section">
                            <img src="imagenes/principal9.jpg" alt="Imagen 10" class="gallery-image">
                        </div>
                    </div> 
                    <div class="btn-left"><i class='bx bx-chevron-left'></i></div>
                    <div class="btn-right"><i class='bx bx-chevron-right'></i></div>         
                </div>
            </div>
            <section class="information container">
                <div class ="information-content">
                    <div class = "information-1">
                        <i class="ti ti-building-store"></i>
                        <h3>Atencion 24hrs</h3>
                        <p>
                            Estamos 24 /7 
                        </p>
                    </div>
                    <div class = "information-1">
                        <i class="ti ti-star"></i>
                        <h3>Pago seguro</h3>
                        <p>
                            10+ años de trayectoria y experiencia en el rubro.
                        </p>
                    </div>
                    <div class = "information-1">
                        <i class="ti ti-shopping-bag-check"></i>
                        <h3>Variedad</h3>
                        <p>
                            Contamos con un gran surtido de productos.
                        </p>
                    </div>
                </div>
            </section>
        </article>

        <section id="productos" class="productos seccion">
                <h2>Nuestros Productos</h2>
                <div class="product-list">
                    <a href="catalogo_log.php" class="product-item">
                        <img src="imagenes/marcas/producto.png" alt="Vino">
                        <h3>Con alcohol</h3>
                    </a>
                    <a href="catalogo_log.php" class="product-item">
                        <img src="imagenes/marcas/producto2.png" alt="Vino">
                        <h3>Gaseosas</h3>
                    </a>
                    <a href="catalogo_log.php" class="product-item">
                        <img src="imagenes/marcas/producto3.png" alt="Vino">
                        <h3>Aperitivos</h3>
                    </a>
                    <a href="catalogo_log.php" class="product-item">
                        <img src="imagenes/marcas/producto4.png" alt="Vino">
                        <h3>Energizantes</h3>
                    </a>
                    <a href="catalogo_log.php" class="product-item">
                        <img src="imagenes/marcas/producto5.png" alt="Vino">
                        <h3>Cervezas</h3>
                    </a>
                    <!-- Más productos -->
                </div>
        </section>

        <section  class="sobre-nosotros seccion">
            <div class="about-content"  id="nosotros">
                <div class="about-column nosotros">
                    <h3>Quienes Somos</h3>
                    <p>Somos una tienda dedicada a ofrecer los mejores licores de todo el mundo.
                        Con más de 20 años de experiencia en el mercado, nos enorgullecemos de nuestra selección de productos de alta calidad y nuestro excelente servicio al cliente. Nuestro objetivo es brindar a nuestros clientes una experiencia única y satisfactoria al descubrir y disfrutar de los mejores licores.
                    </p>
                    <a href="#Formulario">
                        <div>Saber mas</div>
                        <i class="ti ti-arrow-big-right"></i>
                    </a>

                </div>
                <div class="about-column">
                    <img src="imagenes/principal.jpg" alt="Sobre Nosotros">
                </div>
            </div>
        </section>

        <div class="slider-container" id="marcas">
            <h2>Marcas que confían en nosotros</h2>
            <div class="slider-img">
                <div class="slide-track">
                    <div class="slide"><img src="imagenes/marcas/marca1.png" alt="Marca 1"></div>
                    <div class="slide"><img src="imagenes/marcas/marca2.png" alt="Marca 2"></div>
                    <div class="slide"><img src="imagenes/marcas/marca3.png" alt="Marca 3"></div>
                    <div class="slide"><img src="imagenes/marcas/marca4.png" alt="Marca 4"></div>
                    <div class="slide"><img src="imagenes/marcas/marca5.png" alt="Marca 5"></div>
                    <div class="slide"><img src="imagenes/marcas/marca6.png" alt="Marca 5"></div>
                    <div class="slide"><img src="imagenes/marcas/marca7.png" alt="Marca 5"></div>
                    <div class="slide"><img src="imagenes/marcas/marca8.png" alt="Marca 5"></div>
                    <div class="slide"><img src="imagenes/marcas/marca9.png" alt="Marca 5"></div>
                    <div class="slide"><img src="imagenes/marcas/marca10.png" alt="Marca 5"></div>
                    <div class="slide"><img src="imagenes/marcas/marca11.png" alt="Marca 5"></div>

                    <!-- Repeat slides for continuous effect -->
                    <div class="slide"><img src="imagenes/marcas/marca1.png" alt="Marca 1"></div>
                    <div class="slide"><img src="imagenes/marcas/marca2.png" alt="Marca 2"></div>
                    <div class="slide"><img src="imagenes/marcas/marca3.png" alt="Marca 3"></div>
                    <div class="slide"><img src="imagenes/marcas/marca4.png" alt="Marca 4"></div>
                    <div class="slide"><img src="imagenes/marcas/marca5.png" alt="Marca 5"></div>
                    <div class="slide"><img src="imagenes/marcas/marca6.png" alt="Marca 5"></div>
                    <div class="slide"><img src="imagenes/marcas/marca7.png" alt="Marca 5"></div>
                    <div class="slide"><img src="imagenes/marcas/marca8.png" alt="Marca 5"></div>
                    <div class="slide"><img src="imagenes/marcas/marca9.png" alt="Marca 5"></div>
                    <div class="slide"><img src="imagenes/marcas/marca10.png" alt="Marca 5"></div>
                    <div class="slide"><img src="imagenes/marcas/marca11.png" alt="Marca 5"></div>
                </div>
            </div>
        </div>

        <section class="faq" id="Preguntas">
            <div class="faq-item">
                <div class="faq-question">
                    ¿Hay mínimo de compra?
                    <span class="indicator">&#9660;</span>
                </div>
                <div class="faq-answer">La compra mínima es de $30.000 retirando por depósito. Para envíos la compra mínima es de $60.000.</div>
            </div>
            <div class="faq-item">
                <div class="faq-question">
                    ¿Realizan envíos?
                    <span class="indicator">&#9660;</span>
                </div>
                <div class="faq-answer">Sí, enviamos con logística propia en todo CABA y en algunas localidades de GBA. También hacemos envíos a todo el país a través de distintos expresos y transportes.</div>
            </div>
            <div class="faq-item">
                <div class="faq-question">
                    ¿Tiene costo de envío?
                    <span class="indicator">&#9660;</span>
                </div>
                <div class="faq-answer">El envío tiene un costo de $2.500 en CABA. Si el pedido es mayor a $300.000, dicho costo queda bonificado. Si el pedido es a través de un transporte o expreso, el mismo corre por cuenta del cliente. Para envíos en GBA, consultar precios.</div>
            </div>
            <div class="faq-item">
                <div class="faq-question">
                    ¿Cuánto demoran las entregas?
                    <span class="indicator">&#9660;</span>
                </div>
                <div class="faq-answer">Las entregas tienen un plazo máximo de 72 hs hábiles.</div>
            </div>
            <div class="faq-item">
                <div class="faq-question">
                    ¿Cuáles son los medios de pago?
                    <span class="indicator">&#9660;</span>
                </div>
                <div class="faq-answer">Aceptamos pagos mediante efectivo, depósito bancario o transferencia bancaria.</div>
            </div>
        </section>

        <section class="Formulario-principal seccion" id = "Formulario">
            <div class="content-empresa" >
                <div class="company-info">
                    <img src="imagenes/asd.png" alt="Logo de la página">
                    <p>¿Tenes dudas? Rellena el siguiente formulario o escribirnos a nuestros medios de contacto y pronto nos pondremos en comunicación con vos.</p>
                    <div class="social-media">
                        <a href="#" class="social-icon"><i class="ti ti-brand-facebook"></i></a>
                        <a href="#" class="social-icon"><i class="ti ti-brand-instagram"></i></a>
                        <a href="#" class="social-icon"><i class="ti ti-mail"></i></a>
                    </div>
                </div>
            </div>
            <div class="form-container" id="contacto">
        <form class="form-aspecto" id="contactForm" action="email_contacto.php" method="POST">
            <h2>Dejanos tu mensaje</h2>
            <label for="fname">Nombre</label>
            <input type="text" id="fname" name="firstname" placeholder="Tu nombre..">

            <label for="lname">Apellido</label>
            <input type="text" id="lname" name="lastname" placeholder="Tu apellido..">

            <label for="phone">Teléfono</label>
            <input type="tel" id="phone" name="phone" placeholder="Tu teléfono..">

            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Tu email..">

            <label for="subject">Asunto</label>
            <input type="text" id="subject" name="subject" placeholder="Asunto..">

            <label for="message">Mensaje</label>
            <textarea id="message" name="message" placeholder="Escribe tu mensaje.." style="height:200px"></textarea>

            <input type="submit" value="Enviar">
        </form>
    </div>

    <script>
        document.getElementById('contactForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Evitar que se envíe el formulario de forma tradicional

            var formData = new FormData(this);

            fetch('email_contacto.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                alert('Mensaje enviado correctamente');
                document.getElementById('contactForm').reset(); // Opcional: Reiniciar el formulario
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    </script>

        </section>  
            <script src="script.js"></script>

        
            <a href="https://api.whatsapp.com/send?phone=1123836055" class="wpp-boton" target="_blank" >
                <i class="fab fa-whatsapp"></i>
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
                <li><a href="catalogo_log.php">Catalogo</a></li>
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
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
            <script src="js/script.js"></script> 
    </body>
</html>
