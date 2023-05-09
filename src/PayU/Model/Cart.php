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

use PayU\Model\PayUModel;

/**
 * Class Basket
 *
 * Basket class contains summary of the cart
 *
 * @package PayU\Api
 *
 * @property int amountInCents
 * @property string currencyCode
 * @property string description
 */
class Basket extends PayUModel
{
    /**
     * Basket amount in cents converted to integer
     *
     * @param int $amountInCents
     * @return $this
     */
    public function setAmountInCents($amountInCents)
    {
        $this->amountInCents = $amountInCents;
        return $this;
    }

    /**
     * Basket amount in cents converted to integer
     *
     * @return int
     */
    public function getAmountInCents()
    {
        return $this->amountInCents;
    }

    /**
     * 3-letter [currency code]
     *
     * @param string $code
     * @return $this
     */
    public function setCurrencyCode($code)
    {
        $this->currencyCode = $code;
        return $this;
    }

    /**
     * 3-letter [currency code]
     *
     * @return string
     */
    public function getCurrencyCode()
    {
        return $this->currencyCode;
    }

    /**
     * Basket description
     *
     * @param string $description
     * @return $this
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * Basket description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }
}