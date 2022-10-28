<?php 
require_once('../config.php');
class Paginas extends db{
    use Condicion;
    //Atributos
    private $idPagina;
    private $nombre;
    private $descripcion;
    private $link;
    private $mensajeOp;
    static $mensajeStatic;

    // Constructor
    public function __construct() {
        $this->idPagina = '';
        $this->nombre = '';
        $this->descripcion = '';
        $this->link = '';
        $this->mensajeOp = '';
    }

    //Getters y setters
    public function getIdPagina(){
        return $this->idPagina;
    }
    public function setIdPagina($idPagina){
        $this->idPagina = $idPagina;
    }
    public function getNombre(){
        return $this->nombre;
    }
    public function setNombre($nombre){
        $this->nombre = $nombre;
    }
    public function getDescripcion(){
        return $this->descripcion;
    }
    public function setDescripcion($descripcion){
        $this->descripcion = $descripcion;
    }
    public function getLink(){
        return $this->link;
    }
    public function setLink($link){
        $this->link = $link;
    }
    public function getMensajeOp(){
        return $this->mensajeOp;
    }
    public function setMensajeOp($mensajeOp){
        $this->mensajeOp = $mensajeOp;
    }
    public static function getMensajeStatic(){
        return Paginas::$mensajeStatic;
    }
    public static function setMensajeStatic($mensajeStatic){
        Paginas::$mensajeStatic = $mensajeStatic;
    }

    public function cargar($idPagina, $nombre, $descripcion, $link){
        $this->setIdPagina($idPagina);
        $this->setNombre($nombre);
        $this->setDescripcion($descripcion);
        $this->setLink($link);
    }

    
}