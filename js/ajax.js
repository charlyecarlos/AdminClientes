

function existeCIF(tagInput) {
	var xhttp;
	if (tagInput.length != 9) { 
		document.getElementById("exist").innerHTML = "";
	}else{
		xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
				document.getElementById("exist").innerHTML = this.responseText;
			}
		};
		xhttp.open("GET", "./01-existeAJAX.php?q="+tagInput, true);
		xhttp.send();
	}
}

function rellenarClienteConCIF(tagInput){
	var xhttp;
	if (!validarCif(tagInput.value))
		document.getElementById("exist").innerHTML = "";
	else{
		xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				var stringCliente = this.responseText;
				if (stringCliente=="El Cliente no existe")
					document.getElementById("exist").innerHTML=stringCliente;
				else{
					var arrayCliente=stringCliente.split("|");
					document.getElementById("cli").value=arrayCliente[0];
					document.getElementById("direccion").value=arrayCliente[1];
					document.getElementById("cp").value=arrayCliente[2];
					document.getElementById("ciu").value=arrayCliente[3];
					document.getElementById("provincia").value=arrayCliente[4];
					document.getElementById("email").value=arrayCliente[5];
					document.getElementById("telf").value=arrayCliente[6];
				}
			}
		};
		xhttp.open("GET", "./01-rellenarAJAX.php?q="+tagInput.value, true);
		xhttp.send();
	}
}