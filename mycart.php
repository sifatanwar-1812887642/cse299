<?php
	include "../include/connection.php";
	include_once "../include/nav.php";

	if (!isset($_SESSION['userid']) && !isset($_COOKIE['usercookie'])) {
		echo "you are not logged in";
	}elseif (isset($_SESSION['userid']) || isset($_COOKIE['usercookie'])) {
		$restaurantid=$_GET['restaurantid'];
		if (isset($_SESSION['userid'])) {
			$userid=$_SESSION['userid'];
		}elseif (isset($_COOKIE['usercookie'])) {
			$userid=$_COOKIE['usercookie'];
		}

		//if checkout is pressed
		if (isset($_GET['desc'])) {
			$desc=$_GET['desc'];

			//inserting values in order table
			$query="INSERT into orders (restaurantid,userid,orderdesc) values ($restaurantid,$userid,'$desc');";
			if ($conn->query($query)) {
				//deleting data from cart
				$query="DELETE from cart where customerId=$userid;";
				if ($conn->query($query)) {
					header("location: ../");
				}
				
			}
		}

		$query="SELECT * from cart as c,food as f where c.customerId=$userid and c.foodId=f.id and f.restaurantId=$restaurantid;";
		if ($conn->query($query)) {
			$result=$conn->query($query);
			$total=0;
			$i=1;
			$desc="";
			?>
			<div class="wrapper">
				<?php
					while ($row=$result->fetch_assoc()) {
						$name=$row['name'];
						$quantity=$row['quantity'];
						$price=$row['price']*$quantity;
						$total+=$price;
						$desc= $desc."$i."." $name ".   "<br>qty: ".$quantity   ."<br>price: ".$price." tk<br><br>"; 
						$i++;
					}
					$desc=$desc. "Total: $total";
					echo "$desc<br><br>";
		}
	}
	if (isset($_SESSION['userid']) || isset($_COOKIE['usercookie'])) {
		echo "<a href='mycart.php?desc=$desc&restaurantid=$restaurantid'>Checkout</a>";
	}

?>
	 			
			</div>
			