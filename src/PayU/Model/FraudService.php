<?php
/**
 * Copyright © 2023 PayU Financial Services. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace PayUSdk\Model;

use PayUSdk\Api\Data\FraudServiceInterface;
use PayUSdk\Framework\AbstractModel;

/**
 * Class FraudService
 *
 * Details of Fraud Management (FM).
 *
 * @package PayUSdk\Api
 *
 * @property string checkFraudOverride
 * @property string merchantWebsite
 * @property string pcFingerPrint
 * @property string resultCode
 * @property string resultMessage
 */
class FraudService extends AbstractModel implements FraudServiceInterface
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
        return $this->setData('check_fraud_override', $checkFraudOverride);
    }

    /**
     * Check Fraud Override filter.
     *
     * @return string|null
     */
    public function getCheckFraudOverride(): string|null
    {
        return $this->getData('check_fraud_override');
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
        return $this->setData('merchant_website', $merchantWebsite);
    }

    /**
     * Merchant website
     *
     * @return string|null
     */
    public function getMerchantWebsite(): string|null
    {
        return $this->getData('merchant_website');
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
        return $this->setData('pc_finger_print', $pcFingerPrint);
    }

    /**
     * Fingerprint of client machine.
     *
     * @return string|null
     */
    public function getPCFingerPrint(): string|null
    {
        return $this->getData('pc_finger_print');
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
        return $this->setData('result_code', $resultCode);
    }

    /**
     * Fraud management processing result code.
     *
     * @return string|null
     */
    public function getResultCode(): string|null
    {
        return $this->getData('result_code');
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
        return $this->setData('result_message', $resultMessage);
    }

    /**
     * Fraud management processing result message.
     *
     * @return string|null
     */
    public function getResultMessage(): string|null
    {
        return $this->getData('result_message');
    }
}
