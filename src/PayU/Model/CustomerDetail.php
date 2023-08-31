<?php
/**
 * Copyright © 2023 PayU Financial Services. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace PayU\Model;

use PayU\Api\Data\AddressInterface;
use PayU\Api\Data\CustomerDetailInterface;
use PayU\Api\Data\PhoneInterface;
use PayU\Framework\AbstractModel;

/**
 * Class CustomerDetail
 *
 * @package PayU\Model
 */
class CustomerDetail extends AbstractModel implements CustomerDetailInterface
{
    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->getData(CustomerDetailInterface::EMAIL);
    }


    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->getData(CustomerDetailInterface::FIRST_NAME);
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->getData(CustomerDetailInterface::LAST_NAME);
    }

    /**
     * @return string
     */
    public function getCustomerId(): string
    {
        return $this->getData(CustomerDetailInterface::CUSTOMER_ID);
    }

    /**
     * @return PhoneInterface
     */
    public function getPhone(): PhoneInterface
    {
        return $this->getData(CustomerDetailInterface::PHONE);
    }

    /**
     * @return string
     */
    public function getIpAddress(): string
    {
        return $this->getData(CustomerDetailInterface::IP_ADDRESS);
    }

    /**
     * @return AddressInterface
     */
    public function getAddress(): AddressInterface
    {
        return $this->getData(CustomerDetailInterface::ADDRESS);
    }

    /**
     * @return string
     */
    public function getRegionalId(): ?string
    {
        return $this->getData(CustomerDetailInterface::REGIONAL_ID);
    }

    /**
     * @param string $email
     * @return $this
     */
    public function setEmail(string $email): static
    {
        return $this->setData(CustomerDetailInterface::EMAIL, $email);
    }

    /**
     * @param string $firstName
     * @return $this
     */
    public function setFirstName(string $firstName): static
    {
        return $this->setData(CustomerDetailInterface::FIRST_NAME, $firstName);
    }

    /**
     * @param string $lastName
     * @return $this
     */
    public function setLastName(string $lastName): static
    {
        return $this->setData(CustomerDetailInterface::LAST_NAME, $lastName);
    }

    /**
     * @param string $customerId
     * @return $this
     */
    public function setCustomerId(string $customerId): static
    {
        return $this->setData(CustomerDetailInterface::CUSTOMER_ID, $customerId);
    }

    /**
     * @param PhoneInterface $phone
     * @return $this
     */
    public function setPhone(PhoneInterface $phone): static
    {
        return $this->setData(CustomerDetailInterface::PHONE, $phone);
    }

    /**
     * @param string $ipAddress
     * @return $this
     */
    public function setIpAddress(string $ipAddress): static
    {
        return $this->setData(CustomerDetailInterface::IP_ADDRESS, $ipAddress);
    }

    /**
     * @param AddressInterface $address
     * @return $this
     */
    public function setAddress(AddressInterface $address): static
    {
        return $this->setData(CustomerDetailInterface::ADDRESS, $address);
    }

    /**
     * @param AddressInterface $address
     * @return $this
     */
    public function setRegionalId(string $identification): static
    {
        return $this->setData(CustomerDetailInterface::REGIONAL_ID, $identification);
    }
}
