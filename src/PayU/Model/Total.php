<?php
/**
 * PayU MEA PHP SDK
 *
 * @copyright  Copyright (c) 2016 PayU
 * @license    http://opensource.org/licenses/LGPL-3.0  Open Software License (LGPL 3.0)
 * @link http://www.payu.co.za
 * @link http://help.payu.co.za/developers
 * @author Kenneth Onah <kenneth@netcraft-devops.com>
 */

namespace PayU\Api;

use PayU\Conversion\Formatter;
use PayU\Model\PayUModel;
use PayU\Validation\NumericValidator;

/**
 * Class Amount
 *
 * Payment amount.
 *
 * @package PayU\Api
 *
 * @property string total
 * @property \PayU\Api\Currency $currency
 * @property \PayU\Api\Details details
 */
class Amount extends PayUModel
{
    /**
     * 3-letter [currency code].
     *
     * @param Currency $currency
     *
     * @return $this
     */
    public function setCurrency(Currency $currency): static
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * Total amount charged from the payer to the payee. In case of a refund,
     * this is the refunded amount to the original payer from the payee.
     * 10 characters max with support for integers.
     *
     * @param float $total
     *
     * @return $this
     */
    public function setTotal(float $total): static
    {
        NumericValidator::validate($total, "Total");
        $total = Formatter::formatToPrice($total, $this->getCurrency()->getCode());
        $this->total = $total;

        return $this;
    }

    /**
     * 3-letter [currency code]. PayU supports ZAR, NGN currencies only.
     *
     * @return \PayU\Api\Currency
     */
    public function getCurrency(): Currency
    {
        return $this->currency;
    }

    /**
     * Total amount charged from the customer to the merchant. In case of a refund,
     * this is the refunded amount to the original customer from the merchant.
     * 10 characters max with support for integers.
     *
     * @return float
     */
    public function getTotal(): float
    {
        return $this->total;
    }

    /**
     * @param \PayU\Api\Details $details
     * @return $this
     */
    public function setDetails(Details $details): static
    {
        $this->details = $details;

        return $this;
    }

    /**
     * Additional details of the payment amount.
     *
     * @return \PayU\Api\Details
     */
    public function getDetails(): Details
    {
        return $this->details;
    }
}
