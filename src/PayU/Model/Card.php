<?php
/**
 * Copyright © 2023 PayU Financial Services. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace PayUSdk\Model;

use PayUSdk\Api\Data\AddressInterface;
use PayUSdk\Api\Data\CardInterface;
use PayUSdk\Framework\AbstractModel;

/**
 * Class Card
 *
 * @package PayUSdk\Model
 */
class Card extends AbstractModel implements CardInterface
{
    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->getData(CardInterface::ID);
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->getData(CardInterface::TYPE);
    }

    /**
     * @return AddressInterface
     */
    public function getBillingAddress(): AddressInterface
    {
        return $this->getData(CardInterface::BILLING_ADDRESS);
    }

    /**
     * @param string $id
     * @return $this
     */
    public function setId(string $id): static
    {
        return $this->setData(CardInterface::ID, $id);
    }

    /**
     * @param string $type
     * @return $this
     */
    public function setType(string $type): static
    {
        return $this->setData(CardInterface::TYPE, $type);
    }

    /**
     * @param AddressInterface $address
     * @return $this
     */
    public function setBillingAddress(AddressInterface $address): static
    {
        return $this->setData(CardInterface::BILLING_ADDRESS, $address);
    }
}
