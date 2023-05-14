<?php
/**
 * Copyright © 2023 PayU Financial Services. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace PayU\Api\Data;

/**
 * Interface LookupDataInterface
 *
 * LookupData class contains response from SOAP method call with various `LookupTransactionType`
 * for instance `PAYMENT_METHODS`
 *
 * @package PayU\Api\Data
 */
interface LookupDataInterface
{
    /**#@+
     * Constants for keys of data array. Identical to the name of the getter in snake case.
     */
    /*
     * Look up entry.
     */
    const ENTRY = 'entry';

    /**
     * @return LookupDataEntryInterface Array of lookup data
     */
    public function getEntry(): LookupDataEntryInterface;

    /**
     * @param LookupDataEntryInterface $entry
     * @return $this
     */
    public function setEntry(LookupDataEntryInterface $entry): static;
}
