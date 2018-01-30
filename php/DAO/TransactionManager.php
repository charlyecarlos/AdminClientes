
<?php 
	include './php/DAO/ClienteDAO.php';
	require_once './php/DAO/FacturaDAO.php';
	require_once './php/DAO/LineaFacturaDAO.php';

	class TransactionManager{
		
		private $conn;

		function __construct(){
			$this->conn=new mysqli('127.0.0.1','php','php','tallervives');
			$this->conn->autocommit(FALSE);
		}
		
		public function getClienteDAO() {
			return new ClienteDAO($this->conn);
		}

		public function getFacturaDAO(){
			return new FacturaDAO($this->conn);
		}

		public function getLineaFacturaDAO(){
			return new LineaFacturaDAO($this->conn);
		}

		public function closeCommit() {
			if($this->conn!=null){
				$this->conn->commit();
				$this->conn->close();
			}
		}
		
		public function closeRollback(){
			if($this->conn!=null){
				$this->conn->rollback();
				$this->conn->close();
			}
		}
	}
?>