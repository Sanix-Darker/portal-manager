<?php

	$result = array();
	$output = array();

	// Specific ID
	if(isset($_REQUEST[$element.'_id'])){

		$rows = $BD->from($element)
			->where(array($element.'_id' => $_REQUEST[$element.'_id']))
			->select()
			->one();

		foreach ($rows as $key => $val)
		  if (!is_int($key))
		    $output[$key]=$rows[$key];
	}
	// Any ID
	else{
		$rows = $BD->from($element)
			->select()
			->many();

		for ($i=0; $i < sizeof($rows); $i++)
			$output[]=$rows[$i];
	}

	$result['result'] = $output;
	echo json_encode($result);
?>