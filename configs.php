<?php
session_start();
function rewrite_urls($change){
  $match = [

		'/index.php\?pg=plans/',

		'/index.php\?pg=mysurveys&request=([a-z]+)&page=([0-9]+)/',
    '/index.php\?pg=mysurveys&request=([a-z]+)/',

		'/index.php\?pg=mysurveys&page=([0-9]+)/',
    '/index.php\?pg=mysurveys/',

    '/index.php\?pg=pages&id=([0-9]+)&t=(.*)/',

		'/index.php\?pg=survey&id=([0-9]+)&t=(.*)&request=su/',
    '/index.php\?pg=survey&id=([0-9]+)&t=(.*)/',

		'/index.php\?pg=editor&id=([0-9]+)/',
    '/index.php\?pg=editor/',

    '/index.php\?pg=userdetails\&id=([0-9]+)/',
		'/index.php\?pg=userdetails/',

		'/index.php\?pg=responses&id=([0-9]+)\&page=([0-9]+)/',
    '/index.php\?pg=responses&id=([0-9]+)/',
    '/index.php\?pg=report&id=([0-9]+)/',


  ];
  $replace = [
		'plans',

		'surveys/$1/page/$2',
    'surveys/$1',

		'mysurveys/page/$1',
		'mysurveys',

    'p$1/$2',

		'v$1/$2',
		's$1/$2',

		'edit/survey/$1',
		'new/survey',

		'user/details/$1',
		'user/details',

		'responses/$1/page/$2',
		'responses/$1',
		'report/$1',

  ];

  $change = preg_replace($match, $replace, $change);

	return $change;
}
ob_start("rewrite_urls");

# If the installation file exists
if (file_exists(__DIR__."/install/install.php")) {
	die('<meta http-equiv="refresh" content="0;url=install/install.php">');
}

function getBaseUrl(){
  $protocol = 'http';
  if ($_SERVER['SERVER_PORT'] == 443 || (!empty($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) == 'on')) {
    $protocol .= 's';
  }
  $host = $_SERVER['HTTP_HOST'];
  $request = $_SERVER['PHP_SELF'];
  return dirname($protocol . '://' . $host . $request);
}

# Your website path
define("path", getBaseUrl());

# Getting the current page name
define("page", basename($_SERVER['PHP_SELF'], '.php'));

# Photo error src
define("nophoto", path."/assets/img/nophoto.jpg");

# Including Configs files
include __DIR__."/configs/connection.php";


# Language
function stripslashes_deep($value){
  return ( is_array($value) ? array_map('stripslashes_deep', $value) : stripslashes($value) );
}
$lang = [];
if( isset($_COOKIE['lang']) ){
	$sql_lng = $db->query("SELECT * FROM ".prefix."languages WHERE id = '".(int)($_COOKIE['lang'])."'") or die ($db->error);
	if( $sql_lng->num_rows ){
		$rs_lng = $sql_lng->fetch_assoc();
		$lang = $rs_lng['updated_at'] > 1644412952 ? $rs_lng['content'] : stripslashes($rs_lng['content']);
		$lang = stripslashes_deep( json_decode($lang, true) );
	} else {
		include __DIR__.'/configs/lang/en.php';
	}
} else {
	$sql_lng = $db->query("SELECT * FROM ".prefix."languages WHERE isdefault = 1") or die ($db->error);
	if( $sql_lng->num_rows ){
		$rs_lng = $sql_lng->fetch_assoc();
		$lang = $rs_lng['updated_at'] > 1644412952 ? $rs_lng['content'] : stripslashes($rs_lng['content']);
		$lang = stripslashes_deep( json_decode($lang, true) );
	} else {
		include __DIR__.'/configs/lang/en.php';
	}
}


include __DIR__."/configs/countries.php";
include __DIR__."/configs/phone.php";
include __DIR__."/configs/functions.php";
include __DIR__."/configs/pagination.php";

# User Client Info
include __DIR__."/configs/info.class.php";
define("get_ip", UserInfo::get_ip());
define("get_os", UserInfo::get_os());
define("get_browser", UserInfo::get_browser());
define("get_device", UserInfo::get_device());

# Site Details
db_global();
$SITE_COLORS = !empty(site_colors) ? json_decode(site_colors, true) : '';

# User Details
db_login_details();

if(in_array(page, ['configs', 'login'])){
  header("HTTP/1.0 404 Not Found");
}

# Default Country code
define("c_code", site_country);

$flatColors = ["#1abc9c", "#2ecc71", "#3498db", "#9b59b6", "#34495e", "#16a085", "#27ae60", "#2980b9", "#8e44ad", "#2c3e50", "#f1c40f", "#e67e22", "#e74c3c", "#ecf0f1", "#95a5a6", "#f39c12", "#d35400", "#c0392b", "#bdc3c7", "7f8c8d"];

#PHPMailer
use PHPMailer\PHPMailer\PHPMailer;

require __DIR__.'/configs/phpmailer/Exception.php';
require __DIR__.'/configs/phpmailer/PHPMailer.php';
require __DIR__.'/configs/phpmailer/SMTP.php';

$mail = new PHPMailer();

if(defined("site_smtp") && site_smtp == 1)
	$mail->isSMTP();

$mail->Host       = (defined("site_smtp_host") && site_smtp_host != '' ? site_smtp_host : '');
$mail->SMTPAuth   = (defined("site_smtp_auth") && site_smtp_auth == '1' ? true : false);
$mail->Username   = (defined("site_smtp_username") && site_smtp_username != '' ? site_smtp_username : '');
$mail->Password   = (defined("site_smtp_password") && site_smtp_password != '' ? site_smtp_password : '');
$mail->SMTPSecure = (defined("site_smtp_encryption") && site_smtp_encryption != 'none' ? site_smtp_encryption : false);
$mail->Port       = (defined("site_smtp_port") && site_smtp_port != '' ? site_smtp_port : '');

$mail->setFrom((defined("site_noreply") && site_noreply != '' ? site_noreply : ''), site_title);


# Facebook Login App
define("fbAppId",      login_fbAppId);
define("fbAppSecret",  login_fbAppSecret);
define("fbAppVersion", login_fbAppVersion);

$facebookLoginUrl = '#';
if(fbAppId != '' && fbAppSecret != '' && fbAppVersion != ''){
	require __DIR__.'/configs/src/Facebook/autoload.php';
	$fb = new Facebook\Facebook([
		'app_id'                => fbAppId,
		'app_secret'            => fbAppSecret,
		'default_graph_version' => fbAppVersion,
	]);
	$helper      = $fb->getRedirectLoginHelper();
	$permissions = ['email'];
	$facebookLoginUrl    = $helper->getLoginUrl(path."/login-facebook.php", $permissions);
}

# Twitter Login App
define('twConKey',        login_twConKey);
define('twConSecret',     login_twConSecret);
define('twOauthCallback', path."/login-twitter.php");

if(twConKey != '' && twConSecret != ''){
	require_once(__DIR__."/configs/src/Twitter/twitteroauth.php");
	$twitterLoginUrl = path."/login-twitter.php";
}

# Google Login App
define('ggClientId',      login_ggClientId);
define('ggClientSecret',  login_ggClientSecret);
define('ggOauthCallback', path."/login-google.php");
define('ggAppName',       site_title);

if(ggClientId != '' && ggClientSecret != ''){
	require_once(__DIR__."/configs/src/Google/Google_Client.php");
	require_once(__DIR__."/configs/src/Google/contrib/Google_Oauth2Service.php");

	$gClient = new Google_Client();
	$gClient->setApplicationName(ggAppName);
	$gClient->setClientId(ggClientId);
	$gClient->setClientSecret(ggClientSecret);
	$gClient->setRedirectUri(ggOauthCallback);

	$google_oauthV2 = new Google_Oauth2Service($gClient);
	$googleLoginUrl = $gClient->createAuthUrl();
}


# Paypal Payement Gateway configuration
define('PAYPAL_ID', (defined("site_paypal_id") && site_paypal_id != '' ? site_paypal_id : ''));
define('PAYPAL_SANDBOX', (defined("site_paypal_live") && site_paypal_live == 1 ? false : true)); //TRUE (testing) or FALSE (live)

define('PAYPAL_RETURN_URL', path.'/index.php?pg=payment');
define('PAYPAL_CANCEL_URL', path);
define('PAYPAL_NOTIFY_URL', path.'/ipn.php');
define('PAYPAL_CURRENCY', (defined("site_currency_name") && site_currency_name != '' ? site_currency_name : ''));

define('PAYPAL_URL', (PAYPAL_SANDBOX == true)?"https://www.sandbox.paypal.com/cgi-bin/webscr":"https://www.paypal.com/cgi-bin/webscr");


# Get vars
$request = (isset($_GET['request']) ? sc_sec($_GET['request']) : '');
$pg      = (isset($_GET['pg']) ? sc_sec($_GET['pg'])           : '');
$id      = (isset($_GET['id']) ? (int)($_GET['id'])    : '');
$s       = (isset($_GET['s']) ? (int)($_GET['s'])      : '');
$t       = (isset($_GET['t']) ? sc_sec($_GET['t'])      : '');

# Pagination
$page = !isset($_GET["page"]) || !$_GET["page"] ? 1 : (int)($_GET["page"]);
$limit = 10;
$startpoint = ($page * $limit) - $limit;

# Plans Options
$us_plan = us_plan ? us_plan : 1;
if(us_level == 6 || !site_plans){
	define("surveys_month",     9999999);
	define("surveys_steps",     50);
	define("surveys_questions", 50);
	define("surveys_answers",   20);
} else {

	define("surveys_month",     us_level ? db_get("plans", "surveys_month", $us_plan) : 0);
	define("surveys_steps",     us_level ? db_get("plans", "surveys_steps", $us_plan) : 0);
	define("surveys_questions", us_level ? db_get("plans", "surveys_questions", $us_plan) : 0);
	define("surveys_answers",   us_level ? db_get("plans", "surveys_answers", $us_plan) : 0);
}

define("surveys_rapport",   db_get("plans", "surveys_rapport", $us_plan));
define("surveys_export",    db_get("plans", "surveys_export", $us_plan));
define("surveys_iframe",    db_get("plans", "surveys_iframe", $us_plan));
define("show_ads",          db_get("plans", "show_ads", $us_plan));
define("survey_design",     db_get("plans", "survey_design", $us_plan));
define("support",           db_get("plans", "support", $us_plan));

# Survey views
if($pg == 'survey'){
	if(!isset($_COOKIE["survey_view_{$id}"])) {
		setcookie("survey_view_{$id}", "surv_".$id, time() + (86400 * 365));
	}
}


$logic_actions    = [1 => 'Hide', 'Show', 'Jump to'];
$logic_condition1 = [1 => 'if answer on'];
$logic_condition2 = [1 => 'equal to', 'greater than', 'less than', 'different than'];
