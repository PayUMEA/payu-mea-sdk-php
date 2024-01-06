<?php

// # CreatePaymentSample
//
// This sample code demonstrate how you can process
// a direct credit card payment.

require __DIR__ . '/../../bootstrap.php';

use PayUSdk\Api\Data\TransactionInterface;
use PayUSdk\Framework\Action\Redirect;
use PayUSdk\Framework\Processor;
use PayUSdk\Framework\Soap\Context;
use PayUSdk\Model\Address;
use PayUSdk\Model\Cart;
use PayUSdk\Model\Currency;
use PayUSdk\Model\Customer;
use PayUSdk\Model\CustomerDetail;
use PayUSdk\Model\FraudService;
use PayUSdk\Model\Item;
use PayUSdk\Model\ItemList;
use PayUSdk\Model\Phone;
use PayUSdk\Model\ShippingAddress;
use PayUSdk\Model\Total;
use PayUSdk\Model\Transaction;
use PayUSdk\Model\TransactionUrl;

// ### Address
// A resource representing a customer shipping/billing address information
$address = new Address();
$address->setLine1('80 Main Road')
    ->setLine2('Cape Town')
    ->setCity('Cape Town')
    ->setState('WC')
    ->setPostalCode('8000')
    ->setCountryCode('ZAR');

// ### CustomerDetail
// A resource representing a customer detailed information
$phone = new Phone();
$phone->setCountryCode('27')
    ->setNationalNumber('0748523695');

$customerDetail = new CustomerDetail();
$customerDetail->setFirstName('John')
    ->setLastName('Snow')
    ->setEmail('john.snow@example.com')
    ->setPhone($phone)
    ->setCustomerId('856')
    ->setAddress($address)
    ->setIpAddress('127.0.0.1');

// ### Customer
// A resource representing a Customer that funds a payment
$customer = new Customer();
$customer->setCustomerDetail($customerDetail);

// ### Itemized information
// Lets you specify item wise information.
// Utilized with fraud management enabled, otherwise ignored.
$item1 = new Item();
$item1->setName('Ground Coffee 40 oz')
    ->setSku('GCF0011')
    ->setQuantity(10)
    ->setPrice(7.50)
    ->setCostPrice(5.00)
    ->setTotal(75.00);

$item2 = new Item();
$item2->setName('Granola bars')
    ->setSku('GCF0022')
    ->setQuantity(5)
    ->setPrice(20.00)
    ->setCostPrice(10.00)
    ->setTotal(100.00);

$itemList = new ItemList();
$itemList->setItems([$item1, $item2]);

$cart = new Cart();
$cart->setItems($itemList);
$cart->setTotal(175);

// ### ShippingInfo
// Use this optional field to set shipping information.
$shipping = new ShippingAddress($address->toArray());
$shipping->setRecipientName('John Snow')
    ->setShippingId('28')
    ->setPhone($phone)
    ->setShippingMethod('W');

// ### Amount
// Lets you specify a payment amount.
// You can also specify additional details
// such as shipping, tax.
$currency = new Currency();
$currency->setCode('ZAR');

$total = new Total();
$total->setCurrency($currency)
    ->setAmount(175.50);

$fraudService = new FraudService();
$fraudService->setCheckFraudOverride(false)
    ->setMerchantWebsite(getBaseUrl())
    ->setPcFingerPrint('owhjiflkwhefqwoaef');

// ### Transaction
// A transaction defines the contract of a
// payment - what is the payment for and who
// is fulfilling it.
$transaction = new Transaction();
$transaction->setTotal($total)
    ->setCart($cart)
    ->setDescription("Payment description")
    ->setReference(uniqid('payu'))
    ->setFraudService($fraudService)
    ->setShippingInfo($shipping);

$baseUrl = getBaseUrl();
$transactionUrl = new TransactionUrl();
$transactionUrl->setNotificationUrl("$baseUrl/process-return.php")
    ->setResponseUrl("$baseUrl/process-return.php?apiContext=2")
    ->setCancelUrl("$baseUrl/process-return.php?cancel=true&apiContext=2");

// Setting integration to `redirect` will alter the way the API behaves.
$apiContext[2]->setAccountId('account3')
    ->setIntegration(Context::REDIRECT);

// ### Redirect
// A Redirect Payment Resource; create one using
// the above parameters and intent set to 'payment'
$redirect = new Redirect();
$redirect->setContext($apiContext[2])
    ->setTransactionType(TransactionInterface::TYPE_PAYMENT)
    ->setCustomer($customer)
    ->setTransaction($transaction)
    ->setTransactionUrl($transactionUrl);

// ### Create Redirect
// Create a Redirect by calling the payment->init() method
// with a valid Context (See bootstrap.php for more on `Context`)
// The return object contains the result.
try {
    $response = Processor::processAction('setup', $redirect);
} catch (Exception $ex) {
    // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
    ResultPrinter::printError('Setup Redirect With Fraud Management. If 500 Exception, check return object for details', 'Redirect', null, $redirect, $ex);
    exit(1);
}

$rppUrl = $redirect->getPayURedirectUrl();

// NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
ResultPrinter::printResult("Setup Redirect Payment With Fraud Management. Please visit the URL to Capture your payment details.", "Redirect", "<a href='$rppUrl' >$rppUrl</a>", $redirect, $response);


return $response;
