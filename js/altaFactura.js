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
function errorNif(tagInput) {
	var nif = document.getElementById("nif");
	var icoNif = document.getElementById("icoNif");
	if (validarCif(tagInput.value)) {
		nif.className = "form-group has-success has-feedback col-md-6 col-lg-6";
		icoNif.className = "glyphicon glyphicon-ok form-control-feedback ";
	} else {
		nif.className = "form-group has-error has-feedback col-md-6 col-lg-6";
		icoNif.className = "glyphicon form-control-feedback glyphicon-remove";
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

function anhadirLinea(tagInput) {
	if (validarLineas(tagInput)) {
		var idlinea = tagInput.id.slice(tagInput.id.length - 1);

		var tabla = document.getElementById('linea');
		var row = tabla.insertRow();
		row.setAttribute("id", cont);
		var linea1 = row.insertCell(0);
		var linea2 = row.insertCell(1);
		var linea3 = row.insertCell(2);
		var linea4 = row.insertCell(3);
		var linea5 = row.insertCell(4);
		var linea6 = row.insertCell(5);
		linea1.innerHTML = cont;
		linea2.innerHTML = "<input type=text class=center name='descripcion" + cont + "' id='descripcion" + cont + "' size=20 maxlength=30>";
		linea3.innerHTML = "<input type=text class=center name='cant" + cont + "' id='cant" + cont + "' size=9 onblur='validarLinea(this);' maxlength='20' onkeypress='return soloNumeros(event);'>";
		linea4.innerHTML = "<input type=text class=center name='precio" + cont + "' id='precio" + cont + "' size=9 onblur='validarLinea(this); formatoEuro(this)' maxlength='20' onkeypress='return soloNumeros(event);'>";
		linea5.innerHTML = "0.00€";
		linea6.innerHTML = '<a id="borr' + cont + '" onclick="borrarLinea(this)"><span class="glyphicon glyphicon-remove pull-right"></span></a><a id="anh' + cont + '" onclick="anhadirLinea(this)"><span class="glyphicon glyphicon-plus-sign pull-right"></span>';
		cont++;
	}
}
function borrarLinea(tagInput) {
	var idlinea = tagInput.id.slice(tagInput.id.length - 1);
	var tabla = document.getElementById('tabla');
	if (tabla.rows.length > 2)
		tabla.deleteRow(idlinea);
	actualizarDesdeLinea(tabla, idlinea);
}
function validarLinea(tagInput) {
	var bien = false;
	var idlinea = tagInput.id.slice(tagInput.id.length - 1);
	var cant = parseFloat(document.getElementById("cant" + idlinea).value);
	var precio = parseFloat(document.getElementById("precio" + idlinea).value);
	var tabla = document.getElementById('tabla');
	if (!isNaN(cant) && !isNaN(precio) && precio > 0) {
		tabla.rows[idlinea].cells[4].innerHTML = (cant * precio).toFixed(2) + "€";
		bien = true;
	} else {
		tabla.rows[idlinea].cells[4].innerHTML = "0.00€";
	}
	if (estaVacio(document.getElementById("descripcion" + idlinea).value))
		bien = false;
	actualizarGeneral();
	return bien;
}
function validarLineas(tagInput) {
	var tabla = document.getElementById('tabla');
	for (let i = 1; i < tabla.rows.length; i++)
		if (!validarLinea(tabla.rows[i]))
			return false;
	return true;
}
function actualizarDesdeLinea(tabla, idlinea) {
	for (let i = idlinea; i < tabla.rows.length; i++) {
		tabla.rows[i].id = i;
		tabla.rows[i].cells[0].innerHTML = i;
		document.getElementById("cant" + (parseInt(i) + 1)).setAttribute("id", "cant" + i);
		document.getElementById("descripcion" + (parseInt(i) + 1)).setAttribute("id", "descripcion" + i);
		document.getElementById("precio" + (parseInt(i) + 1)).setAttribute("id", "precio" + i);
		document.getElementById("iva" + (parseInt(i) + 1)).setAttribute("id", "iva" + i);
		document.getElementById("borr" + (parseInt(i) + 1)).setAttribute("id", "borr" + i);
		document.getElementById("anh" + (parseInt(i) + 1)).setAttribute("id", "anh" + i);
	}
	cont--;
}
function actualizarGeneral() {
	var tabla = document.getElementById('tabla');
	var total = 0;
	for (let i = 1; i < tabla.rows.length; i++) {
		total += parseFloat(tabla.rows[i].cells[4].innerHTML);
	}
	document.getElementById("total").innerHTML = total.toFixed(2) + "€";
}


function validarCompleto() {
	var allOk = true;

	var factura = document.getElementById("fact").value;
	if (estaVacio(factura))
		allOk = false;

	var fecha = document.getElementById("fech");
	fecha=formatoFecha(fecha.value);
	if (estaVacio(fecha.value) || !validarFecha(fecha))
		allOk = false;

	if (!validarLineas())
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
