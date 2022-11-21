<?php
require_once('../../../config.php');
$objMenuCon = new MenuController();
$lista = $objMenuCon->listarTodo();
$arreglo_salid = array();
foreach ($lista as $key => $value) {
    $nuevoElemen = $value->dameDatos();
    array_push($arreglo_salid, $nuevoElemen);
}
//var_dump($arreglo_salid);
echo json_encode($arreglo_salid);