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

namespace PayU\Framework\Operation;

use PayU\Framework\Exception\ConfigurationException;
use PayU\Framework\Operation;
use PayU\Framework\Soap\ApiContext;
use PayU\Transport\Command;
use ReflectionException;
use SoapFault;

/**
 * Class Payment
 *
 * Lets you create, process and manage redirect payments.
 *
 * @package PayU\Api
 */
class Redirect extends Operation
{
    const REDIRECT_URL = 'https://%s.payu.co.za/rpp.do?PayUReference=%s';

    /**
     * PayU redirect url. Customer is redirected to PayU to capture payment details.
     *
     * @return string|null
     */
    public function getPayURedirectUrl(): ?string
    {
        $mode = parent::$apiContext->get('mode');
        $reference = $this->return->payUReference;

        if (!$mode || !$reference) {
            return null;
        }

        return sprintf(self::REDIRECT_URL, $mode === 'sandbox' ? 'staging' : 'secure', $reference);
    }

    /**
     * Executes, or completes direct payment processing.
     *
     * @param ApiContext|null $apiContext is the APIContext for this call. It can be used to pass dynamic
     * configuration and credentials.
     * @param Command|null $soapCall is the SOAP Call Service that is used to make API calls
     * @return Redirect resource object
     * @throws ConfigurationException
     * @throws ReflectionException
     * @throws SoapFault
     */
    public function create(ApiContext $apiContext = null, Command $soapCall = null): static
    {
        $methodName = 'doTransaction';
        $payload = $this->request->parseForRedirectAPI($this);

        $json = self::executeCall(
            $methodName,
            $payload,
            [],
            $apiContext,
            $soapCall
        );
        $this->fromJson($json);

        return $this;
    }
}
