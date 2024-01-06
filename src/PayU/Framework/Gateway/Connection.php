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
     * HTTP status codes for which a retry must be attempted
     * retry is currently attempted for BuilderComposite timeout, Bad Gateway,
     * Service Unavailable and Gateway timeout errors.
     */
    private static array $retryCodes = ['408', '502', '503', '504',];

    /**
     * @var LoggingManager
     */
    private LoggingManager $logger;

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
        protected ?BuilderComposite $requestBuilder = null
    ) {
        if (!extension_loaded("soap")) {
            throw new ConfigurationException("SOAP extension is not available/enabled on the server");
        }

        $this->logger = LoggingManager::getInstance();
        $this->requestBuilder = $this->requestBuilder ?? new BuilderComposite();
    }

    /**
     * Executes an HTTP request
     *
     * @param array $arguments connection arguments
     * @return array
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

        $payload = array_merge(
            [
                'Api' => Client::API_VERSION,
                'Safekey' => $context->getCredential()->getSafekey(),
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
     * @return array
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
