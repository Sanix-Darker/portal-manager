<?php 
	$result = array();
	$output = array();
	if(isset($_REQUEST['user_name']) AND 
		isset($_REQUEST['user_email']) AND 
		isset($_REQUEST['user_phone']) AND 
		isset($_REQUEST['user_gender']) AND 
		isset($_REQUEST['user_age']) AND 
		isset($_REQUEST['country_name']) AND 
		isset($_REQUEST['user_password']) ){

			// Data initialisation
			$data = array('user_name' => utf8_encode($_REQUEST['user_name']), 
							'user_email' => utf8_encode($_REQUEST['user_email']),
							'user_phone' => utf8_encode($_REQUEST['user_phone']),
							'user_gender' => utf8_encode($_REQUEST['user_gender']),
							'user_age' => intval($_REQUEST['user_age']),
							'country_name' => utf8_encode($_REQUEST['country_name']),
							'user_password' => utf8_encode($_REQUEST['country_name'])
						);
			// Insertion
			$BD->from('user')
			    ->insert($data)
			    ->execute();

			$lastId = $BD->insert_id;

			if($lastId>0){

				$token = getToken(100);

				$res = $BD->from('user')
				    ->where(array('user_id' => $lastId))
				    ->select()
				    ->many();

				$sql_1 = $BD->from('access_token')
				    ->where(array('ID_USER' => $lastId))
				    ->select()
				    ->many();

				if(sizeof($sql_1)>0){

					$BD->from('access_token')
					    ->where(array('ID_USER' => $lastId))
					    ->update(array('TOKEN' => $token))
					    ->execute();

				}else{

					$BD->from('access_token')
					    ->insert(array('ID_USER' => $lastId, 'TOKEN' => $token))
					    ->execute();

				}

				$result['status'] = "success";
				$result['register'] = "success";
				$result['token'] = $token;

				foreach ($res[0] as $key => $val) {
				  if (!is_int($key)) {
				    $output[$key]=$res[0][$key];
				  }
				}

				$result['user'] = $output;

			}else{
				$result['status'] = 'success';
				$result['register'] = "error";
			}

	}else{
			$result['status'] = 'error';
			$result['register'] = "Please, check your entries";
	}
	echo json_encode($result);
?>