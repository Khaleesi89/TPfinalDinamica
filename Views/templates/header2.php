<?php
require_once('../../config.php');

$objSession = new Session();
$objMenu = new MenuController();
$objMenuRol = new MenuRolController();

$bandera = $objSession->activa();

$urlActual = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

$rol = '';
if ($bandera) {
    
    $rol = $objMenuRol->listarTodo();

    for ($i = 0; $i < count($rol); $i++) {
        $idrol = $rol[$i]->getObjRol()->getIdrol();
        $roldescripcion = $rol[$i]->getObjRol()->getRodescripcion();
        if ($roldescripcion == $objSession->getUsRol()) {
            $idrolguardado = $idrol;
        }
    }
    $menu = $objMenu->obtenerMenuesPorRol($idrolguardado);
}

if ($bandera) {
    $rolUsuario = $objSession->getUsRol();
}

if ($bandera = $objSession->activa()) {
    $rolUsuario = $objSession->getUsRol();
    $arrBusRo['rodescripcion'] = $rolUsuario;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yonny ameo</title>
    <script src="https://cdn.jsdelivr.net/npm/botman-web-widget@0/build/js/widget.js"></script>
    <script>
        var botmanWidget = {
            introMessage: 'Bienvenido',
            frameEndpoint: '../../Vendor/botman/chat.php',
            chatServer: '../../Vendor/botman/botman.php',
            introMessage: 'Bienvenid@ soy <b>Yonny</b><br>En que puedo servirle?', //saludo inicial
            title: 'Asistente Yonny', //titulo del chat
            dateTimeFormat: 'Y-m-d H:i:s', //formato con el cual trabajaremos
            placeholderText: 'Enviar mensaje...',
            mainColor: '#27ae60', //encabezado
            bubbleBackground: '#219150', //burbuja//el sobre es el icono predeterminado
            // bubbleAvatarUrl: '../Archivos/icono.png',
            aboutText: 'Producido por el grupo Copado',
        }
    </script>
    <link rel="stylesheet" href="../../Public/cssPuro/newStyle.css">
    <!-- Fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <!-- Swiper -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />
    <!-- Bootstrap -->
    <link rel="stylesheet" href="../../Public/bootstrap-5.2.2-dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../../Vendor/themes/default/easyui.css">
    <link rel="stylesheet" href="../../Vendor/themes/icon.css">
    <link rel="stylesheet" href="../../Vendor/themes/color.css">
    <script src="../../Vendor/jquery.min.js"></script>
    <script src="../../Vendor/jquery.easyui.min.js"></script>

</head>

<body>
    <!-- Header -->
    <header class="header">

        <div class="header-1">
            <a href="../home/newIndex.php" class="logo"><i class="fas fa-book"></i> Yonny</a>
            <form action="" class="search-form" method="">
                <input type="search" name="" placeholder="Buscar..." id="search-box">
                <label for="search-box" class="fas fa-search"></label>
            </form>

            <?php if ($bandera) { ?>
                <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?php echo ($objSession->getUsnombre());
                        echo ($objSession->getUsRol()); ?>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#"><?php echo ($menu[0]); ?></a></li>
                        <li><a class="dropdown-item" href="../logs/logout.php">Log out</a></li>
                    </ul>
                </div>

                <?php if( $bandera ): ?>
                    <div class="collapse navbar-collapse d-flex justify-content-end" id="navbarSupportedContent">
                        <li class="nav-item dropdown user">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <button class="btn btn-outline-danger me-2" type="button"><?php echo($objSession->getUsnombre()); ?></button>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="../logs/logout.php">Salir</a></li>
                            </ul>
                        </li>
                    </div>
                <?php else: ?>
                    <!-- Login y Registro (Se muestra si la persona no está logueada) -->
                    <form class="container-fluid d-flex justify-content-end">
                        <a href="../logs/login.php"><button class="btn btn-outline-light me-2" type="button">Login</button></a>
                        <a href="../logs/signup.php"><button class="btn btn-outline-danger me-2" type="button">Registro</button></a>
                    </form>
                <?php endif; ?>
            </div>
        </nav>

        <?php
        if ($objSession->getUsRol() == 'Admin') {
            echo "<div class=\"header-2\">
            <nav class=\"navbar\">
                <a href=\"../producto/producto_list.php\">Productos</a>
                <a href=\"../compraitem/compraitem_list.php\">Carrito</a>
                <a href=\"../compraestado/compraestado_list.php\">Estado de compra</a>
                <a href=\"../usuario/usuario_list.php\">Usuario</a>
                <a href=\"../menu/menu_list.php\">Menu</a>
                <a href=\"../rol/rol_list.php\">Rol</a>
            </nav>
        </div>";
        } elseif ($objSession->getUsRol() == 'Deposito') {
            echo "<div class=\"header-2\">
            <nav class=\"navbar\">
                <a href=\"../producto/producto_list.php\">Productos</a>
                <a href=\"../compraestado/compraestado_list.php\">Estado de compra</a>
                <a href=\"../usuario/usuario_list.php\">Usuario</a>
            </nav>
        </div>";
        } elseif ($objSession->getUsRol() == 'Cliente') {
            echo "<div class=\"header-2\">
            <nav class=\"navbar\">
                <a href=\"../producto/producto_list.php\">Productos</a>
                <a href=\"../compraitem/compraitem_list.php\">Carrito</a>
                <a href=\"../compraestado/compraestado_list.php\">Estado de compra</a>
                <a href=\"../usuario/usuario_list.php\">Usuario</a>
            </nav>
        </div>";
        }
        ?>
    </header>

    <body>