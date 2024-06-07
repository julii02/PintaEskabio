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
    <link rel="stylesheet" type="text/css" href="estilos/estilo_catalogo_log.css">
    <link rel="stylesheet" type="text/css" href="normalize.css">


</head>
<body class="body-principal">
    <header class="header">
        <div class="Icono">
            <a href="index_cliente.php">
                <img src="imagenes/asd.png" alt="Logo de la página" class="logo">
            </a>
        </div>
        <nav id="menu_bar" class="">
            <ul>
                <li><a class="font-rickandmorty" href="catalogo_log.php">Catalogo</a></li>
          
                <li><a class="font-rickandmorty" data-bs-toggle="modal" data-bs-target="#exampleModal" id="ubicacion-icono" style="cursor: pointer;"><i class="fas fa-map-marker-alt icono ubicacion"></i></a></li>
                <form action="cerrar_sesion.php" method="post" style="display: inline;">
                <button type="submit" class="btn btn-danger">Cerrar Sesión</button>
                </form>

            </ul>
        </nav>
    </header>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Seleccioná tu ubicación</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div id="map"></div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-primary">Guardar</button>
          </div>
        </div>
      </div>
    </div>
        <script>
        let map;

        function initMap() {
            console.log('API de Google Maps cargada');
            const mapElement = document.getElementById('map');
            map = new google.maps.Map(mapElement, {
                center: { lat: -34.397, lng: 150.644 }, // Centro predeterminado
                zoom: 6
            });
            if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            const pos = {
                lat: position.coords.latitude,
                lng: position.coords.longitude
            };
            map.setCenter(pos);
            map.setZoom(15);
        }, function() {
            handleLocationError(true, map, map.getCenter());
        });
    } else {
        // El navegador no soporta Geolocation, maneja el error
        handleLocationError(false, map, map.getCenter());
    }
        }

        function showMap() {
            console.log('showMap se está ejecutando');
            const mapElement = document.getElementById('map');
            mapElement.style.display = 'block'; // Muestra el mapa

            if (navigator.geolocation) {
                console.log('Navegador soporta Geolocalización');
                navigator.geolocation.getCurrentPosition(function(position) {
                    const pos = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };

                    console.log('Posición obtenida:', pos);

                    map.setCenter(pos);
                    map.setZoom(15);

                    new google.maps.Marker({
                        position: pos,
                        map: map,
                        title: 'Mi ubicación'
                    });
                }, function(error) {
                    console.error('Error al obtener la ubicación', error);
                    handleLocationError(true, map, map.getCenter());
                });
            } else {
                // El navegador no soporta Geolocation
                console.warn('El navegador no soporta Geolocalización');
                handleLocationError(false, map, map.getCenter());
            }
        }

        function handleLocationError(browserHasGeolocation, map, pos) {
            console.log('handleLocationError se está ejecutando');
            map.setCenter(pos);
            new google.maps.InfoWindow({
                position: pos,
                content: browserHasGeolocation ?
                    'Error: El servicio de Geolocalización ha fallado.' :
                    'Error: Tu navegador no soporta Geolocalización.'
            }).open(map);
        }

        // Asignar el evento de clic al icono de ubicación
        document.addEventListener('DOMContentLoaded', (event) => {
            console.log('DOM completamente cargado y analizado');
            const iconoUbicacion = document.getElementById('ubicacion-icono');
            if (iconoUbicacion) {
                iconoUbicacion.addEventListener('click', () => {
                    console.log('Icono de ubicación clicado');
                    showMap();
                });
            } else {
                console.error('No se encontró el icono de ubicación');
            }
        });
    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=APIKEYACA&callback=initMap"></script>
    <img src="imagenes/lrg.png" alt="Publicidad" class="imagen-publicitaria">

    <main class="main-content">
        <div class="section" id="clientes">
            <a href="#">
                <img src="imagenes/sinalc.png" alt="Sin_Alcohol">
                <br>
                <span>Sin Alcohol</span>
            </a>    
        </div>
        <div class="section" id="ventas">
            <a href="#">
                <img src="imagenes/alc.png" alt="Alcohol">
                <br>
                <span>Alcohol</span>
            </a>     
        </div>

    </main>

    <section class="contenido">
        <div class="mostrador" id="mostrador">
            <div class="fila">
                <div class="item" onclick="cargar(this)">
                    <div class="contenedor-foto">
                        <img src="img/1.png" alt="">
                    </div>
                    <p class="descripcion">NIKE AIR 97</p>
                    <span class="precio">$ 1.300</span>
                </div>
                <div class="item" onclick="cargar(this)">
                    <div class="contenedor-foto">
                        <img src="img/2.png" alt="">
                    </div>
                    <p class="descripcion" id>NIKE RUNNING TERRA </p>
                    <span class="precio">$ 1.800</span>
                </div>
                <div class="item" onclick="cargar(this)">
                    <div class="contenedor-foto">
                        <img src="img/3.png" alt="">
                    </div>
                    <p class="descripcion">NIKE WINFLO 8
                    </p>
                    <span class="precio">$ 3.600</span>
                </div>
                <div class="item" onclick="cargar(this)">
                    <div class="contenedor-foto">
                        <img src="img/4.png" alt="">
                    </div>
                    <p class="descripcion">NIKE LOW-TOP</p>
                    <span class="precio">$ 1.800</span>
                </div>
            </div>
            <div class="fila">
                <div class="item" onclick="cargar(this)">
                    <div class="contenedor-foto">
                        <img src="img/5.png" alt="">
                    </div>
                    <p class="descripcion">NIKE BLAZER 97</p>
                    <span class="precio">$ 130</span>
                </div>
                <div class="item" onclick="cargar(this)">
                    <div class="contenedor-foto">
                        <img src="img/6.png" alt="">
                    </div>
                    <p class="descripcion">NIKE LEGEND ESENTIAL</p>
                    <span class="precio">$ 2.000</span>
                </div>
                <div class="item" onclick="cargar(this)">
                    <div class="contenedor-foto">
                        <img src="img/7.png" alt="">
                    </div>
                    <p class="descripcion">NIKE AIR ZOOM</p>
                    <span class="precio">$ 2.500</span>
                </div>
                <div class="item" onclick="cargar(this)">
                    <div class="contenedor-foto">
                        <img src="img/8.png" alt="">
                    </div>
                    <p class="descripcion">NIKE TERRA KING</p>
                    <span class="precio">$ 1.800</span>
                </div>
            </div> 

            <div class="fila">
                <div class="item" onclick="cargar(this)">
                    <div class="contenedor-foto">
                        <img src="img/5.png" alt="">
                    </div>
                    <p class="descripcion">NIKE BLAZER 97</p>
                    <span class="precio">$ 130</span>
                </div>
                <div class="item" onclick="cargar(this)">
                    <div class="contenedor-foto">
                        <img src="img/6.png" alt="">
                    </div>
                    <p class="descripcion">NIKE LEGEND ESENTIAL</p>
                    <span class="precio">$ 2.000</span>
                </div>
                <div class="item" onclick="cargar(this)">
                    <div class="contenedor-foto">
                        <img src="img/7.png" alt="">
                    </div>
                    <p class="descripcion">NIKE AIR ZOOM</p>
                    <span class="precio">$ 2.500</span>
                </div>
                <div class="item" onclick="cargar(this)">
                    <div class="contenedor-foto">
                        <img src="img/8.png" alt="">
                    </div>
                    <p class="descripcion">NIKE TERRA KING</p>
                    <span class="precio">$ 1.800</span>
                </div>
            </div>

        </div>
        <!-- CONTENEDOR DEL ITEM SELECCIONADO -->
        <div class="seleccion" id="seleccion">
            <div class="cerrar" onclick="cerrar()">
                &#x2715
            </div>
            <div class="info">
                <img src="img/1.png" alt="" id="img">
                <h2 id="modelo">NIKE MODEL 1</h2>
                <p id="descripcion">Descripción Modelo 1</p>

                <span class="precio" id="precio">$ 130</span>

                <div class="fila">
                    <div class="size">
                        <label for="">STOCK</label>
                        <select name="" id="">
                            <option value="">40</option>
                            <option value="">42</option>
                            <option value="">44</option>
                            <option value="">46</option>
                        </select>
                    </div>
                    <button>AGREGAR AL CARRITO</button>
                </div>
            </div>
        </div>
    </section>
    
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
