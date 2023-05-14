<?php
// # LookupPaymentSample
// This sample code demonstrate how you can
// retrieve details of a Payment resource
// you've created using the SOAP API.

use PayU\Api\ResponseInterface;
use PayU\Framework\Action\Search;
use PayU\Framework\Processor;

/** @var ResponseInterface $response */
$response = require __DIR__ . '/../../safestore/setup-standard-redirect.php';

$reference = $response->getPayUReference();

$search = new Search();
$search->setContext($apiContext[1])
    ->setPayUReference($reference);

// ### Retrieve payment
// Retrieve details of Redirect resource by calling the
// static `get` method on Redirect class by passing a valid Redirect ID (PayU reference)
// (See bootstrap.php for more on `Context`)
try {
    $response = Processor::processAction('search', $search);
} catch (Exception $ex) {
    // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
    ResultPrinter::printError("Get Redirect Payment details", "Redirect", null, $search, $ex);
    exit(1);
}

// NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
ResultPrinter::printResult("Get Redirect Payment details", "Redirect", $reference, $search, $response);

return $response;
