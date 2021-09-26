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
		<h1 class="login-header">Sign into your account</h1>
		<form action="" method="POST">
			<input type="text" name="email" placeholder="Email"><br>
			<input type="password" name="pass" placeholder="Password"><br>
			<label><input type="checkbox" name="loggedin" value="loggedin" class="checkbox">Keep me logged in</label><br>
			<button name="login">Login</button>
		</form>
	</div>
</body>
</html>

<?php
	include "../include/connection.php";
	
	
	if (isset($_SESSION['restaurantid']) || isset($_COOKIE['restaurantcookie']) || isset($_SESSION['userid']) || isset($_COOKIE['usercookie'])) {
		header("location: ../");
	}
	
	if (isset($_POST['login'])) {

		$pass=mysqli_real_escape_string($conn,$_POST['pass']);
		$email=mysqli_real_escape_string($conn,$_POST['email']);

		$query="SELECT * from customers where email='$email';";
		if ($conn->query($query)) {
			//storing the data in $result
			$result=$conn->query($query);

			//checking number of rows
			if ($result->num_rows==1) {
				$row=$result->fetch_assoc();

				//checking password
				$passCheck=password_verify($pass,$row['pass']);

				if ($passCheck==false) {
					echo "wrong password";
				}else{

					//setting up session and cookie
					
					$_SESSION['userid']=$row['id'];

					if (isset($_POST['loggedin'])) {
						setcookie('usercookie',$row['id'],time()+60*60*24*30,'/');
					}

					header("location: ../");
				}
			}else{
				echo "This email doesn't exist in our database";
			}
		}

	}
 