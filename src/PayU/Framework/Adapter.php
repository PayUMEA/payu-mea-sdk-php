<?php
/**
 * Copyright © 2023 PayU Financial Services. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace PayUSdk\Framework;

use PayUSdk\Api\AdapterInterface;
use PayUSdk\Api\ResponseInterface;
use PayUSdk\Framework\Data\DataObject;
use PayUSdk\Framework\Exception\ConfigurationException;
use PayUSdk\Framework\Exception\InvalidCredentialException;
use PayUSdk\Framework\Gateway\Command;
use PayUSdk\Framework\Soap\Context;
use PayUSdk\Framework\Validation\ArgumentValidator;
use SoapFault;

/**
 * Class Adapter
 *
 * An executable operation such as payment, refund, capture etc.
 * @package PayUSdk\Framework
 */
class Adapter extends DataObject implements AdapterInterface
{
    /**
     * Call command on PayU gateway
     *
     * @param array $arguments
     * @return array response of the transaction
     * @throws ConfigurationException
     * @throws InvalidCredentialException
     * @throws SoapFault
     */
    protected static function execute(array $arguments): array
    {
        // Initialize the context and command object if not provided explicitly
        $context = $arguments['context'] ?? new Context();
        $command = new Command($context);
        $arguments['handlers'][] = 'PayUSdk\Handler\GatewayConfigHandler';

        return $command->execute($arguments);
    }

    /**
     * Shows details a of payment or redirect resource.
     *
     * @param array $arguments
     * @return ResponseInterface resource object
     * @throws ConfigurationException
     * @throws InvalidCredentialException
     * @throws SoapFault
     */
    public static function get(array $arguments): ResponseInterface
    {
        $arguments['method'] = 'getTransaction';
        $reference = $arguments['subject']->getPayUReference();
        ArgumentValidator::validate($reference, 'PayUReference');

        $result = self::execute($arguments);

        return new Response($result['return']);
    }

    /**
     * Set up a redirect payment process. In the JSON request body, include a `redirect` object with the intent,
     * customer, fundingInstrument, transaction etc. Also include return, notify, and cancel URLs in the `redirect` object.
     *
     * @param array $arguments
     * @return ResponseInterface resource object
     * @throws ConfigurationException
     * @throws InvalidCredentialException
     * @throws SoapFault
     */
    public function setup(array $arguments): ResponseInterface
    {
        $arguments['method'] = 'setTransaction';
        $result = self::execute($arguments);

        return new Response($result['return']);
    }

    /**
     * Executes, or completes direct payment processing. In the JSON request body, include a `payment` object with the intent,
     * customer, fundingInstrument, transaction etc. Also include return, notify, and cancel URLs in the `payment` object.
     *
     * @param array $arguments
     * @return ResponseInterface resource object
     * @throws ConfigurationException
     * @throws InvalidCredentialException
     * @throws SoapFault
     */
    public function create(array $arguments): ResponseInterface
    {
        $arguments['method'] = 'doTransaction';
        $result = self::execute($arguments);

        return new Response($result['return']);
    }

    /**
     * Refund a captured payment.
     * In addition, include an amount object in the body of the request JSON.
     *
     * @param array $arguments
     * @return ResponseInterface
     * @throws ConfigurationException
     * @throws InvalidCredentialException
     * @throws SoapFault
     */
    public function refund(array $arguments): ResponseInterface
    {
        return $this->executeTransaction($arguments);
    }

    /**
     * Captures and processes an authorization, by ID. To use this call, the original payment call must specify an
     * intent of `reserve`.
     *
     * @param array $arguments
     * @return ResponseInterface
     * @throws ConfigurationException
     * @throws InvalidCredentialException
     * @throws SoapFault
     */
    public function capture(array $arguments): ResponseInterface
    {
        return $this->executeTransaction($arguments);
    }

    /**
     * Voids, or cancels, an authorization, by ID. You cannot void a fully captured authorization.
     *
     * @param array $arguments
     * @return ResponseInterface
     * @throws ConfigurationException
     * @throws InvalidCredentialException
     * @throws SoapFault
     */
    public function void(array $arguments): ResponseInterface
    {
        return $this->executeTransaction($arguments);
    }

    /**
     * Shows details for a payment, by ID.
     *
     * @param array $arguments
     * @return ResponseInterface
     * @throws ConfigurationException
     * @throws InvalidCredentialException
     * @throws SoapFault
     */
    public static function lookup(array $arguments): ResponseInterface
    {
        $arguments['method'] = 'getLookupTransaction';
        $result = self::execute($arguments);

        return new Response($result['return']);
    }

    /**
     * @param array $arguments
     * @return Response
     * @throws ConfigurationException
     * @throws InvalidCredentialException
     * @throws SoapFault
     */
    private function executeTransaction(array $arguments): Response
    {
        $arguments['method'] = 'doTransaction';
        $payUReference = $arguments['subject']->getPayUReference();
        $merchantReference = $arguments['subject']->getMerchantReference();
        ArgumentValidator::validate($payUReference, "PayUReference");
        ArgumentValidator::validate($merchantReference, "MerchantReference");

        $result = self::execute($arguments);

        return new Response($result['return']);
    }
}
