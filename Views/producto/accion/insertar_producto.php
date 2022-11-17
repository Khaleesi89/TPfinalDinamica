<?php
require_once('../../../config.php');
$objConPro = new ProductoController();
$data = $objConPro->buscarKey('pronombre');
$respuesta = false;
if($data != null){
    $rta = $objConPro->insertar();
    if($rta['respuesta']){
        $respuesta = true;
    }
    if(!$respuesta){
        $mensaje = "La accion no pudo completarse";
    }
}
$retorno['respuesta'] = $respuesta;
if(isset($mensaje)){
    $retorno['errorMsg'] = $mensaje;
}
echo json_encode($retorno);