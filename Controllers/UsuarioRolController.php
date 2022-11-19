<?php

class UsuarioRolController extends MasterController {
    use Errores;

    public function listarTodo( $arrayBusqueda ){
        $rta = Usuariorol::listar( $arrayBusqueda );
        if( $rta['respuesta'] == true ){
            //conversion
            $data['array'] = $rta['array'];
            $data['arrayHTML'] = [];
            foreach ($data['array'] as $key => $value) {
                $objUsuarioRol = $value;
                $objUsuario = $value->getObjUsuario();
                $objRol = $value->getObjRol();
                $idur = $objUsuarioRol->getIdur();
                $nombre = $objUsuario->getUsnombre();
                $rol = $objRol->getRodescripcion();
                $array['idur'] = $idur;
                $array['nombre'] = $nombre;
                $array['rol'] = $rol;
                array_push($data['arrayHTML'], $array);
            }
        } else {
            $data['error'] = $this->manejarError( $rta );
        }
        return $data;
    }

    public function buscarRoles(){
        $idusuario = $this->buscarKey('idusuario');
        //var_dump($idusuario);
        $arrayBus = [];
        $arrayBus['idusuario'] = $idusuario;
        $rta = Usuariorol::listar($arrayBus);
        $listaRoles = [];
        if($rta['respuesta']){
            $listaRoles = $rta['array'];
        }
        return $listaRoles;
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

    public function eliminar(){
        $response = false;
        $arrayBus['idur'] = $this->buscarKey('idur');
        $objUsuarioRol = new UsuarioRol();
        $rta = $objUsuarioRol->buscar($arrayBus);
        if($rta['respuesta']){
            $rtaa = $objUsuarioRol->eliminar();
            if($rtaa['respuesta']){
                //se elimino
                $response = true;
            }
        }
        return $response;
    }

    public function getRoles(){
        $arrayBus = [];
        $listaRoles = Rol::listar($arrayBus);
        return $listaRoles['array'];
    }

    public function getUsuarios(){
        $arrayBus = [];
        $arrayBus['usdeshabilitado'] = NULL;
        $listaUsuarios = Usuario::listar($arrayBus);
        return $listaUsuarios['array'];
    }

    public function obtenerNuevosRoles(){
        $roles = $this->getRoles();
        $arrayRoles = [];
        foreach ($roles['array'] as $key => $value) {
            $data = $value->dameDatos();
            $array['idrol'] = $data['idrol'];
            $array['rodescripcion'] = $data['rodescripcion'];
            array_push($arrayRoles, $array);
        }
        $arrayRta = [];
        foreach ($arrayRoles as $key => $value) {
            $rodescripcion = $value['rodescripcion'];
            $input = $this->buscarKey("$rodescripcion");
            if($input != null){
                $campo = true;
            }else{
                $campo = false;
            }
            $arr[$rodescripcion] = $campo;
            array_push($arrayRta, $arr);
        }
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
