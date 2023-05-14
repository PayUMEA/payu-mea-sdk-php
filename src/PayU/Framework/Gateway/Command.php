<?php
/**
 * Copyright © 2023 PayU Financial Services. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace PayU\Framework\Gateway;

use PayU\Api\CommandInterface;
use PayU\Framework\Exception\ConfigurationException;
use PayU\Framework\Exception\InvalidCredentialException;
use PayU\Framework\BuilderComposite;
use PayU\Framework\Soap\Context;
use PayU\Api\HandlerInterface;
use SoapFault;

/**
 * Class Command
 *
 * @package PayU\Framework\Gateway
 */
class Command implements CommandInterface
{
    /**
     * Default Constructor
     *
     * @param Context $apiContext
     */
    public function __construct(protected readonly Context $apiContext)
    {
    }

    /**
     * @param array $arguments
     * @return array
     * @throws ConfigurationException
     * @throws SoapFault|InvalidCredentialException
     */
    public function execute(array $arguments): array
    {
        $configHashmap = $this->apiContext->getConfigHashmap();
        $config = new Config(null, $arguments['method'], $configHashmap);

        /** @var HandlerInterface $handler */
        foreach ($arguments['handlers'] as $handler) {
            if (!is_object($handler)) {
                $class = "\\" . $handler;
                $handler = new $class($this->apiContext);
            }

            $handler->handle($config);
        }

        $connection = new Connection($this->apiContext, $config);

        return $connection->execute($arguments);
    }
}
