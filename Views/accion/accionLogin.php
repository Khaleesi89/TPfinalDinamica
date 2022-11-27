<?php
require_once( '../templates/header.php');

$name = $objSession->buscarKey( 'usnombre' );
$pass = $objSession->buscarKey( 'uspass' );
/* $passHash = password_hash( $pass, PASSWORD_BCRYPT ); */

$objSession->iniciar( $name, $pass );

$resp = $objSession->validar();
if( $resp ){
    ?>
    <script>
        location.href = 'http://virtualhostg/TPfinalDinamica/Views/producto/producto_list.php';
    </script>
    <?php
} else {
    echo( 'Ha ocurrido un error. Intente nuevamente :)' );
}