<?php
/**
 * Copyright © 2023 PayU Financial Services. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace PayUSdk\Framework\Action;

use PayUSdk\Api\ActionInterface;
use PayUSdk\Api\AdapterInterface;
use PayUSdk\Api\ResponseInterface;
use PayUSdk\Framework\Data\DataObject;
use PayUSdk\Framework\Adapter;
use PayUSdk\Framework\Exception\ConfigurationException;
use PayUSdk\Framework\Exception\InvalidCredentialException;
use SoapFault;

/**
 * Class BaseAction
 *
 * Base class of all actions requested by the client
 *
 * @package PayUSdk\Framework\Adapter
 * @template TKey of string
 * @template TValue
 * @extends DataObject<TKey, TValue>
 */
abstract class BaseAction extends DataObject implements ActionInterface
{
    /**
     * @param ?AdapterInterface $adapter
     * @param array<TKey, TValue> $data
     */
    public function __construct(
        protected ?AdapterInterface $adapter = null,
        array $data = []
    ) {
        $this->adapter = $this->adapter ?? new Adapter();

        parent::__construct($data);
    }

    /**
     * @param string $action
     * @return ResponseInterface
     * @throws ConfigurationException
     * @throws InvalidCredentialException
     * @throws SoapFault
     */
    public function execute(string $action): ResponseInterface
    {
        /** @var AdapterInterface $adapter */
        $adapter = $this->adapter;

        return $adapter->create(
            [
                'subject' => $this,
                'action' => $action,
                'context' => $this->getContext()
            ]
        );
    }

    /**
     * @return \PayUSdk\Framework\Soap\Context
     */
    public function getContext(): \PayUSdk\Framework\Soap\Context
    {
        $context = $this->getData('context');
        if (!($context instanceof \PayUSdk\Framework\Soap\Context)) {
            $context = new \PayUSdk\Framework\Soap\Context();
            $this->setData('context', $context);
        }

        return $context;
    }
}
