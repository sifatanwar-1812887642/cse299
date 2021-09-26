<?php 

	include "include/connection.php";
	session_start();
	

	

?>




<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>FOODIE</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link href="https://fonts.googleapis.com/css?family=Lato:100,300,300i,400,700" rel="stylesheet">
</head>
<body>
	<header class="homeHeader">
		<div>
			<nav>
				<a href="./"><img src="css/images/logo3.png"></a>
				<ul>
					<li><a href="./">Home</a></li>
					<?php

						//only for restaurant owners
					 	if (isset($_SESSION['restaurantid']) || isset($_COOKIE['restaurantcookie'])) {
							echo "<li><a href='restaurant'>My Restaurant</a></li>";
							echo "<li><a href='restaurant/addfood.php'>Add Item</a></li>";
							echo "<li><a href='restaurant/orders.php'>Orders</a></li>";
							echo "<li><a href='include/logout.php'>Logout</a></li>";
						}elseif (isset($_SESSION['userid']) || isset($_COOKIE['usercookie'])) {
							echo "<li><a href='include/logout.php'>Logout</a></li>";
						}elseif (!isset($_SESSION['userid']) && !isset($_COOKIE['usercookie'])){
							echo "<li><a href='user/login.php'>Login</a></li>";
							echo "<li><a href='user/signup.php'>Sign up</a></li>";
						}
					?>
				</ul>
			</nav>
		</div>
		
		<!-- <a href="restaurant/signup.php">Sign up</a>
		<a href="restaurant/login.php">Login</a> -->
		
		<form class="searchbox" action="" method="post">
			<input type="text" name="searchbox" placeholder="Search Restaurants">
			<button type="submit" name="search">SEARCH</button>
		</form>
	</header>

	<div class="wrapper">
		<h2 class="restaurants">
			Restaurants
		</h2>
		<?php
			if (isset($_POST['search']) && !empty($_POST['searchbox'])) {
				$restaurantname=$_POST['searchbox'];
				$query="SELECT * from restaurants where name like '%$restaurantname%';";
			}else{
				$query="SELECT * from restaurants";
			}
				//selecting restaurants from database and showing in the landing page
				if ($conn->query($query)) {
					$result=$conn->query($query);
					

					while ($row=$result->fetch_assoc()) {
						$name=$row['name'];
						$restaurantid=$row['id'];
						$pic=$row['pic'];
						$address=$row['address'];
						echo "<a href='restaurant?restaurantid=$restaurantid'><div class='restaurantLandingPage'><img src='restaurant/img/$pic'><p><br>$name</p></div></a>";

					}
				}
		
			
		?>	
	</div>

</body>
</html>