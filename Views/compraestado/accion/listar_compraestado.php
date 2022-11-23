<?php
require_once('../../../config.php');

$objConCompraEstado = new CompraEstadoController();
$lista = $objConCompraEstado->listarTodo();
$arreglo_salid = array();
foreach ($lista as $key => $value) {
    if($value->getCefechafin() == null){
        $nuevoElemen = $value->dameDatos();
        array_push($arreglo_salid, $nuevoElemen);
    };
    
}
//var_dump($arreglo_salid);
echo json_encode($arreglo_salid);