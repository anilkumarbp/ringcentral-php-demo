<?php

// performing API call
	print("Retreive Account and Extension Details");
	echo "\n";
	echo "----------------------------";
	echo "\n";


$extensions = $platform->get('/account/~/extension', array('perPage' => 10))->json()->records;

print 'Users loaded ' . count($extensions) . PHP_EOL;
