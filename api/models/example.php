<?php 

	// Include the library
	include 'sparrow.php';

	// Declare the class instance
	$db = new Sparrow();


	// How to connect to a Database
	// mysql, mysqli, pgsql, sqlite and sqlite3
	// 
	// The connection string uses the following format:
	// type://username:password@hostname[:port]/database

	// For sqlite, you need to use:
	// type://database
	// 
	// $db->setDb(array(
	//     'type' => 'mysql',
	//     'hostname' => 'localhost',
	//     'database' => 'mydb',
	//     'username' => 'admin',
	//     'password' => 'hunter2'
	// ));

	// Using the PDO:
	$pdo = new PDO('mysql:host=localhost;dbname=sparrow', 'root', '');
	$db->setDb($pdo);


	// Select *
	echo $db->from('user')
			->select()
			->sql();
	echo "<hr>";


	// Select avec le Where qui peut etre a plusieurs etapes
	echo $db->from('user')
	    ->where('id', 123)
	    ->where('name', 'maggie')
	    ->select()
	    ->sql();
	echo "<hr>";

	// Select avec un where en passant un tableau
	$where = array('id' => 123, 'name' => 'bob');
	echo $db->from('user')
	    ->where($where)
	    ->select()
	    ->sql();
	echo "<hr>";

	// Autres Cas: 
	echo $db->from('user')
	    ->where('id = 99')
	    ->where('Cardid >', 78)
	    ->select()
	    ->sql();
	echo "<hr>";

	// Pour le OR 
	// SELECT * FROM user WHERE id < 10 OR id > 20
	echo $db->from('user')
	    ->where('id <', 10)
	    ->where('|id >', 20)
	    ->select()
	    ->sql();
	echo "<hr>";


	// LIKE
	// SELECT * FROM user WHERE name LIKE '%bob%'
	echo $db->from('user')
	    ->where('name %', '%bob%')
	    ->select()
	    ->sql();
	echo "<hr>";


	// NOT LIKE
	echo $db->from('user')
	    ->where('name !%', '%bob%')
	    ->select()
	    ->sql();
	echo "<hr>";


	// IN
	// SELECT * FROM user WHERE id IN (10, 20, 30)
	echo $db->from('user')
	    ->where('id @', array(10, 20, 30))
	    ->select()
	    ->sql();
	echo "<hr>";

	// NOT IN
	echo $db->from('user')
	    ->where('id !@', array(10, 20, 30))
	    ->select()
	    ->sql();
	echo "<hr>";


	// SELECT SPECIFICs Fields
	echo $db->from('user')
	    ->select(array('id','name'))
	    ->sql();
	// SELECT id, name FROM user
	echo "<hr>";

	

	// LIMIT AND OFFSET
	echo $db->from('user')
	    ->limit(10)
	    ->offset(20)
	    ->select()
	    ->sql();
	//SELECT * FROM user LIMIT 10 OFFSET 20
	echo "<hr>";

	// OR
	echo $db->from('user')
	    ->select('*', 50, 10)
	    ->sql();
	//SELECT * FROM user LIMIT 50 OFFSET 10
	echo "<hr>";

	
	// Distinct
	echo $db->from('user')
	    ->distinct()
	    ->select('name')
	    ->sql();
	echo "<hr>";

	// Jointures
	echo $db->from('user')
	    ->join('role', array('role.id' => 'user.id'))
	    ->select()
	    ->sql();
	echo "<hr>";


	// Sorting ASC / DESC
	echo $db->from('user')
	    ->sortDesc('id') // ->sortAsc('id')
	    ->select()
	    ->sql();
	echo "<hr>";

	// Insert
	$data = array('id' => 123, 'name' => 'bob');
	echo $db->from('user')
	    ->insert($data)
	    ->sql();
	echo "<hr>";

	// Update
	$data = array('name' => 'bob', 'email' => 'bob@aol.com');
	$where = array('id' => 123);
	echo $db->from('user')
	    ->where($where)
	    ->update($data)
	    ->sql();
	echo "<hr>";


	// Delete
	echo $db->from('user')
	    ->where('id', 123)
	    ->delete()
	    ->sql();
	echo "<hr>";


	// Fetching records
	// To fetch multiple records, use the many function.
	$rows = $db->from('user')
	    ->where('id >', 100)
	    ->many();
	//The result returned is an array of associative arrays:
		// array(
		//     array('id' => 101, 'name' => 'joe'),
		//     array('id' => 102, 'name' => 'ted');
		// )

	//To fetch a single record, use the one function.
	$row = $db->from('user')
	    ->where('id', 123)
	    ->one();
	//The result returned is a single associative array:

	//array('id' => 123, 'name' => 'bob')
	//To fetch the value of a column, use the value function and pass in the name of the column.
	$username = $db->from('user')
	    ->where('id', 123)
	    ->value('username');
	//All the fetch functions automatically perform a select, so you don't need to include the select function unless you want to specify the fields to return.

	$row = $db->from('user')
	    ->where('id', 123)
	    ->select(array('id', 'name'))
	    ->one();


	// Non Queries: INSERT, UPDATE, DELETE
	$db->from('user')
	    ->where('id', 123)
	    ->delete()
	    ->execute();

	// Just add execute at the end of the query



	// Custom Queries
	// You can also run raw SQL by passing it to the sql function.
	$posts = $db->sql('SELECT * FROM posts')->many();
	$user = $db->sql('SELECT * FROM user WHERE id = 123')->one();
	$db->sql('UPDATE user SET name = "bob" WHERE id = 1')->execute();

?>