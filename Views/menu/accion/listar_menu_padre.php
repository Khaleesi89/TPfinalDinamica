<?php
require_once('../../../config.php');
$objMenuCon =  new MenuController();
$array = $objMenuCon->listar_menu_padre();
echo json_encode($array);