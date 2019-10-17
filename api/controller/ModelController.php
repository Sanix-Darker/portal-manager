<?php

// SELECT `player_id`, `user_id`, `position`, `goals`, `height`, `weight`, `nickname`, `club_id` FROM `player` WHERE 1

	$cible = isset($_GET['cible'])? $_GET['cible'] : "load";

	$element = $ctrl;
	switch($cible){
		case 'load':{
			include 'views/'.$ctrl.'/load.php';
			break;
		}
		default:{
			// load a specifik element
			if(is_numeric($cible)){
				$_REQUEST['id'] = $cible;
				include 'views/'.$ctrl.'/load.php';
			}else{

				if (isset($_REQUEST['token'])){

					$id_user = getUserByToken($_REQUEST['token']);

					if($id_user==0){
						return_RESPONSE('not_auth');
					}
					else {

						if($cible == 'create'){
							//required value
							$required = isset($_REQUEST['model_name']);
							// Data initialisation
							$data = array(
								'model_name' => utf8_encode($_REQUEST['model_name'])
							);
							include 'views/'.$ctrl.'/create.php';
						}else if($cible == 'update'){

							if(checkUserConcern($id_user, $element, $_REQUEST['model_id'])){
								$required = isset($_REQUEST['model_id']);
								// Data initialisation
								$data = array(
									'model_name' => utf8_encode($_REQUEST['model_name'])
								);
								$where = array('model_id' => $_REQUEST['model_id']);
								include 'views/'.$ctrl.'/update.php';
							}else{
								return_RESPONSE('not_auth');
							}

						}else if($cible == 'delete'){

							if(checkUserConcern($id_user, $element, $_REQUEST['model_id'])){
								include 'views/'.$ctrl.'/delete.php';
							}else{
								return_RESPONSE('not_auth');
							}

						}else{
							return_RESPONSE('bad_params');
						}
					}
				}else{
					return_RESPONSE('not_auth');
				}
			}
			break;
		}
	}

?>