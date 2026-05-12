<?php

/**
 * Copyright © 2023 PayU Financial Services. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace PayUSdk\Model;

use PayUSdk\Api\Data\CartInterface;
use PayUSdk\Framework\AbstractModel;

/**
 * Class Cart
 *
 * @package PayUSdk\Model
 */
class Cart extends AbstractModel implements CartInterface
{
    /**
     * @return float
     */
    public function getTotal(): float
    {
        return $this->getData(CartInterface::TOTAL);
    }

    /**
     * @return ItemList
     */
    public function getItems(): ItemList
    {
        return $this->getData(CartInterface::ITEMS);
    }

    /**
     * Basket amount in cents converted to integer
     *
     * @param float $total
     * @return $this
     */
    public function setTotal(float $total): static
    {
        return $this->setData(CartInterface::TOTAL, $total);
    }

    /**
     * @param ItemList $items
     * @return $this
     */
    public function setItems(ItemList $items): static
    {
        return $this->setData(CartInterface::ITEMS, $items);
    }
}
