<?php

	session_start();
	session_destroy();
	setcookie('restaurantcookie','',-3600,'/');
	setcookie('usercookie','',-3600,'/');
	header("location: ../");
