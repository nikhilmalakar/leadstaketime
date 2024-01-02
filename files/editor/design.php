<?php if(fh_access("design")): ?>
	<div class="row">
		<div class="col-6">
			<div class="pt-design">
				<div class="form-inline">
					<div class="form-group">
						<label for="sradio1ss"><?=$lang['editor']['design_bb']?> </label>
					</div>
					<div class="form-group">
						<label class="mr-2"><?=$lang['editor']['design_si']?> </label>
						<input type="number" value="0" min="0" max="9" name="design[button_border_width]">
					</div>
					<div class="form-group">
						<label class="mr-2 ml-2"><?=$lang['editor']['design_s']?> </label>
						<select name="design[button_border_style]">
							<option value="none">None</option>
							<option value="solid">Solid</option>
							<option value="dotted">Dotted</option>
							<option value="dashed">Dashed</option>
						</select>
					</div>
				</div>
				<div class="form-inline">
					<div class="form-group">
						<label for="sradio1ss"><?=$lang['editor']['design_bc']?> </label>
					</div>
					<div class="form-group">
						<label class="mr-2"><?=$lang['editor']['design_c']?> 1 </label>
						<input type="text" name="design[button_border1_color]" class="colorpicker-popup" value="<?=($survey_colors['button_border1_color'] ?? '')?>">
					</div>
					<div class="form-group">
						<label class="mr-2 ml-2"><?=$lang['editor']['design_c']?> 2 </label>
						<input type="text" name="design[button_border2_color]" class="colorpicker-popup" value="<?=($survey_colors['button_border2_color'] ?? '')?>">
					</div>
				</div>
				<div class="form-inline">
					<div class="form-group">
						<label for="sradio1ss"><?=$lang['editor']['design_btg']?> </label>
					</div>
					<div class="form-group">
						<div class="form-group">
							<input type="radio" name="design[bg_gradient]" id="sradio12" value="0" class="choice" <?=(isset($survey_colors['bg_gradient']) && $survey_colors['bg_gradient'] ? '' : 'checked')?>>
							<label for="sradio12" class="mr-2"><?=$lang['editor']['design_g']?></label>
						</div>
						<div class="form-group">
							<input type="radio" name="design[bg_gradient]" id="sradio22" value="1" class="choice"<?=(isset($survey_colors['bg_gradient']) && $survey_colors['bg_gradient'] ? 'checked' : '')?>>
							<label for="sradio22"><?=$lang['editor']['design_n']?></label>
						</div>
					</div>
					</div>
					<div class="form-inline">
						<div class="form-group">
							<label for="sradio1ss"><?=$lang['editor']['design_btg1']?> </label>
						</div>
						<div class="form-group">
							<label class="mr-2"><?=$lang['editor']['design_c']?> 1 </label>
							<input type="text" name="design[bg1_color1]" class="colorpicker-popup" value="<?=($survey_colors['bg1_color1'] ?? '')?>">
						</div>
						<div class="form-group">
							<label class="mr-2 ml-2"><?=$lang['editor']['design_c']?> 2 </label>
							<input type="text" name="design[bg1_color2]" class="colorpicker-popup" value="<?=($survey_colors['bg1_color2'] ?? '')?>">
						</div>
					</div>
					<div class="form-inline">
						<div class="form-group">
							<label for="sradio1ss"><?=$lang['editor']['design_btg2']?> </label>
						</div>
						<div class="form-group">
							<label class="mr-2"><?=$lang['editor']['design_c']?> 1 </label>
							<input type="text" name="design[bg2_color1]" class="colorpicker-popup" value="<?=($survey_colors['bg2_color1'] ?? '')?>">
						</div>
						<div class="form-group">
							<label class="mr-2 ml-2"><?=$lang['editor']['design_c']?> 2 </label>
							<input type="text" name="design[bg2_color2]" class="colorpicker-popup" value="<?=($survey_colors['bg2_color2'] ?? '')?>">
						</div>
					</div>
					<div class="form-inline">
						<div class="form-group">
							<label for="sradio1ss"><?=$lang['editor']['design_btc']?> </label>
						</div>
						<div class="form-group">
							<label class="mr-2"><?=$lang['editor']['design_c']?> 1 </label>
							<input type="text" name="design[txt_color1]" class="colorpicker-popup" value="<?=($survey_colors['txt_color1'] ?? '')?>">
						</div>
						<div class="form-group">
							<label class="mr-2 ml-2"><?=$lang['editor']['design_c']?> 2 </label>
							<input type="text" name="design[txt_color2]" class="colorpicker-popup" value="<?=($survey_colors['txt_color2'] ?? '')?>">
						</div>
					</div>

					<div class="form-inline">
						<div class="form-group">
							<label for="sradio1ss"><?=$lang['editor']['design_sbg']?> </label>
						</div>
						<div class="form-group">
							<input type="text" name="design[survey_bg]" class="colorpicker-popup" value="<?=($survey_colors['survey_bg'] ?? '')?>">
						</div>
					</div>
					<div class="form-inline">
						<div class="form-group">
							<label for="sradio1ss"><?=$lang['editor']['design_stbg']?> </label>
						</div>
						<div class="form-group">
							<input type="text" name="design[label_bg]" class="colorpicker-popup" value="<?=($survey_colors['label_bg'] ?? '')?>">
						</div>
					</div>
					<div class="form-inline">
						<div class="form-group">
							<label for="sradio1ss"><?=$lang['editor']['design_ibg']?> </label>
						</div>
						<div class="form-group">
							<input type="text" name="design[input_bg]" class="colorpicker-popup" value="<?=($survey_colors['input_bg'] ?? '')?>">
						</div>
					</div>


			</div>
		</div>
		<div class="col-6">
			<div class="pt-surveybg p-3">
				<div class="pt-survey pt-newsurvey w-75 mt-0 mb-0 p-3">
					<h3 data-link="s0_title">Question here</h3>
					<div class="textarea-welcome">The question lettle description</div>
					<div class="pt-survey-answers">
						<div class="pt-form-group">
							<input type="text" placeholder="Input style">
						</div>
					</div>
					<div class="pt-survey-answers">
							<div class="pt-form-group">
								<input type="radio" id="a2ss" class="choice"> <label for="a2ss">Labels style</label>
							</div>
						</div>
					<div class="pt-link">
						<a href="#previous" class="pt-btn btn-blue">Previous</a>
						<a href="#next" class="pt-btn btn-green">Next</a>
					</div>
				</div>
				<style rel="inp"></style>
				<style rel="stp"></style>
			</div>
		</div>
	</div>

<?php endif; ?>
