<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN'
'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml' lang='es' xml:lang='es'>

<head>
	<meta name='author' content='Carlos Campos' />
	<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
	<meta name='copyright' content='Carlos Campos' />
	<meta name='description' content='Paginas web de principiantes' />

	<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>
	<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
	<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>


	<link rel='stylesheet' type='text/css' href='css/altaCliente.css'>
	<script type='text/javascript' src='js/altaFactura.js'></script>
	<script type="text/javascript" src="js/validacion.js"></script>
	<script type="text/javascript" src="js/ajax.js"></script>

	<link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">

	<!--titulo-->
	<title>Formulario</title>
</head>

<body >
	<?php
		if(isset($_REQUEST["error"])){
			echo "<div class='alert alert-danger col-md-6 col-md-offset-3 text-center'>";
			echo '<p class="error">'.$_REQUEST['error'].'</p>';
			echo '</div>';
		}
	?>
	<!-- Cuerpo del HTML-->
	<form class="col-lg-12" action="00-grabarFactura.php" method="POST">
		<div class="row cuadro col-lg-8 col-lg-offset-2">
			<div class="row col-md-12 col-lg-12 text-center navbar-text">
				<h1>Insertar Factura</h1>
			</div>
			<div class="row">
				<div class="form-group has-feedback col-md-6 col-lg-6" id="factura">
					<label class="col-md-4 col-lg-4 col-form-label col-form-label-lg  text-left control-label">NºFactura*:</label>
					<div class="col-md-8 col-lg-8">
						<?php 		
							require_once './php/Service/FacturaService.php';

							$servicioFactura=new FacturaService();
							$num=$servicioFactura->recuperarNuevaFactura();
							$num++;
						?>
						<input type="text" class="form-control text-center" name="fact" id="fact" maxlength="20" value=<?= $num ?> readonly/>
						<span id="icoFact"></span>
					</div>
				</div>
				<div class="form-group has-feedback col-md-6 col-lg-6" id="fecha">
					<label class="col-md-4 col-lg-4 col-form-label col-form-label-lg text-left control-label">Fecha*:</label>
					<div class="col-md-8 col-lg-8">
						<input type="date" class="form-control text-center" name="fech" id="fech" />
						<span id="icoFecha"></span>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="form-group has-feedback col-md-6 col-lg-6" id="nif">
					<label class="col-md-4 col-lg-4 col-form-label col-form-label-lg text-left control-label">CIF*:</label>
					<div class="col-md-8 col-lg-8">
						<input type="text" class="form-control" name="cif" id="dni" maxlength="9" onkeyup="rellenarClienteConCIF(this)" onblur="errorNif(this);" />
						<span id="icoNif"></span>
					</div>
				</div>
				<div class="form-group col-md-6 col-lg-6">
					<p id="exist"></p>
				</div>
			</div>
			<div class="row">
				<div class="form-group has-feedback col-md-6 col-lg-6" id="cliente">
					<label class="col-md-4 col-lg-4 col-form-label col-form-label-lg text-left control-label">Cliente*:</label>
					<div class="col-md-8 col-lg-8">
						<input type="text" class="form-control"  id="cli" maxlength="20" readonly />
						<span id="icoCliente"></span>
					</div>
				</div>
				<div class="form-group has-feedback col-md-6 col-lg-6">
					<label class="col-md-4 col-lg-4 col-form-label col-form-label-lg text-left control-label">Direccion:</label>
					<div class="col-md-8 col-lg-8">
						<input type="text" class="form-control" id="direccion" maxlength="20" readonly/>
						<span id="icoDir"></span>
					</div>
				</div>
			</div>
			<div class="row	">
				<div class="form-group has-feedback col-md-6 col-lg-6" id="codp">
					<label class="col-md-4 col-lg-4 col-form-label col-form-label-lg text-left control-label">CP*:</label>
					<div class="col-md-8 col-lg-8">
						<input type="text" class="form-control" id="cp" minlength="5" maxlength="5" readonly/>
						<span id="icoCp"></span>
					</div>
				</div>
				<div class="form-group has-feedback col-md-6 col-lg-6" id="ciudad">
					<label class="col-md-4 col-lg-4 col-form-label col-form-label-lg text-left control-label">Ciudad*:</label>
					<div class="col-md-8 col-lg-8">
						<input type="text" class="form-control" id="ciu" maxlength="20" readonly/>
						<span id="icoCiudad"></span>
					</div>
				</div>
			</div>
			<div class="row ">
				<div class="form-group has-feedback col-md-6 col-lg-6">
					<label class="col-md-4 col-lg-4 col-form-label col-form-label-lg text-left control-label">Provincia:</label>
					<div class="col-md-8 col-lg-8">
						<input type="text" class="form-control" id="provincia" readonly/>
					</div>
				</div>
				<div class="form-group has-feedback col-md-6 col-lg-6" id="mail">
					<label class="col-md-4 col-lg-4 col-form-label col-form-label-lg text-left control-label">Email*:</label>
					<div class="col-md-8 col-lg-8">
						<input type="text" class="form-control" id="email" maxlength="50" readonly/>
						<span id="icoMail"></span>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="form-group has-feedback col-md-6 col-lg-6" id="tlf">
					<label class="col-md-4 col-lg-4 col-form-label col-form-label-lg text-left control-label">Telefono:</label>
					<div class="col-md-8 col-lg-8">
						<input type="text" class="form-control" id="telf" maxlength="9" readonly/>
						<span id="icoTlf"></span>
					</div>
				</div>
			</div>
			<br>
		</div>
		<div class="row cuadro col-lg-8 col-lg-offset-2">
			<table class="table table-striped col-lg-12" id="tabla">
				<thead class="thead-dark">
					<th scope="col">Línea</th>
					<th scope="col">Descripción</th>
					<th scope="col">Cantidad</th>
					<th scope="col">Precio</th>
					<th scope="col">Total</th>
					<th scope="col">Añadir</th>
				</thead>
				<tbody id="linea">
					<tr id="1">
						<td>1</td>
						<td>
							<input type="text" class="center" name="descripcion1" id="descripcion1" size="20" maxlength="30">
						</td>
						<td>
							<input type="text" class="center" name="cant1" id="cant1" size="9" onblur="validarLinea(this);" maxlength="20" onkeypress="return soloNumeros(event);">
						</td>
						<td>
							<input type="text" class="center" name="precio1" id="precio1" size="9" onblur="validarLinea(this); formatoEuro(this)" maxlength="20" onkeypress="return soloNumeros(event);">
						</td>
						<td>0.00€</td>
						<td>
							<a id="borr1" onclick="borrarLinea(this)">
								<span class="glyphicon glyphicon-remove pull-right"></span>
							</a>
							<a id="anh1" onclick="anhadirLinea(this)">
								<span class="glyphicon glyphicon-plus-sign pull-right"></span>
							</a>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		<div class="row cuadro col-lg-8 col-lg-offset-2">
			<div class="text-center">
				<h4>Total Factura: <label id="total"> 0.00€</label></h4>
			</div>
		</div>

		<footer class="row cuadro col-lg-8 col-lg-offset-2">
			<input type="submit" value="Enviar" onclick="validarCompleto()" class="btn btn-success" />
			<input type="reset" value="Limpiar" class="btn btn-primary" />
		</footer>
	</form>


</body>

</html>