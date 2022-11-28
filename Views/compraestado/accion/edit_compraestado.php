<?php

require_once('../../../config.php');
$objConCompraestado = new CompraestadoController();
$arraybusquedaaaa = $objConCompraestado->buscarId();
$fechafin = date("Y-m-d H:i:s");
if(!is_null($arraybusquedaaaa['obj'])){
    $objConCompraestado = $arraybusquedaaaa['obj'];
    $rta = $objConCompraestado->modificarFechafin($fechafin);
    if($rta['respuesta']){
        echo "se realizo";
    }else{
        echo "no se realizo";
    }
}else{
    echo "no existe objeto";
}





//$arraydevuelto = $objConCompraestado->setearfecha();
//->modificarFechafin();
//$objConCompraestado->setearfecha($objcompraestado);
echo "<pre>";
var_dump($arraydevuelto);
echo "</pre>";
die();
//$nuevoCodigo = $objCompraestado->buscarKey('cetdescripcion');

/* $rta = false;
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
 */










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