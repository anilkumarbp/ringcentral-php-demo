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
            'from' => array('phoneNumber' => 'FromNumber'),
            'to'   => array('phoneNumber' => 'ToNumber')
        ));

        $json = $response->json();

        $lastStatus = $json->status->callStatus;

        // Poll for call status updates

        while ($lastStatus == 'InProgress') {

            $current = $platform->get($json->uri);
            $currentJson = $current->Json();
            $lastStatus = $currentJson->status->callStatus;
            print 'Status: ' . json_encode($currentJson->status) . PHP_EOL;

            sleep(2);

        }

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

        // $response = $e->getTransaction()->getResponse();

        $message = $e->getMessage() . ' (from backend) at URL ' . $e->apiResponse()->request()->getUri()->__toString();

        print 'Expected HTTP Error: ' . $message . PHP_EOL;

}