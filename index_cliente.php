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
        <link rel="stylesheet" type="text/css" href="estilos/estilo_clien_sinlog.css">
        <link rel="stylesheet" type="text/css" href="normalize.css">
        <link rel="stylesheet" href="estilos/lightbox.css">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css" />
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Orbitron:wght@900&family=Righteous&family=Seymour+One&display=swap');
        </style>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    </head>
    <?php session_start() ?>
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
                    <li><a href="catalogo_log.php">Productos</a></li>
                    <li><a href="index.php#sobre-nosotros">Nosotros</a></li>
                    <li><a href="index.php#Formulario">Contacto</a></li>
                </ul>
            </nav>
        </header>
        <article>
            <div class="principal-carousel">
                <div class="container-carousel">
                    <div class="carruseles" id="slider">
                        <div class="slider-section">
                            <img src="imagenes/principal.jpg" alt="Imagen 1" class="gallery-image">
                        </div>
                        <div class="slider-section">
                            <img src="imagenes/principal01.jpeg" alt="Imagen 2" class="gallery-image">
                        </div>
                        <div class="slider-section">
                            <img src="imagenes/principal02.jpeg" alt="Imagen 3" class="gallery-image">
                        </div>
                        <div class="slider-section">
                            <img src="imagenes/principal03.jpg" alt="Imagen 4" class="gallery-image">
                        </div>
                        <div class="slider-section">
                            <img src="imagenes/principal04.png" alt="Imagen 4" class="gallery-image">
                        </div>
                    </div> 
                    <div class="btn-left"><i class='bx bx-chevron-left'></i></div>
                    <div class="btn-right"><i class='bx bx-chevron-right'></i></div>         
                </div>
            </div>
            <section class="information container">
                <div class ="information-content">
                    <div class = "information-1">
                        <img src="imagenes/i1.svg" alt="">
                        <h3>Atencion 24hrs</h3>
                        <p>
                            Estamos 24 /7 
                        </p>
                    </div>
                    <div class = "information-1">
                        <img src="imagenes/i2.svg" alt="">
                        <h3>Pago seguro</h3>
                        <p>
                            10+ años de trayectoria y experiencia en el rubro.
                        </p>
                    </div>
                    <div class = "information-1">
                        <img src="imagenes/i3.svg" alt="">
                        <h3>Rapidez</h3>
                        <p>
                            Entregas en menos de 72 horas hábiles.
                        </p>
                    </div>
                </div>
            </section>
        </article>

        <section id="productos" class="productos seccion">
                <h2>Nuestros Productos</h2>
                <div class="product-list">
                    <div class="product-item">
                        <img src="imagenes/jhonny.jpg" alt="Vino">
                        <h3>Vino Tinto</h3>
                        <p>Descripción del vino tinto.</p>
                        <a href="#" class="btn">Comprar Ahora</a>
                    </div>
                    <div class="product-item">
                        <img src="imagenes/jhonny.jpg" alt="Whisky">
                        <h3>Whisky</h3>
                        <p>Descripción del whisky.</p>
                        <a href="#" class="btn">Comprar Ahora</a>
                    </div>
                    <div class="product-item">
                        <img src="imagenes/jhonny.jpg" alt="Whisky">
                        <h3>Whisky</h3>
                        <p>Descripción del whisky.</p>
                        <a href="#" class="btn">Comprar Ahora</a>
                    </div>
                    <div class="product-item">
                        <img src="imagenes/jhonny.jpg" alt="Whisky">
                        <h3>Whisky</h3>
                        <p>Descripción del whisky.</p>
                        <a href="#" class="btn">Comprar Ahora</a>
                    </div>
                    <div class="product-item">
                        <img src="imagenes/jhonny.jpg" alt="Whisky">
                        <h3>Whisky</h3>
                        <p>Descripción del whisky.</p>
                        <a href="#" class="btn">Comprar Ahora</a>
                    </div>
                    <!-- Más productos -->
                </div>
        </section>

        <section id="sobre-nosotros" class="sobre-nosotros seccion">
            <div class="about-content">
                <div class="about-column">
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
        <section class="marcas-img seccion">
                <section>
                    <h2>Informacion de las marcas que nos patrocinan</h2>
                    <div class="card" >
                        <a href="imagenes/jhonny.jpg" data-lightbox="marcas" ><img src="imagenes/jhonny.jpg" alt="Johnnie Walker" title="Johnnie Walker"></a>
                        <div>
                            <h3>Johnnie Walker</h3>
                            <p>
                                <strong>Johnnie Walker​</strong> es una marca de whisky escocés ahora propiedad de Diageo que se originó en la ciudad escocesa de Kilmarnock,
                                East Ayrshire. La marca fue establecida por primera vez por el tendero <strong>John Walker</strong>.
                                Es la marca de whisky escocés mezclado más ampliamente distribuida en el mundo,
                                vendida en casi todos los países, con ventas anuales equivalentes a más de <strong>223.7 millones de botellas de 700 ml en 2016
                                (156.6 millones de litros)</strong>. Johnnie Walker es conocido por su distintiva gama de whiskies, que van desde el clásico Johnnie Walker Red Label
                                hasta el exclusivo y prestigioso Johnnie Walker Blue Label.
                            </p>
                        <button class = "btn" >Mas información...</button>
                        </div>
                    </div>
                    <div class="card" >
                        <a href="imagenes/smirnoff.jpeg" data-lightbox="marcas" ><img src="imagenes/smirnoff.jpeg" alt="Smirnoff" title="Smirnoff"></a>
                        <div>
                            <h3>Smirnoff</h3>
                            <p>
                                Elaborado por la destilería homónima, fundada por <strong>Piotr Arsenieyevich Smirnov</strong> en <strong>1864</strong>. 
                                Cuando Piotr falleció, en <strong>1910</strong>, recogió el legado su tercer hijo <strong>Vladimir Smirnov</strong>, que llevó a la empresa a lo más alto.
                                Actualmente es el vodka más vendido en todo el mundo, con mercado en más de <strong>130 países</strong>, y pertenece a la multinacional <strong>Diageo</strong>.
                                En <strong>2003</strong> obtuvo la medalla de oro en la competencia mundial de bebidas espirituosas celebrada en <strong>San Francisco</strong>.
                                Se distribuye en botellas de <strong>750 cc</strong> y <strong>1000 cc</strong> con una graduación de alcohol del <strong>37.5%</strong>.
                            </p>
                        <button class = "btn">Mas información...</button>
                        </div>
                    </div>
                    <div class="card" >
                        <a href="imagenes/coronona.jpeg" data-lightbox="marcas" ><img src="imagenes/coronona.jpeg" alt="Corona Extra" title="Corona Extra"></a>
                        <div>
                            <h3>Corona</h3>
                            <p>
                                <strong>Corona</strong> es una marca de cerveza fundada en <strong>1926</strong>, producida en múltiples fábricas en 
                                México y exportada a mercados de todo el mundo. La empresa belga <strong>Anheuser-Busch 
                                InBev</strong> es propietaria de la cerveza en todos los demás mercados. Es la marca de 
                                cerveza importada más vendida en los <strong>Estados Unidos</strong>. A menudo se sirve con una 
                                rodaja de limón o lima en el cuello de la botella para agregar acidez y sabor. 
                                La receta incluye maíz, así como malta de cebada y lúpulo que se utilizan 
                                tradicionalmente para hacer cerveza.
                            </p>
                        </p>
                        <button class = "btn" >Mas información...</button>
                        </div>
                    </div>
                    <div class="card" >
                        <a href="imagenes/cocacola.jpg" data-lightbox="marcas" ><img src="imagenes/cocacola.jpg" alt="Coca Cola" title="Coca Cola"></a>
                        <div>
                            <h3>Coca Cola</h3>
                            <p>
                                <strong>Coca-Cola</strong> (también conocida comúnmente como Coca en muchos países hispanohablantes; 
                                en inglés también conocida como Coke) es una bebida azucarada gaseosa vendida a 
                                nivel mundial en tiendas, restaurantes y máquinas expendedoras en más de doscientos 
                                países o territorios. Es el principal producto de <strong>The Coca-Cola Company</strong>, de origen 
                                estadounidense. En un principio, cuando la inventó el farmacéutico <strong>John Stith 
                                Pemberton</strong>, fue concebida como una bebida medicinal patentada, aunque posteriormente, 
                                fue adquirida por el empresario <strong>Asa Griggs Candler</strong>, que hizo de la bebida una de las 
                                más consumidas del <strong>siglo XX</strong>, y del <strong>siglo XXI</strong>.
                            </p>
                        <button class = "btn" >Mas información...</button>
                        </div>
                    </div>
                </section>

                <script src="js/lightbox-plus-jquery.min.js"></script>
        </section>

        <section class="Formulario-principal seccion" id = "Formulario">
            <div class="form-container">
                <form class="form-aspecto">
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
            <div class="content-empresa">
                <div class="company-info">
                    <h1>PINTAESKABIO</h1>
                    <p>¿Tenes dudas? Rellena el siguiente formulario o escribirnos a nuestros medios de contacto y pronto nos pondremos en comunicación con vos.</p>
                    <div class="social-media">
                        <a href="#" class="social-icon">Facebook</a>
                        <a href="#" class="social-icon">Twitter</a>
                        <a href="#" class="social-icon">Instagram</a>
                    </div>
            </div>
        </section>  
            <script src="script.js"></script>

        
            <a href="https://api.whatsapp.com/send?phone=1123836055" class="wpp-boton" target="_blank" >
                <i class="fab fa-whatsapp"></i>
            </a>

            <footer class="footer">
                <p>&copy; 2024 Mi Página. Todos los derechos reservados.</p>
            </footer>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
            <script src="js/script.js"></script> 
    </body>
</html>
