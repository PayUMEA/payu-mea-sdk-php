<?php
use PayUSdk\Framework\Exception\InvalidCredentialException;

/**
 * Test class for InvalidCredentialException.
 *
 */
class InvalidCredentialExceptionTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var InvalidCredentialException
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp(): void
    {
        $this->object = new InvalidCredentialException;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown(): void
    {
    }

    public function testInvalidCredentialException()
    {
        $msg = $this->object->errorMessage();
        $this->assertStringContainsString('Error in line', $msg);
    }
}
