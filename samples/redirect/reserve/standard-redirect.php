<?php

// # CreateRedirectPaymentSample
//
// This sample code demonstrate how you can process
// a redirect payment.

require __DIR__ . '/../../bootstrap.php';

use PayU\Api\Data\TransactionInterface;
use PayU\Framework\Processor;
use PayU\Model\Address;
use PayU\Model\Total;
use PayU\Model\Customer;
use PayU\Model\CustomerDetail;
use PayU\Framework\Action\Redirect;
use PayU\Model\TransactionUrl;
use PayU\Model\Transaction;
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
    ->setEmail('test.customer@example.com')
    ->setPhone($phone)
    ->setCustomerId('854')
    ->setAddress($address)
    ->setIPAddress('127.0.0.1');

// ### Customer
// A resource representing a Customer that funds a payment.
$customer = new Customer();
$customer->setCustomerDetail($customerDetail);

// ### Amount
// Lets you specify a payment amount.
// You can also specify additional details
// such as shipping, tax.
$currency = new \PayU\Model\Currency();
$currency->setCode('ZAR');

$total = new Total();
$total->setCurrency($currency)
    ->setAmount(2000.00);

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
    ->setResponseUrl("$baseUrl/process-return.php?apiContext=1")
    ->setCancelUrl("$baseUrl/process-return.php?cancel=true&apiContext=1");

// Setting integration to `redirect` will alter the way the API behaves.
$apiContext[1]->setAccountId('account2')
    ->setIntegration(Context::REDIRECT);

// ### Redirect
// A Redirect Payment Resource; create one using
// the above types and intent set to sale 'payment'
$redirect = new Redirect();
$redirect->setContext($apiContext[1])
    ->setTransactionType(TransactionInterface::TYPE_RESERVE)
    ->setCustomer($customer)
    ->setTransaction($transaction)
    ->setTransactionUrl($transactionUrl);

// ### Setup redirect
// Setup redirect payment by calling the payment->setup() method
// with a valid Context (See bootstrap.php for more on `Context`)
// The PayU redirect url is obtained by calling `getPayURedirectUrl` on the redirect object
try {
    $response = Processor::processAction('setup', $redirect);
} catch (Exception $ex) {
    // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
    ResultPrinter::printError('Setup Redirect (Reserve). If 500 Exception, try creating a new Redirect Payment transaction', 'Redirect', null, $redirect, $ex);
    exit(1);
}

$rppUrl = $redirect->getPayURedirectUrl();

// NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
ResultPrinter::printResult("Setup Redirect (Reserve). Please visit the URL to Capture your payment details.", "Redirect", "<a href='$rppUrl' >$rppUrl</a>", $redirect, $response);


return $response;
