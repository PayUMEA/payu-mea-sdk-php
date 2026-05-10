<?php
/**
 * PayU MEA PHP SDK
 *
 * @copyright  Copyright (c) 2016 PayU
 * @license    http://opensource.org/licenses/LGPL-3.0  Open Software License (LGPL 3.0)
 * @link http://www.payu.co.za
 * @link http://help.payu.co.za/developers
 * @author Kenneth Onah <kenneth@netcraft-devops.com>
 */

namespace PayUSdk\Framework\Validation;

use PayUSdk\Framework\Exception\InvalidArgumentException;
use PayUSdk\Framework\Exception\RequiredArgumentException;
use PayUSdk\Framework\Data\DataObject;

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
    private array $doTransaction = array(
        'payment' => array('intent', 'customer', 'transaction', 'redirect_urls'),
        'reserve' => array(),
        'credit' => array(),
        'reserve_cancel' => array(),
        'finalize' => array()
    );

    /**
     * @var array<string, string[]>
     */
    private array $setTransaction = array(
        'payment' => array('intent', 'customer', 'transaction', 'redirect_urls'),
        'reserve' => array('intent', 'customer', 'transaction', 'redirect_urls')
    );

    /**
     * @var array<string, string[]>
     */
    private array $getTransaction = array();

    /**
     * @param DataObject<string, mixed> $resource
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
                    $this->checkRequiredParameter(array_keys($properties), $params[$properties['intent']]);
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
        if ($properties != $params)
            throw new RequiredArgumentException('One of the required parameter is missing: ' . implode(', ', $params));
    }
}
