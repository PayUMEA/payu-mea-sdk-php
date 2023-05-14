<?php

// # CreatePaymentSample
//
// This sample code demonstrate how you can process
// a direct credit card payment.

require __DIR__ . '/../../bootstrap.php';

use PayU\Api\Data\CardInterface;
use PayU\Api\Data\TransactionInterface;
use PayU\Framework\Action\Sale;
use PayU\Framework\Processor;
use PayU\Model\BillingAddress;
use PayU\Model\Cart;
use PayU\Model\CreditCard;
use PayU\Model\Currency;
use PayU\Model\Customer;
use PayU\Model\CustomerDetail;
use PayU\Model\FraudService;
use PayU\Model\FundingInstrument;
use PayU\Model\Item;
use PayU\Model\ItemList;
use PayU\Model\PaymentMethod;
use PayU\Model\Phone;
use PayU\Model\ShippingAddress;
use PayU\Model\Total;
use PayU\Model\Transaction;
use PayU\Model\TransactionUrl;
use PayU\Framework\Soap\Context;

// ### Address
// A resource representing a customer shipping/billing address information
$address = new BillingAddress();
$address->setLine1("80 Main Road")
    ->setLine2("Cape Town")
    ->setCity("Cape Town")
    ->setState("WC")
    ->setPostalCode("8000")
    ->setCountryCode("ZAF");

// ### CreditCard
// A resource representing a payment card that can be
// used to fund a payment.
$card = new CreditCard();
$card->setType(CardInterface::TYPE_VISA)
    ->setNumber("4000015372250142")
    ->setExpiryMonth("11")
    ->setExpiryYear("2027")
    ->setCvv("123")
    ->setBudget(false)
    ->setSecure3d(true)
    ->setNameOnCard("John Snow")
    ->setBillingAddress($address);

// ### FundingInstrument
// A resource representing a Customer's funding instrument.
// For direct credit card payments, set the CreditCard
// field on this object.
$funding = new FundingInstrument(['credit_card' => $card]);

// ### CustomerDetail
// A resource representing a customer detailed information
$phone = new Phone();
$phone->setCountryCode('27');
$phone->setNationalNumber('27748523695');

$customerDetail = new CustomerDetail();
$customerDetail->setFirstName('John')
    ->setLastName('Snow')
    ->setEmail('john.snow@example.com')
    ->setIpAddress('127.0.0.1')
    ->setPhone($phone)
    ->setCustomerId('854');

// ### Customer
// A resource representing a Customer that funds a payment
$customer = new Customer();
$customer->setPaymentMethod(PaymentMethod::TYPE_CREDITCARD)
    ->setFundingInstrument($funding)
    ->setCustomerDetail($customerDetail);

// ### Currency
$currency = new Currency(['code' => 'ZAR']);

// ### Itemized information
// (Optional) Lets you specify item wise
// information. Only Utilized with fraud management enabled, otherwise ignored.
$item1 = new Item();
$item1->setName('Ground Coffee 40 oz')
    ->setSku('GCF0011')
    ->setQuantity(10)
    ->setPrice(5.50)
    ->setTotal(55.00)
    ->setCostPrice(4.50);

$item2 = new Item();
$item2->setName('Granola bars')
    ->setSku('GCF0022')
    ->setQuantity(5)
    ->setPrice(25.00)
    ->setTotal(75.00)
    ->setCostPrice(15.00);

$itemList = new ItemList();
$itemList->setItems([$item1, $item2]);

$cart = new Cart();
$cart->setItems($itemList)
    ->setTotal(130.00);
// ### ShippingInfo
// Use this optional field to set shipping information.
$shippingAddress = new ShippingAddress($address->toArray());
$shippingAddress->setRecipientName('Jon Snow')
    ->setShippingId('880')
    ->setShippingMethod('P');

// ### Amount
// Lets you specify a payment amount.
// You can also specify additional details
// such as shipping, tax.
$amount = new Total();
$amount->setCurrency($currency)
    ->setAmount(175.50);

// ### Fraud Management Details
// Lets you specify details required for fraud management.
$fraudService = new FraudService();
$fraudService->setCheckFraudOverride(false)
    ->setMerchantWebsite(getBaseUrl())
    ->setPCFingerPrint('owhjiflkwhefqwoaef');

// ### Transaction
// A transaction defines the contract of a
// payment - what is the payment for and who
// is fulfilling it.
$transaction = new Transaction();
$transaction->setTotal($amount)
    ->setCart($cart)
    ->setDescription("Payment description")
    ->setReference(uniqid('payu'))
    ->setFraudService($fraudService)
    ->setShippingInfo($shippingAddress);

$baseUrl = getBaseUrl();
$transactionUrls = new TransactionUrl();
$transactionUrls->setNotificationUrl('http://example.com/return')
    ->setResponseUrl("$baseUrl/process-return.php?apiContext=2")
    ->setCancelUrl("$baseUrl/process-return.php?cancel=true&apiContext=2");

// Setting integration will alter the way the API behaves.
$apiContext[2]->setAccountId('account3')
    ->setIntegration(Context::ENTERPRISE);

// ### Redirect
// A Redirect Payment Resource; create one using
// the above types and intent set to sale 'payment'
$payment = new Sale();
$payment->setContext($apiContext[2])
    ->setTransactionType(TransactionInterface::TYPE_PAYMENT)
    ->setCustomer($customer)
    ->setTransaction($transaction)
    ->setTransactionUrl($transactionUrls);

// For Sample Purposes Only.
$request = clone $payment;

// ### Create Payment
// Create a payment by calling the payment->callSetTransaction method
// with a valid Context (See bootstrap.php for more on `Context`)
// The return object contains the result with the redirect url to PayU to capture customer's payment details.
try {
    $response = Processor::processAction('sale', $payment);
} catch (Exception $ex) {
    // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
    ResultPrinter::printError('Create Payment with Fraud Management. If 500 Exception, check response for details.', 'Payment', null, $request, $ex);
    exit(1);
}

// NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
ResultPrinter::printResult('Create Payment with Fraud Management', 'Payment', $response->getPayUReference(), $request, $response);

return $payment;
