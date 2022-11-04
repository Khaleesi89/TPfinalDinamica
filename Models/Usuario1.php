<?php
require_once('../config.php');
class Usuario extends db{
    use Condicion;

    //Atributos
    private $idUsuario;
    private $usuarioNombre;
    private $usuPassword;
    private $mail;
    private $objRol; // delegamos el id de la tabla rol
    private $mensajeOp;
    static $mensajeStatic;

    // Constructor
    public function __construct() {
        $this->idUsuario = '';
        $this->usuarioNombre = '';
        $this->usuPassword = '';
        $this->mail = '';
        $this->objRol = null;
        $this->mensajeOp = '';
    }

    //Getter y setters
    public function getIdUsuario(){
        return $this->idUsuario;
    }
    public function setIdUsuario($idUsuario){
        $this->idUsuario = $idUsuario;
    }
    public function getUsuarioNombre(){
        return $this->usuarioNombre;
    }
    public function setUsuarioNombre($usuarioNombre){
        $this->usuarioNombre = $usuarioNombre;
    }
    public function getUsuPassword(){
        return $this->usuPassword;
    }
    public function setUsuPassword($usuPassword){
        $this->usuPassword = $usuPassword;
    }
    public function getMail(){
        return $this->mail;
    }
    public function setMail($mail){
        $this->mail = $mail;
    }
    public function getObjRol(){
        return $this->objRol;
    }
    public function setObjRol($objRol){
        $this->objRol = $objRol;
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

    //getter solo pa nombre de rol
    public function getRol(){
        $objRol = $this->getObjRol();
        $dataRol = $objRol->dameDatos();
        return $dataRol;
    }

    // Cargar
    public function cargar( $idUsuario, $usuarioNombre, $usuPassword, $mail, $objRol){
        $this->setIdUsuario($idUsuario);
        $this->setUsuarioNombre($usuarioNombre);
        $this->setUsuPassword($usuPassword);
        $this->setMail($mail);
        $this->setObjRol($objRol);
    }

    //En el busqueda agregar de buscar siempre con deleted en null
    public function buscar($arrayBusqueda){
        $stringBusqueda = $this->setearBusquedaUsuario($arrayBusqueda);
        //seteo de respuesta
        $respuesta['respuesta'] = false;
        $respuesta['errorInfo'] = '';
        $respuesta['codigoError'] = null;
        //busqueda en si
        $sql = "SELECT * FROM usuario";
        if($stringBusqueda != ''){
            $sql.= ' WHERE ';
            $sql.= $stringBusqueda;
        }
        $base = new db();
        try {
            if($base->Iniciar()){
                if($base->Ejecutar($sql)){
                    if($row2 = $base->Registro()){
                        $this->setIdUsuario($row2['idUsuario']);
                        $this->setUsuarioNombre($row2['usuarioNombre']);
                        $this->setUsuPassword($row2['usuPassword']);
                        $this->setMail($row2['mail']);
                        $idRol = $row2['idRol'];
                        $rol = new Rol();
                        $rta = $rol->buscar($idRol);
                        if($rta['respuesta'] ){
                            //true
                            $this->setObjRol($rol);
                        }else{
                            $this->setMensajeOp($rta['errorInfo']);
                        }
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
        $datosRol = $this->getRol();
        $idRol = $datosRol['idRol'];
        $sql = "INSERT INTO usuario VALUES(DEFAULT, {$this->getUsuarioNombre()}', {$this->getUsuPassword()}', {$this->getMail()}', '', $idRol)";
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

    //Antes de usar el modificar se debe utilizar el buscar.
    //En el controlador fijarse si no hay un usuario con el mismo nombre
    //En el controlador fijarse si hay un id de rol 
    public function modificar(){
        //seteo de respuesta
        $respuesta['respuesta'] = false;
        $respuesta['errorInfo'] = '';
        $respuesta['codigoError'] = null;
        $base = new db();
        $datosRol = $this->getRol();
        $idRol = $datosRol['idRol'];
        $sql = "UPDATE usuario SET usuarioNombre = '{$this->getUsuarioNombre()}', usuPassword = '{$this->getUsuPassword()}', mail = '{$this->getMail()}', deleted = '', idRol = $idRol} WHERE id = {$this->getIdUsuario()}";
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

    //Usar el buscar antes del eliminar
    public function eliminar(){
        //seteo de respuesta
        $respuesta['respuesta'] = false;
        $respuesta['errorInfo'] = '';
        $respuesta['codigoError'] = null;
        $base = new db();
        //obtener fecha actual
        $fecha = getdate();
        $fechaPosta = $fecha['mday'].':'.$fecha['mon'].':'.$fecha['year'];
        $sql = "UPDATE usuario SET deleted = '$fechaPosta' WHERE id = {$this->getIdUsuario()}";
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

    /*Se pasara un array asociativo que contenga
    $arrayBusqueda['idUsuario'] = valor/null,
    $arrayBusqueda['usuarioNombre'] = valor/null,
    $arrayBusqueda['mail'] = valor/null,
    $arrayBusqueda['deleted'] = valor/null,
    $arrayBusqueda['idRol'] = valor/null
    */
    public static function listar($arrayBusqueda){
        //seteo de respuesta
        $respuesta['respuesta'] = false;
        $respuesta['errorInfo'] = '';
        $respuesta['codigoError'] = null;
        $arregloUsuario = null;
        $base = new db();
        //seteo de busqueda
        $stringBusqueda = Usuario::setearBusquedaStaticUsuario($arrayBusqueda);
        $sql = "SELECT * FROM usuario";
        if($stringBusqueda != ''){
            $sql.= ' WHERE ';
            $sql.= $stringBusqueda;
        }
        try {
            if($base->Iniciar()){
                if($base->Ejecutar($sql)){
                    $arregloUsuario = array();
                    while($row2 = $base->Registro()){
                        $idUsuario = $row2['idUsuario'];
                        $usuarioNombre = $row2['usuarioNombre'];
                        $usuPassword = $row2['usuPassword'];
                        $mail = $row2['mail'];
                        $idRol = $row2['idRol'];
                        //creo el objeto de rol
                        $objRol = new Rol();
                        $objRol->buscar($idRol);
                        $usuario = new Usuario();
                        $usuario->cargar($idUsuario, $usuarioNombre, $usuPassword, $mail, $objRol);
                        array_push($arregloUsuario, $usuario);
                    }
                    $respuesta['respuesta'] = true;
                }else{
                    Usuario::setMensajeStatic($base->getError());
                    $respuesta['respuesta'] = false;
                    $respuesta['errorInfo'] = 'Hubo un error con la consulta';
                    $respuesta['codigoError'] = 1;
                }
            }else{
                Usuario::setMensajeStatic($base->getError());
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
            $respuesta['array'] = $arregloUsuario;
        }
        return $respuesta;
    }

    public function dameDatos(){
        $datosRol = $this->getRol();
        $data = [];
        $data['idUsuario'] = $this->getIdUsuario();
        $data['usuarioNombre'] = $this->getUsuarioNombre();
        $data['usuPassword'] = $this->getUsuPassword();
        $data['mail'] = $this->getMail();
        $data['nombreRol'] = $datosRol['nombreRol'];
        return $data;
    }

}