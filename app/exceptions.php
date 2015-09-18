<?php

use RingCentral\SDK\Http\ApiException;
use RingCentral\http\Response;
use RingCentral\SDK;

print("To perform an exception");
	echo "\n";
	echo "----------------------------";
	echo "\n";

try {

    $platform->get('/account/~/whatever');

} catch (ApiException $e) {

    // Getting error messages using PHP native interface
    print 'Expected HTTP Error: ' . $e->getMessage() . PHP_EOL;

    // In order to get Request and Response used to perform transaction:
    $apiResponse = $e->apiResponse();
    print_r($apiResponse->request()); 
    print_r($apiResponse->response());

    // Another way to get message, but keep in mind, that there could be no response if request has failed completely
    print '  Message: ' . $e->apiResponse->response()->error() . PHP_EOL;

}