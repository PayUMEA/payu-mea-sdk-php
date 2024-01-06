<?php
/**
 * PayU MEA PHP SDK
 *
 * @copyright  Copyright (c) 2016 PayU
 * @license    http://opensource.org/licenses/LGPL-3.0  Open Software License (LGPL 3.0)
 * @link       http://www.payu.co.za
 * @link       http://help.payu.co.za/developers
 * @author     Kenneth Onah <kenneth@netcraft-devops.com>
 */

namespace PayUSdk\Model;

use PayUSdk\Api\Data\CartInterface;
use PayUSdk\Api\Data\ShippingAddressInterface;
use PayUSdk\Api\Data\TotalInterface;
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
