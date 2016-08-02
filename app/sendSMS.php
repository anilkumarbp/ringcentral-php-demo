<?php

// use RingCentral\SDK\Http\HttpException;
// use RingCentral\http\Response;
// use RingCentral\SDK;

// ---------------------- Send SMS --------------------
	echo "\n";
	echo "------------Send SMS----------------";
	echo "\n";



try {

    
$apiResponse = $platform->post('/account/~/extension/~/sms', array(
	'from' => array('phoneNumber'=> ''),
	'to' => array(
				array('phoneNumber' => ''),
				),
	'text' => 'Testing !',	
	));

print 'Sent SMS ' . $apiResponse->json()->uri . PHP_EOL;


} catch (HttpException $e) {

    // $response = $e->getTransaction()->getResponse();

    $message = $e->getMessage() . ' (from backend) at URL ' . $e->apiResponse()->request()->getUri()->__toString();

    print 'Expected HTTP Error: ' . $message . PHP_EOL;

}

