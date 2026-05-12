<?php

/**
 * Copyright © 2023 PayU Financial Services. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace PayUSdk\Model;

use PayUSdk\Framework\AbstractModel;

/**
 * Class PaymentMethod
 *
 * @package PayUSdk\Model
 */
class PaymentMethod extends AbstractModel
{
    public const TYPE_CREDITCARD = 'CREDITCARD';
    public const TYPE_DEBIT_ORDER = 'DEBIT_ORDER';
    public const TYPE_EFT_PRO = 'EFT_PRO';
    public const TYPE_SMARTEFT = 'SMARTEFT';
    public const TYPE_EBUCKS = 'EBUCKS';
    public const TYPE_CREDITCARD_TOKEN = 'CREDITCARD_TOKEN';
    public const TYPE_DISCOVERYMILES = 'DISCOVERYMILES';
    public const TYPE_REAL_TIME_RECURRING = 'REAL_TIME_RECURRING';

    /**
     * The payment method id. This is in the form of a token
     *
     * @param string $id
     *
     * @return $this
     */
    public function setId($id)
    {
        return $this->setData('id', $id);
    }

    /**
     * The payment method id. This is in the form of a token
     *
     * @return string
     */
    public function getId()
    {
        $id = $this->getData('id');
        if ($id) {
            return $id;
        }

        return $this->getData('pm_id');
    }

    /**
     * The card number.
     *
     * @param string $number
     *
     * @return $this
     */
    public function setCardNumber($number)
    {
        return $this->setData('card_number', $number);
    }

    /**
     * The card number.
     *
     * @return string
     */
    public function getCardNumber()
    {
        return $this->getData('card_number');
    }

    /**
     * The card type.
     * Valid Values: ["VISA", "MASTERCARD"]
     *
     * @param string $type
     *
     * @return $this
     */
    public function setInformation($type)
    {
        return $this->setData('information', $type);
    }

    /**
     * The card type.
     *
     * @return string
     */
    public function getInformation()
    {
        return $this->getData('information');
    }

    /**
     * Payment amount in integer
     *
     * @param mixed $amountInCents
     *
     * @return $this
     */
    public function setAmountInCents($amountInCents)
    {
        return $this->setData('amount_in_cents', $amountInCents);
    }

    /**
     * Payment amount in integer
     *
     * @return string
     */
    public function getAmountInCents()
    {
        return (string)$this->getData('amount_in_cents');
    }

    /**
     * The expiry date for the card.
     *
     * @param string $expiry
     *
     * @return $this
     */
    public function setCardExpiry($expiry)
    {
        return $this->setData('card_expiry', $expiry);
    }

    /**
     * The expiry date for the card.
     *
     * @return string
     */
    public function getCardExpiry()
    {
        return $this->getData('card_expiry');
    }

    /**
     * The validation code for the card.
     *
     * @param string $cvv
     *
     * @return $this
     */
    public function setCvv($cvv)
    {
        return $this->setData('cvv', $cvv);
    }

    /**
     * The validation code for the card.
     *
     * @return string
     */
    public function getCvv()
    {
        return $this->getData('cvv');
    }

    /**
     * The full name of the card holder.
     *
     * @param string $name
     *
     * @return $this
     */
    public function setNameOnCard($name)
    {
        return $this->setData('name_on_card', $name);
    }

    /**
     * The full name of the card holder.
     *
     * @return string
     */
    public function getNameOnCard()
    {
        return $this->getData('name_on_card');
    }

    /**
     * The verified status of the payment method.
     *
     * @param string $verified
     *
     * @return $this
     */
    public function setVerified($verified)
    {
        return $this->setData('verified', $verified);
    }

    /**
     * The verified status of the payment method.
     *
     * @return string
     */
    public function getVerified()
    {
        return $this->getData('verified');
    }

    /**
     * The payment method ID
     *
     * @param string $pmId
     *
     * @return $this
     */
    public function setPmId($pmId)
    {
        return $this->setData('pm_id', $pmId);
    }

    /**
     * The payment method ID
     *
     * @return string
     */
    public function getPmId()
    {
        return $this->getData('pm_id');
    }

    /**
     * The payment method description set by the user
     *
     * @param mixed $description
     *
     * @return $this
     */
    public function setDescription($description)
    {
        return $this->setData('description', $description);
    }

    /**
     * The payment method description set by the user
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->getData('description');
    }

    /**
     * The default payment method
     *
     * @param mixed $defaultPM
     *
     * @return $this
     */
    public function setDefaultPM($defaultPM)
    {
        return $this->setData('default_pm', $defaultPM);
    }

    /**
     * The default payment method
     *
     * @return string
     */
    public function getDefaultPM()
    {
        return $this->getData('default_pm');
    }

    /**
     * EFT funding instrument reference
     *
     * @param mixed $reference
     *
     * @return $this
     */
    public function setReference($reference)
    {
        return $this->setData('reference', $reference);
    }

    /**
     * EFT funding instrument reference
     *
     * @return string
     */
    public function getReference()
    {
        return $this->getData('reference');
    }

    /**
     * eBucks funding instrument token
     *
     * @param mixed $ebucksToken
     *
     * @return $this
     */
    public function setEbucksToken($ebucksToken)
    {
        return $this->setData('ebucks_token', $ebucksToken);
    }

    /**
     * eBucks funding instrument token
     *
     * @return string
     */
    public function getEbucksToken()
    {
        return $this->getData('ebucks_token');
    }
}
