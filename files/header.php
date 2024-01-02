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

include __DIR__."/head.php";

if(us_level || (!us_level && in_array($pg, ['survey', 'login-google', 'login-twitter'])) || (!us_level && in_array($pg, ['survey', 'plans', 'pages'])) ):
?>
<div class="pt-wrapper">
	<?php if( in_array($pg, ['survey']) && $request == 'su' ): ?>
	<?php else: ?>
	<div class="pt-header">
		<div class="pt-menu">
			<div class="pt-logo">
				<a href="<?=path?>"><img src="<?=path?>/<?=site_logo?>" onerror="this.src='<?=path?>/assets/img/logo3.png'" /></a>
			</div>
			<div class="pt-links-l">
				<span class="pt-mobile-menu"><i class="fas fa-ellipsis-h"></i></span>
				<ul class="pt-drop">
					<li><a href="<?=path?>"<?=(page=='index'&&!$pg&&$request!='all'?' class="pt-active"':'')?>><?=$lang['menu']['home']?></a></li>
					<?php if (site_landing && us_level): ?>
						<li><a href="<?=path?>/index.php?pg=mysurveys"><?=$lang['menu']['my']?></a></li>
					<?php endif; ?>
					<?php if (show_allsurveys): ?>
					<li><a href="<?=path?>/index.php?pg=mysurveys&request=all"<?=(page=='index'&&$request=='all'?' class="pt-active"':'')?>><?=$lang['menu']['forms']?></a></li>
					<?php endif; ?>
					<?php
					$sql = $db->query("SELECT * FROM ".prefix."pages WHERE header = 0 ORDER BY sort ASC");
					if($sql->num_rows):
					while($rs = $sql->fetch_assoc()):
					?>
					<li><a href="<?=path?>/index.php?pg=pages&id=<?=$rs['id']?>&t=<?=fh_seoURL($rs['title'])?>"<?=($pg&&$rs['id']==$id?' class="pt-active"':'')?>><?=$rs['title']?></a></li>
					<?php endwhile; ?>
					<?php endif; ?>
					<?php $sql->close(); ?>
				</ul>
			</div>
			<div class="pt-links-r">
				<ul>
					<?php if( site_plans ): ?>
					<li><a href="<?=path?>/index.php?pg=plans"><i class="far fa-gem"></i> <?=$lang['menu']['plans']?></a></li>
					<?php endif; ?>
					<li>
						<a href="#" class="pt-user">
							<div class="pt-thumb"><img src="<?=(us_photo ? path.'/'.us_photo : nophoto)?>" onerror="this.src='<?=nophoto?>'" /></div>
							<?=$lang['menu']['welcome']?><?php if(us_level): ?>, <?=us_username?> <i class="fas fa-angle-down"></i><?php endif; ?>
						</a>
						<?php if(us_level): ?>
						<ul class="pt-drop">
							<li><a href="#newSurveyModal" data-toggle="modal"><i class="fas fa-plus"></i> <?=$lang['menu']['new']?></a></li>
							<?php if(us_level == 6): ?>
							<li><a href="<?=path?>/dashboard.php"><i class="fas fa-cogs"></i> <?=$lang['menu']['admin']?></a></li>
							<?php endif; ?>
							<li><a href="<?=path?>/index.php?pg=userdetails"><i class="fas fa-user-cog"></i> <?=$lang['menu']['info']?>
								<span class="badge <?=( us_plan=='1' ? 'bg-gy' : ( us_plan=='2' ? 'bg-gr' : ( us_plan=='3' ? 'bg-v' : 'bg-o' )))?>">
									<?=(us_plan?db_get("plans", "plan", us_plan):$lang['details']['freeplan'])?>
								</span>
							</a></li>
							<li><a href="#" class="pt-logout"><i class="fas fa-power-off"></i> <?=$lang['menu']['logout']?></a></li>
						</ul>
						<?php endif; ?>
					</li>
					<?php if(!us_level): ?><li><a href="#loginModal" data-toggle="modal" class="pt-btn"><i class="far fa-user"></i> <?=$lang['menu']['signin']?></a></li><?php endif; ?>
				</ul>
			</div>
		</div>
		<?php if (site_ads_header && (fh_access("ads") || !us_level)): ?>
		<div class="pt-header-ads"><?=site_ads_header?></div>
		<?php else: ?>
			<div class="pt-header-ads"></div>
		<?php endif; ?>
	</div>
	<?php endif; ?>

	<!-- The Modal -->
	<div class="modal fade newmodal" id="newSurveyModal">
	  <div class="modal-dialog">
	    <div class="modal-content">

	      <div class="modal-header">
	        <h4 class="modal-title"><?=$lang['editor']['create']?></h4>
	        <a type="button" class="close" data-dismiss="modal">×</a>
	      </div>

	      <div class="modal-body">
					<div class="row">
						<div class="col-6">
							<a href="<?=path?>/index.php?pg=editor" class="pt-tmps"><span><i class="fas fa-keyboard"></i></span><b>Blank Survey</b></a>
						</div>
						<div class="col-6">
							<a rel="break" class="pt-tmps pt-tmps-click"><span><i class="fas fa-pager"></i></span><b>Choose a Template</b></a>
						</div>
					</div>


					<div class="pt-alltemplates">
						<h3 class="position-relative">All Templates <span class="badge badge-danger pt-tmps-click"><i class="fas fa-times-circle"></i></span></h3>
						<div class="pt-alltemplates-sc">
						<?php

						$sql = $db->query("SELECT * FROM ".prefix."survies WHERE template = 1 ORDER BY id DESC LIMIT 30") or die ($db->error);
						if($sql->num_rows):
						while($rs = $sql->fetch_assoc()):
							 ?>
							 	<div class="position-relative">
									<a class="pt-tmps-a" href="<?=path?>/index.php?pg=survey&id=<?=$rs['id']?>&t=<?=fh_seoURL($rs['title'])?>"><?=$rs['title']?></a>
									<span class="badge badge-success pt-choose-template" rel="<?=$rs['id']?>"><i class="fas fa-check-circle"></i> Choose</span>
								</div>
							 <?php
					 		endwhile;
					 		else:
					 			?>
					 			<div><?=fh_alerts($lang['alerts']["no-data"], "info")?></div>
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

	<div class="pt-body<?=( in_array($pg, ['survey']) && $request == 'su' ? ' pt-suif' : '') ?>">
<?php
else:
	include __DIR__."/login.php";
	exit;
endif;
?>
