<?php

// # CreateRedirectPaymentSample
//
// This sample code demonstrate how you can process
// a redirect payment.

list($request,) = require dirname(__DIR__) . '/safestore/create-credit-card.php';

use PayUSdk\Framework\Action\Lookup;
use PayUSdk\Framework\Processor;

$lookup = new Lookup();
$lookup->setCustomerId($request->getCustomer()->getCustomerDetail()->getCustomerId())
    ->setContext($apiContext[0]);

try {
    $response = Processor::processAction('lookup', $lookup);
} catch (Exception $ex) {
    // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
    ResultPrinter::printError('Lookup Transactions. If 500 Exception, check response details', 'LookupTransaction', null, $request, $ex);
    exit(1);
}

ResultPrinter::printResult('Lookup Transactions', 'LookupTransaction', $response->getPayUReference(), $lookup, $response);

return $response;
