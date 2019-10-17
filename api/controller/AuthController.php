<?php
	$cible = isset($_GET['cible'])? $_GET['cible'] : "login";

	switch($cible){
		case 'login':{
			include 'models/auth/login.php';
			break;
		}
		case 'register':{
			include 'models/auth/register.php';
			break;
		}
	}

?>