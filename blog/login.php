<?php
require_once 'include/header.php';
require_once 'include/Adapter.php';

class Login{

	public function loginAction()
	{
		require_once 'view/login.phtml';
	}

	public function authAction()
	{
		if (!isset($_POST['submit'])) {
			throw new Exception("  Request deniad.", 1);			
		}
		$email = $_POST['email'];
		$password = $_POST['password'];

		$sql = "SELECT * FROM `user` WHERE `email` = '$email'";
		$adapter = new Adapter();
		$user = $adapter->fetchRow($sql);

		$password = ($password);
		
		$db_email = $user['email'];
		$db_pass = $user['password'];

		if($password == $db_pass){
			session_start();
			$_SESSION['id'] = $user['user_id'];
				$_SESSION['name'] = $user['first_name'];
			$_SESSION['role'] = $user['user_role'];
		}
			header('Location: blog.php?page=grid');
			
		}

		public function logoutAction()
		{
			// session_start();
			session_destroy();
			header("Location: login.php?page=login");
		}

	
}

$page = $_GET['page'].'Action';

$login = new Login();
$login->$page();

?>