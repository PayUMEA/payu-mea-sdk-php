<?php
/**
 * Copyright © 2023 PayU Financial Services. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace PayU\Api\Data;

/**
 * Interface CustomerDetailInterface
 *
 * Represents the details of a customer
 *
 * @package PayU\Api\Data
 */
interface CustomerDetailInterface
{
    /**#@+
     * Constants for keys of data array. Identical to the name of the getter in snake case.
     */
    /*
     * Email.
     */
    const EMAIL = 'email';
    /*
     * First name.
     */
    const FIRST_NAME = 'first_name';
    /*
     * Last name.
     */
    const LAST_NAME = 'last_name';
    /*
     * Customer Id.
     */
    const CUSTOMER_ID = 'customer_id';
    /*
     * Customer phone.
     */
    const PHONE = 'phone';
    /*
     * IP address.
     */
    const IP_ADDRESS = 'ip_address';
    /*
     * Address.
     */
    const ADDRESS = 'address';

    /**
     * @return string Customer email
     */
    public function getEmail(): string;

    /**
     * @return string Customer first name
     */
    public function getFirstName(): string;

    /**
     * @return string Customer last name
     */
    public function getLastName(): string;

    /**
     * @return string Customer id
     */
    public function getCustomerId(): string;

    /**
     * @return PhoneInterface
     */
    public function getPhone(): PhoneInterface;

    /**
     * @return string Customer ip address
     */
    public function getIpAddress(): string;

    /**
     * @return AddressInterface Customer address
     */
    public function getAddress(): AddressInterface;

    /**
     * @param string $email
     * @return $this
     */
    public function setEmail(string $email): static;

    /**
     * @param string $firstName
     * @return $this
     */
    public function setFirstName(string $firstName): static;

    /**
     * @param string $lastName
     * @return $this
     */
    public function setLastName(string $lastName): static;

    /**
     * @param string $customerId
     * @return $this
     */
    public function setCustomerId(string $customerId): static;

    /**
     * @param PhoneInterface $phone
     * @return $this
     */
    public function setPhone(PhoneInterface $phone): static;

    /**
     * @param string $ipAddress
     * @return $this
     */
    public function setIpAddress(string $ipAddress): static;

    /**
     * @param AddressInterface $address
     * @return $this
     */
    public function setAddress(AddressInterface $address): static;
}
