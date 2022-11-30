<?php
require_once('../../../config.php');

$objSession = new SessionController();
$objCompraItemController = new CompraitemController();
$objCompraController = new CompraController();

$idUsuario = $objSession->getIdusuario();
$idCompra =  $objCompraController->buscarCompraConIdusuario( $idUsuario );
$arrayBusqueda = ['idcompra' => $idCompra];
$lista = $objCompraItemController->listarTodo( $arrayBusqueda );
//$lista = $objCompraItemControler->listarTodo();

$arraydelacompraitem = [];
foreach( $lista as $key => $objCompraItem ){
    /* $arraydelacompraitem = []; */
    $idcompraitem = $objCompraItem->getIdcompraitem();
    $producto = $objCompraItem->getObjProducto();
    $nombreproduct = $producto->getProNombre();
    $idproducto = $producto->getIdProducto();
    $compra = $objCompraItem->getObjCompra();
    $idcompra = $compra->getIdcompra();
    $cantidadComprada = $objCompraItem->getCicantidad();
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
