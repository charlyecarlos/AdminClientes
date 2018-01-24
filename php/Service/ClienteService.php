
<?php
	include './php/DAO/TransactionManager.php';
	require_once './php/Exception/DAOException.php';
	require_once './php/Exception/ServiceException.php';

	class ClienteService{

		public function insertarCliente($cliente){
			$trans= new TransactionManager();
			try{
				$clientedao=$trans->getClienteDAO();
				$clientedao->insertarCliente($cliente);
				$trans->closeCommit();
			}catch(DAOException $e){
				$trans->closeRollback();
				throw new ServiceException($e->getMessage());
			}
		}
		
		public function borrarCliente($cliente){
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

		public function modificarCliente($cliente){
			$trans= new TransactionManager();
			try{
				$clientedao=$trans->getClienteDAO();
				$clientedao->modificarCliente($cliente);
				$trans->closeCommit();
			}catch(DAOException $e){
				$trans->closeRollback();
				throw new ServiceException($e->getMessage());
			}
		}

		public function modificarClienteConcurrente($cliente,$clienteInicial){
			$trans= new TransactionManager();
			$filas=0;
			try{
				$clientedao=$trans->getClienteDAO();
				$filas=$clientedao->modificarClienteConcurrente($cliente,$clienteInicial);
				$trans->closeCommit();
			}catch(DAOException $e){
				$trans->closeRollback();
				throw new ServiceException($e->getMessage());
			}
			return $filas;
		}
		
		public function recuperarCliente($cliente){
			$trans= new TransactionManager();
			try{
				$clientedao=$trans->getClienteDAO();
				$clientes = $clientedao->recuperarCliente($cliente);
				$trans->closeCommit();
			}catch(DAOException $e){
				$trans->closeRollback();
				throw new ServiceException($e->getMessage());
			}
			return $clientes;
		}

		public function recuperarBuscarCliente($buscar){
			$trans= new TransactionManager();
			try{
				$clientedao=$trans->getClienteDAO();
				$clientes = $clientedao->recuperarBuscarCliente($buscar);
				$trans->closeCommit();
			}catch(DAOException $e){
				$trans->closeRollback();
				throw new ServiceException($e->getMessage());
			}
			return $clientes;
		}

		public function recuperarClienteOrdenado($orden){
			$trans= new TransactionManager();
			$clientes=null;
			try{
				$clientedao=$trans->getClienteDAO();
				$clientes = $clientedao->recuperarClienteOrdenado($orden);
				$trans->closeCommit();
			}catch(DAOException $e){
				$trans->closeRollback();
				throw new ServiceException($e->getMessage());
			}
			return $clientes;
		}

		public function recuperarTodosCliente(){
			$trans= new TransactionManager();
			try{
				$clientedao=$trans->getClienteDAO();
				$clientes = $clientedao->recuperarTodosCliente();
				$trans->closeCommit();
			}catch(DAOException $e){
				$trans->closeRollback();
				throw new ServiceException($e->getMessage());
			}
			return $clientes;
		}
	}
	

?>