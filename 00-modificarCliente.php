
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
		session_start();
		$clienteInicial=$_SESSION["clienteInicial"];
		$servicioCliente=new ClienteService();
		if($servicioCliente->modificarClienteConcurrente($cliente,$clienteInicial)==0)
			header('Location: ./errorOtroUsuario.php');
		else
			header('Location: ./clienteModificado.php');

	}catch(ServiceException|DomainException $e){
		header('Location: ./modCliente.php?error='.$e->getMessage().'&cif='.$_POST["dni"]);
	}

?>