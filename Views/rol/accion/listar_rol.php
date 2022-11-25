<?php
require_once('../templates/header2.php');
$objRolCon = new RolController();
try {
    $rol = $objSession->getUsRol();
    $rol = $objSession->getUsRol();
if($rol != ''){
    if($rol == 'Admin'){
        $lista = $objRolCon->listarTodo();
    }elseif($rol == 'Cliente' || $rol == 'Deposito'){
        $lista = [];
    }
}
} catch (\Throwable $th) {
    $rol = '';
    $lista = [];//  ['idproducto' => '', 'pronombre' => '', 'sinopsis'=>'', 'procantstock'=>'', 'autor'=>'', 'precio'=>'', 'isbn'=>'', 'categoria'=>''];
}

$arreglo_salid = array();
foreach ($lista as $value) {
    $nuevoElemen = $value->dameDatos();
    array_push($arreglo_salid, $nuevoElemen);
}
//var_dump($arreglo_salid);
echo json_encode($arreglo_salid);