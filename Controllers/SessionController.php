<?php

class SessionController extends MasterController {

    public function __construct(){
        if (!isset($_SESSION)) {
            session_start();
        }
    }

    public function getUsnombre() {
        return $_SESSION['usnombre'];
    }

    public function getIdusuario() {
        return $_SESSION['idusuario'];
    }

    public function existenCredenciales() {
        $sevalido = false;
        $usnombre = $this->buscarKey('usnombre');
        $uspass = $this->buscarKey('uspass');
        //var_dump($usnombre);
        //var_dump($uspass);
        if (($usnombre != false && $uspass != false) || (isset($_SESSION['usnombre']))) {
            //hay credenciales enviadas
            $_SESSION['usnombre'] = $usnombre;
            $sevalido = true;
        }
        return $sevalido;
    }

    /** Identifica si la sesion esta activa
     * @return bool
     */
    public function activa() {
        $bandera = false;
        if( isset($_SESSION['usnombre']) ){
            $bandera = true;
        }
        return $bandera;
    }

    /** Identificamos si las credenciales ingresadas concuerdan con algun usuario
     * en la base de datos 
    * @return bool
    */
    public function validarCredenciales() {
        $usnombre = $this->buscarKey('usnombre');
        $uspass = $this->buscarKey('uspass');
        //echo "<script>console.log('$uspass');console.log('$usnombre');</script>";
        if( ($usnombre != false && $uspass != false) || isset($_SESSION['usnombre']) ){
            
            //a buscar
            //$_SESSION['uspass'] = $uspass;
            $objUsuario = new Usuario();
            $arrBusUs = array('usnombre' => $usnombre, 'uspass' => $uspass);
            /* $arrBusUs['usnombre'] = $usnombre;
            $arrBusUs['uspass'] = $uspass; */
            $rta = $objUsuario->buscar($arrBusUs);
            // var_dump($rta);
            // die();
            if ($rta['respuesta']) {
                try {
                    $idusuario = $objUsuario->getIdusuario();
                } catch (\Throwable $th) {
                    $idusuario = 0;
                }
                if ($idusuario != NULL && $idusuario != 0) {
                    //esta bien
                    $_SESSION['idusuario'] = $idusuario;
                    $_SESSION['usnombre'] = $usnombre;
                    $retorno = true;
                } else {
                    $retorno = false;
                }
            }
        } else {
            
            $retorno = false;
        }
        return $retorno;
    }

    /**
     * Con el ID del usuario obtenemos su rol
     * @return array
     */
    public function obtenerRol() {
        $arrBusU['idusuario'] = $this->getIdusuario();
        $rta = Usuariorol::listar($arrBusU);
        if( array_key_exists('array', $rta) ){
            $roles = $rta['array'];
        } else {
            $roles = [];
        }
        return $roles;
    }

    public function listaRoles() {
        $roles = $this->obtenerRol();
        $rolesString = [];
        $rolesId = [];
        foreach ($roles as $key => $value) {
        }
    }

}