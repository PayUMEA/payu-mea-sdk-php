<?php
/**
 * Copyright © 2023 PayU Financial Services. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace PayUSdk\Framework\Action;

use PayUSdk\Api\ResponseInterface;
use PayUSdk\Framework\Exception\ConfigurationException;
use PayUSdk\Framework\Exception\InvalidCredentialException;
use PayUSdk\Framework\Soap\Context;
use PayUSdk\Framework\Gateway\Command;
use ReflectionException;
use SoapFault;

/**
 * Class Payment
 *
 * Payment with redirect action.
 *
 * @package PayUSdk\Framework\Action
 */
class Redirect extends BaseAction
{
    const REDIRECT_URL = 'https://%s.payu.co.za/rpp.do?PayUReference=%s';

    /**
     * @param string $action
     * @return ResponseInterface
     * @throws ConfigurationException
     * @throws InvalidCredentialException
     * @throws SoapFault
     */
    public function execute(string $action): ResponseInterface
    {
        $response =  $this->adapter->setup(
            [
                'subject' => $this,
                'action' => $action,
                'context' => $this->getContext()
            ]
        );

        $response->setPayURedirectUrl($this->getPayURedirectUrl($response));

        return $response;
    }

    /**
     * PayU redirect url. Customer is redirected to PayU to capture payment details.
     *
     * @param $response
     * @return string|null
     */
    public function getPayURedirectUrl($response): ?string
    {
        $mode = $this->getContext()->get('mode');
        $reference = $response->getPayUReference();

        if (!$mode || !$reference) {
            return null;
        }

        return sprintf(self::REDIRECT_URL, $mode === 'sandbox' ? 'staging' : 'secure', $reference);
    }
}
