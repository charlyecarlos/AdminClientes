
<?php
	class Validator{
		/**
		 * Metodo que comprueba la cantidad de caracteres de una cadena
		 * 
		 * @param cadena
		 *            Cadena a comprobar
		 * @param min
		 *            Minimo de caracteres
		 * @param max
		 *            Maximo de caracteres
		 * @return boolean; true = valido
		 */
		public static function length($cadena, $min, $max) {
			$validation = false;
			$cadena=trim($cadena);
			if ($cadena != null) 
				if (strlen($cadena) >= $min && strlen($cadena) <= $max)
					$validation = true;
			return $validation;

		}
		/**
		 * Metodo que comprueba la cantidad de caracteres de una cadena
		 * 
		 * @param cadena
		 *            Cadena a comprobar
		 * @param min
		 *            Minimo de caracteres
		 * @param max
		 *            Maximo de caracteres
		 * @return boolean; true = valido
		 */
		public static function lengthDecimal($numero,$precision,$decimales) {
			$enteros=$precision-$decimales;
			if (strlen($numero)<=$precision)
				if(preg_match("/^[0-9]{0,".$enteros."}.[0-9]{0,".$decimales."}$/", $numero))
					return true;
			
			return false;
		}

		/**
		 * Comprueba si un email es valido
		 * 
		 * @param email
		 * @param emailMax
		 * @param emailMin
		 * @return boolean; true = email valido
		 */
		public static function email($email,$emailMin,$emailMax) {
			$validation = false;
			if (Validator::length($email,$emailMin,$emailMax)) {
				if (filter_var($email, FILTER_VALIDATE_EMAIL))
					$validation=true;
			}
			return $validation;

		}

		/**
		 * Comprueba que el telefono solo tiene numeros y espacios, puede tener '+' delante
		 * 
		 * @param phoneNo
		 * @return boolean
		 */
		public static function telephone($phone, $min, $max) {
			$validation = false;
			if (Validator::length($phone, $min, $max))
				if(preg_match("/^[9|6|7][0-9]{8}$/", $phone)) 
					$validation=true;
			return $validation;
		}


		/**
		 * Comprueba que el DNI es valido
		 * 
		 * @param dni
		 * @return boolean
		 */

		public static function DNI($dni) {
			$validation = false;
			$letra = substr($dni, -1);
			$numeros = substr($dni, 0, -1);
			if ( substr("TRWAGMYFPDXBNJZSQVHLCKE", $numeros%23, 1) == $letra && strlen($letra) == 1 && strlen ($numeros) == 8 )
				$validation=true;
			return $validation;
		}
	}
?>