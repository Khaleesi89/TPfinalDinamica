<?php
class Compraestado extends db{	 
	use Condicion;
	//Atributos
	private $idcompraestado;
	private $objCompra;
	private $objCompraestadotipo;
	private $cefechaini;
	private $cefechafin;
	private $mensajeOp;
	static $mensajeStatic;

	//Constructor
	public function __construct(){
		$this->idcompraestado = '';
		$this->objCompra = NULL;
		$this->objCompraestadotipo = NULL;
		$this->cefechaini = '';
		$this->cefechafin = '';
		$this->mensajeOp = '';
	}

	//Metodo cargar
	public function cargar( $objCompra, $objCompraestadotipo, $cefechaini, $cefechafin, $mensajeOp){
		//$this->idcompraestado = $idcompraestado;
		$this->objCompra = $objCompra;
		$this->objCompraestadotipo = $objCompraestadotipo;
		$this->cefechaini = $cefechaini;
		$this->cefechafin = $cefechafin;
		$this->mensajeOp = $mensajeOp;
	}

	//Getters y setters
	public function getIdcompraestado(){
		return $this->idcompraestado;
	}
	public function setIdcompraestado($idcompraestado){
		$this->idcompraestado = $idcompraestado;
	}
	public function getObjCompra(){
		return $this->objCompra;
	}
	public function setObjCompra($objCompra){
		$this->objCompra = $objCompra;
	}
	public function getObjCompraestadotipo(){
		return $this->objCompraestadotipo;
	}
	public function setObjCompraestadotipo($objCompraestadotipo){
		$this->objCompraestadotipo = $objCompraestadotipo;
	}
	public function getCefechaini(){
		return $this->cefechaini;
	}
	public function setCefechaini($cefechaini){
		$this->cefechaini = $cefechaini;
	}
	public function getCefechafin(){
		return $this->cefechafin;
	}
	public function setCefechafin($cefechafin){
		$this->cefechafin = $cefechafin;
	}
	public function getMensajeOp(){
		return $this->mensajeOp;
	}
	public function setMensajeOp($mensajeOp){
		$this->mensajeOp = $mensajeOp;
	}
	public static function getMensajeStatic(){
		return Compraestado::$mensajeStatic;
	}
	public static function setMensajeStatic($mensajeStatic){
		Compraestado::$mensajeStatic = $mensajeStatic;
	}

	public function buscar($arrayBusqueda){
		//Seteo del array de busqueda, se deberan pasar como claves los campos de la db y como argumentos los parametros a buscar
		$stringBusqueda = $this->SB($arrayBusqueda);
		//Seteo de respuesta
		$respuesta['respuesta'] = false;
		$respuesta['errorInfo'] = '';
		$respuesta['codigoError'] = null;
		//Sql
		$sql = "SELECT * FROM compraestado";
		if($stringBusqueda != ''){
			$sql.= " WHERE $stringBusqueda";
		}
		$base = new db();
		try {
			if($base->Iniciar()){
				if($base->Ejecutar($sql)){
					if($row2 = $base->Registro()){
						//MODIFICARRRRRRRRR
						$this->setIdcompraestado($row2['idcompraestado']);
						$id = $row2['idcompra'];
						$objCompra = new Compra();
						$arrayDeBusqueda['idcompra'] = $id;
						$objCompra->buscar($arrayDeBusqueda);
						$this->setObjCompra($objCompra);
						$id = $row2['idcompraestadotipo'];
						$objCompraestadotipo = new Compraestadotipo();
						$arrayDeBusqueda['idcompraestadotipo'] = $id;
						$objCompraestadotipo->buscar($arrayDeBusqueda);
						$this->setObjCompraestadotipo($objCompraestadotipo);
						$this->setCefechaini($row2['cefechaini']);
						$this->setCefechafin($row2['cefechafin']);
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
		//obtención de idcompra
		$objCompra = $this->getObjCompra();
		$idcompra = $objCompra->getIdcompra();
		$objCompra = null;
		//obtencion de idcompraestadotipo
		$objCompraestadotipo = $this->getObjCompraestadotipo();
		$idcompraestadotipo = $objCompraestadotipo->getIdcompraestadotipo();
		$objCompraestadotipo = null;
        $sql = "INSERT INTO compraestado VALUES(DEFAULT, $idcompra, $idcompraestadotipo, '{$this->getCefechaini()}', '{$this->getCefechafin()}')";
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
		//obtención de idcompra
		$objCompra = $this->getObjCompra();
		$idcompra = $objCompra->getIdcompra();
		$objCompra = null;
		//obtencion de idcompraestadotipo
		$objCompraestadotipo = $this->getObjCompraestadotipo();
		$idcompraestadotipo = $objCompraestadotipo->getIdcompraestadotipo();
		$objCompraestadotipo = null;
        $sql = "UPDATE compraestado SET idcompra = $idcompra, idcompraestadotipo = $idcompraestadotipo, cefechaini = '{$this->getCefechaini()}', cefechafin = '{$this->getCefechafin()}' WHERE idcompraestado = {$this->getIdcompraestado()}";
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
        $sql = "DELETE FROM compraestrado WHERE idcompraestado = {$this->getIdcompraestado()}";
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
        $arregloCompraestado = null;
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
                    $arregloCompraestado = array();
                    while($row2 = $base->Registro()){
                        $objMenu = new Menu();
                        $objMenu->setIdmenu($row2['idmenu']);
                        $objMenu->setMenombre($row2['menombre']);
                        $objMenu->setMedescripcion($row2['medescripcion']);
                        $objMenuPadre = new Menu();
                        $idPadre = $row2['idpadre'];
                        if($idPadre == 0 || $idPadre == null){
                            $objMenuPadre = null;
                        }else{
                            $arrayPadre['idmenu'] = $idPadre;
                            $objMenuPadre->buscar($arrayPadre);
                        }
                        $objMenu->setObjPadre($objMenuPadre);
                        $objMenu->setMedeshabilitado($row2['medeshabilitado']);
                        array_push($arregloCompraestado, $objMenu);
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
            $respuesta['array'] = $arregloCompraestado;
        }
        return $respuesta;
    }
}