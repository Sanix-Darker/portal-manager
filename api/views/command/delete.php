<?php 

	$result = array();
	$output = array();
	if(isset($_REQUEST['command_address'])){

		// Suppression
		$BD->from($element)
		    ->where(array('ADDRESS' => $_REQUEST['command_address']))
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