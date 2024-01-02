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

include __DIR__."/files/head.php";

if(us_level == 6):
?>
<link rel="stylesheet" href="<?=path?>/assets/css/scroll.css">
<div class="pt-wrapper">
	<div class="pt-admin-nav">
		<div class="pt-logo"><i class="fas fa-fire"></i></div>
		<!-- <div class="pt-logo"><img src="<?=path?>/<?=site_favicon?>" /></div> -->
		<ul>
			<li><a href="<?=path?>"><i class="fas fa-home"></i><b><?=$lang['menu']['home']?></b></a></li>
			<li<?=($pg==""?' class="pt-active"':'')?>><a href="<?=path?>/dashboard.php"><i class="fas fa-tachometer-alt"></i><b><?=$lang['menu']['admin']?></b></a></li>
			<li<?=($pg=="users"?' class="pt-active"':'')?>><a href="<?=path?>/dashboard.php?pg=users"><i class="fas fa-users"></i><b><?=$lang['dashboard']['users']?></b></a></li>
			<li<?=($pg=="surveys"?' class="pt-active"':'')?>><a href="<?=path?>/dashboard.php?pg=surveys"><i class="fas fa-poll"></i><b><?=$lang['dashboard']['surveys']?></b></a></li>
			<li<?=($pg=="plans"?' class="pt-active"':'')?>><a href="<?=path?>/dashboard.php?pg=plans"><i class="fas fa-puzzle-piece"></i><b><?=$lang['menu']['plans']?></b></a></li>
			<li<?=($pg=="payments"?' class="pt-active"':'')?>><a href="<?=path?>/dashboard.php?pg=payments"><i class="fas fa-dollar-sign"></i><b><?=$lang['dashboard']['p_title']?></b></a></li>
			<li<?=($pg=="pages"?' class="pt-active"':'')?>><a href="<?=path?>/dashboard.php?pg=pages"><i class="fas fa-copy"></i><b><?=$lang['dashboard']['pg_title']?></b></a></li>
			<li<?=($pg=="setting"?' class="pt-active"':'')?>><a href="<?=path?>/dashboard.php?pg=setting"><i class="fas fa-cogs"></i><b><?=$lang['dashboard']['settings']?></b></a></li>
			<li<?=($pg=="languages"?' class="pt-active"':'')?>><a href="<?=path?>/dashboard.php?pg=languages"><i class="fas fa-language"></i><b><?=$lang['dashboard']['languages']?></b></a></li>
			<li><a href="#" class="pt-logout"><i class="fas fa-power-off"></i><b><?=$lang['menu']['logout']?></b></a></li>
		</ul>
	</div>
	<div class="pt-admin-body">
		<div class="pt-welcome">
			<h3><?=$lang['dashboard']['hello']?> <?=us_username?>!</h3>
			<p><?=$lang['dashboard']['welcome']?></p>
			<span><i class="fas fa-chart-line"></i></span>
		</div>
		<div class="pt-stats">
			<ul>
				<li><span><i class="fas fa-poll"></i></span><b><?=$lang['dashboard']['surveys']?></b> <em><?=db_rows("survies")?></em></li>
				<li><span><i class="fas fa-users"></i></span><b><?=$lang['dashboard']['users']?></b> <em><?=db_rows("users")?></em></li>
				<li><span><i class="fas fa-hand-holding-heart"></i></span><b><?=$lang['dashboard']['responses']?></b> <em><?=db_rows("responses")?></em></li>
				<li><span><i class="far fa-question-circle"></i></span><b><?=$lang['dashboard']['questions']?></b> <em><?=db_rows("questions")?></em></li>
			</ul>
		</div>


		<?php
		if(!$pg):                  include __DIR__."/files/cpanel/main.php";
		elseif($pg == "plans"):    include __DIR__."/files/cpanel/plans.php";
		elseif($pg == "surveys"):  include __DIR__."/files/cpanel/surveys.php";
		elseif($pg == "users"):    include __DIR__."/files/cpanel/users.php";
		elseif($pg == "payments"): include __DIR__."/files/cpanel/payments.php";
		elseif($pg == "pages"):    include __DIR__."/files/cpanel/pages.php";
		elseif($pg == "setting"):  include __DIR__."/files/cpanel/setting.php";
		elseif($pg == "languages"):  include __DIR__."/files/cpanel/languages.php";
		endif;
	?>

		<div class="pt-footer">
			<div><?=str_replace("{link}", '<a href="'.path.'">'.site_title.'</a>',$lang['home']['copyright'])?></div>
		</div>
	</div>
</div>
<?php
include __DIR__."/files/scripts.php";
else:
	echo '<meta http-equiv="refresh" content="0;url='.path.'">';
endif;
?>
</body>
</html>
