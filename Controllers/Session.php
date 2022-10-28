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

    /**
     * Getters & Setters
     * Obtiene y setea los índices de la variable $_SESSION
     */
    public function getIdUsuario() {
        return $_SESSION['idUsuario'];
    }
    public function setIdusuario( $idusuario ){
        $_SESSION['idUsuario'] = $idusuario;
    }

    public function getUsuNombre() {
        return $_SESSION['usuNombre'];
    }
    public function setUsuNombre( $usuNombre ){
        $_SESSION['usuNombre'] = $usuNombre;
    }

    public function getUsuPass() {
        return $_SESSION['usuPass'];
    }

    public function setUsuPass( $usuPass ){
        $_SESSION['usuPass'] = $usuPass;
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
    public function iniciar( $usuNombre, $usuPass ){
        $this->setUsuNombre( $usuNombre );
        $this->setUsuPass( $usuPass );
    }

    /**
     * Método que valida si la sesión actual tiene usuario y pass válidos.
     * @return boolean
     */
    public function validar(){
        $validado = false;
        $usuario = $this->getUsuNombre();
        $pass = $this->getUsuPass();
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