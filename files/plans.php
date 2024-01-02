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

if( !site_plans ){
	echo "<div class='padding'>".fh_alerts($lang['alerts']['wrong'], "danger", path)."</div>";
	include __DIR__."/footer.php";
	exit;
}

?>

<div class="pt-title">
	<h3><span><i class="fas fa-dollar-sign"></i></span></h3>
	<h3><?=$lang['plans']['title']?></h3>
	<p><?=$lang['plans']['desc']?></p>
</div>

<div class="pt-plans">
<div class="row">
	<?php
	$sql = $db->query("SELECT * FROM ".prefix."plans WHERE id != 0");
	while($value = $sql->fetch_assoc()):
	?>
		<div class="col">
			<div class="pt-plan">
				<h5><?=$value['plan']?></h5>
				<h6><span><?=site_currency_symbol?></span><b><?=$value['price']?></b></h6>
				<p><?=$lang['plans']['month']?></p>

				<form action="<?php echo PAYPAL_URL; ?>" method="post">
					<input type="hidden" name="business" value="<?=PAYPAL_ID?>">
					<input type="hidden" name="cmd" value="_xclick-subscriptions">

					<input type="hidden" name="item_name" value="<?=$value['plan']?>">
					<input type="hidden" name="item_number" value="Plan#<?=$value['id']?>">
					<input type="hidden" name="currency_code" value="<?=PAYPAL_CURRENCY?>">
					<input type="hidden" name="a3" value="<?=$value['price']?>">
					<input type="hidden" name="p3" value="1">
					<input type="hidden" name="t3" value="M">
    			<input type="hidden" name="custom" value="<?=us_id?>">

					<input type="hidden" name="return" value="<?=PAYPAL_RETURN_URL?>">
					<input type="hidden" name="cancel_return" value="<?=PAYPAL_CANCEL_URL?>">

					<?php if (us_level): ?>
						<button <?=((int)($value['price'])==0?'disabled':'')?> type="sublit" name="submit" class="fancy-button bg-gradient<?=($value['id']==2?'5' :'5')?>">
							<span><?=$lang['plans']['btn']?> <i class="fas fa-heart"></i></span>
						</button>
					<?php else: ?>
						<button type="button" href="#loginModal" data-toggle="modal" class="fancy-button bg-gradient<?=($value['id']==2?'5' :'5')?>">
							<span><?=$lang['plans']['btn']?> <i class="fas fa-heart"></i></span>
						</button>
					<?php endif; ?>

				</form>
				<ul>
					<?php
					$value['specifics'] = [
						[$value['desc1'], 'green', '1'],
						[$value['desc2'], '', '1'],
						[$value['desc3'], '', '1'],
						[$value['desc4'], '', $value['surveys_rapport']],
						[$value['desc5'], '', $value['survey_design']],
						[$value['desc6'], '', $value['surveys_export']],
						[$value['desc7'], '', $value['surveys_iframe']],
						[$value['desc8'], '', $value['support']],
						[$value['desc9'], '', $value['show_ads']]
					];
					foreach ($value['specifics'] as $v):
						if ($v[0]):
						?>
						<li<?=($v[1] == 'green' ?' class="alert-success"' :'')?>>
							<span><i class="fas fa-<?=($v[2]=='1'?'check' :'times')?>"></i></span> <?=$v[0]?>
						</li>
						<?php
						endif;
					endforeach;
					?>
				</ul>
			</div>
		</div>
		<?php
	endwhile;
	?>
</div>
</div>



<?php
include __DIR__."/footer.php";
?>
