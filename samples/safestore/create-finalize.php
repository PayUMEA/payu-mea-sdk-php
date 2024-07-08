<?php
// # Capture Payment
// This sample code demonstrates how you can capture a payment.

$reserveResponse = require 'create-reserve.php';

use PayUSdk\Framework\Processor;
use PayUSdk\Model\Total;
use PayUSdk\Model\Currency;
use PayUSdk\Model\Customer;
use PayUSdk\Model\PaymentMethod;
use PayUSdk\Framework\Action\Authorize;
use PayUSdk\Model\Transaction;
use PayUSdk\Framework\Soap\Context;


$customer = new Customer();
$customer->setPaymentMethod(PaymentMethod::TYPE_CREDITCARD);

$currency = new Currency(['code' => 'ZAR']);
$total = new Total();
$total->setCurrency($currency)
    ->setAmount(175.50);

$transaction = new Transaction();
$transaction->setTotal($total);

// Setting integration to `redirect` will alter the way the API behaves.
$apiContext[0]->setAccountId('account1')
    ->setIntegration(Context::ENTERPRISE);

// Setting intent to finalize captures the authorized payment.
$authorize = new Authorize();
$authorize->setContext($apiContext[0])
    ->setTransactionType(Transaction::TYPE_FINALIZE)
    ->setCustomer($customer)
    ->setTransaction($transaction)
    ->setPayUReference($reserveResponse->getPayUReference())
    ->setMerchantReference($reserveResponse->getMerchantReference());

// ### Capture Payment
// Capture a payment by calling the reserve->capture() method
// with a valid Context (See bootstrap.php for more on `Context`)
// The response object retrieved by calling `getReturn()` on the payment resource contains the state.
try {
    $response = Processor::processAction('capture', $authorize);
} catch (Exception $ex) {
    // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
    ResultPrinter::printError('Capture/Finalize Reserved Payment', 'Reserve', $response ? $response->getPayUReference() : '', $authorize, $ex);
    exit(1);
}

// NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
ResultPrinter::printResult('Capture/Finalize Reserved Payment', 'Reserve', $response->getPayUReference(), $authorize, $response);

return $response;
