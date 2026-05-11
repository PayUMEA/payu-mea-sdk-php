<?php
/**
 * Copyright © 2023 PayU Financial Services. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace PayUSdk\Framework\Gateway;

use PayUSdk\Api\ConnectionInterface;
use PayUSdk\Framework\BuilderComposite;
use PayUSdk\Framework\Core\LoggingManager;
use PayUSdk\Framework\Exception\ConfigurationException;
use PayUSdk\Framework\Exception\InvalidCredentialException;
use PayUSdk\Framework\Soap\Context;
use SoapFault;

/**
 * Class Connection
 *
 * @package PayU\Http
 */
class Connection implements ConnectionInterface
{
    /**
     * @var LoggingManager
     */
    private LoggingManager $logger;

    /**
     * @var BuilderComposite
     */
    protected BuilderComposite $requestBuilder;

    /**
     * Default Constructor
     *
     * @param Context $context
     * @param Config $config
     * @param ?BuilderComposite $requestBuilder
     * @throws ConfigurationException
     */
    public function __construct(
        protected readonly Context $context,
        protected readonly Config  $config,
        ?BuilderComposite $requestBuilder = null
    ) {
        if (!extension_loaded("soap")) {
            throw new ConfigurationException("SOAP extension is not available/enabled on the server");
        }

        $this->logger = LoggingManager::getInstance();
        $this->requestBuilder = $requestBuilder ?? new BuilderComposite();
    }

    /**
     * Executes an HTTP request
     *
     * @param array<string, mixed> $arguments connection arguments
     * @return array<string, mixed>
     * @throws SoapFault|InvalidCredentialException
     */
    public function execute(array $arguments): array
    {
        $context = $this->context;
        $config = $this->config;
        $arguments['config'] = $config;
        $arguments['context'] = $context;

        $payload = $this->requestBuilder->build($arguments);

        // Initialize the logger
        if ($context->get('log.log_enabled')) {
            $this->logger->debug($config->getMethod() . ' connection: ' . $config->getGatewayUrl());
        }

        // Initialize PayU API client
        $client = new Client($context, $config);
        $headers = $this->getHttpHeaders();

        // Logging each header for debugging purposes
        foreach ($headers as $header) {
            //TODO: Strip out credentials and other secure info when logging.
            $this->logger->debug($header);
        }

        $credential = $context->getCredential();
        assert($credential !== null);

        $payload = array_merge(
            [
                'Api' => Client::API_VERSION,
                'Safekey' => $credential->getSafekey(),
            ],
            $payload
        );

        $result = $client->doAction($arguments['method'], $payload, $headers);

        if ($context->get('log.log_enabled')) {
            $this->logger->debug($client->debugLog());
        }

        return $result;
    }

    /**
     * Gets all Http Headers
     *
     * @return string[]
     */
    private function getHttpHeaders(): array
    {
        $headers = [];

        foreach ($this->config->getHeaders() as $key => $value) {
            $headers[] = "$key: $value";
        }

        return $headers;
    }
}
