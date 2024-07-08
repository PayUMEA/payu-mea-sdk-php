<?php

// # CreatePaymentSample
//
// This sample code demonstrate how you can process
// a direct credit card payment.

require __DIR__ . '/../../bootstrap.php';

use PayUSdk\Api\Data\TransactionInterface;
use PayUSdk\Framework\Processor;
use PayUSdk\Model\Phone;
use PayUSdk\Model\Total;
use PayUSdk\Api\Data\CardInterface;
use PayUSdk\Model\BillingAddress;
use PayUSdk\Model\CreditCard;
use PayUSdk\Model\Currency;
use PayUSdk\Model\Customer;
use PayUSdk\Model\CustomerDetail;
use PayUSdk\Model\FundingInstrument;
use PayUSdk\Framework\Action\Sale;
use PayUSdk\Model\PaymentMethod;
use PayUSdk\Model\TransactionUrl;
use PayUSdk\Model\Transaction;
use PayUSdk\Framework\Soap\Context;

$address = new BillingAddress();
$address->setLine1("80 Main Road")
    ->setLine2("Cape Town")
    ->setCity("Cape Town")
    ->setState("Western Cape")
    ->setPostalCode("8000")
    ->setCountryCode("ZA");

// ### CreditCard
// A resource representing a payment card that can be
// used to fund a payment.
$card = new CreditCard();
$card->setType(CardInterface::TYPE_VISA)
    ->setNumber("4000015372250142")
    ->setExpiryMonth("11")
    ->setExpiryYear("2028")
    ->setCvv("123")
    ->setBudget(false)
    ->setSecure3d(true)
    ->setNameOnCard("Mr John Snow")
    ->setBillingAddress($address);

// ### FundingInstrument
// A resource representing a Customer's funding instrument.
// For direct credit card payments, set the CreditCard
// field on this object.
$funding = new FundingInstrument();
$funding->setCreditCard($card);

$phone = new Phone();
$phone->setNationalNumber('0748523695')
    ->setCountryCode('27');

$customerDetail = new CustomerDetail();
$customerDetail->setFirstName('John')
    ->setLastName('Snow')
    ->setEmail('test.customer@example.com')
    ->setPhone($phone)
    ->setCustomerId('854')
    ->setIPAddress('127.0.0.1')
    ->setAddress($address);

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
$transactionUrl->setNotificationUrl("$baseUrl/process-ipn")
    ->setResponseUrl("$baseUrl/process-return.php?apiContext=6")
    ->setCancelUrl("$baseUrl/process-return.php?cancel=true&apiContext=6");

// Because default integration is redirect, setting integration to
// `enterprise` will alter the way the API behaves.
$apiContext[6]->setAccountId('account7')
    ->setIntegration(Context::ENTERPRISE);

// ### Payment
// A Payment Resource; create one using
// the above types and intent set to sale 'sale'
$payment = new Sale();
$payment->setContext($apiContext[6])
    ->setTransactionType(TransactionInterface::TYPE_PAYMENT)
    ->setCustomer($customer)
    ->setTransaction($transaction)
    ->setTransactionUrl($transactionUrl);

// For Sample Purposes Only.
$request = clone $payment;

// ### Create Payment
// Create a payment by calling the payment->doTransaction method
// with a valid Context (See bootstrap.php for more on `Context`)
// The return object contains the state.
try {
    $response = Processor::processAction('sale', $payment);
} catch (Exception $ex) {
    // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
    ResultPrinter::printError('Create Payment Using Credit Card. If 500 Exception, try creating a new Credit Card', 'Payment', null, $request, $ex);
    exit(1);
}

// NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
ResultPrinter::printResult('Create Payment Using Credit Card', 'Payment', $response->getPayUReference(), $request, $response);

return $payment;
