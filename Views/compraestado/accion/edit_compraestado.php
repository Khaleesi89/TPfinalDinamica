<?php

require_once('../../../config.php');
$objConCompraestado = new CompraestadoController();

//buscarKey es para buscar en el post y en el get

$data = $objConCompraestado->buscarKey('idcompraestado');
//aca obtengo el objeto sin el id compra estado
$objetocompraestado = $objConCompraestado->busqueda();
//aca busco el que me trae el post
$nuevocodigo = $objConCompraestado->buscarKey('cetdescripcion');

//ACA TIENE QUE UNIRSE AMBOS NUMEROS...VER SI ESA FUNCION pasarNuevoCodigo LO PUEDO HACER ANDAR







//$objConCompraestado->pasarNuevoCodigo($nuevocodigo);
var_dump($objConCompraestado);
die();
/* var_dump($objetocompraestado);
echo"llega aca";
die(); */
/* if($data){
    $objConCompraestadotipo->modificar();
} */
$rta = false;
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