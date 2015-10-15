<?php

use RingCentral\SDK\Http\HttpException;
use RingCentral\http\Response;
use RingCentral\SDK;

// ---------------------- Send SMS --------------------
	echo "\n";
	echo "------------Get Call Logs----------------";
	echo "\n";



try {

    
$apiResponse = $platform->get('/account/~/extension/~/call-log', array(
	'perPage' => 10
	));

print 'Retreieved Call logs' . $apiResponse->json()->uri . PHP_EOL;


} catch (HttpException $e) {

    // $response = $e->getTransaction()->getResponse();

    $message = $e->getMessage() . ' (from backend) at URL ' . $e->apiResponse()->request()->getUri()->__toString();

    print 'Expected HTTP Error: ' . $message . PHP_EOL;

}
