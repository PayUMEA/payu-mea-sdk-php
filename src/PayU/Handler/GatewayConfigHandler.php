<?php
/**
 * Copyright © 2023 PayU Financial Services. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace PayUSdk\Handler;

use PayUSdk\Api\HandlerInterface;
use PayUSdk\Framework\Constants;
use PayUSdk\Framework\Exception\ConfigurationException;
use PayUSdk\Framework\Gateway\Config;
use PayUSdk\Framework\Soap\Context;
use PayUSdk\Framework\UserAgent;

/**
 * Class GatewayConfigHandler
 *
 * @package PayUSdk\Handler
 */
class GatewayConfigHandler implements HandlerInterface
{
    /**
     * Construct
     *
     * @param Context $apiContext
     */
    public function __construct(protected readonly Context $apiContext)
    {
    }

    /**
     * @param Config $config configuration hash
     * @return void
     * @throws ConfigurationException
     */
    public function handle(Config $config): void
    {
        $configHashmap = $this->apiContext->getConfigHashmap();
        $config->setGatewayUrl(rtrim(trim($this->getEndpoint($configHashmap)), '/'));

        $headers = [
            "User-Agent" => UserAgent::getValue(Constants::SDK_NAME, Constants::SDK_VERSION),
            "Accept" => "*/*",
        ];
        $config->setHeaders($headers);

        // Add any additional Headers that they may have provided
        $headers = $this->apiContext->getRequestHeaders();

        foreach ($headers as $key => $value) {
            $config->addHeader($key, $value);
        }
    }

    /**
     * Get base endpoint for SOAP WSDL service
     *
     * @param array $config
     *
     * @return string $baseEndpoint the WSDL endpoint
     * @throws ConfigurationException
     */
    private static function getEndpoint(array $config): string
    {
        if (isset($config['mode'])) {
            $baseEndpoint = match (strtoupper($config['mode'])) {
                'SANDBOX' => Constants::STAGING_WSDL_ENDPOINT,
                'LIVE' => Constants::PROD_WSDL_ENDPOINT,
                default => throw new ConfigurationException(
                    'The mode config parameter must be set to either sandbox/live'
                ),
            };
        } else {
            // Defaulting to Sandbox
            $baseEndpoint = Constants::STAGING_WSDL_ENDPOINT;
        }

        return rtrim(trim($baseEndpoint), '/');
    }
}
