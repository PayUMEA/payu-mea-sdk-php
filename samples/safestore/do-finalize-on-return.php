<?php

// # CreateRedirectPaymentSample
//
// This sample code demonstrate how you can process
// a redirect payment.

use PayU\Framework\Action\Redirect;
use PayU\Model\Currency;
use PayU\Model\Customer;
use PayU\Model\CustomerDetail;
use PayU\Model\Phone;
use PayU\Model\Total;
use PayU\Model\Transaction;

// ### CustomerDetail
// A resource representing a customer detailed information
$phone = new Phone();
$phone->setNationalNumber('0748523695')
    ->setCountryCode('27');

$ci = new CustomerDetail();
$ci->setFirstName('Test')
    ->setLastName('Customer')
    ->setEmail('test.customer@example.com')
    ->setPhone($phone)
    ->setCustomerId('854')
    ->setIpAddress('127.0.0.1');

// ### Customer
// A resource representing a Customer that funds a payment.
$customer = new Customer();
$customer->setCustomerDetail($ci);

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
    ->setDescription("Payment description");

// ### Redirect
// A Redirect Payment Resource; create one using
// the above types and intent set to sale 'payment'
$redirect = new Redirect();
$redirect->setTransactionType(Transaction::TYPE_FINALIZE)
    ->setCustomer($customer)
    ->setTransaction($transaction);

return $redirect;
