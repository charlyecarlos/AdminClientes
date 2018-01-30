

<?php
require_once './php/Domain/Cliente.php';
require_once './php/Exception/DAOException.php';

class FacturaDAO{

	private $con;

	public function __construct($con){
		$this->con=$con;
	}

	function insertarFactura($factura){
		$query="INSERT INTO facturas(NUM_FACT,FECHA,CIF) VALUES (?,STR_TO_DATE(?, '%d/%m/%Y'),?)";

		$num_fact=$factura->getNum_fact();
		$fecha=$factura->getFecha();
		$cif=$factura->getCliente()->getCIF();

		$stmt=$this->con->prepare($query);
		$stmt->bind_param("sss",$num_fact,$fecha,$cif);

		$stmt->execute();

		if ($this->con->errno==1062)
			throw new DAOException("EL Nº Factura ya existe");
	}

	public function borrarFactura($factura){
		$query = "DELETE FROM FACTURAS WHERE NUM_FACT=?";
			
		$num_fact=$factura->getNum_fact();
		$stmt = $this->con->prepare($query);
		$stmt->bind_param("s",$num_fact);
		$stmt->execute();
		
		if (!isset($this->con->errno)) {
			throw new DAOException("No se ha podido borrar la factura, intentelo de nuevo mas tarde.");		
		}
	}

	public function recuperarNuevaFactura(){
		$sql= "SELECT MAX(NUM_FACT) NUM_FACT FROM FACTURAS";

		$stmt = $this->con->stmt_init();
		$stmt->prepare($sql);

		$stmt->execute();	
		$stmt->bind_result($NUM_FACT);

		if ($stmt->fetch()) {
			return $NUM_FACT;
		}else
			return "0";
	}
	
	public function recuperarTodasFacturas(){
		$sql = 'SELECT NUM_FACT,DATE_FORMAT(FECHA,"%d/%m/%Y") FECHA,CIF FROM facturas';	
		$result=$this->con->query($sql);
			
		$factura= array();
		while ($linea = $result->fetch_assoc()){
			$cliente=new Cliente();
			$cliente->setCIF($linea["CIF"]);
			array_push( $factura,Factura::crearFactura($linea["NUM_FACT"],$linea["FECHA"],$cliente));
		}

		if (!isset($this->con->errno)) 
			throw new DAOException("Error interno, vuelve a intentarlo mas tarde.");		

		return $factura;
	}

}

?>