<?php

use PayUSdk\Framework\Authentication;
use PayUSdk\Framework\Soap\Context;

/**
 * Test class for ApiContextTest.
 *
 */
class ApiContextTest extends \PHPUnit\Framework\TestCase
{
    protected $username = '100032';
    protected $password = 'PypWWegU';
    protected $safekey = '{CE62CE80-0EFD-4035-87C1-8824C5C46E7F}';

    /**
     * @var Context
     */
    public $apiContext;

    public function setUp(): void
    {
        $this->apiContext = new Context(
            new Authentication(
            $this->username,
            $this->password,
            $this->safekey
        ));
    }

    public function testGetRequestId()
    {
        $requestId = $this->apiContext->getRequestId();
        $this->assertNull($requestId);
    }

    public function testSetRequestId()
    {
        $this->assertNull($this->apiContext->getRequestId());

        $expectedRequestId = 'random-value';
        $this->apiContext->setRequestId($expectedRequestId);
        $requestId = $this->apiContext->getRequestId();
        $this->assertEquals($expectedRequestId, $requestId);
    }

    public function testResetRequestId()
    {
        $this->assertNull($this->apiContext->getRequestId());

        $requestId = $this->apiContext->resetRequestId();
        $this->assertNotNull($requestId);

        // Tests that another resetRequestId call will generate a new ID
        $newRequestId = $this->apiContext->resetRequestId();
        $this->assertNotNull($newRequestId);
        $this->assertNotEquals($newRequestId, $requestId);
    }
}
