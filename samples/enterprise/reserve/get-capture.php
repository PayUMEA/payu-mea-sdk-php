<?php
// # Get Capture
// This sample code demonstrates how you can get details of a captured payment.

$capture = require __DIR__ . '/../../safestore/create-finalize.php';
$captureId = $capture->getPayUReference();

use PayUSdk\Framework\Action\Search;
use PayUSdk\Framework\Processor;
use PayUSdk\Framework\Soap\Context;

// Setting integration will alter the way the API behaves.
$apiContext[0]->setAccountId('account1')
    ->setIntegration(Context::ENTERPRISE);


$search = new Search();
$search->setPayUReference($captureId)
    ->setContext($apiContext[0]);

// You can retrieve info about a Capture (Finalize)
// by invoking the Capture::get method
// with a valid Context (See bootstrap.php for more on <code>Context</code>).
try {
    $response = Processor::processAction('search', $search);
} catch (Exception $ex) {
    // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
    ResultPrinter::printError('Get Captured/Finalized Payment Details', 'Capture', null, $search, $ex);
    exit(1);
}

// NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
ResultPrinter::printResult('Get Captured/Finalized Payment Details', 'Capture', $captureId, $search, $response);

return $response;
