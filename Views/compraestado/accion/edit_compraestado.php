<?php

require_once('../../../config.php');
$objCompraEstadoTipoCon = new CompraestadotipoController();
$idCompraEstado = $objCompraEstadoTipoCon->buscarKey('idcompraestado');
if($idCompraEstado != NULL || $idCompraEstado !=  false){
    $objCompraEstadoCon = new CompraestadoController();
    $rta = $objCompraEstadoCon->buscarId($idCompraEstado); // lo devuelve gut
    if(array_key_exists('obj', $rta)){
        //encontro el objCompraEstado
        $objCompraEstado = $rta['obj'];
        $ObjCompraEstadoTipoActual = $objCompraEstado->getObjCompraestadotipo();
        $idCompraEstadoTipoPorParametro = $objCompraEstadoTipoCon->buscarKey('idcompraestadotipo');
        if($idCompraEstadoTipoPorParametro == '2' || $idCompraEstadoTipoPorParametro == 2){
            //logica chetita
            $objCompra = $objCompraEstado->getObjCompra(); 
            $idCompra = $objCompra->getIdcompra();
            $objCompraItemCon = new CompraitemController();
            $arrBusIdCompra['idcompra'] = $idCompra;
            $listaCarrito = $objCompraItemCon->listarTodo($arrBusIdCompra);
            $banderaSePuedeDescontar = false;
            foreach( $listaCarrito as $key => $value ){
                $cicantidad = $value->getCicantidad();
                $objProducto = $value->getObjproducto();
                $stock = $objProducto->getProCantStock();
                if($cicantidad > $stock){
                    $banderaSePuedeDescontar = true;
                }
            }
            if( !$banderaSePuedeDescontar ){
                //a descontar stock
                foreach( $listaCarrito as $key => $value ){
                    $cicantidad = $value->getCicantidad();

                    $objProducto = $value->getObjProducto();
                    $stock = $objProducto->getProCantStock();

                    $nuevoStock = $stock - $cicantidad;
                    $rta = $objProducto->setProCantStock( $nuevoStock );
                    
                    $rta = $objProducto->modificar(); // no lo modifica - sql error
                }
                //cambiar estado tupla y generar una nueva de compraestado; 5
                $idcompraestadotipo = 2;
                $idCompraEstado = $objCompraEstadoCon->buscarKey( 'idcompraestado' );
                $rsss = $objCompraEstadoCon->modificarEstado($idCompraEstado, $idcompraestadotipo);
                if($rsss){
                    $response = true;
                }else{
                    $response = false;
                }
            }else{
                $response = false;
                $mensaje = 'Un producto supera el stock';
                //no se pudo papuh
            }
        }else{
            //cambio de estado solamente 5
            if($idCompraEstadoTipoPorParametro == 3){
                $idcompraestado = $objCompraEstado->getIdcompraestado();
                $idcompraestadotipo = 3;
                $rsss = $objCompraEstadoCon->modificarEstado($idCompraestado, $idcompraestadotipo);
            
            }elseif($idCompraEstadoTipoPorParametro == 4){
                $idcompraestado = $objCompraEstado->getIdcompraestado();
                $idcompraestadotipo = 4;
                $rsss = $objCompraEstadoCon->modificarEstado($idCompraestado, $idcompraestadotipo);
            }
        }
    }else{
        //no lo encontro
        $response = false;
        $mensaje = 'No se encontró el Obj de Compra Estado';
    }
}
$retorno['respuesta'] = $response;
if(isset($mensaje)){
    $retorno['errorMsg'] = $mensaje;
}
echo json_encode($retorno);




/* $objConCompraestado = new CompraestadoController();
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
echo json_encode($retorno); */






