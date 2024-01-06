<?php
// # Authorize Payment
// This sample code demonstrates how you can authorize a payment and get it's details.

$response = require __DIR__ . '/../../safestore/create-finalize.php';
$reference = $response->getPayUReference();

use PayUSdk\Api\Data\TransactionInterface;
use PayUSdk\Framework\Action\Refund;
use PayUSdk\Framework\Processor;
use PayUSdk\Framework\Soap\Context;
use PayUSdk\Model\Currency;
use PayUSdk\Model\Total;
use PayUSdk\Model\Transaction;

// ### Amount
// Lets you specify a payment amount.
// You can also specify additional details
// such as shipping, tax.
$currency = new Currency();
$currency->setCode('ZAR');

$total = new Total();
$total->setCurrency($currency)
    ->setAmount(175.50);

// ### Transaction
// A transaction defines the contract of a
// payment - what is the payment for and who
// is fulfilling it.
$transaction = new Transaction();
$transaction->setTotal($total);

// Setting integration will alter the way the API behaves.
$apiContext[0]->setAccountId('account1')
    ->setIntegration(Context::ENTERPRISE);

$refund = new Refund();
$refund->setContext($apiContext[0])
    ->setTransactionType(TransactionInterface::TYPE_CREDIT)
    ->setTransaction($transaction)
    ->setPayUReference($reference)
    ->setMerchantReference($response->getMerchantReference());

// You can refund a payment amount by invoking the `refund` method
// with a valid Context (See bootstrap.php for more on <code>Context</code>).
try {
    $response = Processor::processAction('refund', $refund);
} catch (Exception $ex) {
    // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
    ResultPrinter::printError('Refund Captured/Finalized Payment', 'Refund', null, $refund, $ex);
    exit(1);
}

// NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
ResultPrinter::printResult('Refund Captured/Finalized Payment', 'Refund', $reference, $refund, $response);

return $response;
