
<?php
	include './php/DAO/TransactionManager.php';
	require_once './php/Exception/DAOException.php';
	require_once './php/Exception/ServiceException.php';

	class FacturacionService{

		public function insertarFacturacion($factura,$lineas_factura){
			$trans= new TransactionManager();
			try{
				$facturadao=$trans->getFacturaDAO();
				$lineafacturadao=$trans->getLineaFacturaDAO();
				$facturadao->insertarFactura($factura);

				foreach ($lineas_factura as $linea_factura)
					$lineafacturadao->insertarLineaFactura($linea_factura);

				$trans->closeCommit();
			}catch(DAOException $e){
				$trans->closeRollback();
				throw new ServiceException($e->getMessage());
			}
		}
		
		public function borrarFacturacion($factura){
			$trans= new TransactionManager();
			try{
				$facturadao=$trans->getFacturaDAO();
				$lineafacturadao=$trans->getLineaFacturaDAO();

				$lineafacturadao->borrarLineasFacturaPorFactura($factura);
				$facturadao->borrarFactura($factura);
				$trans->closeCommit();
			}catch(DAOException $e){
				$trans->closeRollback();
				throw new ServiceException($e->getMessage());
			}
		}

		public function recuperarTodasFacturas(){
			$trans= new TransactionManager();
			try{
				$facturadao=$trans->getFacturaDAO();
				$factura = $facturadao->recuperarTodasFacturas();
				$trans->closeCommit();
			}catch(DAOException $e){
				$trans->closeRollback();
				throw new ServiceException($e->getMessage());
			}
			return $factura;
		}

		public function recuperarTodasFacturasCompletas(){
			$trans= new TransactionManager();
			try{
				$facturadao=$trans->getFacturaDAO();
				$facturas = $facturadao->recuperarTodasFacturas();

				$clientedao=$trans->getClienteDAO();
				$lineafacturadao=$trans->getLineaFacturaDAO();
				for ($i=0;$i<count($facturas);$i++) { 
					$cliente=$clientedao->recuperarCliente($facturas[$i]->getCliente());
					$facturas[$i]->setCliente($cliente);
					$lineas_factura=$lineafacturadao->recuperarLineaFacturaPorFactura($facturas[$i]);
					$facturas[$i]->setLineas_factura($lineas_factura);
				}
				$trans->closeCommit();
			}catch(DAOException $e){
				$trans->closeRollback();
				throw new ServiceException($e->getMessage());
			}
			return $facturas;
		}
	}
	

?>