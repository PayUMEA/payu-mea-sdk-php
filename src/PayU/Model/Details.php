<?php

/**
 * Copyright © 2023 PayU Financial Services. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace PayUSdk\Model;

use PayUSdk\Api\Data\DetailsInterface;
use PayUSdk\Framework\Formatter;
use PayUSdk\Framework\Validation\NumericValidator;

/**
 * Class Details
 *
 * Additional details of the lookup data entry value.
 *
 * @package PayUSdk\Model
 *
 * @property string $subtotal
 * @property string $shipping
 * @property string $tax
 * @property string $handlingFee
 * @property string $shippingDiscount
 * @property string $giftWrap
 * @property string $fee
 */
class Details extends PayUModel implements DetailsInterface
{
    /**
     * Amount of the subtotal of the items. **Required** if line items are specified.
     * 10 characters max, with support for integers.
     *
     * @param string|float $subtotal
     * @return $this
     */
    public function setSubtotal(string|float $subtotal): static
    {
        NumericValidator::validate($subtotal, "Subtotal");
        $subtotal = Formatter::formatToPrice((float)$subtotal);

        return $this->setData(DetailsInterface::SUBTOTAL, $subtotal);
    }

    /**
     * Amount of the subtotal of the items. **Required** if line items are specified.
     * 10 characters max, with support for integers.
     *
     * @return float
     */
    public function getSubtotal(): float
    {
        return (float)$this->getData(DetailsInterface::SUBTOTAL);
    }

    /**
     * Amount charged for shipping.
     *
     * @param string|float $shipping
     *
     * @return $this
     */
    public function setShipping(string|float $shipping): static
    {
        NumericValidator::validate($shipping, "Shipping");
        $shipping = Formatter::formatToPrice((float)$shipping);

        return $this->setData(DetailsInterface::SHIPPING_FEE, $shipping);
    }

    /**
     * Amount charged for shipping.
     *
     * @return string
     */
    public function getShipping(): float
    {
        return (float)$this->getData(DetailsInterface::SHIPPING_FEE);
    }

    /**
     * Amount charged for tax.
     *
     * @param string|float $tax
     *
     * @return $this
     */
    public function setTax(string|float $tax): static
    {
        NumericValidator::validate($tax, "Tax");
        $tax = Formatter::formatToPrice((float)$tax);

        return $this->setData(DetailsInterface::TAX, $tax);
    }

    /**
     * Amount charged for tax.
     *
     * @return string
     */
    public function getTax(): float
    {
        return (float)$this->getData(DetailsInterface::TAX);
    }

    /**
     * Amount being charged for the handling fee.
     *
     * @param string|float $handlingFee
     *
     * @return $this
     */
    public function setHandlingFee(string|float $handlingFee): static
    {
        NumericValidator::validate($handlingFee, "Handling Fee");
        $handlingFee = Formatter::formatToPrice((float)$handlingFee);

        return $this->setData(DetailsInterface::HANDLING_FEE, $handlingFee);
    }

    /**
     * Amount being charged for the handling fee.
     *
     * @return string
     */
    public function getHandlingFee(): float
    {
        return (float)$this->getData(DetailsInterface::HANDLING_FEE);
    }

    /**
     * Amount being discounted for the shipping fee.
     *
     * @param string|float $shippingDiscount
     *
     * @return $this
     */
    public function setShippingDiscount(string|float $shippingDiscount): static
    {
        NumericValidator::validate($shippingDiscount, "Shipping Discount");
        $shippingDiscount = Formatter::formatToPrice((float)$shippingDiscount);

        return $this->setData(DetailsInterface::SHIPPING_DISCOUNT, $shippingDiscount);
    }

    /**
     * Amount being discounted for the shipping fee.
     *
     * @return string
     */
    public function getShippingDiscount(): float
    {
        return (float)$this->getData(DetailsInterface::SHIPPING_DISCOUNT);
    }

    /**
     * Amount being charged as gift wrap fee.
     *
     * @param string|double $giftWrap
     *
     * @return $this
     */
    public function setGiftWrap(string|float $giftWrap): static
    {
        NumericValidator::validate($giftWrap, "Gift Wrap");
        $giftWrap = Formatter::formatToPrice((float)$giftWrap);

        return $this->setData(DetailsInterface::GIFT_WRAP_FEE, $giftWrap);
    }

    /**
     * Amount being charged as gift wrap fee.
     *
     * @return float
     */
    public function getGiftWrap(): float
    {
        return (float)$this->getData(DetailsInterface::GIFT_WRAP_FEE);
    }

    /**
     * Fee charged by PayU. In case of a refund,
     * this is the fee amount refunded to the original recipient of the payment.
     *
     * @param string|float $fee
     *
     * @return $this
     */
    public function setFee(string|float $fee): static
    {
        NumericValidator::validate($fee, "Fee");
        $fee = Formatter::formatToPrice((float)$fee);

        return $this->setData(DetailsInterface::PAYU_CHARGE, $fee);
    }

    /**
     * Fee charged by PayU. In case of a refund,
     * this is the fee amount refunded to the original recipient of the payment.
     *
     * @return float
     */
    public function getFee(): float
    {
        return (float)$this->getData(DetailsInterface::PAYU_CHARGE);
    }
}
