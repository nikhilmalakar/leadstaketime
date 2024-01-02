<div class="pt-body">
<div class="pt-title">
	<h3><?=$lang['dashboard']['p_title']?></h3>
</div>
<div class="table-responsive">
<table class="table">
	<thead>
		<tr>
			<th scope="col"><?=$lang['dashboard']['p_user']?></th>
			<th scope="col" class="text-center"><?=$lang['dashboard']['p_status']?></th>
			<th scope="col" class="text-center"><?=$lang['dashboard']['p_plan']?></th>
			<th scope="col" class="text-center"><?=$lang['dashboard']['p_amount']?></th>
			<th scope="col" class="text-center"><?=$lang['dashboard']['p_date']?></th>
			<th scope="col" class="text-center"><?=$lang['dashboard']['p_txn']?></th>
			<th scope="col"></th>
		</tr>
	</thead>
	<tbody>
		<?php
		$sql = $db->query("SELECT * FROM ".prefix."payments ORDER BY id DESC LIMIT {$startpoint} , {$limit}") or die ($db->error);
		if($sql->num_rows):
		while($rs = $sql->fetch_assoc()):
			$rs['plan'] = str_replace("Plan#", "", $rs['plan']);
		?>
		<tr>
			<th scope="row">
				<div class="pt-thumb">
					<img src="<?=db_get("users", "photo", $rs['author'])?>" title="<?=fh_user($rs['author'], false)?>" onerror="this.src='<?=nophoto?>'" />
				</div>
				<a href="#"><?=fh_user($rs['author'])?></a>
			</th>
			<td class="text-center"><?=$rs['status']?></td>
			<td class="text-center"><span class="pt-plan-badg p<?=$rs['plan']?>"><?=($rs['plan']?db_get("plans", "plan", $rs['plan']):'--')?></span></td>
			<td class="text-center">$<?=$rs['price']?></td>
			<td class="text-center"><?=fh_ago($rs['date'])?></td>
			<td class="text-center"><?=$rs['txn_id']?></td>
			<td class="pt-options">
				<a class="pt-options-link"><i class="fas fa-ellipsis-h"></i></a>
				<ul class="pt-drop">
					<li><a class="pt-delete" data-table="payment" rel="<?=$rs['id']?>"><i class="fas fa-trash-alt"></i> <?=$lang['dashboard']['delete']?></a></li>
				</ul>
			</td>
		</tr>
		<?php
		endwhile;
		echo '<tr><td colspan="8">'.fh_pagination("payments",$limit, path."/dashboard.php?pg=payments&").'</td></tr>';
		else:
			?><tr><td colspan="8"><?=fh_alerts($lang['alerts']["no-data"], "info")?></td></tr><?php
		endif;
		$sql->close();
		?>
	</tbody>
</table>
</div>
</div>
