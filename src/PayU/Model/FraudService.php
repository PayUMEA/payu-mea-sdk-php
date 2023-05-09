<?php
/**
 * PayU EMEA PHP SDK
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
 * Class FraudService
 *
 * Details of Fraud Management (FM).
 *
 * @package PayU\Api
 *
 * @property string checkFraudOverride
 * @property string merchantWebsite
 * @property string pcFingerPrint
 * @property string resultCode
 * @property string resultMessage
 */
class FraudService extends PayUModel
{
    /**
     * Check Fraud Override filter.
     *
     * @param string $checkFraudOverride
     *
     * @return $this
     */
    public function setCheckFraudOverride(string $checkFraudOverride): static
    {
        $this->checkFraudOverride = $checkFraudOverride;

        return $this;
    }

    /**
     * Check Fraud Override filter.
     *
     * @return string|null
     */
    public function getCheckFraudOverride(): string|null
    {
        return $this->checkFraudOverride;
    }

    /**
     * Merchant website
     *
     * @param string $merchantWebsite
     *
     * @return $this
     */
    public function setMerchantWebsite(string $merchantWebsite): static
    {
        $this->merchantWebsite = $merchantWebsite;

        return $this;
    }

    /**
     * Merchant website
     *
     * @return string|null
     */
    public function getMerchantWebsite(): string|null
    {
        return $this->merchantWebsite;
    }

    /**
     * Finger print of client machine.
     *
     * @param string $pcFingerPrint
     *
     * @return $this
     */
    public function setPCFingerPrint(string $pcFingerPrint): static
    {
        $this->pcFingerPrint = $pcFingerPrint;

        return $this;
    }

    /**
     * Fingerprint of client machine.
     *
     * @return string|null
     */
    public function getPCFingerPrint(): string|null
    {
        return $this->pcFingerPrint;
    }

    /**
     * Fraud management processing result code.
     *
     * @param string $resultCode
     *
     * @return $this
     */
    public function setResultCode(string $resultCode): static
    {
        $this->resultCode = $resultCode;

        return $this;
    }

    /**
     * Fraud management processing result code.
     *
     * @return string|null
     */
    public function getResultCode(): string|null
    {
        return $this->resultCode;
    }

    /**
     * Fraud management processing result message.
     *
     * @param string $resultMessage
     *
     * @return $this
     */
    public function setResultMessage(string $resultMessage): static
    {
        $this->resultMessage = $resultMessage;

        return $this;
    }

    /**
     * Fraud management processing result message.
     *
     * @return string|null
     */
    public function getResultMessage(): string|null
    {
        return $this->resultMessage;
    }
}
