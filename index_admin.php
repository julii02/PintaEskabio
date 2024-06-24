<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - PintaEskabio</title>
    <link rel="stylesheet" type="text/css" href="estilos/estilos_admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="normalize.css">
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
    <main class="main-content">
        <div class="section" id="Catalogo">
            <a href="catalogo_admin.php">
                <img src="imagenes/izq.png" alt="Catalogo">
                <br>
                <span>Ver Catálogo</span>
            </a>    
        </div>
        <div class="section" id="clientes">
            <a href="clientes.php">
                <img src="imagenes/cliente.png" alt="Clientes">
                <br>
                <span>Clientes</span>
            </a>    
        </div>
        <div class="section" id="ventas">
            <a href="ventas.php">
                <img src="imagenes/contrato.png" alt="Ventas">
                <br>
                <span>Ventas</span>
            </a>    
        </div>
        <div class="section" id="articulos">
            <a href="productos.php">
                <img src="imagenes/espiritu.png" alt="Artículos">
                <br>
                <span>Productos</span>
            </a>
        </div>
        <div class="section" id="proveedores">
            <a href="proveedores.php">
                <img src="imagenes/repartidor.png" alt="Proveedores">
                <br>
                <span>Proveedores</span>
            </a>
        </div>
        <div class="section" id="comprastock">
            <a href="compra_stock.php">
                <img src="imagenes/verificar.png" alt="Compra/Stock">
                <br>
                <span>Compra De Stock</span>
            </a>
        </div>
    </main>
    <footer class="footer">
        <p>&copy; 2024 Mi Página. Todos los derechos reservados.</p>
    </footer>
</body>
</html>
