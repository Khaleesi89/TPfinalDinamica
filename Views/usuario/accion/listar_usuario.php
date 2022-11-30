<?php
/* require_once('../templates/header2.php'); */
require_once( '../../../config.php' );
$objUsuarioController = new UsuarioController();
$objUsuarioRolController = new UsuarioRolController();
$objSession = new SessionController();

$arrayRoles = $objUsuarioRolController->getRoles();
try {
    $rol = $objSession->obtenerRol();
    if($rol != ''){
        if($rol == 'Admin'){
            $array = [];
            $lista = $objUsuarioRolController->listarTodo($array);
        }elseif($rol == 'Cliente' || $rol == 'Deposito'){
            $arrBuPro['usdeshabilitado'] = NULL;
            $idusuario = $objSession->getIdusuario();
            $arrBuPro['idusuario'] = $idusuario;
            $lista = $objUsuarioRolController->listarTodo($arrBuPro);
        }
    }else{
        $lista = [];
    }
} catch (\Throwable $th) {
    $lista = [];
}
$arreglo_salid = array();
foreach ($lista as $key => $value) {
    $nuevoElemen = $value->dameDatos();
    array_push($arreglo_salid, $nuevoElemen);
}
//var_dump($arreglo_salid);
echo json_encode($arreglo_salid);