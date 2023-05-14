<?php
// # LookupPaymentSample
// This sample code demonstrate how you can
// retrieve details of a Payment resource
// you've created using the SOAP API.

$response = require dirname(__DIR__, 2) . '/safestore/setup-standard-redirect.php';

use PayU\Framework\Action\Search;
use PayU\Framework\Processor;

$reference = $response->getPayUReference();

$search = new Search();
$search->setPayUReference($reference)
    ->setContext($apiContext[1]);

// ### Retrieve payment
// Retrieve the Redirect resource object by calling the
// static `get` method on the Redirect class by passing a valid Redirect ID (PayU reference).
// (See bootstrap.php for more on `Context`)
try {
    $response = Processor::processAction('search', $search);
} catch (Exception $ex) {
    // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
    ResultPrinter::printError("Get Redirect Authorize/Reserve details", "Redirect", null, $search, $ex);
    exit(1);
}

// NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
ResultPrinter::printResult("Get Redirect Authorize/Reserve details", "Redirect", $reference, $search, $response);

return $response;
