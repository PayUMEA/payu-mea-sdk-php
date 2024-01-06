<?php

// # EFTPaymentSample
//
// This sample code demonstrate how you can process
// an EFT payment.

require __DIR__ . '/../bootstrap.php';

use PayUSdk\Api\Data\TransactionInterface;
use PayUSdk\Framework\Processor;
use PayUSdk\Model\Address;
use PayUSdk\Model\Currency;
use PayUSdk\Model\Phone;
use PayUSdk\Model\Total;
use PayUSdk\Model\Customer;
use PayUSdk\Model\CustomerDetail;
use PayUSdk\Model\EftPro;
use PayUSdk\Model\FundingInstrument;
use PayUSdk\Framework\Action\Sale;
use PayUSdk\Model\PaymentMethod;
use PayUSdk\Model\TransactionUrl;
use PayUSdk\Model\Transaction;
use PayUSdk\Framework\Soap\Context;

$addr = new Address();
$addr->setLine1("80 Main Road")
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
    ->setAmount(200.05);

// ### Eft
// A resource representing an eft that can be
// used to fund a payment.

$eftPro = new EftPro();
$eftPro->setCurrency($currency);
$eftPro->setAmount($total->getAmount());

// ### FundingInstrument
// A resource representing a Customer's funding instrument.
$funding = new FundingInstrument();
$funding->setEft($eftPro);

$phone = new Phone(
    [
        'country_code' => '27',
        'national_number' => '0748523695'
    ]
);
$customerDetail = new CustomerDetail();
$customerDetail->setFirstName('Test')
    ->setLastName('Customer')
    ->setEmail('test.customer@example.com')
    ->setPhone($phone)
    ->setCustomerId('858')
    ->setIpAddress('127.0.0.1');

// ### Customer
// A resource representing a Customer that funds a payment.
$customer = new Customer();
$customer->setPaymentMethod(PaymentMethod::TYPE_EFT_PRO)
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
    ResultPrinter::printError('Create Payment Using EFT Pro. If 500 Exception, check response for details.', 'Payment', null, $sale, $ex);
    exit(1);
}

$url = $sale->getEftProUrl();

// NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
ResultPrinter::printResult('Create Payment Using EFT Pro. Please visit the URL to choose your bank.', 'Payment', "<a href='$url' >$url</a>", $sale, $response);

return $response;
