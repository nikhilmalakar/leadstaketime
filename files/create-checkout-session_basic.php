<?php

require 'stripe-php-master/init.php';

$stripe = new \Stripe\StripeClient('sk_test_51OUNY5SBPdt3AoFTq8muknD9SPz0UvqagCzvaLiR0aDG6cAMRM8DTAPeuGmVia1AJyplX888AsZHOQ9HJC2ewtX300If3bdncx');

$priceId = 'price_1OVpaZSBPdt3AoFTwniUlEah';
$survey_id = $_POST['survey_id'];
// echo $survey_id;

$checkout_session = $stripe->checkout->sessions->create([
  'line_items' => [[
    'price' => $priceId,
    // For metered billing, do not pass quantity
    'quantity' => 1,
  ]],
  'mode' => 'payment',
  'success_url' => 'http://localhost/leadstaketime/files/success_basic.php?survey_id='.$survey_id.'',
  'cancel_url' => 'http://localhost/cancel',
]);

header("HTTP/1.1 303 See Other");
header("Location: " . $checkout_session->url);
?>