<div class="pt-plans">
	<form class="pt-sendplans">
		<div class="pt-body mb-3">
				<input class="tgl tgl-light" id="cb1" value="1" name="site_plans" type="checkbox"<?=(!site_plans ? ' checked' : '')?>/>
				<label class="tgl-btn" for="cb1"></label>
				<label><?=$lang['dashboard']['pl_title']?></label>
				<div class="pt-options">
						<a href="#myModal" data-toggle="modal" class="btn bg-gy text-white"><i class="fas fa-plus"></i> <?=$lang['dashboard']['pl_create']?></a>
					</div>
		</div>
		<div class="row">
			<?php
			$sql = $db->query("SELECT * FROM ".prefix."plans");
			while($rs = $sql->fetch_assoc()):
			?>
			<div class="col">
				<div class="pt-body">
				<?php foreach ($rs as $key => $value): ?>
					<?php if(!in_array($key, ['id', 'created_at', 'surveys_rapport', 'surveys_export', 'surveys_iframe', 'show_ads', 'survey_design', 'support', 'currency'])): ?>
					<label> <?php if(in_array($key, ['surveys_month', 'surveys_steps', 'surveys_questions', 'surveys_answers'])): ?><b><?=str_replace('_',' ',$key)?></b> <?php endif;?>
						<input type="text" name="<?=$key?>[<?=$rs['id']?>]" placeholder="plan <?=$key?>" value="<?=$value?>">
					</label>
					<?php endif;?>
					<?php if(in_array($key, ['surveys_rapport', 'surveys_export', 'surveys_iframe', 'show_ads', 'survey_design', 'support'])): ?>
						<div class="mb-1">
							<input class="tgl tgl-light" id="<?=$key.$rs['id']?>" value="1"type="checkbox" name="<?=$key?>[<?=$rs['id']?>]"<?=($value==1?'checked':'')?>/>
							<label class="tgl-btn" for="<?=$key.$rs['id']?>"></label>
							<label><?=str_replace('_',' ',$key)?></label>
						</div>

					<?php endif;?>
					<?php endforeach;?>
					<a class="bg-r text-white pt-delete" data-table="plan" rel="<?php echo $rs['id'] ?>"><i class="fas fa-trash-alt"></i> <?=$lang['dashboard']['pl_delete']?></a>
				</div>
			</div>
			<?php
			endwhile;
			$sql->close();
			?>
		</div>
		<div class="pt-link">
			<button type="submit" class="fancy-button bg-gradient5">
				<span><?=$lang['dashboard']['save']?> <i class="fas fa-arrow-circle-right"></i></span>
			</button>
		</div>
	</form>
</div>


<!-- The Modal -->
<form id="pt-sendplan" class="pt-form">
<div class="modal fade newmodal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <h4 class="modal-title"><?=$lang['dashboard']['pl_create']?></h4>
        <a type="button" class="close" data-dismiss="modal">×</a>
      </div>

      <div class="modal-body">
				<div class="form-row">
					<label class="pt-lb"><input type="text" name="plan" placeholder="plan plan"></label>
					<label class="pt-lb"><input type="text" name="price" placeholder="plan price"></label>
					<label class="pt-lb"><input type="text" name="desc1" placeholder="plan desc1"></label>
					<label class="pt-lb"><input type="text" name="desc2" placeholder="plan desc2"></label>
					<label class="pt-lb"><input type="text" name="desc3" placeholder="plan desc3"></label>
					<label class="pt-lb"><input type="text" name="desc4" placeholder="plan desc4"></label>
					<label class="pt-lb"><input type="text" name="desc5" placeholder="plan desc5"></label>
					<label class="pt-lb"><input type="text" name="desc6" placeholder="plan desc6"></label>
					<label class="pt-lb"><input type="text" name="desc7" placeholder="plan desc7"></label>
					<label class="pt-lb"><input type="text" name="desc8" placeholder="plan desc8"></label>
					<label class="pt-lb"><input type="text" name="desc9" placeholder="plan desc9"></label>
				</div>
				<div class="form-row">
					<label class="pt-lbs"> <b><?=$lang['dashboard']['surveys']?></b><input type="text" name="surveys_month"></label>
					<label class="pt-lbs"> <b><?=$lang['dashboard']['pl_steps']?></b><input type="text" name="surveys_steps"></label>
					<label class="pt-lbs"> <b><?=$lang['dashboard']['questions']?></b><input type="text" name="surveys_questions"></label>
					<label class="pt-lbs"> <b><?=$lang['editor']['answers']?></b><input type="text" name="surveys_answers"></label>

					<div class="mb-1">
						<input class="tgl tgl-light" id="surveys_iframe2s" value="1" type="checkbox" name="surveys_iframe">
						<label class="tgl-btn" for="surveys_iframe2s"></label>
						<label> iframe</label>
					</div>

					<div class="mb-1">
						<input class="tgl tgl-light" id="surveys_rapport2s" value="1" type="checkbox" name="surveys_rapport">
						<label class="tgl-btn" for="surveys_rapport2s"></label>
						<label> rapport</label>
					</div>

					<div class="mb-1">
						<input class="tgl tgl-light" id="surveys_export2s" value="1" type="checkbox" name="surveys_export">
						<label class="tgl-btn" for="surveys_export2s"></label>
						<label> export</label>
					</div>

					<div class="mb-1">
						<input class="tgl tgl-light" id="survey_design2s" value="1" type="checkbox" name="survey_design">
						<label class="tgl-btn" for="survey_design2s"></label>
						<label> design</label>
					</div>

					<div class="mb-1">
						<input class="tgl tgl-light" id="show_ads2s" value="1" type="checkbox" name="show_ads">
						<label class="tgl-btn" for="show_ads2s"></label>
						<label> ads</label>
					</div>

					<div class="mb-1">
						<input class="tgl tgl-light" id="support2s" value="1" type="checkbox" name="support">
						<label class="tgl-btn" for="support2s"></label>
						<label> support</label>
					</div>

				</div>
				<div class="pt-msg"></div>
      </div>

      <div class="modal-footer">
        <button type="submit" class="btn bg-gr"><?=$lang['dashboard']['save']?></button>
      </div>

    </div>
  </div>
</div>
</form>
