<?php
require_once( '../templates/header2.php');

$name = $objSession->buscarKey( 'usnombre' );
$pass = $objSession->buscarKey( 'uspass' );
/* $passHash = password_hash( $pass, PASSWORD_BCRYPT ); */


$objSession->iniciar( $name, $pass );

$resp = $objSession->validar();
if( $resp['rta'] ){
    ?>
    <script>
        location.href = 'http://localhost/TPfinalDinamica/Views/producto/producto_list.php';
    </script>
    <?php
} else {
    echo($resp['error']);
}