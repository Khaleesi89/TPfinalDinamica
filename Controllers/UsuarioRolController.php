<?php

class UsuarioRolController extends MasterController {
    use Errores;

    public function listarTodo( $arrayBusqueda ){
        $rta = Usuariorol::listar( $arrayBusqueda );
        if( $rta['respuesta'] == true ){
            $data['array'] = $rta['array'];
        } else {
            $data['error'] = $this->manejarError( $rta );
        }
        return $data;
    }

    public function buscarId() {
        $idBusqueda = $this->buscarKey( 'idur' );
        if( $idBusqueda == false ){
            // Error
            $data['error'] = $this->warning( 'No se ha encontrado dicho registro' );
        } else {
            // Se encontró
            $array['id'] = $idBusqueda;
            $usuarioRol = new Usuariorol();
            $rta = $usuarioRol->buscar( $array );
            if( $rta['respuesta'] == false ){
                $data['error'] = $this->manejarError( $rta );
            } else {
                $data['array'] = $usuarioRol;
            }
        }
        return $data;
    }

    public function insertar( $data ){
        $newUsuarioRol = new Usuariorol();
        $newUsuarioRol->setIdur( $data['idur'] );
        $newUsuarioRol->setObjUsuario( $data['objUsuario'] );
        $newUsuarioRol->setObjRol( $data['objRol'] );

        $operacion = $newUsuarioRol->insertar();
        if( $operacion['respuesta'] == false ){
            $rta = $operacion['errorInfo'];
        } else {
            $rta = $operacion['respuesta'];
        }
        return $rta;
    }

    public function modificacionChetita() {
        $rta = $this->buscarId();
        $usuarioRol = $rta['array'];

        $idur = $this->buscarKey( 'idur' );
        $objUsuario = $this->buscarKey( 'objUsuario' );
        $objRol = $this->buscarKey( 'objRol' );

        $usuarioRol->setIdur( $idur );
        $usuarioRol->setObjUsuario( $objUsuario );
        $usuarioRol->setObjRol( $objRol );

        $respuesta = $usuarioRol->modificar();
        return $respuesta;
    }

    public function baja( $param ){
        $bandera = false;
        if( $param->getIdur !== null ){
            if( $param->eliminar() ){
                $bandera = true;
            }
        }
        return $bandera;
    }
}
