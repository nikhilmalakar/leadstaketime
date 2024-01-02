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

$s_where = ($request == 'all' ? "private = 0" : "author = '".us_id."'");
$s_title = ($request == 'all' ? $lang['mysurvys']['alltitle'] : $lang['mysurvys']['title']);
?>

<div class="pt-title">
	<h3><?=$s_title?></h3>
	<div class="pt-options">
		<a href="<?=path?>/index.php?pg=editor" class="pt-btn"><?=$lang['mysurvys']['create']?></a>
	</div>
</div>

<table class="table table-responsive">
	<thead>
		<tr>
			<th scope="col"><?=($request != 'all' ? $lang['mysurvys']['status'] : '')?></th>
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
		$sql = $db->query("SELECT * FROM ".prefix."survies WHERE {$s_where} ORDER BY id DESC LIMIT {$startpoint} , {$limit}") or die ($db->error);
		if($sql->num_rows):
		while($rs = $sql->fetch_assoc()):
			$firststep = db_get("steps", "views", $rs['id'], "survey", "ORDER BY id ASC LIMIT 1");
			$laststep  = db_get("steps", "views", $rs['id'], "survey", "ORDER BY id DESC LIMIT 1");
			$lastresp  = db_get("responses", "date", $rs['id'], "survey", "ORDER BY id DESC LIMIT 1");
			$pourcent  = $firststep ? ceil(($laststep/$firststep)*100) : '0';
			$pourcent  = $rs['views'] ? ceil((db_rows("responses WHERE survey = '{$rs['id']}' GROUP BY token_id", "token_id")/$rs['views'])*100) : '0';
			$userphoto = db_get("users", "photo", $rs['author']);
		?>
		<tr>
			<?php if($request != 'all'): ?>
			<th scope="row" class="pt-status">
				<input class="tgl tgl-light" id="cb<?=$rs['id']?>" value="<?=$rs['id']?>" type="checkbox"<?=(!$rs['status'] ? ' checked' : '')?>/>
				<label class="tgl-btn" for="cb<?=$rs['id']?>"></label>
			</th>
			<?php else: ?>
			<th scope="row" class="pt-thumbth">
				<div class="pt-thumb">
					<img src="<?=($userphoto?$userphoto:nophoto)?>" title="<?=fh_user($rs['author'], false)?>" onerror="this.src='<?=nophoto?>'" />
				</div>
			</th>
			<?php endif; ?>
			<td><a href="<?=path?>/index.php?pg=survey&id=<?=$rs['id']?>&t=<?=fh_seoURL($rs['title'])?>"><?=$rs['title']?></a></td>
			<td><?=$rs['views']?></td>
			<td><?=db_rows("responses WHERE survey = '{$rs['id']}' GROUP BY token_id", "token_id")?></td>
			<td class="pt-progress">
				<span><?=$pourcent?>%</span>
				<span class="pt-progress-line"><span style="width: <?=$pourcent?>%"></span></span>
			</td>
			<td><?=fh_ago($rs['date'])?></td>
			<td><?=($lastresp?fh_ago($lastresp):'--')?></td>
			<td class="pt-options">
				<a class="pt-options-link"><i class="fas fa-ellipsis-h"></i></a>
				<ul class="pt-drop">
					<li><a href="<?=path?>/index.php?pg=survey&id=<?=$rs['id']?>&t=<?=fh_seoURL($rs['title'])?>&request=su"><i class="fas fa-eye"></i> <?=$lang['mysurvys']['op_view']?></a></li>
					<?php if($request != 'all'): ?>
					<li><a href="<?=path?>/index.php?pg=report&id=<?=$rs['id']?>"><i class="fas fa-poll"></i> <?=$lang['mysurvys']['op_stats']?></a></li>
					<li><a href="<?=path?>/index.php?pg=responses&id=<?=$rs['id']?>"><i class="far fa-address-card"></i> <?=$lang['mysurvys']['op_resp']?></a></li>
					<?php if(fh_access("iframe")): ?>
					<li><a data-toggle="modal" href="#embedModal<?=$rs['id']?>"><i class="fas fa-share-square"></i> <?=$lang['mysurvys']['op_embed']?></a></li>
					<?php endif; ?>
					<li><a href="#sendModal" rel="<?=$rs['id']?>" data-toggle="modal" class="sendtoemail"><i class="far fa-envelope"></i> <?=$lang['mysurvys']['op_send']?></a></li>
					<li><a href="<?=path?>/index.php?pg=editor&id=<?=$rs['id']?>"><i class="far fa-edit"></i> <?=$lang['mysurvys']['op_edit']?></a></li>
					<li><a class="pt-delete" data-table="survey" rel="<?=$rs['id']?>"><i class="fas fa-trash-alt"></i> <?=$lang['mysurvys']['op_delete']?></a></li>
					<?php endif; ?>
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
		echo '<tr><td colspan="8">'.fh_pagination("survies WHERE {$s_where}",$limit, path.($request=='all'?"/".(site_landing?'mysurvies':'index').".php?request=all&":"/".(site_landing?'mysurvies':'index').".php?")).'</td></tr>';
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
					<input type="text" name="subject" value="" placeholder="<?=$lang['mysurvys']['subject']?>">
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

			<div class="modal-footer">
				<input type="hidden" name="id" value="">
				<button type="submit" class="btn btn-danger"><?=$lang['mysurvys']['op_send']?></button>
			</div>

			</form>

		</div>
	</div>
</div>

<?php
include __DIR__."/footer.php";
?>
