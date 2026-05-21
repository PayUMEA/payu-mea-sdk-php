<?php

use PayUSdk\Framework\Exception\RequiredArgumentException;

/**
 * Test class for RequiredArgumentException.
 *
 */
class RequiredArgumentExceptionTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var RequiredArgumentException
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp(): void
    {
        $this->object = new RequiredArgumentException('Test RequiredArgumentException');
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown(): void
    {
    }

    public function testRequiredArgumentException()
    {
        $this->assertEquals('Test RequiredArgumentException', $this->object->getMessage());
    }
}
