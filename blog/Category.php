<?php
require_once 'include/Adapter.php';
require_once 'include/header.php';
require_once 'include/session.php';


class Category{

	public function addAction()
	{
		require_once 'view/Category/add.phtml';
	}

	public function insertAction()
	{
		if (!isset($_POST['submit'])) {
			throw new Exception("Request deniad.", 1);			
		}
		// else $_session['role'] != admin; then  redirect
		if ($_SESSION['role'] == 'admin') {
			
		$name = $_POST['category'];
		$status = $_POST['status'];
		$sql = "INSERT INTO `category` (`name`,`status`,`created_at`)
		VALUE('$name','$status', now())";

		$adapter = new Adapter();
		$adapter->insert($sql);
		}
		header("Location: Category.php?page=grid");

	}

	public function gridAction()
	{	
		
		$sql = "SELECT * FROM `category` WHERE 1";
		$adapter = new Adapter();
		$categorys = $adapter->fetchAll($sql);
		require_once 'view/category/grid.phtml';
	}
}

$page = $_GET['page'].'Action';

$category = new Category();
$category->$page();


?>