<?php

	header('Access-Control-Allow-Origin: *');
	header('Access-Control-Allow-Methods: GET, POST');
	header("Access-Control-Allow-Headers: X-Requested-With");

    header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1 
    header("Cache-Control: post-check=0, pre-check=0", false); 
    header("Cache-Control: private");
    header("Pragma: no-cache");
    header('Content-Type:text/json; Charset=UTF-8');

	ob_start();
	session_start();
	require("db.php");
	define("BASEURL", $baseURL."/api/");

	$query = array();
	$parts = parse_url($_SERVER["REQUEST_URI"]);

	if(isset($parts['query'])){
		parse_str($parts['query'], $query);
		if(isset($query) && count($query)>0)
			foreach ($query as $key => $value)
				$_REQUEST[$key] = $value;
	}

	$ctrl = "home"; // Page de connexion par défaut
	$defautColor = "#61b47c";
	// Par défaut on affiche le TABLEAU DE BORD
	if(isset($_REQUEST['page']) ){
		$ctrl = $_REQUEST['page'];
	}

	require_once("fonctions.php");    // Chargement des fonction de base
	include 'models/classes.php';

	if (isset($_REQUEST['token'])){

		$id_user = getUserByToken($_REQUEST['token']);

		if($id_user==0){
			$result = array();
			$result['status'] = "error";
			$result['token'] = $_REQUEST['token'];
			$result['post'] = $_POST;
			$result['reason'] = "Non authorisé";
			echo json_encode($result);
		}
		else {
			switch($ctrl){

				case 'mail':{
					include("controller/MailController.php");
					break;
				}
				case 'command':{
					include("controller/CommandController.php");
					break;
				}
				case 'badging':{
					include("controller/BadgingController.php");
					break;
				}
				default:{
					$result = array();
					$result['status'] = "error";
					$result['reason'] = "404";
					echo json_encode($result);
				}
			}
		}
	}
	else if($ctrl=='model'){
		include("controller/ModelController.php");
	}
	else if($ctrl=='auth'){
		include("controller/AuthController.php");
	}
	else if($ctrl=='db'){
		header('Location: models/db/manager/phpliteadmin.php');
	}
	else{
		$result = array();
		$result['status'] = "error";
		$result['reason'] = "Any parameters send";
		echo json_encode($result);
	}
	ob_end_flush();
?>