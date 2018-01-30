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

	<title>Listado Facturas</title>
</head>
<body>
	<div class="text-center">
		<a href="listadoFacturas.php"><h1>Listado Facturas</h1></a>
	</div>
	<br><br>
	<?php
		if(isset($_REQUEST["error"])){
			echo "<div class='alert alert-danger col-md-6 col-md-offset-3 text-center'>";
			echo '<p class="error">'.$_REQUEST['error'].'</p>';
			echo '</div>';
		}
	?>
	<br><br>
	<div class="col-lg-10 col-lg-offset-1">
		<table class="table table-striped">
			<thead>
				<th>Nº</th>
				<th>FECHA
				</th>
				<th>CLIENTE
				</th>
				<th>TOTAL
				</th>
				<th>BORRAR</th>
			</thead>
			<tbody>
				<?php 
					require_once './php/Domain/Factura.php';
					require_once './php/Service/FacturaService.php';

					$facturas=null;					
					$servicioFactura=new FacturaService();
					if (!isset($_REQUEST["parar"]))
						try{
							$facturas=$servicioFactura->recuperarTodasFacturasCompletas();
							
							foreach ($facturas as $linea) {
								$sum=0;
								foreach ($linea->getlineas_factura() as $lineas_factura)
									$sum+=$lineas_factura->getCantidad()*$lineas_factura->getPrecio();
								echo "<tr>";
								echo "	<td>".$linea->getNum_fact()."</td>";
								echo "	<td>".$linea->getFecha()."</td>";
								echo "	<td>".$linea->getCliente()->getNombre()."</td>";
								echo "	<td>".$sum."€</td>";
								echo "	<td><a href='00-borrarFactura.php?num_fact=".$linea->getNum_fact()."'><span class='glyphicon glyphicon-trash'></span></a></td>";
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
	<div class="col-lg-10">
	</div>
	<div class="col-lg-2">
		<a href="altaFactura.php"><span class="glyphicon glyphicon-plus"></span></a>
	</div>
	<a id="ir" href="index.php">Ir a Clientes</a>
</body>
</html>