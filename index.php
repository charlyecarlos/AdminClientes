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

	<link rel="stylesheet" href="css/index.css">

	<title>Ver Clientes</title>
</head>
<body>
	<div class="text-center">
		<a href="index.php"><h1>Ver Clientes</h1></a>
	</div>
	<br><br>
	<?php
		if(isset($_REQUEST["error"])){
			echo "<div class='alert alert-danger col-md-6 col-md-offset-3 text-center'>";
			echo '<p class="error">'.$_REQUEST['error'].'</p>';
			echo '</div>';
		}
	?>
	<div class="col-lg-10 col-lg-offset-1">
		<form action="index.php" method="post">
			<label>Buscar</label>
			<input type="text" name="buscar" id="buscar" placeholder="Buscar">
			<button><span class="glyphicon glyphicon-search"></button>
		</form>
	</div>
	<br><br>
	<div class="col-lg-10 col-lg-offset-1">
		<table class="table table-striped">
			<thead>
				<th>CIF</th>
				<th>NOMBRE
					<a href="index.php?orden=NOMBRE">
						<span class="glyphicon glyphicon-arrow-up"></span>
					</a>
					<a href="index.php?orden=NOMBRE DESC">
						<span class="glyphicon glyphicon-arrow-down"></span>
					</a>
				</th>
				<th>TELEFONO
				<a href="index.php?orden=TELEFONO">
						<span class="glyphicon glyphicon-arrow-up"></span>
					</a>
					<a href="index.php?orden=TELEFONO DESC">
						<span class="glyphicon glyphicon-arrow-down"></span>
					</a>
				</th>
				<th>SALDO
				<a href="index.php?orden=SALDO">
						<span class="glyphicon glyphicon-arrow-up"></span>
					</a>
					<a href="index.php?orden=SALDO DESC">
						<span class="glyphicon glyphicon-arrow-down"></span>
					</a>
				</th>
				<th>BORRAR/MODIFICAR</th>
			</thead>
			<tbody>
				<?php 
					require_once './php/Domain/cliente.php';
					include_once './php/Service/ClienteService.php';

					$clientes=null;					
					$servicioCliente=new ClienteService();
					if (!isset($_REQUEST["parar"]))
						try{
							if(isset($_REQUEST["buscar"])){
								$clientes=$servicioCliente->recuperarBuscarCliente($_REQUEST["buscar"]);
							}else if(isset($_REQUEST["orden"])){
								$clientes=$servicioCliente->recuperarClienteOrdenado($_REQUEST["orden"]);
							}else
								$clientes=$servicioCliente->recuperarTodosCliente();
							
							foreach ($clientes as $linea) {
								echo "<tr>";
								echo "	<td>".$linea->getCIF()."</td>";
								echo "	<td>".$linea->getNombre()."</td>";
								echo "	<td>".$linea->getTelefono()."</td>";
								echo "	<td>".$linea->getSaldo()."€</td>";
								echo "	<td><a href='modCliente.php?cif=".$linea->getCIF()."'><span class='glyphicon glyphicon-pencil'></span></a> <a href='00-borrarCliente.php?cif=".$linea->getCIF()."'><span class='glyphicon glyphicon-trash'></span></a></td>";
								echo "</tr>";
							}
						}catch(ServiceException $e){
							header('Location: ./index.php?error='.$e->getMessage().'&parar=on');
						}
				?>
			</tbody>
		</table>
	</div>
	<br><br><br>
	<div class="row col-lg-10"></div>
	<div class="col-lg-2">
		<a href="altaCliente.php"><span class="glyphicon glyphicon-plus"></span></a>
	</div>
	<a id="ir" href="listadoFacturas.php">Ir a Facturas</a>
</body>
</html>