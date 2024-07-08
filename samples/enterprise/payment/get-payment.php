<?php
// # LookupPaymentSample
// This sample code demonstrate how you can
// retrieve details of a Payment resource
// you've created using the SOAP API.

/** @var Sale $createdPayment */
$createdPayment = require __DIR__ . '/../../safestore/create-payment.php';

use PayUSdk\Framework\Action\Search;
use PayUSdk\Framework\Action\Sale;
use PayUSdk\Framework\Processor;

$paymentId = $createdPayment->getPayUReference();

$search = new Search();
$search->setPayUReference($paymentId)
    ->setContext($apiContext[6]);
// ### Retrieve payment
// Retrieve details of a payment object by calling the
// static `get` method
// on the Payment class by passing a valid PayU reference ID
// (See bootstrap.php for more on `Context`)
try {
    $response = Processor::processAction('search', $search);
} catch (Exception $ex) {
    // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
    ResultPrinter::printError("Get Payment details", "Payment", null, null, $ex);
    exit(1);
}

// NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
ResultPrinter::printResult("Get Payment details", "Payment", $response->getPayUReference(), $createdPayment, $response);

return $response;
