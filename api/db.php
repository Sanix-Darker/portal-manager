<?php 

	// Include the library
	include 'models/sparrow.php';

	// Declare the class instance
	$BD = new Sparrow();

	$online = false;

	// How to connect to a Database
	// mysql, mysqli, pgsql, sqlite and sqlite3
	// 
	// The connection string uses the following format:
	// type://username:password@hostname[:port]/database

	// For sqlite, you need to use:
	// type://database
	// 
	// $BD->setDb(array(
	//     'type' => 'mysql',
	//     'hostname' => 'localhost',
	//     'database' => 'mydb',
	//     'username' => 'admin',
	//     'password' => 'hunter2'
	// ));

	if($online){
		$baseURL = "http://intense-savannah-81233.herokuapp.com"; // offline $baseURL = "/Glorious_destiny"; // online $baseURL = "http://intense-savannah-81233.herokuapp.com";
		// Using the PDO:
		$PDO = new PDO('mysql:host=localhost;dbname=glorious', 'root', '');
	}else{
		$baseURL = "/"; // offline $baseURL = "/Glorious_destiny"; // online $baseURL = "http://intense-savannah-81233.herokuapp.com";
		// Using the PDO:
		$PDO = new PDO('mysql:host=localhost;dbname=database', 'root', 'root');

	}
	$BD->setDB($PDO);
?>