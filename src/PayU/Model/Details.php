<?php
/**
 * Copyright © 2023 PayU Financial Services. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace PayUSdk\Model;

use PayUSdk\Api\Data\DetailsInterface;
use PayUSdk\Framework\Formatter;
use PayUSdk\Framework\AbstractModel;
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

        return $this->setData('subtotal', $subtotal);
    }

    /**
     * Amount of the subtotal of the items. **Required** if line items are specified.
     * 10 characters max, with support for integers.
     *
     * @return float
     */
    public function getSubtotal(): float
    {
        return (float)$this->getData('subtotal');
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
        $shipping = Formatter::formatToPrice((float)$shipping);
        return $this->setData('shipping', $shipping);
    }

    /**
     * Amount charged for shipping.
     *
     * @return string
     */
    public function getShipping()
    {
        return $this->getData('shipping');
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
        $tax = Formatter::formatToPrice((float)$tax);
        return $this->setData('tax', $tax);
    }

    /**
     * Amount charged for tax.
     *
     * @return string
     */
    public function getTax()
    {
        return $this->getData('tax');
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
        $handlingFee = Formatter::formatToPrice((float)$handlingFee);
        return $this->setData('handling_fee', $handlingFee);
    }

    /**
     * Amount being charged for the handling fee.
     *
     * @return string
     */
    public function getHandlingFee()
    {
        return $this->getData('handling_fee');
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
        $shippingDiscount = Formatter::formatToPrice((float)$shippingDiscount);
        return $this->setData('shipping_discount', $shippingDiscount);
    }

    /**
     * Amount being discounted for the shipping fee.
     *
     * @return string
     */
    public function getShippingDiscount()
    {
        return $this->getData('shipping_discount');
    }

    /**
     * Amount being charged as gift wrap fee.
     *
     * @param string|double $giftWrap
     *
     * @return $this
     */
    public function setGiftWrap($giftWrap)
    {
        NumericValidator::validate($giftWrap, "Gift Wrap");
        $giftWrap = Formatter::formatToPrice((float)$giftWrap);
        return $this->setData('gift_wrap', $giftWrap);
    }

    /**
     * Amount being charged as gift wrap fee.
     *
     * @return string
     */
    public function getGiftWrap()
    {
        return $this->getData('gift_wrap');
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
        $fee = Formatter::formatToPrice((float)$fee);
        return $this->setData('fee', $fee);
    }

    /**
     * Fee charged by PayU. In case of a refund,
     * this is the fee amount refunded to the original recipient of the payment.
     *
     * @return string
     */
    public function getFee()
    {
        return $this->getData('fee');
    }
}
