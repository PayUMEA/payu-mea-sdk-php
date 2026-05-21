<?php

/**
 * Copyright © 2023 PayU Financial Services. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace PayUSdk\Api\Data;

interface ItemListInterface
{
    /**#@+
     * Constants for keys of data array. Identical to the name of the getter in snake case.
     */
    /*
     * Key.
     */
    public const ITEMS = 'items';

    /**
     * @param ItemInterface $item
     * @return static
     */
    public function addItem(ItemInterface $item): static;

    /**
     * @return ?ItemInterface[]
     */
    public function getItems(): ?array;

    /**
     * @param ItemInterface[] $items
     * @return $this
     */
    public function setItems(array $items): static;

    /**
     * @param Item $item
     * @return $this
     */
    public function removeItem(Item $item): static;
}
