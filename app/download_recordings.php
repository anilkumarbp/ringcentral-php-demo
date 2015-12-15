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

	// $file = fopen("sample.csv","w");
	// // fputcsv($file,explode(',','RecordingID','ContentURI'));
	// fputcsv($file,explode('RecordingID','contentURI','Filename'));

	$timePerRecording = 6;
	
	// print_r($callRecordings);

// print 'Retreieved Call logs' . $callRecordings . PHP_EOL;

foreach ($callRecordings as $i => $callRecording) {
	
	
	if(property_exists($callRecording,'recording')) {

	$id = $callRecording ->recording ->id;
	print "Downloading Call Log Record ${id}" . PHP_EOL;

	$uri = $callRecording->recording->contentUri;
	print "Retrieving ${uri}" . PHP_EOL;


	// check if the API rates are well within 10/min
	// if($i > 0 && $i % 10 == 0) {
	// 	sleep(30);
	// }
	// "account/recording"
	$apiResponse = $platform->get($callRecording->recording->contentUri);
    
    $ext = ($apiResponse->response()->getHeader('Content-Type')[0] == 'audio/mpeg')
      ? 'mp3' : 'wav';
    
    // $filename =  recording_${id}.${ext}";


    $start = microtime(true);
    file_put_contents("/Users/anil.kumar/Desktop/AllianceRecordings/Recordings/recording_${id}.${ext}", $apiResponse->raw());
    print "Wrote Recording for Call Log Record ${id}" . PHP_EOL;
    file_put_contents("/Users/anil.kumar/Desktop/AllianceRecordings/JSON/recording_${id}.json", json_encode($callRecording));
    print "Wrote Metadata for Call Log Record ${id}" . PHP_EOL;
    $end=microtime(true);
    

    $time = ($end*1000 - $start * 1000);
    if($time < $timePerRecording) {
    	sleep($timePerRecording-$time);
    }

    // // write to csv
    // fputcsv($file,explode($id,$uri));


	}
	
	else{
		print "does not have recording" . PHP_EOL;
	}

}

	// fclose($file);



} catch (HttpException $e) {

    // $response = $e->getTransaction()->getResponse();

    $message = $e->getMessage() . ' (from backend) at URL ' . $e->apiResponse()->request()->getUri()->__toString();

    print 'Expected HTTP Error: ' . $message . PHP_EOL;

}
