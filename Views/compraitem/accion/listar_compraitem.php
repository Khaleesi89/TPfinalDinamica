<?php
require_once('../../../config.php');
$objCompraitem = new CompraitemController();
$lista = $objCompraitem->listarTodo();
foreach ($lista as $key => $objCompraitem) {
    $arraydelacompraitem = [];
    $idcompraitem = $objCompraitem->getIdcompraitem();
    $producto = $objCompraitem->getObjProducto();
    $nombreproduct = $producto->getProNombre();
    $idproducto = $producto->getIdProducto();
    $compra = $objCompraitem->getObjCompra();
    $idcompra = $compra->getIdcompra();
    $cantidadComprada = $objCompraitem->getCicantidad();
    $nuevoElemen = [
                            'idcompraitem' =>$idcompraitem,
                            'idproducto' =>$idproducto,
                            'pronombre' =>$nombreproduct,
                            'idcompra' =>$idcompra,
                            'cicantidad' =>$cantidadComprada,
    ];
    
    array_push($arraydelacompraitem, $nuevoElemen);
}
//var_dump($arreglo_salid);
echo json_encode($arraydelacompraitem);
