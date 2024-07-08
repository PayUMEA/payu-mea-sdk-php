<?php

// # CreateDebitOrderSample
//
// This sample code demonstrate how you can process
// a debit order.

require __DIR__ . '/../../bootstrap.php';

use PayUSdk\Api\Data\CardInterface;
use PayUSdk\Api\Data\TransactionInterface;
use PayUSdk\Framework\Action\Sale;
use PayUSdk\Framework\Processor;
use PayUSdk\Framework\Soap\Context;
use PayUSdk\Model\Address;
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
use PayUSdk\Model\TransactionRecord;
use PayUSdk\Model\TransactionUrl;

// ### Address
// A resource representing a customer shipping/billing address information
$address = new Address();
$address->setLine1("21 Main Road")
    ->setLine2("Cape Town")
    ->setCity("Cape Town")
    ->setState("WC")
    ->setPostalCode("8000")
    ->setCountryCode("ZA");

// ### CreditCard
// A resource representing a payment card that can be
// used to fund a payment.
$card = new CreditCard();
$card->setType(CardInterface::TYPE_VISA)
    ->setNumber("4000015372250142")
    ->setExpiryMonth("11")
    ->setExpiryYear("2026")
    ->setCvv("123")
    ->setNameOnCard("John Snow")
    ->setBudget(false)
    ->setSecure3d(true)
    ->setBillingAddress(new BillingAddress($address->toArray()));

// ### FundingInstrument
// A resource representing a Customer's funding instrument.
// For direct credit card payments, set the CreditCard
// field on this object.
$funding = new FundingInstrument();
$funding->setCreditCard($card);

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
    ->setCustomerId('858')
    ->setAddress($address)
    ->setIpAddress('127.0.0.1');

// ### Customer
// A resource representing a Customer that funds a payment.
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
    ->setStartDate('2023/05/01')
    ->setStatementDescription('Subscription')
    ->setManagedBy('MERCHANT')
    ->setFrequency('W')
    ->setAnonymousUser(false)
    ->setCallCenterRepIds(['25', '56']);

$baseUrl = getBaseUrl();
$transactionUrl = new TransactionUrl();
$transactionUrl->setNotificationUrl('http://example.com/return')
    ->setResponseUrl("$baseUrl/process-return.php?apiContext=3")
    ->setCancelUrl("$baseUrl/process-return.php?cancel=true&apiContext=3");

// Redirect API integration.
$apiContext[3]->setAccountId('account4')
    ->setIntegration(Context::ENTERPRISE);

// ### Redirect
// A Redirect Payment Resource; create with intent set to 'debit_order'
$payment = new Sale();
$payment->setContext($apiContext[3])
    ->setTransactionType(TransactionInterface::TYPE_DEBIT_ORDER)
    ->setCustomer($customer)
    ->setTransaction($transaction)
    ->setTransactionUrl($transactionUrl)
    ->setTransactionRecord($transactionRecord);

// For Sample Purposes Only.
$request = clone $payment;

// ### Setup Redirect Debit Order
// Setup redirect by calling the redirect->setup() method
// with a valid Context (See bootstrap.php for more on `Context`)
// `getPayURedirectUrl` will return the url for redirection.
try {
    $response = Processor::processAction('sale', $payment);
} catch (Exception $ex) {
    // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
    ResultPrinter::printError('Create Debit Order Payment. If 500 Exception, check response for details', 'Redirect', null, $request, $ex);
    exit(1);
}

// NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
ResultPrinter::printResult("Create Debit Order Payment.", "Redirect", $response->getPayUReference(), $request, $response);


return $payment;
