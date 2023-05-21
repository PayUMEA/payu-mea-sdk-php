<?php

require __DIR__ . '/../../bootstrap.php';

use PayU\Framework\Action\Search;
use PayU\Framework\Processor;
use PayU\Framework\Soap\Context;
use PayU\Framework\XMLHelper;

$payuReference = $_GET['PayUReference'] ?? '';

if (!$payuReference) {
    $payuReference = $_GET['payUReference'] ?? '';
}

/**
 * @param mixed $payuReference
 * @param array $apiContext
 * @return void
 */
function processReturn(mixed $payuReference, array $apiContext): void
{
    $apiContextId = $_GET['apiContext'] ?? 1;
    list($request, $response) = getTransactionDetail($payuReference, $apiContext[$apiContextId]);

    // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
    ResultPrinter::printResult("Redirected From PayU", 'Redirect', $payuReference, $request, $response);
}

/**
 * @param mixed $payuReference
 * @param Context $apiContext
 * @return array
 */
function getTransactionDetail(string $payuReference, Context $apiContext): array
{
    $cancel = $_GET['cancel'] ?? false;
    $search = new Search();
    $search->setContext($apiContext)
        ->setPayUReference($payuReference);

    $response = Processor::processAction('search', $search);

    if ($cancel) {
        // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
        ResultPrinter::printResult("User Cancelled the Capturing of Payment Details", 'Redirect', $payuReference, $search, $response);
        exit;
    }

    return [$search, $response];
}

if ($payuReference) {
    processReturn($payuReference, $apiContext);

} else {
    $xml = file_get_contents("php://input");
    $sxe = simplexml_load_string($xml);

    if (empty($sxe)) {
        http_response_code('500');
    }

    $ipnArray = XMLHelper::parseXMLToArray($sxe);

    if ($ipnArray) {
        $baseUrl = getBaseUrl();
        file_put_contents('sample_ipn', json_encode($ipnArray, 128 | 64));
        http_response_code('200');
    } else {
        http_response_code('500');
    }
}
