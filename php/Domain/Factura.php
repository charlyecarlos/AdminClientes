<?php
	require_once './php/Util/Validator.php';
	
	class Factura{

		private $num_fact;
		private $fecha;
		private $cliente;
		private $lineas_factura;

		static function crearFactura($num_fact,$fecha,$cliente){
			$factura=new Factura();
			$factura->setNum_fact($num_fact);
			$factura->setFecha($fecha);
			$factura->setCliente($cliente);
			return $factura;
		}

		static function crearFacturaCompleto($num_fact,$fecha,$cliente,$lineas_factura){
			$factura=new Factura();
			$factura->setNum_fact($num_fact);
			$factura->setFecha($fecha);
			$factura->setCliente($cliente);
			$factura->setLineas_factura($lineas_factura);
			return $factura;
		}

		function setNum_fact($num_fact){
			if (Validator::length($num_fact,1,20))
				$this->num_fact=$num_fact;
			else
				throw new DomainException("El Nº factura tiene que ser de 1 a 20 digitos");
		}

		function getNum_fact(){
			return $this->num_fact;
		}
		
		function setFecha($fecha){
			if (Validator::fecha($fecha))
				$this->fecha=$fecha;
			else
				throw new DomainException("La fecha es incorrecta, tiene que tener el formato dd/mm/yyyy hh/mm/ss");
		}

		function getFecha(){
			return $this->fecha;
		}

		function setCliente($cliente){
			if ($cliente!=null)
				$this->cliente=$cliente;
			else
				throw new DomainException("El cliente no puede ser nulo.");	
		}

		function getCliente(){
			return $this->cliente;
		}

		function setLineas_factura($lineas_factura){
		    $this->lineas_factura = $lineas_factura;
		}
		
		function getLineas_factura(){
		    return $this->lineas_factura;
		}
	}

?>