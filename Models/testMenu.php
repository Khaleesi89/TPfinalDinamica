<?php
require_once('../config.php');



$menu = new Menu();
//var_dump ($menu);
//die();

//cargar

$menu->cargar(200, "Peluqueria","servicios que realiza",null, null);
$resultado = $menu->insertar();
var_dump($menu);
/* if($resultado['respuesta']){
    echo "se realizo";
}else{
    var_dump( $resultado['errorInfo']);
    echo "juira bicho";
} */
