<?php

use RingCentral\SDK\Http\HttpException;
use RingCentral\http\Response;
use RingCentral\SDK;


	echo "\n";
	echo "------------Download Detailed Call Recordings----------------";
	echo "\n";



try {

    
$callRecordings = $platform->get('/account/~/call-log', array(
	'type' => 'Voice',
	'view' => 'Detailed',
	'withRecording' => 'True'
	))
	->json()->records;


	$timePerRecording = 6;

	foreach ($callRecordings as $i => $callRecording) {

		// Make the Directory for the specific call alone
		$recordingDir = getcwd() . DIRECTORY_SEPARATOR . 'Recordings' . DIRECTORY_SEPARATOR . 'Call :' .$i;
		$jsonDir = getcwd(). DIRECTORY_SEPARATOR . 'Json' . DIRECTORY_SEPARATOR . 'Call :' .$i;
		if (!file_exists($recordingDir) && !file_exists($jsonDir) ) {
    		mkdir($recordingDir, 0777, true);
    		mkdir($jsonDir, 0777, true);
		}
		
		// Retreive Call Legs associated with a Call-Log Entry in Detailed View
		$legs = $callRecording->legs;
			
		// Loop through Each Legs to Download the call recordings
		foreach ($legs as $i => $leg) {

		
			if(property_exists($leg,'recording')) {

				$id = $leg ->recording ->id;
				print "Downloading Call Log Record ${id}" . PHP_EOL;

				$uri = $callRecording->recording->contentUri;
				print "Retrieving ${uri}" . PHP_EOL;


				$apiResponse = $platform->get($callRecording->recording->contentUri);
		    
		    	$ext = ($apiResponse->response()->getHeader('Content-Type')[0] == 'audio/mpeg')
		      	? 'mp3' : 'wav';


		    	$start = microtime(true);
		    	// file_put_contents("/Users/anil.kumar/Desktop/acdc/Recordings/recording_${id}.${ext}", $apiResponse->raw());
		    	file_put_contents("${recordingDir}/recording_${id}.${ext}", $apiResponse->raw());
		    	print "Wrote Recording for Call Log Record ${id}" . PHP_EOL;
		    	file_put_contents("${jsonDir}/recording_${id}.json", json_encode($leg));
		    	print "Wrote Metadata for Call Log Record ${id}" . PHP_EOL;
		    	$end=microtime(true);
		    

		    	$time = ($end*1000 - $start * 1000);
		    	if($time < $timePerRecording) {
		    		sleep($timePerRecording-$time);
		    	}

			}
		
			else{
				print "does not have recording with the call_leg, moving onto the next call leg" . PHP_EOL;
			}

		}
	}

} catch (HttpException $e) {


    $message = $e->getMessage() . ' (from backend) at URL ' . $e->apiResponse()->request()->getUri()->__toString();

    print 'Expected HTTP Error: ' . $message . PHP_EOL;

}
