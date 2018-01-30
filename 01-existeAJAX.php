
<?php
	require_once './php/Domain/cliente.php';
	require_once './php/Service/ClienteService.php';

	try{
		$response="";
		$cif=$_REQUEST["q"];
		$cliente=new Cliente();
		$cliente->setCIF($cif);
		$servicioCliente=new ClienteService();
		$clientes=$servicioCliente->recuperarCliente($cliente);
			if($cliente!=null)
				$response= "El CIF ya existe";
	}catch(ServiceException $e){
		header('Location: ./altaCliente.php?error='.$e->getMessage());
	}
	echo $response;
?>