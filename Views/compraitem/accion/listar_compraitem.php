<?php
require_once('../../../config.php');
$objCompraitem = new CompraitemController();
$lista = $objCompraitem->listarTodo();

$arreglo_salid = array();
foreach ($lista as $key => $objCompraitem) {
    $arraydelacompraitem = [];
    $idcompraitem = $objCompraitem->getIdcompraitem();
    
    $producto = $objCompraitem->getObjProducto();
    $nombreproduct = $producto->getProNombre();
    $cantidadTotal = $producto->getProCantStock();
    $compra = $objCompraitem->getIdcompra();
    $cantidadComprada = $objCompraitem->getCicantidad();
    $nuevoElemen = [
                            'idcompraitem' =>$idcompraitem,
                            'pronombre' =>$nombreproduct,
                            'procantstock' =>$cantidadTotal,
                            'idcompra' =>$compra,
                            'cicantidad' =>$cantidadComprada,
    ];
    
    array_push($arraydelacompraitem, $nuevoElemen);
}
//var_dump($arreglo_salid);
echo json_encode($arraydelacompraitem);