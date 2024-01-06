<?php
/**
 * Copyright © 2023 PayU Financial Services. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace PayUSdk\Model;

use PayUSdk\Api\Data\ItemInterface;
use PayUSdk\Framework\AbstractModel;
use PayUSdk\Framework\Formatter;

/**
 * Class Item
 *
 * @package PayUSdk\Api
 */
class Item extends AbstractModel implements ItemInterface
{
    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->getData(ItemInterface::NAME);
    }

    /**
     * @return string
     */
    public function getSku(): string
    {
        return $this->getData(ItemInterface::SKU);
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->getData(ItemInterface::QUANTITY);
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->getData(ItemInterface::PRICE);
    }

    /**
     * @return float
     */
    public function getCostPrice(): float
    {
        return $this->getData(ItemInterface::COST_PRICE);
    }

    /**
     * @return float
     */
    public function getTotal(): float
    {
        return $this->getData(ItemInterface::TOTAL);
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName(string $name): static
    {
        return $this->setData(ItemInterface::NAME, $name);
    }

    /**
     * @param string $sku
     * @return $this
     */
    public function setSku(string $sku): static
    {
        return $this->setData(ItemInterface::SKU, $sku);
    }

    /**
     * @param int $quantity
     * @return $this
     */
    public function setQuantity(int $quantity): static
    {
        return $this->setData(ItemInterface::QUANTITY, $quantity);
    }

    /**
     * @param float $price
     * @return $this
     */
    public function setPrice(float $price): static
    {
        return $this->setData(ItemInterface::PRICE, $price);
    }

    /**
     * @param float $costPrice
     * @return $this
     */
    public function setCostPrice(float $costPrice): static
    {
        return $this->setData(ItemInterface::COST_PRICE, $costPrice);
    }

    /**
     * @param float $total
     * @return $this
     */
    public function setTotal(float $total): static
    {
        return $this->setData(ItemInterface::TOTAL, $total);
    }
}
