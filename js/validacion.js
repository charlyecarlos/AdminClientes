
function estaVacio(elemento) {
	if (elemento == "")
		return true;
	else
		return false;
}

/**
 * @param {*} fecha 
 * @description Validar fecha con mascara dd/mm/yyyy
 */
function validarFecha(fecha) {
	var exp = /^([0][1-9]|[12][0-9]|3[01])(\/|-)([0][1-9]|[1][0-2])\2(\d{4})$/;
	if (fecha != "") {
		if (exp.test(fecha))
			return true;
		else
			return false;
	} else
		return false;
}

function validarTelefono(tlf) {
	if (tlf != "" && !isNaN(tlf) && tlf.length == 9)
		if (tlf.charAt(0) == 6 || tlf.charAt(0) == 7 || tlf.charAt(0) == 9)
			return true;
		else
			return false;
	else
		return false;
}

function validarMail(correo) {
	var exp = /^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,3})$/;
	if (exp.test(correo))
		return true;
	else
		return false;
}

function validarCP(cp) {
	var exp = /^([1-9]{2}|[0-9][1-9]|[1-9][0-9])[0-9]{3}$/;
	if (exp.test(cp))
		return true;
	else
		return false;
}

function validarDoc(doc) {
	var tipoDoc = document.getElementById('tipoDoc');
	var numdo = document.getElementById('numdo');
	if (tipoDoc.value == "CIF") {
		if (validarCif(doc.value)) {
			numdo.className = "form-group has-success has-feedback";
			icoNumdo.className = "glyphicon glyphicon-ok form-control-feedback ";
		} else {
			numdo.className = "form-group has-error has-feedback";
			icoNumdo.className = "glyphicon glyphicon-remove form-control-feedback ";
		}
	} else if (tipoDoc.value == "DNI" || tipoDoc.value == "NIE") {
		if (validarDni(doc.value)) {
			numdo.className = "form-group has-success has-feedback";
			icoNumdo.className = "glyphicon glyphicon-ok form-control-feedback ";
		} else {
			numdo.className = "form-group has-error has-feedback";
			icoNumdo.className = "glyphicon glyphicon-remove form-control-feedback ";
		}
	}
}

function validarCif(cif) {

	//Quitamos el primer caracter y el ultimo digito
	var valueCif = cif.substr(1, cif.length - 2);
	var suma = 0;

	//Sumamos las cifras pares de la cadena
	for (i = 1; i < valueCif.length; i = i + 2)
		suma = suma + parseInt(valueCif.substr(i, 1));

	var suma2 = 0;

	//Sumamos las cifras impares de la cadena
	for (i = 0; i < valueCif.length; i = i + 2) {
		result = parseInt(valueCif.substr(i, 1)) * 2;
		if (String(result).length == 1) {
			// Un solo caracter
			suma2 = suma2 + parseInt(result);
		} else {
			// Dos caracteres. Los sumamos...
			suma2 = suma2 + parseInt(String(result).substr(0, 1)) + parseInt(String(result).substr(1, 1));
		}
	}
	// Sumamos las dos sumas que hemos realizado
	suma = suma + suma2;
	var unidad = String(suma).substr(1, 1)
	unidad = 10 - parseInt(unidad);
	var primerCaracter = cif.substr(0, 1).toUpperCase();
	if (primerCaracter.match(/^[FJKNPQRSUVW]$/)) {
		//Empieza por .... Comparamos la ultima letra
		if (String.fromCharCode(64 + unidad).toUpperCase() == cif.substr(cif.length - 1, 1).toUpperCase())
			return true;
	} else if (primerCaracter.match(/^[ABCDEFGHLM]$/)) {
		//Se revisa que el ultimo valor coincida con el calculo
		if (unidad == 10)
			unidad = 0;
		if (cif.substr(cif.length - 1, 1) == String(unidad))
			return true;
	}
	return false;
}

function validarNif(nif) {
	var dni = nif.substring(0, nif.length - 1);
	var let = nif.charAt(nif.length - 1);
	if (!isNaN(let)) {
		//alert('Falta la letra');
		return false;
	} else {
		cadena = "TRWAGMYFPDXBNJZSQVHLCKET";
		posicion = dni % 23;
		letra = cadena.substring(posicion, posicion + 1);
		if (letra != let.toUpperCase()) {
			//alert("Nif no válido");
			return false;
		}
	}
	//alert("Nif válido")
	return true;
}

function validarDni(dni) {
	var numero
	var letr
	var letra
	var expresion_regular_dni
	expresion_regular_dni = /^\d{8}[a-zA-Z]$/;

	if (expresion_regular_dni.test(dni) == true) {
		numero = dni.substr(0, dni.length - 1);
		letr = dni.substr(dni.length - 1, 1);
		numero = numero % 23;
		letra = 'TRWAGMYFPDXBNJZSQVHLCKET';
		letra = letra.substring(numero, numero + 1);
		if (letra != letr.toUpperCase()) {
			return false;
		} else {
			return true;
		}
	} else {
		return false;
	}
}

function validarIBAN(IBAN) {
	//Se pasa a Mayusculas
	IBAN = IBAN.toUpperCase();
	//Se quita los blancos de principio y final.
	IBAN = IBAN.trim();
	IBAN = IBAN.replace(/\s/g, ""); //Y se quita los espacios en blanco dentro de la cadena

	var letra1, letra2, num1, num2;
	var isbanaux;
	var numeroSustitucion;
	//La longitud debe ser siempre de 24 caracteres
	if (IBAN.length != 24) {
		return false;
	}

	// Se coge las primeras dos letras y se pasan a números
	letra1 = IBAN.substring(0, 1);
	letra2 = IBAN.substring(1, 2);
	num1 = getnumIBAN(letra1);
	num2 = getnumIBAN(letra2);
	//Se sustituye las letras por números.
	isbanaux = String(num1) + String(num2) + IBAN.substring(2);
	// Se mueve los 6 primeros caracteres al final de la cadena.
	isbanaux = isbanaux.substring(6) + isbanaux.substring(0, 6);

	//Se calcula el resto, llamando a la función modulo97, definida más abajo
	resto = modulo97(isbanaux);
	if (resto == 1) {
		return true;
	} else {
		return false;
	}
}

/**
 * @param {*} cp 
 * @description Devuelve el nombre de la provincia al que pertenece ese codigo postal
 */
function provinciaPorCP(cp) {
	var res = cp.slice(0, 2);
	switch (res) {
		case '01':
			return "Alava";
			break;
		case '08':
			return "Barcelona";
			break;
		case '09':
			return "Burgos";
			break;
		case '15':
			return "Coruña";
			break;
		case '22':
			return "Huesca";
			break;
		case '28':
			return "Madrid";
			break;
		case '29':
			return "Málaga";
			break;
		case '36':
			return "Pontevedra";
			break;
		case '43':
			return "Tarragona";
			break;
		case '50':
			return "Zaragoza";
			break;
		default:
			return "Desconocido";
	}
}

/**
* @param fecha
* @description Cambiar formato fecha de yyyy-MM-dd a dd/MM/yyyy 
*/

function formatoFecha(fecha){
  return fecha.replace(/^(\d{4})-(\d{2})-(\d{2})$/g,'$3/$2/$1');
}
