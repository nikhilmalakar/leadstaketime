<?php

require 'stripe-php-master/init.php';

$stripe = new \Stripe\StripeClient('sk_test_51OUNY5SBPdt3AoFTq8muknD9SPz0UvqagCzvaLiR0aDG6cAMRM8DTAPeuGmVia1AJyplX888AsZHOQ9HJC2ewtX300If3bdncx');

$checkout_session = $stripe->checkout->sessions->create([
  'line_items' => [[
    'price_data' => [
      'currency' => 'usd',
      'product_data' => [
        'name' => 'Preferred',
      ],
      'unit_amount' => 3000,
    ],
    'quantity' => 1,
  ]],
  'mode' => 'payment',
  'success_url' => 'http://localhost/leadstaketime/files/success_firms.php',
  'cancel_url' => 'http://localhost/cancel',
]);

header("HTTP/1.1 303 See Other");
header("Location: " . $checkout_session->url);
?>