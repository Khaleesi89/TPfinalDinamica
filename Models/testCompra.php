<?php

require_once('../config.php');

$compra = new Compra();
$usuario = new Usuario();
$usuarios = $usuario->cargar("Marcia","3443222","leoneley@hotmail", null);
if($usuarios['respuesta']){
    echo "funco";
}else{
    echo $usuarios['errorInfo'];
}
print_r($usuarios);
//$respuesta = $compra->cargar("20/10/2022",$usuario);
