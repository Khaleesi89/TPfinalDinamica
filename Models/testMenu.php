<?php
require_once('../config.php');



$menu = new Menu();
var_dump ($menu);
die();

//cargar

$resultado = $menu->cargar(200, "Peluqueria","servicios que realiza","Servicios","09/12/1960");
if($resultado){
    echo "se realizo";
}else{
    echo "juira bicho";
}
