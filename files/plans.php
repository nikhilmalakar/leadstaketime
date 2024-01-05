<?php
include __DIR__ . "/header.php";

if (!site_plans) {
	echo "<div class='padding'>" . fh_alerts($lang['alerts']['wrong'], "danger", path) . "</div>";
	include __DIR__ . "/footer.php";
	exit;
}

?>

<div class="pt-title">
	<h3><span><i class="fas fa-dollar-sign"></i></span></h3>
	<h3><?= $lang['plans']['title'] ?></h3>
	<p><?= $lang['plans']['desc'] ?></p>
</div>


<div class="pt-plans">
	<div class="row">
		<div class="col">
			<div class="pt-plan">
				<h5>Starter</h5>
				<h6><span>$</span><b>2.00</b></h6>
				<p>/per survey</p>

				<form action="<?php echo PAYPAL_URL; ?>" method="post">
					<input type="hidden" name="business" value="<?= PAYPAL_ID ?>">
					<input type="hidden" name="cmd" value="_xclick-subscriptions">

					<input type="hidden" name="item_name" value="Starter">
					<input type="hidden" name="item_number" value="Plan#1">
					<input type="hidden" name="currency_code" value="USD">
					<input type="hidden" name="a3" value="2.00">
					<input type="hidden" name="p3" value="1">
					<input type="hidden" name="t3" value="M">
					<input type="hidden" name="custom" value="2">

					<input type="hidden" name="return" value="<?= PAYPAL_RETURN_URL ?>">
					<input type="hidden" name="cancel_return" value="<?= PAYPAL_CANCEL_URL ?>">

					<?php if (us_level) : ?>
						<button type="submit" name="submit" class="fancy-button bg-gradient5">
							<span><?= $lang['plans']['btn'] ?> <i class="fas fa-heart"></i></span>
						</button>
					<?php else : ?>
						<button type="button" href="#loginModal" data-toggle="modal" class="fancy-button bg-gradient5">
							<span><?= $lang['plans']['btn'] ?> <i class="fas fa-heart"></i></span>
						</button>
					<?php endif; ?>

				</form>
				<ul>
					<li class="alert-success">
						<span><i class="fas fa-check"></i></span> Profile to track your leads
					</li>
					<li>
						<span><i class="fas fa-check"></i></span> Fast turnaround solutions
					</li>
					<li>
						<span><i class="fas fa-check"></i></span> Quickly evaluate potential tenants financial qualifications
					</li>
					<li>
						<span><i class="fas fa-check"></i></span> Email support
					</li>
					<li>
						<span><i class="fas fa-check"></i></span> Specific Survey Design
					</li>
					<li>
						<span><i class="fas fa-check"></i></span> Export Responses
					</li>
				</ul>
			</div>
		</div>
		<div class="col">
			<div class="pt-plan">
				<h5>Preferred</h5>
				<h6><span>$</span><b>30.00</b></h6>
				<p>/per month</p>

				<form action="./files/create-checkout-session_preferred.php" method="post">
					<input type="hidden" name="business" value="<?= PAYPAL_ID ?>">
					<input type="hidden" name="cmd" value="_xclick-subscriptions">

					<input type="hidden" name="item_name" value="Preferred">
					<input type="hidden" name="item_number" value="Plan#2">
					<input type="hidden" name="currency_code" value="USD">
					<input type="hidden" name="a3" value="30.00">
					<input type="hidden" name="p3" value="1">
					<input type="hidden" name="t3" value="M">
					<input type="hidden" name="custom" value="2">

					<input type="hidden" name="return" value="<?= PAYPAL_RETURN_URL ?>">
					<input type="hidden" name="cancel_return" value="<?= PAYPAL_CANCEL_URL ?>">

					<?php if (us_level) : ?>
						<button type="submit" name="submit" class="fancy-button bg-gradient5">
							<span><?= $lang['plans']['btn'] ?> <i class="fas fa-heart"></i></span>
						</button>
					<?php else : ?>
						<button type="button" href="#loginModal" data-toggle="modal" class="fancy-button bg-gradient5">
							<span><?= $lang['plans']['btn'] ?> <i class="fas fa-heart"></i></span>
						</button>
					<?php endif; ?>

				</form>
				<ul>
					<li class="alert-success">
						<span><i class="fas fa-check"></i></span> All starter features
					</li>
					<li>
						<span><i class="fas fa-check"></i></span> 24/7 Email support
					</li>
					<li>
						<span><i class="fas fa-check"></i></span> customizable themes to show your survey 
					</li>
					<li>
						<span><i class="fas fa-check"></i></span> Logo add customization
					</li>
					<li>
						<span><i class="fas fa-check"></i></span> Specific Survey Design
					</li>
					<li>
						<span><i class="fas fa-check"></i></span> Unlimited submissions
					</li>
					<li>
						<span><i class="fas fa-check"></i></span> More scalable infrastructure
					</li>
				</ul>
			</div>
		</div>
		<div class="col">
			<div class="pt-plan">
				<h5>Firm (10-50 realtors)</h5>
				<h6><span>$</span><b>2500.00</b></h6>
				<p>/per month</p>

				<form action="./files/create-checkout-session_firms.php" method="post">
					<input type="hidden" name="business" value="<?= PAYPAL_ID ?>">
					<input type="hidden" name="cmd" value="_xclick-subscriptions">

					<input type="hidden" name="item_name" value="Firm (10-50 realtors)">
					<input type="hidden" name="item_number" value="Plan#3">
					<input type="hidden" name="currency_code" value="USD">
					<input type="hidden" name="a3" value="2500.00">
					<input type="hidden" name="p3" value="1">
					<input type="hidden" name="t3" value="M">
					<input type="hidden" name="custom" value="2">

					<input type="hidden" name="return" value="<?= PAYPAL_RETURN_URL ?>">
					<input type="hidden" name="cancel_return" value="<?= PAYPAL_CANCEL_URL ?>">

					<?php if (us_level) : ?>
						<button type="submit" name="submit" class="fancy-button bg-gradient5">
							<span><?= $lang['plans']['btn'] ?> <i class="fas fa-heart"></i></span>
						</button>
					<?php else : ?>
						<button type="button" href="#loginModal" data-toggle="modal" class="fancy-button bg-gradient5">
							<span><?= $lang['plans']['btn'] ?> <i class="fas fa-heart"></i></span>
						</button>
					<?php endif; ?>

				</form>
				<ul>
					<li class="alert-success">
						<span><i class="fas fa-check"></i></span> All pro and starter features
					</li>
					<li>
						<span><i class="fas fa-check"></i></span> White label solutions and customization
					</li>
					<li>
						<span><i class="fas fa-check"></i></span> Custom Survey Design
					</li>
					<li>
						<span><i class="fas fa-check"></i></span> Export Responses
					</li>
					<li>
						<span><i class="fas fa-check"></i></span> Priority support
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>



</div>




<?php
include __DIR__ . "/footer.php";
?>