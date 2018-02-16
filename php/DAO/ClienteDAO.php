
<?php
require_once './php/Domain/Cliente.php';
require_once './php/Exception/DAOException.php';

class ClienteDAO {
	private $con;
	
	public function __construct($con){
		$this->con=$con;
	}

	public function insertarCliente($cliente){
		$query = "INSERT INTO clientes(CIF,NOMBRE,DIRECCION,CP,CIUDAD,PROVINCIA,TELEFONO,EMAIL,SALDO,OBSERVACIONES) VALUES (?,?,?,?,?,?,?,?,?,?)";
			
		$cif=$cliente->getCIF();
		$nombre=$cliente->getNombre();
		$direccion=$cliente->getDireccion();
		$cp=$cliente->getCP();
		$ciudad=$cliente->getCiudad();
		$provincia=$cliente->getProvincia();
		$telefono=$cliente->getTelefono();
		$email=$cliente->getEmail();
		$saldo=$cliente->getSaldo();
		$obs=$cliente->getObservaciones();

		$stmt = $this->con->prepare($query);
		$stmt->bind_param("ssssssssds",$cif,$nombre,$direccion,$cp,$ciudad,$provincia,$telefono,$email,$saldo,$obs);
		$stmt->execute();

		if ($this->con->errno==1062) {
			throw new DAOException("EL NIF ya existe");		
		}
	}

	public function borrarCliente($cliente){
		$query = "DELETE FROM clientes WHERE CIF=?";
			
		$cif=$cliente->getCIF();
		$stmt = $this->con->prepare($query);
		$stmt->bind_param("s",$cif);
		$stmt->execute();
		
		if (!isset($this->con->errno)) {
			throw new DAOException("No se ha podido borrar el cliente, intentelo de nuevo mas tarde.");		
		}
	}

	public function modificarCliente($cliente){
		$sql = "UPDATE clientes SET NOMBRE=?,DIRECCION=?,CP=?,CIUDAD=?,PROVINCIA=?,TELEFONO=?,EMAIL=?,SALDO=?,OBSERVACIONES=? WHERE CIF=?";

		$cif=$cliente->getCIF();
		$nombre=$cliente->getNombre();
		$direccion=$cliente->getDireccion();
		$cp=$cliente->getCP();
		$ciudad=$cliente->getCiudad();
		$provincia=$cliente->getProvincia();
		$telefono=$cliente->getTelefono();
		$email=$cliente->getEmail();
		$saldo=$cliente->getSaldo();
		$obs=$cliente->getObservaciones();

		$stmt = $this->con->prepare($sql);
		$stmt->bind_param("sssssssdss",$nombre,$direccion,$cp,$ciudad,$provincia,$telefono,$email,$saldo,$obs,$cif);
		$stmt->execute();

		if (!isset($this->con->errno)) 
			throw new DAOException("Error interno, vuelve a intentarlo mas tarde.");		

	}

	public function modificarClienteConcurrente($cliente,$clienteInicial){
		$sql = "UPDATE clientes SET NOMBRE=?,DIRECCION=?,CP=?,CIUDAD=?,PROVINCIA=?,TELEFONO=?,EMAIL=?,SALDO=?,OBSERVACIONES=? WHERE CIF=? AND NOMBRE=? AND DIRECCION=? AND CP=? AND CIUDAD=? AND PROVINCIA=? AND TELEFONO=? AND EMAIL=? AND SALDO=? AND OBSERVACIONES=?";
		$filas = 0;

		$cif=$cliente->getCIF();
		$nombre=$cliente->getNombre();
		$direccion=$cliente->getDireccion();
		$cp=$cliente->getCP();
		$ciudad=$cliente->getCiudad();
		$provincia=$cliente->getProvincia();
		$telefono=$cliente->getTelefono();
		$email=$cliente->getEmail();
		$saldo=$cliente->getSaldo();
		$obs=$cliente->getObservaciones();

		$nombreIni=$clienteInicial->getNombre();
		$direccionIni=$clienteInicial->getDireccion();
		$cpIni=$clienteInicial->getCP();
		$ciudadIni=$clienteInicial->getCiudad();
		$provinciaIni=$clienteInicial->getProvincia();
		$telefonoIni=$clienteInicial->getTelefono();
		$emailIni=$clienteInicial->getEmail();
		$saldoIni=$clienteInicial->getSaldo();
		$obsIni=$clienteInicial->getObservaciones();

		$stmt = $this->con->prepare($sql);
		$stmt->bind_param("sssssssdsssssssssds",$nombre,$direccion,$cp,$ciudad,$provincia,$telefono,$email,$saldo,$obs,$cif,$nombreIni,$direccionIni,$cpIni,$ciudadIni,$provinciaIni,$telefonoIni,$emailIni,$saldoIni,$obsIni);
		$stmt->execute();
		$filas = $stmt->affected_rows;
		if (!isset($this->con->errno)) 
			throw new DAOException("Error interno, vuelve a intentarlo mas tarde.");		
		
		return $filas;
	}
	
	public function recuperarCliente($cliente){
		$cif=$cliente->getCIF();
		$sql = "SELECT NOMBRE,DIRECCION,CP,CIUDAD,PROVINCIA,TELEFONO,EMAIL,SALDO,OBSERVACIONES FROM clientes WHERE CIF=?";	
		
		$stmt = $this->con->stmt_init();
		$stmt->prepare($sql);
		$stmt->bind_param('s',$cif);
		$stmt->execute();
		
		$stmt->bind_result($nombre,$direccion,$cp,$ciudad,$provincia,$telefono,$email,$saldo,$obs);
		$stmt->fetch();
		if(isset($nombre))
			$cliente=Cliente::crearCliente($cif,$nombre,$direccion,$cp,$ciudad,$provincia,$telefono,$email,$saldo,$obs);
		else
			$cliente=null;
		$stmt->close();

		if (!isset($this->con->errno)) 
			throw new DAOException("Error interno, vuelve a intentarlo mas tarde.");		
		return $cliente;
	}

	public function recuperarBuscarCliente($buscar){
		$sql = "SELECT CIF,NOMBRE,DIRECCION,CP,CIUDAD,PROVINCIA,TELEFONO,EMAIL,SALDO,OBSERVACIONES FROM clientes WHERE NOMBRE like ?";	
		
		$stmt = $this->con->stmt_init();
		$stmt->prepare($sql);
		$buscar='%'.$buscar.'%';
		$stmt->bind_param('s',$buscar);
		$stmt->execute();	
		$stmt->bind_result($cif,$nombre,$direccion,$cp,$ciudad,$provincia,$telefono,$email,$saldo,$obs);

		$clientes= array();
		while($stmt->fetch())
			array_push($clientes,Cliente::crearCliente($cif,$nombre,$direccion,$cp,$ciudad,$provincia,$telefono,$email,$saldo,$obs));
		$stmt->close();

		if (!isset($this->con->errno)) 
			throw new DAOException("Error interno, vuelve a intentarlo mas tarde.");

		return $clientes;
	}

	public function recuperarClienteOrdenado($orden){
		$sql = "SELECT CIF,NOMBRE,DIRECCION,CP,CIUDAD,PROVINCIA,TELEFONO,EMAIL,SALDO,OBSERVACIONES FROM clientes ORDER BY ".$orden;
		$stmt = $this->con->stmt_init();
		$stmt->prepare($sql);
		$stmt->execute();	
		$stmt->bind_result($cif,$nombre,$direccion,$cp,$ciudad,$provincia,$telefono,$email,$saldo,$obs);

		$clientes= array();
		while($stmt->fetch())
			array_push($clientes,Cliente::crearCliente($cif,$nombre,$direccion,$cp,$ciudad,$provincia,$telefono,$email,$saldo,$obs));
		$stmt->close();

		if (!isset($this->con->errno)) 
			throw new DAOException("Error interno, vuelve a intentarlo mas tarde.");		

		return $clientes;
	}

	public function recuperarTodosCliente(){
		$sql = "SELECT CIF,NOMBRE,DIRECCION,CP,CIUDAD,PROVINCIA,TELEFONO,EMAIL,SALDO,OBSERVACIONES FROM clientes";	
		$result=$this->con->query($sql);
			
		$clientes= array();
		while ($linea = $result->fetch_assoc())
			array_push( $clientes , Cliente::crearCliente($linea["CIF"],$linea["NOMBRE"],$linea["DIRECCION"],$linea["CP"],$linea["CIUDAD"],$linea["PROVINCIA"],$linea["TELEFONO"],$linea["EMAIL"],$linea["SALDO"],$linea["OBSERVACIONES"]));

		if (!isset($this->con->errno)) 
			throw new DAOException("Error interno, vuelve a intentarlo mas tarde.");		

		return $clientes;
	}
}

?>