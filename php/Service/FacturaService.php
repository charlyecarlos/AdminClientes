
<?php
	include './php/DAO/TransactionManager.php';
	require_once './php/Exception/DAOException.php';
	require_once './php/Exception/ServiceException.php';

	class FacturaService{

		public function insertarFactura($factura){
			$trans= new TransactionManager();
			try{
				$facturadao=$trans->getFacturaDAO();
				$facturadao->insertarFactura($factura);
				$trans->closeCommit();
			}catch(DAOException $e){
				$trans->closeRollback();
				throw new ServiceException($e->getMessage());
			}
		}

		public function recuperarNuevaFactura(){
			$trans= new TransactionManager();
			try{
				$facturadao=$trans->getFacturaDAO();
				$num_fact=$facturadao->recuperarNuevaFactura();
				$trans->closeCommit();
			}catch(DAOException $e){
				$trans->closeRollback();
				throw new ServiceException($e->getMessage());
			}
			return $num_fact;
		}
		
		// AUN NO SE HA HECHO EL DAO
/*		public function borrarCliente($factura){
			$trans= new TransactionManager();
			try{
				$clientedao=$trans->getClienteDAO();
				$clientedao->borrarCliente($cliente);
				$trans->closeCommit();
			}catch(DAOException $e){
				$trans->closeRollback();
				throw new ServiceException($e->getMessage());
			}
		}
*/
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