<!DOCTYPE html>
<html lang="es">
<head>	
	<meta name='author' content='Carlos Campos' />
	<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
	<meta name='copyright' content='Carlos Campos' />
	<meta name='description' content='Paginas web de principiantes' />

	<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>
	<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
	<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>

	<link rel='stylesheet' type='text/css' href='css/altaCliente.css'>
	<script type='text/javascript' src='js/plantilla.js'></script>
	<script type="text/javascript" src="js/validacion.js"></script>

	<title>Modificar Cliente</title>
</head>
<body>
		<?php
		try{
			if(isset($_REQUEST["error"])){
				echo "<div class='alert alert-danger col-md-6 col-md-offset-3 text-center'>";
				echo '<p class="error">'.$_REQUEST['error'].'</p>';
				echo '</div>';
			}

			require_once './php/Domain/cliente.php';
			include_once './php/Service/ClienteService.php';

			$cliente=new Cliente();
			$cliente->setCIF($_REQUEST["cif"]);	
			$servicioCliente=new ClienteService();
			$cliente=$servicioCliente->recuperarCliente($cliente);
			session_start();
			$_SESSION["clienteInicial"]=$cliente;
		}catch(DomainException $e){
			echo $e;
		}
		?>
	<form onsubmit="return validarCompleto()" action="00-modificarCliente.php" method="post">
		<div class="row cuadro col-lg-8 col-lg-offset-2">		
			<div class='col-lg-12 text-center'>
				<h1>Modificar Cliente</h1>
			</div>
			<div class="row">
				<div class="form-group has-feedback col-md-6 col-lg-6" id="nif">
					<label class="col-md-4 col-lg-4 col-form-label col-form-label-lg text-left control-label">CIF*:</label>
					<div class="col-md-8 col-lg-8">
						<input type="text" class="form-control" name="dni" id="dni" maxlength="9" onblur="errorNif(this);" value="<?=$cliente->getCIF()?>" readonly/>
						<span id="icoNif"></span>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="form-group has-feedback col-md-6 col-lg-6" id="cliente">
					<label class="col-md-4 col-lg-4 col-form-label col-form-label-lg text-left control-label">Nombre*:</label>
					<div class="col-md-8 col-lg-8">
						<input type="text" class="form-control" name="cli" id="cli" maxlength="20" onblur="errorCliente(this);" value="<?=$cliente->getNombre()?>"/>
						<span id="icoCliente"></span>
					</div>
				</div>
				<div class="form-group has-feedback col-md-6 col-lg-6" id="dir">
					<label class="col-md-4 col-lg-4 col-form-label col-form-label-lg text-left control-label">Direccion*:</label>
					<div class="col-md-8 col-lg-8">
						<input type="text" class="form-control" name="dir" id="direccion" onblur="errorDir(this)" maxlength="20" value="<?=$cliente->getDireccion()?>"/>
						<span id="icoDir"></span>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="form-group has-feedback col-md-6 col-lg-6" id="codp">
					<label class="col-md-4 col-lg-4 col-form-label col-form-label-lg text-left control-label">CP*:</label>
					<div class="col-md-8 col-lg-8">
						<input type="text" class="form-control" name="cp" id="cp" minlength="5" maxlength="5" onblur="errorCp(this)" value="<?=$cliente->getCP()?>"/>
						<span id="icoCp"></span>
					</div>
				</div>
				<div class="form-group has-feedback col-md-6 col-lg-6" id="ciudad">
					<label class="col-md-4 col-lg-4 col-form-label col-form-label-lg text-left control-label">Ciudad*:</label>
					<div class="col-md-8 col-lg-8">
						<input type="text" class="form-control" name="ciu" id="ciu" maxlength="20" onblur="errorCiudad(this);" value="<?=$cliente->getCiudad()?>"/>
						<span id="icoCiudad"></span>
					</div>
				</div>
			</div>
			<div class="row ">
				<div class="form-group has-feedback col-md-6 col-lg-6">
					<label class="col-md-4 col-lg-4 col-form-label col-form-label-lg text-left control-label">Provincia:</label>
					<div class="col-md-8 col-lg-8">
						<input type="text" class="form-control" name="provincia" id="provincia" value="<?=$cliente->getProvincia()?>" readonly/>
					</div>
				</div>
				<div class="form-group has-feedback col-md-6 col-lg-6" id="mail">
					<label class="col-md-4 col-lg-4 col-form-label col-form-label-lg text-left control-label">Email*:</label>
					<div class="col-md-8 col-lg-8">
						<input type="text" class="form-control" name="email" id="email" maxlength="50" onblur="errorMail(this);" value="<?=$cliente->getEmail()?>"/>
						<span id="icoMail"></span>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="form-group has-feedback col-md-6 col-lg-6" id="tlf">
					<label class="col-md-4 col-lg-4 col-form-label col-form-label-lg text-left control-label">Telefono*:</label>
					<div class="col-md-8 col-lg-8">
						<input type="text" class="form-control" name="telf" id="telf" maxlength="9" onblur="errorTlf(this);" value="<?=$cliente->getTelefono()?>"/>
						<span id="icoTlf"></span>
					</div>
				</div>
				<div class="form-group has-feedback col-md-6 col-lg-6" >
					<label class="col-md-4 col-lg-4 col-form-label col-form-label-lg text-left control-label">Saldo*:</label>
					<div class="col-md-8 col-lg-8">
						<input type="text" class="form-control text-right" name="saldo" id="sald" maxlength="8" onblur="errorSaldo(this);" value="<?=$cliente->getSaldo()?>"/>
					</div>
				</div>
			</div>
			<div class="row form-group has-feedback col-md-6 col-lg-6" >
					<label class="col-md-4 col-lg-4 col-form-label col-form-label-lg text-left control-label">Observaciones*:</label>
					<div class="col-md-8 col-lg-8">
						<textarea name="obs" id="obs" cols="100" rows="3" maxlength="200"><?=$cliente->getObservaciones()?></textarea>
					</div>
			</div>
		</div>
		<footer class="row cuadro col-lg-8 col-lg-offset-2">
			<input type="submit" value="Modificar" class="btn btn-success"/>
			<input type="reset" value="Limpiar" class="btn btn-primary"/>
		</footer>
	</form>
</body>
</html>