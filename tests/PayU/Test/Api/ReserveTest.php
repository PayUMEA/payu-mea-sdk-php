<?php
/**
 * Created by PhpStorm.
 * User: kenny
 * Date: 12/19/16
 * Time: 10:23 AM
 */

namespace PayU\Test\Api;

use PayU\Test\Api\Helper;

use PayUSdk\Model\Reserve;

class ReserveTest extends \PHPUnit\Framework\TestCase
{
    /**
     * Gets Object Instance with Json data filled in
     * @return Reserve
     */
        /**
     * Gets array data representation of the object
     * @return array
     */
    public static function getData()
    {
        return Helper::hydrateData(json_decode(self::getJson(), true));
    }

    public static function getObject()
    {
        return new Reserve(self::getData());
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
     * @return Reserve
     */
    public function testSerializationDeserialization()
    {
        $obj = new Reserve(self::getData());
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
        $this->assertEquals(self::getObject(), $obj);
        return $obj;
    }

    /**
     * @depends testSerializationDeserialization
     * @param Reserve $obj
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
     * @param Reserve $obj
     */
    public function testGet($obj, $mockApiContext)
    {
        $mockPUSoapCall = $this->getMockBuilder('\PayU\Transport\SoapCall')
            ->disableOriginalConstructor()
            ->getMock();

        $mockPUSoapCall->expects($this->any())
            ->method('execute')
            ->will($this->returnValue(
                RedirectTest::getJson()
            ));

        $result = $obj->get("reserveId", $mockApiContext, $mockPUSoapCall);
        $this->assertNotNull($result);
    }

    /**
     * @dataProvider mockProvider
     * @param Reserve $obj
     */
    public function testCreate($obj, $mockApiContext)
    {
        $mockPUSoapCall = $this->getMockBuilder('\PayU\Transport\SoapCall')
            ->disableOriginalConstructor()
            ->getMock();

        $mockPUSoapCall->expects($this->any())
            ->method('execute')
            ->will($this->returnValue(
                RedirectTest::getJson()
            ));

        $result = $obj->create($mockApiContext, $mockPUSoapCall);
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
