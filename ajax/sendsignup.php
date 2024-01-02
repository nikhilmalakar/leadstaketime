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
#	¤  Last Update: 10/02/2022                   ¤   #
#	¤                                            ¤   #
#¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤#
# -------------------------------------------------#

if($_SERVER['REQUEST_METHOD'] === 'POST'){
	if(!us_level || us_level == 6){
		$reg_name    = isset($_POST['reg_name']) ? sc_sec($_POST['reg_name']) : '';
		$reg_pass    = isset($_POST['reg_pass']) ? sc_sec($_POST['reg_pass']) : '';
		$reg_email   = isset($_POST['reg_email']) ? sc_sec($_POST['reg_email']) : '';

		if(empty($reg_name) || empty($reg_pass) || empty($reg_email)){
			$alert = [
				'type'  =>'danger',
				'alert' => fh_alerts($lang['alerts']['required'])
			];
		} elseif(!preg_match('/^[\p{L}\' -]+$/u',$reg_name)){
			$alert = [
				'type'  =>'danger',
				'alert' => fh_alerts($lang['alerts']['signupchar_username'])
			];
		} elseif(strlen($reg_name) < 3 || strlen($reg_name) > 15){
			$alert = [
				'type'  =>'danger',
				'alert' => fh_alerts($lang['alerts']['signuplimited_username'])
			];
		} elseif(db_rows("users WHERE username = '".$reg_name."'")){
			$alert = [
				'type'  =>'danger',
				'alert' => fh_alerts($lang['alerts']['signupexist_username'])
			];
		} elseif(strlen($reg_pass) < 6 || strlen($reg_pass) > 12){
			$alert = [
				'type'  =>'danger',
				'alert' => fh_alerts($lang['alerts']['signuplimited_pass'])
			];
		} elseif(!sc_check_email($reg_email)){
			$alert = [
				'type'  =>'danger',
				'alert' => fh_alerts($lang['alerts']['signupcheck_email'])
			];
		} elseif(db_rows("users WHERE email = '".$reg_email."'")){
			$alert = [
				'type'  =>'danger',
				'alert' => fh_alerts($lang['alerts']['signupexist_email'])
			];
		} else {
			$data = [
				'username'   => "{$reg_name}",
				'email'      => "{$reg_email}",
				'password'   => sc_pass($reg_pass),
				'date'       => time(),
				'level'      => "1"
			];

			db_insert("users", $data);

			$alert = [
					'type'  =>'success',
					'alert' => fh_alerts($lang['alerts']['signupsuccess'], 'success')
			];

		}

		echo json_encode($alert);
	}
}
