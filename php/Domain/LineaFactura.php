
<?php

class LineaFactura {
		
	private $factura;
	private $num_linea;
	private $descripcion;
	private $cantidad;
	private $precio;

	static function crearLinea_factura($factura,$num_linea,$descripcion,$cantidad,$precio){
		$linea_factura=new LineaFactura();
		$linea_factura->setFactura($factura);
		$linea_factura->setNum_linea($num_linea);
		$linea_factura->setDescripcion($descripcion);
		$linea_factura->setCantidad($cantidad);
		$linea_factura->setPrecio($precio);
		return $linea_factura;
	}

	public function setFactura($factura){
		if ($factura!=null)
	   	$this->factura = $factura;
	   else
	   	throw new DomainException("La factura no puede ser nula.");
	}
	
	public function getFactura(){
	    return $this->factura;
	}

	public function setNum_linea($num_linea){
		if (Validator::length($num_linea,1,20))
		   $this->num_linea = $num_linea;
		else
			throw new DomainException("El numero de linea no puede ser nulo.");
	}
	
	public function getNum_linea(){
	    return $this->num_linea;
	}
	
	public function setDescripcion($descripcion){
		if (Validator::length($descripcion,1,200))
		   $this->descripcion = $descripcion;
		else
			throw new DomainException("La descripcion no puede ser nula.");
	}
	
	public function getDescripcion(){
	    return $this->descripcion;
	}
		
	public function setCantidad($cantidad){
		if (Validator::lengthDecimal($cantidad,10,0))
		   $this->cantidad = $cantidad;
		else
			throw new DomainException("La cantidad no puede ser nula.");
	}
	
	public function getCantidad(){
	   return $this->cantidad;
	}
	
	public function setPrecio($precio){
		if (Validator::lengthDecimal($precio,10,2))
		   $this->precio = $precio;
		else
			throw new DomainException("El precio tiene que tener entre -99999999.99 y 99999999.99");
	}
	
	public function getPrecio(){
	    return $this->precio;
	}
	
}

?>