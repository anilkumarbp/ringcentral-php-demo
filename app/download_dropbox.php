<?php

// require_once "dropbox-sdk/Dropbox/autoload.php";

use RingCentral\SDK\Http\HttpException;
use RingCentral\http\Response;
use RingCentral\SDK;
use \Dropbox as dbx;



// ---------------------- Send SMS --------------------
	echo "\n";
	echo "------------Get Call Logs----------------";
	echo "\n";



try {

// Authenticate DropBox
// $json = './config.json';
$appInfo = dbx\AppInfo::loadFromJsonFile("app/config.json");
$webAuth = new dbx\WebAuthNoRedirect($appInfo, "PHP-Example/1.0");

$authorizeUrl = $webAuth->start();

echo "1. Go to: " . $authorizeUrl . "\n";
echo "2. Click \"Allow\" (you might have to log in first).\n";
echo "3. Copy the authorization code.\n";
$authCode = \trim(\readline("Enter the authorization code here: "));

list($accessToken, $dropboxUserId) = $webAuth->finish($authCode);
print "Access Token: " . $accessToken . "\n";

$dbxClient = new dbx\Client($accessToken, "PHP-Example/1.0");

// use RC to retreive the recordgins
    
$apiResponse = $platform->get('https://media.devtest.ringcentral.com:443/restapi/v1.0/account/131192004/recording/1376191004/content', array(
	'perPage' => 100,
	''
	));	

    $ext = ($apiResponse->response()->getHeader('Content-Type')[0] == 'audio/mpeg')
      ? 'mp3' : 'wav';

// Uploading to dropbox

file_put_contents("/Recordings/sample.${ext}", $apiResponse->raw()); 
$f = fopen("/Recordings/sample.${ext}", "rb");     
$result = $dbxClient->uploadFile("/sample.mp3", dbx\WriteMode::add(), $f);
fclose($f);
print_r($result);


print 'Uploaded recordgins' . $apiResponse->text() . PHP_EOL;


} catch (HttpException $e) {

    // $response = $e->getTransaction()->getResponse();

    $message = $e->getMessage() . ' (from backend) at URL ' . $e->apiResponse()->request()->getUri()->__toString();

    print 'Expected HTTP Error: ' . $message . PHP_EOL;

}
