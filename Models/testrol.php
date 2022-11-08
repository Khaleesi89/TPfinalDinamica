<?php

require_once('../config.php');
$rol = new Rol();

// Insertar FUNCA PAPA
/* $rol->cargar('', 'Admin');
$rta = $rol->insertar();
if( $rta['respuesta'] ){
    echo('Gut');
} else {
    var_dump( $rta );
} */

// Buscar FUNCA PAPAAAA
/* $array = [];
$rta = $rol->buscar( $array );
if( $rta['respuesta'] ){
    echo('gut');
} else {
    var_dump( $rta );
} */

// Modificar FUNCA PAPA
/* $arrayBusqueda = ['idrol' => 1];
$rol->buscar( $arrayBusqueda );
$rol->setRodescripcion( 'Cliente' );
$rta = $rol->modificar();
if( $rta['respuesta'] ){
    echo('Gut');
} else {
    var_dump( $rta );
} */

// Eliminar FUNCA PAPAAA
/* $arrayBusqueda = ['idrol' => 1];
$rol->buscar( $arrayBusqueda );
$rol->eliminar();
if( $rol ){
    echo('gut');
} else {
    var_dump( $rta );
} */

// Listar FUNCA PAAA
/* $arrayBusqueda = [];
$rta = $rol::listar( $arrayBusqueda );
var_dump( $rta['array'] ); */