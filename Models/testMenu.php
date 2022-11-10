<?php
require_once('../config.php');



$menu = new Menu();
var_dump ($menu);
//die();

//cargar

$menu->cargar(200, "Peluqueria","servicios que realiza",null,"09/12/1960");
$resultado = $menu->insertar();
if($resultado['respuesta']){
    echo "se realizo";
}else{
    var_dump( $resultado['errorInfo']);
    echo "juira bicho";
}
