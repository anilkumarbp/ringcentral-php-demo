<?php

use RingCentral\SDK\SDK;

require_once(__DIR__ . '/bootstrap.php');

try{

 
    $rcsdk = new RingCentral\SDK\SDK('appKey','appSecret','https://platform.devtest.ringcentral.com');
  
	$platform = $rcsdk->platform();
    
	$t = $platform->login('username','','password');

	$r = $platform->loggedIn();

	print_r($r);
}

catch(Exception $e) {
	print($e);
}
	