<?php
require_once( '../templates/header.php');

$objUsuario = new UsuarioController();
$data = $objUsuario->getDatos();

$respuesta = $objUsuario->insertar();
if( $respuesta['respuesta'] ){
    echo('Usuario creado piolon');
} else {
    echo('Usuario creado pa la wea');
}