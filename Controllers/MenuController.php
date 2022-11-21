<?php
class MenuController extends MasterController {
    use Errores;

    public function listarTodo(){
        $arrayBus['medeshabilitado'] = NULL;
        $arrayTotal = Menu::listar($arrayBus);
        if(array_key_exists('array', $arrayTotal)){
            $array = $arrayTotal['array'];
        }else{
            $array = [];
        }
        return $array;
    }

    public function listar_menu_padre(){
        $idmenu = $this->buscarKey('idmenu');
        $array = Menu::darMenuesSinMenu($idmenu);
        return $array;
    }
}