<?php
// # Authorize Payment
// This sample code demonstrates how you can authorize a payment and get it's details.

$reserve = require __DIR__ . '/../../safestore/create-reserve.php';
$reference = $reserve->getPayUReference();

use PayUSdk\Framework\Action\Search;
use PayUSdk\Framework\Processor;
use PayUSdk\Framework\Soap\Context;

// Setting integration will alter the way the API behaves.
$apiContext[0]->setAccountId('account1')
    ->setIntegration(Context::ENTERPRISE);

$search = new Search();
$search->setContext($apiContext[0])
    ->setPayUReference($reference);

// For Sample Purposes Only.
$request = clone $search;

// You can retrieve info about an Authorization (Reserve)
// by invoking the Reserve::get method
// with a valid Context (See bootstrap.php for more on <code>Context</code>).
try {
    $response = Processor::processAction('search',  $search);
} catch (Exception $ex) {
    // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
    ResultPrinter::printError('Get Authorized/Reserved Payment Details', 'Reserve', null, $request, $ex);
    exit(1);
}

// NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
ResultPrinter::printResult('Get Authorized/Reserved Payment Details', 'Reserve', $reference, $request, $response);

return $response;
