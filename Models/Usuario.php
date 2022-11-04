<?php
require_once('../config.php');
class Usuario extends db{
    use Condicion;
    //Atributos
    private $idusuario;
    private $usnombre;
    private $uspass;
    private $usmail;//revisar en la db el tipo de dato
    private $usdeshabilitado;
    private $mensajeOp;
    static $mensajeStatic;

    //Constructor
    public function __construct(){
        $this->idusuario = '';
        $this->usnombre = '';
        $this->uspass = '';
        $this->usmail = '';
        $this->usdeshabilitado = '';
        $this->mensajeOp = '';
    }

    //Getters y setters
    public function getIdusuario(){
        return $this->idusuario;
    }
    public function setIdusuario($idusuario){
        $this->idusuario = $idusuario;
    }
    public function getUsnombre(){
        return $this->usnombre;
    }
    public function setUsnombre($usnombre){
        $this->usnombre = $usnombre;
    }
    public function getUspass(){
        return $this->uspass;
    }
    public function setUspass($uspass){
        $this->uspass = $uspass;
    }
    public function getUsmail(){
        return $this->usmail;
    }
    public function setUsmail($usmail){
        $this->usmail = $usmail;
    }
    public function getUsdeshabilitado(){
        return $this->usdeshabilitado;
    }
    public function setUsdeshabilitado($usdeshabilitado){
        $this->usdeshabilitado = $usdeshabilitado;
    }
    public function getMensajeOp(){
        return $this->mensajeOp;
    }
    public function setMensajeOp($mensajeOp){
        $this->mensajeOp = $mensajeOp;
    }
    public static function getMensajeStatic(){
        return Usuario::$mensajeStatic;
    }
    public static function setMensajeStatic($mensajeStatic){
        Usuario::$mensajeStatic = $mensajeStatic;
    }
}