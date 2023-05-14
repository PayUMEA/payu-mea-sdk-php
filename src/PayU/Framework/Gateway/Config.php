<?php
/**
 * Copyright © 2023 PayU Financial Services. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace PayU\Framework\Gateway;

use PayU\Framework\Exception\ConfigurationException;

/**
 * class Config
 *
 * Http Configuration Class
 *
 * @package PayU\Http
 */
class Config
{
    const HEADER_SEPARATOR = ';';

    /**
     * Some default options for SOAPClient
     * These are typically overridden by ConnectionManager
     *
     * @var array
     */
    public array $defaultSoapClientOptions = [
        'cache_wsdl' => WSDL_CACHE_BOTH,
        'connection_timeout' => 500000,
        'cache_ttl' => 86400,
        'trace' => true,
        'exceptions' => true,
        'keep_alive' => false
    ];

    /**
     * @var array
     */
    private array $headers = [];

    /**
     * @var array
     */
    private array $soapOptions;

    /***
     * Number of times to retry a failed HTTP call
     */
    private int $retryCount = 0;

    /**
     * Default Constructor
     *
     * @param ?string $gatewayUrl
     * @param string $method SOAP method (doTransaction, setTransaction etc) default doTransaction
     * @param array $configs All Configurations
     */
    public function __construct(
        protected ?string $gatewayUrl = null,
        protected string $method = 'doTransaction',
        protected array $configs = []
    ) {
        $this->soapOptions = $this->getHttpConstantsFromConfigs(
            'http.',
            $configs
            ) + $this->defaultSoapClientOptions;
    }

    /**
     * Retrieves an array of constant key, and value based on Prefix
     *
     * @param string $prefix HTTP configuration prefix
     * @param array $configs configuration options
     * @return array
     */
    public function getHttpConstantsFromConfigs(string $prefix, array $configs = []): array
    {
        $arr = [];

        if ($prefix != null && is_array($configs)) {
            foreach ($configs as $k => $v) {
                // Check if it startsWith
                if (str_starts_with($k, $prefix)) {
                    $newKey = ltrim($k, $prefix);
                    if (defined($newKey)) {
                        $arr[constant($newKey)] = $v;
                    }
                }
            }
        }

        return $arr;
    }

    /**
     * Gets Url endpoint
     *
     * @return ?string
     */
    public function getGatewayUrl(): ?string
    {
        return $this->gatewayUrl;
    }

    /**
     * Sets Url endpoint
     *
     * @param string $gatewayUrl
     */
    public function setGatewayUrl(string $gatewayUrl): void
    {
        $this->gatewayUrl = $gatewayUrl;
    }

    /**
     * Gets Method
     *
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * Gets all Headers
     *
     * @return array
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * Set Headers
     *
     * @param array $headers
     */
    public function setHeaders(array $headers = array())
    {
        $this->headers = $headers;
    }

    /**
     * Get Header by Name
     *
     * @param $name
     * @return string|null
     */
    public function getHeader($name)
    {
        if (array_key_exists($name, $this->headers)) {
            return $this->headers[$name];
        }
        return null;
    }

    /**
     * Adds a Header
     *
     * @param      $name
     * @param      $value
     * @param bool $overWrite allows you to override header value
     */
    public function addHeader($name, $value, $overWrite = true)
    {
        if (!array_key_exists($name, $this->headers) || $overWrite) {
            $this->headers[$name] = $value;
        } else {
            $this->headers[$name] = $this->headers[$name] . self::HEADER_SEPARATOR . $value;
        }
    }

    /**
     * Removes a Header
     *
     * @param $name
     */
    public function removeHeader($name)
    {
        unset($this->headers[$name]);
    }

    /**
     * Gets all SOAP options
     *
     * @return array
     */
    public function getSoapOptions(): array
    {
        return $this->soapOptions;
    }

    /**
     * Set SOAP Options. Overrides all SOAP options
     *
     * @param array $options
     */
    public function setSoapOptions(array $options): void
    {
        $this->soapOptions = $options;
    }

    /**
     * Add SOAP Option
     *
     * @param string $name
     * @param mixed $value
     */
    public function addSoapOption(string $name, mixed $value): void
    {
        $this->soapOptions[$name] = $value;
    }

    /**
     * Removes a SOAP option from the list
     *
     * @param string $name
     */
    public function removeSoapOption(string $name): void
    {
        unset($this->soapOptions[$name]);
    }

    /**
     * Sets the UserAgent string on the HTTP request
     *
     * @param string $userAgentString
     */
    public function setUserAgent(string $userAgentString): void
    {
        $this->soapOptions['user_agent'] = $userAgentString;
    }

    /**
     * Set ssl parameters for certificate based client authentication
     *
     * @param      $certPath
     * @param null $passPhrase
     */
    public function setSSLCert($certPath, $passPhrase = null): void
    {
        $this->soapOptions['local_cert'] = realpath($certPath);

        if (isset($passPhrase) && trim($passPhrase) != "") {
            $this->soapOptions['passphrase'] = $passPhrase;
        }
    }

    /**
     * Set HTTP proxy information
     *
     * @param string $proxy format http://[username:password]@hostname[:port]
     * @throws ConfigurationException
     */
    public function setHttpProxy(string $proxy): void
    {
        $urlParts = parse_url($proxy);

        if (!$urlParts || !array_key_exists("host", $urlParts)) {
            throw new ConfigurationException("Invalid proxy configuration " . $proxy);
        }

        $this->soapOptions['proxy_host'] = $urlParts["host"];

        if (isset($urlParts["port"])) {
            $this->soapOptions['proxy_port'] = $urlParts["port"];
        }

        if (isset($urlParts["user"])) {
            $this->soapOptions['proxy_login'] = $urlParts["user"];
            $this->soapOptions['proxy_password'] = $urlParts["pass"];
        }
    }

    /**
     * Set Http Retry Counts
     *
     * @param int $retryCount
     */
    public function setHttpRetryCount(int $retryCount): void
    {
        $this->retryCount = $retryCount;
    }

    /**
     * Get Http Retry Counts
     *
     * @return int
     */
    public function getHttpRetryCount(): int
    {
        return $this->retryCount;
    }
}
