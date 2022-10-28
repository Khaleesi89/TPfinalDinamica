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

    public function getUsuRol() {
        return $_SESSION['usuRol'];
    }

    public function setUsuRol( $usuRol ){
        $_SESSION['usuRol'] = $usuRol;
    }

    /**
     * Método que setea sesion de un usuario
     * @param $usuNombre
     */
    public function cargar( $usuNombre, $usuPass ){
        $this->setUsuNombre( $usuNombre );
    }
    
}