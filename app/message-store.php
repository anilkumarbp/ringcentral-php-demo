	<?php

use RingCentral\SDK\Http\HttpException;
use RingCentral\http\Response;
use RingCentral\SDK;

// ---------------------- Send SMS --------------------
	echo "\n";
	echo "------------Get Message Store----------------";
	echo "\n";



try {

print 'sample';
    
$apiResponse = $platform->get('/account/~/extension/~/message-store', array(
	'perPage' => 100
	));

print 'Retreieved Message Store Logs' . $apiResponse->text() . PHP_EOL;


} catch (HttpException $e) {

    // $response = $e->getTransaction()->getResponse();

    $message = $e->getMessage() . ' (from backend) at URL ' . $e->apiResponse()->request()->getUri()->__toString();

    print 'Expected HTTP Error: ' . $message . PHP_EOL;

}
