<?php

/**
 * Copyright © 2023 PayU Financial Services. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace PayUSdk\Model;

use PayUSdk\Framework\AbstractModel;

/**
 * Class ShippingCost
 *
 * @package PayUSdk\Model
 */
class ShippingCost extends AbstractModel
{
    /**
     * @param \PayUSdk\Model\Total $amount
     * @return $this
     */
    public function setAmount(Total $amount): self
    {
        $this->setData('amount', $amount);
        return $this;
    }

    /**
     * @return \PayUSdk\Model\Total|null
     */
    public function getAmount(): ?Total
    {
        return $this->getData('amount');
    }

    /**
     * @param \PayUSdk\Model\Tax $tax
     * @return $this
     */
    public function setTax(Tax $tax): self
    {
        $this->setData('tax', $tax);
        return $this;
    }

    /**
     * @return \PayUSdk\Model\Tax|null
     */
    public function getTax(): ?Tax
    {
        return $this->getData('tax');
    }
}
