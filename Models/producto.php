<?php

require_once('../config.php');

class Producto extends db
{
    use Condicion;
    private $idProducto;
    private $proNombre;
    private $proDetalle;
    private $proCantStock;
    private $mensajeOp;

    public function __construct()
    {
        $this->idProducto = '';
        $this->proNombre = '';
        $this->proDetalle = '';
        $this->proCantStock = '';
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

    public function getProDetalle()
    {
        return $this->proDetalle;
    }

    public function setProDetalle($proDetalle)
    {
        $this->proDetalle = $proDetalle;
    }

    public function getProCantStock()
    {
        return $this->proCantStock;
    }

    public function setProCantStock($proCantStock)
    {
        $this->proCantStock = $proCantStock;
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
    public function cargar($idProducto, $proDetalle, $proNombre, $proCantStock)
    {
        $this->setIdProducto($idProducto);
        $this->setProDetalle($proDetalle);
        $this->setProNombre($proNombre);
        $this->setProCantStock($proCantStock);
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
                        $this->setProDetalle($row2['prodetalle']);
                        $this->setProCantStock($row2['procantstock']);
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
        $sql = "INSERT INTO producto VALUES(DEFAULT, {$this->getProNombre()}', {$this->getProDetalle()}', {$this->getProCantStock()}')";
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
        $sql = "UPDATE producto SET pronombre = '{$this->getProNombre()}', prodetalle = '{$this->getProDetalle()}', procantStock = '{$this->getProCantStock()}'} WHERE idproducto = {$this->getIdProducto()}";
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
                        $proDetalle = $row2['prodetalle'];
                        $proNombre = $row2['pronombre'];
                        $proCantStock = $row2['procantstock'];
                        $producto = new Producto();
                        $producto->cargar($idProducto, $proDetalle, $proNombre, $proCantStock);
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
        $data['prodetalle'] = $this->getProDetalle();
        $data['procantstock'] = $this->getProCantStock();
        return $data;
    }
}
