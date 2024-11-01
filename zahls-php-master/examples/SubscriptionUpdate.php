<?php

spl_autoload_register(function($class) {
    $root = dirname(__DIR__);
    $classFile = $root . '/lib/' . str_replace('\\', '/', $class) . '.php';
    if (file_exists($classFile)) {
        require_once $classFile;
    }
});

// $instanceName is a part of the url where you access your zahls installation.
// https://{$instanceName}.zahls.ch
$instanceName = 'YOUR_INSTANCE_NAME';

// $secret is the zahls secret for the communication between the applications
// if you think someone got your secret, just regenerate it in the zahls administration
$secret = 'YOUR_SECRET';

$zahls = new \Zahls\Zahls($instanceName, $secret);

$subscription = new \Zahls\Models\Request\Subscription();
$subscription->setId(6);
$subscription->setAmount(40000);
$subscription->setCurrency('CHF');
try {
    $response = $zahls->update($subscription);
    var_dump($response);
} catch (\Zahls\ZahlsException $e) {
    print $e->getMessage();
}