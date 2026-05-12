<?php

/**
 * Copyright © 2023 PayU Financial Services. All rights reserved.
 * See LICENSE for license details.
 */

declare(strict_types=1);

namespace PayUSdk\Framework\Core;

/**
 * class ConfigManager
 *
 * ConfigManager loads the SDK configuration (in PHP ini format) file
 *
 * @package PayUSdk\Framework\Core
 */
class ConfigManager
{
    /**
     * Singleton Object
     *
     * @var ConfigManager
     */
    private static ConfigManager $instance;

    /**
     * Configuration Options
     *
     * @var array<string, mixed>
     */
    private array $configs = [];

    /**
     * Private Constructor
     */
    private function __construct()
    {
        if (defined('PYU_CONFIG_PATH')) {
            $configFile = constant('PYU_CONFIG_PATH') . '/sdk_config.ini';
        } else {
            $configFile = implode(
                DIRECTORY_SEPARATOR,
                [dirname(__FILE__), "..", "config", "sdk_config.ini"]
            );
        }

        if (file_exists($configFile)) {
            $this->addConfigFromIni($configFile);
        }
    }

    /**
     * Add Configuration from configuration.ini files
     *
     * @param string $fileName
     * @return self
     */
    public function addConfigFromIni(string $fileName): self
    {
        if ($configs = parse_ini_file($fileName)) {
            $this->addConfigs($configs);
        }

        return self::$instance;
    }

    /**
     * If a configuration exists in both arrays,
     * then the element from the first array will be used and
     * the matching key's element from the second array will be ignored.
     *
     * @param array<string, mixed> $configs
     * @return self
     */
    public function addConfigs(array $configs = []): self
    {
        $this->configs = $configs + $this->configs;

        return self::$instance;
    }

    /**
     * Returns the singleton object
     *
     * @return self
     */
    public static function getInstance(): self
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * Simple getter for configuration params
     * If an exact match for key is not found,
     * does a "contains" search on the key
     *
     * @param string $searchKey
     * @return string[]|string|bool
     */
    public function get(string $searchKey): array|string|bool
    {
        if (array_key_exists($searchKey, $this->configs)) {
            return $this->configs[$searchKey];
        } else {
            $arr = [];

            foreach ($this->configs as $k => $v) {
                if (strstr($k, $searchKey)) {
                    $arr[$k] = $v;
                }
            }

            return $arr;
        }
    }

    /**
     * Utility method for handling account configuration
     * return config key corresponding to the API accountId passed in
     *
     * If $accountId is null, returns config keys corresponding to
     * all configured accounts
     *
     * @param string|null $accountId
     * @return string[]|string
     */
    public function getIniPrefix(?string $accountId = null): array|string
    {
        if ($accountId == null) {
            $arr = [];

            foreach ($this->configs as $key => $value) {
                $pos = strpos((string)$key, '.');

                if (str_contains((string)$key, "acct") && $pos !== false) {
                    $arr[] = substr((string)$key, 0, $pos);
                }
            }

            return array_unique($arr);
        } else {
            $iniPrefix = array_search($accountId, $this->configs);
            if ($iniPrefix === false) {
                return '';
            }
            $pos = strpos((string)$iniPrefix, '.');

            return substr((string)$iniPrefix, 0, $pos === false ? null : $pos);
        }
    }

    /**
     * returns the config file hashmap
     *
     * @return array<string, mixed>
     */
    public function getConfigHashmap(): array
    {
        return $this->configs;
    }

    /**
     * Disabling __clone call
     */
    public function __clone()
    {
        trigger_error('Clone is not allowed.', E_USER_ERROR);
    }
}
