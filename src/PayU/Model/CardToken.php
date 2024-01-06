<?php
/**
 * Copyright © 2023 PayU Financial Services. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace PayUSdk\Model;

use PayUSdk\Api\Data\CardTokenInterface;
use PayUSdk\Framework\AbstractModel;

/**
 * Class CardToken
 *
 * @package PayPal\Model
 */
class CardToken extends AbstractModel implements CardTokenInterface
{
    /**
     * @param string $id
     * @return $this
     */
    public function setId(string $id): static
    {
        return $this->setData(CardTokenInterface::ID, $id);
    }

    /**
     * @param string $lastFour
     * @return $this
     */
    public function setLastFourDigits(string $lastFour): static
    {
        return $this->setData(CardTokenInterface::LAST_FOUR, $lastFour);
    }

    /**
     * @param string $type
     * @return $this
     */
    public function setType(string $type): static
    {
        return $this->setData(CardTokenInterface::TYPE, $type);
    }

    /**
     * @param string $cvv
     * @return $this
     */
    public function setCvv(string $cvv): static
    {
        return $this->setData(CardTokenInterface::CVV, $cvv);
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->getData(CardTokenInterface::ID);
    }

    /**
     * @return string
     */
    public function getLastFourDigits(): string
    {
        return $this->getData(CardTokenInterface::LAST_FOUR);
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->getData(CardTokenInterface::TYPE);
    }

    /**
     * @return string
     */
    public function getCvv(): string
    {
        return $this->getData(CardTokenInterface::CVV);
    }
}
