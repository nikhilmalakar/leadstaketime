<div class="pt-body">
<div class="pt-title">
	<h3><?=$lang['dashboard']['surveys']?></h3>
	<div class="pt-options">
		<a href="<?=path?>/index.php?pg=editor" class="pt-btn"><?=$lang['mysurvys']['create']?></a>
	</div>
</div>
<div class="table-responsive">
	<table class="table">
		<thead>
			<tr>
				<th scope="col"><?=$lang['mysurvys']['status']?></th>
				<th scope="col"><?=$lang['mysurvys']['name']?></th>
				<th scope="col"><?=$lang['mysurvys']['views']?></th>
				<th scope="col"><?=$lang['mysurvys']['responses']?></th>
				<th scope="col"><?=$lang['mysurvys']['rate']?></th>
				<th scope="col"><?=$lang['mysurvys']['created']?></th>
				<th scope="col"><?=$lang['mysurvys']['last_r']?></th>
				<th scope="col"></th>
			</tr>
		</thead>
		<tbody>
			<?php
			$sql = $db->query("SELECT * FROM ".prefix."survies ORDER BY id DESC LIMIT {$startpoint} , {$limit}") or die ($db->error);
			if($sql->num_rows):
			while($rs = $sql->fetch_assoc()):
				$firststep = db_get("steps", "views", $rs['id'], "survey", "ORDER BY id ASC LIMIT 1");
				$laststep  = db_get("steps", "views", $rs['id'], "survey", "ORDER BY id DESC LIMIT 1");
				$pourcent  = $firststep ? ceil(($laststep/$firststep)*100) : '--';
				$lastresp  = db_get("responses", "date", $rs['id'], "survey", "ORDER BY id DESC LIMIT 1");
			?>
			<tr>
				<th scope="row" class="pt-status">
					<input class="tgl tgl-light" id="cb<?=$rs['id']?>" value="<?=$rs['id']?>" type="checkbox"<?=(!$rs['status'] ? ' checked' : '')?>/>
					<label class="tgl-btn" for="cb<?=$rs['id']?>"></label>
				</th>
				<td>
					<div class="media">
						<div class="media-left">
							<div class="pt-thumb"><img src="<?=db_get("users", "photo", $rs['author'])?>" onerror="this.src='<?=nophoto?>'" title="<?=fh_user($rs['author'], false)?>" /></div>
						</div>
						<div class="media-body">
							<a href="<?=path?>/index.php?pg=survey&id=<?=$rs['id']?>"><?=$rs['title']?></a>
						</div>
					</div>
				</td>
				<td><?=$rs['views']?></td>
				<td><?=db_rows("responses WHERE survey = '{$rs['id']}' GROUP BY ip ORDER BY MAX(id) DESC", "ip")?></td>
				<td class="pt-progress">
					<span><?=$pourcent?>%</span>
					<span class="pt-progress-line"><span style="width: <?=str_replace('--', '0', $pourcent)?>%"></span></span>
				</td>
				<td><?=fh_ago($rs['date'])?></td>
				<td><?=($lastresp?fh_ago($lastresp):'--')?></td>
				<td class="pt-options">
					<a class="pt-options-link"><i class="fas fa-ellipsis-h"></i></a>
					<ul class="pt-drop">
						<li><a href="<?=path?>/index.php?pg=survey&id=<?=$rs['id']?>&request=su"><i class="fas fa-eye"></i> <?=$lang['mysurvys']['op_view']?></a></li>
						<li><a href="<?=path?>/index.php?pg=report&id=<?=$rs['id']?>"><i class="fas fa-poll"></i> <?=$lang['mysurvys']['op_stats']?></a></li>
						<?php if(fh_access("iframe")): ?>
						<li><a data-toggle="modal" href="#embedModal<?=$rs['id']?>"><i class="fas fa-share-square"></i> <?=$lang['mysurvys']['op_embed']?></a></li>
						<?php endif; ?>
						<li><a href="<?=path?>/index.php?pg=responses&id=<?=$rs['id']?>"><i class="far fa-address-card"></i> <?=$lang['mysurvys']['op_resp']?></a></li>
						<li><a href="#sendModal" rel="<?=$rs['id']?>" data-toggle="modal" class="sendtoemail"><i class="far fa-envelope"></i> <?=$lang['mysurvys']['op_send']?></a></li>
						<li><a href="<?=path?>/index.php?pg=editor&id=<?=$rs['id']?>"><i class="far fa-edit"></i> <?=$lang['mysurvys']['op_edit']?></a></li>
						<li><a class="pt-delete" data-table="survey" rel="<?=$rs['id']?>"><i class="fas fa-trash-alt"></i> <?=$lang['mysurvys']['op_delete']?></a></li>
					</ul>
					<?php if(fh_access("iframe")): ?>
					<div class="modal fade" id="embedModal<?=$rs['id']?>">
						<div class="modal-dialog"><div class="modal-content"><div class="modal-body"><pre class="radius">&lt;iframe src=&quot;<?=path?>/index.php?pg=survey&id=<?=$rs['id']?>&request=su&quot; style=&quot;width: 460px;height:315px&quot; frameborder=&quot;0&quot;&gt;&lt;/iframe&gt;</pre></div></div></div>
					</div>
					<?php endif; ?>
				</td>
			</tr>
			<?php
			endwhile;
			echo '<tr><td colspan="8">'.fh_pagination("survies",$limit, path."/dashboard.php?pg=surveys&").'</td></tr>';
			else:
				?>
				<tr>
					<td colspan="8">
						<?=fh_alerts($lang['alerts']["no-data"], "info")?>
					</td>
				</tr>
				<?php
			endif;
			$sql->close();
			?>
		</tbody>
	</table>
</div>
</div>

<div class="modal fade" id="sendModal">
<div class="modal-dialog">
	<div class="modal-content">
		<form class="pt-sendsurveyemail">
		<div class="modal-header">
			<h4 class="modal-title"><?=$lang['mysurvys']['op_send']?></h4>
			<button type="button" class="close" data-dismiss="modal">&times;</button>
		</div>

		<div class="modal-body">
			<div class="mb-3">
				<input type="text" name="subject" value="" placeholder="Subject">
			</div>
			<div class="mb-3">
				<select name="email[]" class="js-example-tokenizer" multiple="multiple">
					<?php
					$sqls = $db->query("SELECT * FROM ".prefix."users");
					while($rss = $sqls->fetch_assoc()):
					?>
					<option value="<?=$rss['email']?>"><?=$rss['email']?></option>
					<?php
					endwhile;
					$sqls->close();
					?>
				</select>
			</div>
			<div class="">
				<textarea name="message" id="wysibb-editor3"><?php echo site_sendsurveyemail ?></textarea>
			</div>
		</div>

		<!-- Modal footer -->
		<div class="modal-footer">
			<input type="hidden" name="id" value="">
			<button type="submit" class="btn btn-danger"><?=$lang['mysurvys']['op_send']?></button>
		</div>

		</form>

	</div>
</div>
</div>
