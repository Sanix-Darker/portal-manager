<?php

	$cible = isset($_GET['cible'])? $_GET['cible'] : "load";

	switch($cible){
		case 'send':{
			include 'views/'.$ctrl.'/send.php';
			break;
		}
		default :{
			$result = array();
			$result['status'] = 'error';
			$result['reason'] = "Bad paramters";	
			echo json_encode($result);
			break;
		}
	}

?>