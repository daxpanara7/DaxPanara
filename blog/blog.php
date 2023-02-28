<?php
require_once 'include/header.php';
require_once 'include/Adapter.php';
require_once 'include/session.php';


class Blog{

	public function cat_selectAction()
	{

		$sql = "SELECT * FROM `category` WHERE `parent_id` IS NULL";
		$adapter = new Adapter();
		$categorys = $adapter->fetchAll($sql);
		require_once 'view/blog/cat_select.phtml';
	}
	
	public function addAction()
		{
			if (!isset($_POST['submit'])) {
				 throw new Exception(" Request deniad.", 1);				
			}
			$title = $_POST['title'];	
			$category_id = $_POST['category_id'];
			$sql = "SELECT * FROM `category` WHERE `parent_id` = '$category_id'";
			$sql = "SELECT * FROM `category` WHERE 1";


			$adapter = new Adapter();
			$sub_categorys = $adapter->fetchAll($sql);
			require_once 'view/blog/add.phtml';
		}	


	public function insertAction()
		{
			$file = $_FILES['file']['name']; 		
			$fileTemp = $_FILES['file']['tmp_name'];
			move_uploaded_file($fileTemp, 'view/blog/media/'.$file ); 

			$blog = $_POST['blog'];

			// print_r($blog);

			// echo $category = $blog[category_id];
			// echo $sub_category = $blog[sub_category];
			
			$sql = "INSERT INTO `post`(`user_id`, `title`, `discription`, `image`, `status`, `category`, `sub_category`, `created_at`) VALUES ('$blog[user_id]','$blog[title]','$blog[description]','$file','$blog[status]','$blog[category_id]','$blog[sub_category]',now())";

			$adapter = new Adapter();
			$adapter->insert($sql);
			header("Location: blog.php?page=grid");

		}

	public function gridAction()
		{	
			if ($_SESSION['role'] == 'admin')
			{
			$sql = "SELECT * FROM `post`";
			$adapter = new Adapter();
			$blogs = $adapter->fetchAll($sql);
			}
			else{
			$sql = "SELECT * FROM `post` WHERE `user_id` = '{$_SESSION['id']}'";
			$adapter = new Adapter();
			$blogs = $adapter->fetchAll($sql);
			}

			require_once 'view/blog/grid.phtml';
		}	
}

$page = $_GET['page'].'Action';

$blog = new Blog();
$blog->$page();

?>