<?php
/**
 * Copyright © 2023 PayU Financial Services. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace PayU\Framework\Action;

use PayU\Api\ResponseInterface;
use PayU\Framework\Exception\ConfigurationException;
use PayU\Framework\Exception\InvalidCredentialException;
use PayU\Framework\Soap\Context;
use PayU\Framework\Gateway\Command;
use ReflectionException;
use SoapFault;

/**
 * Class Payment
 *
 * Payment with redirect action.
 *
 * @package PayU\Framework\Action
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

        $this->setResponse($response);

        return $response;
    }

    /**
     * PayU redirect url. Customer is redirected to PayU to capture payment details.
     *
     * @return string|null
     */
    public function getPayURedirectUrl(): ?string
    {
        $mode = $this->getContext()->get('mode');
        $reference = $this->getResponse()->getPayUReference();

        if (!$mode || !$reference) {
            return null;
        }

        return sprintf(self::REDIRECT_URL, $mode === 'sandbox' ? 'staging' : 'secure', $reference);
    }
}
