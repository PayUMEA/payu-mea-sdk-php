<?php

/**
 * Copyright © 2023 PayU Financial Services. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace PayUSdk\Api\Data;

interface CustomFieldsInterface
{
    /**#@+
     * Constants for keys of data array. Identical to the name of the getter in snake case.
     */
    /*
     * Key.
     */
    public const KEY = 'key';
    /*
     * Value.
     */
    public const VALUE = 'value';

    /**
     * @return string
     */
    public function getKey(): string;

    /**
     * @return mixed
     */
    public function getValue(): mixed;

    /**
     * @param string $key
     * @return $this
     */
    public function setKey(string $key): static;

    /**
     * @param mixed $value
     * @return $this
     */
    public function setValue(mixed $value): static;
}
