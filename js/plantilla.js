var cont = 2;

function errorFactura(tagInput) {
	var factura = document.getElementById("factura");
	var icoFact = document.getElementById("icoFact");
	if (!estaVacio(tagInput.value)) {
		factura.className = "form-group has-success has-feedback col-md-6 col-lg-6";
		icoFact.className = "glyphicon glyphicon-ok form-control-feedback ";
	} else {
		factura.className = "form-group has-error has-feedback col-md-6 col-lg-6";
		icoFact.className = "glyphicon glyphicon-remove form-control-feedback ";
	}
}
function errorFecha(tagInput) {
	var fecha = document.getElementById("fecha");
	var icoFecha = document.getElementById("icoFecha");
	if (!estaVacio(tagInput.value)) {
		if (validarFecha(tagInput.value)) {
			fecha.className = "form-group has-success has-feedback col-md-6 col-lg-6";
			icoFecha.className = "glyphicon glyphicon-ok form-control-feedback ";
		} else {
			fecha.className = "form-group has-error has-feedback col-md-6 col-lg-6";
			icoFecha.className = "glyphicon glyphicon-remove form-control-feedback ";
		}
	} else {
		fecha.className = "form-group has-error has-feedback col-md-6 col-lg-6";
		icoFecha.className = "glyphicon glyphicon-remove form-control-feedback ";
	}
}
function errorCliente(tagInput) {
	var cliente = document.getElementById("cliente");
	var icoCli = document.getElementById("icoCliente");
	if (!estaVacio(tagInput.value)) {
		cliente.className = "has-success  has-feedback col-md-6 col-lg-6";
		icoCli.className = "glyphicon glyphicon-ok form-control-feedback ";
	} else {
		cliente.className = "has-error has-feedback col-md-6 col-lg-6";
		icoCli.className = "glyphicon form-control-feedback glyphicon-remove ";
	}
}
function errorNif(tagInput) {
	document.getElementById("exist").innerHTML="";
	var nif = document.getElementById("nif");
	var icoNif = document.getElementById("icoNif")
	if (validarCif(tagInput.value)) {
		existeCIF(tagInput.value);
		nif.className = "form-group has-success has-feedback col-md-6 col-lg-6";
		icoNif.className = "glyphicon glyphicon-ok form-control-feedback ";
	} else {
		nif.className = "form-group has-error has-feedback col-md-6 col-lg-6";
		icoNif.className = "glyphicon form-control-feedback glyphicon-remove";
	}
}
function errorCp(tagInput) {
	var cpo = document.getElementById("codp");
	var iconcp = document.getElementById("icoCp")
	if (!estaVacio(tagInput.value))
		if (validarCP(tagInput.value)) {
			cpo.className = "has-success has-feedback col-md-6 col-lg-6";
			iconcp.className = "glyphicon glyphicon-ok form-control-feedback ";
			pintarProvincia();
		} else {
			cpo.className = "has-error has-feedback col-md-6 col-lg-6";
			iconcp.className = "glyphicon form-control-feedback glyphicon-remove";
		}
	else {
		cpo.className = "has-error has-feedback col-md-6 col-lg-6";
		iconcp.className = "glyphicon form-control-feedback glyphicon-remove";
	}
}
function errorCiudad(tagInput) {
	var ciudad = document.getElementById("ciudad");
	var icoCiu = document.getElementById("icoCiudad");
	if (!estaVacio(tagInput.value)) {
		ciudad.className = "form-group has-success has-feedback col-md-6 col-lg-6";
		icoCiu.className = "glyphicon glyphicon-ok form-control-feedback ";
	} else {
		ciudad.className = "form-group has-error has-feedback col-md-6 col-lg-6";
		icoCiu.className = "glyphicon form-control-feedback glyphicon-remove ";
	}
}
function errorMail(tagInput) {
	var mail = document.getElementById("mail");
	var icomail = document.getElementById("icoMail");
	if (validarMail(tagInput.value)) {
		mail.className = "form-group has-success has-feedback col-md-6 col-lg-6";
		icomail.className = "glyphicon glyphicon-ok form-control-feedback ";
	} else {
		mail.className = "form-group has-error has-feedback col-md-6 col-lg-6";
		icoMail.className = "glyphicon glyphicon-remove form-control-feedback ";
	}
}
function errorTlf(tagInput) {
	var tl = document.getElementById("tlf");
	var icontlf = document.getElementById("icoTlf")
	if (!estaVacio(tagInput.value))
		if (validarTelefono(tagInput.value)) {
			tl.className = "form-group has-success has-feedback col-md-6 col-lg-6";
			icontlf.className = "glyphicon glyphicon-ok form-control-feedback ";
		} else {
			tl.className = "form-group has-error has-feedback col-md-6 col-lg-6";
			icontlf.className = "glyphicon form-control-feedback glyphicon-remove";
		}
	else {
		tl.className = "form-group has-error has-feedback col-md-6 col-lg-6";
		icontlf.className = "glyphicon form-control-feedback glyphicon-remove";
	}
}

function errorSaldo(tagInput) {
	if (!estaVacio(tagInput.value))
		if (soloNumeros(tagInput.value))
			return true;
	return false;
}

function errorDir(tagInput){
	var dir = document.getElementById("dir");
	var icondir = document.getElementById("icoDir")
	if (!estaVacio(tagInput.value)){
		dir.className = "form-group has-success has-feedback col-md-6 col-lg-6";
		icondir.className = "glyphicon glyphicon-ok form-control-feedback ";
	} else {
		dir.className = "form-group has-error has-feedback col-md-6 col-lg-6";
		icondir.className = "glyphicon form-control-feedback glyphicon-remove";
	}
}

function formatoEuro(tagInput) {
	if (tagInput.value != "") {
		var num = parseFloat(tagInput.value);
		tagInput.value = num.toFixed(2) + "€";
	} else
		tagInput.value = "0.00€"
}
function soloNumeros(evt) {
	var charCode = (evt.which) ? evt.which : event.keyCode
	if (charCode == 46) {
		var inputValue = $("#floor").val();
		var count = (inputValue.match(/'.'/g) || []).length;
		if (count < 1) {
			if (inputValue.indexOf('.') < 1)
				return true;
			return false;
		} else
			return false;
	}
	if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57))
		return false;
	return true;
}
function pintarProvincia() {
	var cp = document.getElementById("cp");
	document.getElementById("provincia").value = provinciaPorCP(cp.value);
}

var hombre=["Moreno","Rubio","Castaño"];
var mujer=["Morena","Rubia","Castaña"];

function cambiarPelo(tagInput) {
	if (tagInput.value=='Hombre') 
		meterOptions(hombre);
	else 
		meterOptions(mujer);
}

function meterOptions(tagInput){
	var select=document.getElementById("pelo");
	borrarOptions();
	for (var i=0; i<tagInput.length; i++) {
		 select.add(new Option(tagInput[i]));        
	}
}

function borrarOptions(){
	var select=document.getElementById("pelo");
	while(select.options.length)
	select.remove(0);   

}

function validarCompleto() {
	var allOk = true;
		
	var cliente = document.getElementById("cli");
	if (estaVacio(cliente.value)){
		allOk = false;
		errorCliente(cliente);
	}

	var nif = document.getElementById("dni");
	if (estaVacio(nif.value)){
		allOk = false;
		errorNif(nif);
	}

	var dir= document.getElementById("direccion");
	if(estaVacio(dir.value)){
		allOk=false;
		errorDir(dir);
	}

	var cp = document.getElementById("cp");
	if (estaVacio(cp.value) || !validarCP(cp.value)){
		allOk = false;
		errorCp(cp);
	}
	
	var ciudad = document.getElementById("ciu");
	errorCiudad(ciudad);
	if (estaVacio(ciudad.value))
		allOk = false;
	
	var mail = document.getElementById("email");
	errorMail(mail);
	if (estaVacio(mail.value) || !validarMail(mail.value))
		allOk = false;
	
	var telf = document.getElementById("telf");
	errorTlf(telf);
	if (!estaVacio(telf.value))
		if(!validarTelefono(telf.value))
			allOk = false;

	if (!allOk)
		alert("Datos incorrectos");
	
	return allOk;
}

function rellenarAlert(tipoelemento, elemento) {
	if (document.getElementById(elemento).value != '')
		return tipoelemento + ': ' + document.getElementById(elemento).value + '.\n';
	else
		return '';
}
