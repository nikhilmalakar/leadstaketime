<div class="pt-body pt-box-languages">
	<div class="pt-title">
		<h3><?=$lang['dashboard']['languages']?></h3>
	</div>

	<div class="p-4 pt-0">

	  <ul class="nav nav-tabs">
			<?php
			$sql = $db->query("SELECT * FROM ".prefix."languages") or die ($db->error);
			$i = 0;
			while ( $rs = $sql->fetch_assoc() ) {
				$i++;
				echo '<li class="nav-item"><a class="nav-link '.($rs['isdefault'] ? ' active' : '').'" data-toggle="tab" href="#'.str_replace(" ", "_", $rs['language']).'">'.$rs['language'].'</a></li>';
			}
			?>
	    <li class="nav-item"><a class="nav-link pt-newlang" href="#"><i class="fas fa-plus"></i></a></li>
	  </ul>


	  <div class="tab-content">
			<?php
			$sql2 = $db->query("SELECT * FROM ".prefix."languages ORDER BY isdefault ASC") or die ($db->error);
			while ( $rs2 = $sql2->fetch_assoc() ):
				$langs = $rs2['updated_at'] > 1644412952 ? $rs2['content'] : stripslashes($rs2['content']);
				$langs = json_decode($langs, true);
			?>
	    <div id="<?php echo str_replace(" ", "_", $rs2['language']) ?>" class="container tab-pane <?=($rs2['isdefault'] ? ' active' : '')?> pt-tab2"><br>
				<form class="pt-sendlanguage pt-form">
					<div class="row">
						<div class="col">
							<div class="form-group">
								<label><?=$lang['dashboard']['ln_title']?></label>
								<input type="text" name="lang_name" placeholder="English" value="<?php echo $rs2['language'] ?>">
							</div>
						</div>
						<div class="col">
							<div class="form-group">
								<label><?=$lang['dashboard']['ln_short']?></label>
								<input type="text" name="lang_short" placeholder="en" value="<?php echo $rs2['short'] ?>">
								<input type="hidden" name="lang_id" value="<?php echo $rs2['id'] ?>">
							</div>
						</div>
						<div class="col">
							<div class="pt-box m-0 mt-5">
								<input class="tgl tgl-light" id="cb<?php echo $rs2['id'] ?>" value="1" name="lang_default" type="checkbox"<?=($rs2['isdefault'] ? ' checked' : '')?>/>
								<label class="tgl-btn m-3" for="cb<?php echo $rs2['id'] ?>"></label>
								<label><?=$lang['dashboard']['ln_def']?></label>
								<div class="float-right"><a href="#" class="pt-delete btn btn-danger btn-sm m-2" data-table="language" rel="<?=$rs2['id']?>"><i class="fas fa-trash-alt"></i> <?=$lang['dashboard']['delete']?></a></div>
							</div>
						</div>
					</div>
					<ul class="nav nav-tabs">
						<li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#<?php echo str_replace(" ", "_", $rs2['language']) ?>_gen">General</a></li>
						<?php foreach($langs as $key => $value): if(is_array($value)): ?>
							<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#<?php echo str_replace(" ", "_", $rs2['language']) ?>_<?php echo $key ?>"><?php echo $key ?></a></li>
						<?php endif; endforeach; ?>
					</ul>
					<div class="tab-content">
						<div id="<?php echo str_replace(" ", "_", $rs2['language']) ?>_gen" class="container active tab-pane">
							<textarea name="language[a]" class="pt-nowhitespaces pt-textzebra"><?php foreach($langs as $key => $value) if(!is_array($value)) echo stripslashes($value) .'&#13' ?></textarea>
			      </div>
						<?php foreach($langs as $key => $value): if(is_array($value)): ?>
							<div id="<?php echo str_replace(" ", "_", $rs2['language']) ?>_<?php echo $key ?>" class="container tab-pane">
							<textarea name="language[<?php echo $key ?>]" class="pt-nowhitespaces pt-textzebra"><?php foreach($value as $k => $v) echo stripslashes($v) .'&#13' ?></textarea>
							</div>
						<?php endif; endforeach; ?>
					</div>
					<hr>
					<button type="submit" class="btn bg-gr pt-2 pb-2 pl-4 pr-4 text-white"><?=$lang['dashboard']['save']?></button>

				</form>
	    </div>
			<?php endwhile; ?>
	  </div>


	</div>




</div>
