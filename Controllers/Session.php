<?php

class Session {

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

    public function getUsuRol() {
        return $_SESSION['usuRol'];
    }

    public function setUsuRol( $usuRol ){
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
        $array = [
            'usnombre' => $usnombre, 
            'uspass' => $uspass, 
            'usdeshabilitado' => null
        ];

        $busqueda = $objUsuario->listarTodo( $array );
        if( count($busqueda) > 0 ){
            $usuarioLogueado = $busqueda[0];
            $this->setIdusuario( $usuarioLogueado->getIdusuario() );
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

        $str = '';
        if( $lista['array']->getUsnombre == $usuario
            && $lista['array']->getUspass == $pass ){
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
        if( isset($_SESSION['usuNombre']) ){
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
    
}