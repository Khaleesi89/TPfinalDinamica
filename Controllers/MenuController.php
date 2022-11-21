<?php
class MenuController extends MasterController {
    use Errores;

    public function listarTodo(){
        $arrayBus['medeshabilitado'] = NULL;
        $arrayTotal = Menu::listar($arrayBus);
        $array = $arrayTotal['array'];
        return $array;
    }
}