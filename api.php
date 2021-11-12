<?php

	ini_set('display_errors', '1');
	ini_set('display_startup_errors', '1');
	error_reporting(E_ALL);

	require_once("detectlanguage-php-master/lib/detectlanguage.php");

	use \DetectLanguage\DetectLanguage;

	DetectLanguage::setApiKey("07569dcf662772152dca1cbe4bfb9bbb");

	$results = DetectLanguage::detect($_REQUEST['message']);

	$payload = json_encode($_REQUEST);


	if($results[0]->language == 'es'){
		$ch = curl_init('http://172.31.21.52:5000/webhooks/rest/webhook');
	}
	else{
		$ch = curl_init('http://172.31.21.52:5000/webhooks/rest/webhook');
	}



//	if(substr($_POST['message'], -1) == '2')
//         $ch = curl_init('http://localhost:82/webhooks/rest/webhook');
//     else
//         $ch = curl_init('http://localhost:82/webhooks/rest/webhook');

	
    

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLINFO_HEADER_OUT, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

    // Set HTTP Header for POST request

    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Content-Length: ' . strlen($payload))
    );

    // Submit the POST request
    $result = curl_exec($ch);

    $a = json_decode($result, true);

    print_r($a[0]['text']);
    // print_r('Bot Response');

    // Close cURL session handle
    // curl_close($ch);

?>