<?php
// # Capture Payment
// This sample code demonstrates how you can capture an authorize payment.

$response = require __DIR__ . '/../../safestore/create-reserve.php';

use PayU\Framework\Processor;
use PayU\Model\Total;
use PayU\Model\Currency;
use PayU\Model\Customer;
use PayU\Model\PaymentMethod;
use PayU\Framework\Action\Authorize;
use PayU\Model\Transaction;
use PayU\Framework\Soap\Context;

$customer = new Customer();
$customer->setPaymentMethod(PaymentMethod::TYPE_CREDITCARD);

$currency = new Currency(['code' => 'ZAR']);
$total = new Total();
$total->setCurrency($currency)
    ->setAmount(175.50);

$transaction = new Transaction();
$transaction->setTotal($total)
    ->setDescription('Capture transaction');

// Setting integration will alter the way the API behaves.
$apiContext[0]->setAccountId('account1')
    ->setIntegration(Context::ENTERPRISE);

// Setting intent to finalize captures the authorized payment.
$authorize = new Authorize();
$authorize->setContext($apiContext[0])
    ->setTransactionType(Transaction::TYPE_FINALIZE)
    ->setCustomer($customer)
    ->setTransaction($transaction)
    ->setPayUReference($response->getPayUReference())
    ->setMerchantReference($response->getMerchantReference());

// ### Capture Payment
// Create a payment by calling the reserve->create() method
// with a valid Context (See bootstrap.php for more on `Context`)
// The response object retrieved by calling `getReturn()` on the payment resource contains the state.
try {
    $response = Processor::processAction('capture', $authorize);
} catch (Exception $ex) {
    // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
    ResultPrinter::printError('Capture/Finalize Reserved Payment', 'Capture', $response->getPayUReference(), $authorize, $ex);
    exit(1);
}

// NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
ResultPrinter::printResult('Capture/Finalize Reserved Payment', 'Capture', $response->getPayUReference(), $authorize, $response);

return $response;
