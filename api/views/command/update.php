<?php

	$result = array();
	$output = array();
	if($required){

		$data = array();
		$data["ADDRESS"] = $json->address;
		$data["STATUS"] = $json->status;

		$where = array('ADDRESS' => $data["ADDRESS"]);

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