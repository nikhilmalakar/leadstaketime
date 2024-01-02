<?php


function fh_is_url($url){
  if(!$url || !is_string($url)) return false;
  if( ! preg_match('/^http(s)?:\/\/[a-z0-9-]+(\.[a-z0-9-]+)*(:[0-9]+)?(\/.*)?$/i', $url) ) return false;
  return true;
}

$survey_title         = isset($_POST['survey_title']) ? sc_sec($_POST['survey_title'])                 : '';
$survey_startdate     = isset($_POST['survey_startdate']) && !empty($_POST['survey_startdate']) ? strtotime(sc_sec($_POST['survey_startdate']))         : 0;
$survey_enddate       = isset($_POST['survey_enddate']) && !empty($_POST['survey_enddate']) ? strtotime(sc_sec($_POST['survey_enddate']))             : 0;
$survey_url           = isset($_POST['survey_url']) ? sc_sec($_POST['survey_url'])                     : '';
$survey_password      = isset($_POST['survey_password']) ? sc_sec($_POST['survey_password'])           : '';

$survey_questions_arr = isset($_POST['question']) ? ($_POST['question'])                               : [];
$survey_steps         = isset($_POST['survey_steps']) ? fh_array_start(sc_sec($_POST['survey_steps'])) : [];

$survey_pagination    = isset($_POST['survey_pagination']) ? 1                                         : 0;
$survey_status        = isset($_POST['survey_status']) ? 1                                             : 0;
$survey_private       = isset($_POST['survey_private']) ? 1                                            : 0;
$survey_byip          = isset($_POST['survey_byip']) ? 1                                               : 0;

$survey_share         = isset($_POST['survey_share']) ? 1                                              : 0;
$survey_template      = isset($_POST['survey_template']) ? 1                                              : 0;
$survey_email         = isset($_POST['survey_email']) ? 1                                              : 0;
$survey_email_body    = isset($_POST['survey_email_body']) ? sc_sec($_POST['survey_email_body'])       : '';
$survey_design    = isset($_POST['design']) ? sc_sec($_POST['design'])       : '';


$survey_id            = isset($_POST['survey_id']) ? (int)($_POST['survey_id'])                        : 0;

$alert = [];



if( empty($survey_title) ){
	$alert = ["alert" =>  $lang['alerts']['surveyerror'], "type" => "error", "field" => "survey_title"];
} else if( db_rows("survies WHERE title = '{$survey_title}' && date >= '".(time()-360)."'") && !$survey_id ){
	$alert = ["alert" =>  $lang['alerts']['surveyjust'], "type" => "error"];
} else if( !empty($survey_url) && !fh_is_url($survey_url) ){
	$alert = ["alert" =>  $lang['alerts']['surveyurl'], "type" => "error", "field" => "survey_url"];
} else if( !empty($survey_password) && strlen($survey_password) < 8 ){
	$alert = ["alert" => $lang['alerts']['surveypass'], "type" => "error", "field" => "survey_password"];
} else {


		$survey_questions = [];
		$break = false;

		if( !empty($survey_questions_arr) ){

			foreach ($survey_questions_arr as $k => $v) {
				$survey_questions_v = sc_sec(explode('i', sc_sec($k)));
				$survey_questions[$survey_questions_v[2]] = [];
				$survey_questions[$survey_questions_v[2]]["step"] = $survey_questions_v[1];
				$survey_questions[$survey_questions_v[2]]["question"] = isset($v["question"]) ? sc_sec($v["question"]) : '';
				$survey_questions[$survey_questions_v[2]]["type"] = isset($v["type"]) ? sc_sec($v["type"]) : '';
				$survey_questions[$survey_questions_v[2]]["description"] = isset($v["description"]) ? sc_sec($v["description"]) : '';
				$survey_questions[$survey_questions_v[2]]["status"] = isset($v["status"]) ? 1 : 0;
				$survey_questions[$survey_questions_v[2]]["inline"] = isset($v["inline"]) ? 1 : 0;
				$survey_questions[$survey_questions_v[2]]["rows"] = isset($v["rows"]) ? sc_sec($v["rows"]) : 0;
				$survey_questions[$survey_questions_v[2]]["icon"] = isset($v["icon"]) ? sc_sec($v["icon"]) : '';
				$survey_questions[$survey_questions_v[2]]["filetype"] = isset($v["filetype"]) ? sc_sec($v["filetype"]) : '';
				$survey_questions[$survey_questions_v[2]]["scale1"] = isset($v["scale1"]) ? sc_sec($v["scale1"]) : '';
				$survey_questions[$survey_questions_v[2]]["scale2"] = isset($v["scale2"]) ? sc_sec($v["scale2"]) : '';
				$survey_questions[$survey_questions_v[2]]["scale3"] = isset($v["scale3"]) ? sc_sec($v["scale3"]) : '';
				$survey_questions[$survey_questions_v[2]]["scale4"] = isset($v["scale4"]) ? sc_sec($v["scale4"]) : '';
				$survey_questions[$survey_questions_v[2]]["scale5"] = isset($v["scale5"]) ? sc_sec($v["scale5"]) : '';
				$survey_questions[$survey_questions_v[2]]["id"] = isset($v["id"]) ? sc_sec($v["id"]) : '';
				if( !($survey_questions[$survey_questions_v[2]]["id"]) ){
					$survey_questions[$survey_questions_v[2]]["answers"] = isset($v["answers"]) ? (sc_sec($v["type"]) != "text" ? fh_array_start(sc_sec(explode('\r\n', sc_sec($v["answers"])))) : sc_sec($v["answers"]) ) : '';
					$survey_questions[$survey_questions_v[2]]["images"] = isset($v["images"]) ? fh_array_start(sc_sec($v["images"])) : '';
				} else {
					$survey_questions[$survey_questions_v[2]]["answers"] = isset($v["answers"]) ? sc_sec($v["answers"]) : '';
					$survey_questions[$survey_questions_v[2]]["images"] = isset($v["images"]) ? sc_sec($v["images"]) : '';
				}


				if( !$survey_questions[$survey_questions_v[2]]["question"] && $survey_questions[$survey_questions_v[2]]["type"] != "text"){
					$alert = ["alert" => $lang['alerts']['surveyquestion'], "type" => "error", "field" => "question[".sc_sec($k)."][question]"];
					$break = true;
					break;
				} else if( empty($survey_questions[$survey_questions_v[2]]["answers"]) && !in_array($survey_questions[$survey_questions_v[2]]["type"], ["rating", "scale", "file"]) ){
					$alert = ["alert" => $lang['alerts']['surveyanswers'], "type" => "error", "field" => "question[".sc_sec($k)."][answers]"];
					$break = true;
					break;
				} else {
					$break = false;
					$alert = ["alert" => $lang['alerts']['surveydone'], "type" => "success"];
				}


			}

		} else {
			$alert = ["alert" => $lang['alerts']['surveynoq'], "type" => "error"];
			$break = true;
		}



		if( !$break ){

			#------------------- Survey
			# Survey Data
			$data_u = [
				"title"           => $survey_title,
				"private"         => $survey_private,
				"status"          => $survey_status,
				"pagination"      => $survey_pagination,
				"byip"            => $survey_byip,
				"url"             => $survey_url,
				"password"        => $survey_password,
				"startdate"       => $survey_startdate,
				"enddate"         => $survey_enddate,
				"share"           => $survey_share,
				"send_email"      => $survey_email,
				"template" => $survey_template,
				"send_email_body" => $survey_email_body,
				"colors"          => $survey_design ? json_encode($survey_design) : ''
			];

			if( $survey_id ){
				db_update("survies", $data_u, $survey_id);
			} else {
				$data_u['date']   = time();
				$data_u['author'] = us_id;
				db_insert("survies", $data_u);
			}

			# Get Survey Id
			$s_gid = $survey_id ? $survey_id : db_get("survies", "id", us_id, "author", "ORDER BY id DESC LIMIT 1");


			#------------------- Step
			# Step Insert
			foreach ($survey_steps as $key => $value) {
				if( !db_rows("steps WHERE survey = '{$s_gid}' && sort = '{$value}'") ){
					db_insert("steps", [ "survey" => $s_gid, "sort" => $value ]);
				}
			}


			#------------------- Question
			# Question Insert
			foreach ($survey_questions as $key => $value) {
					if( !$survey_id || ($survey_id && !$value["id"]) ){

							db_insert("questions", [
								"title"       => $value["question"],
								"description" => $value["description"],
								"survey"      => $s_gid,
								"step"        => $value["step"],
								"status"      => $value["status"],
								"type"        => $value["type"],
								"inline"      => $value["inline"],
								"crows"        => $value["rows"],
								"icon"        => $value["icon"],
								"file"        => $value["filetype"],
								"scale1"        => $value["scale1"],
								"scale2"        => $value["scale2"],
								"scale3"        => $value["scale3"],
								"scale4"        => $value["scale4"],
								"scale5"        => $value["scale5"],
								"sort"        => $key,
								"author"      => us_id,
								"date"        => time()
							]);

							$ques_new_id = $db->insert_id;

							if( !empty($value["answers"]) ){
								if($value["type"] != "text"){
									foreach ($value["answers"] as $kk => $vv) {
										db_insert("answers", [
											"title"       => $vv,
											"survey"      => $s_gid,
											"step"        => $value["step"],
											"status"      => $value["status"],
											"type"        => $value["type"],
											"question"    => $key,
											"question_id" => $ques_new_id,
											"image"       => isset($value["images"][$kk]) ? sc_sec($value["images"][$kk]) : '',
											"author"      => us_id,
											"date"        => time()
										]);
									}
								} else {
									db_insert("answers", [
										"title"       => $value["answers"],
										"survey"      => $s_gid,
										"step"        => $value["step"],
										"status"      => $value["status"],
										"type"        => $value["type"],
										"question"    => $key,
										"question_id" => $ques_new_id,
										"image"       => '',
										"author"      => us_id,
										"date"        => time()
									]);
								}


							}


				} else {
						db_update("questions", [
							"title"       => $value["question"],
							"description" => $value["description"],
							"step"        => $value["step"],
							"status"      => $value["status"],
							"type"        => $value["type"],
							"inline"      => $value["inline"],
							"crows"        => $value["rows"],
							"icon"        => $value["icon"],
							"file"        => $value["filetype"],
							"scale1"        => $value["scale1"],
							"scale2"        => $value["scale2"],
							"scale3"        => $value["scale3"],
							"scale4"        => $value["scale4"],
							"scale5"        => $value["scale5"],
							"sort"        => $key
						], $value["id"]);
						if( !empty($value["answers"]) ){
								foreach ($value["answers"] as $kk => $vv) {
									if( $survey_id && db_rows("answers WHERE id = '{$kk}' && survey = '{$s_gid}'") ){
										db_update("answers", [
											"title"       => $vv,
											"step"        => $value["step"],
											"status"      => $value["status"],
											"image"       => isset($value["images"][$kk]) ? sc_sec($value["images"][$kk]) : '',
											"question"    => $key
										], $kk);
									} else {
										db_insert("answers", [
											"title"       => $vv,
											"survey"      => $s_gid,
											"step"        => $value["step"],
											"status"      => $value["status"],
											"type"        => $value["type"],
											"image"       => isset($value["images"][$kk]) ? sc_sec($value["images"][$kk]) : '',
											"question"    => $key,
											"question_id" => $value["id"],
											"author"      => us_id,
											"date"        => time()
										]);
									}
								}
						}
					}
			}





		}

		$alert["html"] = isset($s_gid) ? path."/index.php?pg=survey&id=".$s_gid."&t=".fh_seoURL($survey_title) : 0;

}


echo json_encode($alert);
