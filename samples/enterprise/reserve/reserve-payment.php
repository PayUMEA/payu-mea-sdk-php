<?php
// # Authorize Payment
// This sample code demonstrates how you can authorize a payment.

require __DIR__ . '/../../bootstrap.php';

use PayU\Api\Data\TransactionInterface;
use PayU\Framework\Processor;
use PayU\Model\Address;
use PayU\Model\Currency;
use PayU\Model\Phone;
use PayU\Model\Total;
use PayU\Model\CreditCard;
use PayU\Model\Customer;
use PayU\Model\CustomerDetail;
use PayU\Model\FundingInstrument;
use PayU\Api\Data\CardInterface;
use PayU\Model\PaymentMethod;
use PayU\Model\TransactionUrl;
use PayU\Framework\Action\Authorize;
use PayU\Model\Transaction;
use PayU\Framework\Soap\Context;

// The biggest difference between creating a payment, and authorizing a payment is to set the intent of payment
// to correct setting. In this case, it would be 'reserve'
$addr = new Address();
$addr->setLine1("21 Main Road")
    ->setLine2("Cape Town")
    ->setCity("Cape Town")
    ->setState("WC")
    ->setPostalCode("8000")
    ->setCountryCode("ZA");

$creditCard = new CreditCard();
$creditCard->setType(CardInterface::TYPE_MASTERCARD)
    ->setNumber("5100011063555010")
    ->setExpiryMonth("11")
    ->setExpiryYear("2026")
    ->setCvv("123")
    ->setNameOnCard("Joe Soap")
    ->setBillingAddress($addr);

$funding = new FundingInstrument();
$funding->setCreditCard($creditCard);

$phone = new Phone();
$phone->setNationalNumber('0748523695')
    ->setCountryCode('27');

$customerDetail = new CustomerDetail();
$customerDetail->setFirstName('Joe')
    ->setLastName('Soap')
    ->setEmail('joe.soap@example.com')
    ->setPhone($phone)
    ->setCustomerId('854')
    ->setAddress($addr)
    ->setIPAddress('127.0.0.1');

$customer = new Customer();
$customer->setPaymentMethod(PaymentMethod::TYPE_CREDITCARD)
    ->setFundingInstrument($funding)
    ->setCustomerDetail($customerDetail);

$currency = new Currency(['amount' => 100, 'code' => "ZAR"]);
$total = new Total();
$total->setCurrency($currency)
    ->setAmount(100);

$transaction = new Transaction();
$transaction->setTotal($total)
    ->setDescription("Payment description.")
    ->setReference(uniqid('payu'));

$baseUrl = getBaseUrl();
$transactionUrl = new TransactionUrl();
$transactionUrl->setNotificationUrl('http://example.com/return')
    ->setResponseUrl("$baseUrl/process-return.php?apiContext=2")
    ->setCancelUrl("$baseUrl/process-return.php?cancel=true&apiContext=2");

// Setting integration will alter the way the API behaves.
$apiContext[0]->setAccountId('account1')
    ->setIntegration(Context::ENTERPRISE);

// Setting intent to reserve creates a payment
// authorization. Setting it to payment creates actual payment
$reserve = new Authorize();
$reserve->setContext($apiContext[0])
    ->setTransactionType(TransactionInterface::TYPE_RESERVE)
    ->setCustomer($customer)
    ->setTransaction($transaction)
    ->setTransactionUrl($transactionUrl);

// For Sample Purposes Only.
$request = clone $reserve;

// ### Create Payment
// Create an authorization by calling the payment->callDoTransaction() method
// with a valid Context (See bootstrap.php for more on `Context`)
// The return/response object contains the various information about the payment.
try {
    $response = Processor::processAction('authorize', $reserve);
} catch (Exception $ex) {
    // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
    ResultPrinter::printError('Authorize/Reserve Payment', 'Reserve', null, $request, $ex);
    exit(1);
}

// NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
ResultPrinter::printResult('Authorize/Reserve Payment', 'Reserve', $response->getPayUReference(), $request, $response);

return $response;
