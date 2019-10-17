 <?php 
 	$result = array();

 	if(isset($_REQUEST['user_phone']) && isset($_REQUEST['user_password'])){

		$sql = $BD->from('user')
			->where('(user_phone = "'.$_REQUEST['user_phone'].'"')
			->where(' OR user_email = "'.$_REQUEST['user_phone'].'")')
			->where(' AND user_password = "'.$_REQUEST['user_password'].'"')
		    ->select()
		    ->one();

		if(sizeof($sql)>0){

			$token = getToken(100);

			$sql_1 = $BD->from('access_token')
			    ->where(array('ID_USER' => $sql['user_id']))
			    ->select()
				->many();

			if(sizeof($sql_1)>0){
				$BD->from('access_token')
				    ->where(array('ID_USER' => $sql['user_id']))
				    ->update(array('TOKEN' => $token))
				    ->execute();
			}else{
				$BD->from('access_token')
				    ->insert(array('ID_USER' => $sql['user_id'], 'TOKEN' => $token))
				    ->execute();
			}

			foreach ($sql as $key => $val)
			  if (!is_int($key))
			    $output[$key]=$sql[$key];

			$result['status'] = "success";
			$result['login'] = "success";
			$result['token'] = $token;
			$result['user'] = $output;

		}
		else {
			$result['status'] = 'success';
			$result['login'] = "error";
		}

 	}
 	else {
		$result['status'] = 'error';
		$result['reason'] = "Paramètres incorrects";
 	}

 	echo json_encode($result);
 ?>