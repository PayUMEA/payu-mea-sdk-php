<?php

namespace PayU\Test\Functional\Api;

use PayUSdk\Api\Capture;
use PayUSdk\Api\Reserve;
use PayUSdk\Api\Transaction;
use PayUSdk\Model\ResourceModel;
use PayU\Test\Functional\Setup;

/**
 * Class ReserveFunctionalTest
 *
 * @package PayU\Test\Api
 */
class ReserveFunctionalTest extends \PHPUnit_Framework_TestCase
{

    public $operation;

    public $response;

    public $mockSoapCall;

    public $apiContext;

    public function setUp()
    {
        $className = $this->getClassName();
        $testName = $this->getName();
        $operationString = file_get_contents(__DIR__ . "/../resources/$className/$testName.json");
        $this->operation = json_decode($operationString, true);
        $this->response = true;
        if (array_key_exists('body', $this->operation['response'])) {
            $this->response = json_encode($this->operation['response']['body']);
        }
        Setup::SetUpForFunctionalTests($this);
    }

    /**
     * Returns just the classname of the test you are executing. It removes the namespaces.
     * @return string
     */
    public function getClassName()
    {
        return join('', array_slice(explode('\\', get_class($this)), -1));
    }

    /**
     * Create a payment resource
     *
     * @return ResourceModel
     */
    public function testCreate()
    {
        $request = $this->operation['request']['body'];
        $obj = new Reserve($request);
        $result = $obj->create($this->apiContext, $this->mockSoapCall);
        $this->assertNotNull($result);
        $this->assertTrue($result->getReturn()->getSuccessful());
        return $result;
    }

    /**
     * @depends testCreate
     * @param $reserve Reserve
     * @return ResourceModel
     */
    public function testGet($reserve)
    {
        $result = Reserve::get($reserve->getId(), $this->apiContext, $this->mockSoapCall);
        $this->assertNotNull($result);
        $this->assertEquals($reserve->getId(), $result->getId());
        return $result;
    }

    /**
     * @depends testCapture
     * @param $reserve Reserve
     * @return ResourceModel
     */
    public function testCapture($reserve)
    {
        $result = $reserve->capture($this->apiContext, $this->mockSoapCall);
        $this->assertNotNull($result);
        $this->assertTrue($result->getReturn()->getSuccessful());
        $this->assertEquals($reserve->getId(), $result->getId());
        $this->assertEquals($reserve->getid(), $result->getId());
        return $result;
    }

    /**
     * @depends testCreate
     * @param $reserve Reserve
     * @return ResourceModel
     */
    public function testVoid($reserve)
    {
        $request = clone $reserve;
        $reserve->setIntent(Transaction::TYPE_RESERVE_CANCEL);
        $result = $reserve->void($this->apiContext, $this->mockSoapCall);
        $this->assertNotNull($result);
        $this->assertTrue($result->getReturn()->getSuccessful());
        $this->assertEquals($request->getId(), $result->getId());
        return $result;
    }

    /**
     * @depends testCapture
     * @param $capture Capture
     * @return ResourceModel
     */
    public function testCredit($capture)
    {
        $transaction = new Transaction($this->operation->request['body']);
        $request = clone $capture;
        $capture->setIntent(Transaction::TYPE_CREDIT);
        $capture->setTransaction($transaction);
        $result = $capture->refund($this->apiContext, $this->mockSoapCall);
        $this->assertNotNull($result);
        $this->assertTrue($result->getReturn()->getSuccessful());
        $this->assertEquals($request->getId(), $result->getId());
        return $result;
    }
}
