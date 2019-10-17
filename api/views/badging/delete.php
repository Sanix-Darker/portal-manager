<?php 

	$result = array();
	$output = array();
	if(isset($_REQUEST['badging_id'])){

		// Suppression
		$BD->from($element)
		    ->where(array('BADGING_ID' => $_REQUEST['badging_id']))
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