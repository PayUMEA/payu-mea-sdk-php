<?php
/**
 * Copyright © 2023 PayU Financial Services. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace PayU\Model;

use PayU\Api\Data\LookupDataEntryInterface;
use PayU\Api\Data\LookupDataInterface;
use PayU\Framework\AbstractModel;

/**
 * Class LookupData
 *
 * @package PayU\Api
 */
class LookupData extends AbstractModel implements LookupDataInterface
{
    /**
     * @param LookupDataEntryInterface $entry
     * @return $this
     */
    public function setEntry(LookupDataEntryInterface $entry): static
    {
        return $this->setData(LookupDataInterface::ENTRY, $entry);
    }

    /**
     * @return LookupDataEntryInterface
     */
    public function getEntry(): LookupDataEntryInterface
    {
        return $this->getData(LookupDataInterface::ENTRY);
    }
}
