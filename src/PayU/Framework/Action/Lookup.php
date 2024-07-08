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
use SoapFault;

/**
 * Class Lookup
 *
 * Search for a transaction on the payment gateway
 *
 * @package PayUSdk\Framework\Action
 */
class Lookup extends BaseAction
{
    /**
     * @param string $action
     * @return ResponseInterface
     * @throws ConfigurationException
     * @throws InvalidCredentialException
     * @throws SoapFault
     */
    public function execute(string $action): ResponseInterface
    {
        return $this->adapter->lookup(
            [
                'subject' => $this,
                'action' => $action,
                'context' => $this->getContext()
            ]
        );
    }
}
