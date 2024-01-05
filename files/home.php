<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>
		<?= fh_title() ?>
	</title>

	<meta name="title" content="<?= fh_title() ?>">
	<meta name="description" content="<?= site_description ?>">
	<meta name="keywords" content="<?= site_keywords ?>">

	<!-- Open Graph / Facebook -->
	<meta property="og:type" content="website">
	<meta property="og:url" content="<?= site_url ?>">
	<meta property="og:title" content="<?= fh_title() ?>">
	<meta property="og:description" content="<?= site_description ?>">
	<meta property="og:image" content="<?= site_url ?>">

	<!-- Twitter -->
	<meta property="twitter:card" content="summary_large_image">
	<meta property="twitter:url" content="<?= site_url ?>">
	<meta property="twitter:title" content="<?= fh_title() ?>">
	<meta property="twitter:description" content="<?= site_description ?>">
	<meta property="twitter:image" content="<?= site_url ?>">

	<!-- Favicon -->
	<link rel="shortcut icon" href="./assets/img/leadstaketime.png" type="image/x-icon" />

	<link rel="stylesheet" href="<?= path ?>/assets/css/normalize.css">
	<link rel="stylesheet" href="<?= path ?>/assets/css/all.min.css">
	<link rel="stylesheet" href="<?= path ?>/assets/css/simple-line-icons.css">

	<!-- Google Fonts -->
	<link rel="stylesheet"
		href="//fonts.googleapis.com/css?family=Raleway:100,200,300,400,500,600,700,900%7CGentium+Basic:400italic&subset=latin,latin">
	<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,400,300,700">
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/flag-icon-css/4.1.5/css/flag-icons.min.css">

	<!-- Favicon -->
	<link rel="shortcut icon" href="./assets/img/leadstaketime_logo.png" type="image/x-icon" />

	<!-- Google Fonts -->
	<link rel="stylesheet"
		href="//fonts.googleapis.com/css?family=Raleway:100,200,300,400,500,600,700,900%7CGentium+Basic:400italic&subset=latin,latin">
	<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,400,300,700">

	<!-- Font Awseome -->
	<link rel="stylesheet" href="<?= path ?>/assets/css/all.min.css">

	<!-- Bootstrap -->
	<link rel="stylesheet" href="<?= path ?>/assets/css/bootstrap.min.css">

	<!-- sceditor -->
	<link rel="stylesheet" href="<?= path ?>/assets/js/minified/themes/default.min.css" />

	<!-- Datepicker -->
	<link rel="stylesheet" href="<?= path ?>/assets/css/datepicker.min.css">

	<!-- Icon Picker -->
	<link rel="stylesheet" href="<?= path ?>/assets/css/fontawesome-iconpicker.min.css">

	<!-- Confirm -->
	<link rel="stylesheet" href="<?= path ?>/assets/css/jquery-confirm.min.css">

	<!-- Color Picker -->
	<link rel="stylesheet" href="<?= path ?>/assets/css/spectrum.css" />

	<!-- Select -->
	<link rel="stylesheet" href="<?= path ?>/assets/css/bootstrap-select.min.css">
	<link rel="stylesheet" href="<?= path ?>/assets/css/select2.min.css" />

	<!-- Flag Icon -->
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/flag-icon-css/4.1.5/css/flag-icons.min.css">


	<link rel="stylesheet" href="<?= path ?>/assets/css/popupConsent.css">

	<link rel="stylesheet" href="<?= path ?>/assets/css/style.css">
	<link rel="stylesheet" href="<?= path ?>/assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?= path ?>/assets/css/popupConsent.css">
	<link rel="stylesheet" href="<?= path ?>/assets/css/home.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"
		integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">


	<?php if ($lang['rtl'] == "rtl_true"): ?>
		<link rel="stylesheet" href="//fonts.googleapis.com/css?family=El+Messiri">
		<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Harmattan">
		<link rel="stylesheet" href="<?= path ?>/assets/css/rtl.css">
	<?php endif; ?>
	<link rel="stylesheet" type="text/css" href="<?= path ?>/assets/css/style.php">

	<?php if (google_analytics): ?>
		<!-- Global Site Tag (gtag.js) - Google Analytics -->
		<script async src="//www.googletagmanager.com/gtag/js?id=<?php echo google_analytics ?>"></script>

		<script>
			window.dataLayer = window.dataLayer || [];
			function gtag() { dataLayer.push(arguments); }
			gtag('js', new Date());
			gtag('config', '<?php echo google_analytics ?>');
		</script>
	<?php endif; ?>
</head>

<body class="pt-bodyhome">
	<div class="pt-wrapper">

		<!-- ------------------------- HEADER NAV BAR ------------------------------------ -->
		<nav class="container navbar navbar-expand-lg navbar-light bg-white">
			<a href="#" class="navbar-brand">
				<img src="./assets/img/leadstaketime_logo.png" height="56" alt="CoolBrand">
			</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02"
				aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarTogglerDemo02">
				<ul class="navbar-nav mr-auto mt-2 mt-lg-0">
					<li class="nav-item">
						<a class="" href="./">Home <span class="sr-only">(current)</span></a>
					</li>
					<li class="nav-item">
						<a class="" href="#">About Us</a>
					</li>
					<li class="nav-item">
						<a class="" href="#">Contact Us</a>
					</li>
				</ul>
				<div class="navbar-nav ms-auto">
					<div class="nav-action-button">
						<a href="./plans" class="nav-item">Pricing</a>
					</div>
					<?php if (us_level != 6): ?>
						<div class="nav-action-button">
							<a href="./mysurveys" class="nav-item">Get Started</a>
						</div>
					<?php else: ?>
						<div class="nav-action-button">
							<a href="./dashboard.php" class="nav-item">Admin Panel</a>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</nav>




		<!-- ---------------------------HERO SECTION ------------------------------------ -->


		<div class="container col-xxl-8 px-4 ">
			<div class="row flex-lg-row-reverse justify-content-center align-items-center g-5 py-3 pb-5">
				<div class="col-10 col-sm-8 col-lg-6" style="padding:20px 0;">
					<img src="./assets/img/hero-section-img.png" class="d-block mx-lg-auto img-fluid"
						alt="Bootstrap Themes" width="400" loading="lazy">
				</div>
				<div class="hero-section col-lg-6">
					<h1 class=" display-5 fw-bold lh-1 my-3" style="font-size:48px; font-weight: 700;">Empowering
						Realtors,
						<span style="font-size:36px;">One <span style=" color:#3dbb3d;">Verified Lead</span> at a
							Time</span>
					</h1>
					<p class=" lead" style="font-weight: 500;">Get leads, screen tenants, verify them in easy way</p>
					<div class="d-grid gap-2 d-md-flex justify-content-md-start">
						<?php if (us_level != 6): ?>
							<button type="button" onclick="redirectuser()" class=" btn btn-primary btn-lg px-4 my-3 me-md-2"
							style="background-color:#3dbb3d !important; border:1px solid #3dbb3d;">Get Started
							Now!</button>
						<?php else: ?>
							<button type="button" onclick="redirectdashboard()" class=" btn btn-primary btn-lg px-4 my-3 me-md-2"
							style="background-color:#3dbb3d !important; border:1px solid #3dbb3d;">
							Admin Dashboard</button>
						<?php endif; ?>
						
					</div>
				</div>
			</div>
		</div>

		<script>
			function redirectuser() {
				 window.location.href = "./mysurveys";
			}
			function redirectdashboard() {
				 window.location.href = "./dashboard";
			}
		</script>
		
		<!-- ----------------------------------FEATURES------------------------------------------------- -->
		<!-- <div class="alba-sepa"><div class="custom-shape-divider-top-1606478547"><svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none"><path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" opacity=".25" class="shape-fill"></path><path d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z" opacity=".5" class="shape-fill"></path><path d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z" class="shape-fill"></path></svg></div></div> -->
		<div class="pt-section pt-features" style="margin-top:20px;">
			<div class="pt-container">
				<div class="pt-stitle">
					<h3>Why to choose <span>LEADS TAKE TIME?</span></h3>
					<!-- <h1>hello</h1> -->
					<!-- <p><?= $lang['home']['sf_p'] ?></p> -->
				</div>

				<ul>
					<li>
						<div class="pt-content">
							<span><i class="icon-fire icons"></i></span>
							<h3>Inspire trust</h3>
							<p>As your click numbers go up, your brand recognition increases</p>
						</div>
					</li>
					<li>
						<div class="pt-content">
							<span><i class="icon-rocket icons"></i></span>
							<h3>Boost results</h3>
							<p>Better deliverability and improved click-through are just the start.</p>
						</div>
					</li>
					<li>
						<div class="pt-content">
							<span><i class="icon-speedometer icons"></i></span>
							<h3>Gain control</h3>
							<p>On top of being able to fully customize your links,</p>
						</div>
					</li>
					<li>
						<div class="pt-content">
							<span><i class="icon-pie-chart icons"></i></span>
							<h3>Big Data Analysis</h3>
							<p>Lorem ipsum dolor sit amet adicing elit maecenas sa</p>
						</div>
					</li>
				</ul>

				<div class="pt-links">
					<?php if (site_plans): ?>
						<a href="<?= path ?>/index.php?pg=plans"><span><i class="icon-diamond icons"></i>
								<?= $lang['home']['link1'] ?>
							</span></a>
					<?php endif; ?>
					<a href="<?= path ?>/index.php?pg=mysurveys"><span><i class="icon-question icons"></i>
							<?= $lang['home']['link2'] ?>
						</span></a>
				</div>

				<div class="pt-stats">
					<div>
						<span><i class="icon-chart icons" style="color:#3dbb3d"></i></span>
						<strong>Current Active Users</strong>
						<b>1768</b>
					</div>
					<div>
						<span><i class="icon-check icons" style="color:#3dbb3d"></i></span>
						<strong>Total Leads Generated</strong>
						<b>18412</b>
					</div>
					<div>
						<span><i class="icon-people icons" style="color:#3dbb3d"></i></span>
						<strong>Conversion Percentage</strong>
						<b>72.41% </b>
					</div>
				</div>

			</div>
		</div>

		<!-- --------------------------------------PLANS----------------------------------------------------- -->
		<style>
			.home-plans {
				margin: auto;
				/* text-align: center; */
				width: 80%;
			}

			.pt-title h3 span {
				border-radius: 50%;
				background: #FFF;
				width: 52px;
				height: 52px;
				text-align: center;
				line-height: 52px;
				box-shadow: 0 0 0 4px #eeeeff, 0 0 0 5px #3dbb3d;
				display: inline-block;
				border: 2px solid #3dbb3d;
				margin-bottom: 18px;
				color: #3dbb3d;
			}

			.pt-title h3 {
				font-weight: 700;
				font-family: "Raleway";
			}

			.pt-title p {
				font-family: "Raleway";
			}

			.pt-title {
				text-align: center;
				/* padding: 68px 0 0 0; */
			}

			.pt-plan {
				margin: 10px 0;
			}

			@media (max-width:430px) {
				.pt-title {
					padding-top: 50px;
				}



			}
		</style>
		<div class="home-plans">
			<div class="pt-title">
				<h3><span><i class="fas fa-dollar-sign"></i></span></h3>
				<h3>
					<?= $lang['plans']['title'] ?>
				</h3>
				<p>
					<?= $lang['plans']['desc'] ?>
				</p>
			</div>


			<div class="pt-plans">
				<div class="row">
					<div class="col">
						<div class="pt-plan">
							<h5>Starter</h5>
							<h6><span>$</span><b>2.00</b></h6>
							<p>/per survey</p>

							<form action="<?php echo PAYPAL_URL; ?>" method="post">
								<input type="hidden" name="business" value="<?= PAYPAL_ID ?>">
								<input type="hidden" name="cmd" value="_xclick-subscriptions">

								<input type="hidden" name="item_name" value="Starter">
								<input type="hidden" name="item_number" value="Plan#1">
								<input type="hidden" name="currency_code" value="USD">
								<input type="hidden" name="a3" value="2.00">
								<input type="hidden" name="p3" value="1">
								<input type="hidden" name="t3" value="M">
								<input type="hidden" name="custom" value="2">

								<input type="hidden" name="return" value="<?= PAYPAL_RETURN_URL ?>">
								<input type="hidden" name="cancel_return" value="<?= PAYPAL_CANCEL_URL ?>">

								<?php if (us_level & us_level != 6): ?>
									<button type="submit" name="submit" class="fancy-button bg-gradient5">
										<span>
											<?= $lang['plans']['btn'] ?> <i class="fas fa-heart"></i>
										</span>
									</button>
								<?php endif; ?>
								<?php if (!us_level && us_level != 6): ?>
									<button type="button" href="#loginModal" data-toggle="modal"
										class="fancy-button bg-gradient5">
										<span>
											<?= $lang['plans']['btn'] ?> <i class="fas fa-heart"></i>
										</span>
									</button>
								<?php endif; ?>

							</form>
							<ul>
								<li class="alert-success">
									<span><i class="fas fa-check"></i></span> Profile to track your leads
								</li>
								<li>
									<span><i class="fas fa-check"></i></span> Fast turnaround solutions
								</li>
								<li>
									<span><i class="fas fa-check"></i></span> Quickly evaluate potential tenants
									financial qualifications
								</li>
								<li>
									<span><i class="fas fa-check"></i></span> Email support
								</li>
								<li>
									<span><i class="fas fa-check"></i></span> Specific Survey Design
								</li>
								<li>
									<span><i class="fas fa-check"></i></span> Export Responses
								</li>
							</ul>
						</div>
					</div>
					<div class="col">
						<div class="pt-plan">
							<h5>Preferred</h5>
							<h6><span>$</span><b>30.00</b></h6>
							<p>/per month</p>

				<form action="./files/create-checkout-session_preferred.php" method="post">
					<input type="hidden" name="business" value="<?= PAYPAL_ID ?>">
					<input type="hidden" name="cmd" value="_xclick-subscriptions">

								<input type="hidden" name="item_name" value="Preferred">
								<input type="hidden" name="item_number" value="Plan#2">
								<input type="hidden" name="currency_code" value="USD">
								<input type="hidden" name="a3" value="30.00">
								<input type="hidden" name="p3" value="1">
								<input type="hidden" name="t3" value="M">
								<input type="hidden" name="custom" value="2">

								<input type="hidden" name="return" value="<?= PAYPAL_RETURN_URL ?>">
								<input type="hidden" name="cancel_return" value="<?= PAYPAL_CANCEL_URL ?>">

								<?php if (us_level & us_level != 6): ?>
									<button type="submit" name="submit" class="fancy-button bg-gradient5">
										<span>
											<?= $lang['plans']['btn'] ?> <i class="fas fa-heart"></i>
										</span>
									</button>
								<?php endif; ?>
								<?php if (!us_level && us_level != 6): ?>
									<button type="button" href="#loginModal" data-toggle="modal"
										class="fancy-button bg-gradient5">
										<span>
											<?= $lang['plans']['btn'] ?> <i class="fas fa-heart"></i>
										</span>
									</button>
								<?php endif; ?>

							</form>
							<ul>
								<li class="alert-success">
									<span><i class="fas fa-check"></i></span> All starter features
								</li>
								<li>
									<span><i class="fas fa-check"></i></span> 24/7 Email support
								</li>
								<li>
									<span><i class="fas fa-check"></i></span> customizable themes to show your survey
								</li>
								<li>
									<span><i class="fas fa-check"></i></span> Logo add customization
								</li>
								<li>
									<span><i class="fas fa-check"></i></span> Specific Survey Design
								</li>
								<li>
									<span><i class="fas fa-check"></i></span> Unlimited submissions
								</li>
								<li>
									<span><i class="fas fa-check"></i></span> More scalable infrastructure
								</li>
							</ul>
						</div>
					</div>
					<div class="col">
						<div class="pt-plan">
							<h5>Firm (10-50 realtors)</h5>
							<h6><span>$</span><b>2500.00</b></h6>
							<p>/per month</p>

				<form action="./files/create-checkout-session_firms.php" method="post">
					<input type="hidden" name="business" value="<?= PAYPAL_ID ?>">
					<input type="hidden" name="cmd" value="_xclick-subscriptions">

								<input type="hidden" name="item_name" value="Firm (10-50 realtors)">
								<input type="hidden" name="item_number" value="Plan#3">
								<input type="hidden" name="currency_code" value="USD">
								<input type="hidden" name="a3" value="2500.00">
								<input type="hidden" name="p3" value="1">
								<input type="hidden" name="t3" value="M">
								<input type="hidden" name="custom" value="2">

								<input type="hidden" name="return" value="<?= PAYPAL_RETURN_URL ?>">
								<input type="hidden" name="cancel_return" value="<?= PAYPAL_CANCEL_URL ?>">

								<?php if (us_level & us_level != 6): ?>
									<button type="submit" name="submit" class="fancy-button bg-gradient5">
										<span>
											<?= $lang['plans']['btn'] ?> <i class="fas fa-heart"></i>
										</span>
									</button>
								<?php endif; ?>
								<?php if (!us_level && us_level != 6): ?>
									<button type="button" href="#loginModal" data-toggle="modal"
										class="fancy-button bg-gradient5">
										<span>
											<?= $lang['plans']['btn'] ?> <i class="fas fa-heart"></i>
										</span>
									</button>
								<?php endif; ?>

							</form>
							<ul>
								<li class="alert-success">
									<span><i class="fas fa-check"></i></span> All pro and starter features
								</li>
								<li>
									<span><i class="fas fa-check"></i></span> White label solutions and customization
								</li>
								<li>
									<span><i class="fas fa-check"></i></span> Custom Survey Design
								</li>
								<li>
									<span><i class="fas fa-check"></i></span> Export Responses
								</li>
								<li>
									<span><i class="fas fa-check"></i></span> Priority support
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>



		</div>
	</div>



	<!-- --------------------------------------FOOTER----------------------------------------------------- -->


	<div class="container">
		<footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
			<div class="col-md-4 d-flex align-items-center">
				<a href="./" class="mb-3 me-2 px-4 mb-md-0 text-muted text-decoration-none lh-1">
					<img src="" onerror="this.src='<?= path ?>/assets/img/leadstaketime_logo.png'" width="100"
						alt="<?= site_title ?>">
				</a>
				<span class="mb-3 mb-md-0 text-muted" style="font-weight:600;">Leads Take Time</span>
			</div>

			<ul class="nav col-md-4 justify-content-end list-unstyled d-flex">
				<li class="ms-3">Twitter<a class="text-muted" href="#"><svg class="bi" width="24" height="24">
							<use xlink:href="#twitter"> </use>
						</svg></a></li>
				<li class="ms-3">Instagram<a class="text-muted" href="#"><svg class="bi" width="24" height="24">
							<use xlink:href="#instagram"> </use>
						</svg></a></li>
				<li class="ms-3">Facebook<a class="text-muted" href="#"><svg class="bi" width="24" height="24">
							<use xlink:href="#facebook">Facebook</use>
						</svg></a></li>
			</ul>
		</footer>
	</div>

	<div class="container">
		<footer class="py-3 my-4">
			<ul class="nav justify-content-center border-bottom pb-3 mb-3">
				<li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Home</a></li>
				<li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Features</a></li>
				<li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Pricing</a></li>
				<li class="nav-item"><a href="#" class="nav-link px-2 text-muted">About Us</a></li>
				<li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Contact Us</a></li>
			</ul>
			<p class="text-center text-muted">© Leads Take Time | All Rights Reserved</p>
		</footer>
	</div>

	<!-- End Footer -->

	</div><!-- End Wrapper -->

	<script>
		var path = '<?= path ?>';
		var lang = <?= json_encode($lang) ?>;
		var maxsteps = <?= surveys_steps ?>;
		var maxquestions = <?= surveys_questions ?>;
		var maxanswers = <?= surveys_answers ?>;
		var nophoto = '<?= nophoto ?>';
		var privacy_link = '<?= privacy_link ?>';
		var terms_link = '<?= terms_link ?>';
		var phonemask = '<?= site_phonemask ?>';
	</script>

	<script type="text/javascript" src="<?= path ?>/assets/js/jquery.min.js"></script>

	<script src="<?= path ?>/assets/js/popper.min.js"></script>
	<script src="<?= path ?>/assets/js/bootstrap.min.js"></script>
	<script src="<?= path ?>/assets/js/jquery.livequery.js"></script>

	<script src="<?= path ?>/assets/js/popupConsent.min.js"></script>
	<script>
		(function ($) {
			'use strict';

			$(document).ready(function () {
				$.puerto_droped = function (prtclick, prtlist = "ul.pt-drop") {
					$(prtclick).livequery('click', function () {
						var ul = $(this).parent();
						if (ul.find(prtlist).hasClass('open')) {
							ul.find(prtlist).removeClass('open');
							$(this).removeClass('active');
							if (prtclick == ".pl-mobile-menu") $('body').removeClass('active');
						} else {
							$("ul.pt-drop").parent().find(".active").removeClass('active');
							$("ul.pt-drop").removeClass('open');
							ul.find(prtlist).addClass('open');
							$(this).addClass('active');
							if (prtclick == ".pl-mobile-menu") $('body').addClass('active');
						}
						return false;
					});
					$("html, body").livequery('click', function () {
						$("ul.pt-drop").parent().find(".active").removeClass('active');
						$("ul.pt-drop").removeClass('open');
						if (prtclick == ".pl-mobile-menu") $('body').removeClass('active');
					});
				}

				$.puerto_droped(".pt-mobmenulink");

				$(".pt-lang a").on('click', function () {
					$.post(path + "/ajax.php?pg=lang", { id: $(this).attr('rel') }, function (puerto) { location.reload(); });
					return false;
				});

				$(".pt-log").on('click', function () {
					var ul = $(this).parent();
					if (ul.find(".pt-drops").hasClass('open')) {
						ul.find(".pt-drops").removeClass('open');
						$(this).removeClass('active');
					} else {
						$("ul.pt-drops").parent().find(".active").removeClass('active');
						$("ul.pt-drops").removeClass('open');
						ul.find(".pt-drops").addClass('open');
						$(this).addClass('active');
					}
					return false;
				});


				$("#pt-send-signin").on("submit", function () {
					var ths = $(this);
					var btn = ths.find('button[type=submit]');
					var btxt = btn.html();

					btn.prop('disabled', true).html('<i class="fas fa-spinner fa-pulse fa-fw"></i> Loading..');

					$.post(path + "/ajax.php?pg=login", $(this).serialize(), function (puerto) {
						btn.before(puerto.alert);
						if (puerto.type == "danger") {
							setTimeout(function () {
								$(".alert").fadeOut('slow').remove();
								btn.html(btxt).prop('disabled', false);
							}, 3000);
						} else {
							setTimeout(function () {
								$(".alert").fadeOut('slow').remove();
								$(location).attr('href', path + "/mysurveys");
							}, 3000);
						}
					}, 'json');
					return false;
				});

				$("#pt-send-signup").on("submit", function () {
					var ths = $(this);
					var btn = ths.find('button[type=submit]');
					var btxt = btn.html();

					btn.prop('disabled', true).html('<i class="fas fa-spinner fa-pulse fa-fw"></i> Loading..');

					$.post(path + "/ajax.php?pg=register", $(this).serialize(), function (puerto) {
						btn.before(puerto.alert);
						if (puerto.type == "danger") {
							setTimeout(function () {
								$(".alert").fadeOut('slow').remove();
								btn.html(btxt).prop('disabled', false);
							}, 3000);
						} else {
							setTimeout(function () {
								$(".alert").fadeOut('slow').remove();
								location.reload();
							}, 3000);
						}
					}, 'json');
					return false;
				});




				if (document.cookie.split(/; */).indexOf("popupConsent=true") == '-1') {
					popupConsent({
						'textPopup': lang['home']['cookie1'].replace("{link_privacy}", '<a href="' + privacy_link + '" target="_blank">' + lang['home']['privacy'] + '</a>').replace("{link_terms}", '<a href="' + terms_link + '" target="_blank">' + lang['home']['terms'] + '</a>'),
						'textButtonAccept': lang['home']['cookie2'],
						'textButtonConfigure': lang['home']['cookie3'],
						'textButtonSave': lang['home']['cookie4'],

						authorization: [
							{ textAuthorization: lang['home']['cookie5'], nameCookieAuthorization: 'autoriseGeolocation' },
							{ textAuthorization: lang['home']['cookie6'], nameCookieAuthorization: 'targetedAdvertising' },
							{ textAuthorization: lang['home']['cookie7'], nameCookieAuthorization: 'cookieConsent' }
						]

					});
				}


			});


		}(jQuery));
	</script>

</body>

</html>