<?php
require_once('../config.php');
$objMenuCon = new MenuController();
//prueba de menues por rol.. admin 
$rta = $objMenuCon->obtenerMenuesPorRol(4);
echo "<pre>";
var_dump($rta);
echo "</pre>";