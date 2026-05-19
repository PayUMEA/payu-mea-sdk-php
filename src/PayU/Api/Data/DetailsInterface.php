<?php

/**
 * Copyright © 2023 PayU Financial Services. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace PayUSdk\Api\Data;

/**
 * Interface DetailsInterface
 *
 * @package PayUSdk\Api\Data
 */
interface DetailsInterface
{
    /**#@+
     * Constants for keys of data array. Identical to the name of the getter in snake case.
     */
    /*
     * Subtotal.
     */
    public const SUBTOTAL = 'subtotal';
    /*
     * Shipping fee.
     */
    public const SHIPPING_FEE = 'shipping_fee';
    /*
     * Tax Amount.
     */
    public const TAX = 'tax';
    /*
     * Shipping Handling Fee.
     */
    public const HANDLING_FEE = 'handling_fee';
    /*
     * Shipping Discount Amount.
     */
    public const SHIPPING_DISCOUNT = 'shipping_discount';
    /*
     * Gift Wrap Fee.
     */
    public const GIFT_WRAP_FEE = 'gift_wrap_fee';
    /*
     * Fee charged by PayU.
     */
    public const PAYU_CHARGE = 'payu_charge';

    /**
     * @return float
     */
    public function getSubtotal(): float;

    /**
     * @return float
     */
    public function getShipping(): float;

    /**
     * @return float
     */
    public function getTax(): float;

    /**
     * @return float
     */
    public function getHandlingFee(): float;

    /**
     * @return float
     */
    public function getShippingDiscount(): float;

    /**
     * @return float
     */
    public function getGiftWrap(): float;

    /**
     * @return float
     */
    public function getPayUFee(): float;

    /**
     * @param string|float $key
     * @return $this
     */
    public function setSubtotal(string|float $key): static;

    /**
     * @param string|float $value
     * @return $this
     */
    public function setShipping(string|float $value): static;

    /**
     * @param string|float $value
     * @return $this
     */
    public function setTax(string|float $value): static;

    /**
     * @param string|float $value
     * @return $this
     */
    public function setHandlingFee(string|float $value): static;

    /**
     * @param string|float $value
     * @return $this
     */
    public function setShippingDiscount(string|float $value): static;

    /**
     * @param string|float $value
     * @return $this
     */
    public function setGiftWrap(string|float $value): static;

    /**
     * @param string|float $value
     * @return $this
     */
    public function setPayUFee(string|float $value): static;
}
