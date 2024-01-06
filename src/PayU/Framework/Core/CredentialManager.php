<?php
/**
 * Copyright © 2023 PayU Financial Services. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace PayUSdk\Framework\Core;

use Exception;
use JetBrains\PhpStorm\NoReturn;
use PayUSdk\Framework\Authentication;
use PayUSdk\Framework\Exception\InvalidCredentialException;

/**
 * class CredentialManager
 *
 * CredentialManager holds all the credential information in one place.
 *
 * @package PayUSdk\Framework\Core
 */
class CredentialManager
{
    /**
     * Singleton Object
     *
     * @var ?CredentialManager
     */
    private static ?CredentialManager $instance = null;

    /**
     * Hashmap to contain credentials for accounts.
     *
     * @var array
     */
    private array $credentialHashmap = [];

    /**
     * Contains the API username of the default account to use
     * when authenticating API calls
     *
     * @var string
     */
    private string $defaultAccountName = '';

    /**
     * Constructor initialize credential for multiple accounts specified in property file
     *
     * @param array $config
     * @throws Exception
     */
    private function __construct(array $config)
    {
        try {
            $this->initCredential($config);
        } catch (Exception $e) {
            $this->credentialHashmap = [];
            throw $e;
        }
    }

    /**
     * Load credentials for multiple accounts.
     *
     * @param array $config
     */
    private function initCredential(array $config): void
    {
        $suffix = 1;
        $prefix = "account";

        $accountConfig = [];

        foreach ($config as $k => $v) {
            if (strstr($k, $prefix)) {
                $accountConfig[$k] = $v;
            }
        }

        $credentials = $accountConfig;
        $accounts = [];

        foreach ($config as $key => $value) {
            $dot = strpos($key, '.');

            if (str_contains($key, "account")) {
                $accounts[] = substr($key, 0, $dot);
            }
        }

        $uniqueAccounts = array_unique($accounts);

        $key = $prefix . $suffix;
        $account = null;

        while (in_array($key, $uniqueAccounts)) {
            if (isset($credentials[$key . ".username"]) && isset($credentials[$key . ".password"]) && isset($credentials[$key . ".safekey"])) {
                $account = $key;
                $this->credentialHashmap[$account] = new Authentication(
                    $credentials[$key . ".username"],
                    $credentials[$key . ".password"],
                    $credentials[$key . ".safekey"]
                );
            }

            if ($account && $this->defaultAccountName == null) {
                if (array_key_exists($key . '.store_id', $credentials)) {
                    $this->defaultAccountName = $credentials[$key . '.store_id'];
                } else {
                    $this->defaultAccountName = $key;
                }
            }

            $suffix++;
            $key = $prefix . $suffix;
        }
    }

    /**
     * Create singleton instance for this class.
     *
     * @param array|null $config
     * @return CredentialManager
     * @throws Exception
     */
    public static function getInstance(array $config = null): CredentialManager
    {
        if (!self::$instance) {
            self::$instance = new self(
                $config
                    ?? ConfigManager::getInstance()->getConfigHashmap()
            );
        }

        return self::$instance;
    }

    /**
     * Sets credential object for users
     *
     * @param Authentication $credential
     * @param string|null $accountId Account Id associated with the account
     * @param bool $default If set, it would make it as a default credential for all requests
     *
     * @return $this
     */
    public function setCredentialObject(Authentication $credential, string $accountId = null, bool $default = true): static
    {
        $key = !$accountId ? 'default' : $accountId;
        $this->credentialHashmap[$key] = $credential;

        if ($default) {
            $this->defaultAccountName = $key;
        }

        return $this;
    }

    /**
     * Obtain Credential Object based on StoreId provided.
     *
     * @param null $accountId
     * @return Authentication
     * @throws InvalidCredentialException
     */
    public function getCredentialObject($accountId = null): Authentication
    {
        if ($accountId == null && array_key_exists($this->defaultAccountName, $this->credentialHashmap)) {
            $credObj = $this->credentialHashmap[$this->defaultAccountName];
        } elseif (array_key_exists($accountId, $this->credentialHashmap)) {
            $credObj = $this->credentialHashmap[$accountId];
        }

        if (empty($credObj)) {
            throw new InvalidCredentialException("Credential not found for " . ($accountId ?: " default user") .
                ". Please make sure your configuration/APIContext has credential information");
        }

        return $credObj;
    }

    /**
     * Disabling __clone call
     */
    #[NoReturn]
    public function __clone()
    {
        trigger_error('Clone is not allowed.', E_USER_ERROR);
    }
}
