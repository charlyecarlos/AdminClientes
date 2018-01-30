
<?php 
	
	require_once './php/Domain/cliente.php';
	require_once './php/Service/ClienteService.php';

	try{
		$response="";
		$cif=$_REQUEST["q"];
		$cliente=new Cliente();
		$cliente->setCIF($cif);
		$servicioCliente=new ClienteService();
		$cliente=$servicioCliente->recuperarCliente($cliente);
			if($cliente!=null){
				$response=$cliente->getNombre().'|'.$cliente->getDireccion().'|'.$cliente->getCP().'|'.$cliente->getCiudad().'|'.$cliente->getProvincia().'|'.$cliente->getEmail().'|'.$cliente->getTelefono();
			}else
				$response= "El Cliente no existe";
	}catch(ServiceException $e){
		header('Location: ./altaCliente.php?error='.$e->getMessage());
	}
	echo $response;


?>