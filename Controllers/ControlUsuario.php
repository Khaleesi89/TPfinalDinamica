<?php

class ControlUsuario extends MasterController {
    use Errores;

    public function listarTodo( $arrayBusqueda ){
        $rta = Usuario::listar( $arrayBusqueda );
        if( $rta['respuesta'] == true ){
            $data['array'] = $rta['array'];
        } else {
            $data['error'] = $this->manejarError( $rta );
        }
        return $data;
    }

    public function buscarId() {
        $idBusqueda = $this->buscarKey( 'id' );
        if( $idBusqueda == false ){
            // error
            $data['error'] = $this->warning( 'No se ha encontrado dicho registro' );
        } else {
            // encontrado!
            $array['id'] = $idBusqueda;
            $usuario = new Usuario();
            $rta = $usuario->buscar( $array );
            if( $rta['respuesta'] == false ){
                $data['error'] = $this->manejarError( $rta );
            } else {
                $data['array'] = $usuario;
            }
            return $data;
        }
    }

    public function insertar( $data ){
        
    }

    public function modificacionChetita() {
        $rta = $this->buscarId();
        $usuario = $rta['array'];

        $usNombre = $this->buscarKey( 'usnombre' );
        $usPass = $this->buscarKey( 'uspass' );
        $usMail = $this->buscarKey( 'usmail' );
        $usDeshabilitado = $this->buscarKey( 'usdeshabilitado' );

        $usuario->setUsnombre( $usNombre );
        $usuario->setUspass( $usPass );
        $usuario->setUsmail( $usMail );
        $usuario->setUsdeshabilitado( $usDeshabilitado );

        $respuesta = $usuario->modificar();
        return $respuesta;
    }

    public function baja( $param ){
        $bandera = false;
        if( $param->getId() !== null ){
            if( $param->eliminar() ){
                $bandera = true;
            }
        }
        return $bandera;
    }

}