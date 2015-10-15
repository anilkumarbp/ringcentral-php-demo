<?php



// // --------------------- Send FAX --------------------
	echo "\n";
	echo "--------------Send FAX--------------";
	echo "\n";


$file = file_get_contents('http://www.ziphearing.com/NewDevelopment/test/Referral_test.pdf');

// touch('report.pdf')

echo $file;

$request = $rcsdk->createMultipartBuilder()
                 ->setBody(array(
                     'to'         => array(
                         array('phoneNumber' => '15856234120'),
                     ),
                     'faxResolution' => 'High',
                 ))
                 // ->add('Plain Text','Referral_test.pdf')
                 ->add($file,'Referral_test.pdf')
                 ->request('/account/~/extension/~/fax');

// print $request->getBody() . PHP_EOL;

$response = $platform->sendRequest($request);




print 'Sent Fax ' . $response->json()->uri . PHP_EOL;

