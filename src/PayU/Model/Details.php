<?php
/**
 * Copyright © 2023 PayU Financial Services. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace PayU\Model;

use PayU\Api\Data\DetailsInterface;
use PayU\Framework\Formatter;
use PayU\Framework\AbstractModel;
use PayU\Framework\Validation\NumericValidator;

/**
 * Class Details
 *
 * Additional details of the lookup data entry value.
 *
 * @package PayU\Model
 *
 * @property string subtotal
 * @property string shipping
 * @property string tax
 * @property string handlingFee
 * @property string shippingDiscount
 * @property string giftWrap
 * @property string fee
 */
class Details extends AbstractModel implements DetailsInterface
{
    /**
     * Amount of the subtotal of the items. **Required** if line items are specified.
     * 10 characters max, with support for integers.
     *
     * @param float $subtotal
     * @return $this
     */
    public function setSubtotal(float $subtotal): static
    {
        NumericValidator::validate($subtotal, "Subtotal");
        $subtotal = Formatter::formatToPrice($subtotal);

        return $this->setData();
    }

    /**
     * Amount of the subtotal of the items. **Required** if line items are specified.
     * 10 characters max, with support for integers.
     *
     * @return string
     */
    public function getSubtotal(): float
    {
        return $this->subtotal;
    }

    /**
     * Amount charged for shipping.
     *
     * @param string|double $shipping
     *
     * @return $this
     */
    public function setShipping($shipping)
    {
        NumericValidator::validate($shipping, "Shipping");
        $shipping = Formatter::formatToPrice($shipping);
        $this->shipping = $shipping;
        return $this;
    }

    /**
     * Amount charged for shipping.
     *
     * @return string
     */
    public function getShipping()
    {
        return $this->shipping;
    }

    /**
     * Amount charged for tax.
     *
     * @param string|double $tax
     *
     * @return $this
     */
    public function setTax($tax)
    {
        NumericValidator::validate($tax, "Tax");
        $tax = Formatter::formatToPrice($tax);
        $this->tax = $tax;
        return $this;
    }

    /**
     * Amount charged for tax.
     *
     * @return string
     */
    public function getTax()
    {
        return $this->tax;
    }

    /**
     * Amount being charged for the handling fee.
     *
     * @param string|double $handlingFee
     *
     * @return $this
     */
    public function setHandlingFee($handlingFee)
    {
        NumericValidator::validate($handlingFee, "Handling Fee");
        $handlingFee = Formatter::formatToPrice($handlingFee);
        $this->handlingFee = $handlingFee;
        return $this;
    }

    /**
     * Amount being charged for the handling fee.
     *
     * @return string
     */
    public function getHandlingFee()
    {
        return $this->handlingFee;
    }

    /**
     * Amount being discounted for the shipping fee.
     *
     * @param string|double $shippingDiscount
     *
     * @return $this
     */
    public function setShippingDiscount($shippingDiscount)
    {
        NumericValidator::validate($shippingDiscount, "Shipping Discount");
        $shippingDiscount = Formatter::formatToPrice($shippingDiscount);
        $this->shippingDiscount = $shippingDiscount;
        return $this;
    }

    /**
     * Amount being discounted for the shipping fee.
     *
     * @return string
     */
    public function getShippingDiscount()
    {
        return $this->shippingDiscount;
    }

    /**
     * Amount being charged as gift wrap fee.
     *
     * @param string|double $gift_wrap
     *
     * @return $this
     */
    public function setGiftWrap($giftWrap)
    {
        NumericValidator::validate($giftWrap, "Gift Wrap");
        $giftWrap = Formatter::formatToPrice($giftWrap);
        $this->giftWrap = $giftWrap;
        return $this;
    }

    /**
     * Amount being charged as gift wrap fee.
     *
     * @return string
     */
    public function getGiftWrap()
    {
        return $this->giftWrap;
    }

    /**
     * Fee charged by PayU. In case of a refund,
     * this is the fee amount refunded to the original recipient of the payment.
     *
     * @param string|double $fee
     *
     * @return $this
     */
    public function setFee($fee)
    {
        NumericValidator::validate($fee, "Fee");
        $fee = Formatter::formatToPrice($fee);
        $this->fee = $fee;
        return $this;
    }

    /**
     * Fee charged by PayU. In case of a refund,
     * this is the fee amount refunded to the original recipient of the payment.
     *
     * @return string
     */
    public function getFee()
    {
        return $this->fee;
    }
}
