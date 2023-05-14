<?php

require __DIR__ . '/../../bootstrap.php';

use PayU\Framework\XMLHelper;

$payuReference = isset($_GET['PayUReference']) ? $_GET['PayUReference'] : '';

if(!$payuReference)
    $payuReference = isset($_GET['payUReference']) ? $_GET['payUReference'] : '';

if($payuReference) {
    extracted($payuReference, $apiContext);

} else {
    $xml = file_get_contents("php://input");
    $sxe = simplexml_load_string($xml);

    if(empty($sxe)) {
        http_response_code('500');
    }

    $ipnArray = XMLHelper::parseXMLToArray($sxe);

    if($ipnArray) {
        $baseUrl = getBaseUrl();
        file_put_contents('sample_ipn', json_encode($ipnArray));
        http_response_code('200');
    } else {
        http_response_code('500');
    }
}
