
<?php
	require_once './php/Domain/cliente.php';
	require_once './php/Service/ClienteService.php';

	try{
		$response="";
		$cif=$_REQUEST["q"];
		$servicioCliente=new ClienteService();
		$clientes=$servicioCliente->recuperarTodosCliente();
		foreach ($clientes as $cliente)
			if($cliente->getCIF()===$cif)
				$response= "El CIF ya existe";
	}catch(ServiceException $e){
		header('Location: ./altaCliente.php?error='.$e->getMessage());
	}
	echo $response;
?>