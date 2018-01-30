
<?php

	require_once './php/Domain/Factura.php';
	require_once './php/Service/FacturacionService.php';
	try{
		$factura=new Factura();
		$factura->setNum_fact($_REQUEST["num_fact"]);
		
		$servicioFacturacion=new FacturacionService();
		$servicioFacturacion->borrarFacturacion($factura);

		header('Location: ./facturaBorrada.php');

	}catch(ServiceException|DomainException $e){
		header('Location: ./listadoFacturas.php?error='.$e->getMessage().'&fact='.$_REQUEST["fact"]);
	}

?>