<?php
class CompraitemController extends MasterController {
    use Errores;

    public function listarTodo(){
        $arrayBus['idcompraitem'] = NULL;
        $arrayTotal = Compraitem::listar($arrayBus);
        if(array_key_exists('array', $arrayTotal)){
            $array = $arrayTotal['array'];
        }else{
            $array = [];
        }
        return $array;
    }



}