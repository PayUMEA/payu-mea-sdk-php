<?php

use PayUSdk\Framework\Exception\ServerException;

/**
 * Test class for ServerException.
 *
 */
class ServerExceptionTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var ServerException
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp(): void
    {
        $this->object = new ServerException('Test ServerException');
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown(): void
    {
    }

    public function testServerException()
    {
        $this->assertEquals('Test ServerException', $this->object->getMessage());
    }
}
