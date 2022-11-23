<?php
class MenuController extends MasterController {
    use Errores;

    public function listarTodo($arralgo = NULL){
        if($arralgo == NULL){
            $arrBu = [];
        }else{
            $arrBu = $arralgo;
        }
        //$arrayBus['medeshabilitado'] = NULL;
        $arrayTotal = Menu::listar($arrBu);
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

    public function busqueda(){
        $arrayBusqueda = [];
        $idmenu = $this->buscarKey('idmenu');
        $menombre = $this->buscarKey('menombre');
        $medescripcion = $this->buscarKey('medescripcion');
        $idpadre = $this->buscarKey('idpadre');
        $medeshabilitado = $this->buscarKey('medeshabilitado');
        $arrayBusqueda = ['idmenu' => $idmenu,
                          'menombre' => $menombre,
                          'medescripcion' => $medescripcion,
                          'idpadre' => $idpadre,
                          'medeshabilitado' => $medeshabilitado];
        //var_dump($arrayBusqueda);
        return $arrayBusqueda;
    }

    public function insertar(){
        $data = $this->busqueda();
        $objMenu = new Menu();
        $objMenu->setIdmenu(NULL);
        $objMenu->setMenombre($data['menombre']);
        $objMenu->setMedescripcion($data['medescripcion']);
        $objPadre = new Menu();
        $arrayBus['idmenu'] = $data['idpadre'];
        $objPadre->buscar($arrayBus);
        $objMenu->setObjPadre($objPadre);
        $objMenu->setMedeshabilitado(NULL);
        //var_dump($objMenu);
        $rta = $objMenu->insertar();
        //var_dump($rta);
        return $rta;
    }

    public function modificar(){
        $rta = $this->buscarId();
        $response = false;
        if($rta['respuesta']){
            //puedo modificar con los valores
            $valores = $this->busqueda();
            $objMenu = $rta['obj'];
            $objMenu->cargar($valores['menombre'], $valores['medescripcion'], $valores['idpadre']);
            $rsta = $objMenu->modificar();
            if($rsta['respuesta']){
                //todo gut
                $response = true;
            }
        }
        return $response;
    }

    public function buscarId(){
        $respuesta['respuesta'] = false;
        $respuesta['obj'] = null;
        $respuesta['error'] = '';
        $arrayBusqueda = [];
        $arrayBusqueda['idmenu'] = $this->buscarKey('idmenu');
        $objMenu = new Menu();
        $rta = $objMenu->buscar($arrayBusqueda);
        if($rta['respuesta']){
            $respuesta['respuesta'] = true;
            $respuesta['obj'] = $objMenu;
        }else{
            $respuesta['error'] = $rta;
        }
        return $respuesta;        
    }

    public function eliminar(){
        $rta = $this->buscarId();
        $response = false;
        if($rta['respuesta']){
            $objMenu = $rta['obj'];
            $respEliminar = $objMenu->eliminar();
            if($respEliminar['respuesta']){
                $response = true;
            }
        }else{
            //no encontro el obj
            $response = false;
        }
        return $response;
    }

    public function Noeliminar(){
        $rta = $this->buscarId();
        $response = false;
        if($rta['respuesta']){
            $objMenu = $rta['obj'];
            $respEliminar = $objMenu->Noeliminar();
            if($respEliminar['respuesta']){
                $response = true;
            }
        }else{
            //no encontro el obj
            $response = false;
        }
        return $response;
    }

    public function getRoles(){
        $arrayBus = [];
        $listaRoles = Rol::listar($arrayBus);
        return $listaRoles['array'];
    }

    public function obtenerMenuesPorRol($idrol){
        $arrayBu['idrol'] = $idrol;
        $arrayMenues = Menurol::listar($arrayBu);
        //var_dump($arrayMenues['array']);
        //convertir y traer todos los menues
        if(array_key_exists('array', $arrayMenues)){
            $arrayRta = [];
            $arrayRta['Home'] = [];
            foreach ($arrayMenues['array'] as $key => $value) {
                $objMenu = $value->getObjMenu();
                $PadreObj = $objMenu->getObjPadre();
                if($PadreObj == NULL || $PadreObj->getIdmenu() == 0){
                    $nombreMenu = $objMenu->getMenombre();
                    //var_dump($objMenu);
                    array_push($arrayRta['Home'], $nombreMenu);
                }    
            }
            //var_dump($arrayRta);

            //obtener el ordenamiento de los que tienen padre 
            foreach ($arrayMenues['array'] as $key => $value) {
                $objMenu = $value->getObjMenu();
                $idPadre = $objMenu->getIdpadre();
                //var_dump($idPadre);
                if($idPadre != 0){
                    $objPadre = $objMenu->getObjPadre();
                    $nombrePadre = $objPadre->getMenombre();
                    $nombreMenu = $objMenu->getMenombre();
                    if(array_key_exists($nombrePadre, $arrayRta['Home']) && $nombrePadre != 'Home'){
                        if(!array_key_exists($nombreMenu, $arrayRta['Home'][$nombrePadre])){
                            array_push($arrayRta['Home'][$nombrePadre], $nombreMenu);
                        }
                    }
                }
                
            }

            /* foreach ($arrayMenues['array'] as $key => $value) {
                $objMenu = $value->getObjMenu();
                $PadreObj = $objMenu->getObjPadre();
                /* var_dump($PadreObj);
                echo ($PadreObj != '');
                if($PadreObj != null){ */
                    //var_dump($PadreObj);
                    //if($PadreObj != null || $PadreObj->getIdmenu() != 0){
                        /* try {
                            $idPadre = $PadreObj->getIdmenu();
                            $nombrePadre = $PadreObj->getMenombre();
                        } catch (\Throwable $th) {
                            $idPadre = 0;
                            $nombrePadre = 'Home';
                        }
                        //$idpadre['idmenu'] = $idPadre;
                        $nombremenu = $objMenu->getMenombre();
                        if(array_key_exists($nombrePadre, $arrayRta)){
                            $arr = [];
                            $arr[$nombremenu] = true;
                            array_push($arrayRta[$nombrePadre], $arr);
                        } */ 
                    //}
                //}
                   
                    
        }else{
            $arrayRta = [];
        }
        return $arrayRta;
    }
}