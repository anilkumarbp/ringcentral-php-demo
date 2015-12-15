<?php
// --------------------- Subscription --------------------

use RingCentral\SDK\Subscription\Events\NotificationEvent;
use RingCentral\SDK\Subscription\Subscription;

	echo "\n";
	echo "--------------Subscription--------------";
	echo "\n";




try {

$subscription = $rcsdk->createSubscription();

$subscription->addEvents(array(
	'/account/~/extension/~/message-store',
	'/account/~/extension/~/presence'));

$subscription->setKeepPolling(true);

$subscription->addListener(Subscription::EVENT_NOTIFICATION, function (NotificationEvent $e) {
    print 'Notification' . print_r($e->payload(), true) . PHP_EOL;
});

print 'Subscribing' . PHP_EOL;

$subscription->register();

print 'End' . PHP_EOL;


} catch (HttpException $e) {

    // $response = $e->getTransaction()->getResponse();

    $message = $e->getMessage() . ' (from backend) at URL ' . $e->apiResponse()->request()->getUri()->__toString();

    print 'Expected HTTP Error: ' . $message . PHP_EOL;

}