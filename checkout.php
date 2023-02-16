<?php

if (is_dir(__DIR__ . 'php')) {
    $dir = __DIR__ . 'php/';
} else {
    $dir = __DIR__ . '/';
}

require_once $dir . 'vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable($dir);
$dotenv->load();

\Stripe\Stripe::setApiKey($_ENV['STRIPE_SECRET_KEY']);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_SERVER['REQUEST_URI'] == '/php/checkout.php') {
    // Get the line items from the request body
    $line_items = $_POST['line_items'];

    // Create a checkout session
    $session = \Stripe\Checkout\Session::create([
        'payment_method_types' => ['card'],
        'line_items' => $line_items,
        'mode' => 'payment',
        'success_url' => $_POST[$_ENV['STRIPE_SUCCESS_URL']],
        'cancel_url' => $_POST[$_ENV['STRIPE_CANCEL_URL']],
    ]);

    // Send the session URL back to the client
    header('Content-Type: application/json');
    echo json_encode(['url' => $session->url]);
}
