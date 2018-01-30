<?php
require_once './php/Domain/Factura.php';
require_once './php/Domain/LineaFactura.php';
require_once './php/Exception/DAOException.php';

class LineaFacturaDAO{

	private $con;

	public function __construct($con){
		$this->con=$con;
	}

	function insertarLineaFactura($linea_facturas){
		$query="INSERT INTO linea_facturas(`NUM_FACT`, `NUM_LINEA`, `DESCRIPCION`, `CANTIDAD`, `PRECIO`) VALUES (?,?,?,?,?)";

		$num_fact=$linea_facturas->getFactura();
		$num_linea=$linea_facturas->getNum_linea();
		$descripcion=$linea_facturas->getDescripcion();
		$cantidad=$linea_facturas->getCantidad();
		$precio=$linea_facturas->getPrecio();

		$stmt = $this->con->stmt_init();
		$stmt->prepare($query);
		$stmt->bind_param("sssdd",$num_fact,$num_linea,$descripcion,$cantidad,$precio);

		$stmt->execute();

		if ($this->con->errno==1062)
			throw new DAOException("EL Nº de linea en la Factura ya existe");
	}


	public function borrarLineasFacturaPorFactura($factura){
		$query = "DELETE FROM LINEA_FACTURAS WHERE NUM_FACT=?";
			
		$num_fact=$factura->getNum_fact();
		$stmt = $this->con->prepare($query);
		$stmt->bind_param("s",$num_fact);
		$stmt->execute();
		
		if (!isset($this->con->errno)) {
			throw new DAOException("No se ha podido borrar las lineas de factura, intentelo de nuevo mas tarde.");		
		}
	}

	public function recuperarLineaFacturaPorFactura($factura){
		$sql = "SELECT NUM_FACT,NUM_LINEA,DESCRIPCION,CANTIDAD,PRECIO FROM linea_facturas WHERE NUM_FACT=?";	
		
		$stmt = $this->con->stmt_init();
		$stmt->prepare($sql);

		$num_fact=$factura->getNum_fact();
		$stmt->bind_param('s',$num_fact);
		$stmt->execute();
		$stmt->bind_result($num_fact,$num_linea,$descripcion,$cantidad,$precio);

		$linea_facturas= array();
		while ($stmt->fetch()){
			$factura=new Factura();
			$factura->setNum_Fact($num_fact);
			array_push($linea_facturas,LineaFactura::crearLinea_factura($factura,$num_linea,$descripcion,$cantidad,$precio));
		}
		$stmt->close();

		if (!isset($this->con->errno)) 
			throw new DAOException("Error interno, vuelve a intentarlo mas tarde.");		

		return $linea_facturas;
	}

}

?>