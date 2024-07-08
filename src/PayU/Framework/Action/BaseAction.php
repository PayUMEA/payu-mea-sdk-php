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
 */
abstract class BaseAction extends DataObject implements ActionInterface
{
    /**
     * @param ?AdapterInterface $adapter
     * @param array $data
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
        return $this->adapter->create(
            [
                'subject' => $this,
                'action' => $action,
                'context' => $this->getContext()
            ]
        );
    }
}
