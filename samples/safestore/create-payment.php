<?php

// # CreatePaymentSample
//
// This sample code demonstrate how you can process
// a direct credit card payment.

require __DIR__ . '/../bootstrap.php';

use PayU\Api\Data\CardInterface;
use PayU\Api\Data\TransactionInterface;
use PayU\Framework\Processor;
use PayU\Model\Cart;
use PayU\Model\CreditCard;
use PayU\Model\Phone;
use PayU\Model\Total;
use PayU\Model\BillingAddress;
use PayU\Model\Currency;
use PayU\Model\Customer;
use PayU\Model\CustomerDetail;
use PayU\Model\FundingInstrument;
use PayU\Model\Item;
use PayU\Model\ItemList;
use PayU\Framework\Action\Sale;
use PayU\Model\PaymentMethod;
use PayU\Model\TransactionUrl;
use PayU\Model\Transaction;
use PayU\Framework\Soap\Context;

$addr = new BillingAddress();
$addr->setLine1("3909 Witmer Road")
    ->setLine2("Niagara Falls")
    ->setCity("Niagara Falls")
    ->setState("GP")
    ->setPostalCode("14305")
    ->setCountryCode("ZA");

// ### PaymentCard
// A resource representing a payment card that can be
// used to fund a payment.
$card = new CreditCard();
$card->setType(CardInterface::TYPE_VISA)
    ->setNumber("4000015372250142")
    ->setExpiryMonth("11")
    ->setExpiryYear("2025")
    ->setCvv("123")
    ->setSecure3d(true)
    ->setBudget(false)
    ->setNameOnCard("John Snow")
    ->setBillingAddress($addr);

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
$customerDetail->setFirstName('Test')
    ->setLastName('Customer')
    ->setEmail('test.customer@example.com')
    ->setPhone($phone)
    ->setCustomerId('854')
    ->setIPAddress('127.0.0.1');

// ### Customer
// A resource representing a Customer that funds a payment
// For direct credit card payments, set payment method
// to 'credit_card' and add an array of funding instruments.
$customer = new Customer();
$customer->setPaymentMethod(PaymentMethod::TYPE_CREDITCARD)
    ->setCustomerDetail($customerDetail)
    ->setFundingInstrument($funding);

$currency = new Currency(['code' => 'ZAR']);

// ### Itemized information
// (Optional) Lets you specify item wise information
$item1 = new Item();
$item1->setName('Ground Coffee 40 oz')
    ->setQuantity(1)
    ->setPrice(500.00)
    ->setCostPrice(450.50)
    ->setTotal(500.00);

$item2 = new Item();
$item2->setName('Granola bars')
    ->setQuantity(5)
    ->setPrice(200.00)
    ->setCostPrice(150.50)
    ->setTotal(1000.00);

$itemList = new ItemList();
$itemList->setItems([$item1, $item2]);

$cart = new Cart(['items' => $itemList]);
$cart->setTotal(1500.00);

// ### Amount
// Lets you specify the total amount to pay.
$total = new Total();
$total->setCurrency($currency)
    ->setAmount(2000.00);

// ### Transaction
// A transaction defines the contract of a
// payment - what is the payment for and who
// is fulfilling it.
$transaction = new Transaction();
$transaction->setTotal($total)
    ->setCart($cart)
    ->setDescription("Payment description")
    ->setReference(uniqid('payu'));

$baseUrl = getBaseUrl();
$transactionUrl = new TransactionUrl();
$transactionUrl->setNotificationUrl("$baseUrl/process-ipn")
    ->setResponseUrl("$baseUrl/process-return.php?apiContext=6")
    ->setCancelUrl("$baseUrl/process-return.php?cancel=true&apiContext=6");

// Setting integration to `redirect` will alter the way the API behaves.
$apiContext[6]->setAccountId('account7')
    ->setIntegration(Context::ENTERPRISE);

// ### Payment
// A Payment Resource; create one using
// the above types and intent set to sale 'sale'
$sale = new Sale();
$sale->setContext($apiContext[6])
    ->setTransactionType(TransactionInterface::TYPE_PAYMENT)
    ->setCustomer($customer)
    ->setTransaction($transaction)
    ->setTransactionUrl($transactionUrl);

// ### Create Payment
// Create a payment by calling the payment->doTransaction method
// with a valid Context (See bootstrap.php for more on `Context`)
// The response object retrieved by calling `getReturn` on the payment object contains the state.
try {
    $response = Processor::processAction('sale', $sale);
} catch (Exception $ex) {
    // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
    ResultPrinter::printError('Create Payment With Credit Card. If 500 Exception, check response details', 'Payment', null, $sale, $ex);
    exit(1);
}

// NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
ResultPrinter::printResult("Create Payment With Credit Card", "Payment", $response->getPayUReference(), $sale, $response);

return $response;
