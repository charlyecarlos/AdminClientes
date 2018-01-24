
<?php
	require_once './php/Util/Validator.php';

	class Cliente {
		private $cif;
		private $nombre;
		private $direccion;
		private $cp;
		private $ciudad;
		private $provincia;
		private $telefono;
		private $email;
		private $saldo;
		private $observaciones;


		static function crearCliente($cif,$nombre,$direccion,$cp,$ciudad,$provincia,$telefono,$email,$saldo,$observaciones){
			$cliente=new Cliente();
			$cliente->setCIF($cif);
			$cliente->setNombre($nombre);
			$cliente->setDireccion($direccion);
			$cliente->setCP($cp);
			$cliente->setCiudad($ciudad);
			$cliente->setProvincia($provincia);
			$cliente->setTelefono($telefono);
			$cliente->setEmail($email);
			$cliente->setSaldo($saldo);
			$cliente->setObsevaciones($observaciones);
			return $cliente;
		}

		function setCIF($cif){
			if (Validator::length($cif,9,9))
				$this->cif=$cif;
			else
				throw new DomainException("El NIF tiene que ser de 9 digitos");
		}

		function getCIF(){
			return $this->cif;
		}

		function setNombre($nombre){
			if (Validator::length($nombre,1,50))
				$this->nombre=$nombre;
			else
				throw new DomainException("El Nombre tiene que ser tener entre 1 y 50 digitos");		
		}

		function getNombre(){
			return $this->nombre;
		}

		public function setDireccion($direccion){
			if($direccion!=null)
				if(Validator::length($direccion,1, 50))
					$this->direccion = $direccion;
				else
					throw new DomainException("La longitud de la direccion tiene que ser de 1 a 50 caracteres");
			else
				throw new DomainException("La direccion no puede ser nula.");
		}

		public function getDireccion() {
			return $this->direccion;
		}

		public function setCP($cp){
			if (Validator::length($cp,5,5))
				$this->cp = $cp;
			else
				throw new DomainException("El codigo postal no es correcto.");
		}

		public function getCP(){
			return $this->cp;
		}

		public function setCiudad($ciudad){
			if (Validator::length($ciudad,1,50))
				$this->ciudad =$ciudad;
			else
				throw new DomainException("La ciudad tiene que tener entre 1 y 50 caracteres.");
				
		}

		public function getCiudad(){
			return $this->ciudad;
		}

		public function setProvincia($provincia){
			if (Validator::length($provincia,1,50))
				$this->provincia =$provincia;
			else
				throw new DomainException("La provincia tiene que tener entre 1 y 50 caracteres.");
				
		}

		public function getProvincia(){
			return $this->provincia;
		}

		public function setTelefono($telf){
			if(Validator::telephone($telf,9,9))
				$this->telefono = $telf;
			else
				throw new DomainException("El telefono es incorrecto.");
		}
	
		public function getTelefono() {
			return $this->telefono;
		}

		public function setEmail($email){
			if (Validator::email($email,1,70))
				$this->email = $email;
			else
				throw new DomainException("El email es incorrecto.");
		}

		public function getEmail(){
			return $this->email;
		}

		public function setSaldo($saldo){
			if (Validator::lengthDecimal($saldo,10,2))
				$this->saldo=$saldo;
			else
				throw new DomainException("El saldo no puede tener mas de 999.999.999,99");
		}

		public function getSaldo(){
			return $this->saldo;
		}

		public function setObsevaciones($observaciones){
			if (Validator::length($observaciones,1,200))
				$this->observaciones=$observaciones;
			else
				throw new DomainException("Las observaciones tienen que tener entre 1 y 200 caracteres.");
		}

		public function getObservaciones(){
			return $this->observaciones;
		}
	}
	
?>