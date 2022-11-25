<?php
require_once('../../../config.php');
$objConPro = new ProductoController();
$rol = $objSession->getUsRol();
if($rol != ''){
    if($rol == 'Admin' || $rol == 'Deposito'){
        $lista = $objConPro->listarTodo();
    }elseif($rol == 'Cliente'){
        $arrBuPro['prdeshabilitado'] = NULL;
        $lista = $objConPro->listarTodo($arrBuPro);
    }
    $arreglo_salid = array();
    foreach ($lista as $key => $value) {
            if($value->getPrdeshabilitado() == NULL){
                $nuevoElemen = $value->dameDatos();
                array_push($arreglo_salid, $nuevoElemen);    
            }
    }
    //var_dump($arreglo_salid);
    echo json_encode($arreglo_salid);
}else{
    header($PRINCIPAL);
}
