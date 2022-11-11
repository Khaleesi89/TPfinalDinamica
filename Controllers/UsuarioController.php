<?php

class UsuarioController extends MasterController {
    use Errores;

    public function listarTodo( $arrayBusqueda ){
        $rta = Usuario::listar( $arrayBusqueda );
        if( $rta['respuesta'] ){
            $data['array'] = $rta['array'];
        } else {
            $data['error'] = $this->manejarError( $rta['error'] );
        }
        return $data;
    }

    public function buscarId() {
        $idBusqueda = $this->buscarKey( 'idusuario' );
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
        $newUsuario = new Usuario();
        $newUsuario->setIdusuario( $data['idusuario'] );
        $newUsuario->setUsnombre( $data['usnombre'] );
        $newUsuario->setUspass( $data['uspass'] );
        $newUsuario->setUsmail( $data['usmail'] );
        $newUsuario->setUsdeshabilitado( $data['usdeshabilitado'] );

        $operacion = $newUsuario->insertar();
        if( $operacion['respuesta'] == false ){
            $rta = $operacion['errorInfo'];
        } else {
            $rta = $operacion['respuesta'];
        }
        return $rta;
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
        if( $param->getIdusuario() !== null ){
            if( $param->eliminar() ){
                $bandera = true;
            }
        }
        return $bandera;
    }

}