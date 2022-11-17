<?php

class CompraestadotipoController extends MasterController{
    use Errores;

    public function listarTodo( $arrayBusqueda ){
        $rta = Compraestadotipo::listar( $arrayBusqueda );
        if( $rta['respuesta'] == true ){
            $data['array'] = $rta['array'];
        } else {
            $data['error'] = $this->manejarError( $rta );
        }
        return $data;
    }

    public function buscarId() {
        $idBusqueda = $this->buscarKey( 'idcompraestadotipo' );
        if( $idBusqueda == false ){
            // Error
            $data['error'] = $this->warning( 'No se ha encontrado dicho registro' );
        } else {
            // Encontrado!
            $array['idcompraestadotipo'] = $idBusqueda;
            $objCompraestadotipo = new Compraestadotipo();
            $rta = $objCompraestadotipo->buscar( $array );
            if( $rta['respuesta'] == false ){
                $data['error'] = $this->manejarError( $rta );
            } else {
                $data['array'] = $objCompraestadotipo;
            }
            return $data;
        }
    }

    /* public function modificacionChetita() {
        $rta = $this->buscarId();
        $rol = $rta['array'];

        $roDescripcion = $this->buscarKey( 'rodescripcion' );
        $rol->setRodescripcion( $roDescripcion );

        $respuesta = $rol->modificar();
        return $respuesta;
    }

    public function baja( $param ){
        $bandera = false;
        if( $param->getIdrol() !== null ){
            if( $param->eliminar() ){
                $bandera = true;
            }
        }
        return $bandera;
    } */


}