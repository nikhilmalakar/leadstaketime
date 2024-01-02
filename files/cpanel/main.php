<div class="row">
	<div class="col-6">
		<div class="pt-charts">
			<div class="pt-adminstatslinks pt-adminlines">
				<a href="#daily" rel="1"><?=$lang['report']['days']?></a>
				<a href="#monthly" rel="1"><?=$lang['report']['months']?></a>
			</div>
			<div class="pt-adminstats">
				<canvas id="line-chart" width="800" height="450"></canvas>
			</div>
		</div>
	</div>
	<div class="col-6">
		<div class="pt-charts">
			<div class="pt-adminstatslinks pt-adminbars">
				<a href="#daily" rel="1"><?=$lang['report']['days']?></a>
				<a href="#monthly" rel="1"><?=$lang['report']['months']?></a>
			</div>
			<div class="pt-adminstats">
				<canvas id="bar-chart" width="800" height="450"></canvas>
			</div>

		</div>
	</div>
</div>
<div class="row">
	<div class="col">
		<div class="pt-admin-box">
			<h5><i class="far fa-user"></i> <?=$lang['dashboard']['new_u']?></h5>
			<div class="pt-content pt-scroll">
				<ul>
					<?php
					$sql = $db->query("SELECT * FROM ".prefix."users WHERE date >= '".(time() - 3600*24)."' ORDER BY id DESC") or die ($db->error);
					if($sql->num_rows):
					while($rs = $sql->fetch_assoc()):
					?>
					<li>
						<div class="media">
							<div class="media-left">
								<div class="pt-thumb"><img src="<?=$rs['photo']?>" onerror="this.src='<?=nophoto?>'" /></div>
							</div>
							<div class="media-body">
								<?=fh_user($rs['id'])?>
								<p>
									<span><i class="far fa-clock"></i> <?=fh_ago($rs['date'])?></span>
									<span><i class="fas fa-poll"></i> <?=db_rows("survies WHERE author = '{$rs['id']}'")?> <?=$lang['dashboard']['surveys']?></span>
								</p>
							</div>
						</div>
					</li>
					<?php
					endwhile;
					else:
						echo '<li>'.fh_alerts($lang['alerts']['no-data'], "info").'</li>';
					endif;
					$sql->close();
					?>
				</ul>
			</div>
		</div>
	</div>
	<div class="col">
		<div class="pt-admin-box">
			<h5><i class="fas fa-money-bill-wave"></i> <?=$lang['dashboard']['new_p']?></h5>
			<div class="pt-content">
				<ul>
					<?php
					$sql = $db->query("SELECT * FROM ".prefix."payments WHERE date >= '".(time() - 3600*24)."' ORDER BY id DESC") or die ($db->error);
					if($sql->num_rows):
					while($rs = $sql->fetch_assoc()):
					?>
					<li>
						<div class="media">
							<div class="media-left">
								<div class="pt-thumb"><img src="<?=db_get("users", "photo", $rs['author'])?>" onerror="this.src='<?=nophoto?>'" /></div>
							</div>
							<div class="media-body">
								<?=fh_user($rs['author'])?>
								<p>
									<span><i class="far fa-clock"></i> <?=fh_ago($rs['date'])?></span>
									<span class="pt-plan-badg <?=( $rs['plan']=='Plan#1' ? 'p1' : ( $rs['plan']=='Plan#2' ? 'p2' : ( $rs['plan']=='Plan#3' ? 'p3' : '')))?>">
										<?=$rs['plan']?>
									</span>
									<span><i class="fas fa-comment-dollar"></i> $<?=$rs['price']?></span>
								</p>
							</div>
						</div>
					</li>
					<?php
					endwhile;
					else:
						echo '<li>'.fh_alerts($lang['alerts']['no-data'], "info").'</li>';
					endif;
					$sql->close();
					?>
				</ul>
			</div>
		</div>
	</div>
	<div class="col">
		<div class="pt-admin-box">
			<h5><i class="fas fa-poll"></i> <?=$lang['dashboard']['new_s']?></h5>
			<div class="pt-content pt-scroll">
				<ul>
					<?php
					$sql = $db->query("SELECT * FROM ".prefix."survies WHERE date >= '".(time() - 3600*24)."' ORDER BY id DESC") or die ($db->error);
					if($sql->num_rows):
					while($rs = $sql->fetch_assoc()):
					?>
					<li>
						<a href="<?=path?>/index.php?pg=survey&id=<?=$rs['id']?>"><?=$rs['title']?></a>
						<p>
							<span><i class="far fa-user"></i> <?=fh_user($rs['author'])?></span>
							<span><i class="far fa-clock"></i> <?=fh_ago($rs['date'])?></span>
							<span><i class="far fa-eye"></i> <?=$rs['views']?> </span>
							<span><i class="fas fa-reply"></i> <?=db_rows("responses WHERE survey = '{$rs['id']}' GROUP BY ip", "ip")?></span>
						</p>
					</li>
					<?php
					endwhile;
					else:
						echo '<li>'.fh_alerts($lang['alerts']['no-data'], "info").'</li>';
					endif;
					$sql->close();
					?>
				</ul>
			</div>
		</div>
	</div>
</div>
