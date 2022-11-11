<?php

require_once('../config.php');

$compra = new Compra();
$usuario = new Usuario();
$found = [];
$found['idusuario'] = 1;
//print_r ($found);
//die();
$usuarios = $usuario->buscar($found);
var_dump($usuarios);
die();
/*
if($usuarios['respuesta']){
    echo "funco";
}else{
    echo $usuarios['errorInfo'];
}
print_r($usuarios);
*/
//$respuesta = $compra->cargar("20/10/2022",$usuario);
