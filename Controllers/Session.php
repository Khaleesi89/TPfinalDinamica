<?php

class Session extends MasterController {

    /**
     * Método constructor
     * Si no está iniciada una sesión, comienza una nueva
     */
    public function __construct() {
        if( !isset($_SESSION) ){
            session_start();
        }
    }

/*// LA PROFE MALAPI LA TIENE ASI

public function __construct(){
    if (!session_start()) {
        return false;
    } else {
        return true;
    }
  }*/


    /**
     * Getters & Setters
     * Obtiene y setea los índices de la variable $_SESSION
     */
    public function getIdusuario() {
        return $_SESSION['idusuario'];
    }
    public function setIdusuario( $idusuario ){
        $_SESSION['idusuario'] = $idusuario;
    }

    public function getUsnombre() {
        return $_SESSION['usnombre'];
    }
    public function setUsnombre( $usnombre ){
        $_SESSION['usnombre'] = $usnombre;
    }

    public function getUspass() {
        return $_SESSION['uspass'];
    }

    public function setUspass( $uspass ){
        $_SESSION['uspass'] = $uspass;
    }

    public function getUsRol() {
        return $_SESSION['usuRol'];
    }

    public function setUsRol( $usuRol ){
        $_SESSION['usuRol'] = $usuRol;
    }

    /**
     * Método que actualiza las variables de sesión con valores ingresados
     * @param $usuNombre
     * @param $usuPass
     */
    public function iniciar( $usnombre, $uspass ){
        $bandera = false;
        $objUsuario = new UsuarioController();
        $objUsuarioRol = new UsuarioRolController();

        /* $usuariorolbusqueda = $objUsuarioRol->buscarId();
        $usuarioRol = $usuariorolbusqueda['array']->getObjRol();
        $usrol = $usuarioRol->getIdrol(); */

        $array = [
            'usnombre' => $usnombre, 
            'uspass' => $uspass, 
            'usdeshabilitado' => null
        ];
        $busqueda = $objUsuario->listarTodo( $array );


        if( count($busqueda) > 0 ){
            $usuarioLogueado = $busqueda[0];
            //var_dump( $usuarioLogueado );
            $idusuario = $usuarioLogueado->getIdusuario();
            $usnombre = $usuarioLogueado->getUsnombre();
            $uspass = $usuarioLogueado->getUspass();

            $idus = $objUsuarioRol->buscarIdUsuario();
            $this->setIdusuario( $idusuario );
            $this->setUsnombre( $usnombre );
            $this->setUspass( $uspass );
            if( $idus == $this->getIdusuario() ){
                $this->setUsRol( $usrol );
            }
        }
        return $bandera;
    }

    /**
     * Método que valida si la sesión actual tiene usuario y pass válidos.
     * @return boolean
     */
    public function validar(){
        $validado = false;
        $usuario = $this->getUsnombre();
        $pass = $this->getUspass();

        $filtroNombre = ['usnombre' => $usuario];
        $filtroPass = ['uspass' => $pass];
        /* $query = [
            'usnombre' => $usuario,
            'uspass' => $pass
        ]; */

        $controlUsuario = new UsuarioController();
        $lista = $controlUsuario->buscarId();
        //var_dump( $lista );

        $str = '';
        $usnombrelista = $lista['obj']->getUsnombre();
        $uspasslista = $lista['obj']->getUspass();
        if( $usnombrelista == $usuario && $uspasslista == $pass ){
            $validado = true;
        } else {
            $str = 'Credenciales incorrectas';
        }
        return $validado;

    }

    /**
     * Método que verifica si la sesión esta activa o no
     * Retorna true si está activa, caso contrario false
     * @param void
     * @return boolean
     */
    public function activa() {
        $bandera = false;
        if( isset($_SESSION['usnombre']) ){
            $bandera = true;
        }
        return $bandera;
    }

    /**
     * Método que finaliza una sesión
     * @param void
     * @return void
     */
    public function cerrar() {
        session_unset();
        session_destroy();
    }

    // Get rol de usuario
    public function getRol() {
        $objUsuarioRol = new UsuarioRolController();
        $rolUsuario = [];
        $listaUsuarios = $objUsuarioRol->getUsuarios();
        foreach( $listaUsuarios as $usuario ){
            $id = $usuario->getIdusuario();
            if( $id == $this->getIdusuario() ){
                $rolUsuario = $objUsuarioRol->buscarRoles();
            }
        }
        return $rolUsuario;
    }
    
    public function isAdmin( $rol ){
        $bandera = false;
        if( $rol == 'Admin' && $rol == $this->getUsRol() ){
            $bandera = true;
        }
        return $bandera;
    }
    
    // dame datos de idusuario, roles del usuario
    public function dameDatos() {
        $data = [];
        $data['idusuario'] = $this->getIdusuario();
        $data['rolesusuario'] = $this->getRol();
        return $data;
    }

    public function rolesUsuario() {
        $objUsuarioRolCon = new UsuarioRolController();
        $rta = $objUsuarioRolCon->buscarRoles();
        $arrayRoles = $objUsuarioRolCon->getRoles();
        $rolesSimple = [];
        foreach( $arrayRoles as $key => $value ){
            $data = $value->dameDatos();
            $rolesSimple[$data['idrol']] = false;
        }
        //var_dump($rolesSimple);
        //convertir roles del usuario a texto
        $rolesTexto = [];
        //var_dump($rta);
        if( count($rta) != 0 ){
            foreach( $rta as $key => $value ){
                $data = $value->dameDatos();
                //$idRol = $data['idrol'];
                //var_dump($idRol);
                $rolesTexto[$data['idrol']] = true;
            }
        }
        //var_dump($rolesTexto);
        //var_dump($rolesSimple);
        $string = "";
        $arrayOtro = [];
        if( count($rolesTexto) != 0 ){
            foreach( $rolesSimple as $id => $idrolArray ){
                $valor = 'false';
                if( array_key_exists($id, $rolesTexto) ){
                    $rolesSimple[$id] = true;
                    $valor = 'true';
                    
                }
                $arrayOtro["rol$id"] = $valor;
                if( $string == '' ){
                    $string.="[$id => $valor,";
                } else {
                    $string.= " $id => $valor,";
                }
                
            }
        }
        $string = substr( $string, 0, -1 );
        $string .= "] ";
        $objNuevo = (object)array( 'data' => $arrayOtro );
        return $objNuevo;
    }

    
}