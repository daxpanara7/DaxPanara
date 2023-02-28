<?php
	require_once 'include/header.php';
	require_once 'include/Adapter.php';
	require_once 'include/session.php';


class Sub_category{


	public function addAction()
	{
		$sql = "SELECT * FROM `category` WHERE `parent_id` IS NULL";
		$adapter = new Adapter();
		$categorys = $adapter->fetchAll($sql);
		require_once 'view/Sub_category/add.phtml';
	}

	public function insertAction()
	{
		if(!isset($_POST['submit'])){
			throw new Exception(" Request deniad.", 1);			
		}
		// else $_session['role'] != admin; then  redirect
		if ($_SESSION['role'] == 'admin') {

		print_r($_POST);
		echo $sub_category = $_POST['sub_category'];
		$category = $_POST['category'];
		$status = $_POST['status'];

		$sql = "INSERT INTO `category` (`parent_id`,`name`,`status`,`created_at`)
		VALUE('$category','$sub_category','$status', now())";

		$adapter = new Adapter();
		$result = $adapter->insert($sql);
		}
		header("Location: Sub_category.php?page=grid");
	}

	public function gridAction()
	{	

		
		$sql = "SELECT * FROM `category` WHERE `parent_id` IS NOT NULL";
		$adapter = new Adapter();
		$sub_categorys = $adapter->fetchAll($sql);
		require_once 'view/sub_category/grid.phtml';
	}

}

$page = $_GET['page'].'Action';

$subCategory = new Sub_category();
$subCategory->$page();


?>