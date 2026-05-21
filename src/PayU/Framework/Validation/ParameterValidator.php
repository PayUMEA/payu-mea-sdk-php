<?php

/**
 * Copyright © 2023 PayU Financial Services. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace PayUSdk\Framework\Validation;

use PayUSdk\Framework\Data\DataObject;
use PayUSdk\Framework\Exception\InvalidArgumentException;
use PayUSdk\Framework\Exception\RequiredArgumentException;

/**
 * Class ParameterValidator
 *
 * @package PayUSdk\Framework\Validation
 */
class ParameterValidator
{
    /**
     * @var array<string, string[]>
     */
    private array $doTransaction = [
        'payment' => ['intent', 'customer', 'transaction', 'redirect_urls'],
        'reserve' => [],
        'credit' => [],
        'reserve_cancel' => [],
        'finalize' => []
    ];

    /**
     * @var array<string, string[]>
     */
    private array $setTransaction = [
        'payment' => ['intent', 'customer', 'transaction', 'redirect_urls'],
        'reserve' => ['intent', 'customer', 'transaction', 'redirect_urls']
    ];

    /**
     * @var array<string, string[]>
     */
    private array $getTransaction = [];

    /**
     * @param DataObject $resource
     * @param string $methodName
     * @return void
     * @throws InvalidArgumentException|RequiredArgumentException
     */
    public function validate(DataObject $resource, string $methodName): void
    {
        $params = $this->$methodName;
        $properties = $resource->toArray();

        if (isset($properties['intent'])) {
            switch ($properties['intent']) {
                case 'payment':
                    /** @var string[] $keys */
                    $keys = (array)array_keys($properties);
                    $this->checkRequiredParameter($keys, $params[$properties['intent']]);
                    break;
                default:
                    throw new InvalidArgumentException('Unknown SOAP method action requested');
            }
        }
    }

    /**
     * @param string[] $properties
     * @param string[] $params
     * @return void
     * @throws RequiredArgumentException
     */
    private function checkRequiredParameter(array $properties, array $params): void
    {
        if ($properties != $params) {
            throw new RequiredArgumentException('One of the required parameter is missing: ' . implode(', ', $params));
        }
    }
}
