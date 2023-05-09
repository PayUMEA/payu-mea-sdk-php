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
 * Class CreditCardToken
 *
 * A resource representing a credit card that can be used to fund a payment.
 *
 * @package PayPal\Api
 *
 * @property string last4
 * @property string type
 * @property string cvv2
 * @property int expireMonth
 * @property int expireYear
 * @property string creditCardId
 */
class CreditCardToken extends PayUModel
{
    /**
     * Last four digits of the stored credit card number.
     *
     * @param string $last4
     *
     * @return $this
     */
    public function setLast4(string $last4): static
    {
        $this->last4 = $last4;

        return $this;
    }

    /**
     * Last four digits of the stored credit card number.
     *
     * @return string|null
     */
    public function getLast4(): string|null
    {
        return $this->last4;
    }

    /**
     * Credit card type. Valid types are: ["VISA", "MASTERCARD"]
     * Values are presented in lowercase and should not be used for display.
     *
     * @param string $type
     *
     * @return $this
     */
    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Credit card type. Valid types are: ["VISA", "MASTERCARD"]
     * Values are presented in lowercase and should not be used for display.
     *
     * @return string|null
     */
    public function getType(): string|null
    {
        return $this->type;
    }

    /**
     * The validation code for the card. Supported for payments but not for saving payment cards for future use.
     *
     * @param string $cvv2
     *
     * @return $this
     */
    public function setCvv2(string $cvv2): static
    {
        $this->cvv2 = $cvv2;

        return $this;
    }

    /**
     * The validation code for the card. Supported for payments but not for saving payment cards for future use.
     *
     * @return string|null
     */
    public function getCvv2(): string|null
    {
        return $this->cvv2;
    }

    /**
     * Expiration month with no leading zero. Acceptable values are 1 through 12.
     *
     * @param int $expireMonth
     *
     * @return $this
     */
    public function setExpireMonth(int $expireMonth): static
    {
        $this->expireMonth = $expireMonth;

        return $this;
    }

    /**
     * Expiration month with no leading zero. Acceptable values are 1 through 12.
     *
     * @return ?int
     */
    public function getExpireMonth(): ?int
    {
        return $this->expireMonth;
    }

    /**
     * 4-digit expiration year.
     *
     * @param int $expireYear
     *
     * @return $this
     */
    public function setExpireYear(int $expireYear): static
    {
        $this->expireYear = $expireYear;

        return $this;
    }

    /**
     * 4-digit expiration year.
     *
     * @return ?int
     */
    public function getExpireYear(): ?int
    {
        return $this->expireYear;
    }

    /**
     * ID of credit card previously stored using `storePaymentMethod` parameter set to `true`.
     *
     * @param string $creditCardId
     *
     * @return $this
     */
    public function setCreditCardId(string $creditCardId): static
    {
        $this->creditCardId = $creditCardId;

        return $this;
    }

    /**
     * ID of credit card previously stored using `storePaymentMethod` parameter set to `true`.
     *
     * @return string|null
     */
    public function getCreditCardId(): string|null
    {
        return $this->creditCardId;
    }
}
