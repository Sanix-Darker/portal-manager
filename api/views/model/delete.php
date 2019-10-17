<?php 

	$result = array();
	$output = array();
	if(isset($_REQUEST[$element.'_id'])){

		// Suppression
		$BD->from($element)
		    ->where($element.'_id', $_REQUEST[$element.'_id'])
		    ->delete()
		    ->execute();

		$result['status'] = 'success';
		$result['output'] = 'deleted successfully';

	}else{
		$result['status'] = 'error';
		$result['output'] = "Please, check your entries";
	}

	echo json_encode($result);
?>