<?php
require_once('../templates/header2.php');
$objUsuCon = new UsuarioController();
$objUsuRolCon = new UsuarioRolController();
$arrayRoles = $objUsuRolCon->getRoles();
try {
    $rol = $objSession->getUsRol();
    $rol = $objSession->getUsRol();
    if($rol != ''){
        if($rol == 'Admin'){
            $lista = $objConPro->listarTodo();
        }elseif($rol == 'Cliente' || $rol == 'Deposito'){
            $arrBuPro['usdeshabilitado'] = NULL;
            $idusuario = $objSession->getIdusuario();
            $arrBuPro['idusuario'] = $idusuario;
            $lista = $objConPro->listarTodo($arrBuPro);
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