<?php
	require_once './php/Domain/Cliente.php';
	require_once './php/Domain/Factura.php';
	require_once './php/Service/FacturacionService.php';
	require_once './php/Exception/ServiceException.php';
	
	try{
		$fecha = new DateTime($_REQUEST["fech"]);
		$fecha = $fecha->format('d/m/Y');

		$cliente=new Cliente();
		$cliente->setCIF($_REQUEST["cif"]);
		$factura=Factura::crearFactura($_REQUEST["fact"], $fecha, $cliente);

		$lineas_factura=array();
		$i=1;
		while(isset($_REQUEST["descripcion".$i]) && 
				$_REQUEST["descripcion".$i]!="" && 
				$_REQUEST["cant".$i]!="" && 
				$_REQUEST["precio".$i]!=""){
			$precio=str_replace("€","",$_REQUEST["precio".$i]);
			array_push($lineas_factura,LineaFactura::crearLinea_factura(
													$_REQUEST["fact"],
													$i,
													$_REQUEST["descripcion".$i],
													$_REQUEST["cant".$i],
													$precio));
			$i++;
		}

		if ($i>1) {
			$servicioFactura=new FacturacionService();
			$servicioFactura->insertarFacturacion($factura,$lineas_factura);
		} else 
			throw new ServiceException("No se ha insertado ninguna linea de pedido.");
		
		header('Location: ./facturaInsertada.php');
	}catch(ServiceException|DomainException $e){
		header('Location: ./altaFactura.php?error='.$e->getMessage().'&cif='.$_REQUEST["cif"]);
	}

?>