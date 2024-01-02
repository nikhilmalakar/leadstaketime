<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
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

	<link rel="stylesheet" href="<?=path?>/assets/css/normalize.css">
	<link rel="stylesheet" href="<?=path?>/assets/css/all.min.css">
	<link rel="stylesheet" href="<?=path?>/assets/css/simple-line-icons.css">

	<!-- Google Fonts -->
	<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Raleway:100,200,300,400,500,600,700,900%7CGentium+Basic:400italic&subset=latin,latin">
	<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,400,300,700">
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/flag-icon-css/4.1.5/css/flag-icons.min.css">

	<link rel="stylesheet" href="<?=path?>/assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?=path?>/assets/css/popupConsent.css">
	<link rel="stylesheet" href="<?=path?>/assets/css/home.css">


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
<body class="pt-bodyhome">

<div class="pt-wrapper">


	<div class="pt-header">
		<?php if ( !site_hidetopbar ): ?>
		<div class="pt-header-top">
			<div class="pt-container">
				<?php if ( site_email ): ?> <a><i class="far fa-envelope-open"></i> <?=site_email?></a> <?php endif; ?>
				<?php if ( site_phone ): ?> <a><i class="fas fa-phone-volume"></i> <?=site_phone?></a> <?php endif; ?>

				<?php if (!us_level): ?>
				<div class="right pt-login-form">
					<a class="pt-log"><?=$lang['home']['login']?></a>
					<ul class="pt-drops">
						<li>
							<form id="pt-send-signin">

								<label class="pt-input-icon">
									<span><i class="fas fa-user"></i></span>
									<input type="text" name="sign_name" placeholder="<?=$lang['login']['username']?>" />
								</label>
								<label class="pt-input-icon">
									<span><i class="fas fa-key"></i></span>
									<input type="password" name="sign_pass" placeholder="<?=$lang['login']['password']?>" />
								</label>
								<button type="submit"><?=$lang['login']['button']?></button>

								<?php if(site_register && (login_facebook || login_twitter || login_google)): ?>
								<div class="pt-social-login">
									<b><?=$lang['home']['login2']?></b>
									<?php if(login_facebook): ?> <a class="facebook" href="<?=$facebookLoginUrl?>"><i class="fab fa-facebook"></i></a> <?php endif; ?>
									<?php if(login_twitter): ?> <a class="twitter" href="<?=$twitterLoginUrl?>"><i class="fab fa-twitter"></i></a> <?php endif; ?>
									<?php if(login_google): ?> <a class="google" href="<?=$googleLoginUrl?>"><i class="fab fa-google"></i></a> <?php endif; ?>
								</div>
								<?php endif; ?>
								<?php if(site_register): ?>
								<p><?=$lang['login']['footer']?> <span href="#registrationModal" data-toggle="modal"><?=$lang['login']['footer_l']?></span></p>
								<?php endif; ?>


							</form>
						</li>
					</ul>
				</div>
				<?php endif; ?>

				<a class="right" href="<?=support_link?>"><i class="fas fa-headset"></i> <?=$lang['home']['support']?></a>
			</div>
		</div>
		<?php endif; ?>

		<div class="pt-container">
			<div class="pt-top-menu">
				<div class="pt-logo">
					<img src="<?=site_logo?>" onerror="this.src='<?=path?>/assets/img/logo3.png'" alt="<?=site_title?>">
				</div>
				<div class="left pt-mobmenu">
					<a href="#" class="pt-mobmenulink"><i class="fas fa-bars"></i></a>
					<ul class="pt-left-menu pt-drop">
						<li><a href="<?=path?>"><?=$lang['home']['home']?></a></li>
						<?php
						$sql = $db->query("SELECT * FROM ".prefix."pages WHERE header = 0 ORDER BY sort ASC");
						if($sql->num_rows):
						while($rs = $sql->fetch_assoc()):
						?>
						<li><a href="<?=path?>/index.php?pg=pages&id=<?=$rs['id']?>&t=<?=fh_seoURL($rs['title'])?>"><?=$rs['title']?></a></li>
						<?php endwhile; ?>
						<?php endif; ?>
						<?php $sql->close(); ?>
					</ul>
				</div>
				<ul class="pt-right-menu">
					<?php if( site_plans ): ?>
					<li><a href="<?=path?>/index.php?pg=plans"><i class="far fa-gem"></i> <?=$lang['menu']['plans']?></a></li>
					<?php endif; ?>
					<li><a href="<?=path?>/index.php?pg=mysurveys" class="pt-started"><?=(!us_level?$lang['home']['get']:$lang['menu']['my'])?></a></li>
					<?php if ( !us_level ): ?>
					<?php if ( site_hidetopbar ): ?>
					<li class="pt-login-form">
						<a class="pt-log"><?=$lang['home']['login']?></a>
						<ul class="pt-drops">
							<li>
								<form id="pt-send-signin">

									<label class="pt-input-icon">
										<span><i class="fas fa-user"></i></span>
										<input type="text" name="sign_name" placeholder="<?=$lang['login']['username']?>" />
									</label>
									<label class="pt-input-icon">
										<span><i class="fas fa-key"></i></span>
										<input type="password" name="sign_pass" placeholder="<?=$lang['login']['password']?>" />
									</label>
									<button type="submit"><?=$lang['login']['button']?></button>

									<?php if(site_register && (login_facebook || login_twitter || login_google)): ?>
									<div class="pt-social-login">
										<b><?=$lang['home']['login2']?></b>
										<?php if(login_facebook): ?> <a class="facebook" href="<?=$facebookLoginUrl?>"><i class="fab fa-facebook"></i></a> <?php endif; ?>
										<?php if(login_twitter): ?> <a class="twitter" href="<?=$twitterLoginUrl?>"><i class="fab fa-twitter"></i></a> <?php endif; ?>
										<?php if(login_google): ?> <a class="google" href="<?=$googleLoginUrl?>"><i class="fab fa-google"></i></a> <?php endif; ?>
									</div>
									<?php endif; ?>
									<?php if(site_register): ?>
									<p><?=$lang['login']['footer']?> <span href="#registrationModal" data-toggle="modal"><?=$lang['login']['footer_l']?></span></p>
									<?php endif; ?>


								</form>
							</li>
						</ul>

					</li>
					<?php endif; ?>
					<?php endif; ?>
					<?php if (us_level==6): ?>
					<li><a href="<?=path?>/dashboard.php" class="pt-started ml-1" title="<?=$lang['menu']['admin']?>"><i class="fas fa-cogs"></i></a></li>
					<?php endif; ?>
				</ul>
			</div>
		</div>

		<?php if(site_register): ?>
		<form id="pt-send-signup" class="pt-form">
		<div class="modal fade newmodal" id="registrationModal">
		  <div class="modal-dialog">
		    <div class="modal-content">

		      <div class="modal-header">
		        <h4 class="modal-title"><?=$lang['login']['footer_l']?></h4>
		        <a type="button" class="close" data-dismiss="modal">×</a>
		      </div>

		      <div class="modal-body">
						<div class="form-groups">
							<label class="pt-input-icon">
								<span><i class="fas fa-user"></i></span>
								<input type="text" name="reg_name" placeholder="<?=$lang['signup']['username']?>">
							</label>
						</div>
						<div class="form-groups">
							<label class="pt-input-icon">
								<span><i class="fas fa-key"></i></span>
								<input type="password" name="reg_pass" placeholder="<?=$lang['signup']['password']?>">
							</label>
						</div>
						<div class="form-groups">
							<label class="pt-input-icon">
								<span><i class="fas fa-envelope"></i></span>
								<input type="text" name="reg_email" placeholder="<?=$lang['signup']['email']?>">
							</label>
						</div>
						<p><?=str_replace(["{link_privacy}", "{link_terms}"], ['<a href="'.privacy_link.'" target="_blank">'.$lang['home']['privacy'].'</a>', '<a href="'.terms_link.'" target="_blank">'.$lang['home']['terms'].'</a>'],$lang['home']['accepting'])?></p>
						<div class="pt-msg"></div>
		      </div>

		      <div class="modal-footer">
		        <button type="submit" class="btn bg-gr"><?=$lang['signup']['button']?></button>
		      </div>

		    </div>
		  </div>
		</div>
		</form>
		<?php endif; ?>


		<div class="pt-container">
			<div class="pt-context">
				<h3><?=str_replace("{br}", "<br />",$lang['home']['s_h'])?></h3>
				<p><?=$lang['home']['s_p']?></p>
				<a href="<?=path?>/index.php?pg=mysurveys"><i class="fas fa-fire"></i> <?=$lang['home']['s_b']?></a>
			</div>
		</div>

		<!-- SVGs -->
		<!-- <div class="svg"><svg x="0px" y="0px" viewBox="0 186.5 1920 113.5"><polygon points="-30,300 355.167,210.5 1432.5,290 1920,198.5 1920,300"></polygon></svg></div><div class="svg svg2"><svg x="0px" y="0px" viewBox="0 186.5 1920 113.5"><polygon points="-30,300 355.167,210.5 1432.5,290 1920,198.5 1920,300"></polygon></svg></div> -->
	</div>

	<div class="alba-sepa"><div class="custom-shape-divider-top-1606478547"><svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none"><path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" opacity=".25" class="shape-fill"></path><path d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z" opacity=".5" class="shape-fill"></path><path d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z" class="shape-fill"></path></svg></div></div>

	<div class="pt-section pt-features">
		<div class="pt-container">

			<div class="pt-stitle">
				<h3><?=$lang['home']['sf_h']?></h3>
				<p><?=$lang['home']['sf_p']?></p>
			</div>

				<ul>
					<li>
						<div class="pt-content">
							<span><i class="icon-fire icons"></i></span>
							<h3><?=$lang['home']['sf_h1']?></h3>
							<p><?=$lang['home']['sf_p1']?></p>
							<a href="<?php echo feature_link1 ?>"><?=$lang['home']['sf_b']?> <i class="fas fa-long-arrow-alt-right"></i></a>
						</div>
					</li>
					<li>
						<div class="pt-content">
							<span><i class="icon-rocket icons"></i></span>
							<h3><?=$lang['home']['sf_h2']?></h3>
							<p><?=$lang['home']['sf_p2']?></p>
							<a href="<?php echo feature_link2 ?>"><?=$lang['home']['sf_b']?> <i class="fas fa-long-arrow-alt-right"></i></a>
						</div>
					</li>
					<li>
						<div class="pt-content">
							<span><i class="icon-speedometer icons"></i></span>
							<h3><?=$lang['home']['sf_h3']?></h3>
							<p><?=$lang['home']['sf_p3']?></p>
							<a href="<?php echo feature_link3 ?>"><?=$lang['home']['sf_b']?> <i class="fas fa-long-arrow-alt-right"></i></a>
						</div>
					</li>
					<li>
						<div class="pt-content">
							<span><i class="icon-pie-chart icons"></i></span>
							<h3><?=$lang['home']['sf_h4']?></h3>
							<p><?=$lang['home']['sf_p4']?></p>
							<a href="<?php echo feature_link4 ?>"><?=$lang['home']['sf_b']?> <i class="fas fa-long-arrow-alt-right"></i></a>
						</div>
					</li>
				</ul>

				<div class="pt-links">
					<?php if( site_plans ): ?>
					<a href="<?=path?>/index.php?pg=plans"><span><i class="icon-diamond icons"></i> <?=$lang['home']['link1']?></span></a>
					<?php endif; ?>
					<a href="<?=path?>/index.php?pg=mysurveys"><span><i class="icon-question icons"></i> <?=$lang['home']['link2']?></span></a>
				</div>

				<div class="pt-stats">
					<div>
						<span><i class="icon-chart icons"></i></span>
						<strong><?=$lang['home']['stats_h1']?></strong>
						<b><?php echo db_rows("survies")?></b>
					</div>
					<div>
						<span><i class="icon-check icons"></i></span>
						<strong><?=$lang['home']['stats_h2']?></strong>
						<b><?php echo db_rows("responses")?></b>
					</div>
					<div>
						<span><i class="icon-people icons"></i></span>
						<strong><?=$lang['home']['stats_h3']?></strong>
						<b><?php echo db_rows("users")?></b>
					</div>
				</div>

		</div>
	</div>

	<div class="pt-section pt-topsurvys">
		<div class="pt-container">

			<div class="pt-stitle">
				<h3><?=$lang['home']['top_h']?></h3>
				<p><?=$lang['home']['top_p']?></p>
			</div>

				<ul>
					<?php
					$sql = $db->query("SELECT s.id, s.author, s.title, COUNT(r.id) AS resp FROM ".prefix."survies AS s LEFT JOIN ".prefix."responses AS r ON(r.survey = s.id) WHERE s.private = 0 GROUP BY s.id ORDER BY COUNT(r.id) DESC LIMIT 3") or die ($db->error);
					if($sql->num_rows):
					while($rs = $sql->fetch_assoc()):
						$firststep = db_get("steps", "views", $rs['id'], "survey", "ORDER BY id ASC LIMIT 1");
						$laststep  = db_get("steps", "views", $rs['id'], "survey", "ORDER BY id DESC LIMIT 1");
						$pourcent  = $firststep ? ceil(($laststep/$firststep)*100) : '--';
						$lastresp  = db_get("responses", "date", $rs['id'], "survey", "ORDER BY id DESC LIMIT 1");
						$userphoto = db_get("users", "photo", $rs['author']);
					?>
					<li>
						<div class="media">
								<div class="pt-thumb">
									<img src="<?=($userphoto?$userphoto:nophoto)?>" title="<?=fh_user($rs['author'], false)?>" onerror="this.src='<?=nophoto?>'" />
								</div>
							<div class="pt-dtable">
							<div class="pt-vmiddle">
								<a href="<?=path?>/index.php?pg=survey&id=<?=$rs['id']?>&t=<?=fh_seoURL($rs['title'])?>&request=su"><?=$rs['title']?></a>
								<p>
									<b><?=db_rows("responses WHERE survey = '{$rs['id']}' GROUP BY ip", "ip")?></b> <?=$lang['home']['rel']?> <?=($lastresp?fh_ago($lastresp):'--')?>
								</p>
							</div>
							</div>
						</div>
					</li>
					<?php
					endwhile;
					else:
						?>
						<div>
								<?=fh_alerts($lang['alerts']["no-data"], "info")?>
						</div>
						<?php
					endif;
					$sql->close();
					?>
				</ul>

			</div>

	</div>

	<div class="pt-section pt-features">
		<div class="pt-container">

			<div class="pt-stitle">
				<h3><?=$lang['home']['integ_h']?></h3>
				<p><?=$lang['home']['integ_p']?></p>
			</div>
			<div class="pt-iframe">
				<iframe src="<?php echo iframe_link ?>"></iframe>
			</div>
		</div>

	</div>

	<div class="alba-sepa alba-footer"><div class="custom-shape-divider-top-1606478547"><svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none"><path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" opacity=".25" class="shape-fill"></path><path d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z" opacity=".5" class="shape-fill"></path><path d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z" class="shape-fill"></path></svg></div></div>

<div class="pt-footer">
	<!-- SVGs -->
	<!-- <div class="svg"><svg x="0px" y="0px" viewBox="0 186.5 1920 113.5"><polygon points="-30,300 355.167,210.5 1432.5,290 1920,198.5 1920,300"></polygon></svg></div><div class="svg svg2"><svg x="0px" y="0px" viewBox="0 186.5 1920 113.5"><polygon points="-30,300 355.167,210.5 1432.5,290 1920,198.5 1920,300"></polygon></svg></div> -->
	<div class="container">
		<div class="row">
			<div class="col-3">
				<div class="pt-logo"><a href="<?=path?>"><img src="<?=site_logo?>" onerror="this.src='<?=path?>/assets/img/logo3.png'" /></a></div>
				<div class="pt-social">
					<?php if (site_facebook): ?>
					<a href="https://facebook.com/<?=site_facebook?>" target="_blank"><i class="fab fa-facebook"></i></a>
					<?php endif; ?>
					<?php if (site_instagram): ?>
					<a href="https://instagram.com/<?=site_instagram?>" target="_blank"><i class="fab fa-instagram"></i></a>
					<?php endif; ?>
					<?php if (site_twitter): ?>
					<a href="https://twitter.com/<?=site_twitter?>" target="_blank"><i class="fab fa-twitter"></i></a>
					<?php endif; ?>
					<?php if (site_youtube): ?>
					<a href="https://youtube.com/<?=site_youtube?>" target="_blank"><i class="fab fa-youtube"></i></a>
					<?php endif; ?>
					<?php if (site_skype): ?>
					<a href="https://skype.com/<?=site_skype?>" target="_blank"><i class="fab fa-skype"></i></a>
					<?php endif; ?>
				</div>
			</div>
			<div class="col-6">
				<div class="pt-links">
					<h3><?=$lang['home']['flinks']?></h3>
					<?php
					$sql = $db->query("SELECT * FROM ".prefix."pages WHERE footer = 0 ORDER BY sort ASC LIMIT 12");
          if($sql->num_rows):
          $i = 1;
          while($rs = $sql->fetch_assoc()):
          ?>
          <a href="<?=path?>/index.php?pg=pages&id=<?=$rs['id']?>&t=<?=fh_seoURL($rs['title'])?>"><i class="fas fa-long-arrow-alt-<?=($lang['rtl'] == "rtl_true" ? 'left':'right')?>"></i> <?=$rs['title']?></a>
          <?php
          $i++;
          if($i==7){
            echo'</div><div class="pt-links"><h3>&nbsp;</h3>';
            $i=0;
          }
          endwhile;
          endif;
          $sql->close();
          ?>
				</div>
			</div>
			<div class="col-3">
				<div class="pt-copy">
					<h3>&nbsp;</h3>
					<div class="pt-lang">
						<?php
						$sql = $db->query("SELECT * FROM ".prefix."languages") or die ($db->error);
						while ( $rs = $sql->fetch_assoc() ) {
							echo '<a href="#" rel="'.$rs['id'].'" title="'.$rs['language'].'"><i class="flag-icon flag-icon-squared flag-icon-'.strtolower($rs['short']).'"></i></a>';
						}
						$sql->close();
						?>
					</div>
					<?=str_replace("{link}", '<a href="'.path.'">'.site_title.'</a>',$lang['home']['copyright'])?>
				</div>
			</div>
		</div>
	</div>

</div><!-- End footer -->


</div><!-- End Wrapper -->

<script>
	var path         = '<?=path?>';
	var lang         = <?=json_encode($lang)?>;
	var maxsteps     = <?=surveys_steps?>;
	var maxquestions = <?=surveys_questions?>;
	var maxanswers   = <?=surveys_answers?>;
	var nophoto      = '<?=nophoto?>';
	var privacy_link = '<?=privacy_link?>';
	var terms_link   = '<?=terms_link?>';
	var phonemask    = '<?=site_phonemask?>';
</script>

<script type="text/javascript" src="<?=path?>/assets/js/jquery.min.js"></script>

<script src="<?=path?>/assets/js/popper.min.js"></script>
<script src="<?=path?>/assets/js/bootstrap.min.js"></script>
<script src="<?=path?>/assets/js/jquery.livequery.js"></script>

<script src="<?=path?>/assets/js/popupConsent.min.js"></script>
<script>
( function ( $ ) {
    'use strict';

$(document).ready(function(){
	$.puerto_droped = function( prtclick, prtlist = "ul.pt-drop" ){
		$(prtclick).livequery('click', function(){
			var ul = $(this).parent();
			if( ul.find(prtlist).hasClass('open') ){
				ul.find(prtlist).removeClass('open');
				$(this).removeClass('active');
				if(prtclick == ".pl-mobile-menu") $('body').removeClass('active');
			} else {
				$("ul.pt-drop").parent().find(".active").removeClass('active');
				$("ul.pt-drop").removeClass('open');
				ul.find(prtlist).addClass('open');
				$(this).addClass('active');
				if(prtclick == ".pl-mobile-menu") $('body').addClass('active');
			}
			return false;
		});
		$("html, body").livequery('click', function(){
			$("ul.pt-drop").parent().find(".active").removeClass('active');
			$("ul.pt-drop").removeClass('open');
			if(prtclick == ".pl-mobile-menu") $('body').removeClass('active');
		});
	}

	$.puerto_droped(".pt-mobmenulink");

	$(".pt-lang a").on('click', function() {
		$.post(path+"/ajax.php?pg=lang", {id:$(this).attr('rel')}, function(puerto){ location.reload();});
		return false;
	});

	$(".pt-log").on('click', function(){
		var ul = $(this).parent();
		if( ul.find(".pt-drops").hasClass('open') ){
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


	$("#pt-send-signin").on("submit", function(){
		var ths = $(this);
		var btn  = ths.find('button[type=submit]');
		var btxt = btn.html();

		btn.prop('disabled', true).html('<i class="fas fa-spinner fa-pulse fa-fw"></i> Loading..');

		$.post(path+"/ajax.php?pg=login", $(this).serialize(), function(puerto){
			btn.before(puerto.alert);
			if(puerto.type == "danger"){
				setTimeout(function () {
					$(".alert").fadeOut('slow').remove();
					btn.html(btxt).prop('disabled', false);
				}, 3000);
			} else {
				setTimeout(function () {
					$(".alert").fadeOut('slow').remove();
					$(location).attr('href', path+"/mysurveys");
				}, 3000);
			}
		}, 'json');
		return false;
	});

	$("#pt-send-signup").on("submit", function(){
		var ths = $(this);
		var btn  = ths.find('button[type=submit]');
		var btxt = btn.html();

		btn.prop('disabled', true).html('<i class="fas fa-spinner fa-pulse fa-fw"></i> Loading..');

		$.post(path+"/ajax.php?pg=register", $(this).serialize(), function(puerto){
			btn.before(puerto.alert);
			if(puerto.type == "danger"){
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




	if( document.cookie.split(/; */).indexOf("popupConsent=true") == '-1' ){
		popupConsent({
		  'textPopup': lang['home']['cookie1'].replace("{link_privacy}", '<a href="'+privacy_link+'" target="_blank">'+lang['home']['privacy']+'</a>').replace("{link_terms}", '<a href="'+terms_link+'" target="_blank">'+lang['home']['terms']+'</a>'),
		  'textButtonAccept' : lang['home']['cookie2'],
		  'textButtonConfigure' : lang['home']['cookie3'],
		  'textButtonSave' : lang['home']['cookie4'],

		  authorization: [
		    { textAuthorization: lang['home']['cookie5'], nameCookieAuthorization: 'autoriseGeolocation' },
		    { textAuthorization: lang['home']['cookie6'], nameCookieAuthorization: 'targetedAdvertising' },
		    { textAuthorization: lang['home']['cookie7'], nameCookieAuthorization: 'cookieConsent' }
		  ]

		});
	}


});


} ( jQuery ) );
</script>

</body>
</html>
