<?php
// --------------------- Subscription --------------------

use RingCentral\SDK\Subscription\Events\NotificationEvent;
use RingCentral\SDK\Subscription\Subscription;

	echo "\n";
	echo "--------------Subscription--------------";
	echo "\n";



$subscription = $rcsdk->createSubscription()

					  ->addEvents(array('/restapi/v1.0/account/~/extension/~/presence'))

					  ->addListener(Subscription::EVENT_NOTIFICATION, function(NotificationEvent $e) {
	
								print_r($e->getPayload(), true);
                       });

print 'Subscribing' . PHP_EOL;

$subscription->register();


print 'End' . PHP_EOL;