<?php

// # CreatePaymentSample
//
// This sample code demonstrate how you can process
// a direct credit card payment.

require __DIR__ . '/../bootstrap.php';

use PayUSdk\Api\Data\CardInterface;
use PayUSdk\Api\Data\TransactionInterface;
use PayUSdk\Framework\Action\Authorize;
use PayUSdk\Framework\Processor;
use PayUSdk\Framework\Soap\Context;
use PayUSdk\Model\BillingAddress;
use PayUSdk\Model\CreditCard;
use PayUSdk\Model\Currency;
use PayUSdk\Model\Customer;
use PayUSdk\Model\CustomerDetail;
use PayUSdk\Model\FundingInstrument;
use PayUSdk\Model\PaymentMethod;
use PayUSdk\Model\Phone;
use PayUSdk\Model\Total;
use PayUSdk\Model\Transaction;
use PayUSdk\Model\TransactionUrl;

// ### Address
$address = new BillingAddress();
$address->setLine1('123 ABC Street')
    ->setLine2('Cape Town')
    ->setCity('Johannesburg')
    ->setState('Gauteng')
    ->setPostalCode('2000')
    ->setCountryCode('ZA');

// ### PaymentCard
// A resource representing a payment card that can be
// used to fund a payment.
$card = new CreditCard();
$card->setType(CardInterface::TYPE_VISA)
    ->setNumber("4000019542438801")
    ->setExpiryMonth("11")
    ->setExpiryYear("2026")
    ->setCvv("123")
    ->setNameOnCard("John Snow")
    ->setBillingAddress($address);

// ### FundingInstrument
// A resource representing a Customer's funding instrument.
// For direct credit card payments, set the CreditCard
// field on this object.
$funding = new FundingInstrument();
$funding->setCreditCard($card)
    ->setSaveCard(true);

$phone = new Phone();
$phone->setNationalNumber('0748523695')
    ->setCountryCode('27');

$customerDetail = new CustomerDetail();
$customerDetail->setFirstName('Test')
    ->setLastName('Customer')
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
$customer->setPaymentMethod(PaymentMethod::TYPE_CREDITCARD)
    ->setCustomerDetail($customerDetail)
    ->setFundingInstrument($funding);

// ### Amount
// Lets you specify a payment amount.
// You can also specify additional details
// such as shipping, tax.
$currency = new Currency(['code' => 'ZAR']);
$total = new Total();
$total->setCurrency($currency)
    ->setAmount(175.50);

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
$transactionUrl->setNotificationUrl("$baseUrl/process-ipn")
    ->setResponseUrl("$baseUrl/process-return.php?apiContext=0")
    ->setCancelUrl("$baseUrl/process-return.php?cancel=true&apiContext=0");

// Setting integration to `redirect` will alter the way the API behaves.
$apiContext[0]->setAccountId('account1')
    ->setIntegration(Context::ENTERPRISE);

// ### Payment
// A Payment Resource; create one using
// the above types and intent set to sale 'sale'
$authorize = new Authorize();
$authorize->setContext($apiContext[0])
    ->setTransactionType(TransactionInterface::TYPE_RESERVE)
    ->setCustomer($customer)
    ->setTransaction($transaction)
    ->setTransactionUrl($transactionUrl);

// ### Create Payment
// Create a payment by calling the payment->callDoTransaction method
// with a valid Context (See bootstrap.php for more on `Context`)
// The response object retrieved by calling `getReturn()` on the payment resource the contains the state.
try {
    $response = Processor::processAction('authorize', $authorize);
} catch (Exception $ex) {
    // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
    ResultPrinter::printError("Create Authorized/Reserved Payment", "Reserve", null, $authorize, $ex);
    exit(1);
}

// NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
ResultPrinter::printResult("Create Authorized/Reserved Payment", "Reserve", $response->getPayUReference(), $authorize, $response);

return $response;
