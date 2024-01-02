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
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

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
			<!-- <?php if ( !site_hidetopbar ): ?>
				<div class="pt-header-top">
			<h1>header</h1>
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
		<?php endif; ?> -->

		<div class="pt-container">
			<div class="pt-top-menu">
				<div class="pt-mobile-header">
						<div class="pt-logo">
							<img src="" onerror="this.src='<?=path?>/assets/img/leadstaketime_logo.png'" alt="<?=site_title?>">
						</div>
					<div class=" pt-mobmenu">
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
						<ul class="pt-right-menu">
		
						<!------------------------------------ SUBSCRIPTION PLANS --------------------------------------- -->
							<!-- <?php if( site_plans ): ?> 
							<li><a href="<?=path?>/index.php?pg=plans"><i class="far fa-gem"></i> <?=$lang['menu']['plans']?></a></li> 
							<?php endif; ?> -->
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

		<!-- ---------------------------HERO SECTION ------------------------------------ -->
    
		<div class="pt-container">
			<div class="row flex-row-reverse align-items-center bg-light col-xxl-10 mx-auto py-4">
				<div class="col-lg-4 ms-lg-4">
					<div style="" class="lc-block mb-4">
						<img class="img-fluid shadow" src="https://images.unsplash.com/photo-1525004866327-07739b938272?crop=entropy&amp;cs=tinysrgb&amp;fit=crop&amp;fm=jpg&amp;ixid=MnwzNzg0fDB8MXxzZWFyY2h8MTZ8fGJ1aWxkaW5nfGVufDB8Mnx8fDE2MzQ1NTA4MDc&amp;ixlib=rb-1.2.1&amp;q=80&amp;w=1080&amp;h=1080" alt="Photo by Kaloyan Draganov">
					</div><!-- /lc-block -->
				</div>
				<div class="col-lg-7 ps-lg-4">
					<div class="lc-block mb-4">
						<div editable="rich">
							<h1 class="rfs-30 fw-bold">Lorem ipsum dolor sit amet</h1>
						</div>
					</div>
					<div class="lc-block mb-4">
						<div editable="rich">
							<p class="lead"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc et metus id ligula malesuada placerat sit</p>
						</div>
					</div>
					<div class="lc-block">
						<a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
					</div>
				</div>
			</div>
		</div>git 

	</div>


	<!-- ----------------------------------FEATURES------------------------------------------------- -->
	<!-- <div class="alba-sepa"><div class="custom-shape-divider-top-1606478547"><svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none"><path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" opacity=".25" class="shape-fill"></path><path d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z" opacity=".5" class="shape-fill"></path><path d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z" class="shape-fill"></path></svg></div></div> -->
	<div class="pt-section pt-features">
		<div class="pt-container">
			<div class="pt-stitle">
				<h3>Why to choose <span>LEADS TAKE TIME?</span></h3>
				<!-- <h1>hello</h1> -->
				<!-- <p><?=$lang['home']['sf_p']?></p> -->
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
					<?php if( site_plans ): ?>
					<a href="<?=path?>/index.php?pg=plans"><span><i class="icon-diamond icons"></i> <?=$lang['home']['link1']?></span></a>
					<?php endif; ?>
					<a href="<?=path?>/index.php?pg=mysurveys"><span><i class="icon-question icons"></i> <?=$lang['home']['link2']?></span></a>
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
						<b>72.41%	</b>
					</div>
				</div>

		</div>
	</div>

<!-- --------------------------------------PLANS----------------------------------------------------- -->
<?php
// include __DIR__."/header.php";

if( !site_plans ){
	echo "<div class='padding'>".fh_alerts($lang['alerts']['wrong'], "danger", path)."</div>";
	include __DIR__."/footer.php";
	exit;
}

?>

<div class="pt-title">
	<h3><span><i class="fas fa-dollar-sign"></i></span></h3>
	<h3><?=$lang['plans']['title']?></h3>
	<p><?=$lang['plans']['desc']?></p>
</div>

<div class="pt-plans">
<div class="row">
	<?php
	$sql = $db->query("SELECT * FROM ".prefix."plans WHERE id != 0");
	while($value = $sql->fetch_assoc()):
	?>
		<div class="col">
			<div class="pt-plan">
				<h5><?=$value['plan']?></h5>
				<h6><span><?=site_currency_symbol?></span><b><?=$value['price']?></b></h6>
				<p><?=$lang['plans']['month']?></p>

				<form action="<?php echo PAYPAL_URL; ?>" method="post">
					<input type="hidden" name="business" value="<?=PAYPAL_ID?>">
					<input type="hidden" name="cmd" value="_xclick-subscriptions">

					<input type="hidden" name="item_name" value="<?=$value['plan']?>">
					<input type="hidden" name="item_number" value="Plan#<?=$value['id']?>">
					<input type="hidden" name="currency_code" value="<?=PAYPAL_CURRENCY?>">
					<input type="hidden" name="a3" value="<?=$value['price']?>">
					<input type="hidden" name="p3" value="1">
					<input type="hidden" name="t3" value="M">
    			<input type="hidden" name="custom" value="<?=us_id?>">

					<input type="hidden" name="return" value="<?=PAYPAL_RETURN_URL?>">
					<input type="hidden" name="cancel_return" value="<?=PAYPAL_CANCEL_URL?>">

					<?php if (us_level): ?>
						<button <?=((int)($value['price'])==0?'disabled':'')?> type="sublit" name="submit" class="fancy-button bg-gradient<?=($value['id']==2?'5' :'5')?>">
							<span><?=$lang['plans']['btn']?> <i class="fas fa-heart"></i></span>
						</button>
					<?php else: ?>
						<button type="button" href="#loginModal" data-toggle="modal" class="fancy-button bg-gradient<?=($value['id']==2?'5' :'5')?>">
							<span><?=$lang['plans']['btn']?> <i class="fas fa-heart"></i></span>
						</button>
					<?php endif; ?>

				</form>
				<ul>
					<?php
					$value['specifics'] = [
						[$value['desc1'], 'green', '1'],
						[$value['desc2'], '', '1'],
						[$value['desc3'], '', '1'],
						[$value['desc4'], '', $value['surveys_rapport']],
						[$value['desc5'], '', $value['survey_design']],
						[$value['desc6'], '', $value['surveys_export']],
						[$value['desc7'], '', $value['surveys_iframe']],
						[$value['desc8'], '', $value['support']],
						[$value['desc9'], '', $value['show_ads']]
					];
					foreach ($value['specifics'] as $v):
						if ($v[0]):
						?>
						<li<?=($v[1] == 'green' ?' class="alert-success"' :'')?>>
							<span><i class="fas fa-<?=($v[2]=='1'?'check' :'times')?>"></i></span> <?=$v[0]?>
						</li>
						<?php
						endif;
					endforeach;
					?>
				</ul>
			</div>
		</div>
		<?php
	endwhile;
	?>
</div>
</div>



<!-- --------------------------------------FOOTER----------------------------------------------------- -->

<div class="pt-footer">
	<!-- SVGs -->
	<!-- <div class="svg"><svg x="0px" y="0px" viewBox="0 186.5 1920 113.5"><polygon points="-30,300 355.167,210.5 1432.5,290 1920,198.5 1920,300"></polygon></svg></div><div class="svg svg2"><svg x="0px" y="0px" viewBox="0 186.5 1920 113.5"><polygon points="-30,300 355.167,210.5 1432.5,290 1920,198.5 1920,300"></polygon></svg></div> -->
	<div class="container">
		<div class="row">
			<div class="col-3">
				<div class="pt-logo">
					<a href="<?=path?>">
						<img src="" onerror="this.src='<?=path?>/assets/img/leadstaketime_logo.png'" alt="<?=site_title?>">	
					</a></div>
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
	<div>
		<img src="" onerror="this.src='<?=path?>/assets/img/footer_white.png'" alt="<?=site_title?>">
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
