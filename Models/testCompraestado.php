<?php
require_once('../config.php');

$objCompra = new Compra();
$objUsuario = new Usuario();
$objCompraEstadoTipo = new Compraestadotipo();
$objCompraEstadoTipo->cargar("vamos", "que podemos");
$objCompraEstadoTipo->insertar();//funca bien hasta aca
$compraestado = new Compraestado();
$found = [];
$found['idusuario'] = 2;
$founds = [];
$founds['idcompra'] = 8;
$camp = $objUsuario->buscar($found);
//var_dump($objUsuario);
$camps = $objCompra->buscar($founds);
//var_dump($objCompra);
//die();
$foundSS = [];
$foundSS['idcompraestadotipo'] = 2;
$objCompraEstadoTipo->buscar($foundSS);
//var_dump($objCompraEstadoTipo);
//die();

/*//cargar FUNCIONA

$compraestado->cargar($objCompra,$objCompraEstadoTipo);
//var_dump($compraestado);
//die();

*//*//insertar FUNCA

$sepudo = $compraestado->insertar();
//var_dump($compraestado);
//die();
if($sepudo){
    echo "funco";
}else{
    echo "segui participando mamerto/a";
}*/


//modificar



//eliminar



//buscar

$busq = [];
$busq['idcompraestado'] = 4;
$info = $compraestado->buscar($busq);
if($info){
    echo "se encontro";
    var_dump($compraestado);
}else{
    echo "perdido";
}

//listar


//dameDatos