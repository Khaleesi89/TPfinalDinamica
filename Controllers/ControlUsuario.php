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

    public function buscar() {
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
}