<?php
require_once('../../../config.php');
$objCompraitem = new CompraitemController();
$data = $objCompraitem->buscarKey('idcompraitem');
$respuesta = false;
if($data != null){
    $rta = $objCompraitem->modificar();
    if(!$rta){
        $mensaje = "La accion no pudo concretarse";
    }
}
$retorno['respuesta'] = $rta;
if(isset($mensaje)){
    $retorno['errorMsg'] = $mensaje;
}
echo json_encode($retorno);