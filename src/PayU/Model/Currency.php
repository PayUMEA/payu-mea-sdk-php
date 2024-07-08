<?php
/**
 * Copyright © 2023 PayU Financial Services. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace PayUSdk\Model;

use PayUSdk\Api\Data\CurrencyInterface;
use PayUSdk\Framework\AbstractModel;

/**
 * Class Currency
 *
 * @package PayUSdk\Model
 */
class Currency extends AbstractModel implements CurrencyInterface
{
    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->getData(CurrencyInterface::CODE);
    }

    /**
     * @param string $code
     * @return $this
     */
    public function setCode(string $code): static
    {
        return $this->setData(CurrencyInterface::CODE, $code);
    }
}
