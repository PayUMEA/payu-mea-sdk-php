<?php
/**
 * Created by PhpStorm.
 * User: kenny
 * Date: 12/19/16
 * Time: 10:23 AM
 */

namespace PayU\Test\Api;

use PayU\Test\Api\Helper;

use PayUSdk\Model\ShippingAddress;

class ShippingAddressTest extends \PHPUnit\Framework\TestCase
{
    /**
     * Gets Object Instance with Json data filled in
     * @return ShippingAddress
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
        return new ShippingAddress(self::getData());
    }

    /**
     * Gets Json String of Object Address
     * @return string
     */
    public static function getJson()
    {
        return '{"line1":"TestSample","line2":"TestSample","city":"TestSample","countryCode":"TestSample","postalCode":"TestSample","state":"TestSample","phone":' . PhoneTest::getJson() . ',"recipientName":"TestSample"}';
    }

    /**
     * Tests for Serialization and Deserialization Issues
     * @return ShippingAddress
     */
    public function testSerializationDeserialization()
    {
        $obj = new ShippingAddress(self::getData());
        $this->assertNotNull($obj);
        $this->assertNotNull($obj->getLine1());
        $this->assertNotNull($obj->getLine2());
        $this->assertNotNull($obj->getCity());
        $this->assertNotNull($obj->getCountryCode());
        $this->assertNotNull($obj->getPostalCode());
        $this->assertNotNull($obj->getState());
        $this->assertNotNull($obj->getPhone());
        $this->assertNotNull($obj->getRecipientName());
        $this->assertEquals(self::getObject(), $obj);
        return $obj;
    }

    /**
     * @depends testSerializationDeserialization
     * @param ShippingAddress $obj
     */
    public function testGetters($obj)
    {
        $this->assertEquals($obj->getLine1(), "TestSample");
        $this->assertEquals($obj->getLine2(), "TestSample");
        $this->assertEquals($obj->getCity(), "TestSample");
        $this->assertEquals($obj->getCountryCode(), "TestSample");
        $this->assertEquals($obj->getPostalCode(), "TestSample");
        $this->assertEquals($obj->getState(), "TestSample");
        $this->assertEquals($obj->getPhone(), PhoneTest::getObject());
        $this->assertNotNull($obj->getRecipientName(), 'TestSample');
    }
}
