<?php
/**
 * Copyright © 2023 PayU Financial Services. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace PayU\Framework\Action;

use PayU\Api\ActionInterface;
use PayU\Api\ResponseInterface;
use PayU\Framework\Exception\ConfigurationException;
use PayU\Framework\Exception\InvalidCredentialException;
use SoapFault;

/**
 * Class Sale
 *
 * Payment/Sale action.
 *
 * @package PayU\Framework\Action
 */
class Sale extends BaseAction implements ActionInterface
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
        $response = $this->adapter->create(
            [
                'subject' => $this,
                'action' => $action,
                'context' => $this->getContext()
            ]
        );
        $response->setEftProUrl($this->getEftProUrl($response));

        return $response;
    }

    /**
     * @param $response
     * @return string
     */
    protected function getEftProUrl($response): string
    {
        return isset($response['redirect']) ? $response['redirect']['url'] : '';
    }
}
