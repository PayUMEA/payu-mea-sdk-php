<?php
/**
 * Created by PhpStorm.
 * User: kenny
 * Date: 12/19/16
 * Time: 10:23 AM
 */

namespace PayU\Test\Api;

use PayU\Test\Api\Helper;

use PayUSdk\Model\ShippingInfo;

class ShippingInfoTest extends \PHPUnit\Framework\TestCase
{
    /**
     * Gets Object Instance with Json data filled in
     * @return ShippingInfo
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
        return new ShippingInfo(self::getData());
    }

    /**
     * Gets Json String of Object Address
     * @return string
     */
    public static function getJson()
    {
        return '{"id":"TestSample","firstName":"TestSample","lastName":"TestSample","email":"TestSample","businessName":"TestSample","phone":"TestSample","method":"TestSample","shippingAddress":' . ShippingAddressTest::getJson() . ',"shippingCost":' . ShippingCostTest::getJson() .'}';
    }

    /**
     * Tests for Serialization and Deserialization Issues
     * @return ShippingInfo
     */
    public function testSerializationDeserialization()
    {
        $obj = new ShippingInfo(self::getData());
        $this->assertNotNull($obj);
        $this->assertNotNull($obj->getId());
        $this->assertNotNull($obj->getFirstName());
        $this->assertNotNull($obj->getLastName());
        $this->assertNotNull($obj->getEmail());
        $this->assertNotNull($obj->getBusinessName());
        $this->assertNotNull($obj->getPhone());
        $this->assertNotNull($obj->getMethod());
        $this->assertNotNull($obj->getShippingAddress());
        $this->assertNotNull($obj->getShippingCost());
        $this->assertEquals(self::getObject(), $obj);
        return $obj;
    }

    /**
     * @depends testSerializationDeserialization
     * @param ShippingInfo $obj
     */
    public function testGetters($obj)
    {
        $this->assertEquals($obj->getId(), "TestSample");
        $this->assertEquals($obj->getFirstName(), "TestSample");
        $this->assertEquals($obj->getLastName(), "TestSample");
        $this->assertEquals($obj->getEmail(), "TestSample");
        $this->assertEquals($obj->getBusinessName(), "TestSample");
        $this->assertEquals($obj->getPhone(), "TestSample");
        $this->assertEquals($obj->getMethod(), "TestSample");
        $this->assertEquals($obj->getShippingAddress(), ShippingAddressTest::getObject());
        $this->assertEquals($obj->getShippingCost(), ShippingCostTest::getObject());
    }
}
