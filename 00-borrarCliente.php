
<?php

	require_once './php/Domain/cliente.php';
	require_once './php/Service/ClienteService.php';
	try{
		$cliente=new Cliente();
		$cliente->setCIF($_REQUEST["cif"]);
		
		$servicioCliente=new ClienteService();
		$servicioCliente->borrarCliente($cliente);

		header('Location: ./clienteBorrado.php');

	}catch(ServiceException|DomainException $e){
		header('Location: ./index.php?error='.$e->getMessage().'&cif='.$_REQUEST["cif"]);
	}

?>