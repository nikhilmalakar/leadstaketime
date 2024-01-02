<div class="pt-body">
	<div class="pt-title">
		<h3><?=$lang['dashboard']['u_users']?></h3>
		<div class="pt-options">
				<a href="#registrationModal" data-toggle="modal" class="btn bg-gy text-white"><i class="fas fa-plus"></i> <?=$lang['dashboard']['u_create']?></a>
			</div>
	</div>
	<div class="table-responsive">
	<table class="table">
		<thead>
			<tr>
				<th scope="col"><?=$lang['dashboard']['u_status']?></th>
				<th scope="col"><?=$lang['dashboard']['u_username']?></th>
				<th scope="col" class="text-center"><?=$lang['dashboard']['surveys']?></th>
				<th scope="col" class="text-center"><?=$lang['dashboard']['u_plan']?></th>
				<th scope="col" class="text-center"><?=$lang['dashboard']['u_credits']?></th>
				<th scope="col" class="text-center"><?=$lang['dashboard']['u_last_p']?></th>
				<th scope="col" class="text-center"><?=$lang['dashboard']['u_registred']?></th>
				<th scope="col" class="text-center"><?=$lang['dashboard']['u_updated']?></th>
				<th scope="col"></th>
			</tr>
		</thead>
		<tbody>
			<?php
			$sql = $db->query("SELECT * FROM ".prefix."users ORDER BY id DESC LIMIT {$startpoint} , {$limit}") or die ($db->error);
			if($sql->num_rows):
			while($rs = $sql->fetch_assoc()):
			?>
			<tr>
				<th scope="row" class="pt-status pt-userstatus">
					<input class="tgl tgl-light" id="cb<?=$rs['id']?>" value="<?=$rs['id']?>" type="checkbox"<?=(!$rs['moderat'] ? ' checked' : '')?>/>
					<label class="tgl-btn" for="cb<?=$rs['id']?>"></label>
				</th>
				<td>
					<div class="pt-thumb">
						<img src="<?=($rs['photo'] ? $rs['photo'] : nophoto)?>" onerror="this.src='<?=nophoto?>'" />
					</div>
					<a href="#"><?=$rs['username']?></a>
				</td>
				<td class="text-center"><?=db_rows("survies WHERE author = '{$rs['id']}'")?></td>
				<td class="text-center"><span class="pt-plan-badg p<?=$rs['plan']?>"><?=($rs['plan']?db_get("plans", "plan", $rs['plan']):'--')?></span></td>
				<td class="text-center"><?=($rs['credits']?"$".$rs['credits']:'--')?></td>
				<td class="text-center"><?=($rs['lastpayment']?fh_ago($rs['lastpayment']):'--')?></td>
				<td class="text-center"><?=fh_ago($rs['date'])?></td>
				<td class="text-center"><?=($rs['updated_at']?fh_ago($rs['updated_at']):'--')?></td>
				<td class="pt-options">
					<a class="pt-options-link"><i class="fas fa-ellipsis-h"></i></a>
					<ul class="pt-drop">
						<li><a href="<?=path?>/index.php?pg=userdetails&id=<?=$rs['id']?>"><i class="far fa-edit"></i> <?=$lang['dashboard']['u_edit']?></a></li>
						<li><a class="pt-delete" data-table="user" rel="<?=$rs['id']?>"><i class="fas fa-trash-alt"></i> <?=$lang['dashboard']['u_delete']?></a></li>
					</ul>
				</td>
			</tr>
			<?php
			endwhile;
			echo '<tr><td colspan="8">'.fh_pagination("users",$limit, path."/dashboard.php?pg=users&").'</td></tr>';
			else:
				?><tr><td colspan="8"><?=fh_alerts($lang['alerts']["no-data"], "info")?></td></tr><?php
			endif;
			$sql->close();
			?>
		</tbody>
	</table>
	</div>
</div>


<!-- The Modal -->
<form id="pt-send-signup" class="pt-form">
<div class="modal fade newmodal" id="registrationModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <h4 class="modal-title"><?=$lang['dashboard']['u_create']?></h4>
        <a type="button" class="close" data-dismiss="modal">×</a>
      </div>

      <div class="modal-body">
				<label class="pt-input-icon"><span><i class="fas fa-user"></i></span>
					<input type="text" name="reg_name" placeholder="<?=$lang['dashboard']['u_username']?>">
				</label>
				<label class="pt-input-icon"><span><i class="fas fa-key"></i></span>
					<input type="password" name="reg_pass" placeholder="<?=$lang['dashboard']['u_pass']?>">
				</label>
				<label class="pt-input-icon"><span><i class="fas fa-envelope"></i></span>
					<input type="text" name="reg_email" placeholder="<?=$lang['dashboard']['u_email']?>">
				</label>
				<div class="pt-msg"></div>
      </div>

      <div class="modal-footer">
        <button type="submit" class="btn bg-gr"><?=$lang['dashboard']['save']?></button>
      </div>

    </div>
  </div>
</div>
</form>
