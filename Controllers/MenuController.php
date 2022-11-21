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

    public function getRoles(){
        $arrayBus = [];
        $listaRoles = Rol::listar($arrayBus);
        return $listaRoles['array'];
    }
}