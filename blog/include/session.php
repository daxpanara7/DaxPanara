<?php
session_start();
	echo "NAME :  ".$_SESSION['name'];
	echo "<br>";
	echo "ROLE :  ".$_SESSION['role'];
if (!isset($_SESSION['id'])) {
	header("Location: login.php?page=login");
}

?>