<?php

// # CreatePaymentSample
//
// This sample code demonstrate how you can process
// a direct credit card payment.

list($request, $response) = require dirname(__DIR__, 2) . '/safestore/setup-real-time-recurring-credit-card.php';

$reference = $response->getMerchantReference();
$pmId = $response->getPaymentMethodsUsed()->getId();
$userId = $request->getCustomer()->getCustomerDetail()->getCustomerId();

use PayU\Api\Data\TransactionInterface;
use PayU\Framework\Processor;
use PayU\Model\Currency;
use PayU\Model\Total;
use PayU\Model\CardToken;
use PayU\Model\Customer;
use PayU\Model\CustomerDetail;
use PayU\Model\FundingInstrument;
use PayU\Framework\Action\Sale;
use PayU\Model\PaymentMethod;
use PayU\Model\Transaction;
use PayU\Framework\Soap\Context;

// ### CardToken
// Saved credit card id from a previous call to
// create-credit-card.php
$cardToken = new CardToken();
$cardToken->setId($pmId)
    ->setCvv('123');

// ### FundingInstrument
// A resource representing a Customer's funding instrument.
// For stored credit card payments, set the CardToken
// field on this object.
$funding = new FundingInstrument();
$funding->setCardToken($cardToken);

$customerDetail = new CustomerDetail();
$customerDetail->setCustomerId($userId);

// ### Customer
// A resource representing a Customer that funds a payment
// For stored credit card payments, set payment method to 'credit_card'.
$customer = new Customer();
$customer->setPaymentMethod(PaymentMethod::TYPE_REAL_TIME_RECURRING)
    ->setCustomerDetail($customerDetail)
    ->setFundingInstrument($funding);

// ### Amount
// Lets you specify a payment amount.
// You can also specify additional details
// such as shipping, tax.
$currency = new Currency();
$currency->setCode('ZAR');

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

// Setting integration will alter the way the API behaves.
$apiContext[0]->setAccountId('account1')
    ->setIntegration(Context::ENTERPRISE);

// ### Payment
// A Payment Resource; create one using
// the above types and intent set to 'sale'
$sale = new Sale();
$sale->setContext($apiContext[0])
    ->setTransactionType(TransactionInterface::TYPE_PAYMENT)
    ->setCustomer($customer)
    ->setTransaction($transaction);

// ###Create Payment
// Create a payment by calling the 'callDoTransaction' method
// passing it a valid apiContext.
// (See bootstrap.php for more on `Context`)
// The return object contains the state.
try {
    $response = Processor::processAction('sales', $sale);
} catch (Exception $ex) {
    // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
    ResultPrinter::printError("Create Real-Time Recurring Payment with token (pmId).", "Payment", null, $request, $ex);
    exit(1);
}

// NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
ResultPrinter::printResult("Create Real-Time Recurring Payment with token (pmId).", "Payment", $response->getPayUReference(), $request, $response);

return $response;
