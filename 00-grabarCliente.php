
<?php
	require_once './php/Domain/cliente.php';
	require_once './php/Service/ClienteService.php';
	
	try{
		$cliente=Cliente::crearCliente(
						$_POST["dni"],
						$_POST["cli"],
						$_POST["dir"],
						$_POST["cp"],
						$_POST["ciu"],
						$_POST["provincia"],
						$_POST["telf"],
						$_POST["email"],
						$_POST["saldo"],
						$_POST["obs"]						
					);
		$servicioCliente=new ClienteService();
		$servicioCliente->insertarCliente($cliente);

		header('Location: ./clienteInsertado.php');

	}catch(ServiceException|DomainException $e){
		header('Location: ./altaCliente.php?error='.$e->getMessage().'&cif='.$_POST["dni"]);
	}

?>