<?php
require_once('../../../config.php');
$objCompraestado = new CompraestadoController();
$data = $objCompraestado->buscarKey('idcompraestado');
$respuesta = false;
if($data != null){
   $rta = $objCompraestado->eliminar();
   //var_dump($rta);
   //die()
   if(!$rta){
    $mensaje = "La acción no pudo concretarse";
   } 
}

$retorno['respuesta'] = true;
if(isset($mensaje)){
    $retorno['errorMsg'] = $mensaje;
}
echo json_encode($retorno);