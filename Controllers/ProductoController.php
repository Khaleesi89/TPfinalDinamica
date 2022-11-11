<?php
class ProductoController extends MasterController{
    use Errores;

    public function busqueda(){
        $arrayBusqueda = [];
        $idproducto = $this->buscarKey('idproducto');
        $pronombre = $this->buscarKey('pronombre');
        $sinopsis = $this->buscarKey('sinopsis');
        $procantstock = $this->buscarKey('procantstock');
        $autor = $this->buscarKey('autor');
        $precio = $this->buscarKey('precio');
        $isbn = $this->buscarKey('isbn');
        $categoria = $this->buscarKey('categoria');
        $prdeshabilitado = $this->buscarKey('prdeshabilitado');
        $arrayBusqueda = ['idproducto' => $idproducto,
                          'pronombre' => $pronombre,
                          'sinopsis' => $sinopsis,
                          'procantstock' => $procantstock,
                          'autor' => $autor,
                          'precio' => $precio,
                          'isbn' => $isbn,
                          'categoria' => $categoria,
                          'prdeshabilitado' => $prdeshabilitado];
        return $arrayBusqueda;
    }

    public function listarTodo(){
        $arrayBusqueda = $this->busqueda();
        $arrayTotal = Producto::listar($arrayBusqueda);
        return $arrayTotal;        
    }

    public function buscarId(){
        $respuesta['respuesta'] = false;
        $respuesta['obj'] = null;
        $respuesta['error'] = '';
        $arrayBusqueda = [];
        $arrayBusqueda['idproducto'] = $this->buscarKey('idproducto');
        $objProducto = new Producto();
        $rta = $objProducto->buscar($arrayBusqueda);
        if($rta['respuesta']){
            $respuesta['respuesta'] = true;
            $respuesta['obj'] = $objProducto;
        }else{
            $respuesta['error'] = $rta;
        }
        return $respuesta;        
    }

    public function modificar(){
        $rta = $this->buscarId();
        if($rta['respuesta']){
            //puedo modificar con los valores
            $valores = $this->busqueda();
            $objProducto = $rta['obj'];
            $objProducto->cargar($valores['sinopsis'], $valores['pronombre'], $valores['procantstock'], $valores['autor'], $valores['precio'], $valores['isbn']);
            $rsta = $objProducto->modificar();
            if($rsta['respuesta']){
                //todo gut
            }
        }else{
            //no encontro el obj

        }
    }
}