<?php

include __DIR__ . "/head.php";

if (us_level || (!us_level && in_array($pg, ['survey', 'login-google', 'login-twitter'])) || (!us_level && in_array($pg, ['survey', 'plans', 'pages']))):
	?>

	<!-- ------------------------- HEADER NAV BAR ------------------------------------ -->

	<style>
		.pt-profile-icon {
			display: flex;
			justify-content: center;
			align-items: center;
			cursor: pointer;
		}

		.pt-profile-icon img {
			width: 50px;
			height: auto;
			border-radius: 100%;
		}

		@media (min-width: 900px) {
			.dropdown-menu.show {
				left: -75px;
			}
		}

		.dropdown-menu.show {
			box-shadow: 0 0 9px 3px #d7d7d7;
		}
	</style>


	<nav class="navbar navbar-expand-lg navbar-light bg-white m-0" style="">
		<a href="#" class="navbar-brand">
			<img src="<?= path ?>/assets/img/leadstaketime_logo.png" height="56" alt="Leads Take Time">
		</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02"
			aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarTogglerDemo02">
			<ul class="navbar-nav mr-auto mt-2 mt-lg-0">
				<li class="nav-item">
					<a class="" href="<?= path ?>">Home <span class="sr-only">(current)</span></a>
				</li>
				<?php if (site_landing && us_level != 6): ?>
					<li class="nav-item">
						<a href="<?= path ?>/index.php?pg=mysurveys">
							<?= $lang['menu']['my'] ?>
						</a>
					</li>
				<?php endif; ?>
				<li class="nav-item">
					<a class="" href="#">Contact Us</a>
				</li>
			</ul>

				<div class="navbar-nav ms-auto">
					<?php if (us_level != 6): ?>
						<div class="nav-action-button">
							<a href="./plans" class="nav-item" style="color:white !important;"><i class="far fa-gem"
									style="padding-right:10px !important;"></i>Pricing</a>
						</div>
					<?php endif; ?>

					<?php if (!us_level): ?>
						<div class="nav-action-button">
							<a href="./mysurveys" style="color:white !important;" class="nav-item">Get Started</a>
						</div>
					<?php elseif (us_level == 6): ?>
						<div class="nav-action-button">
							<a href="./dashboard.php" style="color:white !important;" class="nav-item">Admin Panel</a>
						</div>
					<?php elseif (us_level): ?>
						<div class="nav-action-button">
							<a href="./mysurveys" style="color:white !important;" class="nav-item">Dashboard</a>
						</div>
					<?php endif; ?>

				</div>
				
				<div>
					<?php if (us_level): ?>
						<?php if (in_array($pg, ['survey']) && $request == 'su'): ?>
						<?php else: ?>
							<li class="nav-item dropdown" style="list-style-type: none;">

								<ul style="list-style-type: none; padding:0; margin:0;">
									<li>
										<?php if (us_level): ?>

											<div class=" pt-profile-icon nav-link dropdown-toggle m-0" href="#" id="navbarDropdown"
												role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
												<div class="pt-thumb m-2"><img src="<?= (us_photo ? path . '/' . us_photo : nophoto) ?>"
														onerror="this.src='<?= nophoto ?>'" />
												</div>
												<div>
													<?= $lang['menu']['welcome'] ?>
													<?php if (us_level): ?>,
														<?= us_username ?> <i class="fas fa-angle-down"></i>
													<?php endif; ?>
												</div>
											</div>

											<div class="dropdown-menu" aria-labelledby="navbarDropdown">
												<?php if (us_level != 6): ?>
													<a class="dropdown-item" href="#newSurveyModal" data-toggle="modal"><i
															class="fas fa-plus"></i>
														<?= $lang['menu']['new'] ?>
													</a>
												<?php endif; ?>
												<?php if (us_level == 6): ?>
													<a class="dropdown-item" href="<?= path ?>/dashboard.php"><i class="fas fa-cogs"></i>
														<?= $lang['menu']['admin'] ?></a>
												<?php endif; ?>
												<div class="dropdown-divider"></div>
												<a class="dropdown-item" href="<?= path ?>/index.php?pg=userdetails"><i
														class="fas fa-user-cog"></i>
													<?= $lang['menu']['info'] ?>
													<span
														class="badge <?= (us_plan == '1' ? 'bg-gy' : (us_plan == '2' ? 'bg-gr' : (us_plan == '3' ? 'bg-v' : 'bg-o'))) ?>">
														<?= (us_plan ? db_get("plans", "plan", us_plan) : $lang['details']['freeplan']) ?>
													</span>
												</a>
												<div class="dropdown-divider"></div>
												<!-- <li><a href="#" class="pt-logout"><i class="fas fa-power-off"></i> <?= $lang['menu']['logout'] ?></a></li> -->

												<a class="dropdown-item pt-logout" href="#" class=""><i class="fas fa-power-off"></i>
													<?= $lang['menu']['logout'] ?></a>
											</div>

										<?php endif; ?>
									</li>
									<?php if (!us_level): ?>
										<li><a href="#loginModal" data-toggle="modal" class="pt-btn"><i class="far fa-user"></i>
												<?= $lang['menu']['signin'] ?></a>
										</li>
									<?php endif; ?>
								</ul>
							</li>
						<?php endif; ?>
					<?php endif; ?>
				</div>
		</div>
	</nav>





	<!-- The Modal -->
	<div class="modal fade newmodal" id="newSurveyModal">
		<div class="modal-dialog">
			<div class="modal-content">

				<div class="modal-header">
					<h4 class="modal-title">
						<?= $lang['editor']['create'] ?>
					</h4>
					<a type="button" class="close" data-dismiss="modal">×</a>
				</div>

				<div class="modal-body">
					<div class="row">
						<div class="col-6">
							<a href="<?= path ?>/index.php?pg=editor" class="pt-tmps"><span><i
										class="fas fa-keyboard"></i></span><b>Blank Survey</b></a>
						</div>
						<div class="col-6">
							<a rel="break" class="pt-tmps pt-tmps-click"><span><i class="fas fa-pager"></i></span><b>Choose
									a Template</b></a>
						</div>
					</div>


					<div class="pt-alltemplates">
						<h3 class="position-relative">All Templates <span class="badge badge-danger pt-tmps-click"><i
									class="fas fa-times-circle"></i></span></h3>
						<div class="pt-alltemplates-sc">
							<?php

							$sql = $db->query("SELECT * FROM " . prefix . "survies WHERE template = 1 ORDER BY id DESC LIMIT 30") or die($db->error);
							if ($sql->num_rows):
								while ($rs = $sql->fetch_assoc()):
									?>
									<div class="position-relative">
										<a class="pt-tmps-a"
											href="<?= path ?>/index.php?pg=survey&id=<?= $rs['id'] ?>&t=<?= fh_seoURL($rs['title']) ?>">
											<?= $rs['title'] ?>
										</a>
										<span class="badge badge-success pt-choose-template" rel="<?= $rs['id'] ?>"><i
												class="fas fa-check-circle"></i> Choose</span>
									</div>
									<?php
								endwhile;
							else:
								?>
								<div>
									<?= fh_alerts($lang['alerts']["no-data"], "info") ?>
								</div>
								<?php
							endif;
							$sql->close();
							?>

						</div>
					</div>
				</div>

			</div>
		</div>
	</div>

	<div class="pt-body<?= (in_array($pg, ['survey']) && $request == 'su' ? ' pt-suif' : '') ?>">
		<?php
else:
	include __DIR__ . "/login.php";
	exit;
endif;
?>