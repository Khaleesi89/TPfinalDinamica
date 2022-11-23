<?php
require_once( '../templates/header.php');

$name = $session->buscarKey( 'usnombre' );
$pass = $session->buscarKey( 'uspass' );
$passHash = password_hash( $pass, PASSWORD_BCRYPT );

$session->iniciar( $name, $passHash );

$resp = $session->validar();
if( $resp ){
    ?>
    <script>
        location.href = 'http://localhost/TPfinalDinamica/Views/home/newIndex.php';
    </script>
    <?php
} else {
    echo( 'Ha ocurrido un error. Intente nuevamente :)' );
}