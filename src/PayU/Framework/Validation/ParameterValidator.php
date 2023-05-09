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

namespace PayU\Validation;

use PayU\Exception\InvalidArgumentException;
use PayU\Exception\RequiredArgumentException;
use PayU\Resource;

/**
 * Class ParameterValidator
 *
 * @package PayU\Validation
 */
class ParameterValidator
{
    private $doTransaction = array(
        'payment' => array('intent', 'customer', 'transaction', 'redirect_urls'),
        'reserve' => array(),
        'credit' => array(),
        'reserve_cancel' => array(),
        'finalize' => array()
    );

    private $setTransaction = array(
        'payment' => array('intent', 'customer', 'transaction', 'redirect_urls'),
        'reserve' => array('intent', 'customer', 'transaction', 'redirect_urls')
    );

    private $getTransaction = array();

    public function validate(Resource $resource, $methodName)
    {
        $params = $this->$methodName;
        $properties = $resource->toArray();

        if (isset($properties['intent'])) {
            switch ($properties['intent']) {
                case 'payment':
                    call_user_func(array($this, 'checkRequiredParameter'), array_keys($properties), $params[$properties['intent']]);
                    break;
                default:
                    new InvalidArgumentException('Unknown SOAP method action requested');
            }
        }
    }

    private function checkRequiredParameter($properties, $params)
    {
        if ($properties != $params)
            throw new RequiredArgumentException('One of the required parameter is missing: ' . implode(', ', $params));
    }
}