<?php

use RingCentral\SDK\Http\HttpException;
use RingCentral\http\Response;
use RingCentral\SDK;

// ---------------------- Send SMS --------------------
	echo "\n";
	echo "------------Download Call Recordings----------------";
	echo "\n";



try {

    
$callRecordings = $platform->get('/account/~/extension/~/call-log', array(
	'type' => 'Voice',
	'withRecording' => 'True'))
	->json()->records;
	
	// print_r($callRecordings);

// print 'Retreieved Call logs' . $callRecordings . PHP_EOL;

foreach ($callRecordings as $callRecording) {
	
	
	if(property_exists($callRecording,'recording')) {

	$id = $callRecording ->recording ->id;
	print "Downloading Call Log Record ${id}" . PHP_EOL;

	$uri = $callRecording->recording->contentUri;
	print "Retrieving ${uri}" . PHP_EOL;

	// "account/recording"
	$apiResponse = $platform->get($callRecording->recording->contentUri);
    
    $ext = ($apiResponse->response()->getHeader('Content-Type')[0] == 'audio/mpeg')
      ? 'mp3' : 'wav';
    file_put_contents("/Users/anil.kumar/Desktop/recording_${id}.${ext}", $apiResponse->raw());
    print "Wrote Recording for Call Log Record ${id}" . PHP_EOL;
    file_put_contents("/Users/anil.kumar/Desktop/recording_${id}.json", json_encode($callRecording));
    print "Wrote Metadata for Call Log Record ${id}" . PHP_EOL;

	}
	
	else{
		print "does not have recording" . PHP_EOL;
	}

}




} catch (HttpException $e) {

    // $response = $e->getTransaction()->getResponse();

    $message = $e->getMessage() . ' (from backend) at URL ' . $e->apiResponse()->request()->getUri()->__toString();

    print 'Expected HTTP Error: ' . $message . PHP_EOL;

}
