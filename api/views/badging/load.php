<?php

	$result = array();
	$output = array();

	// Specific ID
	if(isset($_REQUEST['command_address'])){

		$rows = $BD->from($element)
			->where(array('ADDRESS' => $_REQUEST['command_address']))
			->select()
			->one();

		foreach ($rows as $key => $val)
		  if (!is_int($key))
		    $output[$key]=$rows[$key];
	}
	// Any ID
	else{
		$rows = $BD->from($element)
			->sortDesc('BADGING_ID')
			->select()
			->many();

		for ($i=0; $i < sizeof($rows); $i++)
			$output[]=$rows[$i];
	}

	$result['result'] = $output;
	echo json_encode($result);
?>