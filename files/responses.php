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

$sql = $db->query("SELECT * FROM ".prefix."survies WHERE id = '{$id}'") or die ($db->error);
$rs = $sql->fetch_assoc();
if($rs['author'] == us_id || us_level == 6):
?>
<div class="pt-breadcrump">
  <li><a href="<?=path?>/index.php?pg=mysurveys"><i class="fas fa-home"></i> <?=$lang['menu']['my']?></a></li>
	<li><?=$lang['report']['rtitle']?></li>
	<li><?=$rs['title']?></li>
</div>

<div class="pt-title">
	<div class="pt-options">
		<a href="<?=path?>/index.php?pg=report&id=<?=$rs['id']?>" class="pt-btn"><i class="fas fa-chart-pie"></i> <?=$lang['report']['btn_1']?></a>
		<a href="<?=path?>/index.php?pg=editor&id=<?=$rs['id']?>" class="pt-btn btn-red"><i class="fas fa-edit"></i> <?=$lang['report']['btn2']?></a>
	</div>
</div>

<div class="table-responsive">
<table class="table">
	<thead>
		<tr>
			<?php
			$q_sql = $db->query("SELECT * FROM ".prefix."questions WHERE survey = '{$id}' ORDER BY step ASC,sort ASC LIMIT 12") or die ($db->error);
			while($q_rs = $q_sql->fetch_assoc()):
				if($q_rs['type']!="text"):
			?>
				<th scope="col"><span class="spover"><?=$q_rs['title']?></span></th>
			<?php
				endif;
			endwhile;
			?>
		</tr>
	</thead>
	<tbody>
		<?php
		$sql = $db->query("SELECT MAX(id) as rid, token_id FROM ".prefix."responses WHERE survey = '{$id}' GROUP BY token_id ORDER BY MAX(id) DESC LIMIT {$startpoint} , {$limit}") or die ($db->error);
		if($sql->num_rows):
		while($rs = $sql->fetch_assoc()):
		?>
		<tr class="pt-response" data-response="<?=$rs['rid']?>">
			<?php
			$q_sql = $db->query("SELECT * FROM ".prefix."questions WHERE survey = '{$id}' ORDER BY step ASC,sort ASC LIMIT 12") or die ($db->error);
			while($q_rs = $q_sql->fetch_assoc()):
				if($q_rs['type']!="text"):
			?>
				<td scope="col"><span class="spover">
					<?php
					$ans_id = db_get("responses", "answer", $q_rs['id'], "question", "&& token_id = '{$rs['token_id']}'");
					$ans_tp = $q_rs['type'];
					$ans_vl = db_get("responses", "response", $q_rs['id'], "question", "&& token_id = '{$rs['token_id']}'");

						if($ans_tp == "rating"){
							for($x=1;$x<=$ans_vl;$x++)
								echo '<i class="'.$q_rs['icon'].' pt-stars-a pt-small"></i>';
							for($x=1;$x<=(5-$ans_vl);$x++)
								echo '<i class="'.$q_rs['icon'].' pt-stars small"></i>';
						} elseif($ans_tp=="scale"){
							echo "<div class='pt-content pt-rscale-c'>";
							for($x=1;$x<=$ans_vl;$x++)
								echo '<i class="pt-rscale-a">'.$x.'</i>';
							for($x=$ans_vl+1;$x<=10;$x++)
								echo '<i class="pt-rscale">'.$x.'</i>';
							echo "</div>";
						} elseif(in_array($ans_tp, ["checkbox","radio", "image", "dropdown"])){
							$ans_arr = explode(',', $ans_vl);
							$i=0;
							for($x=0;$x<count($ans_arr);$x++){
								$i++;
								echo db_get("answers", "title", $ans_arr[$x]);
								echo ($i != count($ans_arr) ? ' | ': '');
							}

						} elseif($ans_tp == "country"){
							echo '<i class="flag-icon flag-icon-'.strtolower($ans_vl).'"></i> ';
							echo "{$countries[$ans_vl]}";
						} elseif($ans_tp == "phone"){
							echo ($ans_vl?'<i class="flag-icon flag-icon-'.strtolower(substr($ans_vl, 0, 2)).'" title="+'.$phones[substr($ans_vl, 0, 2)]['code'].'"></i> ':'');
							echo substr($ans_vl, 2, -1);
						} elseif($ans_tp == "file"){
							echo ($ans_vl?$lang['report']['download']:'');
						} else {
							echo "{$ans_vl}";
						}
					 ?>
				</span></td>
			<?php
				endif;
			endwhile;
			?>
		</tr>
		<?php
		endwhile;
		echo (db_rows("responses WHERE survey = '{$id}' GROUP BY token_id", "MAX(id)") > $limit ? '<tr><td colspan="12">'.fh_pagination("responses WHERE survey = '{$id}' GROUP BY token_id",$limit, path."/index.php?pg=responses&id={$id}&", 1, true).'</td></tr>' : '');
		else:
			?>
			<tr>
				<td colspan="12">
					<?=fh_alerts($lang['alerts']['no-data'], "info")?>
				</td>
			</tr>
			<?php
		endif;
		$sql->close();
		?>

	</tbody>
</table>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      <div class="modal-body pt-response-m"></div>
    </div>
  </div>
</div>

<?php
else:
	echo '<div class="padding">'.fh_alerts($lang['alerts']['wrong'], "danger", path).'</div>';
endif;
include __DIR__."/footer.php";
?>
