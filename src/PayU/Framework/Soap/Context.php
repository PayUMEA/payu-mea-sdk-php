<?php
/**
 * PayU MEA PHP SDK
 *
 * @copyright  Copyright (c) 2016 PayU
 * @license    http://opensource.org/licenses/LGPL-3.0  Open Software License (LGPL 3.0)
 * @link http://www.payu.co.za
 * @link http://help.payu.co.za/developers
 * @author Kenneth Onah <kenneth@netcraft-devops.com>
 */

namespace PayU\Framework\Soap;

use Exception;
use PayU\Framework\Core\ConfigManager;
use PayU\Framework\Core\CredentialManager;
use PayU\Framework\Authentication;
use PayU\Framework\Exception\InvalidCredentialException;

/**
 * Class Context
 *
 * Call level parameters such as credentials, request-id etc
 *
 * @package PayU\Soap
 */
class Context
{
    const ENTERPRISE = 'enterprise';
    const REDIRECT = 'redirect';

    /**
     * Unique request id to be used for this call
     * The user can either generate one as per application
     * needs or let the SDK generate one
     *
     * @var ?string $requestId
     */
    private ?string $requestId = '';

    /**
     * Determines how to make API calls. Default integration method is Redirect Payment Page (RPP)
     *
     * @var ?string
     */
    private ?string $integration = '';

    /**
     * PayU configuration Account Id placeholder. This enable multi-tenancy in the SDK, i.e multiple accounts can be
     * used within the SDK.
     *
     * @var ?string
     */
    private ?string $accountId = '';


    /**
     * Construct
     *
     * @param ?Authentication $credential
     */
    public function __construct(protected ?Authentication $credential = null)
    {
    }

    /**
     * Get Credential
     *
     * @return ?Authentication
     * @throws InvalidCredentialException
     * @throws Exception
     */
    public function getCredential(): ?Authentication
    {
        if (null == $this->credential) {
            $this->credential = CredentialManager::getInstance()->getCredentialObject();
        }

        return $this->credential;
    }

    /**
     * @return array
     */
    public function getRequestHeaders(): array
    {
        $result = ConfigManager::getInstance()->get('http.headers');
        $headers = [];

        foreach ($result as $header => $value) {
            $headerName = ltrim($header, 'http.headers');
            $headers[$headerName] = $value;
        }

        return $headers;
    }

    /**
     * @param string $name
     * @param string $value
     * @return void
     */
    public function addRequestHeader(string $name, string $value): void
    {
        // Determine if the name already has a 'http.headers' prefix. If not, add one.
        if (!(str_starts_with($name, 'http.headers'))) {
            $name = 'http.headers.' . $name;
        }

        ConfigManager::getInstance()->addConfigs([$name => $value]);
    }

    /**
     * Resets the requestId that can be used to set the PayU-request-id
     * header used for idempotency. In cases where you need to make multiple create calls
     * using the same Context object, you need to reset request Id.
     *
     * @return ?string
     */
    public function resetRequestId(): ?string
    {
        $this->requestId = $this->generateRequestId();

        return $this->getRequestId();
    }

    /**
     * Generates a unique per-request id that
     * can be used to set the PayU-BuilderComposite-Id header
     * that is used for idempotency
     *
     * @return string
     */
    private function generateRequestId(): string
    {
        static $pid = -1;
        static $addr = -1;

        if ($pid == -1) {
            $pid = getmypid();
        }

        if ($addr == -1) {
            if (array_key_exists('SERVER_ADDR', $_SERVER)) {
                $addr = ip2long($_SERVER['SERVER_ADDR']);
            } else {
                $addr = php_uname('n');
            }
        }

        return $addr . $pid . $_SERVER['REQUEST_TIME'] . mt_rand(0, 0xffff);
    }

    /**
     * Get the BuilderComposite ID
     *
     * @return string|null
     */
    public function getRequestId(): ?string
    {
        return $this->requestId;
    }

    /**
     * Sets the request ID
     *
     * @param string $requestId the value to use
     */
    public function setRequestId(string $requestId): void
    {
        $this->requestId = $requestId;
    }

    /**
     * Sets Config
     *
     * @param array $config SDK configuration parameters
     */
    public function setConfig(array $config): void
    {
        ConfigManager::getInstance()->addConfigs($config);
    }

    /**
     * Gets Configurations hashmap
     *
     * @return array
     */
    public function getConfigHashmap(): array
    {
        return ConfigManager::getInstance()->getConfigHashmap();
    }

    /**
     * Gets a specific configuration from key
     *
     * @param $searchKey
     * @return string|array
     */
    public function get($searchKey): string|array
    {
        return ConfigManager::getInstance()->get($searchKey);
    }

    /**
     * PayU configuration AccountId.
     *
     * @return string
     */
    public function getAccountId(): string
    {
        return $this->accountId;
    }

    /**
     * PayU configuration AccountId.
     *
     * @param string $accountId
     *
     * @return $this
     */
    public function setAccountId(string $accountId): static
    {
        $this->accountId = $accountId;

        return $this;
    }

    /**
     * API integration.
     *
     * Valid Values: ["enterprise", "redirect"]
     *
     * @return string
     */
    public function getIntegration(): string
    {
        return $this->integration;
    }

    /**
     * API integration.
     *
     * Valid Values: ["enterprise", "redirect"]
     *
     * @param string $integration
     *
     * @return $this
     */
    public function setIntegration(string $integration): static
    {
        $this->integration = $integration;

        return $this;
    }
}
