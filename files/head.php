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
if(basename($_SERVER['PHP_SELF'], '.php') != "index"){
	include __DIR__."/../configs.php";
}
?>

<!DOCTYPE html>
<html lang="<?php echo $lang['lang'] ?>">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?=fh_title()?></title>

	<meta name="title" content="<?=fh_title()?>">
	<meta name="description" content="<?=site_description?>">
	<meta name="keywords" content="<?=site_keywords?>">

	<!-- Open Graph / Facebook -->
	<meta property="og:type" content="website">
	<meta property="og:url" content="<?=site_url?>">
	<meta property="og:title" content="<?=fh_title()?>">
	<meta property="og:description" content="<?=site_description?>">
	<meta property="og:image" content="<?=site_url?>">

	<!-- Twitter -->
	<meta property="twitter:card" content="summary_large_image">
	<meta property="twitter:url" content="<?=site_url?>">
	<meta property="twitter:title" content="<?=fh_title()?>">
	<meta property="twitter:description" content="<?=site_description?>">
	<meta property="twitter:image" content="<?=site_url?>">

	<!-- Favicon -->
	<link rel="shortcut icon" href="<?=path?>/<?=site_favicon?>" type="image/x-icon" />

	<!-- Google Fonts -->
	<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Raleway:100,200,300,400,500,600,700,900%7CGentium+Basic:400italic&subset=latin,latin">
	<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,400,300,700">

	<!-- Font Awseome -->
	<link rel="stylesheet" href="<?=path?>/assets/css/all.min.css">

	<!-- Bootstrap -->
	<link rel="stylesheet" href="<?=path?>/assets/css/bootstrap.min.css">

	<!-- sceditor -->
	<link rel="stylesheet" href="<?=path?>/assets/js/minified/themes/default.min.css" />

	<!-- Datepicker -->
	<link rel="stylesheet" href="<?=path?>/assets/css/datepicker.min.css">

	<!-- Icon Picker -->
	<link rel="stylesheet" href="<?=path?>/assets/css/fontawesome-iconpicker.min.css">

	<!-- Confirm -->
	<link rel="stylesheet" href="<?=path?>/assets/css/jquery-confirm.min.css">

	<!-- Color Picker -->
	<link rel="stylesheet" href="<?=path?>/assets/css/spectrum.css" />

	<!-- Select -->
	<link rel="stylesheet" href="<?=path?>/assets/css/bootstrap-select.min.css">
	<link rel="stylesheet" href="<?=path?>/assets/css/select2.min.css" />

	<!-- Flag Icon -->
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/flag-icon-css/4.1.5/css/flag-icons.min.css">


	<link rel="stylesheet" href="<?=path?>/assets/css/popupConsent.css">

	<link rel="stylesheet" href="<?=path?>/assets/css/style.css">

	<?php if($lang['rtl'] == "rtl_true"): ?>
	<link rel="stylesheet" href="//fonts.googleapis.com/css?family=El+Messiri">
	<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Harmattan">
	<link rel="stylesheet" href="<?=path?>/assets/css/rtl.css">
	<?php endif; ?>
	<link rel="stylesheet" type="text/css" href="<?=path?>/assets/css/style.php">

	<?php if( google_analytics ): ?>
		<!-- Global Site Tag (gtag.js) - Google Analytics -->
	 <script async src="//www.googletagmanager.com/gtag/js?id=<?php echo google_analytics ?>"></script>

	 <script>
	   window.dataLayer = window.dataLayer || [];
	   function gtag(){dataLayer.push(arguments);}
	   gtag('js', new Date());
	   gtag('config', '<?php echo google_analytics ?>');
	 </script>
	<?php endif; ?>

</head>
<body<?=(page?' class="pt-'.page.'page pt-'.$pg.'page'.(!us_level || (in_array($pg, ['survey']) && $request == 'su')?' pt-nouser':'').'"':'')?>>
