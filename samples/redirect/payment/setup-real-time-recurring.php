<?php

// # CreateDebitOrderSample
//
// This sample code demonstrate how you can process
// a debit order.

require __DIR__ . '/../../bootstrap.php';

use PayU\Api\Data\TransactionInterface;
use PayU\Framework\Processor;
use PayU\Model\Address;
use PayU\Model\Total;
use PayU\Model\Customer;
use PayU\Model\CustomerDetail;
use PayU\Model\PaymentMethod;
use PayU\Framework\Action\Redirect;
use PayU\Model\TransactionUrl;
use PayU\Model\Transaction;
use PayU\Model\TransactionRecord;
use PayU\Framework\Soap\Context;

// ### Address
// A resource representing a customer shipping/billing address information
$address = new Address();
$address->setLine1("21 Main Road")
    ->setLine2("Cape Town")
    ->setCity("Cape Town")
    ->setState("WC")
    ->setPostalCode("8000")
    ->setCountryCode("ZA");

// ### CustomerDetail
// A resource representing a customer detailed information
$phone = new \PayU\Model\Phone();
$phone->setNationalNumber('0748523695')
    ->setCountryCode('27');
$customerDetail = new CustomerDetail();
$customerDetail->setFirstName('Test')
    ->setLastName('Customer')
    ->setEmail('test.customer@gmail.com')
    ->setPhone($phone)
    ->setCustomerId('854')
    ->setAddress($address)
    ->setIpAddress('127.0.0.1');

// ### Customer
// A resource representing a Customer that funds a payment.
$customer = new Customer();
$customer->setPaymentMethod(PaymentMethod::TYPE_REAL_TIME_RECURRING)
    ->setCustomerDetail($customerDetail);

// ### Amount
// Lets you specify a payment amount.
// You can also specify additional details
// such as shipping, tax.
$currency = new \PayU\Model\Currency();
$currency->setCode('ZAR');

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
$transactionUrl->setNotificationUrl("$baseUrl/process-return.php")
    ->setResponseUrl("$baseUrl/process-return.php?apiContext=4")
    ->setCancelUrl("$baseUrl/process-cancel.php?cancel=true&apiContext=4");

$transactionRecord = new TransactionRecord();
$transactionRecord->setRecurrences(6)
    ->setStartDate('2023/05/09')
    ->setStatementDescription('Subscription')
    ->setManagedBy('PAYU')
    ->setFrequency('W');

// Setting integration to `redirect` will alter the way the API behaves.
$apiContext[4]->setAccountId('account5')
    ->setIntegration(Context::REDIRECT);

// ### Redirect
// A Redirect Payment Resource; create one using
// the above types and intent set to sale 'payment'
$redirect = new Redirect();
$redirect->setContext($apiContext[4])
    ->setTransactionType(TransactionInterface::TYPE_PAYMENT)
    ->setCustomer($customer)
    ->setTransaction($transaction)
    ->setTransactionUrl($transactionUrl)
    ->setTransactionRecord($transactionRecord);

// ### Create Payment
// Create a payment by calling the payment->callSetTransaction method
// with a valid Context (See bootstrap.php for more on `Context`)
// The return object contains the state.
try {
    $response = Processor::processAction('setup', $redirect);
} catch (Exception $ex) {
    // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
    ResultPrinter::printError('Setup Debit Order. If 500 Exception, check return object for details', 'Redirect', null, $redirect, $ex);
    exit(1);
}

$rppUrl = $redirect->getPayURedirectUrl();

// NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
ResultPrinter::printResult("Setup Debit Order. Please visit the URL to complete setup.", "Redirect", "<a href='$rppUrl' >$rppUrl</a>", $redirect, $response);


return $response;
