<?php
/**
 * Copyright © 2023 PayU Financial Services. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace PayU\Api\Data;

/**
 * Interface LookupDataEntryInterface
 *
 * LookupDataEntry class contains lookup data key-value pair details
 *
 * @package PayU\Api\Data
 */
interface LookupDataEntryInterface
{
    /**#@+
     * Constants for keys of data array. Identical to the name of the getter in snake case.
     */
    /*
     * Array key.
     */
    const KEY = 'key';
    /*
     * Array value.
     */
    const VALUE = 'value';

    /**
     * @return string string value
     */
    public function getKey(): string;

    /**
     * @return DetailsInterface JSON string value
     */
    public function getValue(): DetailsInterface;

    /**
     * @param string $key
     * @return $this
     */
    public function setKey(string $key): static;

    /**
     * @param string $value
     * @return $this
     */
    public function setValue(string $value): static;
}
