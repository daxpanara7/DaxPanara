<?php
	class Adapter{

		public $servername = "localhost";
		public $username = "root";
		public $password = "";
		public $database = "blog";

		public function connection()
		{
			$conn = mysqli_connect($this->servername, $this->username, $this->password, $this->database);
			return $conn;	
		}

		public function insert($sql)
		{
			$conn = $this->connection();
			$result = $conn->query($sql);
			return $result;
		}

		public function fetchAll($sql)
		{
			$conn = $this->connection();
			$result = $conn->query($sql);
			return $result->fetch_all(MYSQLI_ASSOC);
		}

		public function fetchRow($sql)
		{
			$conn = $this->connection();
			$result = $conn->query($sql);
			$row = mysqli_num_rows($result);
			if ($row !== 1) {
				throw new Exception("USER NOT FOUND.", 1);				
			}
			
			return $result->fetch_assoc();
		}

		public function numRow($sql)
		{
			$conn = $this->connection();
			$result = $conn->query($sql);
			$row = mysqli_num_rows($result);
			return $row;
		}
	}

	// $adapter = new Adapter();
	// $result = $adapter->connection();
	// print_r($result);
?>