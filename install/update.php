<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 'On');
/*=======================================================/
	| Craeted By: Khalid puerto
	| URL: www.puertokhalid.com
	| Facebook: www.facebook.com/prof.puertokhalid
	| Instagram: www.instagram.com/khalidpuerto
	| Whatsapp: +212 654 211 360
 /======================================================*/

include __DIR__.'/../configs/connection.php';

?>
<title>Puerto Update</title>
<style>
	body { background: #FFF; line-height: 24px; }
	.install-box { width:600px;margin:40px auto 40px auto;background: #FFF;font-family:tahoma;font-size:14px;box-shadow:0 1px 5px #EEE;border-radius: 10px;}
	.install-box h1 { padding: 24px 20px;margin:0;font-size:18px;border-bottom: 1px solid #EEE; }
	.install-box p { padding:20px;margin:0; }
	.install-box ul { padding: 0 20px;font-size: 12px; }
	.install-box .button {font-size:16px;background:#35c43f;color:#FFF;text-decoration:none;display:block;margin-top:20px;text-align:center;padding:16px 0;border-radius: 3px;width: 100%; border:0;font-weight: bold;}
	.input { padding:10px 20px 0px 20px; }
	.input p { padding:0; font-size:12px; }
	label { font-weight:bold; font-size:12px; margin:5px;display:block; }
	input { padding:10px; font-size:12px; border:1px solid #EEE; width:100%;border-radius: 5px; box-shadow:0 1px 5px #EEE; }
	/* button[type=submit] { padding:10px; font-size:12px; color:#FFF; border:0; background: #DF4444; width:auto;  } */
	li i {
		display: inline-block;
		width: 134px;
	}
	.p-h, .p-h a {
    display: inline-block;
    padding: 2px 6px;
    background: #EEE;
    border-radius: 3px;
    -moz-border-radius: 3px;
    -webkit-border-radius: 3px;
    color: #555;
    text-shadow: 0 1px 0 #FFF;
	}
	ul {
		margin:0 24px
	}
	ul li {
		margin: 6px 0;
	}
	.red {
		color: red;
background: #ffefef;
display: block;
padding: 12px;
border-radius: 7px;

	}
	.hr {
		display: block;
    border-bottom: 1px solid #EEE;
    margin-bottom: 12px;

	}
</style>

<?php

$step = (isset($_GET['step']) ? (int)($_GET['step']) : '');

if($step == ''):

?>
<div class="install-box">
	<form method="post" action="update.php?step=1">

	<h1>Welcome to Puerto Premium Survey</h1>
	<p>
	Thank you for purchasing Puerto Premium Survey Script.<br> if you have any problem or issue with the script or the instraction that I provide please contact me first ASAP in:
	</p>
	<ul>
		<li><i>my Email</i>: <span class="p-h">el.bouirtou@gmail.com</span></li>
		<li><i>my Facebook account</i>: <span class="p-h"><a href="https://fb.com/prof.puertokhalid">fb.com/prof.puertokhalid</a></span></li>
		<li><i>on the Instagram</i>: <span class="p-h"><a href="https://instagram.com/khalidpuerto">instagram.com/khalidpuerto</a></span></li>
		<li><i>Codecanyon profile</i>: <span class="p-h"><a href="http://codecanyon.net/user/puertokhalid">codecanyon.net/user/puertokhalid</a></span></li>
	</ul>
	<p>
	 and I will back to you with all help you need.<br>
	 Thanks so much!<br>
	 <br>
	<button type="submit" class="button">Update Puerto Script</button>
	</p>
		</form>
</div>





<?php

else:



	$db->query("ALTER TABLE `".prefix."survies` CHANGE `enddate` `enddate` BIGINT UNSIGNED NOT NULL DEFAULT '0';") or die ($db->error);
	$db->query("ALTER TABLE `".prefix."survies` CHANGE `startdate` `startdate` BIGINT UNSIGNED NOT NULL DEFAULT '0';") or die ($db->error);
	$db->query("ALTER TABLE `".prefix."survies` CHANGE `enddate` `enddate` BIGINT(20) UNSIGNED NULL DEFAULT '0';") or die ($db->error);
	$db->query("ALTER TABLE `".prefix."survies` ADD `template` TINYINT(1) NULL DEFAULT '0';") or die ($db->error);
	$db->query("ALTER TABLE `".prefix."questions` ADD `scale1` VARCHAR(200) NULL;") or die ($db->error);
	$db->query("ALTER TABLE `".prefix."questions` ADD `scale2` VARCHAR(200) NULL;") or die ($db->error);
	$db->query("ALTER TABLE `".prefix."questions` ADD `scale3` VARCHAR(200) NULL;") or die ($db->error);
	$db->query("ALTER TABLE `".prefix."questions` ADD `scale4` VARCHAR(200) NULL;") or die ($db->error);
	$db->query("ALTER TABLE `".prefix."questions` ADD `scale5` VARCHAR(200) NULL;") or die ($db->error);
	$db->query("INSERT INTO `".prefix."configs` (`id`, `variable`, `value`) VALUES (NULL, 'show_allsurveys', '1');") or die ($db->error);

?>


<div class="install-box">
	<h1>Congratulations...</h1>
	<p>
		Congratulations Puerto Premium Survey Script is updated successfully.<br /> if you have any problem or issue with the script or the instruction that I provide please get in touch with me first ASAP in:

		</p>
		<ul>
			<li><i>my Email</i>: <span class="p-h">el.bouirtou@gmail.com</span></li>
			<li><i>my Facebook account</i>: <span class="p-h"><a href="https://fb.com/prof.puertokhalid">fb.com/prof.puertokhalid</a></span></li>
			<li><i>on the Instagram</i>: <span class="p-h"><a href="https://instagram.com/khalidpuerto">instagram.com/khalidpuerto</a></span></li>
			<li><i>Codecanyon profile</i>: <span class="p-h"><a href="http://codecanyon.net/user/puertokhalid">codecanyon.net/user/puertokhalid</a></span></li>
		</ul>
		<p>
		 and I will back to you with all help you need.<br><br>
		<span class="red">Please don't forget to <b>DELETE</b> the installation folder 'install'.</span><br>
		<a href="../index.php" class="button">Go to index</a>
	</p>
</div>

<?php
endif;
