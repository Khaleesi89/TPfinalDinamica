<?php
require_once('../../../config.php');
$objRolCon = new RolController();
$lista = $objRolCon->listarTodo();
$arreglo_salid = array();
foreach ($lista as $value) {
    $nuevoElemen = $value->dameDatos();
    array_push($arreglo_salid, $nuevoElemen);
}
//var_dump($arreglo_salid);
echo json_encode($arreglo_salid);