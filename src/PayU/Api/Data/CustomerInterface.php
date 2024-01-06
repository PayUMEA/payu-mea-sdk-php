<?php
/**
 * Copyright © 2023 PayU Financial Services. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace PayUSdk\Api\Data;

/**
 * Class CustomerInterface
 *
 * Customer who funds a payment transaction.
 *
 * @package PayUSdk\Model
 */
interface CustomerInterface
{
    /**#@+
     * Constants for keys of data array. Identical to the name of the getter in snake case.
     */
    /*
     * Payment method.
     */
    const PAYMENT_METHOD = 'payment_method';
    /*
     * Type.
     */
    const FUNDING_INSTRUMENT = 'funding_instrument';
    /*
     * Type.
     */
    const CUSTOMER_DETAIL = 'customer_detail';

    /**
     * Payment method being used - Credit card, PayU Wallet payment, Eft.
     * Valid Values: ["CREDITCARD", "EFT_PRO", "EBUCKS", "DISCOVERYMILES", "SMARTEFT", "DEBIT_ORDER",
     * "CREDITCARD_TOKEN", "REAL_TIME_RECURRING"]
     *
     * @return ?string Payment method
     */
    public function getPaymentMethod(): ?string;

    /**
     * @return FundingInstrumentInterface Funding instrument to pay with
     */
    public function getFundingInstrument(): FundingInstrumentInterface;

    /**
     * @return CustomerDetailInterface Customer details
     */
    public function getCustomerDetail(): CustomerDetailInterface;

    /**
     * @param string $paymentMethod
     * @return $this
     */
    public function setPaymentMethod(string $paymentMethod): static;

    /**
     * @param FundingInstrumentInterface $fundingInstrument
     * @return $this
     */
    public function setFundingInstrument(FundingInstrumentInterface $fundingInstrument): static;

    /**
     * @param CustomerDetailInterface $customerDetail
     * @return $this
     */
    public function setCustomerDetail(CustomerDetailInterface $customerDetail): static;
}
