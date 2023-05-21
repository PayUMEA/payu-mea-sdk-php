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
use SoapFault;

/**
 * Class Capture
 *
 * A capture action.
 *
 * @package PayU\Framework\Action
 */
class Capture extends BaseAction
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
        return $this->adapter->capture(
            [
                'subject' => $this,
                'action' => $action,
                'context' => $this->getContext()
            ]
        );
    }
}
