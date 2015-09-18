<?php



// // --------------------- Send FAX --------------------
	echo "\n";
	echo "--------------Send FAX--------------";
	echo "\n";



$request = $rcsdk->createMultipartBuilder()
                 ->setBody(array(
                     'to'         => array(
                         array('phoneNumber' => 'sandbox number'),
                     ),
                     'faxResolution' => 'High',
                 ))
                 // ->addAttachment('Plain Text', 'fax.pdf')
                 ->addAttachment(fopen('/path', 'r'))
                 ->request('/account/~/extension/~/fax');

// print $request->getBody() . PHP_EOL;

$response = $platform->sendRequest($request);




print 'Sent Fax ' . $response->json()->uri . PHP_EOL;
