<?php

require_once('../../../config.php');
$objConCompraestado = new CompraestadoController();

//buscarKey es para buscar en el post y en el get

$data = $objConCompraestado->buscarId();
//var_dump($data);
/* if($data){
    $objConCompraestadotipo->modificar();
} */
$respuesta = false;
if($data != null){
    $rta = $objConCompraestado->modificar();
    if(!$rta){
        $mensaje = "La accion no pudo concretarse";
    }
}
$retorno['respuesta'] = $rta;
if(isset($mensaje)){
    $retorno['errorMsg'] = $mensaje;
}
echo json_encode($retorno);











//require_once('../../templates/header2.php');
/* require_once('../../../config.php');
$objConCompraestado = new CompraestadoController();
$data = $objConCompraestado->buscarId(); 

//die();
if($data){
    $objConCompraestado->modificar();
} else{
    retorno['respuesta'] = false;
}
/* if($data != null){ 
    $rta = $objConCompraestado->modificar();
    if(!$rta){
        $mensaje = "La accion no pudo concretarse";
    }
/* } */
/* $retorno['respuesta'] = $rta;
if(isset($mensaje)){
    $retorno['errorMsg'] = $mensaje;
}
echo json_encode($retorno); */ 