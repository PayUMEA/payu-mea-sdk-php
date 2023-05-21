<?php

// # CreateRedirectPaymentSample
//
// This sample code demonstrate how you can process
// a redirect payment process.

require __DIR__ . '/../bootstrap.php';

use PayU\Framework\Action\Redirect;
use PayU\Framework\Processor;
use PayU\Framework\Soap\Context;
use PayU\Model\Address;
use PayU\Model\Currency;
use PayU\Model\Customer;
use PayU\Model\CustomerDetail;
use PayU\Model\Phone;
use PayU\Model\Total;
use PayU\Model\Transaction;
use PayU\Model\TransactionUrl;

// ### Address
// A resource representing a customer shipping/billing address information
$addr = new Address();
$addr->setLine1("3909 Witmer Road")
    ->setLine2("Niagara Falls")
    ->setCity("Niagara Falls")
    ->setState("GP")
    ->setPostalCode("14305")
    ->setCountryCode("ZA");

// ### CustomerDetail
// A resource representing a customer detailed information
$phone = new Phone();
$phone->setNationalNumber('0748523695')
    ->setCountryCode('27');

$customerDetail = new CustomerDetail();
$customerDetail->setFirstName('Test')
    ->setLastName('Customer')
    ->setEmail('test.customer@example.com')
    ->setPhone($phone)
    ->setCustomerId('855')
    ->setAddress($addr)
    ->setIpAddress('127.0.0.1');

// ### Customer
// A resource representing a Customer that funds a payment
// For direct credit card payments, set payment method
// to 'credit_card' and add an array of funding instruments.
$customer = new Customer();
$customer->setCustomerDetail($customerDetail);

// ### Amount
// Lets you specify a payment amount.
// You can also specify additional details
// such as shipping, tax.
$currency = new Currency(['code' => 'ZAR']);
$total = new Total();
$total->setCurrency($currency)
    ->setAmount(200.00);

// ### Transaction
// A transaction defines the contract of a
// payment - what is the payment for and who
// is fulfilling it.
$transaction = new Transaction();
$transaction->setTotal($total)
    ->setDescription("Payment description")
    ->setReference(uniqid('payu'));

$baseUrl = getBaseUrl();
$transactionUrl = new TransactionUrl();
$transactionUrl->setNotificationUrl("$baseUrl/process-ipn.php")
    ->setResponseUrl("$baseUrl/process-return.php")
    ->setCancelUrl("$baseUrl/process-cancel.php");

// Setting integration to `redirect` will alter the way the API behaves.
$apiContext[1]->setAccountId('account2')
    ->setIntegration(Context::REDIRECT);

// ### Redirect
// A Redirect Payment Resource; create one using
// the above types and intent set to sale 'payment'
$redirect = new Redirect();
$redirect->setContext($apiContext[1])
    ->setTransactionType(Transaction::TYPE_PAYMENT)
    ->setCustomer($customer)
    ->setTransaction($transaction)
    ->setTransactionUrl($transactionUrl);

// ### Create Payment
// Create a payment by calling the payment->callSetTransaction method
// with a valid Context (See bootstrap.php for more on `Context`)
// The return object contains the state.
try {
    $response = Processor::processAction('setup', $redirect);
} catch (Exception $ex) {
    // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
    ResultPrinter::printError('Setup Redirect Payment. If 500 Exception, check response details', 'Redirect', null, $redirect, $ex);
    exit(1);
}

// NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
ResultPrinter::printResult("Setup Redirect Payment", "Redirect", $response->getPayUReference(), $redirect, $response);

return $response;

