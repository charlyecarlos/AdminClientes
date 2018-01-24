

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
		xhttp.open("GET", "./01-getAJAX.php?q="+tagInput, true);
		xhttp.send();
	}
}