<?php


use RingCentral\SDK\Http\HttpException;
use RingCentral\http\Response;

use RingCentral\SDK\SDK;

require_once(__DIR__ . '/bootstrap.php');


// // --------------------- Send FAX --------------------
	echo "\n";
	echo "--------------Send FAX--------------";
	echo "\n";

$request = $rcsdk->createMultipartBuilder()
                 ->setBody(array(
                     'to'         => array(
                         array('phoneNumber' => ''),
                     ),
                     'faxResolution' => 'High',
                 ))
                 ->add('Plain Text', 'file.txt')
                 ->add(fopen('https://developers.ringcentral.com/assets/images/ico_case_crm.png', 'r'))
                 ->request('/account/~/extension/~/fax');


$response = $platform->sendRequest($request);

print_r("Request");
print_r($response->request()-> getHeaders());
print_r("Response");
print_r($response->raw());








