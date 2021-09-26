<?php
	
	include "../include/connection.php";
	session_start();

	if (!isset($_SESSION['userid']) && !isset($_COOKIE['usercookie'])) {
		echo "you are not logged in";
	}elseif (isset($_POST['add']) && isset($_GET['foodid'])) {
		$quantity=$_POST['quantity'];
		$foodid=$_GET['foodid'];
		$restaurantid=$_GET['restaurantid'];

		if (isset($_SESSION['userid'])) {
			$userid=$_SESSION['userid'];
		}elseif (isset($_COOKIE['usercookie'])) {
			$userid=$_COOKIE['usercookie'];
		}
		

		$query="INSERT into cart (foodId, customerId, quantity) values ($foodid,$userid,$quantity);";
		if ($conn->query($query)) {
			header("location: ../restaurant/?restaurantid=$restaurantid");
		}else{
			echo "you already ordered this food";
		}
	}  
	