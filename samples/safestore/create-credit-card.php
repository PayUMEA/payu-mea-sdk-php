<?php

// # CreatePaymentSample
//
// This sample code demonstrate how you can process
// a direct credit card payment.

require dirname(__DIR__) . '/bootstrap.php';

use PayU\Api\Data\TransactionInterface;
use PayU\Framework\Processor;
use PayU\Model\Address;
use PayU\Model\CreditCard;
use PayU\Model\Phone;
use PayU\Model\Total;
use PayU\Model\Currency;
use PayU\Model\Customer;
use PayU\Model\CustomerDetail;
use PayU\Model\FundingInstrument;
use PayU\Framework\Action\Sale;
use PayU\Api\Data\CardInterface;
use PayU\Model\PaymentMethod;
use PayU\Model\TransactionUrl;
use PayU\Model\Transaction;
use PayU\Framework\Soap\Context;

// ### PaymentCard
// A resource representing a payment card that can be
// used to fund a payment.
$card = new CreditCard();
$card->setType(CardInterface::TYPE_MASTERCARD)
    ->setNumber("5100011063555010")
    ->setExpiryMonth("11")
    ->setExpiryYear("2028")
    ->setCvv("123")
    ->setNameOnCard("John Snow")
    ->setSecure3d(true)
    ->setBudget(false);

// ### FundingInstrument
// A resource representing a Customer's funding instrument.
// For direct credit card payments, set the CreditCard
// field on this object.
$funding = new FundingInstrument();
$funding->setCreditCard($card)
    ->setSaveCard(true);

$address = new Address();
$address->setLine1('21 Main Road')
    ->setLine2('Cape Town')
    ->setCity('Cape Town')
    ->setState('WC')
    ->setPostalCode('2000');

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

// ### Payment
// A Payment Resource; create one using
// the above types and intent set to sale 'reserve'
$sale = new Sale();
$sale->setContext($apiContext[6])
    ->setTransactionType(TransactionInterface::TYPE_PAYMENT)
    ->setCustomer($customer)
    ->setTransaction($transaction)
    ->setTransactionUrl($transactionUrl);

// Setting integration to `redirect` will alter the way the API behaves.
$apiContext[6]->setAccountId('account7')
    ->setIntegration(Context::ENTERPRISE);

// ### Create Payment
// Create a payment by calling the payment->callDoTransaction method
// with a valid Context (See bootstrap.php for more on `Context`)
// The response object retrieved by calling `getReturn` on the payment object contains the state.
try {
    $response = Processor::processAction('sale', $sale);
} catch (Exception $ex) {
    // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
    ResultPrinter::printError("Create Payment and Save Credit Card", "Payment", null, $sale, $ex);
    exit(1);
}

// NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
ResultPrinter::printResult('Create Payment and Save Credit Card', 'Payment', $response->getPayUReference(), $sale, $response);

return [$sale, $response];
