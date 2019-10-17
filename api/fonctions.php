<?php
/**
 *
 * -----------------------------------------------------
 * |  ___| | | | \ | |/ ___|_   _|_ _/ _ \| \ | / ___|
 * | |_  | | | |  \| | |     | |  | | | | |  \| \___ \
 * |  _| | |_| | |\  | |___  | |  | | |_| | |\  |___) |
 * |_|    \___/|_| \_|\____| |_| |___\___/|_| \_|____/
 * -----------------------------------------------------
 *
 */

	function size($taille,$dim){if(strlen($taille)>$dim){$ref='...';}else{$ref='';}return $ref;}
	function pp($char,$size){return substr($char,0,$size).size($char,$size);}
	function s($tr){return str_replace("\'","'",htmlspecialchars($tr));}
	function sa($tr){return str_replace("'","\'",htmlspecialchars($tr));}
	function a($mot){return Addslashes($mot);}
	function i($chiff){return intval($chiff);}
	function r($a,$b,$char){return s(str_replace($a,$b,$char));}

	function return_RESPONSE($status){
		$result = array();
		$result['status'] = "error";
		if($status == "not_auth"){
			$result['reason'] = "Not authorize";
		}else if($status == "bad_params"){
			$result['reason'] = "Bad parameters";	
		}
		echo json_encode($result);
	}

	function checkUserConcern($user_id, $element, $element_id){

		$rows = $BD->from($element)
			->where(array($element.'_id' => $element_id, 'user_id' => $user_id))
			->select()
			->one();
		if(sizeof($rows)>0){
			return true;
		}else{
			return false;
		}
	}

  function format_date($date){
    $utc = new DateTime($date, new DateTimeZone('UTC'));
    $utc->setTimezone(new DateTimeZone('Africa/Douala'));
    if($_SESSION['lang']=='fr')
    	return $utc->format('d/m/Y à H:i:s');
    else
    	return $utc->format('d/m/Y H:i:s');
}
  function format_dateToTime($date){
    $utc = new DateTime($date, new DateTimeZone('UTC'));
    $utc->setTimezone(new DateTimeZone('Africa/Douala'));
    return $utc->format('H:i');}
  function customformat_date($date){
    $utc = new DateTime($date, new DateTimeZone('UTC'));
    $utc->setTimezone(new DateTimeZone('Africa/Douala'));
    return $utc->format('d-F-Y à H:i:s');}
  function format_dateDate($date){
    $utc = new DateTime($date, new DateTimeZone('UTC'));
    $utc->setTimezone(new DateTimeZone('Africa/Douala'));
    return $utc->format('d/m/Y');}
	function getConvertFileSize($path){
    $bytes = sprintf('%u', filesize($path));

    if ($bytes > 0)
    {
        $unit = intval(log($bytes, 1024));
        $units = array('B', 'KB', 'MB', 'GB');

        if (array_key_exists($unit, $units) === true)
        {
            return sprintf('%d %s', $bytes / pow(1024, $unit), $units[$unit]);
        }
    }

    return $bytes;
}
function getTagExpression( $str) {
    preg_match('/#(.*?)Z/', $str, $matches);
    return $matches;
}
function getTagValues($tag, $str) {
    $re = sprintf("/\{(%s)\}(.+?)\{\/\\1\}/", preg_quote($tag));
    preg_match_all($re, $str, $matches);
    return $matches[2];
}
function getRelativeTime($date) { //Mon incroyable Fonction de Date
   // Déduction de la date donnée à la date actuelle

  $utc = new DateTime($date, new DateTimeZone('Africa/Douala'));
  $utc->setTimezone(new DateTimeZone('Africa/Douala'));
  $date = $utc->format('Y-m-d H:i:s');
  
  $diff = time() - strtotime($date);
  if($diff == 0) {
      return 'maintenant';
  } elseif($diff > 0) {
      $day_diff = floor($diff / 86400);
      if($day_diff == 0) {
          if($diff < 60) return 'il y\'a un instant';
          if($diff < 120) return 'il y\'a une minute';
          if($diff < 3600) return 'il y\'a '.floor($diff / 60) . ' minutes';
          if($diff < 7200) return 'il y\'a une heure';
          if($diff < 86400) return 'il y\'a '.floor($diff / 3600) . ' heures';
      }
      if($day_diff == 1) { return 'Hier'; }
      if($day_diff < 7) { return 'il y\'a '.$day_diff . ' jours'; }
      if($day_diff < 31) { return 'il y\'a '.ceil($day_diff / 7) . ' semaines'; }
      if($day_diff < 60) { return 'le mois passé'; }
      return date('F Y', $ts);
  } else {
      $diff = abs($diff);
      $day_diff = floor($diff / 86400);
      if($day_diff == 0) {
          if($diff < 120) { return 'dans une minute'; }
          if($diff < 3600) { return 'dans ' . floor($diff / 60) . ' minutes'; }
          if($diff < 7200) { return 'dans une heure'; }
          if($diff < 86400) { return 'dans ' . floor($diff / 3600) . ' heures'; }
      }
      if($day_diff == 1) { return 'Demain'; }
      if($day_diff < 4) { return date('l', $ts); }
      if($day_diff < 7 + (7 - date('w'))) { return 'La semaine prochaine'; }
      if(ceil($day_diff / 7) < 4) { return 'dans ' . ceil($day_diff / 7) . ' semaines'; }
      if(date('n', $ts) == date('n') + 1) { return 'le mois prochain'; }
      return date('F Y', $ts);
  }

}



function getRelativeDayes($date) { //Mon incroyable Fonction de Date
   // Déduction de la date donnée à la date actuelle

  $utc = new DateTime($date, new DateTimeZone('Africa/Douala'));
  $utc->setTimezone(new DateTimeZone('Africa/Douala'));
  $date = $utc->format('Y-m-d H:i:s');
  
  $diff = time() - strtotime($date);
  if($diff == 0) {
      return 'maintenant';
  } elseif($diff > 0) {
      $day_diff = floor($diff / 86400);
      if($day_diff == 0) {
          if($diff < 60) return 'il y\'a un instant';
          if($diff < 120) return 'il y\'a une minute';
          if($diff < 3600) return 'il y\'a '.floor($diff / 60) . ' minutes';
          if($diff < 7200) return 'il y\'a une heure';
          if($diff < 86400) return 'il y\'a '.floor($diff / 3600) . ' heures';
      }
      if($day_diff == 1) { return 'Hier'; }
      if($day_diff < 7) { return 'il y\'a '.$day_diff . ' jours'; }
      if($day_diff < 31) { return 'il y\'a '.ceil($day_diff / 7) . ' semaines'; }
      if($day_diff < 60) { return 'le mois passé'; }
      return date('F Y', $ts);
  } else {
      $diff = abs($diff);
      $day_diff = floor($diff / 86400);
      if($day_diff == 0) {
          if($diff < 120) { return 'dans une minute'; }
          if($diff < 3600) { return 'dans ' . floor($diff / 60) . ' minutes'; }
          if($diff < 7200) { return 'dans une heure'; }
          if($diff < 86400) { return 'dans ' . floor($diff / 3600) . ' heures'; }
      }
      if($day_diff == 1) { return 'Demain'; }
      if($day_diff < 4) { return date('l', $ts); }
      if($day_diff < 7 + (7 - date('w'))) { return 'La semaine prochaine'; }
      if(ceil($day_diff / 7) < 4) { return 'dans ' . ceil($day_diff / 7) . ' semaines'; }
      if(date('n', $ts) == date('n') + 1) { return 'le mois prochain'; }
      return date('F Y', $ts);
  }

}


// Code concernant les notifications, petite doc!
// $BD : Juste pour appeller la base de donnees
// $id : c'est l'id de celui ki commet l'action
// $id2 : c'est l'id de celui ki rexoit l'action( groupe, communautee, user,)
// $id_element : est l'id de l'element concerner en question
// action : est l'action en kestion (publier, aimer, commenter, partager, recommenter)
// type_id2 : le type de l'id2( groupe, communaute, user)
// type_element : ( publication, evenement, commentaire(reponse au commentaire), communautee, groupe,...)
  function MakeUrls($str){
    $find=array('`((?:https?|ftp)://\S+[[:alnum:]]/?)`si','`((?<!//)(www\.\S+[[:alnum:]]/?))`si');

    $replace=array('<a href="$1" target="_blank">$1</a>', '<a href="http://$1" target="_blank">$1</a>');

    return preg_replace($find,$replace,$str);
  }

  function format_date3($date){

    $date=explode('-',(explode(' ', $date)[0]));
    $annee=$date[0]; $jour=$date[2]; $mois=$date[1];
    $listemois= array('','Jan','Fev','Mars','Avr','Mai','Juin','Juil','Août','Sept','Oct','Nov','Dec');
    $newmois=$listemois[($mois+0)];
    return $jour." ".$newmois." ".$annee;

  }

  function format_dateHour($date1){

    $date=explode('-',(explode(' ', $date1)[0]));
    $heure=explode(' ', $date1)[1];
    $annee=$date[0]; $jour=$date[2]; $mois=$date[1];
    $listemois= array('','Jan','Fev','Mars','Avr','Mai','Juin','Juil','Août','Sept','Oct','Nov','Dec');
    $newmois=$listemois[($mois+0)];
    return $jour." ".$newmois." ".$annee." à ".$heure;

  }
  
	function getJourSemaine($i){
		switch ($i) {
			case '1':
				return 'Lundi';
				break;
			case '2':
				return 'Mardi';
				break;
			case '3':
				return 'Mercredi';
				break;
			case '4':
				return 'Jeudi';
				break;
			case '5':
				return 'Vendredi';
				break;
			case '6':
				return 'Samedi';
				break;
			case '7':
				return 'Dimanche';
				break;
			
			default:
				return '';
				break;
		}
	}

	function getTVA(){
		global $BD;
		
	}
	function getTypeClient($types){
		$tabs = explode(",", $types);
		$res  = array();
		for ($i=0; $i < count($tabs); $i++) { 
			if($tabs[$i]=='assure')
				$res[] = LIBELLE_ASSURE;
			if($tabs[$i]=='fronteur')
				$res[] = LIBELLE_FRONTEUR;
			if($tabs[$i]=='groupe')
				$res[] = LIBELLE_CLIENT_G;
			if($tabs[$i]=='clientl')
				$res[] = LIBELLE_CLIENT_L;
			if($tabs[$i]=='clienti')
				$res[] = LIBELLE_CLIENT_I;
			if($tabs[$i]=='banque')
				$res[] = LIBELLE_BANQUE;
			if($tabs[$i]=='tiers')
				$res[] = LIBELLE_TIERS;
		}

		return implode(", ", $res);
	}
	function buildPieceJointeSuivi($period, $frequence, $action = "validation", $id){
		return '<a class="load '.$action.'" data-type="suivi" data-periode="'.$period.'" data-frequence="'.$frequence.'" data-id="'.$id.'" href="javascript:">'.LIBELLE_VOIR_PIECEJOINTE.'</a>';
	}

	function getBaseUrl(){
		$base_dir = __DIR__;

		// server protocol
		$protocol = empty($_SERVER['HTTPS']) ? 'http' : 'https';

		// domain name
		$domain = $_SERVER['SERVER_NAME'];

		// server port
		$port = $_SERVER['SERVER_PORT'];
		$disp_port = ($protocol == 'http' && $port == 80 || $protocol == 'https' && $port == 443) ? '' : ":$port";

		// put em all together to get the complete base URL
		$url = "${protocol}://${domain}${disp_port}".BASEURL;

		return $url;
	}

	function setDevise($valeur){
		return $valeur;
	}

	function getAbreviation($string){
		$tabs = explode(" ", $string);
		$res = array();
		for ($i=0; $i < count($tabs); $i++) {
			array_push($res, strtoupper(substr($tabs[$i], 0, 1)));
		}

		return implode("", $res);
	}

	function minimumQuatreChiffre($number){
		if(strlen($number)==1){
			return "000".$number;
		}
		else if(strlen($number)==2){
			return "00".$number;
		}
		else if(strlen($number)==3){
			return "0".$number;
		}
		else if(strlen($number)>3){
			return "".$number;
		}
		else {
			return "".$number;
		}
	}
	function tt($start_date, $end_date){
		$quarters = array();

		$start_month = date( 'm', strtotime($start_date) );
		$start_year = date( 'Y', strtotime($start_date) );

		$end_month = date( 'm', strtotime($end_date) );
		$end_year = date( 'Y', strtotime($end_date) );

		$start_quarter = ceil($start_month/3);
		$end_quarter = ceil($end_month/3);
		$quarter = $start_quarter; // variable to track current quarter

		// Loop over years and quarters to create array
		for( $y = $start_year; $y <= $end_year; $y++ ){
			if($y == $end_year)
				$max_qtr = $end_quarter;
			else
				$max_qtr = 4;

			for($q=$quarter; $q<=$max_qtr; $q++){

				$current_quarter = new stdClass();

				$end_month_num = zero_pad($q * 3);
				$start_month_num = ($end_month_num - 2);
				$q_start_month = month_name($start_month_num);
				$q_end_month = month_name($end_month_num);

				$current_quarter->period = "Qtr $q ($q_start_month - $q_end_month) $y";
				$current_quarter->period_start = "$y-$start_month_num-01";      // yyyy-mm-dd
				$current_quarter->period_end = "$y-$end_month_num-" . month_end_date($y, $end_month_num);

				$quarters[] = $current_quarter;
				unset($current_quarter);
			}
			$quarter = 1; // reset to 1 for next year
		}
		return $quarters;
	}
	function add_months( $months, \DateTime $object ) {
	    $next = new DateTime($object->format('d-m-Y H:i:s'));
	    $next->modify('last day of +'.$months.' month');

	    if( $object->format('d') > $next->format('d') ) {
	        return $object->diff($next);
	    } else {
	        return new DateInterval('P'.$months.'M');
	    }
	}
	function getQuarters($start_date, $period){
		$nbre = floor($period/3);
		$quarters = array();

		$date = new DateTime($start_date);

		for ($i=0; $i < $nbre; $i++) {
			$tmp = array();
			$tmp['start'] = $date->format('d/m/Y');
			$date->add( add_months(3, $date));
			$tmp['end'] = $date->format('d/m/Y');

			$quarters[] = $tmp;
		}

		return $quarters;
	}
	function getAllMonth($start_date, $period){
		$nbre = $period;
		$quarters = array();

		$date = new DateTime($start_date);

		for ($i=0; $i < $nbre; $i++) {
			$tmp = array();
			$tmp['start'] = $date->format('d/m/Y');
			$date->add( add_months(1, $date));
			$tmp['end'] = $date->format('d/m/Y');
			$tmp['text'] = $tmp['start'].' '.LIBELLE_SUP.' '.$tmp['end'];
			$tmp['date'] = $tmp['start'].'-'.$tmp['end'];

			$quarters[] = $tmp;
		}

		return $quarters;
	}
	function getAllSemesters($start_date, $period){
		$nbre = floor($period/6);
		$quarters = array();

		$date = new DateTime($start_date);

		for ($i=0; $i < $nbre; $i++) { 
			$tmp = array();
			$tmp['start'] = $date->format('d/m/Y');
			$date->add( add_months(6, $date));
			$tmp['end'] = $date->format('d/m/Y');
			$tmp['text'] = $tmp['start'].' '.LIBELLE_SUP.' '.$tmp['end'];
			$tmp['date'] = $tmp['start'].'-'.$tmp['end'];

			$quarters[] = $tmp;
		}

		return $quarters;
	}
	function getToken($length){
	     $token = "";
	     $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
	     $codeAlphabet .= "abcdefghijklmnopqrstuvwxyz";
	     $codeAlphabet .= "0123456789";
	     $codeAlphabet .= "_";
	     $max = strlen($codeAlphabet); // edited

	    for ($i=0; $i < $length; $i++) {
	        $token .= $codeAlphabet[rand(0, $max-1)];
	    }

	    return $token;
	}

	function getUserByToken($token){
		global $BD;

		$sql = $BD->from('access_token')
			->where(array('TOKEN' => $token))
			->select()
			->one();

		if(!empty($sql) && $BD->from('access_token')->count()>0){
			$id_user = $sql['ID_USER'];
		}
		else {
			$id_user = 0;
		}
		return $id_user;
	}

	function getAllYears($start_date, $period){
		$nbre = floor($period/12);
		$quarters = array();

		$date = new DateTime($start_date);

		for ($i=0; $i < $nbre; $i++) { 
			$tmp = array();
			$tmp['start'] = $date->format('d/m/Y');
			$date->add( add_months(12, $date));
			$tmp['end'] = $date->format('d/m/Y');
			$tmp['text'] = $tmp['start'].' '.LIBELLE_SUP.' '.$tmp['end'];
			$tmp['date'] = $tmp['start'].'-'.$tmp['end'];	

			$quarters[] = $tmp;
		}

		return $quarters;
	}
	function getAllWeeks($start_date, $period){
		$end_Date = strtotime('+'.$period.' month', $start_date);

		$quarters = array();
		$date1 = new DateTime($start_date);
		$date2 = new DateTime($end_Date);
		$interval = $date1->diff($date2);

		$weeks = floor(($interval->days) / 7);

	    $start_date = $date1->format('d/m/Y');
		for($i = 1; $i <= $weeks; $i++){
			$tmp = array();
		    $week = $date1->format("W");
		    $date1->add(new DateInterval('P4D'));

		    $tmp['start'] = $start_date;
			$tmp['end'] = $date1->format('d/m/Y');
			$tmp['week'] = $week;
			$tmp['text'] = $tmp['start'].' '.LIBELLE_SUP.' '.$tmp['end'];
			$tmp['date'] = $tmp['start'].'-'.$tmp['end'];
			$quarters[] = $tmp;

		    $date1->add(new DateInterval('P3D'));
		    $start_date = $date1->format('d/m/Y');
		}

		return $quarters;
	}
	//var_dump(quater('2016-11-11', 12));
	function month_name($month_number){
		return date('F', mktime(0, 0, 0, $month_number, 10));
	}
	// get get last date of given month (of year)
	function month_end_date($year, $month_number){
		return date("t", strtotime("$year-$month_number-1"));
	}
	// return two digit month or day, e.g. 04 - April
	function zero_pad($number){
		if($number < 10)
			return "0$number";
		return "$number";
	}
	function CurrentQuarter(){
	     $n = date('n');
	     if($n < 4){
	          return "1";
	     } elseif($n > 3 && $n <7){
	          return "2";
	     } elseif($n >6 && $n < 10){
	          return "3";
	     } elseif($n >9){
	          return "4";
	     }
	}

	function get_dates_of_quarter($quarter = 'current', $year = null, $format = null){
	    if ( !is_int($year) ) {
	       $year = (new DateTime)->format('Y');
	    }
	    $current_quarter = ceil((new DateTime)->format('n') / 3);
	    switch (  strtolower($quarter) ) {
	    case 'this':
	    case 'current':
	       $quarter = ceil((new DateTime)->format('n') / 3);
	       break;

	    case 'previous':
	       $year = (new DateTime)->format('Y');
	       if ($current_quarter == 1) {
	          $quarter = 4;
	          $year--;
	        } else {
	          $quarter =  $current_quarter - 1;
	        }
	        break;

	    case 'first':
	        $quarter = 1;
	        break;

	    case 'last':
	        $quarter = 4;
	        break;

	    default:
	        $quarter = (!is_int($quarter) || $quarter < 1 || $quarter > 4) ? $current_quarter : $quarter;
	        break;
	    }
	    if ( $quarter === 'this' ) {
	        $quarter = ceil((new DateTime)->format('n') / 3);
	    }
	    $start = new DateTime($year.'-'.(3*$quarter-2).'-1 00:00:00');
	    $end = new DateTime($year.'-'.(3*$quarter).'-'.($quarter == 1 || $quarter == 4 ? 31 : 30) .' 23:59:59');

	    return array(
	        'start' => $format ? $start->format($format) : $start,
	        'end' => $format ? $end->format($format) : $end,
	    );
	}
	function getAllMonths(){
		global $MOIS;

		$result = array();

		$row = array();
		$row['format'] = $MOIS[date('m')-1]." ".date('Y');
		$row['date'] = date('m Y');
		$result[] = $row;
		for ($i = 1; $i < 8; $i++) {
			$row = array();
			$row['text'] = $MOIS[date('m', strtotime("-$i month"))-1]." ".date('Y', strtotime("-$i month"));
			$row['date'] = date('m Y', strtotime("-$i month"));
			$result[] = $row;
		}
		return $result;
	}

	function getAllQuater(){
		global $MOIS;
		$start    = (new DateTime(date('Y').'-01-01'))->modify('first day of this month');
		$end      = (new DateTime())->modify('first day of this month');
		$interval = DateInterval::createFromDateString('3 month');
		$period   = new DatePeriod($start, $interval, $end);
		$re = [];
		foreach ($period as $dt) {
		    $re[] = $MOIS[intval($dt->format("m"))-1].' '.$dt->format("Y");
		}
		return $re;
	}

	function format_money($number){
		$n = $number;
		/*if($_SESSION['lang']=='fr')
			$n = number_format($number, 0, ',', ' ');
		else
			$n = number_format($number);*/
	 	$n = number_format($number, 0);
    	return str_replace(",", " ", $n);
	}

	function rangeMonth() {
	    date_default_timezone_set(date_default_timezone_get());
	    $dt = time();
	    $res['start'] = date('d/m/Y', strtotime('first day of this month', $dt));
	    $res['end'] = date('d/m/Y', strtotime('last day of this month', $dt));
	    return $res;
    }

  	function rangeCurrentWeek() {
	    date_default_timezone_set(date_default_timezone_get());
	    $dt = time();
	    $res['start'] = date('N', $dt)==1 ? date('d/m/Y', $dt) : date('d/m/Y', strtotime('last monday', $dt));
	    $res['end'] = date('N', $dt)==7 ? date('d/m/Y', $dt) : date('d/m/Y', strtotime('next sunday', $dt));
	    return $res;
    }

  	function rangeLast5Week() {
	    date_default_timezone_set(date_default_timezone_get());
	    $list = [];
	    for ($i=0; $i < 5; $i++) {
		    $dt = strtotime("-".$i." week");
		    $res['start'] = date('N', $dt)==1 ? date('d/m/Y', $dt) : date('d/m/Y', strtotime('last monday', $dt));
		    $res['end'] = date('N', $dt)==7 ? date('d/m/Y', $dt) : date('d/m/Y', strtotime('next sunday', $dt));
			$res['text'] = $res['start'].' '.LIBELLE_SUP.' '.$res['end'];
			$res['date'] = $res['start'].'-'.$res['end'];
		    $list[] = $res;
	    }
	    return $list;
    }
  	function rangeNextWeek() {
	    date_default_timezone_set(date_default_timezone_get());
	    $dt = strtotime("+1 week");
	    $res['start'] = date('N', $dt)==1 ? date('d/m/Y', $dt) : date('d/m/Y', strtotime('last monday', $dt));
	    $res['end'] = date('N', $dt)==7 ? date('d/m/Y', $dt) : date('d/m/Y', strtotime('next sunday', $dt));
	    return $res;
    }
	function pickerDateTimeToMysql($str){
		return date('Y-m-d H:i:s', strtotime(str_replace("/", "-", $str)));
	}
	function pickerDateToMysql($str){
		return date('Y-m-d', strtotime(str_replace("/", "-", $str)));
	}

	function date_diffFromNow($date){

		$ts1 = time();
		$ts2 = strtotime($date);

		$seconds_diff = $ts2 - $ts1;

	   return ceil($seconds_diff/3600/24);
	}

	function checkDirection($service){
		global $BD;
	    if($_SESSION['iduser']==0){
	      return true;
	    }
	    $sql = $BD->prepare("SELECT * FROM utilisateur_direction, direction, service_direction WHERE utilisateur_direction.ID_DIRECTION = direction.ID_DIRECTION AND utilisateur_direction.ID_UTILISATEUR = ? AND service_direction.IDSERVICE = direction.IDSERVICE AND service_direction.NOMSERVICE LIKE ?");
	    $sql->execute(array($_SESSION['iduser'], "%".$service."%"));
	    $etat = $sql->fetch();
	    if($sql->rowCount()>0)
	      return true;
	    else
	      return false;
	}
	function checkDirection2($service, $id_user){
		global $BD;
	    if($_SESSION['iduser']==0){
	      return true;
	    }
	    $sql = $BD->prepare("SELECT * FROM utilisateur_direction, direction, service_direction WHERE utilisateur_direction.ID_DIRECTION = direction.ID_DIRECTION AND utilisateur_direction.ID_UTILISATEUR = ? AND service_direction.IDSERVICE = direction.IDSERVICE AND service_direction.NOMSERVICE LIKE ?");
	    $sql->execute(array($id_user, "%".$service."%"));
	    $etat = $sql->fetch();
	    if($sql->rowCount()>0)
	      return true;
	    else
	      return false;
	}

	function checkPrivilege($page){
		global $BD;
	    if($_SESSION['iduser']==0){
	      return true;
	    }

	    $sql = $BD->prepare("SELECT * FROM direction_privilege, privilege, utilisateur_direction WHERE utilisateur_direction.ID_DIRECTION = direction_privilege.ID_DIRECTION AND direction_privilege.ID_PRIVILEGE = privilege.IDPRIVILEGE AND utilisateur_direction.ID_UTILISATEUR = ? AND privilege.NAME = ?");
	    $sql->execute(array($_SESSION['iduser'], $page));
	    $etat = $sql->fetch();
	    if($sql->rowCount()>0)
	      return true;
	    else
	      return false;
	  }
	function getUsersWithPrivilege($privilege){
		global $BD;
	    $sql = $BD->prepare("SELECT ID_UTILISATEUR FROM direction_privilege, privilege, utilisateur_direction WHERE utilisateur_direction.ID_DIRECTION = direction_privilege.ID_DIRECTION AND direction_privilege.ID_PRIVILEGE = privilege.IDPRIVILEGE AND privilege.NAME = ?");
	    $sql->execute(array($privilege));
	    return $sql->fetch();
	}
	function getUsersReceiveNotification($privilege){
		global $BD;
	    $sql = $BD->prepare("SELECT ID_UTILISATEUR FROM direction_notification, notification, utilisateur_direction WHERE utilisateur_direction.ID_DIRECTION = direction_notification.ID_DIRECTION AND direction_notification.IDNOTIFICATION = notification.IDNOTIFICATION AND notification.NAME = ?");
	    $sql->execute(array($privilege));
	    return $sql->fetch();
	}

	class Mail{
		public function __construct(){

		}

		public static function send_to_user($object, $message, $type, $id_type, $user){
			global $BD;
			$tchat = $BD->prepare("INSERT INTO `tchat`(`IDENVOI`, `IDRECOI`, `OBJET`, `MESSAGE`, `TYPE`,`ID_SUIVI`) VALUES (?,?,?,?,?,?)");
          	$tchat->execute(array($_SESSION["iduser"],$user,utf8_decode($object),utf8_decode($message),$type,$id_type)); 
		}
	}
	//Mail::send_to_user('test', 'testons', '', '', 1);

	class Template {
	    protected $file;
	    protected $values = array();

	    public function __construct($file) {
	        $this->file = $file;
	    }
	    public function set($key, $value) {
		    $this->values[$key] = $value;
		}

		public function output() {
		    if (!file_exists($this->file)) {
		        return "Error loading template file ($this->file).";
		    }
		    $output = file_get_contents($this->file);
		    foreach ($this->values as $key => $value) {
		        $tagToReplace = "[@$key]";
		        $output = str_replace($tagToReplace, $value, $output);
		    }
		    return $output;
		}
	}

	function PaysForUser(){
		global $BD;

		$getdirection = $BD->query("SELECT GROUP_CONCAT(NOM_DIRECTION) as listdirection,GROUP_CONCAT(IDSERVICE) as listservice FROM utilisateur_direction,direction WHERE utilisateur_direction.ID_DIRECTION = direction.ID_DIRECTION AND utilisateur_direction.ID_UTILISATEUR =".$_SESSION["iduser"]);
		if ($getdirection->rowCount() ==0) {
			return "0";
		}
		else{
			while ($getd = $getdirection->fetch()) {
				if (strpos($getd["listdirection"], "MANAGER") !== false) {
					$getpays = $BD->query("SELECT GROUP_CONCAT(DISTINCT ID_PAYS) as listpays FROM pays_service WHERE ID_SERVICE IN (".$getd["listservice"].") ");
					$paysuser = $getpays->fetch();

					//return "manager";
					return $paysuser["listpays"];
				}
				else{
					$getpays = $BD->query("SELECT ID_PAYS FROM utilisateur WHERE IDUTILISATEUR = ".$_SESSION["iduser"]);
					$paysuser = $getpays->fetch();

					//return "agent";
					return $paysuser["ID_PAYS"];
				}
			}
		}
	}
?>