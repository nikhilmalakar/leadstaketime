<?php if (site_ads_header && (fh_access("ads") || !us_level) && $pg != 'editor'): ?>
	<div class="pt-footer-ads">
		<?= (page != "editor" ? site_ads_footer : '') ?>
	</div>
<?php endif; ?>

<div class="" style="background:white;">

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
		<footer class="py-3 ">
			<ul class="nav justify-content-center border-bottom pb-3 mb-3">
				<li class="nav-item"><a href="<?= path ?>/index.php" class="nav-link px-2 text-muted">Home</a></li>
				<!-- <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Features</a></li> -->
				<li class="nav-item"><a href="<?= path ?>/index.php?pg=plans" class="nav-link px-2 text-muted">Pricing</a></li>
				<li class="nav-item"><a href="<?= path ?>/p1/about" class="nav-link px-2 text-muted">About Us</a></li>
				<li class="nav-item"><a href="<?= path ?>/p2/" class="nav-link px-2 text-muted">Contact Us</a></li>
			</ul>
			<p class="text-center text-muted">© Leads Take Time | All Rights Reserved</p>
		</footer>
	</div>


</div>


<?php if (!us_level): ?>

	<form id="pt-send-signin" class="pt-form">
		<div class="modal fade newmodal" id="loginModal">
			<div class="modal-dialog">
				<div class="modal-content">

					<div class="modal-header">
						<h4 class="modal-title">
							<?= $lang['signup']['footer_l'] ?>
						</h4>
						<a type="button" class="close" data-dismiss="modal">×</a>
					</div>

					<div class="modal-body">
						<label class="pt-input-icon">
							<span><i class="fas fa-user"></i></span>
							<input type="text" name="sign_name" placeholder="<?= $lang['login']['username'] ?>" />
						</label>
						<label class="pt-input-icon">
							<span><i class="fas fa-key"></i></span>
							<input type="password" name="sign_pass" placeholder="<?= $lang['login']['password'] ?>" />
						</label>
						<div class="pt-msg"></div>
					</div>

					<div class="modal-footer">
						<button type="submit" class="btn bg-gr">
							<?= $lang['login']['button'] ?>
						</button>
						<?php if (site_register && (login_facebook || login_twitter || login_google)): ?>
							<div class="pt-social-login">
								<b>
									<?= $lang['home']['login2'] ?>
								</b>
								<?php if (login_facebook): ?> <a class="facebook" href="<?= $facebookLoginUrl ?>"><i
											class="fab fa-facebook"></i></a>
								<?php endif; ?>
								<?php if (login_twitter): ?> <a class="twitter" href="<?= $twitterLoginUrl ?>"><i
											class="fab fa-twitter"></i></a>
								<?php endif; ?>
								<?php if (login_google): ?> <a class="google" href="<?= $googleLoginUrl ?>"><i
											class="fab fa-google"></i></a>
								<?php endif; ?>
							</div>
						<?php endif; ?>
						<?php if (site_register): ?>
							<p>
								<?= $lang['login']['footer'] ?> <span href="#registrationModal" data-toggle="modal">
									<?= $lang['login']['footer_l'] ?>
								</span>
							</p>
						<?php endif; ?>
					</div>

				</div>
			</div>
		</div>
	</form>

	<?php if (site_register): ?>
		<form id="pt-send-signup" class="pt-form">
			<div class="modal fade newmodal" id="registrationModal">
				<div class="modal-dialog">
					<div class="modal-content">

						<div class="modal-header">
							<h4 class="modal-title">
								<?= $lang['login']['footer_l'] ?>
							</h4>
							<a type="button" class="close" data-dismiss="modal">×</a>
						</div>

						<div class="modal-body">
							<div class="form-groups">
								<label class="pt-input-icon">
									<span><i class="fas fa-user"></i></span>
									<input type="text" name="reg_name" placeholder="<?= $lang['signup']['username'] ?>">
								</label>
							</div>
							<div class="form-groups">
								<label class="pt-input-icon">
									<span><i class="fas fa-key"></i></span>
									<input type="password" name="reg_pass" placeholder="<?= $lang['signup']['password'] ?>">
								</label>
							</div>
							<div class="form-groups">
								<label class="pt-input-icon">
									<span><i class="fas fa-envelope"></i></span>
									<input type="text" name="reg_email" placeholder="<?= $lang['signup']['email'] ?>">
								</label>
							</div>
							<p>
								<?= str_replace(["{link_privacy}", "{link_terms}"], ['<a href="' . privacy_link . '" target="_blank">' . $lang['home']['privacy'] . '</a>', '<a href="' . terms_link . '" target="_blank">' . $lang['home']['terms'] . '</a>'], $lang['home']['accepting']) ?>
							</p>
							<div class="pt-msg"></div>
						</div>

						<div class="modal-footer">
							<button type="submit" class="btn bg-gr">
								<?= $lang['signup']['button'] ?>
							</button>
						</div>

					</div>
				</div>
			</div>
		</form>
	<?php endif; ?>
<?php endif; ?>

<?php
include __DIR__ . "/scripts.php";
?>

</body>

</html>