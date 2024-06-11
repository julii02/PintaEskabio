<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo de Bebidas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/3e32f3aa7a.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="estilos/estilos_catalogos.css">
    <link rel="stylesheet" type="text/css" href="normalize.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="body-principal">
    <header class="header">
        <div class="Icono">
            <a href="index.php">
                <img src="imagenes/asd.png" alt="Logo de la página" class="logo">
            </a>
        </div>
        <nav id="menu_bar" class="">
            <ul>
                <li><a href="catalogo_sinlog.php">Catalogo</a></li>
                <li><a href="form_iniciosesion.html">Registrarse/Log In</a></li>
            </ul>
        </nav>
    </header>
  
        <br>
    <main>

        </div>
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

    <a href="https://api.whatsapp.com/send?phone=1123836055" class="wpp-boton" target="_blank"> 
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
                <li><a href="index.php">Inicio</a></li>
                <li><a href="catalogo_sinlog.php">Productos</a></li>
                <li><a href="index.php#sobre-nosotros">Nosotros</a></li>
                <li><a href="index.php#Formulario">Contacto</a></li>
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
    <script>
        $(document).ready(function() {
            buscar_filtro('', 'Todos', 'Todos', 'Todos');
        });

        function buscar_filtro(PalabraClave, Precio, Tipo, Alcohol) {
            var parametros = {"buscar": 1, "PalabraClave": PalabraClave, "Precio": Precio, "Tipo": Tipo, "Alcohol": Alcohol};
            $.ajax({
                data: parametros,
                url: 'buscador_nolog.php',
                type: 'POST',
                timeout: 10000,
                success: function(response) {
                    console.log('DENTRO');
                    document.getElementById("resultado_busqueda").innerHTML = response;
                },
                error: function(response, error) {
                    console.log('ERROR');
                    document.getElementById("resultado_busqueda").innerHTML = '<p>Se produjo un error al buscar los productos.</p>';
                }
            });
        }
    </script>
</body>
</html>
