<?php
	session_start();
	
	if(!isset($_SESSION['id'])){
		header("Location: login.php");
	}

	$item_name = $_GET['item_name'];
	//echo $item_name;

	unset($_SESSION["$item_name"]);
	
	header("Location: index.php");
?>