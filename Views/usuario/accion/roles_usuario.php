<?php
require_once('../../../config.php');
$objUsuarioRolCon = new UsuarioRolController();
$rta = $objUsuarioRolCon->buscarRoles();
$arrayRoles = $objUsuarioRolCon->getRoles();
$rolesSimple = [];
foreach ($arrayRoles as $key => $value) {
    $data = $value->dameDatos();
    $rolesSimple[$data['idrol']] = false;
}
//var_dump($rolesSimple);
//convertir roles del usuario a texto
$rolesTexto = [];
//var_dump($rta);
if(count($rta) != 0){
    foreach ($rta as $key => $value) {
        $data = $value->dameDatos();
        //$idRol = $data['idrol'];
        //var_dump($idRol);
        $rolesTexto[$data['idrol']] = true;
    }
}
//var_dump($rolesTexto);
//var_dump($rolesSimple);
$arrayOtro = [];
if(count($rolesTexto) != 0){
    foreach ($rolesSimple as $id => $idrolArray) {
        if(array_key_exists($id, $rolesTexto)){
            $rolesSimple[$id] = true;
        }
    }
}
//responder como _easyui_checkbox2 en adelante
//var_dump($rolesSimple);


echo json_encode($rolesSimple);