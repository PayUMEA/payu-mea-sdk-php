<?php
/**
 * Created by PhpStorm.
 * User: kenny
 * Date: 12/19/16
 * Time: 10:23 AM
 */

namespace PayU\Test\Api;

use PayUSdk\Api\Address;

class AddressTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Gets Object Instance with Json data filled in
     * @return Address
     */
    public static function getObject()
    {
        return new Address(self::getJson());
    }

    /**
     * Gets Json String of Object Address
     * @return string
     */
    public static function getJson()
    {
        return '{"line1":"TestSample","line2":"TestSample","city":"TestSample","countryCode":"TestSample","postalCode":"TestSample","state":"TestSample","phone":' . PhoneTest::getJson() . '}';
    }

    /**
     * Tests for Serialization and Deserialization Issues
     * @return Address
     */
    public function testSerializationDeserialization()
    {
        $obj = new Address(self::getJson());
        $this->assertNotNull($obj);
        $this->assertNotNull($obj->getLine1());
        $this->assertNotNull($obj->getLine2());
        $this->assertNotNull($obj->getCity());
        $this->assertNotNull($obj->getCountryCode());
        $this->assertNotNull($obj->getPostalCode());
        $this->assertNotNull($obj->getState());
        $this->assertNotNull($obj->getPhone());
        $this->assertEquals(self::getJson(), $obj->toJson());
        return $obj;
    }

    /**
     * @depends testSerializationDeserialization
     * @param Address $obj
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
    }
}
