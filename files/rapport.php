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

if(!fh_access("rapport")){
	echo "<div class='padding'>".fh_alerts($lang['alerts']['permission'], "warning")."</div>";
	include __DIR__."/footer.php";
	exit;
}

$sql = $db->query("SELECT * FROM ".prefix."survies WHERE id = '{$id}'") or die ($db->error);
$rs = $sql->fetch_assoc();

if($rs['author'] == us_id || us_level == 6):

$firststep = db_get("steps", "views", $rs['id'], "survey", "ORDER BY id ASC LIMIT 1");
$laststep  = db_get("steps", "views", $rs['id'], "survey", "ORDER BY id DESC LIMIT 1");
$pourcent  = $firststep ? ceil(($laststep/$firststep)*100) : '--';
$lastresp  = db_get("responses", "date", $rs['id'], "survey", "ORDER BY id DESC LIMIT 1");

?>
<div class="pt-breadcrump">
  <li><a href="<?=path?>/index.php?pg=mysurveys"><i class="fas fa-home"></i> <?=$lang['menu']['my']?></a></li>
	<li><?=$lang['report']['title']?></li>
	<li><?=$rs['title']?></li>
</div>
<div class="pt-title">
	<div class="pt-options">
		<a href="<?=path?>/index.php?pg=editor&id=<?=$rs['id']?>" class="pt-btn btn-red"><i class="fas fa-edit"></i> <?=$lang['report']['btn2']?></a>
		<a href="#" class="pt-btn btn-green pt-exportall" rel="<?=$rs['id']?>"><i class="fas fa-file-csv"></i> <?=$lang['report']['btn3']?></a>
	</div>
</div>

<div class="pt-rapport">

<div class="row">
	<div class="col-6">

		<div class="pt-div-stats">
			<table>
				<tr>
					<td><b><?=$lang['report']['stitle']?></b></td>
					<td><a href="<?=path?>/index.php?pg=survey&id=<?=$rs['id']?>"><?=$rs['title']?></a></td>
				</tr>
				<tr>
					<td><b><?=$lang['report']['views']?></b></td>
					<td><?=$rs['views']?></td>
				</tr>
				<tr>
					<td><b><?=$lang['report']['responses']?></b></td>
					<td><?=db_rows("responses WHERE survey = '{$rs['id']}' GROUP BY token_id ORDER BY MAX(id) DESC", "token_id")?></td>
				</tr>
				<tr>
					<td><b><?=$lang['report']['rate']?></b></td>
					<td><span><?=$pourcent?>%</span></td>
				</tr>
				<tr>
					<td><b><?=$lang['report']['start']?></b></td>
					<td><?=date('M d, Y',$rs['date'])?></td>
				</tr>
				<tr>
					<td><b><?=$lang['report']['end']?></b></td>
					<td><?=date('M d, Y',$rs['enddate'])?></td>
				</tr>
				<tr>
					<td><b><?=$lang['report']['last_r']?></b></td>
					<td><?=($lastresp?fh_ago($lastresp):'--')?></td>
				</tr>
			</table>
		</div>

	</div>
	<div class="col-6">
		<div class="pt-surveystatslinks">
			<a href="#daily" rel="<?=$rs['id']?>"><?=$lang['report']['days']?></small></a>
			<a href="#monthly" rel="<?=$rs['id']?>"><?=$lang['report']['months']?></a>
		</div>
		<div class="pt-surveystats" rel="<?=$rs['id']?>">
			<canvas id="line-chart" width="800" height="450"></canvas>
		</div>
	</div>
</div>


<?php
$s_sql = $db->query("SELECT * FROM ".prefix."steps WHERE survey = '{$id}' ORDER BY sort ASC") or die ($db->error);
while($s_rs = $s_sql->fetch_assoc()){

	$q_sql = $db->query("SELECT * FROM ".prefix."questions WHERE survey = '{$id}' && step ='{$s_rs['sort']}' ORDER BY sort ASC") or die ($db->error);
	while($q_rs = $q_sql->fetch_assoc()){
		$q_tp = db_get("answers", "type", $id, "survey", "&& step ='{$s_rs['sort']}' && question = '{$q_rs['sort']}'");
		$q_tp = $q_tp ? $q_tp : $q_rs['type'];
		if($q_tp!="text"){
		echo "
		<div class='pt-rapport-q'>
			<div class='pt-answered'>{$lang['report']['by']} ".db_rows("responses WHERE question = '{$q_rs['id']}' && response != '' GROUP BY token_id", "token_id")." of {$s_rs['views']} {$lang['report']['people']}</div>
			<h3>".$q_rs['title']."
				<div class='pt-options'>
					".(in_array($q_tp, ['rating', 'radio', 'checkbox', "dropdown", "image", "scale"])?
						"<small class='showchart'>chart</small><small class='showpie'>pie</small>" :
						"<small class='showresults'>{$lang['report']['results']}</small>
						<small class='exportEx'>{$lang['report']['export']}</small>")."
				</div>
			</h3>";
		$a_sql = $db->query("SELECT * FROM ".prefix."answers WHERE survey = '{$id}' && step ='{$s_rs['sort']}' && question = '{$q_rs['sort']}' ORDER BY id ASC") or die ($db->error);
		$a = 1;
		$num = $a_sql->num_rows;
		if( $num ){
			while($a_rs = $a_sql->fetch_assoc()){
				$resp = db_get("responses", "response", $a_rs['id'], "answer");
				if($a_rs['type'] == "rating"){
					echo "<div class='pt-content' data-answer='{$a_rs['id']}'></div>";
				} elseif(in_array($a_rs['type'], ["checkbox","radio", "dropdown", "image"])){
					$resp = db_get("responses", "response", $q_rs['id'], "question");
					$ans_arr = explode(',', $resp);
					echo ($a == 1 ? "<div class='pt-content' data-answer='{$a_rs['id']}'>" : '').($a == $num ? "</div>" : '');
				} else {
					echo "<div class='pt-content' data-answer='{$a_rs['id']}' data-question='".($a_rs['type']=="country"?$a_rs['question_id']:$a_rs['question'])."'></div>";
				}
				$a++;
			}
		} else {
			echo "<div class='pt-content' data-answer='0' data-question='{$q_rs['id']}'></div>";
		}
		$a_sql->close();
		echo "</div>";
		}
	}
	$q_sql->close();

}
$s_sql->close();
?>
</div>


<?php
else:
	echo '<div class="padding">'.fh_alerts($lang['alerts']['wrong'], "danger", path).'</div>';
endif;
include __DIR__."/footer.php";
?>
