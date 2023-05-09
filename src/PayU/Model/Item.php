<?php
/**
 * PayU MEA PHP SDK
 *
 * @copyright  Copyright (c) 2016 PayU
 * @license    http://opensource.org/licenses/LGPL-3.0  Open Software License (LGPL 3.0)
 * @link       http://www.payu.co.za
 * @link       http://help.payu.co.za/developers
 * @author     Kenneth Onah <kenneth@netcraft-devops.com>
 */

namespace PayU\Api;

use PayU\Conversion\Formatter;
use PayU\Model\PayUModel;
use PayU\Validation\NumericValidator;

/**
 * Class Item
 *
 * Item details.
 *
 * @package PayU\Api
 *
 * @property string sku
 * @property string name
 * @property string description
 * @property string quantity
 * @property string costPrice
 * @property \PayU\Api\Total amount
 */
class Item extends PayUModel
{
    /**
     * Stock keeping unit corresponding (SKU) to item.
     *
     * @param string $sku
     *
     * @return $this
     */
    public function setSku(string $sku): static
    {
        $this->sku = $sku;

        return $this;
    }

    /**
     * Stock keeping unit corresponding (SKU) to item.
     *
     * @return string
     */
    public function getSku(): string
    {
        return $this->sku;
    }

    /**
     * Item name. 127 characters max.
     *
     * @param string $name
     *
     * @return $this
     */
    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Item name. 127 characters max.
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Description of the item.
     *
     * @param string $description
     *
     * @return $this
     */
    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Description of the item.
     *
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * Number of a particular item. 10 characters max.
     *
     * @param string $quantity
     *
     * @return $this
     */
    public function setQuantity(string $quantity): static
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Number of a particular item. 10 characters max.
     *
     * @return string
     */
    public function getQuantity(): string
    {
        return $this->quantity;
    }

    /**
     * @param float $costPrice
     * @return $this
     */
    public function setCostPrice(float $costPrice): static
    {
        NumericValidator::validate($costPrice, "CostPrice");
        $costPrice = Formatter::formatToPrice($costPrice, $this->getCurrency()->getCode());
        $this->costPrice = $costPrice;

        return $this;
    }

    /**
     * @param Total $amount
     * @return $this
     */
    public function setAmount(Total $amount): static
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Item cost. 10 characters max.
     *
     * @return string
     */
    public function getCostPrice(): string
    {
        return $this->costPrice;
    }

    /**
     * Item amount. 10 characters max.
     *
     * @return \PayU\Api\Total
     */
    public function getAmount(): Total
    {
        return $this->amount;
    }
}
