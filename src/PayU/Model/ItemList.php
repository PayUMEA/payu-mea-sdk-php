<?php

/**
 * Copyright © 2023 PayU Financial Services. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace PayUSdk\Model;

use PayUSdk\Api\Data\ItemInterface;
use PayUSdk\Api\Data\ItemListInterface;

/**
 * Class ItemList
 *
 * List of items in the cart.
 *
 * @package PayUSdk\Api
 */
class ItemList extends PayUModel implements ItemListInterface
{
    /**
     * Append Items to the list.
     *
     * @param ItemInterface $item
     * @return $this
     */
    public function addItem(ItemInterface $item): static
    {
        if (!$this->getItems()) {
            return $this->setItems([$item]);
        } else {
            return $this->setItems($this->getItems() + [$item]);
        }
    }

    /**
     * List of items.
     *
     * @return ?ItemInterface[]
     */
    public function getItems(): ?array
    {
        return $this->getData(ItemListInterface::ITEMS);
    }

    /**
     * List of items.
     *
     * @param ItemInterface[] $items
     * @return $this
     */
    public function setItems(array $items): static
    {
        return $this->setData(ItemListInterface::ITEMS, $items);
    }

    /**
     * Remove Items from the list.
     *
     * @param ItemInterface $item
     * @return $this
     */
    public function removeItem(ItemInterface $item): static
    {
        $items = $this->getItems() ?? [];
        $items = array_filter($items, function ($existingItem) use ($item) {
            return $existingItem !== $item;
        });

        return $this->setItems($items);
    }
}
