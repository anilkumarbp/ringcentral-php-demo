<?php



try{



    
    $rcsdk = new RingCentral\SDK\SDK('your appkey','your appsecret','server url');
  
	$platform = $rcsdk->platform();
    


	$t = $platform->login('sandbox username','','sandbox password');


	

	print_r("Authentication Response");
	echo "\n";
	echo "----------------------------";
	echo "\n"; 
	print_r($t);

// Check Authentication Staus
	print_r("Authentication Status");
	echo "\n";
	echo "----------------------------";
	echo "\n";
	// chech authentication status
	$r = $platform->loggedIn();
	print_r($r);
}

catch(Exception $e) {
	print($e);
}
	