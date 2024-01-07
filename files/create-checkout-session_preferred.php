<?php

require 'stripe-php-master/init.php';

$stripe = new \Stripe\StripeClient('sk_test_51OUNY5SBPdt3AoFTq8muknD9SPz0UvqagCzvaLiR0aDG6cAMRM8DTAPeuGmVia1AJyplX888AsZHOQ9HJC2ewtX300If3bdncx');

$priceId = 'price_1OVomYSBPdt3AoFTQzEukZqd';

$checkout_session = $stripe->checkout->sessions->create([
  'line_items' => [[
    'price' => $priceId,
    // For metered billing, do not pass quantity
    'quantity' => 1,
  ]],
  'mode' => 'subscription',
  'success_url' => 'http://localhost/leadstaketime/index.php',
  'cancel_url' => 'http://localhost/cancel',
]);

header("HTTP/1.1 303 See Other");
header("Location: " . $checkout_session->url);
?>