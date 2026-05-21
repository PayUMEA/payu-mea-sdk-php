<?php

/**
 * Copyright © 2023 PayU Financial Services. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace PayUSdk\Model;

/**
 * Class Merchant
 *
 * A resource representing a Merchant who receives the funds and fulfills the order.
 *
 * @package PayUSdk\Model
 */
class Merchant extends PayUModel
{
    /**
     * Email Address associated with the Payee's PayU Account.
     *
     * @param string $email
     * @return $this
     */
    public function setEmail(string $email): static
    {
        return $this->setData('email', $email);
    }

    /**
     * Email Address associated with the Merchant's PayU Account.
     *
     * @return ?string
     */
    public function getEmail(): ?string
    {
        return $this->getData('email');
    }

    /**
     * PayU account identifier for the Merchant.
     *
     * @param string $merchantId
     * @return $this
     */
    public function setMerchantId(string $merchantId): static
    {
        return $this->setData('merchant_id', $merchantId);
    }

    /**
     * PayU account identifier for the Merchant.
     *
     * @return ?string
     */
    public function getMerchantId(): ?string
    {
        return $this->getData('merchant_id');
    }

    /**
     * First Name of the Payee.
     *
     * @param string $firstName
     * @return $this
     */
    public function setFirstName(string $firstName): static
    {
        return $this->setData('first_name', $firstName);
    }

    /**
     * First Name of the Payee.
     *
     * @return ?string
     */
    public function getFirstName(): ?string
    {
        return $this->getData('first_name');
    }

    /**
     * Last Name of the Payee.
     *
     * @param string $lastName
     * @return $this
     */
    public function setLastName(string $lastName): static
    {
        return $this->setData('last_name', $lastName);
    }

    /**
     * Last Name of the Payee.
     *
     * @return ?string
     */
    public function getLastName(): ?string
    {
        return $this->getData('last_name');
    }

    /**
     * PayU account Number of the Merchant
     *
     * @param string $accountNumber
     * @return $this
     */
    public function setAccountNumber(string $accountNumber): static
    {
        return $this->setData('account_number', $accountNumber);
    }

    /**
     * PayU account Number of the Merchant
     *
     * @return ?string
     */
    public function getAccountNumber(): ?string
    {
        return $this->getData('account_number');
    }

    /**
     * Information related to the Payee.
     *
     * @param mixed $phone
     * @return $this
     */
    public function setPhone(mixed $phone): static
    {
        return $this->setData('phone', $phone);
    }

    /**
     * Information related to the Merchant.
     *
     * @return mixed
     */
    public function getPhone(): mixed
    {
        return $this->getData('phone');
    }
}
