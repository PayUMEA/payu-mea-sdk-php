<?php

namespace PayU\Test\Functional\Api;

use PayUSdk\Api\Payment;
use PayU\Test\Functional\Setup;

/**
 * Class PaymentsFunctionalTest
 *
 * @package PayU\Test\Api
 */
class PaymentsFunctionalTest extends \PHPUnit_Framework_TestCase
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

    public function testCreate()
    {
        $request = $this->operation['request']['body'];
        $obj = new Payment($request);
        $result = $obj->create($this->apiContext, $this->mockSoapCall);
        $this->assertNotNull($result);
        return $result;
    }

    /**
     * @depends testCreate
     * @param $payment Payment
     * @return Payment
     */
    public function testGet($payment)
    {
        $result = Payment::get($payment->getId(), $this->apiContext, $this->mockSoapCall);
        $this->assertNotNull($result);
        $this->assertEquals($payment->getId(), $result->getId());
        return $result;
    }
}
