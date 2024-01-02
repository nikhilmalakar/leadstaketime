<?php
# -------------------------------------------------#
#¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤#
#	¤                                            ¤   #
#	¤         Puerto Premium Survey 1.0          ¤   #
#	¤--------------------------------------------¤   #
#	¤              By Khalid Puerto              ¤   #
#	¤--------------------------------------------¤   #
#	¤                                            ¤   #
#	¤  Facebook : fb.com/prof.puertokhalid       ¤   #
#	¤  Instagram : instagram.com/khalidpuerto    ¤   #
#	¤  Site : http://www.puertokhalid.com        ¤   #
#	¤  Whatsapp: +212 654 211 360                ¤   #
#	¤                                            ¤   #
#	¤--------------------------------------------¤   #
#	¤                                            ¤   #
#	¤  Last Update: 13/09/2020                   ¤   #
#	¤                                            ¤   #
#¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤#
# -------------------------------------------------#

include __DIR__ . "/configs.php";

if(!isset($_SERVER['HTTP_REFERER'])){
	echo '<meta http-equiv="refresh" content="0;url='.path.'">';
	exit;
}

$alert = [];

if($pg == 'send-survey-answers') {
	include __DIR__ . "/ajax/sendsurveyanswers.php";
} elseif($pg == 'adminstats'){
	if(us_level == 6){
		if($request == "daily"){
			$start = new DateTime('now');
			$end = new DateTime('- 7 day');
			$diff = $end->diff($start);
			$interval = DateInterval::createFromDateString('-1 day');
			$period = new DatePeriod($start, $interval, $diff->days);

			foreach ($period as $date) {
				$aa['data'][] = db_rows("responses WHERE FROM_UNIXTIME(date,'%m-%d-%Y') = '".$date->format('m-d-Y')."' GROUP BY ip", "ip");
				$aa['labels'][] = $date->format('M d');
			}

		  $aa['data'] = array_reverse($aa['data']);
		  $aa['labels'] = array_reverse($aa['labels']);
		  $aa['title'] = "Responses ".$lang['dashboard']['stats_line_d'];
		} elseif($request == "monthly"){
			$aa = [];
			for ($i=1; $i <=12 ; $i++) {
				$aa['data'][] = db_rows("responses WHERE MONTH(FROM_UNIXTIME(date)) = '{$i}' GROUP BY ip", "ip");
				$aa['labels'][] = date('F', mktime(0, 0, 0, $i, 10));
			}
		  $aa['title'] = "Responses ".$lang['dashboard']['stats_line_m'];
		}
		echo json_encode($aa);
	}
} elseif($pg == 'adminstatsbars'){
	if(us_level == 6){
		if($request == "daily"){
			$start = new DateTime('now');
			$end = new DateTime('- 7 day');
			$diff = $end->diff($start);
			$interval = DateInterval::createFromDateString('-1 day');
			$period = new DatePeriod($start, $interval, $diff->days);

			foreach ($period as $date) {
				$aa['data'][] = db_rows("survies WHERE FROM_UNIXTIME(date,'%m-%d-%Y') = '".$date->format('m-d-Y')."'");
				$aa['labels'][] = $date->format('M d');
				$colors = randomColor();
				$aa['colors'][] = "#".$colors['hex'];
			}

		  $aa['data'] = array_reverse($aa['data']);
		  $aa['labels'] = array_reverse($aa['labels']);
		  $aa['title'] = "Surveys ".$lang['dashboard']['stats_line_d'];
		} elseif($request == "monthly"){
			$aa = [];
			for ($i=1; $i <=12 ; $i++) {
				$aa['data'][] = db_rows("survies WHERE MONTH(FROM_UNIXTIME(date)) = '{$i}'");
				$aa['labels'][] = date('F', mktime(0, 0, 0, $i, 10));
				$colors = randomColor();
				$aa['colors'][] = "#".$colors['hex'];
			}
		  $aa['title'] = "Surveys ".$lang['dashboard']['stats_line_m'];
		}
		echo json_encode($aa);
	}
}




















elseif($pg == 'changesurveystatus'){
	if(us_level == 6 || db_rows("survies WHERE id = '{$id}' && author = '".us_id."'")){
		$stat = db_get("survies", "status", $id);
		db_update("survies", ['status' => ($stat ? 0 : 1)], $id);
	}
}


elseif($pg == 'delete' || $pg == 'trush'){
	if($request != "user"){
		switch ($request) {
			case 'question': $tb = 'questions'; break;
			case 'answer': $tb = 'answers'; break;
			case 'survey':  $tb = 'survies'; break;
			case 'page':  $tb = 'pages'; break;
			case 'logic':  $tb = 'logics'; break;
			case 'plan':  $tb = 'plans'; break;
			case 'language':  $tb = 'languages'; break;
			case 'payment':  $tb = 'payments'; break;
			default: $tb = ''; break;
		}
		if(us_level == 6) {
			if($pg == 'delete') db_delete("{$tb}", $id);
			elseif($pg == 'trush') db_trush("{$tb}", $id);
		} else if((us_level && db_rows("{$tb} WHERE id = '{$id}' && author = '".us_id."'"))){
			if($pg == 'delete') db_delete("{$tb}", $id);
			elseif($pg == 'trush') db_trush("{$tb}", $id);
		}

		if($tb == "logics"){
			$action = db_get("logics", "action", $id);
			$question1 = db_get("logics", "question1", $id);
			if( $action == 2){
				db_update('questions', ['hide' => 0], $question1);
			}
		}

	} else {
		if(us_level == 6){
			db_delete("users", $id);
		}
	}
}








elseif($pg == "sendsurveyemail"){
	if($_SERVER['REQUEST_METHOD'] === 'POST'){

		$pg_subject = sc_sec($_POST['subject']);
		$pg_email   = $_POST['email'];
		$pg_message = sc_sec($_POST['message']);
		$pg_id      = isset($_POST['id']) ? (int)($_POST['id']) : 0;

		if(empty($pg_subject) || empty($pg_email) || empty($pg_message)){
			$alert = [
				'type'  =>'danger',
				'alert' => fh_alerts($lang['alerts']['required'])
			];
		} else {
			$e_title = db_get("survies", "title", $pg_id);

			$emails = $pg_email;
			foreach ($emails as $em) {
				$pg_username = db_get("users", "username", sc_sec($em), "email");
				$e_url = path."/index.php?pg=survey&id={$pg_id}&request=su&token=".base64_encode(sc_sec($em));
				$mail->addAddress(sc_sec($em), "{$pg_username}");
				$mail->isHTML(true);
				$mail->Subject = $pg_subject;
				$mail->Body    = fh_email_p(fh_bbcode($pg_message), $e_url, ['', '', $e_title]);
				if( $mail->send() ){
					$alert = [
						'type'  =>'success',
						'alert' => fh_alerts("Send succesfully.", 'success')
					];
				} else {
					$alert = [
						'type'  =>'danger',
						'alert' => fh_alerts($lang['alerts']['wrong'])
					];
				}
			}

		}
		echo json_encode($alert);
	}

}













#############################
####                     ####
####       GENERAL       ####
####                     ####
#############################


/* ----------------------------
				Login
 ----------------------------*/

elseif($pg == 'login') {
	include __DIR__ . "/ajax/sendsignin.php";
}


/* ----------------------------
				Signup
 ----------------------------*/

elseif($pg == 'register') {
	include __DIR__ . "/ajax/sendsignup.php";
}


/* ----------------------------
				Logout
 ----------------------------*/

elseif($pg == 'logout'){

 	if(us_level){
 		session_destroy();
 		unset($_COOKIE['login']);
 		setcookie('login', null, -1);
 	}

}


/* ----------------------------
				Change Lang
 ----------------------------*/

elseif($pg == 'lang'){

 	if($_SERVER['REQUEST_METHOD'] === 'POST'){
 		$id = isset($_POST['id']) ? (int)($_POST['id']) : 1;
 		setcookie( "lang" , $id, time()+3600*24*30*6 );
 	}

}



/* ----------------------------
				Change User Details
 ----------------------------*/

elseif($pg == 'senduserdetails'){
	include __DIR__ . "/ajax/senduserdetails.php";
}



/* ----------------------------
				Files upload
 ----------------------------*/

elseif($pg == 'imageupload'){

	include __DIR__.'/configs/class.upload.php';
	$imgurl = '';
	$imgerror = '';
	$dir_dest = 'uploads';

	$fileTypes = array('image/jpeg','image/jpg','image/gif', 'image/png');

	if( $t == 'zip' ){
		$fileTypes = array('application/zip','application/octet-stream','application/x-zip-compressed', 'multipart/x-zip');
	} elseif( $t == 'rar' ){
		$fileTypes = array('application/x-rar-compressed','application/octet-stream');
	}

	$handle = new \Verot\Upload\Upload($_FILES['file']);
	if ($handle->uploaded) {
		$handle->allowed        = $fileTypes;
		$handle->file_max_size  = '5000000'; // 5MB
		$handle->file_safe_name = true;

		$fileNewName            = base64_encode($handle->file_src_name_body)."_".time();
		$handle->file_new_name_body = $fileNewName;

	  $handle->process($dir_dest);
	  if ($handle->processed) {
			$imgurl = $dir_dest.'/' . $handle->file_dst_name;
	  } else {
			$imgerror = $handle->error;
	  }
		$handle->clean();
	}

	echo json_encode(["url" => $imgurl, "error" => $imgerror]);

}



#############################
####                     ####
####       SURVEY        ####
####                     ####
#############################



/* ----------------------------
				Survey Password
 ----------------------------*/


elseif($pg == 'sendsurveypassword'){
 	$id       = isset($_POST["id"]) ? (int)($_POST["id"]) : 0;
 	$password = isset($_POST["password"]) ? sc_sec($_POST["password"]) : '';

 	if( db_rows("survies WHERE id = '{$id}' && password = '{$password}'") ){
 		$alert = [ 'type'  =>'success', 'alert' => fh_alerts($lang['alerts']['alldone'], 'success') ];
 		$_SESSION["surveypasswordfor{$id}"]  = $id;
 	} else {
 		$alert = [ 'type'  =>'danger', 'alert' => fh_alerts($lang['alerts']['wrongpass'], 'danger') ];
 	}
 	echo json_encode($alert);
}



/* ----------------------------
				Survey Check Response
 ----------------------------*/


elseif($pg == 'checksurveyrequiredresponses'){
 	$stepnum = isset($_POST["stepnum"]) ? (int)($_POST["stepnum"]) : 0;


 	$answers = (isset($_POST['answer']) ? $_POST['answer'] : []);
 	$brak_arr = ["break" => false, "break_input" => "$stepnum"];
 	foreach ($answers as $key => $value) {
 		$a_arr      = fh_get_num($key);
 		$a_arr_c    = count($a_arr);

 		$a_survey   = (int)($a_arr[0]);
 		$a_id       = ($a_arr_c != 3 ? (int)($a_arr[1]) : 0 );
 		$a_type     = ($a_arr_c != 3 ? db_get("answers", "type", $a_id) : 'check' );
 		$a_step     = ($a_arr_c != 3 ? db_get("answers", "step", $a_id) : (int)($a_arr[1]) );
 		$a_question = ($a_arr_c != 3 ? db_get("answers", "question", $a_id) : (int)($a_arr[2]) );
 		$a_question = db_get("questions", "id", $a_question, "sort", "&& survey = '{$a_survey}'&& step = '{$a_step}'");
 		$a_question_t = db_get("questions", "title", $a_question);


 		$a_status   = db_get("questions", "status", $a_question);
 		$a_byip     = db_get("survies", "byip", $a_survey);

 		if($a_step == $stepnum) {

 			$break      = false;

 			if($a_type == 'check') {
 				$value = preg_replace('/^,/', '', $value);
 				if($a_status && !$value){
 					$alert = ["alert" => $lang['alerts']['surveyerror'], "type" => "error"];
 					$break = true;
 				} else {
 					$alert = ["alert" => "success!", "type" => "success"];
 				}
 			} else {
 				$value = ( $a_type == "phone" ? ($value['value'] ? "{$value['select']}{$value['value']}" : '') : $value );

 				if(($a_status && !$value) || ($a_status && strlen($value) < 13 && $a_type == "phone") ) {
 					$alert = ["alert" => $lang['alerts']['surveyerror'], "type" => "error"];
 					$break = true;
 				} else {
 					$alert = ["alert" => "success!", "type" => "success"];
 				}
 			}

 			$brak_arr = ["break" => $break, "break_input" => $break ? $a_question : '', "value" => $value, "alert" => $alert];

 			if($break) break;

 		}

		$brak_arr['a_step']  = $a_step;
		$brak_arr['stepnum'] = $stepnum;
		$brak_arr['arr']     = $answers;


 	}

 	echo json_encode($brak_arr);

}


/* ----------------------------
				Survey Add Response
 ----------------------------*/

 elseif($pg == 'sendsurveyresponses'){
 	$stepnum = isset($_POST["stepnum"]) ? (int)($_POST["stepnum"]) : 0;


 	$tok         = (isset($_POST['tok']) ? sc_sec($_POST['tok']) : '');
 	$answers     = (isset($_POST['answer']) ? $_POST['answer']   : []);
 	$brak_arr    = ["break" => false, "break_input" => ""];
 	$answers_arr = [];
 	$break       = true;




 	foreach ($answers as $key => $value) {
 		$a_arr      = fh_get_num($key);
 		$a_arr_c    = count($a_arr);


 		$a_survey   = (int)($a_arr[0]);
 		$a_id       = ($a_arr_c != 3 ? (int)($a_arr[1]) : 0 );
 		$a_type     = ($a_arr_c != 3 ? db_get("answers", "type", $a_id) : 'check' );
 		$a_step     = ($a_arr_c != 3 ? db_get("answers", "step", $a_id) : (int)($a_arr[1]) );
 		$a_question = ($a_arr_c != 3 ? db_get("answers", "question", $a_id) : (int)($a_arr[2]) );
 		$a_question = db_get("questions", "id", $a_question, "sort", "&& survey = '{$a_survey}'&& step = '{$a_step}'");
 		$a_question_t = db_get("questions", "title", $a_question);


 		$a_status   = db_get("questions", "status", $a_question);
 		$a_byip     = db_get("survies", "byip", $a_survey);

 		$break      = false;

 		if(!$a_byip && isset( $_COOKIE["question_".$a_question."_answer_".$a_id] ) ){  // check if already taked by cookies
 			$alert = ["alert" => $lang['alerts']['surveyerror1'], "type" => "error", "pop" => true];
 			$break      = true;
 		} elseif($a_byip && db_rows("responses WHERE ip = '".get_ip."' && answer = '{$a_id}'")){  // check if already taked by ip
 			$alert = ["alert" => $lang['alerts']['surveyerror1'], "type" => "error", "pop" => true];
 			$break      = true;
 		} elseif( db_rows("responses WHERE token_id = '{$tok}' && answer = '{$a_id}'") ){ // check if already taked
 			$alert = ["alert" => $lang['alerts']['surveyerror1'], "type" => "error", "pop" => true];
 			$break      = true;
 		} else {
			if($a_type == 'check') {
 				$value = preg_replace('/^,/', '', $value);
 				if($a_status && !$value){
 					$alert = ["alert" => $lang['alerts']['surveyerror2'], "type" => "error", "pop" => false];
 					$break = true;
 				} else {
 					$alert = ["alert" => "success!", "type" => "success"];
 				}
 			} else {
				$value = ( $a_type == "phone" ? ($value['value'] ? "{$value['select']}{$value['value']}" : '') : $value );

 				if(($a_status && !$value) || ($a_status && strlen($value) < 13 && $a_type == "phone") ) {
 					$alert = ["alert" => $lang['alerts']['surveyerror2'], "type" => "error", "pop" => false];
 					$break = true;
 				} else {
 					$alert = ["alert" => "success!", "type" => "success"];
 				}
 			}
 		}


 		$answers_arr[] = ["survey" => $a_survey, "step" => $a_step, "question" => $a_question, "answer" => $a_id, "answer_v" => $value];

 		$brak_arr = ["break" => $break, "break_input" => $break ? $a_question : '', "value" => $value, "alert" => $alert];

 		if($break) break;


 	}


 	if( !$break ){

 		foreach ($answers_arr as $keys => $values) {
 			$alert_survey = (int)($values["survey"]);
 			$data = [
 				"response" => sc_sec($values["answer_v"]),
 				"date"     => time(),
 				"author"   => us_id,
 				"survey"   => (int)($values["survey"]),
 				"step"     => (int)($values["step"]),
 				"question" => (int)($values["question"]),
 				"answer"   => (int)($values["answer"]),
 				"ip"       => get_ip,
 				"os"       => get_os,
 				"browser"  => get_browser,
 				"device"   => get_device,
 				"token_id" => $tok,
 			];

 			if( !empty($values["answer_v"]) ){
 				setcookie("question_".(int)($values["question"])."_answer_".(int)($values["answer"]), sc_sec($values["answer_v"]), time() + (86400 * 365));
 				db_insert("responses", $data);
 			}

 		}

		# SEND AND EMAIL AFTER FINISHING THE SURVEY
		$emi_sid = $alert_survey;
		$emi_sactive = db_get("survies", "send_email", $emi_sid);

		if( $emi_sactive && db_rows("answers WHERE survey = '{$emi_sid}' && type = 'email'") ){
			$emi_ans_id = db_get("answers", "id", $emi_sid, "survey", "&& type = 'email'");
			$emi_ans_id = "s{$emi_sid}a{$emi_ans_id}";
			$emi_email = isset($answers[$emi_ans_id]) && !empty($answers[$emi_ans_id]) ? sc_sec($answers[$emi_ans_id]) : '';

			if( sc_check_email($emi_email) ){

					$pg_username = "";
					$e_url       = "";
					$e_title     = "";
					$pg_subject  = db_get("survies", "title", $emi_sid);
					$pg_message  = db_get("survies", "send_email_body", $emi_sid);

					$mail->addAddress($emi_email, $pg_username);
					$mail->isHTML(true);
					$mail->Subject = $pg_subject;
					$mail->Body    = fh_email_p(fh_bbcode($pg_message), $e_url, ['', '', $e_title]);
					$mail->send();

			}

		}

 	}


 	$brak_arr['url'] = isset($alert_survey) ? db_get("survies", "url", $alert_survey) : '';
 	echo json_encode($brak_arr);

 }


/* ----------------------------
				Survey Logics
 ----------------------------*/


 elseif($pg == 'surveygetlogics'){

 	$logic    = isset($_POST['name']) ? sc_sec($_POST['name']) : '';
 	$answer   = isset($_POST['answer']) ? sc_sec($_POST['answer']) : '';

 	$q_arr    = fh_get_num($logic);
 	$survey   = $q_arr[0];
 	$step     = $q_arr[1];
 	$question = $q_arr[2];

 	$a_arr    = fh_get_num($answer);
 	$answer   = isset($a_arr[1]) ? $a_arr[1] : $answer;

 	$question = db_get("questions", "id", $question, "sort", "&& survey = '{$survey}' && step = '{$step}'");

 	$rs_logic = db_rs("logics WHERE survey = '{$survey}' && question2 = '{$question}'");
 	$rs_logic = $rs_logic ? $rs_logic : 0;


 	$alert["takeaction"] = false;
 	$alert["action"]     = '';
 	$alert["question"]   = '';
 	$alert["condition2"] = '';
 	if( $rs_logic ){
 		if( $rs_logic['action'] == 1) $alert["action"] = 'hide';
 		if( $rs_logic['action'] == 2) $alert["action"] = 'show';
 		if( $rs_logic['action'] == 3) $alert["action"] = 'jump';

 		if( $rs_logic['condition2'] == 1) $alert["condition2"] = 'equal';
 		if( $rs_logic['condition2'] == 2) $alert["condition2"] = 'greater';
 		if( $rs_logic['condition2'] == 3) $alert["condition2"] = 'less';
 		if( $rs_logic['condition2'] == 4) $alert["condition2"] = 'different';

 		$alert["question"] = $rs_logic['question1'];

 		if( $alert["condition2"] == 'equal' && $answer == $rs_logic['answer']) {
 			$alert["takeaction"] = true;
 		}

 		if( $alert["condition2"] == 'greater' && $answer > $rs_logic['answer']) {
 			$alert["takeaction"] = true;
 		}

 		if( $alert["condition2"] == 'less' && $answer < $rs_logic['answer']) {
 			$alert["takeaction"] = true;
 		}

 		if( $alert["condition2"] == 'different' && $answer != $rs_logic['answer']) {
 			$alert["takeaction"] = true;
 		}

 	}

 	echo json_encode($alert);

}




#############################
####                     ####
####       REPORTS       ####
####                     ####
#############################



/* ----------------------------
				Export all results
 ----------------------------*/


elseif($pg == "exportall"){
 	$sql = $db->query("SELECT * FROM ".prefix."survies WHERE id = '{$id}'") or die ($db->error);
 	$rs = $sql->fetch_assoc();
 	if($rs['author'] == us_id || us_level == 6):

 			$q_sql = $db->query("SELECT * FROM ".prefix."questions WHERE survey = '{$id}' ORDER BY step ASC,sort ASC") or die ($db->error);
 			$lists = [];
 			$i = 0;
 			while($q_rs = $q_sql->fetch_assoc()){
 				if($q_rs['type']!="text"){
 					$i++;
 					$lists[0][$i] = $q_rs['title'];
 				}
 			}

			function nempty($dd) { return (!$dd ? '--' : $dd); }

 			$sql = $db->query("SELECT token_id FROM ".prefix."responses WHERE survey = '{$id}' GROUP BY token_id ORDER BY MAX(id) DESC") or die ($db->error);
 			if($sql->num_rows):
 				$ii = 0;
 			while($rs = $sql->fetch_assoc()):
 				$ii++;

 				$q_sql = $db->query("SELECT * FROM ".prefix."questions WHERE survey = '{$id}' ORDER BY step ASC,sort ASC") or die ($db->error);
 				while($q_rs = $q_sql->fetch_assoc()):
 					if($q_rs['type']!="text"){
 					$ans_id = db_get("responses", "answer", $q_rs['id'], "question", "&& token_id = '{$rs['token_id']}'");
 					$ans_tp = $ans_id ? db_get("answers", "type", $ans_id) : 'check';
 					$ans_tp = in_array($q_rs['type'], ['country', 'file', 'rating', 'scale']) ? $q_rs['type'] : $ans_tp;
 					$ans_vl = db_get("responses", "response", $q_rs['id'], "question", "&& token_id = '{$rs['token_id']}'");
 						if($ans_tp == "stars"){
 								$lists[$ii][] = $ans_vl." stars";
 						} elseif($ans_tp == "check"){
 							$ans_arr = explode(',', $ans_vl);
 							$i=0;
 							$pp = '';
 							for($x=0;$x<count($ans_arr);$x++){
 								$i++;
 								$pp .=  db_get("answers", "title", $ans_arr[$x]);
 								$pp .=  ($i != count($ans_arr) ? ' | ': '');
 							}
 							$lists[$ii][] = nempty($pp);

 						} elseif($ans_tp == "country"){
 							$lists[$ii][] =  "{$countries[$ans_vl]}";
 						} elseif($ans_tp == "phone"){
 							$pp = '';
 							$lists[$ii][] = nempty('(+'.$phones[substr($ans_vl, 0, 2)]['code'].') '.substr($ans_vl, 2, -1));
 						} else {
 							$lists[$ii][] = nempty($ans_vl);
 						}
 					}
 					endwhile;

 			endwhile;

 			endif;
 			$sql->close();

 			endif;
			echo json_encode($lists);
}


/* ----------------------------
				Export results
 ----------------------------*/

elseif($pg == 'exexcel'){

	$dd = isset($_POST['jsn']) ? sc_sec(json_decode($_POST['jsn'], true)) : '';
 	$ss = $s? $dd  : explode('|', sc_sec($request));

	header("Content-Disposition: attachment; filename=export_data".rand().".csv");
	header("content-type: application/csv; charset=UTF-8");
	header("Pragma: no-cache");
	header("Expires: 0");
	$out = fopen("php://output", 'w');
	if($s){
		foreach ($ss as $data){
			fputcsv($out, $data,";");
		}
	}  else {
		fputcsv($out, $ss,";");
	}

	fclose($out);


}


/* ----------------------------
			 Report show results
 ----------------------------*/

elseif($pg == 'rapport-stats') {
 	include __DIR__ . "/ajax/showrapportdetails.php";
}

/* ----------------------------
				Response Modal Show
 ----------------------------*/

elseif($pg == 'respense') {
 	include __DIR__ . "/ajax/showresponsedetails.php";
}

/* ----------------------------
				Report Stats Graph
 ----------------------------*/

elseif($pg == 'surveystats'){
 	if(us_level == 6 || db_rows("survies WHERE id = '{$id}' && author = '".us_id."'")){
 		if($request == "daily"){
 			$start    = new DateTime('now');
 			$end      = new DateTime('- 7 day');
 			$diff     = $end->diff($start);
 			$interval = DateInterval::createFromDateString('-1 day');
 			$period   = new DatePeriod($start, $interval, $diff->days);

 			foreach ($period as $date) {
 				$aa['data'][] = db_rows("responses WHERE survey = '{$id}' &&  FROM_UNIXTIME(date,'%m-%d-%Y') = '".$date->format('m-d-Y')."' GROUP BY token_id", "token_id");
 				$aa['labels'][] = $date->format('M d');
 			}

 		  $aa['data']   = array_reverse($aa['data']);
 		  $aa['labels'] = array_reverse($aa['labels']);
 		  $aa['title']  = $lang['report']['stats_d'];
 		} elseif($request == "monthly"){
 			$aa = [];
 			for ($i=1; $i <=12 ; $i++) {
 				$aa['data'][] = db_rows("responses WHERE survey = '{$id}' &&  MONTH(FROM_UNIXTIME(date)) = '{$i}' GROUP BY token_id", "token_id");
 				$aa['labels'][] = date('F', mktime(0, 0, 0, $i, 10));
 			}
 		  $aa['title'] = $lang['report']['stats_m'];
 		}

 		echo json_encode($aa);
 	}
}



#############################
####                     ####
####      DASHBOARD      ####
####                     ####
#############################



/* ----------------------------
				User Lang
 ----------------------------*/

elseif($pg == 'newlang'){
	if(us_level == 6){

	 	$sql = $db->query("SELECT content FROM ".prefix."languages WHERE id = 1") or die ($db->error);
	 	$rs = $sql->fetch_assoc();

	 	$data = [
	 		"language"  => "LANGUAGE NAME",
	 		"short"     => "ENG",
	 		"isdefault" => "0",
	 		"content"   => addslashes($rs['content']),
	 	];
	 	db_insert("languages", $data);

	}

}

 elseif($pg == 'sendlanguage'){

 	if(us_level == 6){

 		$lang_name    = isset($_POST['lang_name']) ? sc_sec($_POST['lang_name'])   : "";
 		$lang_short   = isset($_POST['lang_short']) ? sc_sec($_POST['lang_short']) : "";
 		$lang_default = isset($_POST['lang_default']) ? 1                          : 0;
 		$lang_id      = isset($_POST['lang_id']) ? (int)($_POST['lang_id'])        : 0;

 		if(empty($lang_name) || empty($lang_short)){
 			$alert = [
 				'type'  =>'danger',
 				'alert' => 'title is required'
 			];
 		} else {

 			$language = [];
 	    $keys = array_keys($lang);


 	    foreach(sc_sec(explode("\r\n", $_POST['language']['a'])) as $k => $v){
 	        $language[$keys[$k]] = sc_sec($v);
 	    }

     	foreach($_POST['language'] as $k => $v){
         if($k != 'a') {
             $keys = array_keys($lang[$k]);
             $vals = sc_sec(explode("\r\n", $v));
             foreach ($keys as $kk => $vv){
                 $language[$k][$vv] = $vals[$kk];
             }
         }
     	}

			if( 1 == 2 ){
				include __DIR__.'/configs/lang/en.php';
				$language = $lang;
			}


 	    $var = json_encode($language, JSON_UNESCAPED_UNICODE);
 	    $var = addslashes(str_replace(array("\r", "\n"), '', $var));

 			$data = [
 				"language"  => $lang_name,
 				"short"     => $lang_short,
 				"isdefault" => $lang_default,
 				"content"   => $var,
 			];


 				if($lang_default){
 					$db->query("UPDATE ".prefix."languages SET isdefault = '0'");
 				}

 			if($lang_id){
 				$data["updated_at"] = time();
 				db_update("languages", $data, $lang_id);
 			} else {
 				$data["created_at"] = time();
 				db_insert("languages", $data);
 			}

 			$alert = [
 				'type'  =>'success',
 				'alert' => $lang['alerts']['alldone']
 			];

 		}


 		echo json_encode($alert);
 	}

 }


/* ----------------------------
				User Status
 ----------------------------*/

 elseif($pg == 'changeuserstatus'){

 	if(us_level == 6 && db_rows("users WHERE id = '{$id}' && level != '6'")){
 		$stat = db_get("users", "moderat", $id);
 		db_update("users", ['moderat' => ($stat ? 0 : 1)], $id);
 	}

 }


/* ----------------------------
				Plans Send
 ----------------------------*/

 elseif($pg == 'sendplans'){

 	if($_SERVER['REQUEST_METHOD'] === 'POST' && us_level == 6){

 		$site_plans = isset($_POST['site_plans']) ? 0 : 1;

 		for($x=1; $x<=4;$x++){
 			$sql = $db->query("DESCRIBE ".prefix."plans");
 			while($row = $sql->fetch_array()){
 				if($row['Field'] != 'id'){
 					if($row['Type'] == "tinyint(1)"){
 						$vv = isset($_POST[$row['Field']][$x]) ? 1 : 0;
 					}
 					elseif($row['Type'] == "int(11)"){
 						$vv = isset($_POST[$row['Field']][$x]) ? (int)($_POST[$row['Field']][$x]) : 0;
 					}
 					else{
 						$vv = isset($_POST[$row['Field']][$x]) ? sc_sec($_POST[$row['Field']][$x]) : '';
 					}
 					db_update("plans", ["{$row['Field']}" => $vv], $x);
 				}
 			}
 		}

 		db_update_global('site_plans', $site_plans);

 		$alert = [ 'type'  =>'success', 'alert' => fh_alerts($lang['alerts']['alldone'], 'success') ];

 		echo json_encode($alert);
 	}

 }


/* ----------------------------
				Plan Send
 ----------------------------*/


 elseif($pg == "sendplan"){
 	if($_SERVER['REQUEST_METHOD'] === 'POST' && us_level == 6){

 		$pg_plan              = isset($_POST['plan']) ? sc_sec($_POST['plan'])                          : '';
 		$pg_price             = isset($_POST['price']) ? sc_sec($_POST['price'])                        : '';
 		$pg_desc1             = isset($_POST['desc1']) ? sc_sec($_POST['desc1'])                        : '';
 		$pg_desc2             = isset($_POST['desc2']) ? sc_sec($_POST['desc2'])                        : '';
 		$pg_desc3             = isset($_POST['desc3']) ? sc_sec($_POST['desc3'])                        : '';
 		$pg_desc4             = isset($_POST['desc4']) ? sc_sec($_POST['desc4'])                        : '';
 		$pg_desc5             = isset($_POST['desc5']) ? sc_sec($_POST['desc5'])                        : '';
 		$pg_desc6             = isset($_POST['desc6']) ? sc_sec($_POST['desc6'])                        : '';
 		$pg_desc7             = isset($_POST['desc7']) ? sc_sec($_POST['desc7'])                        : '';
 		$pg_desc8             = isset($_POST['desc8']) ? sc_sec($_POST['desc8'])                        : '';
 		$pg_desc9             = isset($_POST['desc9']) ? sc_sec($_POST['desc9'])                        : '';
 		$pg_surveys_month     = isset($_POST['surveys_month']) ? (int)($_POST['surveys_month'])         : 0;
 		$pg_surveys_steps     = isset($_POST['surveys_steps']) ? (int)($_POST['surveys_steps'])         : 0;
 		$pg_surveys_questions = isset($_POST['surveys_questions']) ? (int)($_POST['surveys_questions']) : 0;
 		$pg_surveys_answers   = isset($_POST['surveys_answers']) ? (int)($_POST['surveys_answers'])     : 0;
 		$pg_surveys_iframe    = isset($_POST['surveys_iframe']) ? 1                                     : 0;
 		$pg_surveys_rapport   = isset($_POST['surveys_rapport']) ? 1                                    : 0;
 		$pg_surveys_export    = isset($_POST['surveys_export']) ? 1                                     : 0;
 		$pg_survey_design     = isset($_POST['survey_design']) ? 1                                      : 0;
 		$pg_show_ads          = isset($_POST['show_ads']) ? 1                                           : 0;
 		$pg_support           = isset($_POST['support']) ? 1                                            : 0;


 		if(empty($pg_plan) || empty($pg_price)){
 			$alert = [ 'type'  =>'danger', 'alert' => fh_alerts($lang['alerts']['required']) ];
 		} else {
 			$data = [
 				'plan'              => $pg_plan,
 				'price'             => $pg_price,
 				'desc1'             => $pg_desc1,
 				'desc2'             => $pg_desc2,
 				'desc3'             => $pg_desc3,
 				'desc4'             => $pg_desc4,
 				'desc5'             => $pg_desc5,
 				'desc6'             => $pg_desc6,
 				'desc7'             => $pg_desc7,
 				'desc8'             => $pg_desc8,
 				'desc9'             => $pg_desc9,
 				'surveys_month'     => $pg_surveys_month,
 				'surveys_steps'     => $pg_surveys_steps,
 				'surveys_questions' => $pg_surveys_questions,
 				'surveys_answers'   => $pg_surveys_answers,
 				'surveys_iframe'    => $pg_surveys_iframe,
 				'surveys_rapport'   => $pg_surveys_rapport,
 				'surveys_export'    => $pg_surveys_export,
 				'survey_design'     => $pg_survey_design,
 				'show_ads'          => $pg_show_ads,
 				'support'           => $pg_support
 			];


 			db_insert( 'plans', $data );

 			$alert = [ 'type'  =>'success', 'alert' => fh_alerts($lang['alerts']['alldone'], 'success') ];
 		}
 		echo json_encode($alert);

 	}
 }


/* ----------------------------
				Page Send
 ----------------------------*/

elseif($pg == "sendpage"){
 	if($_SERVER['REQUEST_METHOD'] === 'POST' && us_level == 6){
 		$pg_title    = sc_sec($_POST['pg_title']);
 		$pg_sort     = (int)($_POST['pg_sort']);
 		$pg_id       = (int)($_POST['id']);
 		$pg_footer   = (isset($_POST['footer']) ? 1 : 0);
 		$pg_header   = (isset($_POST['header']) ? 1 : 0);
 		$pg_content  = sc_sec($_POST['pg_content'], true);

 		if(empty($pg_title) || empty($pg_content)){
 			$alert = [ 'type'  =>'danger', 'alert' => fh_alerts($lang['alerts']['required']) ];
 		} else {
 			$data = [
 				'title'      => $pg_title,
 				'sort'       => $pg_sort,
 				'footer'     => $pg_footer,
 				'header'     => $pg_header,
 				'content'    => $pg_content
 			];
 			if($pg_id){
 				$data['updated_at'] = time();
 				db_update('pages', $data, $pg_id);
 			} else {
 				$data['created_at'] = time();
 				db_insert( 'pages', $data );
 			}

 			$alert = [ 'type'  =>'success', 'alert' => fh_alerts($lang['alerts']['alldone'], 'success') ];
 		}
 		echo json_encode($alert);
 	}
}


/* ----------------------------
				Settings Send
 ----------------------------*/

elseif($pg == 'sendsettings'){

	if($_SERVER['REQUEST_METHOD'] === 'POST' && us_level == 6){

		$pg_title       = sc_sec($_POST['site_title']);
		$pg_description = sc_sec($_POST['site_description']);
		$pg_keywords    = sc_sec($_POST['site_keywords']);
		$pg_url         = sc_sec($_POST['site_url']);
		$site_favicon   = sc_sec($_POST['site_favicon']);
		$site_logo      = sc_sec($_POST['site_logo']);

		$site_noreply         = sc_sec($_POST['site_noreply']);
		$site_register        = isset($_POST['site_register']) ? (int)($_POST['site_register']) : 0;
		$login_facebook       = isset($_POST['login_facebook']) ? (int)($_POST['login_facebook']) : 0;
		$login_twitter        = isset($_POST['login_twitter']) ? (int)($_POST['login_twitter']) : 0;
		$login_google         = isset($_POST['login_google']) ? (int)($_POST['login_google']) : 0;
		$site_paypal_live     = isset($_POST['site_paypal_live']) ? (int)($_POST['site_paypal_live']) : 0;
		$site_smtp            = isset($_POST['site_smtp']) ? 1 : 0;
		$login_fbAppId        = sc_sec($_POST['login_fbAppId']);
		$login_fbAppSecret    = sc_sec($_POST['login_fbAppSecret']);
		$login_fbAppVersion   = sc_sec($_POST['login_fbAppVersion']);
		$login_twConKey       = sc_sec($_POST['login_twConKey']);
		$login_twConSecret    = sc_sec($_POST['login_twConSecret']);
		$login_ggClientId     = sc_sec($_POST['login_ggClientId']);
		$login_ggClientSecret = sc_sec($_POST['login_ggClientSecret']);
		$site_paypal_id       = sc_sec($_POST['site_paypal_id']);
		$site_currency_name   = sc_sec($_POST['site_currency_name']);
		$site_currency_symbol = sc_sec($_POST['site_currency_symbol']);
		$site_smtp_host       = sc_sec($_POST['site_smtp_host']);
		$site_smtp_username   = sc_sec($_POST['site_smtp_username']);
		$site_smtp_password   = sc_sec($_POST['site_smtp_password']);
		$site_smtp_encryption = sc_sec($_POST['site_smtp_encryption']);
		$site_smtp_auth       = sc_sec($_POST['site_smtp_auth']);
		$site_smtp_port       = sc_sec($_POST['site_smtp_port']);

		$site_landing    = isset($_POST['site_landing']) ? 1 : 0;
		$site_ads_header = mysqli_real_escape_string($db,$_POST['site_ads_header']);
		$site_ads_footer = mysqli_real_escape_string($db,$_POST['site_ads_footer']);
		$site_ads_survey = mysqli_real_escape_string($db,$_POST['site_ads_survey']);

		$site_facebook  = sc_sec($_POST['site_facebook']);
		$site_twitter   = sc_sec($_POST['site_twitter']);
		$site_instagram = sc_sec($_POST['site_instagram']);
		$site_youtube   = sc_sec($_POST['site_youtube']);
		$site_skype     = sc_sec($_POST['site_skype']);

		$site_google_analytics = sc_sec($_POST['google_analytics']);
		$feature_link1         = sc_sec($_POST['feature_link1']);
		$feature_link2         = sc_sec($_POST['feature_link2']);
		$feature_link3         = sc_sec($_POST['feature_link3']);
		$feature_link4         = sc_sec($_POST['feature_link4']);
		$iframe_link           = sc_sec($_POST['iframe_link']);
		$site_hidetopbar       = isset($_POST['site_hidetopbar']) ? (int)($_POST['site_hidetopbar']) : 0;

		$show_allsurveys = isset($_POST['show_allsurveys']) ? 1 : 0;

		$site_onlymembers = isset($_POST['site_onlymembers']) ? (int)($_POST['site_onlymembers']) : 0;
		$site_onlyadmins  = isset($_POST['site_onlyadmins']) ? (int)($_POST['site_onlyadmins'])   : 0;
		$site_email       = isset($_POST['site_email']) ? sc_sec($_POST['site_email'])            : '';
		$site_phone       = isset($_POST['site_phone']) ? sc_sec($_POST['site_phone'])            : '';
		$support_link     = isset($_POST['support_link']) ? sc_sec($_POST['support_link'])        : '';
		$terms_link       = isset($_POST['terms_link']) ? sc_sec($_POST['terms_link'])            : '';
		$privacy_link     = isset($_POST['privacy_link']) ? sc_sec($_POST['privacy_link'])        : '';

		$site_sendsurveyemail =  isset($_POST['site_sendsurveyemail']) ? sc_sec($_POST['site_sendsurveyemail']) : '';
		$site_phonemask =  isset($_POST['site_phonemask']) ? sc_sec($_POST['site_phonemask']) : '000-000-0000';

		$site_colors     = isset($_POST['site_colors']) ? sc_sec($_POST['site_colors'])        : '';




		if(empty($pg_title) || empty($pg_description)){
			$alert = [
				'type'  =>'danger',
				'alert' => fh_alerts($lang['alerts']['required'])
			];
		} else {
			db_update_global('site_title', $pg_title);
			db_update_global('site_description', $pg_description);
			db_update_global('site_keywords', $pg_keywords);
			db_update_global('site_url', $pg_url);
			db_update_global('site_favicon', $site_favicon);
			db_update_global('site_logo', $site_logo);

			db_update_global('site_noreply', $site_noreply);
			db_update_global('site_register', $site_register);
			db_update_global('login_facebook', $login_facebook);
			db_update_global('login_twitter', $login_twitter);
			db_update_global('login_google', $login_google);
			db_update_global('site_paypal_live', $site_paypal_live);
			db_update_global('site_smtp', $site_smtp);
			db_update_global('login_fbAppId', $login_fbAppId);
			db_update_global('login_fbAppSecret', $login_fbAppSecret);
			db_update_global('login_fbAppVersion', $login_fbAppVersion);
			db_update_global('login_twConKey', $login_twConKey);
			db_update_global('login_twConSecret', $login_twConSecret);
			db_update_global('login_ggClientId', $login_ggClientId);
			db_update_global('login_ggClientSecret', $login_ggClientSecret);
			db_update_global('site_paypal_id', $site_paypal_id);
			db_update_global('site_currency_name', $site_currency_name);
			db_update_global('site_currency_symbol', $site_currency_symbol);
			db_update_global('site_smtp_host', $site_smtp_host);
			db_update_global('site_smtp_username', $site_smtp_username);
			db_update_global('site_smtp_password', $site_smtp_password);
			db_update_global('site_smtp_encryption', $site_smtp_encryption);
			db_update_global('site_smtp_auth', $site_smtp_auth);
			db_update_global('site_smtp_port', $site_smtp_port);
			db_update_global('site_landing', $site_landing);
			db_update_global('site_ads_header', $site_ads_header);
			db_update_global('site_ads_footer', $site_ads_footer);
			db_update_global('site_ads_survey', $site_ads_survey);

			db_update_global('site_facebook', $site_facebook);
			db_update_global('site_twitter', $site_twitter);
			db_update_global('site_instagram', $site_instagram);
			db_update_global('site_youtube', $site_youtube);
			db_update_global('site_skype', $site_skype);

			db_update_global('google_analytics', $site_google_analytics);
			db_update_global('site_hidetopbar', $site_hidetopbar);
			db_update_global('feature_link1', $feature_link1);
			db_update_global('feature_link2', $feature_link2);
			db_update_global('feature_link3', $feature_link3);
			db_update_global('feature_link4', $feature_link4);
			db_update_global('iframe_link', $iframe_link);

			db_update_global('site_onlymembers', $site_onlymembers);
			db_update_global('site_onlyadmins', $site_onlyadmins);
			db_update_global('site_email', $site_email);
			db_update_global('site_phone', $site_phone);
			db_update_global('support_link', $support_link);
			db_update_global('terms_link', $terms_link);
			db_update_global('privacy_link', $privacy_link);

			db_update_global('site_sendsurveyemail', $site_sendsurveyemail);
			db_update_global('site_phonemask', $site_phonemask);

			db_update_global('show_allsurveys', $show_allsurveys);


			db_update_global('site_colors', json_encode($site_colors));

			$alert = [
				'type'  =>'success',
				'alert' => fh_alerts($lang['alerts']['alldone'], 'success')
			];
		}
		echo json_encode($alert);
	}
}



#############################
####                     ####
####   SURVEY Template   ####
####                     ####
#############################


elseif($pg == 'choose_template') {



	if( !fh_access("survey") ){
		$alert = ['id' => $id, 'type' => 'danger', 'alert' => $lang['alerts']['permission']];
		echo json_encode($alert);
		exit;
	}

	$db->query("INSERT INTO ".prefix."survies (title, pagination, colors, author, date)
				SELECT title, pagination, colors, '".us_id."','".time()."'
				FROM ".prefix."survies
				WHERE id = '{$id}'");

	$rs = db_rs("survies WHERE author = '".us_id."' ORDER BY id DESC");

	$db->query("INSERT INTO ".prefix."steps (survey, sort, author, date)
				SELECT {$rs['id']}, sort, '".us_id."','".time()."'
				FROM ".prefix."steps
				WHERE survey = '{$id}'");

	$db->query("INSERT INTO ".prefix."questions (title, description, survey, author, date, step, status, type, inline, crows, icon, file, sort, scale1, scale2, scale3, scale4, scale5)
				SELECT title, description, '{$rs['id']}', '".us_id."','".time()."', step, status, type, inline, crows, icon, file, sort, scale1, scale2, scale3, scale4, scale5
				FROM ".prefix."questions
				WHERE survey = '{$id}'");

				$sql_s = $db->query("SELECT * FROM ".prefix."questions WHERE survey = '{$rs['id']}' ORDER BY id ASC") or die ($db->error);
				if($sql_s->num_rows){
					while($rs_s = $sql_s->fetch_assoc()){
						$db->query("INSERT INTO ".prefix."answers (survey, title, author, date, step, status, type, question, question_id, image)
									SELECT {$rs['id']}, title, '".us_id."','".time()."', step, status, type, question, '{$rs_s['id']}', image
									FROM ".prefix."answers
									WHERE survey = '{$id}' && question = '{$rs_s['sort']}'");
					}
				}
				$sql_s->close();

				$alert = ['id' => $id, 'type' => 'success', 'alert' => $lang['alerts']['surveydone'] , 'url' => path."/index.php?pg=editor&id=".$rs['id']];


	echo json_encode($alert);
}


#############################
####                     ####
####    SURVEY EDITOR    ####
####                     ####
#############################


/* ----------------------------
				Editor Send
 ----------------------------*/

elseif($pg == 'surveyeditorsend') {
	include __DIR__ . "/ajax/surveyeditorsend.php";
}

/* ----------------------------
				Editor Logics
 ----------------------------*/

elseif($pg == 'sendlogics'){

	$id         = isset($_POST['id']) ? (int)($_POST['id'])                 : 0;
	$survey     = isset($_POST['survey']) ? (int)($_POST['survey'])         : 0;
	$action     = isset($_POST['action']) ? (int)($_POST['action'])         : 0;
	$question1  = isset($_POST['question1']) ? (int)($_POST['question1'])   : 0;
	$question2  = isset($_POST['question2']) ? (int)($_POST['question2'])   : 0;
	$condition1 = isset($_POST['condition1']) ? (int)($_POST['condition1']) : 0;
	$condition2 = isset($_POST['condition2']) ? (int)($_POST['condition2']) : 0;
	$answer     = isset($_POST['answer']) ? sc_sec($_POST['answer'])        : '';


	if( !$survey || !$question1 || !$question2 ){
		$alert = [
			'type'  =>'danger',
			'alert' => fh_alerts($lang['alerts']['required'])
		];
	} else {
		$data = [
			'survey'     => $survey,
			'action'     => $action,
			'question1'  => $question1,
			'question2'  => $question2,
			'condition1' => $condition1,
			'condition2' => $condition2,
			'answer'     => $answer
		];
		if($id){
			db_update('logics', $data, $id);
		} else {
			db_insert( 'logics', $data );
			$html = '<div class="pt-editorloginitem mt-2">
					<div class="pt-logicsoptions">
						<span>'.$logic_actions[$action].'</span>
						<span>Q'.db_get("questions", "sort", $question2).': <em>'.db_get("questions", "title", $question1).'</em></span>
						<span>'.$logic_condition1[$condition1].'</span>
						<span>Q'.db_get("questions", "sort", $question2).': <em>'.db_get("questions", "title", $question2).'</em></span>
						<span>'.$logic_condition2[$condition2].'</span>
						<span><em>'.db_get("answers", "title", $answer).'</em></span>
					</div>
				</div>';
		}

		if( $action == 2){
			db_update('questions', ['hide' => 1], $question1);
		}


		$alert = [
			'type'  =>'success',
			'alert' => fh_alerts($lang['alerts']['alldone'], 'success'),
			'html'  => $html
		];
	}

	echo json_encode($alert);

}


/* ----------------------------
				Editor Logic Answers
 ----------------------------*/

elseif($pg == 'getanswers'){

	$sort   = db_rows("questions WHERE id = '{$id}'") ? db_get("questions", "sort", $id)   : 0;
	$step   = db_rows("questions WHERE id = '{$id}'") ? db_get("questions", "step", $id)   : 0;
	$survey = db_rows("questions WHERE id = '{$id}'") ? db_get("questions", "survey", $id) : 0;
	$type   = db_rows("questions WHERE id = '{$id}'") ? db_get("questions", "type", $id)   : 0;
	$rows   = db_rows("questions WHERE id = '{$id}'") ? db_get("questions", "crows", $id)   : 0;

	if( in_array($type, ['radio', 'checkbox', 'dropdown', 'image']) ){
		echo '<select class="selectpicker" name="answer">';

		$a_sql = $db->query("SELECT * FROM ".prefix."answers WHERE survey = '{$survey}' && step ='{$step}' && question = '{$sort}' ORDER BY id ASC") or die ($db->error);
		$i=0;
		while($a_rs = $a_sql->fetch_assoc()):
			$i++;
			echo "<option value='".$a_rs['id']."'>A".$i.": ".$a_rs['title']."</option>";
		endwhile;

		echo "</select>";
	} elseif( in_array($type, ['input', 'textarea']) ){
		echo '<input type="text" name="answer" />';
	} elseif( in_array($type, ['scale']) ){
		echo '<select class="selectpicker" name="answer">';
		for ($i=0; $i <= 10; $i++) {
			echo "<option value='".$i."''>A".($i+1).": ".$i."</option>";
		}
		echo "</select>";
	} elseif( in_array($type, ['rating']) ){
		echo '<select class="selectpicker" name="answer">';
		for ($i=1; $i <= $rows; $i++) {
			echo "<option value='".$i."''>A".$i.": ".$i."</option>";
		}
		echo "</select>";
	}

}


/* ----------------------------
				Editor Preview
 ----------------------------*/

elseif($pg == 'sendsurveypreview'){

	if (!us_level) {
		exit;
	}

	$survey_questions_arr = isset($_POST['question']) ? ($_POST['question'])                               : [];
	$survey_steps         = isset($_POST['survey_steps']) ? fh_array_start(sc_sec($_POST['survey_steps'])) : [];

	$survey_questions     = [];

	if( !empty($survey_questions_arr) ){

		foreach ($survey_questions_arr as $k => $v) {
			$survey_questions_v = sc_sec(explode('i', sc_sec($k)));
			$survey_questions[$survey_questions_v[2]]                = [];
			$survey_questions[$survey_questions_v[2]]["step"]        = $survey_questions_v[1];
			$survey_questions[$survey_questions_v[2]]["question"]    = isset($v["question"]) ? sc_sec($v["question"]) : '';
			$survey_questions[$survey_questions_v[2]]["type"]        = isset($v["type"]) ? sc_sec($v["type"]) : '';
			$survey_questions[$survey_questions_v[2]]["description"] = isset($v["description"]) ? sc_sec($v["description"]) : '';
			$survey_questions[$survey_questions_v[2]]["status"]      = isset($v["status"]) ? 1 : 0;
			$survey_questions[$survey_questions_v[2]]["inline"]      = isset($v["inline"]) ? 1 : 0;
			$survey_questions[$survey_questions_v[2]]["rows"]        = isset($v["rows"]) ? sc_sec($v["rows"]) : 0;
			$survey_questions[$survey_questions_v[2]]["icon"]        = isset($v["icon"]) ? sc_sec($v["icon"]) : '';
			$survey_questions[$survey_questions_v[2]]["filetype"]    = isset($v["filetype"]) ? sc_sec($v["filetype"]) : '';
			$survey_questions[$survey_questions_v[2]]["id"]          = isset($v["id"]) ? sc_sec($v["id"]) : '';
			if( !($survey_questions[$survey_questions_v[2]]["id"]) ){
				$survey_questions[$survey_questions_v[2]]["answers"] = isset($v["answers"]) ? (sc_sec($v["type"]) != "text" ? fh_array_start(sc_sec(explode('\r\n', sc_sec($v["answers"])))) : sc_sec($v["answers"]) ) : '';
				$survey_questions[$survey_questions_v[2]]["images"] = isset($v["images"]) ? fh_array_start(sc_sec($v["images"])) : '';
			} else {
				$survey_questions[$survey_questions_v[2]]["answers"] = isset($v["answers"]) ? sc_sec($v["answers"]) : '';
				$survey_questions[$survey_questions_v[2]]["images"]  = isset($v["images"]) ? sc_sec($v["images"]) : '';
			}
		}

		echo '<div class="pt-survey pt-newsurvey">';
		foreach ($survey_questions as $key => $value) :
			$rs_s = $value;
			?>
			<div class="logincactionstoquestion<?php echo (!$rs_s['status'] ? '' : ' pt-bar-hidden');?>" rel="<?=$rs_s['id']?>">
				<h3 class="pt-survey-head"><?=$rs_s['question']?></h3>
				<?php if ( $rs_s['description'] ): ?><p class="pt-survey-head"><?=$rs_s['description']?></p><?php endif; ?>
				<div class="pt-survey-answers<?php echo ( $rs_s['rows'] ? ' pt-form-inline pt-col'.$rs_s['rows'] : '' ) ?>">
					<?php echo fh_get_answer2($rs_s); ?>
				</div>
			</div>
			<?php
		endforeach;
		echo "</div>";

	} else {
		echo '<div class="pt-survey pt-newsurvey text-center">'.$lang['editor']["nofound"].'</div>';
	}

}
