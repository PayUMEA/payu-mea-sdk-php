<?php

// # CreatePaymentSample
//
// This sample code demonstrate how you can process
// a direct credit card payment.

require __DIR__ . '/../bootstrap.php';

use PayU\Api\Data\EftInterface;
use PayU\Api\Data\TransactionInterface;
use PayU\Framework\Processor;
use PayU\Model\Address;
use PayU\Model\Currency;
use PayU\Model\Phone;
use PayU\Model\Total;
use PayU\Model\Customer;
use PayU\Model\CustomerDetail;
use PayU\Model\FundingInstrument;
use PayU\Framework\Action\Sale;
use PayU\Model\PaymentMethod;
use PayU\Model\TransactionUrl;
use PayU\Model\SmartEFT;
use PayU\Model\Transaction;
use PayU\Framework\Soap\Context;

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
$currency = new Currency(['code' => 'ZAR']);
$total = new Total();
$total->setCurrency($currency)
    ->setAmount(200.00);

// For sample purposes
$bankNames = [
    EftInterface::FNB,
    EftInterface::ABSA,
    EftInterface::NEDBANK,
    EftInterface::STANDARD_BANK
];
shuffle($bankNames);
$bankName = array_shift($bankNames);

// ### Eft
// A resource representing an eft that can be
// used to fund a payment.

$smartEft = new SmartEFT();
$smartEft->setBankName($bankName)
    ->setCurrency($currency)
    ->setAmount($total->getAmount());

// ### FundingInstrument
// A resource representing a Customer's funding instrument.
$funding = new FundingInstrument();
$funding->setEft($smartEft);

$phone = new Phone();
$phone->setCountryCode('27')
    ->setNationalNumber('0748523695');

$customerDetail = new CustomerDetail();
$customerDetail->setFirstName('Test')
    ->setLastName('Customer')
    ->setEmail('test.customer@example.com')
    ->setPhone($phone)
    ->setCustomerId('858')
    ->setIpAddress('127.0.0.1')
    ->setAddress($address);

// ### Customer
// A resource representing a Customer that funds a payment.
$customer = new Customer();
$customer->setPaymentMethod(PaymentMethod::TYPE_SMARTEFT)
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
// A Payment Resource; create one with intent set to 'payment'
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
    ResultPrinter::printError('Create Payment Using Smart EFT. If 500 Exception, check response for details.', 'Payment', null, $sale, $ex);
    exit(1);
}

//$url = $payment->getEftProUrl();

// NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
ResultPrinter::printResult('Create Payment Using Smart EFT. "paymentMethodsUsed" key is where the customer will need to deposit the monies into.', 'Payment', $response->getPayUReference(), $sale, $response);

return $response;
