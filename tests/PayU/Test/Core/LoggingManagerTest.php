<?php

namespace PayU\Test\Core;

use PayUSdk\Framework\Core\LoggingManager;

/**
 * Test class for LoggingManager.
 */
class LoggingManagerTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var LoggingManager
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp(): void
    {
        $this->object = LoggingManager::getInstance('PaymentTest');
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown(): void
    {
    }

    /**
     * @test
     */
    public function testGetInstance()
    {
        $this->assertInstanceOf(LoggingManager::class, $this->object);
    }

    /**
     * @test
     */
    public function testError()
    {
        $this->object->error('Test Error Message');
        $this->expectNotToPerformAssertions();
    }

    /**
     * @test
     */
    public function testWarning()
    {
        $this->object->warning('Test Warning Message');
        $this->expectNotToPerformAssertions();
    }

    /**
     * @test
     */
    public function testInfo()
    {
        $this->object->info('Test info Message');
        $this->expectNotToPerformAssertions();
    }

    /**
     * @test
     */
    public function testFine()
    {
        $this->object->fine('Test fine Message');
        $this->expectNotToPerformAssertions();
    }
}
