<?php
class Model_Core_Adapter
{

 		public $servername="localhost";
 		public $username="root";
 		public $password="";
 		public $dbname="ecommerce";

 		public function connect()
 	 		{

 	 			$connect= mysqli_connect($this->servername,$this->username,$this->password,$this->dbname);
 	 			return $connect;
 	 	
 	 		}
 	 		public function fetchRow($query)
 	 		{
 	 			$connect=$this->connect();
 	 			$result=$connect->query($query);
 	 			if (!$result) 
 	 			{
 	 				return false;
 	 			}
 	 			return $result->fetch_assoc();
 	 		}
 	 		public function fetchAll($query)
 	 		{
 	 			$connect=$this->connect();
 	 			$result=$connect->query($query);
 	 			if (!$result) 
 	 			{
 	 				return false;
 	 			}
 	 			return $result->fetch_all(MYSQLI_ASSOC) ;
 	 		}

}

?>