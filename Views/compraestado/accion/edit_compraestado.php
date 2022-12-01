<?php

require_once('../../../config.php');
$objConCompraestado = new CompraestadoController();
//buscamos el objeto compraestadobuscado
$arrayCompraestado = $objConCompraestado->buscarId();
$CompraestadoObj = $arrayCompraestado['obj'];

//comprobamos que la cantidad de stock este disponible
$haystockDisponible = $objConCompraestado->cambiarStocksegunEstado($CompraestadoObj);
if($haystockDisponible['respuesta']){
    //si la cantidad de stock esta disponible entonces hacemos el seteo de la fecha
    $rta = $objConCompraestado->modificarFechafin();
    if($rta){
        //y hacemos la nueva tupla con la info nueva
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
    }else{
        $mess = "No se pudo modificar la fecha";
        $retorno ['respuesta'];
    }
}else{
    $mensajito = "No hay stock disponible";
    $retorno['respuesta']= $mensajito;
}
echo json_encode($retorno);






