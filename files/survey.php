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

include __DIR__."/header.php";

$sql = $db->query("SELECT * FROM ".prefix."survies WHERE id = '{$id}'") or die ($db->error);
if($sql->num_rows):

$rs = $sql->fetch_assoc();
if( ($rs['status'] && $rs['author'] != us_id) && us_level != 6 ):
?>
	<div class="pt-survey pt-close-s">
		<h3><?=$lang['survey']['close_h']?></h3>
		<p><?=$lang['survey']['close_p']?></p>
		<div>
			<a href="<?=path?>" class="fancy-button bg-gradient5">
				<span><?=$lang['survey']['button']?> <i class="fas fa-heart"></i></span>
			</a>
		</div>
	</div>
<?php
include __DIR__."/footer.php";
exit;
endif;

if( !isset($_SESSION["surveypasswordfor{$id}"]) ):
if( ($rs['password'] && $rs['author'] != us_id) && us_level != 6 ):
?>
	<div class="pt-survey pt-close-s">
		<h3><?=$lang['survey']['passh']?></h3>
		<p><?=$lang['survey']['passp']?></p>
		<div>
			<form class="sendsurveypassword">
				<input type="password" name="password" placeholder="<?=$lang['survey']['pass']?>">
				<input type="hidden" name="id" value="<?php echo $id ?>">
				<p></p>
				<button type="submit" class="fancy-button bg-gradient5">
					<span><?=$lang['survey']['passbtn']?> <i class="fas fa-heart"></i></span>
				</button>
			</form>
		</div>
	</div>
<?php
include __DIR__."/footer.php";
exit;
endif;
endif;

$share_url  = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'] .$_SERVER['REQUEST_URI'];

# Update Survey Views
if(!isset($_COOKIE["survey_view_{$id}"])) {
	db_update("survies", ["views" => $rs['views']+1], $id);
}
?>
<?php if ($request != 'su'): ?>
	<div class="pt-breadcrump">
	  <li><a href="<?=path?>"><i class="fas fa-home"></i> <?=$lang['menu']['home']?></a></li>
		<li><?=$rs['title']?></li>
	</div>

<?php if (us_id == $rs['author'] || us_level == 6): ?>
<div class="pt-title">
	<div class="pt-options">
		<a href="<?=path?>/index.php?pg=editor&id=<?=$rs['id']?>" class="pt-btn btn-green"><i class="fas fa-edit"></i> <?=$lang['report']['btn2']?></a>
	</div>
</div>
<?php endif; ?>

<?php endif; ?>

<form id="sendresponses">
	<input type="hidden" name="tok" value="<?php echo bin2hex(random_bytes(5)) ?>" />

	<?php if ($rs['pagination']): ?>

	<div class="pt-survey pt-newsurvey">

		<?php if ($rs['share']): ?>
		<div class="pt-sharesurvey">
			<a href="#"><i class="fas fa-share-alt"></i> <?=$lang['survey']['share']?></a>
			<ul>
				<li><a href="//www.facebook.com/sharer/sharer.php?u=<?=$share_url?>" target="_blank"><i class="fab fa-facebook"></i> <?=$lang['survey']['facebook']?></a></li>
				<li><a href="//twitter.com/home?status=<?=$share_url?> <?=$rs['title']?>" target="_blank"><i class="fab fa-twitter"></i> <?=$lang['survey']['twitter']?></a></li>
				<li><a href="mailto:?Subject=<?=$rs['title']?>&amp;Body=<?=$rs['title']?> <?=$share_url?>"><i class="far fa-envelope"></i> <?=$lang['survey']['email']?></a></li>
				<li><a href="whatsapp://send?text=<?=$share_url?>" target="_blank"><i class="fab fa-whatsapp"></i> <?=$lang['survey']['whatsapp']?></a></li>
				<li><a href="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=http%3A%2F%2Fwww.google.com%2F&choe=UTF-8" target="_blank"><i class="fab fa-whatsapp"></i> <img src="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=http%3A%2F%2Fwww.google.com%2F&choe=UTF-8" title="Link to Google.com" /></a></li>
			</ul>
		</div>
		<?php endif; ?>



		<?php
			$sql_s = $db->query("SELECT * FROM ".prefix."questions WHERE survey = '{$id}' ORDER BY id ASC") or die ($db->error);
			if($sql_s->num_rows):

				# Update Step Views
				if(!isset($_COOKIE["survey_view_{$id}_step_1"])) {
					$sql_st = $db->query("SELECT * FROM ".prefix."steps WHERE survey = '{$id}' ORDER BY id ASC") or die ($db->error);
					setcookie("survey_view_{$id}_step_1", 0, time() + (86400 * 365));
					while($rs_st = $sql_st->fetch_assoc()){
						db_update("steps", ["views" => $rs_st['views']+1], $rs_st['id']);
					}
				}

				while($rs_s = $sql_s->fetch_assoc()):
				?>
				<div class="logincactionstoquestion<?php echo (!$rs_s['hide'] ? '' : ' hidden');?>" rel="<?=$rs_s['id']?>">
					<?php if ( $rs_s['title'] ): ?><h3 class="pt-survey-head"><?=$rs_s['title']?></h3><?php endif; ?>
					<?php if ( $rs_s['description'] ): ?><p class="pt-survey-head"><?=$rs_s['description']?></p><?php endif; ?>
					<div class="pt-survey-answers<?php echo ( $rs_s['crows'] ? ' pt-form-inline pt-col'.$rs_s['crows'] : '' ) ?>"><?php echo fh_get_answer1($rs_s); ?></div>
				</div>
				<?php
				endwhile;
				?>

				<div class="pt-link">
					<button type="submit" class="fancy-button bg-gradient4 step-link" data-behave="next" data-target="steps"  data-step="<?=$id+1?>" data-survey="<?=$s?>">
						<span><?=$lang['survey']['button1']?> <i class="fas fa-check-circle"></i></span>
					</button>
				</div>

			<?php endif; ?>
	</div>

<?php else: ?>

	<div id="example-async" class="pt-survey pt-newsurvey">

		<?php if ($rs['share']): ?>
		<div class="pt-sharesurvey">
			<a href="#"><i class="fas fa-share-alt"></i> <?=$lang['survey']['share']?></a>
			<ul>
				<li><a href="//www.facebook.com/sharer/sharer.php?u=<?=$share_url?>" target="_blank"><i class="fab fa-facebook"></i> <?=$lang['survey']['facebook']?></a></li>
				<li><a href="//twitter.com/home?status=<?=$share_url?> <?=$rs['title']?>" target="_blank"><i class="fab fa-twitter"></i> <?=$lang['survey']['twitter']?></a></li>
				<li><a href="mailto:?Subject=<?=$rs['title']?>&amp;Body=<?=$rs['title']?> <?=$share_url?>"><i class="far fa-envelope"></i> <?=$lang['survey']['email']?></a></li>
				<li><a href="whatsapp://send?text=<?=$share_url?>" target="_blank"><i class="fab fa-whatsapp"></i> <?=$lang['survey']['whatsapp']?></a></li>
				<li><a href="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=<?php echo urldecode(path.'/index.php?pg=survey&id='.$rs['id'].'&t='.fh_seoURL($rs['title'])) ?>" target="_blank"><img src="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=<?php echo urldecode(path.'/s'.$rs['id'].'/'.fh_seoURL($rs['title'])) ?>" title="<?=fh_seoURL($rs['title'])?>" /></a></li>
			</ul>
		</div>
		<?php endif; ?>

		<?php
		$s_sql = $db->query("SELECT * FROM ".prefix."steps WHERE survey = '{$id}' ORDER BY sort ASC") or die ($db->error);
		while($s_rs = $s_sql->fetch_assoc()):

			# Update Step Views
			if(!isset($_COOKIE["survey_view_{$id}_step_{$s_rs['id']}"])) {
				setcookie("survey_view_{$id}_step_{$s_rs['id']}", $s_rs['id'], time() + (86400 * 365));
				db_update("steps", ["views" => $s_rs['views']+1], $s_rs['id']);
			}

			$q_sql = $db->query("SELECT * FROM ".prefix."questions WHERE survey = '{$id}' && step ='{$s_rs['sort']}' ORDER BY sort ASC") or die ($db->error);
			$a = 0;
			?>
			<h5 class="steptitle"></h5>
			<section>
			<?php
			while($rs_s = $q_sql->fetch_assoc()):
			?>
				<div class="logincactionstoquestion<?php echo (!$rs_s['hide'] ? '' : ' hidden');?>" rel="<?=$rs_s['id']?>">
					<?php if ( $rs_s['title'] ): ?><h3 class="pt-survey-head"><?=$rs_s['title']?></h3><?php endif; ?>
					<?php if ( $rs_s['description'] ): ?><p class="pt-survey-head"><?=$rs_s['description']?></p><?php endif; ?>
					<div class="pt-survey-answers<?php echo ( $rs_s['crows'] ? ' pt-form-inline pt-col'.$rs_s['crows'] : '' ) ?>">
					<?php echo fh_get_answer1($rs_s); ?>
					</div>
				</div>
			<?php
			endwhile;
			$q_sql->close();
			?>
			</section>
		<?php
		endwhile;
		$s_sql->close();
		?>
	</div>

<?php endif; ?>

</form>

<!-- Dynamic Survey Styling -->

<?php
if(!empty($rs['colors'])):
$survey_colors = json_decode($rs['colors'], true);
?>
<style>
#example-async .actions ul li a[href="#previous"],
#example-async .actions ul li a[href="#finish"] {
	<?php if(isset($survey_colors['button_border_width'])): ?>border-width: <?=$survey_colors['button_border_width']?>px; <?php endif; ?>
	<?php if(isset($survey_colors['button_border_style'])): ?>border-style: <?=$survey_colors['button_border_style']?>; <?php endif; ?>
	<?php if(isset($survey_colors['button_border1_color'])): ?>border-color: <?=$survey_colors['button_border1_color']?>; <?php endif; ?>
	<?php if(!$survey_colors['bg_gradient'] && $survey_colors['bg1_color1']): ?>background: linear-gradient(to right, <?=$survey_colors['bg1_color1']?> 0%, <?=$survey_colors['bg1_color2']?> 80%, <?=$survey_colors['bg1_color2']?> 100%) !important; <?php endif; ?>
	<?php if(isset($survey_colors['bg_gradient']) && isset($survey_colors['bg1_color1'])): ?>background: <?=$survey_colors['bg1_color1']?> !important; <?php endif; ?>
	<?php if(isset($survey_colors['txt_color1'])): ?>color: <?=$survey_colors['txt_color1']?>; <?php endif; ?>
}
#example-async .actions ul li a[href="#next"] {
	<?php if(isset($survey_colors['button_border_width'])): ?>border-width: <?=$survey_colors['button_border_width']?>px; <?php endif; ?>
	<?php if(isset($survey_colors['button_border_style'])): ?>border-style: <?=$survey_colors['button_border_style']?>; <?php endif; ?>
	<?php if(isset($survey_colors['button_border2_color'])): ?>border-color: <?=$survey_colors['button_border2_color']?>; <?php endif; ?>
	<?php if(!$survey_colors['bg_gradient'] && $survey_colors['bg2_color1']): ?>background: linear-gradient(to right, <?=$survey_colors['bg2_color1']?> 0%, <?=$survey_colors['bg2_color2']?> 80%, <?=$survey_colors['bg2_color2']?> 100%) !important; <?php endif; ?>
	<?php if(isset($survey_colors['bg_gradient']) && isset($survey_colors['bg2_color1'])): ?>background: <?=$survey_colors['bg2_color1']?> !important; <?php endif; ?>
	<?php if(isset($survey_colors['txt_color2'])): ?>color: <?=$survey_colors['txt_color2']?>; <?php endif; ?>
}
.pt-likertscale .rating-group label, .pt-survey.pt-newsurvey .choice + label {
	<?php if(isset($survey_colors['label_bg'])): ?>background: <?=$survey_colors['label_bg']?>; <?php endif; ?>
}
.pt-likertscale .rating-group {
		<?php if(isset($survey_colors['label_bg'])): ?>border-color: <?=$survey_colors['survey_bg']?>; <?php endif; ?>
}
.step-link:before {
	<?php if(!$rs['bg_gradient'] && $rs['bg_color1']): ?>background: linear-gradient(to right, <?=$rs['bg_color1']?> 0%, <?=$rs['bg_color2']?> 80%, <?=$rs['bg_color2']?> 100%); <?php endif; ?>
	<?php if($rs['bg_gradient'] && $rs['bg_color1']): ?>background: <?=$rs['bg_color1']?>; <?php endif; ?>
}
<?php if($request == "su" && $survey_colors['survey_bg']): ?>
body.pt-nouser {
	background: <?=$survey_colors['survey_bg']?>
}
<?php endif; ?>
<?php if(isset($survey_colors['survey_bg'])): ?>
.pt-surveypage .pt-body .pt-dots a.active,
.pt-surveypage .pt-body .pt-dots.pt-lines a span,
.bootstrap-select .dropdown-menu.inner li.selected.active a {
	background: <?=$survey_colors['survey_bg']?>
}
.pt-surveypage .pt-body .pt-dots.pt-lines a span:before {
	border-left-color: <?=$survey_colors['survey_bg']?>
}
.choice[type=checkbox]:checked + label:before {
	background-color: <?=$survey_colors['survey_bg']?>
}
.choice:checked + label:before {
    border-color: <?=$survey_colors['survey_bg']?>;
    box-shadow: 0 0 0 4px <?=$survey_colors['survey_bg']?> inset;
}
<?php endif; ?>
<?php if(isset($survey_colors['input_bg'])): ?>
input[type=text],
input[type=password],
input[type=phone],
input[type=email],
input[type=number],
select, textarea, .bootstrap-select .btn {
	border-bottom-color: <?=$survey_colors['input_bg']?>
}
<?php endif; ?>
</style>
<?php endif; ?>

<!-- End Dynamic Survey Styling -->

<?php
else:
echo "<div class='padding'>".fh_alerts($lang['alerts']['wrong'], "danger", path)."</div>";
endif;
$sql->close();

include __DIR__."/footer.php";
?>
