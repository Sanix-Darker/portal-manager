<?php

	/**
	 * CE ENDPOINT N'A PAS VRAIMENT SA PLACE !!!
	 */
	$result = array();
	$output = array();
	if($required && 1==0){

		$data = array();
		$data["MATRICULE"] = $json->address;
		$data["STATUS"] = $json->status;

		$where = array('MATRICULE' => $data["MATRICULE"]);

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

		$result['status'] = 'success';
		$result['output'] = $output;

	}else{
		$result['status'] = 'error';
		$result['output'] = "Please, check your entries";
	}
	echo json_encode($result);
?>