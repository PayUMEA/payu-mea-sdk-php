<?php
/**
 * Copyright © 2023 PayU Financial Services. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace PayU\Model;

use PayU\Api\Data\ItemInterface;
use PayU\Framework\AbstractModel;

/**
 * Class ItemList
 *
 * List of items in the cart.
 *
 * @package PayU\Api
 */
class ItemList extends AbstractModel
{
    /**
     * Append Items to the list.
     *
     * @param ItemInterface $item
     *
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
     * @return ?array
     */
    public function getItems(): ?array
    {
        return $this->getData('items');
    }

    /**
     * List of items.
     *
     * @param array $items
     *
     * @return $this
     */
    public function setItems(array $items): static
    {
        return $this->setData('items', $items);
    }

    /**
     * Remove Items from the list.
     *
     * @param Item $item
     *
     * @return $this
     */
    public function removeItem(Item $item): static
    {
        return $this->setItems(
            array_diff($this->getItems(), [$item])
        );
    }
}
