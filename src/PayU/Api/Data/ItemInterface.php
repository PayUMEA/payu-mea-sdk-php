<?php
/**
 * Copyright © 2023 PayU Financial Services. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace PayUSdk\Api\Data;

/**
 * Interface ItemInterface
 *
 * Cart items representation
 *
 * @package PayUSdk\Api\Data
 */
interface ItemInterface
{
    /**#@+
     * Constants for keys of data array. Identical to the name of the getter in snake case.
     */
    /*
     * Item name.
     */
    const NAME = 'name';
    /*
     * Item SKU.
     */
    const SKU = 'sku';
    /*
     * Item quantity.
     */
    const QUANTITY = 'quantity';
    /*
     * Item price.
     */
    const PRICE = 'price';
    /*
     * Item cost price.
     */
    const COST_PRICE = 'cost_price';
    /*
     * Item total.
     */
    const TOTAL = 'total';

    /**
     * @return string Item name
     */
    public function getName(): string;

    /**
     * @return string Item sku
     */
    public function getSku(): string;

    /**
     * @return int Item quantity
     */
    public function getQuantity(): int;

    /**
     * @return float Item price
     */
    public function getPrice(): float;

    /**
     * @return float Item cost price
     */
    public function getCostPrice(): float;

    /**
     * @return float Item total
     */
    public function getTotal(): float;

    /**
     * @param string $name
     * @return $this
     */
    public function setName(string $name): static;

    /**
     * @param string $sku
     * @return $this
     */
    public function setSku(string $sku): static;

    /**
     * @param int $quantity
     * @return $this
     */
    public function setQuantity(int $quantity): static;

    /**
     * @param float $price
     * @return $this
     */
    public function setPrice(float $price): static;

    /**
     * @param float $costPrice
     * @return $this
     */
    public function setCostPrice(float $costPrice): static;

    /**
     * @param float $total
     * @return $this
     */
    public function setTotal(float $total): static;
}
