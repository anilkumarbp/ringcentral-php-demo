<?php


//Revoke the token ( Token refresh )
//save the authentication to a file 

				print_r("refreshToken");
				echo "\n";
				echo "----------------------------";
				echo "\n"; 
			$cacheDir = __DIR__ . DIRECTORY_SEPARATOR . '_cache';
			$file = $cacheDir . DIRECTORY_SEPARATOR . 'platform.json';

			if (!file_exists($cacheDir)) {
			    mkdir($cacheDir);
			}

			$cachedAuth = [];

			if (file_exists($file)) {
			    $cachedAuth = json_decode(file_get_contents($file), true);
			    unlink($file); // dispose cache file, it will be updated if script ends successfully
			}

			file_put_contents($file, json_encode($platform->getAuthData(), JSON_PRETTY_PRINT));

			$refresh = $platform->setAuthData(json_decode(file_get_contents($file), true));
