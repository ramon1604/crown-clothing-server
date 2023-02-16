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

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_SERVER['REQUEST_URI'] == '/php/create-payment-intent.php') {
    try {
        // Get the total amount from the request body
        $arr = file_get_contents("php://input");
        $total = intval($arr);

        // Create a payment intent
        $intent = \Stripe\PaymentIntent::create([
            'amount' => $total,
            'currency' => 'usd',
            'payment_method_types' => ['card'],
        ]);

        // Send the client secret back to the client
        header('Content-Type: application/json');
        echo json_encode(['clientSecret' => $intent->client_secret]);
    } catch (Exception $e) {
        echo json_encode(['Message: ' . $e->getMessage() . $total]);
    }
}
