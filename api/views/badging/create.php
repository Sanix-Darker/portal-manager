<?php

	$result = array();
	$output = array();
	if($required){

		$data["MATRICULE"] = $json->matricule;
		$data["INFO"] = $json->info;
		$data["STATUS"] =  $json->status;

		# delete and conserve a certain number of entries in a database
		$BD->sql('DELETE FROM `badging`
		WHERE BADGING_ID NOT IN (
		  SELECT BADGING_ID
		  FROM (
			SELECT BADGING_ID
			FROM `badging`
			ORDER BY BADGING_ID DESC
			LIMIT 2 -- keep this many records
		  ) foo
		)')->execute();

		// Insertion
		$BD->from($element)
		    ->insert($data)
		    ->execute();

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