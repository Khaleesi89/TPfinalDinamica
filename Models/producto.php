<?php

require_once('../config.php');

class Producto extends db
{
    use Condicion;
    private $idProducto;
    private $proNombre;
    private $sinopsis;
    private $proCantStock;
    private $autor;
    private $precio;
    private $isbn;
    private $mensajeOp;

    public function __construct()
    {
        $this->idProducto = '';
        $this->proNombre = '';
        $this->sinopsis = '';
        $this->proCantStock = '';
        $this->autor = '';
        $this->precio = '';
        $this->isbn = '';
        $this->mensajeOp = '';
    }

    public function getIdProducto()
    {
        return $this->idProducto;
    }

    public function setIdProducto($idProducto)
    {
        $this->idProducto = $idProducto;
    }

    public function getProNombre()
    {
        return $this->proNombre;
    }

    public function setProNombre($proNombre)
    {
        $this->proNombre = $proNombre;
    }

    public function getSinopsis()
    {
        return $this->sinopsis;
    }

    public function setSinopsis($sinopsis)
    {
        $this->sinopsis = $sinopsis;
    }

    public function getProCantStock()
    {
        return $this->proCantStock;
    }

    public function setProCantStock($proCantStock)
    {
        $this->proCantStock = $proCantStock;
    }

    public function getAutor(){
        return $this->autor;
    }

    public function setAutor($autor){
        $this->autor = $autor;
    }

    public function getPrecio(){
        return $this->precio;
    }

    public function setPrecio($precio){
        $this->precio = $precio;
    }

    public function getIsbn(){
        return $this->isbn;
    }

    public function setIsbn($isbn){
        $this->isbn = $isbn;
    }

    public function getMensajeOp()
    {
        return $this->mensajeOp;
    }

    public function setMensajeOp($mensajeOp)
    {
        $this->mensajeOp = $mensajeOp;
    }

    // Cargar
    public function cargar( $sinopsis, $proNombre, $proCantStock, $autor, $precio, $isbn)
    {
        //$this->setIdProducto($idProducto);
        $this->setSinopsis($sinopsis);
        $this->setProNombre($proNombre);
        $this->setProCantStock($proCantStock);
        $this->setAutor($autor);
        $this->setPrecio($precio);
        $this->setIsbn($isbn);
    }

    //En el busqueda agregar de buscar siempre con deleted en null
    public function buscar($arrayBusqueda)
    {
        $stringBusqueda = $this->SB($arrayBusqueda);
        //seteo de respuesta
        $respuesta['respuesta'] = false;
        $respuesta['errorInfo'] = '';
        $respuesta['codigoError'] = null;
        //busqueda en si
        $sql = "SELECT * FROM producto";
        if ($stringBusqueda != '') {
            $sql .= ' WHERE ';
            $sql .= $stringBusqueda;
        }
        $base = new db();
        try {
            if ($base->Iniciar()) {
                if ($base->Ejecutar($sql)) {
                    if ($row2 = $base->Registro()) {
                        $this->setIdProducto($row2['idproducto']);
                        $this->setProNombre($row2['pronombre']);
                        $this->setSinopsis($row2['sinopsis']);
                        $this->setProCantStock($row2['procantstock']);
                        $this->setAutor($row2['autor']);
                        $this->setPrecio($row2['precio']);
                        $this->setIsbn($row2['isbn']);
                        $respuesta['respuesta'] = true;
                    }
                } else {
                    $this->setMensajeOp($base->getError());
                    $respuesta['respuesta'] = false;
                    $respuesta['errorInfo'] = 'Hubo un error con la consulta';
                    $respuesta['codigoError'] = 1;
                }
            } else {
                $this->setMensajeOp($base->getError());
                $respuesta['respuesta'] = false;
                $respuesta['errorInfo'] = 'Hubo un error con la conexión de la base de datos';
                $respuesta['codigoError'] = 0;
            }
        } catch (\Throwable $th) {
            $respuesta['respuesta'] = false;
            $respuesta['errorInfo'] = $th;
            $respuesta['codigoError'] = 3;
        }
        $base = null;
        return $respuesta;
    }

    public function insertar()
    {
        $respuesta['respuesta'] = false;
        $respuesta['errorInfo'] = '';
        $respuesta['codigoError'] = null;
        $base = new db();
        $sql = "INSERT INTO producto VALUES(DEFAULT, {$this->getProNombre()}', {$this->getSinopsis()}', {$this->getProCantStock()},{$this->getAutor()}, {$this->getPrecio()},{$this->getIsbn()}')";
        try {
            if ($base->Iniciar()) {
                if ($base->Ejecutar($sql)) {
                    $respuesta['respuesta'] = true;
                } else {
                    $this->setMensajeOp($base->getError());
                    $respuesta['respuesta'] = false;
                    $respuesta['errorInfo'] = 'Hubo un error con la consulta';
                    $respuesta['codigoError'] = 1;
                }
            } else {
                $this->setMensajeOp($base->getError());
                $respuesta['respuesta'] = false;
                $respuesta['errorInfo'] = 'Hubo un error con la conexión de la base de datos';
                $respuesta['codigoError'] = 0;
            }
        } catch (\Throwable $th) {
            $respuesta['respuesta'] = false;
            $respuesta['errorInfo'] = $th;
            $respuesta['codigoError'] = 3;
        }
        $base = null;
        return $respuesta;
    }

    //Antes de usar el modificar se debe utilizar el buscar.
    //En el controlador fijarse si no hay un usuario con el mismo nombre
    //En el controlador fijarse si hay un id de rol 
    public function modificar()
    {
        //seteo de respuesta
        $respuesta['respuesta'] = false;
        $respuesta['errorInfo'] = '';
        $respuesta['codigoError'] = null;
        $base = new db();
        $sql = "UPDATE producto SET pronombre = '{$this->getProNombre()}', sinopsis = '{$this->getSinopsis()}', procantStock = '{$this->getProCantStock()}', autor = '{$this->getAutor()}', precio = '{$this->getPrecio()}', isbn = '{$this->getIsbn()}'} WHERE idproducto = {$this->getIdProducto()}";
        try {
            if ($base->Iniciar()) {
                if ($base->Ejecutar($sql)) {
                    $respuesta['respuesta'] = true;
                } else {
                    $this->setMensajeOp($base->getError());
                    $respuesta['respuesta'] = false;
                    $respuesta['errorInfo'] = 'Hubo un error con la consulta';
                    $respuesta['codigoError'] = 1;
                }
            } else {
                $this->setMensajeOp($base->getError());
                $respuesta['respuesta'] = false;
                $respuesta['errorInfo'] = 'Hubo un error con la conexión de la base de datos';
                $respuesta['codigoError'] = 0;
            }
        } catch (\Throwable $th) {
            $respuesta['respuesta'] = false;
            $respuesta['errorInfo'] = $th;
            $respuesta['codigoError'] = 3;
        }
        $base = null;
        return $respuesta;
    }

    //Usar el buscar antes del eliminar
    public function eliminar()
    {
        //seteo de respuesta
        $respuesta['respuesta'] = false;
        $respuesta['errorInfo'] = '';
        $respuesta['codigoError'] = null;
        $base = new db();
        //obtener fecha actual
        $fecha = getdate();
        $fechaPosta = $fecha['mday'] . ':' . $fecha['mon'] . ':' . $fecha['year'];
        $sql = "UPDATE producto SET procantstock = '0' WHERE id = {$this->getIdProducto()}";
        try {
            if ($base->Iniciar()) {
                if ($base->Ejecutar($sql)) {
                    $respuesta['respuesta'] = true;
                } else {
                    $this->setMensajeOp($base->getError());
                    $respuesta['respuesta'] = false;
                    $respuesta['errorInfo'] = 'Hubo un error con la consulta';
                    $respuesta['codigoError'] = 1;
                }
            } else {
                $this->setMensajeOp($base->getError());
                $respuesta['respuesta'] = false;
                $respuesta['errorInfo'] = 'Hubo un error con la conexión de la base de datos';
                $respuesta['codigoError'] = 0;
            }
        } catch (\Throwable $th) {
            $respuesta['respuesta'] = false;
            $respuesta['errorInfo'] = $th;
            $respuesta['codigoError'] = 3;
        }
        $base = null;
        return $respuesta;
    }

    public static function listar($arrayBusqueda)
    {
        //seteo de respuesta
        $respuesta['respuesta'] = false;
        $respuesta['errorInfo'] = '';
        $respuesta['codigoError'] = null;
        $arregloUsuario = null;
        $base = new db();
        //seteo de busqueda
        $stringBusqueda = Producto::SBS($arrayBusqueda);
        $sql = "SELECT * FROM producto";
        if ($stringBusqueda != '') {
            $sql .= ' WHERE ';
            $sql .= $stringBusqueda;
        }
        try {
            if ($base->Iniciar()) {
                if ($base->Ejecutar($sql)) {
                    $arregloProducto = array();
                    while ($row2 = $base->Registro()) {
                        $idProducto = $row2['idproducto'];
                        $sinopsis = $row2['sinopsis'];
                        $proNombre = $row2['pronombre'];
                        $proCantStock = $row2['procantstock'];
                        $autor = $row2['autor'];
                        $precio = $row2['precio'];
                        $isbn = $row2['isbn'];
                        $producto = new Producto();
                        $producto->cargar($idProducto, $sinopsis, $proNombre, $proCantStock, $autor, $precio, $isbn);
                        array_push($arregloProducto, $producto);
                    }
                    $respuesta['respuesta'] = true;
                } else {
                    Usuario::setMensajeStatic($base->getError());
                    $respuesta['respuesta'] = false;
                    $respuesta['errorInfo'] = 'Hubo un error con la consulta';
                    $respuesta['codigoError'] = 1;
                }
            } else {
                Usuario::setMensajeStatic($base->getError());
                $respuesta['respuesta'] = false;
                $respuesta['errorInfo'] = 'Hubo un error con la conexión de la base de datos';
                $respuesta['codigoError'] = 0;
            }
        } catch (\Throwable $th) {
            $respuesta['respuesta'] = false;
            $respuesta['errorInfo'] = $th;
            $respuesta['codigoError'] = 3;
        }
        $base = null;
        if ($respuesta['respuesta']) {
            $respuesta['array'] = $arregloProducto;
        }
        return $respuesta;
    }

    public function dameDatos()
    {
        $data = [];
        $data['idproducto'] = $this->getIdProducto();
        $data['pronombre'] = $this->getProNombre();
        $data['sinopsis'] = $this->getSinopsis();
        $data['procantstock'] = $this->getProCantStock();
        $data['autor'] = $this->getAutor();
        $data['precio'] = $this->getPrecio();
        $data['isbn'] = $this->getIsbn();
        return $data;
    }

}
