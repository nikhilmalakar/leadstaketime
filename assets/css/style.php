<?php
include __DIR__."/../../configs.php";
header("Content-type: text/css");

function hex2rgba($color, $opacity = false) {

	$default = 'rgb(0,0,0)';

	if(empty($color)) return $default;

  if ($color[0] == '#' ) {
  	$color = substr( $color, 1 );
  }

  if (strlen($color) == 6) {
    $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
  } elseif ( strlen( $color ) == 3 ) {
    $hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
  } else {
    return $default;
  }

  $rgb =  array_map('hexdec', $hex);

  if($opacity){
  	if(abs($opacity) < 1)
  		$opacity = 1.0;
  	$output = 'rgba('.implode(",",$rgb).','.($opacity/100).')';
  } else {
  	$output = 'rgb('.implode(",",$rgb).')';
  }

  return $output;
}


$a        = $SITE_COLORS['a'] ?? "#5385f1";
$body     = $SITE_COLORS['body'] ?? "#f2f3f7";
$header   = $SITE_COLORS['header'] ?? "#38395f";
$header_t = $SITE_COLORS['header_t'] ?? "#2a2b4a";
$header_m = $SITE_COLORS['header_m'] ?? "#2c6c2c";

$btn1     = $SITE_COLORS['btn1'] ?? "#3f79fc";
$btn2     = $SITE_COLORS['btn2'] ?? "#6694fa";
$btn1_c   = $SITE_COLORS['btn1_c'] ?? "#FFF";
$btn3_1   = $SITE_COLORS['btn3_1'] ?? "#fc3f59";
$btn3_2   = $SITE_COLORS['btn3_2'] ?? "#fa667a";
$btn4_1   = $SITE_COLORS['btn4_1'] ?? "#07b81e";
$btn4_2   = $SITE_COLORS['btn4_2'] ?? "#2ee934";
$btn5_1   = $SITE_COLORS['btn5_1'] ?? "#2e62d2";
$btn5_2   = $SITE_COLORS['btn5_2'] ?? "#5f90fa";


$body_h    = $SITE_COLORS['body_h'] ?? "#FFF";
$home_a1   = $SITE_COLORS['home_a1'] ?? "#fba70c";
$home_a1_c = $SITE_COLORS['home_a1_c'] ?? "#FFF";
$home_a1_h = $SITE_COLORS['home_a1_h'] ?? "#FFF";
$home_a2   = $SITE_COLORS['home_a2'] ?? "#1bce5b";
$home_a2_c = $SITE_COLORS['home_a2_c'] ?? "#FFF";
$home_a3_1 = $SITE_COLORS['home_a3_1'] ?? "#5845b9";
$home_a3_2 = $SITE_COLORS['home_a3_2'] ?? "#453497";
$home_a3_c = $SITE_COLORS['home_a3_c'] ?? "#FFF";

$features1 = $SITE_COLORS['features1'] ?? "#281a65";
$features2 = $SITE_COLORS['features2'] ?? "#7761ee";

$plans     = $SITE_COLORS['plans'] ?? "#5f90fa";


?>
body {
	background: <?php echo $body ?>;
}
body.pt-bodyhome {
	background: <?php echo $body_h ?>;
}
a, a:hover, a:focus,
.pt-dashboardpage .pt-admin-nav .pt-logo {
    color: #3dbb3d;
}
  
.navbar a, a:hover, a:focus{
    color: #000;
    margin: 0 20px;
}
.nav-action-button {
    color: #fff !important;
    font-weight:700!important;
    margin: 0 10px;
    padding: 5px 0;
    background-color:#3dbb3d;
}
.pt-body .table .pt-progress-line span {
	background: #3dbb3d;
}

.pt-header .pt-menu .pt-links-r ul li a {
    /*color: #a4bdf6;*/
    color: #FFF;
}
.pt-dashboardpage .pt-admin-nav .pt-logo {
	box-shadow: 0 0 0 4px <?php echo $header ?>, 0 0 0 5px #fff;
}
.tgl-light:checked + .tgl-btn {
    background: #3dbb3d;
}
.choice[type=checkbox]:checked + label:before {
  background-color: <?php echo $a ?>;
}
/*#5f62ad*/
.choice:checked + label:before {
    border-color: <?php echo $a ?>;
    box-shadow: 0 0 0 4px <?php echo $a ?> inset;
}

.pt-header .pt-top-menu .pt-left-menu li:first-of-type a {
    <!-- background: linear-gradient(0deg, rgba(238, 238, 238, 0) 0%, <?php echo $header_t ?> 100%); -->
}

.pt-header .pt-context a {
	background: <?php echo $home_a1 ?>;
	color: <?php echo $home_a1_c ?>;
}
.pt-header .pt-context a:hover {
	background: <?php echo $home_a1_h ?>;
	box-shadow: 0 0 0 3px <?php echo $header ?>, 0 0 0 4px <?php echo $home_a1_h ?>;
}

.pt-header .pt-top-menu .pt-right-menu li a.pt-started {
	background: <?php echo $home_a1 ?>;
	color: <?php echo $home_a1_c ?>;
}
.pt-header .pt-header-top a.pt-log {
	background: <?php echo $home_a2 ?>;
	color: <?php echo $home_a2_c ?>;
}


.pt-section .pt-stitle h3:before,
.pt-section .pt-stitle h3:after,
.pt-section .pt-stitle p:before {
	background: <?php echo $a ?>;
}



.pt-btn {
	/*background-image: linear-gradient(to top, #3f79fc 0%, #6694fa 100%);*/
	background-image: linear-gradient(to top, #3dbb3d  0%, #4ad84a  100%);
}
.pt-btn:hover {
    color: #FFF;
    background-image: linear-gradient(to top, #4ad84a  0%, #3dbb3d  100%);
}
.pt-btn.btn-red {
    background-image: linear-gradient(to top, <?php echo $btn3_1 ?> 0%, <?php echo $btn3_2 ?> 100%);
}
.pt-btn.btn-red:hover {
	color: #FFF;
    background-image: linear-gradient(to top, <?php echo $btn3_2 ?> 0%, <?php echo $btn3_1 ?> 100%);
}
.pt-btn.btn-green,
#example-async .actions ul li a[href="#previous"][href="#next"], #example-async .actions ul li a[href="#next"][href="#next"], #example-async .actions ul li a[href="#finish"][href="#next"] {
    background-image: linear-gradient(to top, <?php echo $btn4_1 ?> 0%, <?php echo $btn4_2 ?> 100%);
}
.pt-btn.btn-green:hover,
#example-async .actions ul li a[href="#previous"][href="#next"]:hover, #example-async .actions ul li a[href="#next"][href="#next"]:hover, #example-async .actions ul li a[href="#finish"][href="#next"]:hover {
	color: #FFF;
    background-image: linear-gradient(to top, <?php echo $btn4_2 ?> 0%, <?php echo $btn4_1 ?> 100%);
}


.bg-gradient5 span, .bg-gradient5:before {
	background: #3dbb3d;
}


#registrationModal input, #loginModal input,
.pt-header .pt-login-form label.pt-input-icon input,
input[type=text], input[type=password], input[type=phone], input[type=email], input[type=number], select, textarea, .bootstrap-select .btn, .select2-container--default .select2-selection--multiple, .select2-container--default.select2-container--focus .select2-selection--multiple {
	border-bottom: 2px solid <?php echo hex2rgba($header, 10) ?>;
}
#registrationModal label.pt-input-icon span, #loginModal label.pt-input-icon span,
.pt-header .pt-login-form label.pt-input-icon span {
	color: <?php echo $header ?>;
}
.pt-form-i span.pt-icon i {
	box-shadow: 0 0 0 1px #fff, 0 0 0 3px <?php echo hex2rgba($header, 10) ?>;
}

.pt-likertscale .rating-group {
    border: 2px solid <?php echo $header ?>;
}

.pt-likertscale .rating-group label,
.pt-survey.pt-newsurvey .choice + label {
	background: <?php echo hex2rgba($header, 4) ?>;
}

.pt-likertscale .pt-likelynot, .pt-likertscale .pt-likelyneutral, .pt-likertscale .pt-likelyext {
	color: <?php echo hex2rgba($header, 30) ?>;
}


.pt-breadcrump li a {
  color: #000;
} 

#example-async .actions ul li a[href="#previous"], #example-async .actions ul li a[href="#next"], #example-async .actions ul li a[href="#finish"] {
	background-image: linear-gradient(to top, <?php echo $btn1 ?> 0%, <?php echo $btn2 ?> 100%);
}
#example-async .actions ul li a[href="#previous"]:hover, #example-async .actions ul li a[href="#next"]:hover, #example-async .actions ul li a[href="#finish"]:hover {
	color: <?php echo $btn1_c ?>;
  background-image: linear-gradient(to top, <?php echo $btn2 ?>  0%, <?php echo $btn1 ?>  100%);
}



.alba-sepa {
  position:relative;
}
.custom-shape-divider-top-1606478547 {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  overflow: hidden;
  line-height: 0;
}

.custom-shape-divider-top-1606478547 svg {
  position: relative;
  display: block;
  width: calc(145% + 1.3px);
  height: 103px;
}

.custom-shape-divider-top-1606478547 .shape-fill {
    fill: <?php echo $header ?>;
}

