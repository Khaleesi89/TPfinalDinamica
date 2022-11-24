<?php
require_once( '../templates/header.php');

$name = $objSession->buscarKey( 'usnombre' );
$pass = $objSession->buscarKey( 'uspass' );
/* $passHash = password_hash( $pass, PASSWORD_BCRYPT ); */

$objSession->iniciar( $name, $passHash );

$resp = $objSession->validar();
if( $resp ){
    ?>
    <script>
        location.href = 'http://localhost/TPfinalDinamica/Views/home/newIndex.php';
    </script>
    <?php
} else {
    echo( 'Ha ocurrido un error. Intente nuevamente :)' );
}