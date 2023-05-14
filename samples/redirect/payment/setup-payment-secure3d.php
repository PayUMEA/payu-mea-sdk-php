<?php

// # CreatePaymentSample
//
// This sample code demonstrate how you can process
// a direct credit card payment.

require __DIR__ . '/../../bootstrap.php';

use PayU\Api\Data\TransactionInterface;
use PayU\Framework\Action\Redirect;
use PayU\Framework\Processor;
use PayU\Framework\Soap\Context;
use PayU\Model\Address;
use PayU\Model\Customer;
use PayU\Model\CustomerDetail;
use PayU\Model\Phone;
use PayU\Model\Total;
use PayU\Model\Transaction;
use PayU\Model\TransactionUrl;

$address = new Address();
$address->setLine1("80 Main Road")
    ->setLine2("Cape Town")
    ->setCity("Cape Town")
    ->setState("WC")
    ->setPostalCode("8000")
    ->setCountryCode("ZA");

$phone = new Phone();
$phone->setNationalNumber('0748523695')
    ->setCountryCode('27');

$customerDetail = new CustomerDetail();
$customerDetail->setFirstName('John')
    ->setLastName('Snow')
    ->setEmail('test.customer@example.com')
    ->setPhone($phone)
    ->setCustomerId('854')
    ->setAddress($address)
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
    ->setResponseUrl("$baseUrl/process-return.php?apiContext=0")
    ->setCancelUrl("$baseUrl/process-return.php?cancel=true&apiContext=0");

// Because default integration is redirect, setting integration to
// `enterprise` will alter the way the API behaves.
$apiContext[0]->setAccountId('account1')
    ->setIntegration(Context::REDIRECT);

// ### Payment
// A Payment Resource; create one using
// the above types and intent set to sale 'sale'
$redirect = new Redirect();
$redirect->setContext($apiContext[0])
    ->setTransactionType(TransactionInterface::TYPE_PAYMENT)
    ->setCustomer($customer)
    ->setTransaction($transaction)
    ->setTransactionUrl($transactionUrl);

// ### Create Payment
// Create a payment by calling the payment->doTransaction method
// with a valid Context (See bootstrap.php for more on `Context`)
// The return object contains the state.
try {
    $response = Processor::processAction('setup', $redirect);
} catch (Exception $ex) {
    // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
    ResultPrinter::printError('Setup Redirect Payment with Secure3D. If 500 Exception, check response for details.', 'Redirect', null, $redirect, $ex);
    exit(1);
}

$rppUrl = $redirect->getPayURedirectUrl();

// NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
ResultPrinter::printResult('Setup Redirect Payment with Secure3D. Please visit the URL to Capture your payment details.', 'Redirect', "<a href='$rppUrl' >$rppUrl</a>", $redirect, $response);

return $response;
