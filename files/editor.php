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

if(!fh_access("survey") && !$id){
	echo "<div class='padding'>".fh_alerts($lang['alerts']['permission'], "warning")."</div>";
	include __DIR__."/footer.php";
	exit;
}

if( $id && ( !db_rows("survies WHERE id = '{$id}' && author = '".us_id."'") && us_level != 6) ){
	exit;
}


$rs = $id ? db_rs("survies WHERE id = '{$id}'") : "";
$survey_colors = isset($rs) && !empty($rs['colors']) ? json_decode($rs['colors'], true) : '' ;

$questionTypes = [];
$questionTypes["radio"]    = $lang['editor']["radio"];
$questionTypes["checkbox"] = $lang['editor']["checkbox"];
$questionTypes["input"]    = $lang['editor']["input"];
$questionTypes["text"]     = $lang['editor']["text"];
$questionTypes["dropdown"] = $lang['editor']["dropdown"];
$questionTypes["textarea"] = $lang['editor']["textarea"];
$questionTypes["image"]    = $lang['editor']["image"];
$questionTypes["rating"]   = $lang['editor']["rating"];
$questionTypes["date"]     = $lang['editor']["date"];
$questionTypes["phone"]    = $lang['editor']["phone"];
$questionTypes["country"]  = $lang['editor']["country"];
$questionTypes["email"]    = $lang['editor']["email"];
$questionTypes["break"]    = $lang['editor']["break"];
$questionTypes["scale"]    = $lang['editor']["scale"];
$questionTypes["file"]     = $lang['editor']["file"];


$questionColors = [];
$questionColors["radio"]    = "o";
$questionColors["checkbox"] = "gr";
$questionColors["input"]    = "v";
$questionColors["text"]     = "gy";
$questionColors["dropdown"] = "bl";
$questionColors["textarea"] = "or";
$questionColors["image"]    = "grr";
$questionColors["rating"]   = "pn";
$questionColors["date"]     = "vv";
$questionColors["phone"]    = "bb";
$questionColors["country"]  = "gr1";
$questionColors["email"]    = "yy";
$questionColors["break"]    = "Break";
$questionColors["scale"]    = "bro";
$questionColors["file"]     = "bro";

?>
<div class="pt-breadcrump">
  <li><a href="<?=path?>"><i class="fas fa-home"></i> <?=$lang['menu']['home']?></a></li>
	<li><?php echo ($id ? $lang['editor']["edit"] : $lang['editor']["create"] ) ?></li>
</div>

<form class="pt-surveyeditorsend">
<div class="pt-surveyeditor">

	<div class="pt-editorcontents">


		<?php
			/* ----------------------------
							SURVEY details
			 ----------------------------*/?>
			 <div class="pt-editorheader">

								 <div class="pt-editornavs">
									 <a rel="pt-editornavsurvey">Survey Details</a>
									 <a class="pt-active" rel="pt-editornavform"><?php echo $lang['editor']["form"] ?></a>
									 <a rel="pt-editornavpreview"><?php echo $lang['editor']["preview"] ?></a>
									 <a rel="pt-editornavlogics" class="relative"><?php echo $lang['editor']["logics"] ?>
										 <div class="pt-textinfo"><i class="fas fa-question" data-toggle="tooltip" data-placement="top" title="<?php echo $lang['editor']["logics_i"] ?>"></i></div>
									 </a>
									 <a rel="pt-editornavoptions"><?php echo $lang['editor']["options"] ?></a>
									 <a rel="pt-editornavdesign"><?php echo $lang['editor']["design"] ?></a>
								 </div>
							 </div>

		<div class="pt-editorbody pt-editornavsurvey">
			<div class="pt-editorheader">


				<!-- <h3><?php echo ($id ? $lang['editor']["edit"] : $lang['editor']["create"] ) ?></h3> -->
				<div class="pt-new-survey-det">

					<div class="pt-form-i">
						<span class="pt-icon"><i class="fas fa-spell-check"></i></span>
						<input type="text" name="survey_title" value="<?php echo ($id && isset($rs['title']) ? $rs['title'] : "" ) ?>" placeholder="<?php echo $lang['editor']["title"] ?>">
					</div>

					<div class="row">
						<div class="col">
							<div class="pt-form-i">
								<span class="pt-icon"><i class="fas fa-calendar"></i></span>
								<input type="text" name="survey_startdate" value="<?php echo ($id && ($rs['startdate']) ? date("m/d/Y h:i a", $rs['startdate']) : "" ) ?>" id="datepicker1" class="datepicker-here" placeholder="<?php echo $lang['editor']["sdate"] ?>">
							</div>
						</div>
						<div class="col">
							<div class="pt-form-i">
								<span class="pt-icon"><i class="far fa-calendar"></i></span>
								<input type="text" name="survey_enddate" value="<?php echo ($id && ($rs['enddate']) ? date("m/d/Y h:i a", $rs['enddate']) : "" ) ?>" id="datepicker" class="datepicker-here" placeholder="<?php echo $lang['editor']["edate"] ?>">
							</div>
						</div>
					</div>

					<div class="pt-form-i">
						<span class="pt-icon"><i class="fas fa-link"></i></span>
						<input type="text" name="survey_url" value="<?php echo ($id && ($rs['url']) ? $rs['url'] : "" ) ?>" placeholder="<?php echo $lang['editor']["url"] ?>">
						<div class="pt-textinfo">
							<i class="fas fa-question" data-toggle="tooltip" data-placement="left" title="<?php echo $lang['editor']["url_i"] ?>"></i>
						</div>
					</div>

					<div class="pt-form-i">
						<span class="pt-icon"><i class="fas fa-lock"></i></span>
						<input type="password" name="survey_password" value="<?php echo ($id && ($rs['password']) ? $rs['password'] : "" ) ?>" placeholder="<?php echo $lang['editor']["pass"] ?>">
						<div class="pt-textinfo"><i class="fas fa-question" data-toggle="tooltip" data-placement="left" title="<?php echo $lang['editor']["pass_i"] ?>"></i></div>
					</div>

					<div class="pt-radio-slide">
						<input name="survey_private" class="tgl tgl-light" id="survey_private" type="checkbox" <?php echo ($id && $rs['private']?'checked':'') ?>>
						<label class="tgl-btn" for="survey_private"></label>
						<b><?php echo $lang['editor']["private"] ?>
							<div class="pt-textinfo">
								<i class="fas fa-question-circle" data-toggle="tooltip" data-placement="right" title="<?php echo $lang['editor']["private_i"] ?>"></i>
							</div>
						</b>
					</div>

					<div class="pt-radio-slide">
						<input name="survey_pagination" class="tgl tgl-light" id="survey_pagination" type="checkbox" <?php echo ($id && $rs['pagination']?'checked':'') ?>>
						<label class="tgl-btn" for="survey_pagination"></label>
						<b><?php echo $lang['editor']["single"] ?>
							<div class="pt-textinfo"><i class="fas fa-question-circle" data-toggle="tooltip" data-placement="right" title="<?php echo $lang['editor']["single_i"] ?>"></i></div>
						</b>
					</div>

					<div class="pt-radio-slide">
						<input name="survey_byip" class="tgl tgl-light" id="survey_byip" type="checkbox" <?php echo ($id && $rs['byip']?'checked':'') ?>>
						<label class="tgl-btn" for="survey_byip"></label>
						<b><?php echo $lang['editor']["ip"] ?>
							<div class="pt-textinfo"><i class="fas fa-question-circle" data-toggle="tooltip" data-placement="right" title="<?php echo $lang['editor']["ip_i"] ?>"></i></div>
						</b>
					</div>
					<?php if (us_level == 6): ?>
					<div class="pt-radio-slide">
						<input name="survey_template" class="tgl tgl-light" id="survey_template" type="checkbox" <?php echo ($id && $rs['template']?'checked':'') ?>>
						<label class="tgl-btn" for="survey_template"></label>
						<b>Save it as a Template
							<div class="pt-textinfo"><i class="fas fa-question-circle" data-toggle="tooltip" data-placement="right" title="This is a predefined template that users can use to create surveys."></i></div>
						</b>
					</div>
					<?php endif; ?>

				</div>


			</div>
		</div>


		<?php
			/* ----------------------------
							Editor FORM
			 ----------------------------*/?>

		<div class="pt-editorbody pt-editornavform pt-active">
			<div class="pt-editorbuttons">
				<ul>
					<li><a rel="text"><span><i class="fas fa-keyboard"></i></span><b><?php echo $lang['editor']["text"] ?></b></a></li>
					<li><a rel="radio"><span><i class="fas fa-check-circle"></i></span><b><?php echo $lang['editor']["radio"] ?></b></a></li>
					<li><a rel="checkbox"><span><i class="fas fa-spell-check"></i></span><b><?php echo $lang['editor']["checkbox"] ?></b></a></li>
					<li><a rel="input"><span><i class="fas fa-font"></i></span><b><?php echo $lang['editor']["input"] ?></b></a></li>
					<li><a rel="dropdown"><span><i class="fas fa-caret-square-down"></i></span><b><?php echo $lang['editor']["dropdown"] ?></b></a></li>
					<li><a rel="textarea"><span><i class="fas fa-comment-alt"></i></span><b><?php echo $lang['editor']["textarea"] ?></b></a></li>
					<li><a rel="image"><span><i class="fas fa-image"></i></span><b><?php echo $lang['editor']["image"] ?></b></a></li>
					<li><a rel="rating"><span><i class="fas fa-star-half-alt"></i></span><b><?php echo $lang['editor']["rating"] ?></b></a></li>
					<li><a rel="date"><span><i class="fas fa-calendar"></i></span><b><?php echo $lang['editor']["date"] ?></b></a></li>
					<li><a rel="phone"><span><i class="fas fa-phone"></i></span><b><?php echo $lang['editor']["phone"] ?></b></a></li>
					<li><a rel="country"><span><i class="fas fa-globe"></i></span><b><?php echo $lang['editor']["country"] ?></b></a></li>
					<li><a rel="email"><span><i class="fas fa-at"></i></span><b><?php echo $lang['editor']["email"] ?></b></a></li>
					<li><a rel="break"><span><i class="fas fa-pager"></i></span><b><?php echo $lang['editor']["break"] ?></b></a></li>
					<li><a rel="scale"><span><i class="fas fa-columns"></i></span><b><?php echo $lang['editor']["scale"] ?></b></a></li>
					<li><a rel="file"><span><i class="fas fa-file-upload"></i></span><b><?php echo $lang['editor']["file"] ?></b></a></li>
				</ul>
			</div>
		<div class="pt-editorbody pt-droppable pt-editornavform pt-active" id="pt-drop0">
			<?php if ($id): ?>
				<?php
				$s_sql = $db->query("SELECT * FROM ".prefix."steps WHERE survey = '{$id}' ORDER BY sort ASC") or die ($db->error);
				while($s_rs = $s_sql->fetch_assoc()):
				?>

					<?php if ( $s_sql->num_rows > 1 ): ?>
					<div class="pt-new-break" rel="<?php echo $s_rs["sort"] ?>">
						<span><?php echo $lang['editor']["page"] ?> <?php echo $s_rs["sort"] ?>
							<?php if ( $s_rs["sort"] > 1 ): ?><a class="pt-badge bg-r pt-edelete pt-new-break-d" rel="<?php echo $s_rs["sort"] ?>"><i class="fas fa-trash-alt"></i></a><?php endif; ?>
						</span><input type="hidden" name="survey_steps[]" value="<?php echo $s_rs["sort"] ?>" />
					</div>
					<?php else: ?>
						<div class="pt-new-break hidden" rel="<?php echo $s_rs["sort"] ?>"><span></span><input type="hidden" name="survey_steps[]" value="<?php echo $s_rs["sort"] ?>" /></div>
					<?php endif; ?>


					<?php
					$q_sql = $db->query("SELECT * FROM ".prefix."questions WHERE survey = '{$id}' && step ='{$s_rs['sort']}' ORDER BY sort ASC") or die ($db->error);
					$a = 0;
					while($q_rs = $q_sql->fetch_assoc()):
						$a++;
						$qq_id = $q_rs['id'] ? "question_id = '{$q_rs['id']}'" : "question = '{$q_rs['sort']}'";
						$q_tp = db_get("answers", "type", $id, "survey", "&& step ='{$s_rs['sort']}' && {$qq_id}");
						$irelID = "i{$s_rs['sort']}i{$q_rs['sort']}";
						?>
						<div class="pt-new-step-content pt-question" rel="<?php echo $irelID ?>">
							<div class="relative">
								<span class="pt-badge bg-<?php echo $questionColors[$q_rs['type']] ?> pt-badge-qn"><?php echo $lang['editor']["q"] ?><?php echo $q_rs['sort'] ?>: </span>
								<span class="pt-badge bg-<?php echo $questionColors[$q_rs['type']] ?>"><?php echo $questionTypes[$q_rs['type']] ?></span>
								<div class="pt-options">
									<a class="pt-badge bg-r pt-delete" rel="<?php echo $q_rs['id'] ?>" data-table="question"><i class="fas fa-trash-alt"></i></a>
									<a class="pt-badge bg-gy '+(questionsCount == 1 ? 'pt-disabled' : '')+' pt-up" rel="<?php echo $irelID ?>"><i class="fas fa-arrow-up"></i></a>
								</div>
								<?php if ($q_rs['type'] != 'text'): ?>
								<input type="text" name="question[<?php echo $irelID ?>][question]"value="<?php echo $q_rs['title'] ?>" placeholder="<?php echo $lang['editor']["question"] ?>" />
								<?php endif; ?>
								<input type="hidden" name="question[<?php echo $irelID ?>][type]" value="<?php echo $q_rs['type'] ?>">
								<input type="hidden" name="question[<?php echo $irelID ?>][state]" value="edit">
								<input type="hidden" name="question[<?php echo $irelID ?>][id]" value="<?php echo $q_rs['id'] ?>">
							</div>

						<?php if ($q_rs['type'] != 'text'): ?>
						<div class=""><input type="text" name="question[<?php echo $irelID ?>][description]" value="<?php echo $q_rs['description'] ?>" placeholder="<?php echo $lang['editor']["desc"] ?>" /></div>
						<?php endif; ?>

						<?php if ( $q_rs['type'] == 'rating' ): ?>
							<div><input type="text" name="question[<?php echo $irelID ?>][icon]" class="my" value="<?php echo $q_rs['icon'] ?>" placeholder="<?php echo $lang['editor']["icon"] ?>" /></div>
							<div><input type="text" name="question[<?php echo $irelID ?>][rows]" value="<?php echo $q_rs['crows'] ?>" placeholder="<?php echo $lang['editor']["icons"] ?>" /></div>
						<?php endif; ?>

						<?php if ( $q_rs['type'] == 'scale' ): ?>
							<div><input type="text" name="question[<?php echo $irelID ?>][rows]" value="<?php echo ($q_rs['crows'] ? $q_rs['crows'] : 10) ?>" placeholder="Number of scales" /></div>
							<div class="row">
								<div class="col"><input type="text" name="question[<?php echo $irelID ?>][scale1]" value="<?php echo $q_rs['scale1'] ?>" placeholder="Scale 1" /></div>
								<div class="col"><input type="text" name="question[<?php echo $irelID ?>][scale2]" value="<?php echo $q_rs['scale2'] ?>" placeholder="Scale 2" /></div>
								<div class="col"><input type="text" name="question[<?php echo $irelID ?>][scale3]" value="<?php echo $q_rs['scale3'] ?>" placeholder="Scale 3" /></div>
								<div class="col"><input type="text" name="question[<?php echo $irelID ?>][scale4]" value="<?php echo $q_rs['scale4'] ?>" placeholder="Scale 4" /></div>
								<div class="col"><input type="text" name="question[<?php echo $irelID ?>][scale5]" value="<?php echo $q_rs['scale5'] ?>" placeholder="Scale 5" /></div>
							</div>
						<?php endif; ?>

						<?php if ( $q_rs['type'] == 'file' ): ?>
							<div class="pt-survey-answers pt-form-inline">
								<div class="pt-form-group">
									<b><?php echo $lang['editor']["ftype"] ?>:</b>
								</div>
								<div class="pt-form-group">
									<input type="radio" name="question[<?php echo $irelID ?>][filetype]" value="image" id="fileimage<?php echo $irelID ?>" class="choice" <?php echo ($q_rs['file'] == "image" ? 'checked' : '') ?>>
									<label for="fileimage<?php echo $irelID ?>"><?php echo $lang['editor']["image"] ?></label>
								</div>
								<div class="pt-form-group">
									<input type="radio" name="question[<?php echo $irelID ?>][filetype]" value="zip" id="filezip<?php echo $irelID ?>" class="choice" <?php echo ($q_rs['file'] == "zip" ? 'checked' : '') ?>>
									<label for="filezip<?php echo $irelID ?>"><?php echo $lang['editor']["zip"] ?></label>
								</div>
								<div class="pt-form-group">
									<input type="radio" name="question[<?php echo $irelID ?>][filetype]" value="rar" id="filerar<?php echo $irelID ?>" class="choice" <?php echo ($q_rs['file'] == "rar" ? 'checked' : '') ?>>
									<label for="filerar<?php echo $irelID ?>"><?php echo $lang['editor']["rar"] ?></label>
								</div>
							</div>
						<?php endif; ?>


						<?php if ($q_rs['type'] != 'text'): ?>
						<div class="pt-radio-slide">
							<input name="question[<?php echo $irelID ?>][status]" class="tgl tgl-light" id="cbr<?php echo $irelID ?>" type="checkbox" <?php echo ($q_rs['status'] ? 'checked' : '') ?>/>
							<label class="tgl-btn" for="cbr<?php echo $irelID ?>"></label> <?php echo $lang['editor']['new_qre'] ?>
						</div>

						<?php if ( !in_array($q_rs['type'], ['dropdown', 'rating', 'scale', 'file']) ): ?>
						<div class="pt-radio-slide">
							<input name="question[<?php echo $irelID ?>][inline]" class="tgl tgl-light" id="cbi<?php echo $irelID ?>" type="checkbox" <?php echo ($q_rs['inline'] ? 'checked' : '') ?>/>
							<label class="tgl-btn" for="cbi<?php echo $irelID ?>"></label> <?php echo $lang['editor']['new_qln'] ?>
							<?php if ($q_rs['crows']): ?>
								<input name="question[<?php echo $irelID ?>][rows]" value="<?php echo $q_rs['crows'] ?>" placeholder="<?php echo $lang['editor']["rows"] ?>" type="text">
							<?php endif; ?>
						</div>
						<?php endif; ?>
						<?php endif; ?>

						<?php if ( !in_array($q_rs['type'], ['rating', 'scale', 'file']) ): ?>
						<div class="pt-editor-answers">
							<?php if ($q_rs['type'] != 'text'): ?>
							<b><?php echo $lang['editor']["answers"] ?>
								<?php if( $q_rs['type'] != 'text' ): ?>
								<a class="pt-badge bg-bl text-white pt-addnewanswer pt-answerasimage" rel="<?php echo $irelID ?>"><i class="fas fa-plus"></i> <?php echo $lang['editor']["new"] ?></a>
								<?php endif; ?>
							</b>
							<?php endif; ?>
							<?php
								$a_sql = $db->query("SELECT * FROM ".prefix."answers WHERE survey = '{$id}' && step ='{$s_rs['sort']}' && question = '{$q_rs['sort']}' ORDER BY id ASC") or die ($db->error);
								$i=0;
								while($a_rs = $a_sql->fetch_assoc()):
									$i++;
									?>
									<div class="relative">
										<?php if( $q_rs['type'] != 'text' ): ?>
										<input type="text" name="question[<?php echo $irelID ?>][answers][<?php echo $a_rs['id'] ?>]" value="<?php echo $a_rs['title'] ?>" placeholder="<?php echo $lang['editor']["answer"] ?>" />
										<a class="pt-badge bg-r pt-delete" rel="<?php echo $a_rs['id'] ?>" data-table="answer"><i class="fas fa-trash-alt"></i></a>
										<?php else: ?>
											<textarea type="text" name="question[<?php echo $irelID ?>][answers][<?php echo $a_rs['id'] ?>]" placeholder="<?php echo $lang['editor']["answer"] ?>" id="wysibbs<?php echo $a_rs['id'] ?>"><?php echo ($a_rs['title']) ?></textarea>
											<p class="pt-pnote">
												<i class="fas fa-exclamation-circle"></i> <?php echo $lang['editor']["bbcode"] ?>
											</p>
										<?php endif; ?>
									</div>
									<?php
								endwhile;
								?>
						</div>
						<?php endif; ?>
						<?php if( $q_rs['type'] == 'image' ): ?>
							<div class="pt-images-up" rel="<?php echo $irelID ?>">
							<?php
								$a_sql = $db->query("SELECT * FROM ".prefix."answers WHERE survey = '{$id}' && step ='{$s_rs['sort']}' && question = '{$q_rs['sort']}' ORDER BY id ASC") or die ($db->error);
								$i=0;
								while($a_rs = $a_sql->fetch_assoc()):
									$i++;
									?>
									<div class="pt-image-upload" data-image="<?php echo $a_rs['id'] ?>" rel="<?php echo $irelID ?>">
										<div class="file-select">
											<div class="file-select-button" id="answerImageSel<?php echo $irelID ?>i<?php echo $a_rs['id'] ?>"><?php echo $lang['editor']["change"] ?></div>
											<input type="file" name="chooseFile" id="answerImageInp<?php echo $irelID ?>i<?php echo $a_rs['id'] ?>">
											<input type="hidden" name="question[<?php echo $irelID ?>][images][<?php echo $a_rs['id'] ?>]" rel="#answerImageInp<?php echo $irelID ?>i<?php echo $a_rs['id'] ?>" value="<?php echo $a_rs['image'] ?>">
										</div>
										<div class="pt-image-thumb" id="answerImageTmb<?php echo $irelID ?>i<?php echo $a_rs['id'] ?>"><img src="<?php echo path.'/'.$a_rs['image'] ?>" class="nophoto" /></div>
									</div>
									<?php
								endwhile;
								?>

								</div>
						<?php endif; ?>
					</div>
					<?php endwhile; ?>
				<?php endwhile; ?>

			<?php else: ?>
			<p class="pt-drageinfo"><?php echo $lang['editor']["drag"] ?></p>
			<div class="pt-new-break hidden" rel="1"><span></span><input type="hidden" name="survey_steps[]" value="1" /></div>
			<?php endif; ?>

		</div>
		</div>


		<?php
			/* ----------------------------
							Editor Preview
			 ----------------------------*/?>

		<div class="pt-editorbody pt-editornavpreview">
			<p class="pt-drageinfo"><?php echo $lang['editor']["nofound"] ?></p>
		</div>

		<?php
			/* ----------------------------
							Editor Logics
			 ----------------------------*/?>

		<div class="pt-editorbody pt-editornavlogics">
			<?php include __DIR__.'/editor/logics.php'; ?>
		</div>

		<?php
			/* ----------------------------
							Editor Options
			 ----------------------------*/?>

		<div class="pt-editorbody pt-editornavoptions">
			<?php include __DIR__.'/editor/options.php'; ?>
		</div>

		<?php
			/* ----------------------------
							Editor Options
			 ----------------------------*/?>

		<div class="pt-editorbody pt-editornavdesign">
			<?php include __DIR__.'/editor/design.php'; ?>
		</div>


		<?php
			/* ----------------------------
							Submit
			 ----------------------------*/?>

		<div class="pt-editorsubmit">
			<div class="row">
				<div class="col-6">
					<div class="pt-radio-slide text-left">
						<input name="survey_status" class="tgl tgl-light" id="survey_status" type="checkbox" <?php echo ($id && $rs['status']?'checked':'') ?>>
						<label class="tgl-btn" for="survey_status"></label>
						<b><?php echo $lang['editor']["unpublished"] ?>
							<div class="pt-textinfo"><i class="fas fa-question-circle" data-toggle="tooltip" data-placement="right" title="<?php echo $lang['editor']["unpublished_i"] ?>"></i></div>
						</b>
					</div>
				</div>
				<div class="col-6">
					<?php if ($id): ?><input type="hidden" name="survey_id" value="<?php echo $id ?>" /><?php endif; ?>
					<button type="submit" class="bg-gr"><?php echo $lang['editor']["save"] ?></button>
				</div>
			</div>
		</div>

	</div>
</div>
</form>

<!-- Dynamic Survey Styling -->

<?php
if(!empty($rs['colors'])):
$survey_colors = json_decode($rs['colors'], true);
?>
<style>
.pt-surveybg a[href="#previous"],
.pt-surveybg a[href="#finish"] {
	<?php if(isset($survey_colors['button_border_width'])): ?>border-width: <?=$survey_colors['button_border_width']?>px; <?php endif; ?>
	<?php if(isset($survey_colors['button_border_style'])): ?>border-style: <?=$survey_colors['button_border_style']?>; <?php endif; ?>
	<?php if(isset($survey_colors['button_border1_color'])): ?>border-color: <?=$survey_colors['button_border1_color']?>; <?php endif; ?>
	<?php if(!$survey_colors['bg_gradient'] && $survey_colors['bg1_color1']): ?>background: linear-gradient(to right, <?=$survey_colors['bg1_color1']?> 0%, <?=$survey_colors['bg1_color2']?> 80%, <?=$survey_colors['bg1_color2']?> 100%) ; <?php endif; ?>
	<?php if(isset($survey_colors['bg_gradient']) && isset($survey_colors['bg1_color1'])): ?>background: <?=$survey_colors['bg1_color1']?> ; <?php endif; ?>
	<?php if(isset($survey_colors['txt_color1'])): ?>color: <?=$survey_colors['txt_color1']?>; <?php endif; ?>
}
.pt-surveybg a[href="#next"] {
	<?php if(isset($survey_colors['button_border_width'])): ?>border-width: <?=$survey_colors['button_border_width']?>px; <?php endif; ?>
	<?php if(isset($survey_colors['button_border_style'])): ?>border-style: <?=$survey_colors['button_border_style']?>; <?php endif; ?>
	<?php if(isset($survey_colors['button_border2_color'])): ?>border-color: <?=$survey_colors['button_border2_color']?>; <?php endif; ?>
	<?php if(!$survey_colors['bg_gradient'] && $survey_colors['bg2_color1']): ?>background: linear-gradient(to right, <?=$survey_colors['bg2_color1']?> 0%, <?=$survey_colors['bg2_color2']?> 80%, <?=$survey_colors['bg2_color2']?> 100%) ; <?php endif; ?>
	<?php if(isset($survey_colors['bg_gradient']) && isset($survey_colors['bg2_color1'])): ?>background: <?=$survey_colors['bg2_color1']?> ; <?php endif; ?>
	<?php if(isset($survey_colors['txt_color2'])): ?>color: <?=$survey_colors['txt_color2']?>; <?php endif; ?>
}
.pt-surveybg .pt-survey.pt-newsurvey .choice + label {
	<?php if(isset($survey_colors['label_bg'])): ?>background: <?=$survey_colors['label_bg']?> ; <?php endif; ?>
}

<?php if(isset($survey_colors['survey_bg'])): ?>
.pt-surveybg {
	background: <?=$survey_colors['survey_bg']?>
}
<?php endif; ?>
<?php if(isset($survey_colors['survey_bg'])): ?>
.choice[type=checkbox]:checked + label:before {
	background-color: <?=$survey_colors['survey_bg']?>
}
.choice:checked + label:before {
    border-color: <?=$survey_colors['survey_bg']?>;
    box-shadow: 0 0 0 4px <?=$survey_colors['survey_bg']?> inset;
}
<?php endif; ?>
<?php if(isset($survey_colors['input_bg'])): ?>
.pt-surveybg input[type=text] {
	border-bottom-color: <?=$survey_colors['input_bg']?>
}
<?php endif; ?>
</style>
<?php endif; ?>

<!-- End Dynamic Survey Styling -->


<?php
include __DIR__."/footer.php";
?>
