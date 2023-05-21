<?php

// # CreateRedirectPaymentSample
//
// This sample code demonstrate how you can process
// a redirect payment.

require dirname(__DIR__, 2) . '/bootstrap.php';

use PayU\Api\Data\TransactionInterface;
use PayU\Framework\Processor;
use PayU\Model\Address;
use PayU\Model\Currency;
use PayU\Model\Phone;
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
$phone = new Phone();
$phone->setCountryCode('27')
    ->setNationalNumber('0748523695');

$customerDetail = new CustomerDetail();
$customerDetail->setFirstName('Test')
    ->setLastName('Customer')
    ->setEmail('test.customer@example.com')
    ->setPhone($phone)
    ->setCustomerId('857')
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
$currency = new Currency();
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
    ->setResponseUrl("$baseUrl/process-return.php?apiContext=1")
    ->setCancelUrl("$baseUrl/process-return.php?cancel=true&apiContext=1");

// Setting integration to `redirect` will alter the way the API behaves.
$apiContext[1]->setAccountId('acct2')
    ->setIntegration(Context::REDIRECT);

// ### Redirect
// A Redirect Payment Resource; create one with intent set to 'payment'
$redirect = new Redirect();
$redirect->setContext($apiContext[1])
    ->setTransactionType(TransactionInterface::TYPE_PAYMENT)
    ->setCustomer($customer)
    ->setTransaction($transaction)
    ->setTransactionUrl($transactionUrl);

// ### Setup redirect
// Setup redirect payment by calling the redirect->setup() method
// with a valid Context (See bootstrap.php for more on `Context`)
// `getPayURedirectUrl` will return the url for redirection.
try {
    $response = Processor::processAction('setup', $redirect);
} catch (Exception $ex) {
    // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
    ResultPrinter::printError('Setup Redirect Payment. If 500 Exception, check response for details.', 'Redirect', null, $redirect, $ex);
    exit(1);
}

$rppUrl = $redirect->getPayURedirectUrl();

// NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
ResultPrinter::printResult("Setup Redirect Payment. Please visit the URL to Capture your payment details.", "Redirect", "<a href='$rppUrl' >$rppUrl</a>", $redirect, $response);


return $redirect;
