<?php
	
use RingCentral\SDK\Http\HttpException;
use RingCentral\http\Response;
use RingCentral\SDK;

require('vendor/autoload.php');


require(__DIR__ . '/app/authenticate.php');




// require(__DIR__ . '/app/refreshToken.php');


// require(__DIR__ . '/app/exceptions.php');


// require(__DIR__ . '/app/sendSMS.php');
// 

// require(__DIR__ . '/app/sendFax.php');


// require(__DIR__ . '/app/extensions.php');


// require(__DIR__ . '/app/ringout.php');

require(__DIR__ . '/app/subscription.php');


// 			// 	echo "\n";
// 			// 	echo "--------------Load Presence--------------";
// 			// 	echo "\n";

// $presence = $platform->get('/account/~/extension/' . $extensions[0]->id . ',' . $extensions[0]->id . '/presence')

// 			->getMultipart();

// print 'Presence loaded' .
// 	  $extensions[0]->name . ' - ' . $presence[0]->getJson()->presenceStatus . ',' .
// 	  $extensions[0]->name . ' - ' . $presence[1]->getJson()->presenceStatus . PHP_EOL;
