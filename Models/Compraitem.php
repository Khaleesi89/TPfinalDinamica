<?php
class Compraitem extends db{	 
	use Condicion;
	//Atributos
	private $idcompraitem;
	private $objProducto;
	private $objCompra;
	private $cicantidad;
	private $mensajeOp;
	static $mensajeStatic;

	//Constructor
	public function __construct(){
		$this->idcompraitem = '';
		$this->objProducto = NULL;
		$this->objCompra = NULL;
		$this->cicantidad = '';
		$this->mensajeOp = '';
	}

	//Metodo cargar
	public function cargar( $objProducto, $objCompra, $cicantidad, $mensajeOp){
		//$this->idcompraitem = $idcompraitem;
		$this->objProducto = $objProducto;
		$this->objCompra = $objCompra;
		$this->cicantidad = $cicantidad;
		$this->mensajeOp = $mensajeOp;
	}

	//Getters y setters
	public function getIdcompraitem(){
		return $this->idcompraitem;
	}
	public function setIdcompraitem($idcompraitem){
		$this->idcompraitem = $idcompraitem;
	}
	public function getObjProducto(){
		return $this->objProducto;
	}
	public function setObjProducto($objProducto){
		$this->objProducto = $objProducto;
	}
	public function getObjCompra(){
		return $this->objCompra;
	}
	public function setObjCompra($objCompra){
		$this->objCompra = $objCompra;
	}
	public function getCicantidad(){
		return $this->cicantidad;
	}
	public function setCicantidad($cicantidad){
		$this->cicantidad = $cicantidad;
	}
	public function getMensajeOp(){
		return $this->mensajeOp;
	}
	public function setMensajeOp($mensajeOp){
		$this->mensajeOp = $mensajeOp;
	}
	public static function getMensajeStatic(){
		return Compraitem::$mensajeStatic;
	}
	public static function setMensajeStatic($mensajeStatic){
		Compraitem::$mensajeStatic = $mensajeStatic;
	}

	public function buscar($arrayBusqueda){
		//Seteo del array de busqueda, se deberan pasar como claves los campos de la db y como argumentos los parametros a buscar
		$stringBusqueda = $this->SB($arrayBusqueda);
		//Seteo de respuesta
		$respuesta['respuesta'] = false;
		$respuesta['errorInfo'] = '';
		$respuesta['codigoError'] = null;
		//Sql
		$sql = "SELECT * FROM compraitem";
		if($stringBusqueda != ''){
			$sql.= " WHERE $stringBusqueda";
		}
		$base = new db();
		try {
			if($base->Iniciar()){
				if($base->Ejecutar($sql)){
					if($row2 = $base->Registro()){
						
						$this->setIdcompraitem($row2['idcompraitem']);
						$id = $row2['idproducto'];
						$objProducto = new Producto();
						$arrayDeBusqueda['idproducto'] = $id;
						$objProducto->buscar($arrayDeBusqueda);
						$this->setObjProducto($objProducto);
						$id = $row2['idcompra'];
						$objCompra = new Compra();
						$arrayDeBusqueda['idcompra'] = $id;
						$objCompra->buscar($arrayDeBusqueda);
						$this->setObjCompra($objCompra);
						$this->setCicantidad($row2['cicantidad']);
						$respuesta['respuesta'] = true;
					}
				}else{
					$this->setMensajeOp($base->getError());
					$respuesta['respuesta'] = false;
					$respuesta['errorInfo'] = 'Hubo un error en la consulta';
					$respuesta['codigoError'] = 1;
				}
			}else{
				$this->setMensajeOp($base->getError());
				$respuesta['respuesta'] = false;
				$respuesta['errorInfo'] = 'Hubo un error con la conexion a la db';
				$respuesta['codigoError'] = 0;
			}
		} catch (\Throwable $th){
			$respuesta['respuesta'] = false;
			$respuesta['errorInfo'] = $th;
			$respuesta['codigoError'] = 3;
		}
		$base = null;
		return $respuesta;
	}

	public function insertar(){
        $respuesta['respuesta'] = false;
        $respuesta['errorInfo'] = '';
        $respuesta['codigoError'] = null;
        $base = new db();
		//obtencion de idproducto
		$objProducto = $this->getObjProducto();
		$idproducto = $objProducto->getIdproducto();
		$objProducto = null;
		//obtención de idcompra
		$objCompra = $this->getObjCompra();
		$idcompra = $objCompra->getIdcompra();
		$objCompra = null;
        $sql = "INSERT INTO compraestado VALUES(DEFAULT, $idproducto, $idcompra, {$this->getCicantidad()})";
        try {
            if($base->Iniciar()){
                if($base->Ejecutar($sql)){
                    $respuesta['respuesta'] = true;
                }else{
                    $this->setMensajeOp($base->getError());
                    $respuesta['respuesta'] = false;
                    $respuesta['errorInfo'] = 'Hubo un error con la consulta';
                    $respuesta['codigoError'] = 1; 
                }
            }else{
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

	public function modificar(){
        //seteo de respuesta
        $respuesta['respuesta'] = false;
        $respuesta['errorInfo'] = '';
        $respuesta['codigoError'] = null;
		//obtención de idproducto
		$objProducto = $this->getObjProducto();
		$idproducto = $objProducto->getIdproducto();
		$objProducto = null;
		//obtención de idcompra
		$objCompra = $this->getObjCompra();
		$idcompra = $objCompra->getIdcompra();
		$objCompra = null;
        $sql = "UPDATE compraestado SET idproducto = $idproducto, idcompra = $idcompra, cicantidad = {$this->getCicantidad()} WHERE idcompraitem = {$this->getIdcompraitem()}";
        $base = new db();
        try {
            if( $base->Iniciar() ){
                if( $base->Ejecutar($sql) ){
                    $respuesta['respuesta'] = true;
                } else {
                    $this->setMensajeOp( $base->getError() );
                    $respuesta['respuesta'] = false;
                    $respuesta['errorInfo'] = 'Hubo un error con la consulta';
                    $respuesta['codigoError'] = 1;
                }
            } else {
                $this->setMensajeOp( $base->getError() );
                $respuesta['respuesta'] = false;
                $respuesta['errorInfo'] = 'Hubo un error con la conexión de la base de datos';
                $respuesta['codigoError'] = 0;
            }
        } catch( \Throwable $th ){
            $respuesta['respuesta'] = false;
            $respuesta['errorInfo'] = $th;
            $respuesta['codigoError'] = 3;
        }
        $base = null;
        return $respuesta;
    }

	//Usar el buscar antes del eliminar
    //Eliminado fisico
    public function eliminar(){
        //seteo de respuesta
        $respuesta['respuesta'] = false;
        $respuesta['errorInfo'] = '';
        $respuesta['codigoError'] = null;
        //obtener fecha
        $sql = "DELETE FROM compraitem WHERE idcompraitem = {$this->getIdcompraitem()}";
        $base = new db();
        try {
            if($base->Iniciar()){
                if($base->Ejecutar($sql)){
                    $respuesta['respuesta'] = true;
                }else{
                    $this->setMensajeOp($base->getError());
                    $respuesta['respuesta'] = false;
                    $respuesta['errorInfo'] = 'Hubo un error con la consulta';
                    $respuesta['codigoError'] = 1;
                }
            }else{
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

	public static function listar($arrayBusqueda){
        //seteo de respuesta
        $respuesta['respuesta'] = false;
        $respuesta['errorInfo'] = '';
        $respuesta['codigoError'] = null;
        $arregloCompraitem = null;
        $base = new db();
        //seteo de busqueda//ARREGLAR EL CONDICION
        $stringBusqueda = Compraestado::SBS($arrayBusqueda);
        $sql = "SELECT * FROM compraestado";
        if($stringBusqueda != ''){
            $sql.= ' WHERE ';
            $sql.= $stringBusqueda;
        }
        try {
            if($base->Iniciar()){
                if($base->Ejecutar($sql)){
                    $arregloCompraitem = array();
                    while($row2 = $base->Registro()){
                        $objCompraitem = new Compraitem();
						$objCompraitem->setIdcompraitem($row2['idcompraitem']);
						//generar objeto producto
						$objProducto = new Producto();
						$arrayBus = [];
						$arrayBus['idproducto'] = $row2['idproducto'];
						$objProducto->buscar($arrayBus);
						$objCompraitem->setObjProducto($objProducto);
						$objProducto = null;
						//generar objeto compra
						$objCompra = new Compra();
						$arrayBus = [];
						$arrayBus['idcompra'] = $row2['idcompra'];
						$objCompra->buscar($arrayBus);
						$objCompraitem->setObjCompra($objCompra);
						$objCompra = null;
						$objCompraitem->setCicantidad($row2['cicantidad']);

                        array_push($arregloCompraitem, $objCompraitem);
                    }
                    $respuesta['respuesta'] = true;
                }else{
                    Usuario::setMensajeStatic($base->getError());
                    $respuesta['respuesta'] = false;
                    $respuesta['errorInfo'] = 'Hubo un error con la consulta';
                    $respuesta['codigoError'] = 1;
                }
            }else{
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
        if($respuesta['respuesta']){
            $respuesta['array'] = $arregloCompraitem;
        }
        return $respuesta;
    }
}