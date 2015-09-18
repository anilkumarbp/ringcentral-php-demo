<?php

// 			// --------------------- RinOut --------------------

				echo "\n";
				echo "--------------RingOut--------------";
				echo "\n";

$response = $platform->post('/account/~/extension/~/ringout', array(
    'from' => array('phoneNumber' => 'sandbox number'),
    'to'   => array('phoneNumber' => 'any number')
));

$json = $response->json();

$lastStatus = $json->status->callStatus;

// Poll for call status updates

while ($lastStatus == 'InProgress') {

    $current = $platform->get($json->uri);
    $currentJson = $current->getJson();
    $lastStatus = $currentJson->status->callStatus;
    print 'Status: ' . json_encode($currentJson->status) . PHP_EOL;

    sleep(2);

}

print 'Done.' . PHP_EOL;
