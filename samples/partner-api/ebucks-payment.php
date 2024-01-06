<?php

// # CreatePaymentSample
//
// This sample code demonstrate how you can process
// a direct credit card payment.

require __DIR__ . '/../bootstrap.php';

use PayUSdk\Api\Data\EbucksInterface;
use PayUSdk\Api\Data\TransactionInterface;
use PayUSdk\Framework\Action\Sale;
use PayUSdk\Framework\Processor;
use PayUSdk\Framework\Soap\Context;
use PayUSdk\Model\Address;
use PayUSdk\Model\Currency;
use PayUSdk\Model\Customer;
use PayUSdk\Model\CustomerDetail;
use PayUSdk\Model\Ebucks;
use PayUSdk\Model\FundingInstrument;
use PayUSdk\Model\PaymentMethod;
use PayUSdk\Model\Phone;
use PayUSdk\Model\Total;
use PayUSdk\Model\Transaction;
use PayUSdk\Model\TransactionUrl;

$address = new Address();
$address->setLine1("80 Main Road")
    ->setLine2("Cape Town")
    ->setCity("Cape Town")
    ->setState("WC")
    ->setPostalCode("8000")
    ->setCountryCode("ZA");

// ### Amount
// Lets you specify a payment amount.
// You can also specify additional details
// such as shipping, tax.
$currency = new Currency();
$currency->setCode('ZAR');

$total = new Total();
$total->setCurrency($currency)
    ->setAmount(200.00);

// ### Ebucks
// A resource representing an ebucks that can be
// used to fund a payment.
$ebucks = new Ebucks();
$ebucks->setAction(EbucksInterface::PAYMENT)
    ->setEbucksOTP('909059')
    ->setEbucksAccountNumber('80000278865')
    ->setEbucksAmount('200');

// ### FundingInstrument
// A resource representing a Customer's funding instrument.
// For direct credit card payments, set the CreditCard
// field on this object.
$funding = new FundingInstrument();
$funding->setEbucks($ebucks);

$phone = new Phone();
$phone->setNationalNumber('0748523695')
    ->setCountryCode('27');

$customerDetail = new CustomerDetail();
$customerDetail->setFirstName('John')
    ->setLastName('Snow')
    ->setEmail('john.snow@example.com')
    ->setPhone($phone)
    ->setCustomerId('858')
    ->setAddress($address)
    ->setIpAddress('127.0.0.1');

// ### Customer
// A resource representing a Customer that funds a payment
// For direct credit card payments, set payment method
// to 'credit_card' and add an array of funding instruments.
$customer = new Customer();
$customer->setPaymentMethod(PaymentMethod::TYPE_EBUCKS)
    ->setCustomerDetail($customerDetail)
    ->setFundingInstrument($funding);

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

// Because default integration is redirect, setting integration to
// `enterprise` will alter the way the API behaves.
$apiContext[1]->setAccountId('account2')
    ->setIntegration(Context::ENTERPRISE);

// ### Payment
// A Payment Resource; create one using
// the above types and intent set to sale 'sale'
$sale = new Sale();
$sale->setContext($apiContext[1])
    ->setCustomer($customer)
    ->setTransaction($transaction)
    ->setTransactionUrl($transactionUrl)
    ->setTransactionType(TransactionInterface::TYPE_PAYMENT);

// ### Create Payment
// Create a payment by calling the payment->create() method
// with a valid Context (See bootstrap.php for more on `Context`)
// The returned object contains the state as well as other details of the
// transaction.
try {
    $response = Processor::processAction('sale', $sale);
} catch (Exception $ex) {
    // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
    ResultPrinter::printError('Create Payment Using eBucks. If 500 Exception, check the details of the response', 'Payment', null, $sale, $ex);
    exit(1);
}

// NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
ResultPrinter::printResult('Create Payment Using eBucks', 'Payment', $response->getPayUReference(), $sale, $response);

return $response;
