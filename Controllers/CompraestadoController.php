<?php
//NO USARLO PORQUE STA AL PEDO
class CompraestadoController extends MasterController {
    use Errores;

    //crea array para la busqueda
    public function busqueda(){
        $arrayBusqueda = [];
        $idcompraestado = $this->buscarKey('idcompraestado');
        $idcompra = $this->buscarKey('idcompra');
        $idcompraestadotipo = $this->buscarKey('idcompraestadotipo');
        $cefechaini = $this->buscarKey('cefechaini');
        /* $cefechafin = $this->buscarKey('cefechafin'); */
        $arrayBusqueda = ['idcompraestado' => $idcompraestado,
                          'idcompra' => $idcompra,
                          'idcompraestadotipo' => $idcompraestadotipo,
                          'cefechaini' => $cefechaini,
                          ];
        return $arrayBusqueda;
    }

    public function listarTodo(){
        //$arrayBusqueda = $this->busqueda();
        $arrayBusqueda['cefechafin'] = NULL;
        $arrayTotal = Compraestado::listar($arrayBusqueda);
        if(array_key_exists('array', $arrayTotal)){
            $array = $arrayTotal['array'];
        }else{
            $array = [];
        }
        
        //var_dump($array);
        return $array;        
    }

    public function buscarId(){
        $respuesta['respuesta'] = false;
        $respuesta['obj'] = null;
        $respuesta['error'] = '';
        $arrayBusqueda = [];
        $arrayBusqueda['idcompraestado'] = $this->buscarKey('idcompraestado');
        $objCompraestado = new Compraestado();
        $rta = $objCompraestado->buscar($arrayBusqueda);
        if($rta['respuesta']){
            $respuesta['respuesta'] = true;
            $respuesta['obj'] = $objCompraestado;
        }else{
            $respuesta['error'] = $rta;
        }
        return $respuesta;        
    }

    public function insertarCompraEstadoNueva($idcompra){
        $objCompraEstado = new Compraestado();
        //generar objeto de compraestadotipo
        $arrBusCET['idcompraestadotipo'] = 1;
        $objCompraEstadoTipo = new Compraestadotipo();
        $objCompraEstadoTipo->buscar($arrBusCET);
        //generar objeto de compra 
        $arrBusC['idcompra'] = $idcompra;
        $objCompra = new Compra();
        $objCompra->buscar($arrBusC);
        $objCompraEstado->cargar($objCompra, $objCompraEstadoTipo);
        $rsta = $objCompraEstado->insertar();
        if($rsta['respuesta']){
            $response = true;
        }else{
            $response = false;
        }
        return $response;
    }


    //
    public function insertar(){
        $data = $this->busqueda();
        $objCompraestado = new Compraestado();
        $objCompraestado->setIdcompraestado($data['idcompraestado']);
        $objCompra = new Compra();
        $objCompra->buscar($data['idcompra']);
        $objCompraestado->setObjCompra($objCompra);
        $objCompraestadotipo = new Compraestado();
        $objCompraestadotipo->buscar($data['idcompraestadotipo']);
        $objCompraestado->setObjCompraestadotipo($objCompraestadotipo);
        $objCompraestado->setCefechaini($data['cefechaini']);
        $objCompraestado->setCefechafin($data['cefechafin']);
        $rta = $objCompraestado->insertar();
        return $rta;
    }

    

    public function modificar(){
        $rta = $this->buscarId();
        $response = false;
        if($rta['respuesta']){
            //puedo modificar con los valores
            $valores = $this->busqueda();
            
            $objCompraestado = $rta['obj'];
            /* $objCompraestado->cargar($valores['idcompraestado'], $valores['idcompra'], $valores['idcompraestadotipo'], $valores['cefechaini'], $valores['cefechafin']); */

            $objCompra = new Compra();
            $arridcompra = ['idcompra' => $valores['idcompra']];
            $objCompra->buscar($arridcompra);
            $objCompraestado->setObjCompra($objCompra);

            $objCompraestadotipo = new Compraestadotipo();
            $arridcompraestadotpo = ['idcompraestadotipo' => $valores['idcompraestadotipo']];
            /* var_dump($arridcompraestadotpo);
            die(); */
            $objCompraestadotipo->buscar($arridcompraestadotpo);
            $objCompraestado->setObjCompraestadotipo($objCompraestadotipo);

            $rsta = $objCompraestado->modificar();
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

    public function modificarTuplaestado(){
        $rta = $this->buscarId();

    }


    public function eliminar(){
        $rta = $this->buscarId();
        $response = false;
        if($rta['respuesta']){
            $objProducto = $rta['obj'];
            $respEliminar = $objProducto->eliminar();
            if($respEliminar['respuesta']){
                $response = true;
            }
        }else{
            //no encontro el obj
            $response = false;
        }
        return $response;
    }

    public function obtenerCompraActivaPorId($idcompra){
        $arrBus = [];
        $arrBus['idcompra'] = $idcompra;
        $arrBus['idcompraestadotipo'] = 1;
        $arrBus['cefechafin'] = NULL;
        $objCompraEstado = new Compra();
        $rta = $objCompraEstado->buscar($arrBus);
        $respuesta = false;
        if($rta['respuesta']){
            //salio bien la query
            if($objCompraEstado->getIdcompra() != NULL){
                //hay una compra activa
                $respuesta = $objCompraEstado->getIdcompra();
            }
        }
        return $respuesta;
    }

    public function pasarNuevoCodigo($numeroestadonuevo){
        $controler = new Compraestadotipo();
        $controler->setIdcompraestadotipo($numeroestadonuevo);
        
    }




    //HACER FUNCION PARA RESTAR LA CANTIDAD DE PRODUCTOS.



    //COMPROBAR LA CANTIDAD




    
}