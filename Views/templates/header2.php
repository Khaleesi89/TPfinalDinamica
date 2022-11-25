<?php
    require_once('../../config.php');
    //require_once('../../Models/conector/db.php');
    //require('../../Vendor/autoload.php');

    $objSession = new Session();
    $objMenu = new MenuController();
    $objMenuRol = new MenuRolController();

    
    
    /* $menues = $objSession->rolesUsuario();
    var_dump($menues); */

    
   
    //var_dump( $menu );

    $bandera = $objSession->activa();
    if($bandera != false){
        //cargar menues 
        
    }

    //var_dump( $objSession->getUsRol() );
    if( $bandera ){
        $rol = $objMenuRol->listarTodo();

        for( $i = 0; $i < count($rol); $i++ ){
            $idrol = $rol[$i]->getObjRol()->getIdrol();
            $roldescripcion = $rol[$i]->getObjRol()->getRodescripcion();
            if( $roldescripcion == $objSession->getUsRol() ){
                $idrolguardado = $idrol;
            }
        }
        $menu = $objMenu->obtenerMenuesPorRol( $idrolguardado );
        //echo( 'logueao papa' );
        //var_dump( $menues );
    }


    //
    
    if($bandera = $objSession->activa()){
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
    <link rel="stylesheet" href="../../Vendor/demo/demo.css">
    <script src="../../Vendor/jquery.min.js"></script>
    <script src="../../Vendor/jquery.easyui.min.js"></script>
    
</head>

<body>
    <!-- Header -->
    <header class="header">

        <!-- <div class="menues">
            <a href="../home/newIndex.php" class="navbar-brand text-white">Home</a>
            <button class="navbar-toggler" type="button" data-bs-toggle='collapse' aria-expanded="false" aria-label="Toggle">
                <span class="navbar-toggle-icon"></span>
            </button>

            <div class="collapse navbar-collapse">
                <ul class='navbar-nav me-auto mb-2 m-2 mb-sm-0'>
                    <li> <a href="../home/newIndex.php" role="button" class='px-2 mx-1 btn btn-lg btn-outline-light'>Home:)</a> </li>

                    <?php
                    /* foreach( $menues as $menu ){
                    ?>
                        <option value="<?php echo $menu[0] ?>"></option>
                    <?php
                    } */
                    ?>

                </ul>
            </div>
        </div> -->

        <div class="header-1">
            <a href="../home/newIndex.php" class="logo"><i class="fas fa-book"></i> Yonny</a>
            <form action="" class="search-form" method="">
                <input type="search" name="" placeholder="Buscar..." id="search-box">
                <label for="search-box" class="fas fa-search"></label>
            </form>

            <?php if( $bandera ){ ?>
                <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?php echo($objSession->getUsnombre()); echo( $objSession->getUsRol() ); ?>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#"><?php echo( $menu[0] ); ?></a></li>
                        <li><a class="dropdown-item" href="../logs/logout.php">Log out</a></li>
                    </ul>
                </div>
                <div class="icons">
                    <a href="../compraitem/compraitem_list.php" class="fas fa-shopping-cart"></a>
                </div>
            <?php } else { ?>
                <div class="icons">
                    <div id="search-btn" class="fas fa-search"></div>
                    <a href="" class="fas fa-shopping-cart"></a>
                    <div id="login-btn" class="fas fa-user"></div>
                </div>
            <?php } ?>
        </div>

        <div class="header-2">
            <nav class="navbar">
                <a href="../home/newIndex.php#home">Home</a>
                <a href="../producto/producto_list.php">Ingresos</a>
                <a href="../home/newIndex.php#reviews">Reviews</a>
                <a href="#contacto">Contacto</a>

            </nav>
        </div>
    </header>

    <!-- Nav pal responsive -->
    <nav class="bottom-navbar">
        <a href="#" class="fas fa-home"></a>
        <a href="../producto/producto_list.php" class="fas fa-tags"></a>
        <a href="#reviews" class="fas fa-comments"></a>
        <a href="#contacto" class="fas fa-blogs"></a>
    </nav>

    <!-- Login. Despues vemos si se deja aca o no
    yo dejo uno sencillito para ya tener una maqueta -->
    <div class="login-form-container">
        <div id="close-login-btn" class="fas fa-times"></div>
        <form action="../accion/accionLogin.php" method="POST">
            <h3>Login</h3>
            <span>Usuario</span>
            <input type="text" name="usnombre" class="box" placeholder="Ingrese su usuario" id="">
            <span>Contraseña</span>
            <input type="password" name="uspass" class="box" placeholder="Ingrese su contraseña" id="">
            <div class="checkbox">
                <input type="checkbox" name="" id="remember-me">
                <label for="remember-me">Remember me</label>
            </div>
            <button type="submit" class="btn btn-success">Sign in</button>
            <p>Te olvidaste la contraseña pa? <a href="#">Clickea aca ;)</a> </p>
            <p>No tenes una cuenta? <a href="../logs/signup.php">Create una papu</a> </p>
        </form>
    </div>