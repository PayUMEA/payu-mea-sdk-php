<?php

// # CreatePaymentSample
//
// This sample code demonstrate how you can process
// a direct credit card payment.

list($request, $response) = require dirname(__DIR__, 2) . '/safestore/setup-real-time-recurring-credit-card.php';

$reference = $response->getMerchantReference();
$pmId = $response->getPaymentMethodsUsed()['pmId'];

use PayU\Api\Data\TransactionInterface;
use PayU\Framework\Action\Sale;
use PayU\Framework\Processor;
use PayU\Framework\Soap\Context;
use PayU\Model\CardToken;
use PayU\Model\Currency;
use PayU\Model\FundingInstrument;
use PayU\Model\PaymentMethod;
use PayU\Model\Total;
use PayU\Model\Transaction;
use PayU\Model\TransactionUrl;

// ### CardToken
// Saved credit card id from a previous call to
// create-credit-card.php
$creditCardToken = new CardToken();
$creditCardToken->setId($pmId)
    ->setCvv('123');

// ### FundingInstrument
// A resource representing a Customer's funding instrument.
// For stored credit card payments, set the CardToken
// field on this object.
$funding = new FundingInstrument();
$funding->setCardToken($creditCardToken);

// ### Customer
// A resource representing a Customer that funds a payment
// For stored credit card payments, set payment method to 'credit_card'.
$customer = $request->getCustomer();
$customer->setPaymentMethod(PaymentMethod::TYPE_REAL_TIME_RECURRING)
    ->setFundingInstrument($funding);

// ### Amount
// Lets you specify a payment amount.
// You can also specify additional details
// such as shipping, tax.
$currency = new Currency(['code' => 'ZAR']);
$total = new Total();
$total->setCurrency($currency)
    ->setAmount(100.00);

// ### Transaction
// A transaction defines the contract of a
// payment - what is the payment for and who
// is fulfilling it.
$transaction = new Transaction();
$transaction->setTotal($total)
    ->setDescription("Payment description")
    ->setReference($reference);

$baseUrl = getBaseUrl();
$transactionUrl = new TransactionUrl();
$transactionUrl->setNotificationUrl('http://example.com/return')
    ->setResponseUrl("$baseUrl/process-return.php?apiContext=6")
    ->setCancelUrl("$baseUrl/process-return.php?cancel=true&apiContext=6");

// Setting integration will alter the way the API behaves.
$apiContext[6]->setAccountId('account7')
    ->setIntegration(Context::ENTERPRISE);

// ### Payment
// A Payment Resource; create one using
// the above types and intent set to 'sale'
$payment = new Sale();
$payment->setContext($apiContext[6])
    ->setTransactionType(TransactionInterface::TYPE_PAYMENT)
    ->setCustomer($customer)
    ->setTransaction($transaction)
    ->setTransactionUrl($transactionUrl);

// For Sample Purposes Only.
$request = clone $payment;

// ###Create Payment
// Create a payment by calling the 'callDoTransaction' method
// passing it a valid apiContext.
// (See bootstrap.php for more on `Context`)
// The return object contains the state.
try {
    $response = Processor::processAction('sale', $payment);
} catch (Exception $ex) {
    // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
    ResultPrinter::printError("Create Real-Time Recurring Payment with token (pmId).", "Payment", null, $request, $ex);
    exit(1);
}

// NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
ResultPrinter::printResult("Create Real-Time Recurring Payment with token (pmId).", "Payment", $response->getPayUReference(), $request, $response);

return $payment;
