<?php

require_once(__DIR__ . '/bootstrap.php');

use RingCentral\SDK\SDK;

// $credentials_file = count($argv) > 1 
//   ? $argv[1] : __DIR__ . '/_credentials.json';

// $credentials = json_decode(file_get_contents($credentials_file), true);

// Create SDK instance

$rcsdk = new SDK("", "" , "https://platform.ringcentral.com", 'Demo', '1.0.0');

$platform = $rcsdk->platform();

// Retrieve previous authentication data

$cacheDir = __DIR__ . DIRECTORY_SEPARATOR . '_cache';
$file = $cacheDir . DIRECTORY_SEPARATOR . 'platform.json';

if (!file_exists($cacheDir)) {
    mkdir($cacheDir);
}

$cachedAuth = array();

if (file_exists($file)) {
    $cachedAuth = json_decode(file_get_contents($file), true);
    unlink($file); // dispose cache file, it will be updated if script ends successfully
}

$platform->auth()->setData($cachedAuth);

try {

    $platform->refresh();

    print 'Authorization was restored' . PHP_EOL;

} catch (Exception $e) {

    print 'Auth exception: ' . $e->getCode() . PHP_EOL;

    $auth = $platform->login("", "", "");

    print 'Authorized' . PHP_EOL;

}

// Save authentication data

file_put_contents($file, json_encode($platform->auth()->data(), JSON_PRETTY_PRINT));