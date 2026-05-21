<?php
/**
 * Created by PhpStorm.
 * User: kenny
 * Date: 12/19/16
 * Time: 10:23 AM
 */

namespace PayU\Test\Api;

use PayU\Test\Api\Helper;

use PayUSdk\Model\Phone;

class PhoneTest extends \PHPUnit\Framework\TestCase
{
    /**
     * Gets Object Instance with Json data filled in
     * @return Phone
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
        return new Phone(self::getData());
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
        $obj = new Phone(self::getData());
        $this->assertNotNull($obj);
        $this->assertNotNull($obj->getCountryCode());
        $this->assertNotNull($obj->getNationalNumber());
        $this->assertNotNull($obj->getExtension());
        $this->assertEquals(self::getObject(), $obj);
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
