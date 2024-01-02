<div class="form-group">
	<input class="tgl tgl-light" id="cb7c" value="1" name="survey_share" type="checkbox"<?php echo ($id && $rs['share']?'checked':'') ?>/>
	<label class="tgl-btn" for="cb7c"></label>
	<label><?php echo $lang['editor']["share"] ?></label>
</div>

<div class="form-group">
	<input class="tgl tgl-light" id="cb6c" value="1" name="survey_email" type="checkbox"<?php echo ($id && $rs['send_email']?'checked':'') ?>/>
	<label class="tgl-btn" for="cb6c"></label>
	<label><?php echo $lang['editor']["send_email"] ?> <i class="fas fa-question-circle" data-toggle="tooltip" data-placement="right" title="<?php echo $lang['editor']["send_email_i"] ?>"></i></label>
</div>

<div class="">
	<textarea name="survey_email_body" id="wysibb-editor3"><?php echo ($id && isset($rs['send_email_body']) ? $rs['send_email_body'] : "" ) ?></textarea>
</div>
