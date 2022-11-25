<?php
require_once('../../../config.php');
$objConCompraestado = new CompraestadoController();
$data = $objConCompraestado->busqueda('idcompraestado');


var_dump($objConCompraestado);
die();
/* if($data){
    $objConCompraestadotipo->modificar();
} */
$respuesta = false;
if($data != null){
    $rta = $objConCompraestadotipo->modificar();
    if(!$rta){
        $mensaje = "La accion no pudo concretarse";
    }
}
$retorno['respuesta'] = $rta;
if(isset($mensaje)){
    $retorno['errorMsg'] = $mensaje;
}
echo json_encode($retorno);