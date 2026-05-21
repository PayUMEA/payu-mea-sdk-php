<?php
use PayUSdk\Framework\Exception\ConfigurationException;

/**
 * Test class for ConfigurationException.
 *
 */
class ConfigurationExceptionTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var ConfigurationException
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp(): void
    {
        $this->object = new ConfigurationException('Test ConfigurationException');
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown(): void
    {
    }

    public function testConfigurationException()
    {
        $this->assertEquals('Test ConfigurationException', $this->object->getMessage());
    }
}
