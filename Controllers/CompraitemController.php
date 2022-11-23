<?php
class CompraitemController extends MasterController {
    use Errores;

    public function listarTodo(){
        $arrayBus['idcompraitem'] = NULL;
        $arrayTotal = Compraitem::listar($arrayBus);
        
        if(array_key_exists('array', $arrayTotal)){
            $array = $arrayTotal['array'];
        }else{
            $array = [];
        }
        return $array;
    }


    //ACA EN MODIFICAR SETEAMOS LA CANTIDAD QUE QUEDA EN STOCK (DENTRO DE PRODUCTO, NO EN COMPRAITEM)
    public function modificar(){
        $rta = $this->buscarId();
        //var_dump($rta);
        $response = false;
        if($rta['respuesta']){
            //puedo modificar con los valores
            $valores = $this->busqueda();
            $objCompraItem = $rta['obj'];
            $idproducto['idproducto'] = $valores['idproducto'];
            $idcompra['idcompra'] = $valores['idcompra'];
            $objProducto = new Producto();
            $objProducto->buscar($idproducto);
            $objCompra = new Compra();
            $objCompra->buscar($idcompra);
            $objCompraItem->cargar($objProducto, $objCompra, $valores['cicantidad']);
            $rsta = $objCompraItem->modificar();
            if($rsta['respuesta']){
                //todo gut
                $response = true;
            }
        }else{
            //no encontro el obj
            $response = false;
        }
        return $response;
    }



    public function buscarId(){
        $respuesta['respuesta'] = false;
        $respuesta['obj'] = null;
        $respuesta['error'] = '';
        $arrayBusqueda = [];
        $arrayBusqueda['idcompraitem'] = $this->buscarKey('idcompraitem');
        $objCompIt = new Compraitem();
        $rta = $objCompIt->buscar($arrayBusqueda);
        if($rta['respuesta']){
            $respuesta['respuesta'] = true;
            $respuesta['obj'] = $objCompIt;
        }else{
            $respuesta['error'] = $rta;
        }
        return $respuesta;        
    }

        public function busqueda(){
            $arrayBusqueda = [];
            $idcompraitem = $this->buscarKey('idcompraitem');
            $idproducto = $this->buscarKey('idproducto');
            $idcompra = $this->buscarKey('idcompra');
            $cicantidad = $this->buscarKey('cicantidad');
            
            $arrayBusqueda = ['idcompraitem' => $idcompraitem,
                            'idproducto' => $idproducto,
                            'idcompra' => $idcompra,
                            'cicantidad' => $cicantidad,
                            ];
            return $arrayBusqueda;
    }

    public function eliminar(){
        $rta = $this->buscarId();
        $response = false;
        if($rta['respuesta']){
            $objCompraItem = $rta['obj'];
            $respEliminar = $objCompraItem->eliminar();
            if($respEliminar['respuesta']){
                $response = true;
            }
        }else{
            //no encontro el obj
            $response = false;
        }
        return $response;
    }

        public function stockTotal(){
            $idProducto['idproducto'] = $this->buscarKey('idproducto');
            $objetoProducto = new Producto();
            $busquedaProducto = $objetoProducto->buscar($idProducto);
            if($busquedaProducto){
                $cantStock = $objetoProducto->getProCantStock();
            }
           /*  $objetoProducto = $this->getObjProducto();
            $cicantidad = $objetitoProd->getProCantStock(); */
            return $cantStock;

        }

        /*
        public function actualizarCantidad(){
            $cantidadTraida = $this->getCicantidad();

        }*/
}