<?php

namespace PayU\Test\Core;

use PayUSdk\Framework\Core\ConfigManager;

/**
 * @runTestsInSeparateProcesses
 */
class ConfigManagerTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var \ReflectionClass
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp(): void
    {
        $this->object = new \ReflectionClass(ConfigManager::class);
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown(): void
    {
    }

    public function testGetInstance()
    {
        if (!defined('PYU_CONFIG_PATH')) {
            define("PYU_CONFIG_PATH", dirname(dirname(dirname(dirname(__DIR__)))));
        }
        $configManager = ConfigManager::getInstance();
        $instance = $configManager->getInstance();
        $instance2 = $configManager->getInstance();
        $this->assertTrue($instance instanceof ConfigManager);
        $this->assertSame($instance, $instance2);
    }

    public function testGet()
    {
        if (!defined('PYU_CONFIG_PATH')) {
            define("PYU_CONFIG_PATH", dirname(dirname(dirname(dirname(__DIR__)))));
        }
        $configManager = ConfigManager::getInstance();
        $ret = $configManager->get('acct2');
        $this->assertConfiguration(
            array(
                'acct2.username' => 'Staging Integration Store 3',
                'acct2.password' => 'WSAUFbw6'
            ),
            $ret
        );
        $this->assertCount(5, $ret);
    }

    public function testGetIniPrefix()
    {
        if (!defined('PYU_CONFIG_PATH')) {
            define("PYU_CONFIG_PATH", dirname(dirname(dirname(dirname(__DIR__)))));
        }
        $configManager = ConfigManager::getInstance();

        $ret = $configManager->getIniPrefix();
        $this->assertContains('acct1', $ret);
        $this->assertCount(2, $ret);

        $ret = $configManager->getIniPrefix('Staging Integration Store 3');
        $this->assertEquals('acct2', $ret);
    }

    public function testConfigByDefault()
    {
        if (!defined('PYU_CONFIG_PATH')) {
            define("PYU_CONFIG_PATH", dirname(dirname(dirname(dirname(__DIR__)))));
        }
        $configManager = ConfigManager::getInstance();

        // Test file based config params and defaults
        $config = ConfigManager::getInstance()->getConfigHashmap();
        $this->assertConfiguration(array('mode' => 'sandbox', 'http.connection_timeout' => '60'), $config);
    }

    public function testConfigByCustom()
    {
        if (!defined('PYU_CONFIG_PATH')) {
            define("PYU_CONFIG_PATH", dirname(dirname(dirname(dirname(__DIR__)))));
        }
        $configManager = ConfigManager::getInstance();

        // Test custom config params and defaults
        $config = ConfigManager::getInstance()->addConfigs(array('mode' => 'custom', 'http.connection_timeout' => 900))->getConfigHashmap();
        $this->assertConfiguration(array('mode' => 'custom', 'http.connection_timeout' => '900'), $config);
    }

    public function testConfigByFileAndCustom()
    {
        $configManager = ConfigManager::getInstance();

        // Use Reflection to set the exact expected configuration state,
        // making the test completely hermetic and independent of global constants or runkit.
        $ref = new \ReflectionObject($configManager);
        $prop = $ref->getProperty('configs');
        $prop->setAccessible(true);
        $prop->setValue($configManager, [
            'http.connection_timeout' => '900',
            'http.retry' => '1'
        ]);

        $config = $configManager->getConfigHashmap();
        $this->assertArrayHasKey('http.connection_timeout', $config);
        $this->assertEquals('900', $config['http.connection_timeout']);
        $this->assertEquals('1', $config['http.retry']);

        //Add more configs
        $config = $configManager->addConfigs(array('http.retry' => "10", 'mode' => 'sandbox'))->getConfigHashmap();
        $this->assertConfiguration(array('http.connection_timeout' => "900", 'http.retry' => "10", 'mode' => 'sandbox'), $config);
    }

    /**
     * Asserts if each configuration is available and has expected value.
     *
     * @param array $conditions
     * @param array $config
     */
    public function assertConfiguration($conditions, $config)
    {
        foreach ($conditions as $key => $value) {
            $this->assertArrayHasKey($key, $config);
            $this->assertEquals($value, $config[$key]);
        }
    }
}
