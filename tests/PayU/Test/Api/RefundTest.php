<?php
/**
 * Created by PhpStorm.
 * User: kenny
 * Date: 12/19/16
 * Time: 10:23 AM
 */

namespace PayU\Test\Api;

use PayUSdk\Api\Refund;

class RefundTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Gets Object Instance with Json data filled in
     * @return Refund
     */
    public static function getObject()
    {
        return new Refund(self::getJson());
    }

    /**
     * Gets Json String of Object Address
     * @return string
     */
    public static function getJson()
    {
        return '{"id":"TestSample","intent":"TestSample","payUReference":"TestSample","merchantReference":"TestSample","customer":' . CustomerTest::getJson() . ',"transaction":' . TransactionTest::getJson() . ',"merchant":' . MerchantTest::getJson() . ',"redirectUrls":' . RedirectUrlsTest::getJson() . ',"return":' . ResponseTest::getJson() . ',"fmDetails":' . FmDetailsTest::getJson() . ',"transactionRecord":' . TransactionRecordTest::getJson() . '}';
    }

    /**
     * Tests for Serialization and Deserialization Issues
     * @return Refund
     */
    public function testSerializationDeserialization()
    {
        $obj = new Refund(self::getJson());
        $this->assertNotNull($obj);
        $this->assertNotNull($obj->getId());
        $this->assertNotNull($obj->getIntent());
        $this->assertNotNull($obj->getPayUReference());
        $this->assertNotNull($obj->getMerchantReference());
        $this->assertNotNull($obj->getCustomer());
        $this->assertNotNull($obj->getTransaction());
        $this->assertNotNull($obj->getMerchant());
        $this->assertNotNull($obj->getRedirectUrls());
        $this->assertNotNull($obj->getReturn());
        $this->assertNotNull($obj->getFmDetails());
        $this->assertNotNull($obj->getTransactionRecord());
        $this->assertEquals(self::getJson(), $obj->toJson());
        return $obj;
    }

    /**
     * @depends testSerializationDeserialization
     * @param Refund $obj
     */
    public function testGetters($obj)
    {
        $this->assertEquals($obj->getId(), "TestSample");
        $this->assertEquals($obj->getIntent(), "TestSample");
        $this->assertEquals($obj->getPayUReference(), "TestSample");
        $this->assertEquals($obj->getMerchantReference(), "TestSample");
        $this->assertEquals($obj->getCustomer(), CustomerTest::getObject());
        $this->assertEquals($obj->getTransaction(), TransactionTest::getObject());
        $this->assertEquals($obj->getMerchant(), MerchantTest::getObject());
        $this->assertEquals($obj->getRedirectUrls(), RedirectUrlsTest::getObject());
        $this->assertEquals($obj->getReturn(), ResponseTest::getObject());
        $this->assertEquals($obj->getFmDetails(), FmDetailsTest::getObject());
        $this->assertEquals($obj->getTransactionRecord(), TransactionRecordTest::getObject());
    }

    /**
     * @dataProvider mockProvider
     * @param Refund $obj
     */
    public function testGet($obj, $mockApiContext)
    {
        $mockPUSoapCall = $this->getMockBuilder('\PayU\Transport\SoapCall')
            ->disableOriginalConstructor()
            ->getMock();

        $mockPUSoapCall->expects($this->any())
            ->method('execute')
            ->will($this->returnValue(
                RefundTest::getJson()
            ));

        $result = $obj->get("refundId", $mockApiContext, $mockPUSoapCall);
        $this->assertNotNull($result);
    }

    /**
     * @dataProvider mockProvider
     * @param Refund $obj
     */
    public function testRefund($obj, $mockApiContext)
    {
        $mockPUSoapCall = $this->getMockBuilder('\PayU\Transport\SoapCall')
            ->disableOriginalConstructor()
            ->getMock();

        $mockPUSoapCall->expects($this->any())
            ->method('execute')
            ->will($this->returnValue(
                RefundTest::getJson()
            ));

        $result = $obj->refund($mockApiContext, $mockPUSoapCall);
        $this->assertNotNull($result);
    }

    public function mockProvider()
    {
        $obj = self::getObject();
        $mockApiContext = $this->getMockBuilder('ApiContext')
            ->disableOriginalConstructor()
            ->getMock();
        return array(
            array($obj, $mockApiContext),
            array($obj, null)
        );
    }
}
