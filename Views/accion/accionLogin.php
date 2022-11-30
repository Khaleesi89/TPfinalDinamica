<?php
//require_once( '../templates/header.php');
require_once('../../config.php');

$objUsuarioCon = new UsuarioController;
$gola = $objUsuarioCon->buscarObjUsuario2();


/* $objSession = new SessionController();

$usnombre = $objSession->buscarKey('usnombre');
$uspass = $objSession->buscarKey('uspass');

$rta = $objSession->validarCredenciales();
if( $rta == false ){
    echo "<script>console.log('no son validas');</script>";
    $url = $PRINCIPAL;
} else {
    $url = $PRODUCTOS;
    echo "<script>console.log('si son validas');</script>";
} */

if($gola['rta']){
    $objSession = new SessionController();
    $valido = $objSession->validarCredenciales();
    if($valido){
        $url = $PRODUCTOS;
    }
}else{
    $url = $PRINCIPAL;
}

header($url);
/* if(!$objSession->existenCredenciales()){
    echo "<script>console.log('no vinieron por post');</script>";
    $url = $PRINCIPAL;
    //header($PRINCIPAL);
}else{
    echo "<script>console.log('$usnombre, $uspass');</script>";
    $objUsuario = new Usuario();
    $arrB['usnombre'] = $usnombre;
    $arrB['uspass'] = $uspass;
    $rta = $objUsuario->buscar($arrB);
    if($rta['respuesta']){
        $idusuario = $objUsuario->getIdusuario();
        echo "<script>console.log('$idusuario');</script>";
    }
    if(!$objSession->validarCredenciales()){
        echo "<script>console.log('si vinieieron');</script>";
        $url = $PRODUCTOS;
        
    }
    echo "<script>console.log('no valido');</script>";
    $url = $PRINCIPAL;
    //header("Location:$ROOT/Views/producto/producto_list.php");
} */
//header($url);
die();