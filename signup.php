<!DOCTYPE html>
<html class="signupbody">
<head>
	<meta charset="utf-8">
	<title>FOODIE</title>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<link href="https://fonts.googleapis.com/css?family=Lato:100,300,300i,400,700" rel="stylesheet">
</head>
<body>
	<header>
		<div class="wrapper">
			<nav>
				<a href="../"><img src="../css/images/logo3.png"></a>
				<ul>
					<li><a href="../">Home</a></li>
					<?php
						session_start();
						
					 	if (isset($_SESSION['restaurantid']) || isset($_COOKIE['restaurantcookie'])) {
					 		//only for restaurant owners
							echo "<li><a href='../restaurant'>My Restaurant</a></li>";
							echo "<li><a href='../restaurant/addfood.php'>Add Item</a></li>";
							echo "<li><a href='logout.php'>Logout</a></li>";
						}elseif (isset($_SESSION['userid']) || isset($_COOKIE['usercookie'])) {
							echo "<li><a href='#'>My Info</a></li>";
							echo "<li><a href='logout.php'>Logout</a></li>";
						}elseif (!isset($_SESSION['userid']) && !isset($_COOKIE['usercookie'])){
							echo "<li><a href='../user/login.php'>Login</a></li>";
							echo "<li><a href='../user/signup.php'>Sign up</a></li>";
						}
					?>
				</ul>
			</nav>
		</div>
	</header>
	<div class="signup">
		<div class="userSignup"><h1>Sign up</h1></div>
		<form action="" method="POST">
			<input type="text" name="name" placeholder="Name" required><br>
			<input type="email" name="email" placeholder="Email" required><br>
			<input type="password" name="pass" placeholder="New password" required><br>
			<input type="text" name="phone" placeholder="Phone number" required><br>
			<input type="text" name="address" placeholder="Address" required><br>
			<button name="signup">Sign up</button>
		</form>
	</div>
</body>
</html>

<?php
	
	include "../include/connection.php";

	
	if (isset($_SESSION['restaurantid']) || isset($_COOKIE['restaurantcookie']) || isset($_SESSION['userid']) || isset($_COOKIE['usercookie'])) {
		header("location: ../");
	}

	if (isset($_POST['signup'])) {
		$name=mysqli_real_escape_string($conn,$_POST['name']);
		$email=mysqli_real_escape_string($conn,$_POST['email']);
		$pass=mysqli_real_escape_string($conn,$_POST['pass']);
		$phone=mysqli_real_escape_string($conn,$_POST['phone']);
		$address=mysqli_real_escape_string($conn,$_POST['address']);
		$hpass=password_hash("$pass",PASSWORD_DEFAULT);
		
		if (!empty($name) || !empty($email) || !empty($pass) || !empty($phone) || !empty($address)) {
			//inserting data into restaurants table
			$query="INSERT into customers (name,email,phone,pass,address) values ('$name','$email',$phone,'$hpass','$address');";

			if ($conn->query($query)) {
				header("location: ../");
			}
		}
	}
 
