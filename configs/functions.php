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

function db_rows($table, $field = 'id'){
	global $db;
	$sql = $db->query("SELECT {$field} FROM ".prefix."{$table}") or die($db->error);
	$rs  = $sql->num_rows;
	$sql->close();
	return $rs;
}

function db_get($table, $field, $id, $where='id', $other=false){
	global $db;
	$sql = $db->query("SELECT {$field} FROM ".prefix."{$table} WHERE {$where} = '{$id}' {$other}") or die($db->error);
	if($sql->num_rows > 0){
		$rs = $sql->fetch_row();
		$sql->close();
		return $rs[0];
	}
}

function db_insert($table, $array) {
	global $db;
	$columns = implode(',', array_keys($array));
	$values  = "'" . implode("','", array_values($array)) . "'";;
	$query   = "INSERT INTO ".prefix."{$table} ({$columns}) VALUES ({$values})";
	return $db->query($query) or die($db->error);
}

function db_update($table, $array, $id, $id_col = 'id', $other = '') {
	global $db;
	$columns = array_keys($array);
	$values  = array_values($array);
	$count   = count($columns);

	$update  = '';
	for($i=0;$i<$count;$i++)
		$update .= "{$columns[$i]} = '{$values[$i]}'" . ($count == $i+1 ? '' : ', ');

	$query   = "UPDATE ".prefix."{$table} SET {$update} WHERE {$id_col} = '{$id}' {$other}";
	return $db->query($query) or die($db->error);
}

function db_delete($table, $id, $id_col = 'id', $more = '') {
	global $db;
	$query = "DELETE FROM ".prefix."{$table} WHERE {$id_col} = '{$id}' {$more}";
	return $db->query($query) or die($db->error);
}

function db_global(){
	global $db;
	$sql = $db->query("SELECT * FROM ".prefix."configs") or die($db->error);
	if($sql){
		while( $rs = $sql->fetch_assoc() )
			define( $rs['variable'], $rs['value'] );

		$sql->close();
	}
}

function db_update_global($var, $val){
	return db_update("configs", ['value' => "{$val}"], $var, 'variable');
}

function db_login_details(){
	global $db;
	$log_session = ( isset($_SESSION['login']) ? (int)$_SESSION['login'] : ( isset($_COOKIE['login']) ? (int)$_COOKIE['login'] : 0 ) );

  if( isset($log_session) && $log_session != 0 ){
   $sql = $db->query( "SELECT * FROM ".prefix."users WHERE id = '{$log_session}'" ) or die($db->error);
   $rs  = $sql->fetch_assoc();
   foreach ( $rs as $key => $val )
         define( 'us_'. $key, $val);

   $sql->close();
  } else {
		$sql = $db->query( "DESCRIBE ".prefix."users" ) or die($db->error);
		while( $rs = $sql->fetch_assoc() ){
			define( 'us_' . $rs['Field'], (in_array(str_replace(' unsigned', '', $rs['Type']), ['tinyint(1)','int(11)','int(10)']) ? 0 : ''));
		}

		$sql->close();
  }
}

function db_rs($data) {
	global $db;
	$data = $db->query("SELECT * FROM ".prefix.$data) or die($db->error);
	$rs = $data->num_rows ? $data->fetch_assoc() : '';
	$data->close();
	return $rs;
}

function sc_check_email($email){
	$address = strtolower(trim($email));
	return (preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix",$address));
}

function sc_pass($data) {
	return sha1($data);
}

function strip_tags_content($text, $tags = '', $invert = FALSE){
    preg_match_all('/<(.+?)[\s]*\/?[\s]*>/si', trim($tags), $tags);
    $tags = array_unique($tags[1]);

    if(is_array($tags) AND count($tags) > 0) {
        if($invert == FALSE) {
            return preg_replace('@<(?!(?:'. implode('|', $tags) .')\b)(\w+)\b.*?>.*?</\1>@si', '', $text);
        } else {
            return preg_replace('@<('. implode('|', $tags) .')\b.*?>.*?</\1>@si', '', $text);
        }
    } elseif($invert == FALSE) {
        return preg_replace('@<(\w+)\b.*?>.*?</\1>@si', '', $text);
    }
    return $text;
}


function sc_sec($data, $html = false) {
	global $db;
	if(gettype($data) == "array")
		return sc_array($data);
	$post = $db->real_escape_string($data);
	$post = trim($post);
	$post = ($html) ? htmlspecialchars($post) : htmlspecialchars(strip_tags_content($post));
	return $post;
}

function sc_array($data, $dataType = 'char'){
	$array = array();
	$data  = array_filter($data);
  if(count($data)){
    foreach( $data AS $k => $d )
      $array[$k] = $dataType == 'int' ? (int)($d) : sc_sec($d);
  }
	return $array;
}


function fh_array_start($exploded){
	return !empty($exploded) ? array_combine(range(1, count($exploded)), $exploded) : '';
}



function fh_title(){
	global $id, $pg;
	$title = '';
	switch ($pg) {
		case 'survey': $title = db_get("survies", "title", $id).' - '.site_title; break;
		case 'plans': $title = 'Plans - '.site_title; break;
		case 'dashboard': $title = 'Dashboard - '.site_title; break;
		case 'rapport': $title = 'Rapport - '.site_title; break;
		case 'responses': $title = 'Responses - '.site_title; break;
		case 'newsurvey': $title = 'New Survey - '.site_title; break;
		case 'userdetails': $title = 'Details - '.site_title; break;

		default: $title = site_title; break;
	}
	return $title;
}

function fh_access($type) {
	global $db;
	$access = true;
	if(us_level == 6) $access = true;
	else {
		if($type == "survey") $access = ( db_rows("survies WHERE FROM_UNIXTIME(date,'%m-%Y') = '".date('m-Y', time())."' && author = '".us_id."'") >= surveys_month ? false : true);

		elseif($type == "design" && !survey_design ) $access = false;
		elseif($type == "rapport" && !surveys_rapport ) $access = false;
		elseif($type == "export" && !surveys_export ) $access = false;
		elseif($type == "iframe" && !surveys_iframe ) $access = false;
		elseif($type == "ads" && !show_ads ) $access = false;
	}
	return $access;
}


if (! function_exists('array_column')) {
  function array_column(array $input, $columnKey, $indexKey = null) {
    $array = array();
    foreach ($input as $value) {
      if ( !array_key_exists($columnKey, $value)) {
        trigger_error("Key \"$columnKey\" does not exist in array");
        return false;
      }
      if (is_null($indexKey)) {
        $array[] = $value[$columnKey];
      }
      else {
        if ( !array_key_exists($indexKey, $value)) {
          trigger_error("Key \"$indexKey\" does not exist in array");
          return false;
        }
        if ( ! is_scalar($value[$indexKey])) {
          trigger_error("Key \"$indexKey\" does not contain scalar value");
          return false;
        }
        $array[$value[$indexKey]] = $value[$columnKey];
      }
    }
    return $array;
  }
}

function fh_seoURL($title){
	$turkish = array("ı", "ğ", "ü", "ş", "ö", "ç");
	$english   = array("i", "g", "u", "s", "o", "c");
	$title = str_replace($turkish, $english, $title);


	$cyr = [
    'ж',  'ч',  'щ',   'ш',  'ю',  'а', 'б', 'в', 'г', 'д', 'е', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ъ', 'ь', 'я',
    'Ж',  'Ч',  'Щ',   'Ш',  'Ю',  'А', 'Б', 'В', 'Г', 'Д', 'Е', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ъ', 'Ь', 'Я'
	];
  $lat = [
    'zh', 'ch', 'sht', 'sh', 'yu', 'a', 'b', 'v', 'g', 'd', 'e', 'z', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'h', 'c', 'y', 'x', 'q',
    'Zh', 'Ch', 'Sht', 'Sh', 'Yu', 'A', 'B', 'V', 'G', 'D', 'E', 'Z', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'F', 'H', 'c', 'Y', 'X', 'Q'
	];

	$title = str_replace($cyr, $lat, $title);

	$cyr = [
		'Љ', 'Њ', 'Џ', 'џ', 'ш', 'ђ', 'ч', 'ћ', 'ж', 'љ', 'њ', 'Ш', 'Ђ', 'Ч', 'Ћ', 'Ж','Ц','ц', 'а','б','в','г','д','е','ё','ж','з','и','й','к','л','м','н','о','п', 'р','с','т','у','ф','х','ц','ч','ш','щ','ъ','ы','ь','э','ю','я', 'А','Б','В','Г','Д','Е','Ё','Ж','З','И','Й','К','Л','М','Н','О','П', 'Р','С','Т','У','Ф','Х','Ц','Ч','Ш','Щ','Ъ','Ы','Ь','Э','Ю','Я'
  ];
  $lat = [
		'Lj', 'Nj', 'Dž', 'dž', 'š', 'đ', 'č', 'ć', 'ž', 'lj', 'nj', 'Š', 'Đ', 'Č', 'Ć', 'Ž','C','c', 'a','b','v','g','d','e','io','zh','z','i','y','k','l','m','n','o','p', 'r','s','t','u','f','h','ts','ch','sh','sht','a','i','y','e','yu','ya', 'A','B','V','G','D','E','Io','Zh','Z','I','Y','K','L','M','N','O','P', 'R','S','T','U','F','H','Ts','Ch','Sh','Sht','A','I','Y','e','Yu','Ya'
  ];

	$title = str_replace($cyr, $lat, $title);

	$_letters = array('ا' => 'a','ب' => 'b', 'ت' => 't', 'و'=>'o','ـ'=>'','ث' => 'th', 'ج' => 'j', 'ح' => 'h', 'خ' => 'kh', 'د' => 'd', 'ذ' => 'z', 'ص' => 'sa',  'ض' => 'da', 'ع' => 'e', 'غ' => 'g', 'ف' => 'f', 'ق' => 'k', 'ط' => 'ta','ظ' => 'za', 'م' => 'm', 'ك' => 'k', 'س' => 's', 'ش' => 'sh', 'ﻻ' => 'la', 'ي'=>'e','ى' => 'y', 'ل' => 'l', 'ة' => 't', 'ه' => 'h', 'ؤ' => 'oa', 'ئ' => 'eo', 'ن' => 'n', 'ز' => 'z', 'ر' => 'r', ' '=> ' ');

	$title = strtr($title, $_letters);




	$title = strtolower(trim(preg_replace('~[^0-9a-z]+~i', '-', html_entity_decode(preg_replace('~&([a-z]{1,2})(?:acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml);~i', '$1', htmlentities($title, ENT_QUOTES, 'UTF-8')), ENT_QUOTES, 'UTF-8')), '-'));

	return $title;
}

function fh_email_p($text, $link = '#', $rep = ''){
	$wrapper = '
		width: 480px;
		margin: 12px auto;
		color: #666;
		font-size: 16px;
		border: 1px solid #EEE;
		padding: 24px;
		border-radius: 3px;
	';
	$button = '
		display: block;
		background: #f43438;
		color: #fff;
		height: 48px;
		line-height: 48px;
		padding: 0 24px;
		font-size: 18px;
		border-radius: 3px;
		text-align: center;
		text-decoration: none;
	';
	$text = '<div style="'.$wrapper.'">'.$text.'</div>';
	$match = [
		'/\{button\}/',
		'/\{button bg=\#([A-Za-z0-9]+)\}/',
		'/\{\/button\}/',
	];
	$replace = [
		'<a href="'.$link.'" style="'.$button.'">',
		'<a href="'.$link.'" style="'.$button.'background:#$1">',
		'</a>',
	];

	$pr_r = preg_replace($match, $replace, $text);
	$pr_r = str_replace('\r\n', '<br>', $pr_r);

	if(!$rep)
		return $pr_r;
	else
		return preg_replace(['/\{name\}/', '/\{email\}/', '/\{title\}/'], $rep, $pr_r);
}

function fh_user($id, $link = true, $cut = false, $count = 25){
	global $db;
	if(!$id){
		return false;
	}
  $sql = $db->query("SELECT id, username, plan FROM ".prefix."users WHERE id = '{$id}'");
  $rs = $sql->fetch_assoc();
	$color = ( $rs['plan']==1 ? '#00cec9' : ( $rs['plan']==2 ? '#ff7675' : ( $rs['plan']==3 ? '#6c5ce7' : '')));
	$username = $rs['username'];
	return ($link) ? '<a href="#"'.($color?' style="color:'.$color.'"':'').'>'.$username.'</a>' : $username;
}

function fh_alerts($alert, $type = 'danger', $redirect = false, $html = true) {
	global $lang;

	$title = $lang['alerts'][$type];
  return ($html) ? '<div class="alert alert-'.$type.'">
            <strong>'.$title.'</strong> '.$alert.'
          </div>'. ($redirect ? '<meta http-equiv="refresh" content="1;url='.$redirect.'">' : false) : '<strong>'.$title.'</strong> '.$alert;
}

function randomColor(){
  $result = array('rgb' => '', 'hex' => '');
  foreach(array('r', 'b', 'g') as $col){
    $rand = mt_rand(0, 255);
    $dechex = dechex($rand);
    if(strlen($dechex) < 2){
      $dechex = '0' . $dechex;
    }
    $result['hex'] .= $dechex;
  }
  return $result;
}

function fh_ip(){
  foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key){
    if (array_key_exists($key, $_SERVER) === true){
    	foreach (explode(',', $_SERVER[$key]) as $ip){
        $ip = trim($ip); // just to be safe

        if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false){
          return $ip;
        }
      }
    }
  }
}

function fh_get_num($str) {
  preg_match_all('/\d+/', $str, $matches);
  return $matches[0];
}

function fh_social_login( $socialname, $profile ){
	global $lang, $db;

	switch($socialname){
		case 'facebook':
			$socialid  = $profile['id'];
			$username  = $profile['name'];
			$firstname = $profile['first_name'];
			$lastname  = $profile['last_name'];
			$email     = $profile['email'];
			$photo     = $profile['picture']['url'];
			$description  = '';
		break;
		case 'google':
			$socialid  = $profile['id'];
			$username  = $profile['name'];
			$firstname = $profile['given_name'];
			$lastname  = $profile['family_name'];
			$email     = $profile['email'];
			$photo     = $profile['picture'];
			$description  = '';
		break;
		case 'twitter':
			$socialid  = $profile->id;
			$username  = $profile->name;
			$firstname = '';
			$lastname  = '';
			$email     = 'no email address';
			$photo     = $profile->profile_image_url;
			$description  = $profile->description;
		break;
	}


	if(db_rows("users WHERE username = '{$username}' || email = '{$email}'")){
		$sql = $db->query("SELECT id, moderat FROM ".prefix."users WHERE (username = '{$username}' || email = '{$email}') && social_name = '{$socialname}' && social_id = '{$socialid}'");
		if($sql->num_rows){
			$rs = $sql->fetch_assoc();
			$_SESSION['login']  = $rs['id'];
			db_update('users', ["photo"=> $photo], $rs['id']);
			echo "<div class='padding'>".fh_alerts($lang['alerts']['loginsuccess'], "success", path)."</div>";
		} else {
			echo "<div class='padding'>".fh_alerts($lang['alerts']['loginsocial'], "danger", path)."</div>";
		}
	} else {
		db_insert('users', [
			"username"    => $username,
			"firstname"   => $firstname,
			"lastname"    => $lastname,
			"email"       => $email,
			"social_id"   => $socialid,
			"social_name" => $socialname,
			"photo"       => $photo,
			"date"        => time(),
			"level"       => 1
		]);
		$_SESSION['login']  = db_get('users', 'id', $username, 'username', "&& social_name = '{$socialname}' && social_id = '{$socialid}'");
		echo "<div class='padding'>".fh_alerts($lang['alerts']['loginsuccess'], "success", path)."</div>";
	}
}

function fh_go($href = '',$tm = 0){
	echo '<meta http-equiv="refresh" content="'.$tm.'; URL='.$href.'">';
}


function fh_ago($tm = '', $at = true, $rcs = 0) {
	global $lang;
	$cur_tm = time();
	$pr_year = $cur_tm - 3600*24*365;
	$pr_month = $cur_tm - 3600*24*31;
	if( $tm > $pr_month ){
		$dif    = $cur_tm-$tm;
		$pds = [$lang['second'], $lang['minute'], $lang['hour'], $lang['day'], $lang['week'], $lang['month'], $lang['year'], $lang['decade']];

		$lngh   = array(1,60,3600,86400,604800,2630880,31570560,315705600);
		for($v = sizeof($lngh)-1; ($v >= 0)&&(($no = $dif/$lngh[$v])<=1); $v--); if($v < 0) $v = 0; $_tm = $cur_tm-($dif%$lngh[$v]);

		$no = floor($no); if($no <> 1 && $lang['rtl'] != 'rtl_true') $pds[$v] .=($lang['lang'] == 'en' ? 's': ''); $x=sprintf("%d %s ",$no,$pds[$v]);
		if(($rcs == 1)&&($v >= 1)&&(($cur_tm-$_tm) > 0)) $x .= time_ago($_tm);
		if($lang['rtl'] == 'rtl_true') return " {$lang['ago']} {$x}";
		else return "{$x} {$lang['ago']}";
	} else {
    if($lang['lang'] == 'en'){
        return ($at?date('d M, Y \a\t H:i', $tm):date('d M, Y', $tm));
    } else {
        return ($at?date('d M, Y \a\t H:i', $tm):date('d M, Y', $tm));
    }
	}
}

function fh_bbcode($text){
	$match = [
		'/\[B\]/isU',
		'/\[\/B\]/isU',
		'/\[I\]/isU',
		'/\[\/I\]/isU',
		'/\[S\]/isU',
		'/\[\/S\]/isU',
		'/\[U\]/isU',
		'/\[\/U\]/isU',

		'/\[IMG width=(.*) height=(.*)\](.*)\[\/IMG\]/isU',
		'/\[IMG\](.*)\[\/IMG\]/isU',
		'/\[URL=(.+)\]/isU',
		'/\[\/URL\]/isU',

		'/\[COLOR=(.*)\]/isU',
		'/\[\/COLOR\]/isU',
		'/\[SIZE=1\]/isU',
		'/\[SIZE=2\]/isU',
		'/\[SIZE=3\]/isU',
		'/\[SIZE=4\]/isU',
		'/\[SIZE=5\]/isU',
		'/\[SIZE=6\]/isU',
		'/\[SIZE=7\]/isU',
		'/\[\/SIZE\]/isU',

		'/\[h1\](.*)\[\/h1\]/isU',
		'/\[P\](.*)\[\/P\]/isU',
		'/\[LEFT\](.*)\[\/LEFT\]/isU',
		'/\[RIGHT\](.*)\[\/RIGHT\]/isU',
		'/\[CENTER\]/isU',
		'/\[\/CENTER\]/isU',
		'/\[quote\](.*)\[\/quote\]/isU',
		'/\[CODE\](.*)\[\/CODE\]/isU',

		'/\[video\](.*)\[\/video\]/isU',
		'/\[youtube\](.*)\[\/youtube\]/isU',

		'/\[list=1\](.*)\[\/list\]/isU',
		'/\[ul\](.*)\[\/ul\]/isU',
		'/\[ol\](.*)\[\/ol\]/isU',
		'/\[\*\](.*)\[\/\*\]/isU',
		'/\[li\](.*)\[\/li\]/isU',

		'/\[TR\]/isU',
		'/\[\/TR\]/isU',
		'/\[TD\]/isU',
		'/\[\/TD\]/isU',
		'/\[TABLE\]/isU',
		'/\[\/TABLE\]/isU',

		'/\[HR\]/isU',
	];

	$replace = [
		'<b>',
		'</b>',
		'<i>',
		'</i>',
		'<strike>',
		'</strike>',
		'<u>',
		'</u>',

		'<img src="$3" style="width:$1px;height:$2px;" />',
		'<img src="$1" />',
		'<a href="$1">',
		'</a>',

		'<span style="color:$1">',
		'</span>',
		'<span style="font-size:8px">',
		'<span style="font-size:12px">',
		'<span style="font-size:14px">',
		'<span style="font-size:16px">',
		'<span style="font-size:18px">',
		'<span style="font-size:20px">',
		'<span style="font-size:22px">',
		'</span>',

		'<h1>$1</h1>',
		'<p>$1</p>',
		'<p class="text-left">$1</p>',
		'<p class="text-right">$1</p>',
		'<p class="text-center">',
		'</p>',
		'<blockquote>$1</blockquote>',
		'<pre>$1</pre>',

		'<iframe src="https://www.youtube.com/embed/$1" width="560" height="420" frameborder="0"></iframe>',
		'<iframe src="https://www.youtube.com/embed/$1" width="560" height="420" frameborder="0"></iframe>',

		'<ul class="decimal">$1</ul>',
		'<ul class="circle">$1</ul>',
		'<ol class="decimal">$1</ol>',
		'<li>$1</li>',
		'<li>$1</li>',
		'<tr>',
		'</tr>',
		'<td>',
		'</td>',
		'<table>',
		'</table>',

		'<hr/>',
	];


	$regex = '/\[font=.*?\]|\[\/font\]/i';
	$text = preg_replace($regex, '', $text);

	return nl2br(preg_replace($match, $replace, $text));
}


function ip_info($ip = NULL, $purpose = "location", $deep_detect = TRUE) {
  $output = NULL;
  if (filter_var($ip, FILTER_VALIDATE_IP) === FALSE) {
    $ip = $_SERVER["REMOTE_ADDR"];
    if ($deep_detect) {
      if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP))
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
      if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP))
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }
  }
  $purpose    = str_replace(array("name", "\n", "\t", " ", "-", "_"), NULL, strtolower(trim($purpose)));
  $support    = array("country", "countrycode", "state", "region", "city", "location", "address");
  $continents = array(
    "AF" => "Africa",
    "AN" => "Antarctica",
    "AS" => "Asia",
    "EU" => "Europe",
    "OC" => "Australia (Oceania)",
    "NA" => "North America",
    "SA" => "South America"
  );
  if (filter_var($ip, FILTER_VALIDATE_IP) && in_array($purpose, $support)) {
    $ipdat = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip));
    if (@strlen(trim($ipdat->geoplugin_countryCode)) == 2) {
      switch ($purpose) {
        case "location":
          $output = array(
              "city"           => @$ipdat->geoplugin_city,
              "state"          => @$ipdat->geoplugin_regionName,
              "country"        => @$ipdat->geoplugin_countryName,
              "country_code"   => @$ipdat->geoplugin_countryCode,
              "continent"      => @$continents[strtoupper($ipdat->geoplugin_continentCode)],
              "continent_code" => @$ipdat->geoplugin_continentCode
          );
          break;
        case "address":
          $address = array($ipdat->geoplugin_countryName);
          if (@strlen($ipdat->geoplugin_regionName) >= 1)
              $address[] = $ipdat->geoplugin_regionName;
          if (@strlen($ipdat->geoplugin_city) >= 1)
              $address[] = $ipdat->geoplugin_city;
          $output = implode(", ", array_reverse($address));
          break;
        case "city":
          $output = @$ipdat->geoplugin_city;
          break;
        case "state":
          $output = @$ipdat->geoplugin_regionName;
          break;
        case "region":
          $output = @$ipdat->geoplugin_regionName;
          break;
        case "country":
          $output = @$ipdat->geoplugin_countryName;
          break;
        case "countrycode":
          $output = @$ipdat->geoplugin_countryCode;
          break;
      }
    }
  }
  return $output;
}



function fh_get_answer1($rs) {
	global $countries, $phones, $a, $_COOKIE, $db, $lang;

	$html  = '';
	$cook  = '';
	$tp    = $rs['type'];
	$icon  = false;
	$class = '';

	if($tp == "date") {
		$class = ' class="datepicker-here"';
		$icon  = "fas fa-calendar-alt";
	}
	if($tp == "email") {
		$icon = "fas fa-at";
	}
	if($tp == "phone") {
		$icon = "fas fa-phone";
	}
	if($tp == "country") {
		$icon = true;
	}


	$byip    = db_get("survies", "byip", $rs['survey']);
	$rosresp = db_rows("responses WHERE ip = '".get_ip."' && question = '{$rs['id']}'");
	$getresp = db_get("responses", "response", get_ip, "ip", "&& question = '{$rs['id']}'");

	$cookie = isset($_COOKIE["question_{$rs['id']}_answer_0"]) ? sc_sec($_COOKIE["question_{$rs['id']}_answer_0"]) : '';
	$cookie = $byip && $rosresp ? $getresp : $cookie;


	switch ($tp) {
		case 'input':
		case 'date':
		case 'email':
		case 'phone':
		case 'country':
		case 'dropdown':
		case 'textarea':
		case 'checkbox':
		case 'radio':
		case 'image':
		case 'text':
		$sql_a = $db->query("SELECT * FROM ".prefix."answers WHERE survey = '{$rs['survey']}' && question = '{$rs['sort']}' ORDER BY id ASC") or die ($db->error);
		$a = 0;
		$count_a = $sql_a->num_rows;
		while($rs_a = $sql_a->fetch_assoc()):
			$a++;

			$cook = "question_{$rs['id']}_answer_".(in_array($tp, ["checkbox", "radio", "image", "dropdown", "country"]) ? 0 : $rs_a['id']);
			$cookie = isset($_COOKIE[$cook]) ? sc_sec($_COOKIE[$cook]) : '';
			$cookie = $byip && $rosresp ? $getresp : $cookie;


			$html .= '
			<div class="pt-form-group'. ($icon ? ' pt-form-i' : '') . ($tp == "phone" ? ' pt-form-phone' : ''). ($tp == "country" ? ' pt-countries' : '').'">
				'. ($icon ? '<span class="pt-icon"><i class="'.$icon.'"></i></span>' : '');
				#----- Phone
				if($tp == "phone") {
					$c_ab = $cookie ? $phones[substr($cookie, 0, 2)]['code'] : c_code;
					$c_vl = $cookie;
					$html .= '<select class="selectpicker" name="answer[s'.$rs['survey'].'a'.$rs_a['id'].'][select]" data-live-search="true">';
					foreach ($phones as $key => $value):
						$html .= '<option value="'.$key.'" data-icon="flag-icon flag-icon-'.strtolower($key).'" data-tokens="'.$key.' '.$value['code'].' '.$value['name'].'"'.( $cookie ? (preg_match("/{$key}/i", $cookie)?' selected':'') : ($value['code']==$c_ab?' selected':'') ).'>(+'.$value['code'].')</option>';
					endforeach;
					$html .= '</select>';
				}

				#----- Country
				if($tp == "country") {
					$ccode = ($cookie ? $cookie : c_code);
					$html .= '<span class="pt-icon"><i class="flag-icon flag-icon-'.strtolower($ccode).'"></i></span>
					<select class="selectpicker" name="answer[s'.$rs_a['survey'].'st'.$rs_a['step'].'q'.$rs_a['question'].']" data-live-search="true">';
						foreach ($countries as $key => $value):
							$html .= '<option value="'.$key.'" data-tokens="'.$key.' '.$value.'"'.($key==$ccode?' selected':'').'>'.$value.'</option>';
						endforeach;
					$html .= '</select>';
				}

				#----- Textarea
				if($tp == "textarea") {
					$html .= '<textarea placeholder="'.$rs_a['title'].'" name="answer[s'.$rs['survey'].'a'.$rs_a['id'].']" rel="answer[s'.$rs_a['survey'].'st'.$rs_a['step'].'q'.$rs_a['question'].']" value="'.$cookie.'" placeholder="'.$rs_a['title'].'"'.$class.'></textarea>';
				}

				#----- Text
				if($tp == "text") {
					$html .= fh_bbcode($rs_a['title']);
				}

				#----- Checkbox
				if($tp == "checkbox" || $tp == "radio") {
					$rr_a = $tp == "checkbox" && $cookie ? explode(",", $cookie) : $cookie;
					$chkd = $tp == "checkbox" && $cookie ? (in_array($rs_a['id'], $rr_a)?' checked':'') : ($rs_a['id'] == $cookie?' checked':'');

					$html .= ( $a == 1 ? '<input type="hidden" name="answer[s'.$rs_a['survey'].'st'.$rs_a['step'].'q'.$rs_a['question'].']" value="'.$cookie.'">' : '' );
					$html .= ' <input type="'.$tp.'" name="answers[q'.$rs_a['question'].']" rel="answer[s'.$rs_a['survey'].'st'.$rs_a['step'].'q'.$rs_a['question'].']" value="s'.$rs_a['survey'].'a'.$rs_a['id'].'" id="a'.$rs_a['id'].'" class="choice" '.$chkd.'> <label for="a'.$rs_a['id'].'">'.$rs_a['title'].'</label>';
				}

				#----- Image
				if($tp == "image") {
					$chkd = $rs_a['id'] == $cookie?' checked':'';
					$html .= ( $a == 1 ? '<input type="hidden" name="answer[s'.$rs_a['survey'].'st'.$rs_a['step'].'q'.$rs_a['question'].']" value="'.$cookie.'">' : '' );
					$html .= ' <input type="radio" name="answers[q'.$rs_a['question'].']" rel="answer[s'.$rs_a['survey'].'st'.$rs_a['step'].'q'.$rs_a['question'].']" value="s'.$rs_a['survey'].'a'.$rs_a['id'].'" id="a'.$rs_a['id'].'" class="choice image"'.$chkd.'> <label for="a'.$rs_a['id'].'"><em>'.$rs_a['title'].'</em><b><img src="'.path.'/'.$rs_a['image'].'" /></b></label>';
				}

				#----- Dropdown
				if($tp == "dropdown") {
					$html .= ( $a == 1 ? '<select class="selectpicker" name="answer[s'.$rs_a['survey'].'st'.$rs_a['step'].'q'.$rs_a['question'].']" rel="answer[s'.$rs_a['survey'].'st'.$rs_a['step'].'q'.$rs_a['question'].']" title="'.$lang['survey']['choose'].'">' : '' );
					$html .= '<option value="'.$rs_a["id"].'"'.( $rs_a["id"] == $cookie ? 'selected' : '' ).'>'.$rs_a["title"].'</option>';
					$html .= ( $a == $count_a ? '</select>' : '' );
				}

				#----- Input
				if( !in_array($tp, ['country', 'dropdown', 'textarea', 'checkbox', 'radio', 'image', 'text']) ) {
					$fn = ($tp == 'email' ? 'email' : ($tp == 'phone' ? 'phone' : 'text' ) );
					$c_vl = $tp == "phone" && isset($c_vl) ? $c_vl : $cookie;
					$html .= '<input type="'.$fn.'" name="answer[s'.$rs['survey'].'a'.$rs_a['id'].']'.($tp == "phone"?'[value]':'').'" rel="answer[s'.$rs_a['survey'].'st'.$rs_a['step'].'q'.$rs_a['question'].']" value="'.$c_vl.'" placeholder="'.$rs_a['title'].'"'.$class.'>';
				}

				$html .= '
			</div>
			';


		endwhile;
		$sql_a->close();
		break;


		case 'rating':
			$html .= '<input type="hidden" name="answer[s'.$rs['survey'].'st'.$rs['step'].'q'.$rs['sort'].']" value="'.$cook.'">';
			$html .= '
			<div class="full-stars-example-two">
			    <div class="rating-group">
					<input disabled checked class="rating__input rating__input--none" name="answers[q'.$rs['sort'].']"  rel="answer[s'.$rs['survey'].'st'.$rs['step'].'q'.$rs['sort'].']" id="rating'.$rs["id"].'-none" value="0" type="radio">';
					for ($i=1; $i <= $rs['crows']; $i++) {
						$chkd = $i == $cookie?' checked':'';
						$html .= '
						<label class="rating__label" for="rating'.$rs["id"].'-'.$i.'"><i class="rating__icon rating__icon--star '.( $rs['icon'] ? $rs['icon'] : 'fa fa-star' ).'"></i></label>
						<input class="rating__input" name="answers[q'.$rs['sort'].']" rel="answer[s'.$rs['survey'].'st'.$rs['step'].'q'.$rs['sort'].']" id="rating'.$rs["id"].'-'.$i.'" value="'.$i.'" type="radio"'.$chkd.'>
						';
					}
			    $html .= '
			    </div>
			</div>
			';
		break;


		case 'scale':

			$html .= '<input type="hidden" name="answer[s'.$rs['survey'].'st'.$rs['step'].'q'.$rs['sort'].']" value="'.$cookie.'">';
			$html .= '
			<div class="pt-likertscale">';




			$html .= '



				<!--<b class="pt-likelynot">'.$lang['notalllikely'].'</b>
				<b class="pt-likelyneutral">'.$lang['neutral'].'</b>
				<b class="pt-likelyext">'.$lang['exlikely'].'</b>-->
		    <div class="rating-group" rel="'.$cookie.'">

				<input disabled checked class="rating__input rating__input--none" name="answers[q'.$rs['sort'].']" rel="answer[s'.$rs['survey'].'st'.$rs['step'].'q'.$rs['sort'].']" id="rating'.$rs["id"].'-none" value="0" type="radio">';
				$scl_rows = ($rs['crows'] && $rs['crows'] <= 15 ? $rs['crows'] : 10);
				for ($i=0; $i <= $scl_rows; $i++) {
					$chkd = $cookie && $i == $cookie?' checked':'';
					$html .= '
					<label class="rating__label" for="rating'.$rs["id"].'-'.$i.'"><i class="rating__icon rating__icon--star">'.$i.'</i></label>
					<input class="rating__input" name="answers[q'.$rs['sort'].']" rel="answer[s'.$rs['survey'].'st'.$rs['step'].'q'.$rs['sort'].']" id="rating'.$rs["id"].'-'.$i.'" value="'.$i.'" type="radio"'.$chkd.'>
					';
				}
		    $html .= '
		    </div>';
				$scl_titles = [ $rs['scale1'], $rs['scale2'], $rs['scale3'], $rs['scale4'], $rs['scale5'] ];
				$scl_titles = array_filter($scl_titles);

				if($scl_titles) {
						$html .= '<div class="d-flex justify-content-between scl_titles">';
						foreach ($scl_titles as $scl_title) {
							$html .= '<div class="p-2 bd-highlight">'.$scl_title.'</div>';
						}
						$html .= '</div>';
				}
				$html .= '
			</div>
			';
		break;


		case 'file':
			$html .= '
			<div class="pt-images-up" rel="'.$rs["id"].'" data-type="'.$rs["file"].'">
				<div class="pt-image-upload pt-imagefile-upload" rel="'.$rs["id"].'">
					<div class="file-select">
						<div class="file-select-button" id="answerImageSeli'.$rs["id"].'">'.( $cookie ? '<i class="fas fa-check-circle"></i> '.$lang['survey']['upattashalr'] : $lang['survey']['upattash'].'<b>.'.($rs["file"] == 'image' ? 'jpg, .png, .gif' : $rs["file"]).'</b>)' ).'</div>
						<input type="file" name="chooseFile" id="answerImageInpirel'.$rs["id"].'">
						<input type="hidden" name="answer[s'.$rs['survey'].'st'.$rs['step'].'q'.$rs['sort'].']" rel="#answerImageInpirel'.$rs["id"].'" value="'.$cookie.'">
					</div>
				</div>
			</div>
			';
		break;
	}





  return $html;
}


function fh_get_answer2($rs) {
	global $countries, $phones, $a, $_COOKIE, $db, $lang;

	$html = '';
	$cook = '';
	$tp = $rs['type'];
	$icon = false;
	$class = '';

	if($tp == "date") {
		$class = ' class="datepicker-here"';
		$icon = "fas fa-calendar-alt";
	}
	if($tp == "email") {
		$icon = "fas fa-at";
	}
	if($tp == "phone") {
		$icon = "fas fa-phone";
	}
	if($tp == "country") {
		$icon = true;
	}

	$rs['images'] = $rs['images'] ? array_combine(range(1, count($rs['images'])), array_values($rs['images'])) : '';


	switch ($tp) {
		case 'input':
		case 'date':
		case 'email':
		case 'phone':
		case 'country':
		case 'dropdown':
		case 'textarea':
		case 'checkbox':
		case 'radio':
		case 'image':
		case 'text':
			$a = 0;
			if($rs["answers"] && $tp != "text"):
				$count_a = count($rs["answers"]);
				foreach ($rs["answers"] as $key => $rs_a) :
					$a++;


					$html .= '
					<div class="pt-form-group'. ($icon ? ' pt-form-i' : '') . ($tp == "phone" ? ' pt-form-phone' : ''). ($tp == "country" ? ' pt-countries' : '').'">
						'. ($icon ? '<span class="pt-icon"><i class="'.$icon.'"></i></span>' : '');

						#----- Phone
						if($tp == "phone") {
							$html .= '<select class="selectpicker" data-live-search="true">';
							foreach ($phones as $key => $value):
								$html .= '<option value="'.$key.'" data-icon="flag-icon flag-icon-'.strtolower($key).'" data-tokens="'.$key.' '.$value['code'].' '.$value['name'].'">(+'.$value['code'].')</option>';
							endforeach;
							$html .= '</select>';
						}

						#----- Country
						if($tp == "country") {
							$ccode = (c_code);
							$html .= '<span class="pt-icon"><i class="flag-icon flag-icon-'.strtolower($ccode).'"></i></span>
							<select class="selectpicker" data-live-search="true">';
								foreach ($countries as $key => $value):
									$html .= '<option value="'.$key.'" data-tokens="'.$key.' '.$value.'"'.($key==$ccode?' selected':'').'>'.$value.'</option>';
								endforeach;
							$html .= '</select>';
						}

						#----- Textarea
						if($tp == "textarea") {
							$html .= '<textarea placeholder="'.$rs_a.'"></textarea>';
						}


						#----- Checkbox
						if($tp == "checkbox" || $tp == "radio") {
							$html .= ' <input type="'.$tp.'" class="choice"> <label>'.$rs_a.'</label>';
						}

						#----- Image
						if($tp == "image") {
							$html .= ' <input type="radio" class="choice image"> <label><em>'.$rs_a.'</em><b><img src="'.path.'/'.$rs['images'][$a].'" /></b></label>';
						}

						#----- Dropdown
						if($tp == "dropdown") {
							$html .= ( $a == 1 ? '<select class="selectpicker" title="'.$lang['survey']['choose'].'">' : '' );
							$html .= '<option>'.$rs_a.'</option>';
							$html .= ( $a == $count_a ? '</select>' : '' );
						}

						#----- Input
						if( !in_array($tp, ['country', 'dropdown', 'textarea', 'checkbox', 'radio', 'image', 'text']) ) {
							$html .= '<input type="text" placeholder="'.$rs_a.'"'.$class.'>';
						}


						$html .= '
					</div>
					';


				endforeach;
			else:
				$html .= '<div class="pt-form-group">';
				$rs["answers"] = gettype($rs["answers"]) == "array" ? array_values($rs['answers']) : $rs["answers"];
				$rs["answers"] = gettype($rs["answers"]) == "array" ? $rs["answers"][0] : $rs["answers"];
				$html .= preg_replace( '#(\\\r\\\n)#', '<br/>', fh_bbcode($rs["answers"]) );
				$html .= '</div>';
			endif;

		break;

		case 'rating':
			$html .= '
			<div class="full-stars-example-two">
			    <div class="rating-group">
					<input disabled checked class="rating__input rating__input--none" id="rating'.$rs["id"].'-none" value="0" type="radio">';
					for ($i=1; $i <= $rs['crows']; $i++) {
						$html .= '
						<label class="rating__label" for="rating'.$rs["id"].'-'.$i.'"><i class="rating__icon rating__icon--star '.( $rs['icon'] ? $rs['icon'] : 'fa fa-star' ).'"></i></label>
						<input class="rating__input" id="rating'.$rs["id"].'-'.$i.'" value="'.$i.'" type="radio">
						';
					}
			    $html .= '
			    </div>
			</div>
			';
		break;

		case 'scale':
			$html .= '
			<div class="pt-likertscale">
				<b class="pt-likelynot">'.$lang['notalllikely'].'</b>
				<b class="pt-likelyneutral">'.$lang['neutral'].'</b>
				<b class="pt-likelyext">'.$lang['exlikely'].'</b>
		    <div class="rating-group">

				<input disabled checked class="rating__input rating__input--none" id="rating'.$rs["id"].'-none" value="0" type="radio">';
				for ($i=0; $i <= 10; $i++) {
					$html .= '
					<label class="rating__label" for="rating'.$rs["id"].'-'.$i.'"><i class="rating__icon rating__icon--star">'.$i.'</i></label>
					<input class="rating__input" id="rating'.$rs["id"].'-'.$i.'" value="'.$i.'" type="radio">
					';
				}
		    $html .= '
		    </div>
			</div>
			';
		break;


	}


  return $html;
}
