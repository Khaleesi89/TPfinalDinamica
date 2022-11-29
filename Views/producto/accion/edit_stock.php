<?php
require_once('../../../config.php');
$objCompraItemCon = new CompraitemController();
$idproducto = $objCompraItemCon->buscarKey('idproducto');
$cicantidad = intVal($objCompraItemCon->buscarKey('cicantidad'));
$objProCon = new ProductoController();
$cantStock = $objProCon->obtenerStockPorId($idproducto);
//Comprobar stock
if ($cantStock != false) {
    if ($cicantidad <= $cantStock) {
        $validStock = true;
        //buscar si hay una compra iniciada
        //$idusuario = $objSession->getIdusuario();
        $idusuario = 1;
        //obtener compra con idusuario
        $objCompraCon = new CompraController();
        $rta = $objCompraCon->buscarCompraConIdusuario($idusuario);
        // var_dump($rta);
        if ($rta != false) {
            //se encontro idcompra
            if ($rta != NULL) {
                //revisar si la compra esta activa
                $idcompra = $rta;
                $objCompraEstadoCon = new CompraestadoController();
                $rsta = $objCompraEstadoCon->obtenerCompraActivaPorId($idcompra);
                if ($rsta != false) {
                    $idcompraActiva = $rsta;
                } else {
                    $resp = $objCompraCon->crearCompraDevolverId($idusuario);
                }
            } else {
                //crear una compra y usar el id
                $resp = $objCompraCon->crearCompraDevolverId($idusuario);
                if ($resp != false) {
                    $idcompraActiva = $resp;
                }
            }
        } else {
            $resp = $objCompraCon->crearCompraDevolverId($idusuario);
            if ($resp != false) {
                $idcompraActiva = $resp;
            }
        }

        //cargar una tupla en compraitem con idcompra y idproducto
        $validoCarrito = $objCompraItemCon->cargarVentaDeProducto($idcompraActiva, $idproducto, $cicantidad);
        if ($validoCarrito) {
            $respuesta = true;
        } else {
            $respuesta = false;
        }
    } else {
        $mensaje = "El stock de compra ingresado es superior al de depósito";
        $respuesta = false;
    }
}
$retorno['respuesta'] = $respuesta;
if (isset($mensaje)) {
    $retorno['errorMsg'] = $mensaje;
}
echo json_encode($retorno);
