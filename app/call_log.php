	<?php

use RingCentral\SDK\Http\HttpException;
use RingCentral\http\Response;
use RingCentral\SDK;

// ---------------------- Send SMS --------------------
	echo "\n";
	echo "------------Get Call Logs----------------";
	echo "\n";



try {



            $apiResponse = $platform->get('/account/~/call-log', array(
            'perPage' => 300,
            'view' => 'Detailed'
            ));


print 'Retreieved Call logs' . $apiResponse->text() . PHP_EOL;

print 'The respsone is : ' . json_encode($apiResponse->json()->records, JSON_PRETTY_PRINT) . PHP_EOL;

$apiResponseArray = $apiResponse->json()->records;

$apiResponseJSONArray = $apiResponse -> jsonArray();
            $recordCountPerPage =  + $apiResponseJSONArray["paging"]["pageEnd"] - $apiResponseJSONArray["paging"]["pageStart"] + 1;
            print 'Number of Records for the page : ' . $recordCountPerPage . PHP_EOL;

$callLogs = array();

foreach ($apiResponseArray as $value) {
                // json_encode($callLogs, FILE_APPEND, JSON_PRETTY_PRINT)
                array_push($callLogs, $value);
                
            }
// print_r ($callLogs);

// print PHP_EOL . "The type is : " . gettype($callLogs) . PHP_EOL;

file_put_contents("Call-Logs/sample.json", json_encode($callLogs));

// print PHP_EOL . "The type is : " . gettype(json_encode($callLogs)) . PHP_EOL;


$callLogRecordsFromFile = file_get_contents(getcwd() . "/Call-Logs/sample.json");


// print "The File Read from JSON file : " . PHP_EOL;

// $decode = json_decode($callLogRecordsFromFile, true);

// print_r ($callLogRecordsFromFile);
print PHP_EOL . "The type is : " . gettype($callLogRecordsFromFile) . PHP_EOL;


foreach ($callLogRecordsFromFile as $i => $callLogRecord) {

if($callLogRecord->recording) {

                  $recordingID = $callLogRecord->recording->id;
                              
                  print "Downloading Call Log Record : ". $recordingID . PHP_EOL;

        
                  // print "Downloaded Call Log Record : ". ${'recordingID'} . PHP_EOL;                  

            }

        }
// print PHP_EOL . "The type is : " . gettype($decode) . PHP_EOL;

} catch (HttpException $e) {

    // $response = $e->getTransaction()->getResponse();

    $message = $e->getMessage() . ' (from backend) at URL ' . $e->apiResponse()->request()->getUri()->__toString();

    print 'Expected HTTP Error: ' . $message . PHP_EOL;

}
