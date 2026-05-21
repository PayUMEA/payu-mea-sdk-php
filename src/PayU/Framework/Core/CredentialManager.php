<?php

/**
 * Copyright © 2023 PayU Financial Services. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace PayUSdk\Framework\Core;

use Exception;
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
     * @var array<string, mixed>
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
     * @param array<string, mixed> $config
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
     * @param array<string, mixed> $config
     */
    private function initCredential(array $config): void
    {
        $accountConfig = [];
        $accounts = [];

        foreach ($config as $k => $v) {
            if (strstr((string)$k, "acct") || strstr((string)$k, "account")) {
                $accountConfig[$k] = $v;
            }
        }

        $credentials = $accountConfig;

        foreach ($config as $key => $value) {
            $dot = strpos((string)$key, '.');

            if (str_contains((string)$key, "acct") || str_contains((string)$key, "account")) {
                $accounts[] = substr((string)$key, 0, $dot === false ? null : $dot);
            }
        }

        $uniqueAccounts = array_unique($accounts);

        foreach ($uniqueAccounts as $key) {
            if (isset($credentials[$key . ".username"]) && isset($credentials[$key . ".password"]) && isset($credentials[$key . ".safekey"])) {
                $auth = new Authentication(
                    $credentials[$key . ".username"],
                    $credentials[$key . ".password"],
                    $credentials[$key . ".safekey"]
                );

                $this->credentialHashmap[$key] = $auth;

                $storeId = null;
                if (array_key_exists($key . '.store_id', $credentials)) {
                    $storeId = $credentials[$key . '.store_id'];
                } elseif (array_key_exists($key . '.storeId', $credentials)) {
                    $storeId = $credentials[$key . '.storeId'];
                }

                if ($storeId !== null) {
                    $this->credentialHashmap[$storeId] = $auth;
                }

                if ($this->defaultAccountName === '') {
                    $this->defaultAccountName = $storeId ?? $key;
                }
            }
        }
    }

    /**
     * Create singleton instance for this class.
     *
     * @param array<string, mixed>|null $config
     * @return CredentialManager
     * @throws Exception
     */
    public static function getInstance(?array $config = null): self
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
     * @return self
     */
    public function setCredentialObject(Authentication $credential, ?string $accountId = null, bool $default = true): self
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
     * @param string|null $accountId
     * @return Authentication
     * @throws InvalidCredentialException
     */
    public function getCredentialObject(?string $accountId = null): Authentication
    {
        $credObj = null;
        if ($accountId === null && array_key_exists($this->defaultAccountName, $this->credentialHashmap)) {
            $credObj = $this->credentialHashmap[$this->defaultAccountName];
        } elseif ($accountId !== null && array_key_exists($accountId, $this->credentialHashmap)) {
            $credObj = $this->credentialHashmap[$accountId];
        }

        if ($credObj === null) {
            throw new InvalidCredentialException("Credential not found for " . ($accountId ?: " default user") .
                ". Please make sure your configuration/APIContext has credential information");
        }

        return $credObj;
    }

    /**
     * Disabling __clone call
     */
    public function __clone()
    {
        trigger_error('Clone is not allowed.', E_USER_ERROR);
    }
}
