<?php

require_once('../../../config.php');
$objConCompraestado = new CompraestadoController();
//hacemos la busqueda el objeto compraestado y seteamos la fechafin 
$rta = $objConCompraestado->modificarFechafin();
//ahora creo una tupla nueva con el estado siguiente que se marcó
$respuestita = $objConCompraestado->crearNuevoestadoElegido();
if($respuestita['respuesta']){
    $rtaS = true;
    
}else{
    $mensaje = "No se ha podido realizar la operación";
}
$retorno['respuesta'] = $rtaS;
if(isset($mensaje)){
    $retorno['errorMsg'] = $mensaje;
}
echo json_encode($retorno);






