<?php 

	$host="localhost";
	$user="root";
	$pass="";
	$dbname="orderfood";

	$conn=new mysqli($host,$user,$pass,$dbname);

	if ($conn->connect_error) {
		echo "connection fail";
		die($conn->connect_error);
	}
