<?php

use PayUSdk\Framework\Exception\AuthorizationException;

/**
 * Test class for ConfigurationException.
 *
 */
class AuthorizationExceptionTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var AuthorizationException
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp(): void
    {
        $this->object = new AuthorizationException('Test AuthorizationException');
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown(): void
    {
    }

    public function testAuthorizationException()
    {
        $this->assertEquals('Test AuthorizationException', $this->object->getMessage());
    }
}
