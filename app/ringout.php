<?php

// use RingCentral\SDK\Http\HttpException;
// use RingCentral\http\Response;
use RingCentral\SDK;

// ---------------------- Send SMS --------------------
    echo "\n";
    echo "------------Initiate Ringout----------------";
    echo "\n";


	

try {    
        
        $start = microtime(true);
        print 'Start Time :' . $start . PHP_EOL;
        $response = $platform->post('/account/~/extension/~/ringout', array(
            'from' => array('phoneNumber' => ''),
            'to'   => array('phoneNumber' => '')
        ));

        $json = $response->json();

        print 'response is :' . json_encode($json) . PHP_EOL;

        $lastStatus = $json->status->callStatus;

        print 'Done.' . PHP_EOL;
        $end = microtime(true);
        print 'End Time :' . $end . PHP_EOL;
        $time = ($end*1000 - $start * 1000) / 1000;
        print 'Recording completed in :' . $time . PHP_EOL;
        if($time < 10){
            $sleepTime = round(10 - $time,0);
            print 'Sleeping for :' . $sleepTime . PHP_EOL;
            sleep($sleepTime);
        }


} catch (HttpException $e) {


        $message = $e->getMessage() . ' (from backend) at URL ' . $e->apiResponse()->request()->getUri()->__toString();

        print 'Expected HTTP Error: ' . $message . PHP_EOL;

}