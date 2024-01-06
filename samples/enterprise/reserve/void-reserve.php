<?php
// # Void Authorize
// This sample code demonstrates how you can authorize a payment and get it's details.

$response = require __DIR__ . '/../../safestore/create-reserve.php';

use PayUSdk\Api\Data\TransactionInterface;
use PayUSdk\Framework\Action\VoidAuthorize;
use PayUSdk\Framework\Processor;
use PayUSdk\Framework\Soap\Context;
use PayUSdk\Model\Currency;
use PayUSdk\Model\Total;
use PayUSdk\Model\Transaction;

$currency = new Currency(['code' => 'ZAR']);
$total = new Total();
$total->setCurrency($currency)
    ->setAmount(175.50);

$transaction = new Transaction();
$transaction->setTotal($total)
    ->setDescription('Void transaction');

// Setting integration to `redirect` will alter the way the API behaves.
$apiContext[0]->setAccountId('account1')
    ->setIntegration(Context::ENTERPRISE);

$void = new VoidAuthorize();
$void->setTransactionType(TransactionInterface::TYPE_RESERVE_CANCEL)
    ->setContext($apiContext[0])
    ->setTransaction($transaction)
    ->setPayUReference($response->getPayUReference())
    ->setMerchantReference($response->getMerchantReference());;


// You can retrieve info about an Authorization (Reserve)
// by invoking the Reserve::get method
// with a valid Context (See bootstrap.php for more on <code>Context</code>).
try {
    $response = Processor::processAction('void', $void);
} catch (Exception $ex) {
    // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
    ResultPrinter::printError('Void/Cancel Authorized/Reserved Payment', 'Reserve', null, $void, $ex);
    exit(1);
}

// NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
ResultPrinter::printResult('Void/Cancel Authorized/Reserved Payment', 'Reserve', $response->getPayUReference(), $void, $response);

return $response;
