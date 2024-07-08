<?php

// # CreatePaymentSample
//
// This sample code demonstrate how you can process
// a direct credit card payment.

require __DIR__ . '/../bootstrap.php';

use PayUSdk\Api\Data\TransactionInterface;
use PayUSdk\Framework\Processor;
use PayUSdk\Model\Phone;
use PayUSdk\Model\Total;
use PayUSdk\Model\CreditCard;
use PayUSdk\Model\Currency;
use PayUSdk\Model\Customer;
use PayUSdk\Model\CustomerDetail;
use PayUSdk\Model\FundingInstrument;
use PayUSdk\Model\Address;
use PayUSdk\Framework\Action\Sale;
use PayUSdk\Api\Data\CardInterface;
use PayUSdk\Model\PaymentMethod;
use PayUSdk\Model\TransactionUrl;
use PayUSdk\Model\Transaction;
use PayUSdk\Framework\Soap\Context;

// ### PaymentCard
// A resource representing a payment card that can be
// used to fund a payment.
$card = new CreditCard();
$card->setType(CardInterface::TYPE_MASTERCARD)
    ->setNumber("5100011063555010")
    ->setExpiryMonth("11")
    ->setExpiryYear("2027")
    ->setCvv("123")
    ->setNameOnCard("John Snow")
    ->setSecure3D(true)
    ->setBudget(false);

// ### FundingInstrument
// A resource representing a Customer's funding instrument.
// For direct credit card payments, set the CreditCard
// field on this object.
$funding = new FundingInstrument();
$funding->setCreditCard($card)
    ->setSaveCard(true);

$address = new Address();
$address->setLine1('123 ABC Street')
    ->setLine2("Ferndale")
    ->setCity('Johannesburg')
    ->setState('Gauteng')
    ->setPostalCode('2000')
    ->setCountryCode("ZA");

$phone = new Phone(
    [
        'country_code' => '27',
        'national_number' => '748523695'
    ]
);
$customerDetail = new CustomerDetail();
$customerDetail->setFirstName('John')
    ->setLastName('Snow')
    ->setEmail('test.customer@example.com')
    ->setIpAddress('127.0.0.1')
    ->setPhone($phone)
    ->setCustomerId('857')
    ->setAddress($address);

// ### Customer
// A resource representing a Customer that funds a payment
// For direct credit card payments, set payment method
// to 'credit_card' and add an array of funding instruments.
$customer = new Customer();
$customer->setPaymentMethod(PaymentMethod::TYPE_REAL_TIME_RECURRING)
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
$transactionUrl->setNotificationUrl('https://example.com/return')
    ->setResponseUrl("$baseUrl/process-return.php?apiContext=6")
    ->setCancelUrl("$baseUrl/process-return.php?cancel=true&apiContext=6");

// Setting integration to `redirect` will alter the way the API behaves.
$apiContext[6]->setAccountId('account7')
    ->setIntegration(Context::ENTERPRISE);

// ### Payment
// A Payment Resource; create one using
// the above types and intent set to sale 'reserve'
$sale = new Sale();
$sale->setTransactionType(TransactionInterface::TYPE_RESERVE)
    ->setContext($apiContext[6])
    ->setCustomer($customer)
    ->setTransaction($transaction)
    ->setTransactionUrl($transactionUrl);

// ### Create Payment
// Create a payment by calling the payment->callDoTransaction method
// with a valid Context (See bootstrap.php for more on `Context`)
// The response object retrieved by calling `getReturn` on the payment object contains the state.
try {
    $response = Processor::processAction('sale', $sale);
} catch (Exception $ex) {
    // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
    ResultPrinter::printError("Setup Real-Time Recurring", "Payment", null, $sale, $ex);
    exit(1);
}

// NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
ResultPrinter::printResult('Setup Real-Time Recurring', 'Payment', $response->getPayUReference(), $sale, $response);

return [$sale, $response];
