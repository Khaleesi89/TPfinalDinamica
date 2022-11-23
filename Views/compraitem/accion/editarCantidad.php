<?php
require_once('../../../config.php');
$objCompraitem = new CompraitemController();
$data = $objCompraitem->buscarKey('idcompraitem');
$respuesta = false;
if($data != null){
    //FUNCION EN CONTROLADOR PAR AQUE TRAIGA LA CANTIDAD DE PRODUCTO
    //FUNCION PARA COMPRAR 
    $cantTotal = $objCompraitem->stockTotal();
    $cantidad = $objCompraitem->buscarKey('cicantidad');
    if($cantTotal > $cantidad){
        $rta = $objCompraitem->modificar();
        if(!$rta){
            $mensaje = "La accion no pudo concretarse";
        } 
    }
    
}
$retorno['respuesta'] = $rta;
if(isset($mensaje)){
    $retorno['errorMsg'] = $mensaje;
}
echo json_encode($retorno);