<?php
use PayUSdk\Framework\Exception\MissingCredentialException;

/**
 * Test class for MissingCredentialException.
 *
 */
class MissingCredentialExceptionTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var MissingCredentialException
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp(): void
    {
        $this->object = new MissingCredentialException;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown(): void
    {
    }

    public function testMissingCredentialException()
    {
        $msg = $this->object->errorMessage();
        $this->assertStringContainsString('Error in line', $msg);
    }
}
