<?php require_once('Connections/cnx.php'); ?> <!-- Incluir el archivo de conexión a la base de datos -->

<?php
// Validar la conexión a la base de datos
if (!$cnx) {
    die("Connection failed: " . mysqli_connect_error()); // Muestra un error si la conexión falla
}

// Seleccionar la base de datos
mysqli_select_db($cnx, $database_cnx); // Selecciona la base de datos especificada
$query_RstProductos = "SELECT * FROM productos"; // Consulta SQL para obtener todos los productos

// Ejecutar la consulta y manejar errores
$RstProductos = mysqli_query($cnx, $query_RstProductos) or die(mysqli_error($cnx)); // Ejecuta la consulta y maneja errores
$productos = mysqli_fetch_all($RstProductos, MYSQLI_ASSOC); // Obtiene todos los productos como un array asociativo
$totalRows_RstProductos = mysqli_num_rows($RstProductos); // Cuenta el número total de productos
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- Meta para el diseño responsivo -->
    <title>CHAMANBIKES</title>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700%7CVarela+Round" rel="stylesheet"> <!-- Fuentes -->
    <link type="text/css" rel="stylesheet" href="css/bootstrap.min.css" /> <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/font-awesome.min.css"> <!-- Font Awesome para iconos -->
    <link type="text/css" rel="stylesheet" href="css/style.css" /> <!-- Estilos personalizados -->
    <link rel="shortcut icon" href="assets/images/logoprincipal.ico"> <!-- Favicon -->
    <style type="text/css">
        /* Estilo para la imagen del producto */
        #imagen {
            height: 150px;
            width: 150px;
            border-radius: 60px; /* Bordes redondeados */
            border: 1px solid #f4b906; /* Borde del imagen */
            padding: 2px;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header id="home">
        <div class="bg-img" style="background-image: url('./img/background3.jpg');"> <!-- Imagen de fondo -->
            <div class="overlay"></div> <!-- Superposición -->
        </div>

        <nav id="nav" class="navbar nav-transparent"> <!-- Navegación -->
            <div class="container">
                <div class="navbar-header">
                    <div class="navbar-brand">
                        <a href="#"></a> <!-- Logo -->
                    </div>
                    <div class="nav-collapse">
                        <span></span> <!-- Botón para colapsar el menú -->
                    </div>
                </div>
                <ul class="main-nav nav navbar-nav navbar-right"> <!-- Enlaces de navegación -->
                    <li><a href="#home">INICIO</a></li>
                    <li><a href="#about">ACERCA</a></li>
                    <li><a href="#pricing">PRODUCTOS</a></li>
                </ul>
            </div>
        </nav>

        <div class="home-wrapper"> <!-- Contenido principal de la sección -->
            <div class="container">
                <div class="row">
                    <div class="col-md-10 col-md-offset-1"> <!-- Offset para centrar el contenido -->
                        <div class="home-content">
                            <h1 class="white-text">CHAMAN BIKES</h1>
                            <p class="white-text">Ofrecemos toda clase de servicios para su bicicleta</p>
                            <a href="login.php" class="bbtn btn-primary btn-lg" role="button"><i class="fa fa-lock"></i> ACCESO AL PANEL DE CONTROL</a> <!-- Enlace al panel de control -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- About -->
    <div id="about" class="section md-padding">
        <div class="container">
            <div class="row">
                <div class="section-header text-center">
                    <h2 class="title">DESCRIPCION DEL SITIO</h2> <!-- Título de la sección "Acerca" -->
                </div>

                <!-- Tres columnas de información sobre el sitio -->
                <div class="col-md-4">
                    <div class="about">
                        <i class="fa fa-cogs"></i>
                        <h3>Completamente Personalizable</h3>
                        <p>El usuario administrador puede cambiar la configuración del sistema.</p>
                        <a href="#">Leer Más</a>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="about">
                        <i class="fa fa-magic"></i>
                        <h3>Tipos de Usuarios</h3>
                        <p>Varios tipos de usuarios para manipular el sistema.</p>
                        <a href="#">Leer Más</a>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="about">
                        <i class="fa fa-mobile"></i>
                        <h3>Páginas Responsives</h3>
                        <p>Se puede manipular el sistema desde cualquier dispositivo ya que la página es adaptable</p>
                        <a href="#">Leer Más</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pricing -->
    <div id="pricing" class="section md-padding">
        <div class="container">
            <div class="row">
                <div class="section-header text-center">
                    <h2 class="title">PRODUCTOS DISPONIBLES</h2> <!-- Título de la sección de productos -->
                </div>

                <?php if ($totalRows_RstProductos > 0): ?> <!-- Verificar si hay productos -->
                    <?php foreach ($productos as $producto): ?> <!-- Iterar sobre cada producto -->
                        <div class="col-sm-6"> <!-- Cambiado a col-sm-6 para mostrar dos productos por línea -->
                            <div class="pricing">
                                <p>NOMBRE DEL PRODUCTO: <?php echo htmlspecialchars($producto['nombre']); ?></p> <!-- Mostrar nombre del producto -->
                                <img src="images/<?php echo htmlspecialchars($producto['imagen']); ?>" alt="<?php echo htmlspecialchars($producto['nombre']); ?>" id="imagen" /> <!-- Mostrar imagen del producto -->
                                <div class="price-head">
                                    <span class="price-title">PRECIO: $<?php echo number_format($producto['precioventa'], 0, ",", "."); ?></span> <!-- Mostrar precio del producto -->
                                </div>
                                <ul class="price-content">
                                    <li>
                                        <p>CANTIDAD: <?php echo $producto['cantidad'] > 0 ? $producto['cantidad'] : 'Agotado'; ?></p> <!-- Mostrar cantidad disponible o "Agotado" -->
                                    </li>
                                    <li>
                                        <p>DESCRIPCIÓN: <?php echo htmlspecialchars($producto['descripcion']); ?></p> <!-- Mostrar descripción del producto -->
                                    </li>
                                </ul>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No hay productos disponibles.</p> <!-- Mensaje si no hay productos -->
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer id="footer" class="sm-padding bg-dark"> <!-- Sección de pie de página -->
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul class="footer-follow"> <!-- Enlaces de redes sociales -->
                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                        <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                        <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                        <li><a href="#"><i class="fa fa-youtube"></i></a></li>
                    </ul>
                    <div class="footer-copyright">
                        <p>Diseñada por <a href="#" target="_blank">Sebastian Martinez - Esteban Rojas</a></p> <!-- Información de derechos de autor -->
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Back to top -->
    <div id="back-to-top"></div>

    <!-- jQuery Plugins -->
    <script type="text/javascript" src="js/jquery.min.js"></script> <!-- jQuery -->
    <script type="text/javascript" src="js/bootstrap.min.js"></script> <!-- Bootstrap JS -->
    <script type="text/javascript" src="js/owl.carousel.min.js"></script> <!-- Carousel JS -->
</body>
</html>
