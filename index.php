<?php
	
use RingCentral\SDK\Http\HttpException;
use RingCentral\http\Response;
use RingCentral\SDK;

// require('vendor/autoload.php');

// require('vendor/dropbox-sdk/Dropbox/autoload.php');

require(__DIR__ . '/app/authenticate.php');

require(__DIR__ . '/app/call_log.php');

require(__DIR__ . '/app/message-store.php');

require(__DIR__ . '/app/sendFax.php');

require(__DIR__ . '/app/ringout.php');

require(__DIR__ . '/app/download_recordings.php');

require(__DIR__ . '/app/download_detailed_call_recordings.php');

require(__DIR__ . '/app/message-store.php');

require(__DIR__ . '/app/active-calls.php');

require(__DIR__ . '/app/readline_callback_handler_remove(oid)g.php');

require(__DIR__ . '/app/download_dropbox.php');

require(__DIR__ . '/app/download_recordings_dropbox.php');

require(__DIR__ . '/app/sendSMS.php');

require(__DIR__ . '/app/subscription.php');
