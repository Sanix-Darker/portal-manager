<?php

	$result = array();
	$output = array();
	if($required){

		$data["TODO"] = $json->todo;
		$data["ADDRESS"] = $json->address;
		$data["STATUS"] = "NOK";

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

		$rows = $BD->from($element)
			->where(array($element.'_id' => $BD->insert_id))
			->select()
			->one();

		foreach ($rows as $key => $val)
		  if (!is_int($key))
		    $output[$key]=$rows[$key];

		$result['status'] = 'success';
		$result['output'] = $output;

	}else{
		$result['status'] = 'error';
		$result['output'] = "Please, check your entries";
	}

	echo json_encode($result);
?>