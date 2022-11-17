<?php
require_once('../config.php');


$objCompraitem = new Compraitem();
$objProducto = new Producto();
$objCompra = new Compra();
$busc1 = [];
$busc1['idproducto'] = 1;
$prodBusc = $objProducto->buscar($busc1);
$busc2 = [];
$busc2['idcompra'] = 6;
$comprBusc = $objCompra->buscar($busc2);


/*//cargar FUNCIONA

$objCompraitem->cargar($objProducto,$objCompra,3);
//var_dump($objCompraitem);

//insertar FUNCIONA
$rta = $objCompraitem->insertar();
if($rta){
    echo "se pudo";
}else{
    echo "jodete ";
}
*/
//buscar

$busc3 = [];
$busc3['idcompraitem'] = 1;
$buscado = $objCompraitem->buscar($busc3);
echo "<pre>";
var_dump($objCompraitem);
echo "</pre>";


//modificar



//eliminar