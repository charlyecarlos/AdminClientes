
<?php 
	include './php/DAO/ClienteDAO.php';

	class TransactionManager{
		
		private $conn;

		function __construct(){
			$this->conn=new mysqli('127.0.0.1','php','php','tallervives');
			$this->conn->autocommit(FALSE);
		}
		
		public function getClienteDAO() {
			return new ClienteDAO($this->conn);
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