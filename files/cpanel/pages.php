<div class="pt-body">
	<div class="pt-title">
		<h3><?=$lang['dashboard']['pg_title']?></h3>
		<div class="pt-options">
			<a href="<?=path?>/dashboard.php?pg=pages&request=new" class="pt-btn"><i class="fas fa-plus"></i> <?=$lang['dashboard']['pcreate']?></a>
		</div>
	</div>
	<?php if ($request != 'new'): ?>
	<div class="table-responsive">
		<table class="table">
			<thead>
				<th><?=$lang['dashboard']['ptitle']?></th>
				<th class="text-center"><?=$lang['dashboard']['ptheader']?></th>
				<th class="text-center"><?=$lang['dashboard']['ptfooter']?></th>
				<th class="text-center"><?=$lang['created']?></th>
				<th class="text-center"><?=$lang['updated']?></th>
				<th></th>
			</thead>
			<tbody>
				<?php
				$sql = $db->query("SELECT * FROM ".prefix."pages ORDER BY sort ASC");
				if($sql->num_rows):
				while($rs = $sql->fetch_assoc()):
				?>
				<tr>
					<td width="40%">
						<a href="<?=path?>/index.php?pg=pages&id=<?=$rs['id']?>&t=<?=fh_seoURL($rs['title'])?>"><b><?=$rs['title']?></b></a>
					</td>
					<td class="text-center"><?=($rs['header']?'<b class="pt-plan-badg p2">No</b>':'<b class="pt-plan-badg p1">Yes</b>')?></td>
					<td class="text-center"><?=($rs['footer']?'<b class="pt-plan-badg p2">No</b>':'<b class="pt-plan-badg p1">Yes</b>')?></td>
					<td class="text-center"><?=fh_ago($rs['created_at'])?></td>
					<td class="text-center"><?=($rs['updated_at']?fh_ago($rs['updated_at']):'--')?></td>
					<td class="pt-options">
						<a class="pt-options-link"><i class="fas fa-ellipsis-h"></i></a>
						<ul class="pt-drop">
							<li><a href="<?=path?>/dashboard.php?pg=pages&request=new&id=<?=$rs['id']?>"><i class="far fa-edit"></i> <?=$lang['dashboard']['edit']?></a></li>
							<li><a class="pt-delete" data-table="page" rel="<?=$rs['id']?>"><i class="fas fa-trash-alt"></i> <?=$lang['dashboard']['delete']?></a></li>
						</ul>
					</td>
				</tr>
				<?php endwhile; ?>
				<?php else: ?>
					<tr>
						<td colspan="7" class="text-center"><?=$lang['alerts']['no-data']?></td>
					</tr>
				<?php endif; ?>
				<?php $sql->close(); ?>
			</tbody>
		</table>
	</div>
<?php else: ?>

<?php $rs = ($id ? db_rs("pages WHERE id = '{$id}'") : ''); ?>
<div class="p-4">
<form id="sendpage">
	<div class="form-group">
		<label><?=$lang['dashboard']['ptitle']?> <small class="text-danger">*</small></label>
		<input type="text" name="pg_title" placeholder="<?=$lang['dashboard']['ptitle']?>" value="<?=($rs?$rs['title']:'')?>">
	</div>

	<div class="form-group">
		<label><?=$lang['dashboard']['psort']?></label>
		<input type="text" name="pg_sort" placeholder="<?=$lang['dashboard']['psort']?>" value="<?=($rs?$rs['sort']:'')?>">
	</div>

	<div class="form-group">
		<input class="tgl tgl-light" id="cb2" value="1" name="footer" type="checkbox"<?=($rs?($rs['footer'] ? ' checked' : ''):'')?>/>
		<label class="tgl-btn" for="cb2"></label>
		<label><?=$lang['dashboard']['pfooter']?></label>
	</div>

	<div class="form-group">
		<input class="tgl tgl-light" id="cb3" value="1" name="header" type="checkbox"<?=($rs?($rs['header'] ? ' checked' : ''):'')?>/>
		<label class="tgl-btn" for="cb3"></label>
		<label><?=$lang['dashboard']['pheader']?></label>
	</div>

	<div class="form-group">
		<label><?=$lang['dashboard']['pcontent']?> <small class="text-danger">*</small></label>
		<textarea name="pg_content" class="wysibb-editor" id="wysibb-editor"><?=($rs?$rs['content']:'')?></textarea>
	</div>

	<hr>
	<button type="submit" class="pt-btn"><?=$lang['dashboard']['save']?></button>
	<input type="hidden" name="id" value="<?=$id?>">
</form>
</div>

<?php endif; ?>
</div>
