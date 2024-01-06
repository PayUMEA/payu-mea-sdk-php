<?php
/**
 * Created by PhpStorm.
 * User: kenny
 * Date: 12/19/16
 * Time: 10:23 AM
 */

namespace PayU\Test\Api;

use PayUSdk\Api\Phone;

class PhoneTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Gets Object Instance with Json data filled in
     * @return Phone
     */
    public static function getObject()
    {
        return new Phone(self::getJson());
    }

    /**
     * Gets Json String of Object Address
     * @return string
     */
    public static function getJson()
    {
        return '{"countryCode":"TestSample","nationalNumber":"TestSample","extension":"TestSample"}';
    }

    /**
     * Tests for Serialization and Deserialization Issues
     * @return Phone
     */
    public function testSerializationDeserialization()
    {
        $obj = new Phone(self::getJson());
        $this->assertNotNull($obj);
        $this->assertNotNull($obj->getCountryCode());
        $this->assertNotNull($obj->getNationalNumber());
        $this->assertNotNull($obj->getExtension());
        $this->assertEquals(self::getJson(), $obj->toJson());
        return $obj;
    }

    /**
     * @depends testSerializationDeserialization
     * @param Phone $obj
     */
    public function testGetters($obj)
    {
        $this->assertEquals($obj->getCountryCode(), "TestSample");
        $this->assertEquals($obj->getNationalNumber(), "TestSample");
        $this->assertEquals($obj->getExtension(), "TestSample");
    }
}
