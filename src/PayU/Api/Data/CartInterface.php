<?php
/**
 * Copyright © 2023 PayU Financial Services. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace PayU\Api\Data;

use PayU\Model\ItemList;

/**
 * Interface CartInterface
 *
 * A summary of shopping cart
 *
 * @package PayU\Api\Data
 */
interface CartInterface
{
    /**#@+
     * Constants for keys of data array. Identical to the name of the getter in snake case.
     */
    /*
     * Total.
     */
    const TOTAL = 'total';
    /*
     * Cart items.
     */
    const ITEMS = 'items';

    /**
     * @return float Total amount
     */
    public function getTotal(): float;

    /**
     * @return ItemList Cart items
     */
    public function getItems(): ItemList;

    /**
     * @param float $total
     * @return $this
     */
    public function setTotal(float $total): static;

    /**
     * @param ItemList $items
     * @return $this
     */
    public function setItems(ItemList $items): static;
}
