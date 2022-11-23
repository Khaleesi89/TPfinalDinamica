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
            $objProducto = $rta['obj'];
            $objProducto->cargar($valores['sinopsis'], $valores['pronombre'], $valores['procantstock'], $valores['autor'], $valores['precio'], $valores['isbn'], $valores['categoria']);
            $rsta = $objProducto->modificar();
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

        public function stockTotal(){
            $objetitoProd = $this->getObjProducto();
            $cicantidad = $objetitoProd->getProCantStock();
            return $cicantidad;

        }

        /*
        public function actualizarCantidad(){
            $cantidadTraida = $this->getCicantidad();

        }*/
}