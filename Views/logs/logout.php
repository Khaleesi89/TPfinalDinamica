<?php
require_once( '../../config.php' );

$objSession = new Session();
$objSession->cerrar();

header('Location: /TPfinalDinamica');

?>