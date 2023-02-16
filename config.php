<?php

if (is_dir(__DIR__ . 'php')) {
    $dir = __DIR__ . 'php/';
} else {
    $dir = __DIR__ . '/';
}

require_once $dir . 'vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable($dir);
$dotenv->load();

header('Content-Type: application/json');

echo json_encode([
    'publishableKey' => $_ENV['STRIPE_PUBLISHABLE_KEY'],
]);
