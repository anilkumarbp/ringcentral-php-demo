<?php

use RingCentral\SDK\Http\HttpException;
use RingCentral\http\Response;
use RingCentral\SDK;

// ---------------------- Send SMS --------------------
	echo "\n";
	echo "------------Download Call Recordings----------------";
	echo "\n";



try {

    
$callRecordings = $platform->get('/account/~/call-log', array(
	'type' => 'Voice',
	'withRecording' => 'True',
	'dateFrom' => '2016-06-23'
	))
	->json()->records;


	$timePerRecording = 6;

	foreach ($callRecordings as $i => $callRecording) {
	
	
	if(property_exists($callRecording,'recording')) {

	$id = $callRecording ->recording ->id;
	print "Downloading Call Log Record ${id}" . PHP_EOL;

	$uri = $callRecording->recording->contentUri;
	print "Retrieving ${uri}" . PHP_EOL;


	$apiResponse = $platform->get($callRecording->recording->contentUri);
    
    $ext = ($apiResponse->response()->getHeader('Content-Type')[0] == 'audio/mpeg')
      ? 'mp3' : 'wav';


    $start = microtime(true);
    file_put_contents("/Users/anil.kumar/Desktop/acdc/Recordings/recording_${id}.${ext}", $apiResponse->raw());
    print "Wrote Recording for Call Log Record ${id}" . PHP_EOL;
    file_put_contents("/Users/anil.kumar/Desktop/acdc/JSON/recording_${id}.json", json_encode($callRecording));
    print "Wrote Metadata for Call Log Record ${id}" . PHP_EOL;
    $end=microtime(true);
    

    $time = ($end*1000 - $start * 1000);
    if($time < $timePerRecording) {
    	sleep($timePerRecording-$time);
    }

	}
	
	else{
		print "does not have recording" . PHP_EOL;
	}

}




} catch (HttpException $e) {


    $message = $e->getMessage() . ' (from backend) at URL ' . $e->apiResponse()->request()->getUri()->__toString();

    print 'Expected HTTP Error: ' . $message . PHP_EOL;

}
