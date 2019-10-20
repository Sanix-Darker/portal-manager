<?php

	$result = array();
	$output = array();
	if($required){

		$data = array();
		$data["ADDRESS"] = $json->address;
		$data["STATUS"] = $json->status;

		$where = array('ADDRESS' => $data["ADDRESS"]);


		if(isset($_REQUEST['board'])){
			$data["TODO"] = ($json->status == "OK")? "activate":"deactivate";
			$data["ADDRESS"] = $json->address;
			$data["STATUS"] = "NOK";
		}

		// On check d'abord si xa existe

		// Si Non on creait
		$rows = $BD->from($element)
			->where($where)
			->select()
			->one();
		if(sizeof($rows) == 0){
			// Insertion
			$BD->from($element)
				->insert($data)
				->execute();
		}

		// Si oui on update juste
		// Update
		$BD->from($element)
		    ->where($where)
		    ->update($data)
		    ->execute();

		$rows = $BD->from($element)
			->where($where)
			->select()
			->one();

		foreach ($rows as $key => $val)
		  if (!is_int($key))
		    $output[$key]=$rows[$key];

		$result['status'] = 'error';
		if(sizeof($output) > 0)
			$result['status'] = 'success';

		$result['output'] = $output;

	}else{
		$result['status'] = 'error';
		$result['output'] = "Please, check your entries";
	}
	echo json_encode($result);
?>