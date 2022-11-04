<?php
require_once('../config.php');
class Rol extends db {
    use Condicion;

    //Atributos
    private $idRol;
    private $nombreRol;
    private $mensajeOp;
    static $mensajeStatic;

    // Constructor
    public function __construct() {
        $this->idRol = '';
        $this->nombreRol = '';
        $this->mensajeOp = '';
    }

    // Getters & Setters
    public function getIdRol(){
        return $this->idRol;
    }
    public function setIdRol($idRol){
        $this->idRol = $idRol;
    }
    public function getNombreRol(){
        return $this->nombreRol;
    }
    public function setNombreRol($nombreRol){
        $this->nombreRol = $nombreRol;
    }
    public function getMensajeOp(){
        return $this->mensajeOp;
    }
    public function setMensajeOp($mensajeOp){
        $this->mensajeOp = $mensajeOp;
    }
    public static function getMensajeStatic(){
        return Rol::$mensajeStatic;
    }
    public static function setMensajeStatic($mensajeStatic){
        Rol::$mensajeStatic = $mensajeStatic;
    }

    // Cargar
    public function cargar( $idRol, $nombreRol){
        $this->setIdRol($idRol);
        $this->setNombreRol($nombreRol);
    }

    public function buscar($id){
        $respuesta['respuesta'] = false;
        $respuesta['errorInfo'] = '';
        $respuesta['codigoError'] = null;
        $sql = "SELECT * FROM rol WHERE idRol=$id";
        $base = new db();
        try {
            if($base->Iniciar()){
                if($base->Ejecutar($sql)){
                    if($row2 = $base->Registro()){
                        $this->setIdRol($row2['idRol']);
                        $this->setNombreRol($row2['nombreRol']);                       
                        $respuesta['respuesta'] = true;
                    }
                }else{
                    $this->setMensajeOp($base->getError());
                    $respuesta['respuesta'] = false;
                    $respuesta['errorInfo'] = 'Hubo un error con la consulta';
                    $respuesta['codigoError'] = 1;
                }
            }else{
                $this->setMensajeOp($base->getError());
                $respuesta['respuesta'] = false;
                $respuesta['errorInfo'] = 'Hubo un error con la conexión de la base de datos';
                $respuesta['codigoError'] = 0;
            }
        } catch (\Throwable $th) {
            $respuesta['respuesta'] = false;
            $respuesta['errorInfo'] = $th;
            $respuesta['codigoError'] = 3;
        }
        $base = null;
        return $respuesta;
    }

    public function insertar(){
        $respuesta['respuesta'] = false;
        $respuesta['errorInfo'] = '';
        $respuesta['codigoError'] = null;
        $base = new db();
        $sql = "INSERT INTO rol VALUES(DEFAULT, '{$this->getNombreRol()}')";
        //var_dump($sql);
        try {
            if($base->Iniciar()){
                if($base->Ejecutar($sql)){
                    $respuesta['respuesta'] = true;
                }else{
                    $this->setMensajeOp($base->getError());
                    $respuesta['respuesta'] = false;
                    $respuesta['errorInfo'] = 'Hubo un error con la consulta';
                    $respuesta['codigoError'] = 1; 
                }
            }else{
                $this->setMensajeOp($base->getError());
                $respuesta['respuesta'] = false;
                $respuesta['errorInfo'] = 'Hubo un error con la conexión de la base de datos';
                $respuesta['codigoError'] = 0; 
            }
        } catch (\Throwable $th) {
            $respuesta['respuesta'] = false;
            $respuesta['errorInfo'] = $th;
            $respuesta['codigoError'] = 3;
        }
        $base = null;
        return $respuesta;
    }

    //Antes de usar el modificar se debe utilizar el buscar
    public function modificar(){
        //seteo de respuesta
        $respuesta['respuesta'] = false;
        $respuesta['errorInfo'] = '';
        $respuesta['codigoError'] = null;
        $base = new db();
        $sql = "UPDATE rol SET nombreRol = '{$this->getNombreRol()}' WHERE idRol = {$this->getIdRol()}";
        try {
            if( $base->Iniciar() ){
                if( $base->Ejecutar($sql) ){
                    $respuesta['respuesta'] = true;
                } else {
                    $this->setMensajeOp( $base->getError() );
                    $respuesta['respuesta'] = false;
                    $respuesta['errorInfo'] = 'Hubo un error con la consulta';
                    $respuesta['codigoError'] = 1;
                }
            } else {
                $this->setMensajeOp( $base->getError() );
                $respuesta['respuesta'] = false;
                $respuesta['errorInfo'] = 'Hubo un error con la conexión de la base de datos';
                $respuesta['codigoError'] = 0;
            }
        } catch( \Throwable $th ){
            $respuesta['respuesta'] = false;
            $respuesta['errorInfo'] = $th;
            $respuesta['codigoError'] = 3;
        }
        $base = null;
        return $respuesta;
    }

    //Antes de utilizar el eliminar se debe utilizar el buscar
    public function eliminar(){
        //seteo de respuesta
        $respuesta['respuesta'] = false;
        $respuesta['errorInfo'] = '';
        $respuesta['codigoError'] = null;
        $base = new db();
        $sql = "DELETE FROM rol WHERE idRol = {$this->getIdRol()}";
        try {
            if($base->Iniciar()){
                if($base->Ejecutar($sql)){
                    $respuesta['respuesta'] = true;
                }else{
                    $this->setMensajeOp($base->getError());
                    $respuesta['respuesta'] = false;
                    $respuesta['errorInfo'] = 'Hubo un error con la consulta';
                    $respuesta['codigoError'] = 1;
                }
            }else{
                $this->setMensajeOp($base->getError());
                $respuesta['respuesta'] = false;
                $respuesta['errorInfo'] = 'Hubo un error con la conexión de la base de datos';
                $respuesta['codigoError'] = 0;
            }
        } catch (\Throwable $th) {
            $respuesta['respuesta'] = false;
            $respuesta['errorInfo'] = $th;
            $respuesta['codigoError'] = 3;
        }
        $base = null;
        return $respuesta;
    }

    public static function listar(){
        //seteo de respuesta
        $respuesta['respuesta'] = false;
        $respuesta['errorInfo'] = '';
        $respuesta['codigoError'] = null;
        $arregloRoles = null;
        $base = new db();
        $sql = "SELECT * FROM notas";
        try {
            if($base->Iniciar()){
                if($base->Ejecutar($sql)){
                    $arregloRoles = array();
                    while($row2 = $base->Registro()){
                        $idRol = $row2['idRol'];
                        $nombreRol = $row2['nombreRol'];
                        $rol = new Rol();
                        $rol->cargar($idRol, $nombreRol);
                        array_push($arregloRoles, $rol);
                    }
                    $respuesta['respuesta'] = true;
                }else{
                    Rol::setMensajeStatic($base->getError());
                    $respuesta['respuesta'] = false;
                    $respuesta['errorInfo'] = 'Hubo un error con la consulta';
                    $respuesta['codigoError'] = 1;
                }
            }else{
                Rol::setMensajeStatic($base->getError());
                $respuesta['respuesta'] = false;
                $respuesta['errorInfo'] = 'Hubo un error con la conexión de la base de datos';
                $respuesta['codigoError'] = 0;
            }
        } catch (\Throwable $th) {
            $respuesta['respuesta'] = false;
            $respuesta['errorInfo'] = $th;
            $respuesta['codigoError'] = 3;
        }
        $base = null;
        if($respuesta['respuesta']){
            $respuesta['array'] = $arregloRoles;
        }
        return $respuesta;
    }

    
    public function dameDatos(){
        $data = [];
        $data['idRol'] = $this->getIdRol();
        $data['nombreRol'] = $this->getNombreRol();
        return $data;
    }


    
}