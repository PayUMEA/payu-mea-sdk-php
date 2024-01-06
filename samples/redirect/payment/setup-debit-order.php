<?php

// # CreateDebitOrderSample
//
// This sample code demonstrate how you can process
// a debit order.

require __DIR__ . '/../../bootstrap.php';

use PayUSdk\Api\Data\TransactionInterface;
use PayUSdk\Framework\Processor;
use PayUSdk\Model\Address;
use PayUSdk\Model\Phone;
use PayUSdk\Model\Total;
use PayUSdk\Model\Customer;
use PayUSdk\Model\CustomerDetail;
use PayUSdk\Framework\Action\Redirect;
use PayUSdk\Model\TransactionUrl;
use PayUSdk\Model\Transaction;
use PayUSdk\Model\TransactionRecord;
use PayUSdk\Framework\Soap\Context;

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
$phone = new Phone();
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
$customer->setCustomerDetail($customerDetail);

// ### Amount
// Lets you specify a payment amount.
// You can also specify additional details
// such as shipping, tax.
$currency = new \PayUSdk\Model\Currency();
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

// A transaction record defines the debit order transaction details.
$transactionRecord = new TransactionRecord();
$transactionRecord->setRecurrences(6)
    ->setStartDate('2023/05/09')
    ->setStatementDescription('Subscription of All life life insurance')
    ->setManagedBy('PAYU')
    ->setFrequency('W');

$baseUrl = getBaseUrl();
$transactionUrl = new TransactionUrl();
$transactionUrl->setNotificationUrl("$baseUrl/process-return.php")
    ->setResponseUrl("$baseUrl/process-return.php?apiContext=3")
    ->setCancelUrl("$baseUrl/process-return.php?cancel=true&apiContext=3");

// Redirect API integration.
$apiContext[3]->setAccountId('account4')
    ->setIntegration(Context::REDIRECT);

// ### Redirect
// A Redirect Payment Resource; create with intent set to 'debit_order'
$redirect = new Redirect();
$redirect->setContext($apiContext[3])
    ->setTransactionType(TransactionInterface::TYPE_DEBIT_ORDER)
    ->setCustomer($customer)
    ->setTransaction($transaction)
    ->setTransactionUrl($transactionUrl)
    ->setTransactionRecord($transactionRecord);

// ### Setup Redirect Debit Order
// Setup redirect by calling the redirect->setup() method
// with a valid Context (See bootstrap.php for more on `Context`)
// `getPayURedirectUrl` will return the url for redirection.
try {
    $response = Processor::processAction('setup', $redirect);
} catch (Exception $ex) {
    // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
    ResultPrinter::printError('Setup Debit Order. If 500 Exception, check response for details', 'Redirect', null, $redirect, $ex);
    exit(1);
}

$rppUrl = $redirect->getPayURedirectUrl();

// NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
ResultPrinter::printResult("Setup Debit Order. Please visit the URL to complete setup.", "Redirect", "<a href='$rppUrl' >$rppUrl</a>", $redirect, $response);


return $response;
