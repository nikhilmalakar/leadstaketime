<div class="pt-editorloginitem">

	<div class="pt-editorloginitemcol">
		<select class="selectpicker" name="action">
			<?php foreach ($logic_actions as $k => $v): ?>
				<option value="<?php echo $k ?>"><?php echo $v ?></option>
			<?php endforeach; ?>
		</select>
	</div>

	<div class="pt-editorloginitemcol">
		<select class="selectpicker" name="question1" title="<?php echo $lang['editor']["qchoose"] ?>">
			<?php
			$q_sql = $db->query("SELECT * FROM ".prefix."questions WHERE survey = '{$id}'ORDER BY sort ASC") or die ($db->error);
			$a = 0;
			while($q_rs = $q_sql->fetch_assoc()):
				$a++;
				?>
			<option value="<?php echo $q_rs['id'] ?>" <?php echo ($a==1?'disabled':'') ?>><?php echo $lang['editor']["q"] ?><?php echo $a ?>: <?php echo $q_rs['title'] ?></option>
			<?php
			endwhile;
			$q_sql->close();
			?>
		</select>
	</div>

	<div class="pt-editorloginitemcol">
		<button type="button" class="pt-btn bg-bl pt-sendlogics"><i class="fas fa-plus"></i> <?php echo $lang['editor']["add"] ?></button>
	</div>

	<div class="pt-editorloginitemcol">
		<select class="selectpicker" name="condition1">
			<?php foreach ($logic_condition1 as $k => $v): ?>
				<option value="<?php echo $k ?>"><?php echo $v ?></option>
			<?php endforeach; ?>
		</select>
	</div>

	<div class="pt-editorloginitemcol">
		<select class="selectpicker pt-getanswerstarget" name="question2" title="<?php echo $lang['editor']["qchoose"] ?>">
			<?php
			$q_sql = $db->query("SELECT * FROM ".prefix."questions WHERE survey = '{$id}'ORDER BY sort ASC") or die ($db->error);
			$a = 0;
			while($q_rs = $q_sql->fetch_assoc()):
				$a++;
			?>
			<option value="<?php echo $q_rs['id'] ?>"<?php echo ( in_array($q_rs['type'], ['date', 'email', 'file', 'phone', 'country']) ?'disabled':'') ?>><?php echo $lang['editor']["q"] ?><?php echo $a ?>: <?php echo $q_rs['title'] ?></option>
			<?php
			endwhile;
			$q_sql->close();
			?>
		</select>
	</div>

	<div class="pt-editorloginitemcol">
		<select class="selectpicker" name="condition2">
			<?php foreach ($logic_condition2 as $k => $v): ?>
				<option value="<?php echo $k ?>"><?php echo $v ?></option>
			<?php endforeach; ?>
		</select>
	</div>

	<div class="pt-editorloginitemcol pt-getanswerscontent">
		<select class="selectpicker" name="answer"></select>
	</div>


</div>

<?php if ( db_rows("logics WHERE survey = '{$id}'") ): ?>
	<?php
	$q_sql = $db->query("SELECT * FROM ".prefix."logics WHERE survey = '{$id}' ORDER BY id ASC") or die ($db->error);
	while($q_rs = $q_sql->fetch_assoc()):
	?>
	<div class="pt-editorloginitem mt-1">
		<div class="pt-logicsoptions">
			<span><?php echo $logic_actions[$q_rs['action']] ?></span>
			<span><?php echo $lang['editor']["q"] ?><?php echo db_get("questions", "sort", $q_rs['question1']) ?>: <em><?php echo db_get("questions", "title", $q_rs['question1']) ?></em></span>
			<span><?php echo $logic_condition1[$q_rs['condition1']] ?></span>
			<span><?php echo $lang['editor']["q"] ?><?php echo db_get("questions", "sort", $q_rs['question2']) ?>: <em><?php echo db_get("questions", "title", $q_rs['question2']) ?></em></span>
			<span><?php echo $logic_condition2[$q_rs['condition2']] ?></span>
			<span><em><?php echo (db_get("answers", "title", $q_rs['answer']) ? db_get("answers", "title", $q_rs['answer']) : $q_rs['answer'] ) ?></em></span>
			<span class="bg-r text-white pt-delete" data-table="logic" rel="<?php echo $q_rs['id'] ?>"><i class="fas fa-trash-alt"></i></span>
		</div>
	</div>
	<?php
	endwhile;
	$q_sql->close();
	?>

<?php endif; ?>
